<?php

namespace App\Models\PaymentPin;

use App\Enums\EPaymentPinStatus;

trait OtherPinModifiers
{
    public function getStatusTextAttribute()
    {
        return EPaymentPinStatus::getTrans($this->status);
    }
}
