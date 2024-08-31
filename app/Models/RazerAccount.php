<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RazerAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'razer_id',
        'email_address',
        'charge_balance',
        'location',
        'charge_ceiling',
        'priority',
        'manual_updated_at',
    ];

    protected $casts = [
        'manual_updated_at' => 'datetime',
    ];

}
