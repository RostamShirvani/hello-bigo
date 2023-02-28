<?php

namespace App\Http\Controllers\Home;

use Cart;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
           'product_id' => 'required',
           'qtybutton' => 'required'
        ]);

        $product = Product::query()->findOrFail($request->product_id);
        $productVariation = ProductVariation::query()->findOrFail(json_decode($request->variation)->id);
        if($request->qtybutton > $productVariation->quantity){
            alert()->error('توجه!', 'تعداد محصول خواسته شده، معتبر نمی باشد!');
            return redirect()->back();
        }

        // add the product to cart
        $rowId = $product->id .'-'.$productVariation->id;
        if (Cart::get($rowId) == null){
            Cart::add(array(
                'id' => $rowId,
                'name' => $product->name,
                'price' => $productVariation->is_sale ? $productVariation->sale_price : $productVariation->price,
                'quantity' => $request->qtybutton,
                'attributes' => $productVariation->toArray(),
                'associatedModel' => $product
            ));
        }else{
            alert()->warning('توجه!', 'این محصول قبلا به سبد خرید شما اضافه شده است!');
            return redirect()->back();
        }


        alert()->success('با تشکر', 'محصول مورد نظر به سبد خرید شما اضافه شد.');
        return redirect()->back();
    }
}
