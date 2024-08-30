<?php

namespace App\Models\LoginToken;

use App\Enums\EFeatured;
use App\Enums\ELoginTokenStatus;
use App\Enums\EState;

trait LoginTokenScopes
{
    public function scopeEnabled($query)
    {
        return $query->where($this->getTable() . '.state', EState::ENABLED);
    }

    public function scopeDisabled($query)
    {
        return $query->where($this->getTable() . '.state', EState::DISABLED);
    }

    public function scopeActive($query)
    {
        return $query->where($this->getTable() . '.status', ELoginTokenStatus::ACTIVE);
    }

    public function scopeDeactive($query)
    {
        return $query->where($this->getTable() . '.status', ELoginTokenStatus::DE_ACTIVE);
    }
}
