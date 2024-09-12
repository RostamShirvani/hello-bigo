<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $guarded = [];

    const STATUS_NEW = 0;
    const STATUS_PAID_AND_COMPLETED = 1;
    const STATUS_PAID_AND_NOT_COMPLETED = 2;
    const STATUS_PAID_AND_IN_PROGRESS = 3;

    public function getStatusAttribute($status)
    {
        return match ($status) {
            self::STATUS_NEW => 'در انتظار پرداخت',
            self::STATUS_PAID_AND_IN_PROGRESS => 'پرداخت شده - در حال انجام',
            self::STATUS_PAID_AND_COMPLETED => 'پرداخت شده - تکمیل شده',
            self::STATUS_PAID_AND_NOT_COMPLETED => 'پرداخت شده - تکمیل نشده',
        };
    }
    public function getPaymentTypeAttribute($payment_type)
    {
        return match ($payment_type) {
            'pos' => 'دستگاه pos',
            'online' => 'پرداخت اینترنتی',
        };
    }
    public function getPaymentStatusAttribute($payment_status)
    {
        return match ($payment_status) {
            0 => 'ناموفق',
            1 => 'موفق',
        };
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
    public function address()
    {
        return $this->belongsTo(UserAddress::class);
    }

    public static function setStatus($order, $status = self::STATUS_NEW, $message = null)
    {
        return $order->update([
            'status' => $status,
            'status_description' => $order->status_description . $message,
        ]);
    }
}
