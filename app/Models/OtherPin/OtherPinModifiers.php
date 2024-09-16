<?php

namespace App\Models\OtherPin;

use App\Enums\EPaymentPinStatus;

trait OtherPinModifiers
{
    public function getStatusTextAttribute()
    {
        return EPaymentPinStatus::getTrans($this->status);
    }
}
