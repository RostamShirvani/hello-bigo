<?php

namespace App\Models\LoginToken;

use App\Enums\ELoginTokenStatus;

trait LoginTokenModifiers
{
    public function getStatusTextAttribute()
    {
        return ELoginTokenStatus::getTrans($this->status);
    }
}
