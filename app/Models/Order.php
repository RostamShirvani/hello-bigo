<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $guarded = [];

    public function getStatusAttribute($status)
    {
        return match ($status) {
            0 => 'در انتظار پرداخت',
            1 => 'پرداخت شده',
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
}
