<?php

namespace App\Models\RequestUrl;

use App\Enums\EState;

trait RequestUrlScopes
{
    public function scopeEnabled($query)
    {
        return $query->where($this->getTable() . '.state', EState::ENABLED);
    }

    public function scopeDisabled($query)
    {
        return $query->where($this->getTable() . '.state', EState::DISABLED);
    }
}
