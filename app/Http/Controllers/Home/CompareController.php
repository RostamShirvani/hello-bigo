<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Product;
use function session;

class CompareController extends Controller
{
    public function add(Product $product)
    {
        if(session()->has('compareProducts')){
            if(in_array($product->id , session()->get('compareProducts'))){
                alert()->warning('توجه!', 'محصول مورد نظر به لیست مقایسه اضافه شده است!')->persistent('حله');
                return redirect()->back();
            }
            session()->push('compareProducts', $product->id);
        }else{
            session()->put('compareProducts', [$product->id]);
        }

        alert()->success( 'با تشکر', 'محصول مورد نظر به لیست مقایسه اضافه شد.');
        return redirect()->back();
    }
}
