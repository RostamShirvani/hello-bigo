<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = "order_items";
    protected $guarded = [];

    const STATUS_NEW = 0;
    const STATUS_CHARGED = 1;
    const STATUS_BLACKLIST = 2;
    const STATUS_PAID_AND_IN_PROGRESS = 3;
    const STATUS_PIN_FINISHED = 4;
    const STATUS_PIN_INVALID = 5;
    const STATUS_TOKEN_INACTIVE = 6;
    const STATUS_DUPLICATE = 7;
    const STATUS_EMPTY_CLIENT_API = 8;
    const STATUS_MISSED_FIELDS = 9;
    const STATUS_UNKNOWN = 99;

    public function getStatusAttribute($status)
    {
        return match ($status) {
            self::STATUS_NEW => 'در انتظار پرداخت',
            self::STATUS_PAID_AND_IN_PROGRESS => 'در حال انجام ...',
            self::STATUS_CHARGED => 'شارژ شده',
            self::STATUS_BLACKLIST => 'بلک لیست',
            self::STATUS_PIN_FINISHED => 'موجودی پین تمام شد',
            self::STATUS_PIN_INVALID => 'پین نامعتبر',
            self::STATUS_TOKEN_INACTIVE => 'توکن غیر فعال',
            self::STATUS_DUPLICATE => 'آیتم تکراری',
            self::STATUS_EMPTY_CLIENT_API => 'Empty client api',
            self::STATUS_MISSED_FIELDS => 'Missed fields',
            self::STATUS_UNKNOWN => 'نامشخص',
        };
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productVariation()
    {
        return $this->belongsTo(ProductVariation::class, 'product_variation_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public static function setStatus($orderItem, $status = self::STATUS_NEW)
    {
        return $orderItem->update([
            'status' => $status
        ]);
    }
}
