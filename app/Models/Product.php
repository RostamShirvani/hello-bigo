<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, sluggable;
    protected $table = "products";
    protected $guarded = [];
    protected $appends = ['check_quantity', 'check_sale', 'check_price'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getCheckQuantityAttribute()
    {
        return $this->variations()->where('quantity', '>', 0)->first() ?? 0;
    }

    public function getCheckSaleAttribute()
    {
        return $this->variations()
                ->where('quantity', '>', 0)
                ->where('sale_price', '!=', null)
                ->where('date_on_sale_from', '<', Carbon::now())
                ->where('date_on_sale_to', '>', Carbon::now())
                ->orderBy('sale_price')
                ->first() ?? false;
    }

    public function getCheckPriceAttribute()
    {
        return $this->variations()
                ->where('quantity', '>', 0)
                ->where('price', '!=', null)
                ->orderBy('sale_price')
                ->first() ?? false;
    }

    public function getIsActiveAttribute($is_active)
    {
        return $is_active ? 'فعال' : 'غیرفعال';
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function rates()
    {
        return $this->hasMany(ProductRate::class);
    }
}
