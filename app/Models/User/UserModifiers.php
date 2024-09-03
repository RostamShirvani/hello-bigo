<?php

namespace App\Models\User;

trait UserModifiers
{
    public function getFullnameAttribute()
    {
        return "{$this->name} {$this->surname}";
    }

    public function getAddressAttribute()
    {
        return null;
    }
}
