<?php

namespace App\Models\PaymentPin;

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
        PaymentPinModifiers;

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

    public static function getActivePaymentPinsCountByValue($value, $appType = EAppType::BIGO_LIVE)
    {
        return PaymentPin::query()
            ->when($appType == EAppType::LIKEE, function ($query) use ($value) {
                $query->where('likee_value', $value);
            }, function ($query) use ($value) {
                $query->where('value', $value);
            })
            ->active()
            ->count();
    }
}
