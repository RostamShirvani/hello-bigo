<?php

namespace App\Models\PaymentPin;

use App\Enums\EAppType;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentPin extends BaseModel
{
    use HasFactory,
        SoftDeletes,
        PaymentPinRelationships,
        PaymentPinScopes,
        PaymentPinModifiers;

    protected $table = 'payment_pins';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'title',
        'serial_number',
        'pin',
        'amount',
        'value',
        'likee_value',
        'status',
        'state',
        'order_id',
        'wp_order_id',
        'wp_order_item_id',
        'tracking_code',
        'used_by_mobile',
        'extra',
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
