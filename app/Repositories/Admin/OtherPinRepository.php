<?php

namespace App\Repositories\Admin;

use App\Enums\EAppType;
use App\Enums\EPaymentPinStatus;
use App\Enums\EState;
use App\Models\OtherPin\OtherPin;
use App\Models\PaymentPin\PaymentPin;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Auth;

class OtherPinRepository extends BaseAdminRepository
{
    public function __construct(PaymentPin $model)
    {
        $this->setModel($model);
    }

    public function getOtherPins(array $searchParams = [])
    {
        // Start a query for the PaymentPin model
        $query = OtherPin::query();

        // Apply filters based on the search parameters
        if (!empty($searchParams['id'])) {
            $query->where('id', $searchParams['id']);
        }

        if (!empty($searchParams['amount'])) {
            $query->where('amount', $searchParams['amount']);
        }

        if (!empty($searchParams['order_id'])) {
            $query->where('order_id', 'like', '%' . $searchParams['order_id'] . '%');
        }

        if (!empty($searchParams['order_item_id'])) {
            $query->where('order_item_id', 'like', '%' . $searchParams['order_item_id'] . '%');
        }

        if (!empty($searchParams['used_by'])) {
            $query->where('used_by', $searchParams['used_by']);
        }

        if (!empty($searchParams['status'])) {
            $query->where('status', $searchParams['status']);
        }

        if (!empty($searchParams['used_at'])) {
            // Convert Jalali to Gregorian
            $jalaliDate = $searchParams['used_at'];
            $vStart = Verta::parse($jalaliDate); // Parse Jalali date
            $vEnd = Verta::parse($jalaliDate)->addDay(); // Add 1 day to get the end of the day
            $gregorianDateStart = $vStart->datetime(); // Get Gregorian datetime for the start of the day
            $gregorianDateEnd = $vEnd->datetime(); // Get Gregorian datetime for the end of the day

// Filter accounts updated between the start and end of the specific day
            $query->whereBetween('used_at', [
                Carbon::parse($gregorianDateStart)->format('Y-m-d H:i:s'),
                Carbon::parse($gregorianDateEnd)->format('Y-m-d H:i:s')
            ]);
        }

        if (!empty($searchParams['app_type'])) {
            $query->where('app_type',  $searchParams['app_type']);
        }

        if (!empty($searchParams['pin'])) {
            $query->where('pin', 'like', '%' . $searchParams['pin'] . '%');
        }

        if (!empty($searchParams['value'])) {
            $query->where('value', 'like', '%' . $searchParams['value'] . '%');
        }

        if (!empty($searchParams['used_by_mobile'])) {
            $query->where('used_by_mobile', 'like', '%' . $searchParams['used_by_mobile'] . '%');
        }

        // Add your default ordering
        $query->orderBy('id', 'desc')
            ->orderBy('used_at', 'desc');

        // Return the paginated result
        return $query->paginate(20);
    }

    public function store($request)
    {
        $paymentPin = new OtherPin();
        $paymentPin->app_type = $request->input('app_type');
        $paymentPin->pin = $request->input('pin');
        $paymentPin->amount = $request->input('amount');
        $paymentPin->value = $request->input('value');
        $paymentPin->status = EPaymentPinStatus::UNUSED;
        $paymentPin->state = EState::ENABLED;
        $paymentPin->created_by = Auth::user()->id;
        $paymentPin->save();

        return $paymentPin;
    }

    public function update($request, $id)
    {
        $paymentPin = OtherPin::query()->findOrFail($id);
        $paymentPin->order_id = $request->input('order_id');
        $paymentPin->order_item_id = $request->input('order_item_id');
        $paymentPin->save();

        return $paymentPin;
    }

    public function bulkStore($request)
    {
        $items = array_filter($request->input('items'), function ($item) {
            return !empty($item['app_type'] && !empty($item['pin']) && !empty($item['amount']) && !empty($item['value']));
        });

        if (empty($items)) {
            return false;
        }

        foreach ($items as $item) {
            $paymentPin = new OtherPin();
            $paymentPin->app_type = $item['app_type'];
            $paymentPin->pin = $item['pin'];
            $paymentPin->amount = $item['amount'];
            $paymentPin->value = $item['value'];
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
//                if (!empty($explode[0]) && !empty($explode[1])) {
                if (!empty($explode[0])) {
                    return [
                        'pin' => trim(str_replace("\r", '', $explode[0])),
//                        'serial_number' => trim(str_replace("\r", '', $explode[1])),
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
                $countOfOtherPins = OtherPin::query()
//                    ->where('serial_number', $item['serial_number'])
                    ->Where('pin', $item['pin'])
                    ->count();

                if ($countOfOtherPins > 0) {
                    continue;
                }

                $paymentPin = new OtherPin();
                $paymentPin->app_type = $request->input('app_type');
                $paymentPin->pin = $item['pin'];
                $paymentPin->amount = $request->input('amount');
                $paymentPin->value = $request->input('value');
                $paymentPin->status = EPaymentPinStatus::UNUSED;
                $paymentPin->state = EState::ENABLED;
                $paymentPin->created_by = Auth::user()->id;
                $paymentPin->save();
            }

            return true;
        }

        return false;
    }

    public function getActiveOtherPins()
    {
        return OtherPin::query()
            ->active()
            ->get();
    }

    public function getActiveOtherPinByAmount($amount)
    {
        return OtherPin::query()
            ->where('amount', $amount)
            ->select([
                'id',
                'app_type',
                'pin',
                'amount',
                'state',
                'status',
            ])
            ->active()
            ->first();
    }

    public function getActiveOtherPinByValue($value, $appType)
    {
        return OtherPin::query()
            ->when(function ($query) use ($value, $appType) {
                $query->where('app_type', $appType);
            }, function ($query) use ($value) {
                $query->where('value', $value);
            })
            ->select([
                'id',
                'app_type',
                'pin',
                'amount',
                'value',
                'state',
                'status',
            ])
            ->active()
            ->first();
    }

    public function getActiveOthersCountPinByAmount($amount)
    {
        return OtherPin::query()
            ->where('amount', $amount)
            ->active()
            ->count();
    }

    public function getActiveOthersCountPinByValue($value, $appType)
    {
        return OtherPin::query()
            ->when(function ($query) use ($appType) {
                $query->where('app_type', $appType);
            }, function ($query) use ($value) {
                $query->where('value', $value);
            })
            ->active()
            ->count();
    }

    public function setOtherPinAsUsed($paymentPin, $usedBy, $orderId = null, $trackingCode = null, $orderAppType = null, $mobile = null, $orderItemId = null)
    {
        OtherPin::query()
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

    public function setOtherPinAsRejected($paymentPin, $orderAppType = EAppType::BIGO_LIVE, $orderId = null, $mobile = null, $orderItemId = null)
    {
        OtherPin::query()
            ->where('id', $paymentPin->id)
            ->update([
                'status' => EPaymentPinStatus::REJECTED,
                'order_app_type' => $orderAppType,
                'order_id' => $orderId,
                'order_item_id' => $orderItemId,
            ]);
    }

    public function getOtherPinByOrderId($orderId)
    {
        return OtherPin::query()
            ->where('order_id', $orderId)
            ->first();
    }

    public function getOtherPinByOrderItemId($orderItemId)
    {
        return OtherPin::query()
            ->where('order_item_id', $orderItemId)
            ->first();
    }
}
