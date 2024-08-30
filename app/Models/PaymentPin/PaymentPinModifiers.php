<?php

namespace App\Models\PaymentPin;

use App\Enums\EPaymentPinStatus;

trait PaymentPinModifiers
{
    public function getStatusTextAttribute()
    {
        return EPaymentPinStatus::getTrans($this->status);
    }
}
