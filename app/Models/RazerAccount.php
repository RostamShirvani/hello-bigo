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
        'bigo_updated_at',
        'pubg_updated_at',
        'imo_updated_at',
    ];

    protected $casts = [
        'bigo_updated_at' => 'datetime',
        'pubg_updated_at' => 'datetime',
        'imo_updated_at' => 'datetime',
    ];

    public static function getCurrentSelectedRazerAccount()
    {
        return RazerAccount::orderBy('priority', 'asc')
            ->orderBy('id', 'asc')
            ->first();
    }
}
