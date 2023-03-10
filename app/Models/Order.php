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

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
