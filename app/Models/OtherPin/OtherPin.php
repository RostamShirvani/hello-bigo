<?php

namespace App\Models\OtherPin;

use App\Enums\EAppType;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtherPin extends BaseModel
{
    use HasFactory,
        SoftDeletes,
        OtherPinRelationships,
        OtherPinScopes,
        OtherPinModifiers;

    protected $table = 'other_pins';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'title',
        'type',
        'pin',
        'amount',
        'value',
        'status',
        'state',
        'used_by_mobile',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'extra' => 'array'
    ];

    public static function getActivePaymentPinsCountByValue($value, $appType)
    {
        return OtherPin::query()
            ->when(function ($query) use ($appType) {
                $query->where('app_type', $appType);
            }, function ($query) use ($value) {
                $query->where('value', $value);
            })
            ->active()
            ->count();
    }
}
