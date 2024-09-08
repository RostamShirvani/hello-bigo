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
    const STATUS_PIN_FINISHED = 3;
    const STATUS_PIN_INVALID = 4;
    const STATUS_TOKEN_INACTIVE = 5;
    const STATUS_DUPLICATE = 6;
    const STATUS_EMPTY_CLIENT_API = 7;
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

    public static function setStatus($orderItemId, $status = self::STATUS_NEW)
    {
        $orderItem = OrderItem::query()->findOrFail($orderItemId);
        return $orderItem->update([
            'status' => $status
        ]);
    }
}
