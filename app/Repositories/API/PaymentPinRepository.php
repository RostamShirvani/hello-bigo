<?php

namespace App\Repositories\API;

use App\Enums\EAppType;
use App\Enums\EPaymentPinStatus;
use App\Models\PaymentPin\PaymentPin;

class PaymentPinRepository extends BaseAPIRepository
{
    public function __construct(PaymentPin $model)
    {
        $this->setModel($model);
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

    public function setPaymentPinAsUsed($paymentPin, $usedBy, $orderId = null, $trackingCode = null, $orderAppType = null, $mobile = null)
    {
        PaymentPin::query()
            ->where('id', $paymentPin->id)
            ->update([
                'order_id' => $orderId,
                'wp_order_id' => request()->input('wp_order_id') ?: null,
                'wp_order_item_id' => request()->input('wp_order_item_id') ?: null,
                'tracking_code' => $trackingCode,
                'status' => EPaymentPinStatus::USED,
                'order_app_type' => $orderAppType ?: EAppType::BIGO_LIVE,
                'used_at' => now(),
                'used_by' => $usedBy,
                'used_by_mobile' => $mobile ?? null,
            ]);
    }

    public function setPaymentPinAsRejected($paymentPin, $orderAppType = EAppType::BIGO_LIVE, $orderId = null, $mobile = null)
    {
        PaymentPin::query()
            ->where('id', $paymentPin->id)
            ->update([
                'status' => EPaymentPinStatus::REJECTED,
                'order_app_type' => $orderAppType,
                'order_id' => $orderId,
                'wp_order_id' => request()->input('wp_order_id') ?: null,
                'wp_order_item_id' => request()->input('wp_order_item_id') ?: null,
            ]);
    }

    public function getPaymentPinByOrderId($orderId)
    {
        return PaymentPin::query()
            ->where('order_id', $orderId)
            ->first();
    }
}
