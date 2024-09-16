<?php

namespace App\Repositories\Admin;

use App\Enums\EAppType;
use App\Enums\EPaymentPinStatus;
use App\Enums\EState;
use App\Models\PaymentPin\PaymentPin;
use Illuminate\Support\Facades\Auth;

class PaymentPinRepository extends BaseAdminRepository
{
    public function __construct(PaymentPin $model)
    {
        $this->setModel($model);
    }

    public function getPaymentPins()
    {
        return PaymentPin::query()
            ->orderBy('id', 'desc')
            ->orderBy('used_at', 'desc')
            ->paginate(20);
    }

    public function store($request)
    {
        $paymentPin = new PaymentPin();
        $paymentPin->serial_number = $request->input('serial_number');
        $paymentPin->pin = $request->input('pin');
        $paymentPin->amount = $request->input('amount');
        $paymentPin->value = $request->input('value');
        $paymentPin->likee_value = $request->input('likee_value');
        $paymentPin->status = EPaymentPinStatus::UNUSED;
        $paymentPin->state = EState::ENABLED;
        $paymentPin->created_by = Auth::user()->id;
        $paymentPin->save();

        return $paymentPin;
    }

    public function bulkStore($request)
    {
        $items = array_filter($request->input('items'), function ($item) {
            return !empty($item['serial_number'] && !empty($item['pin']) && !empty($item['amount']) && !empty($item['value']));
        });

        if (empty($items)) {
            return false;
        }

        foreach ($items as $item) {
            $paymentPin = new PaymentPin();
            $paymentPin->serial_number = $item['serial_number'];
            $paymentPin->pin = $item['pin'];
            $paymentPin->amount = $item['amount'];
            $paymentPin->value = $item['value'];
            $paymentPin->likee_value = $item['likee_value'] ?? null;
            $paymentPin->status = EPaymentPinStatus::UNUSED;
            $paymentPin->state = EState::ENABLED;
            $paymentPin->created_by = Auth::user()->id;
            $paymentPin->save();
        }

        return true;
    }

    public function fileStore($request)
    {
        $content = $request->file('file')->get();
        $collection = collect(explode("\n", $content));
        $collection = $collection
            ->filter(function ($item) {
                return !empty($item);
            })
            ->map(function ($item) {
                $explode = explode('=', $item);
                if (!empty($explode[0]) && !empty($explode[1])) {
                    return [
                        'pin' => trim(str_replace("\r", '', $explode[0])),
                        'serial_number' => trim(str_replace("\r", '', $explode[1])),
                    ];
                }

                return false;
            })
            ->filter(function ($item) {
                return !empty($item);
            })
            ->values();

        if (!empty($collection)) {
            foreach ($collection as $item) {
                $countOfPaymentPins = PaymentPin::query()
                    ->where('serial_number', $item['serial_number'])
                    ->orWhere('pin', $item['pin'])
                    ->count();

                if ($countOfPaymentPins > 0) {
                    continue;
                }

                $paymentPin = new PaymentPin();
                $paymentPin->serial_number = $item['serial_number'];
                $paymentPin->pin = $item['pin'];
                $paymentPin->amount = $request->input('amount');
                $paymentPin->value = $request->input('value');
                $paymentPin->likee_value = $request->input('likee_value');
                $paymentPin->status = EPaymentPinStatus::UNUSED;
                $paymentPin->state = EState::ENABLED;
                $paymentPin->created_by = Auth::user()->id;
                $paymentPin->save();
            }

            return true;
        }

        return false;
    }

    public function getActivePaymentPins()
    {
        return PaymentPin::query()
            ->active()
            ->get();
    }

    public function getActivePaymentPinByAmount($amount)
    {
        return PaymentPin::query()
            ->where('amount', $amount)
            ->select([
                'id',
                'serial_number',
                'pin',
                'amount',
                'state',
                'status',
            ])
            ->active()
            ->first();
    }

    public function getActivePaymentPinByValue($value, $appType = EAppType::BIGO_LIVE)
    {
        return PaymentPin::query()
            ->when($appType == EAppType::LIKEE, function ($query) use ($value) {
                $query->where('likee_value', $value);
            }, function ($query) use ($value) {
                $query->where('value', $value);
            })
            ->select([
                'id',
                'serial_number',
                'pin',
                'amount',
                'value',
                'state',
                'status',
            ])
            ->active()
            ->first();
    }

    public function getActivePaymentsCountPinByAmount($amount)
    {
        return PaymentPin::query()
            ->where('amount', $amount)
            ->active()
            ->count();
    }

    public function getActivePaymentsCountPinByValue($value, $appType = EAppType::BIGO_LIVE)
    {
        return PaymentPin::query()
            ->when($appType == EAppType::LIKEE, function ($query) use ($value) {
                $query->where('likee_value', $value);
            }, function ($query) use ($value) {
                $query->where('value', $value);
            })
            ->active()
            ->count();
    }

    public function setPaymentPinAsUsed($paymentPin, $usedBy, $orderId = null, $trackingCode = null, $orderAppType = null, $mobile = null, $orderItemId = null)
    {
        PaymentPin::query()
            ->where('id', $paymentPin->id)
            ->update([
                'order_id' => $orderId,
                'order_item_id' => $orderItemId,
                'tracking_code' => $trackingCode,
                'status' => EPaymentPinStatus::USED,
                'order_app_type' => $orderAppType ?: EAppType::BIGO_LIVE,
                'used_at' => now(),
                'used_by' => $usedBy,
                'used_by_mobile' => $mobile ?? null,
            ]);
    }

    public function setPaymentPinAsRejected($paymentPin, $orderAppType = EAppType::BIGO_LIVE, $orderId = null, $mobile = null, $orderItemId = null)
    {
        PaymentPin::query()
            ->where('id', $paymentPin->id)
            ->update([
                'status' => EPaymentPinStatus::REJECTED,
                'order_app_type' => $orderAppType,
                'order_id' => $orderId,
                'order_item_id' => $orderItemId,
            ]);
    }

    public function getPaymentPinByOrderId($orderId)
    {
        return PaymentPin::query()
            ->where('order_id', $orderId)
            ->first();
    }

    public function getPaymentPinByOrderItemId($orderItemId)
    {
        return PaymentPin::query()
            ->where('order_item_id', $orderItemId)
            ->first();
    }
}
