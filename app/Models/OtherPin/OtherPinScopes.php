<?php

namespace App\Models\OtherPin;

use App\Enums\EFeatured;
use App\Enums\EPaymentPinStatus;
use App\Enums\EState;

trait OtherPinScopes
{
    public function scopeEnabled($query)
    {
        return $query->where($this->getTable() . '.state', EState::ENABLED);
    }

    public function scopeDisabled($query)
    {
        return $query->where($this->getTable() . '.state', EState::DISABLED);
    }

    public function scopeUnused($query)
    {
        return $query->where($this->getTable() . '.status', EPaymentPinStatus::UNUSED);
    }

    public function scopeUsed($query)
    {
        return $query->where($this->getTable() . '.status', EPaymentPinStatus::USED);
    }

    public function scopeActive($query)
    {
        return $query->enabled()->unused()->whereNull(['order_id']);
    }
}
