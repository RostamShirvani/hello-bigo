<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Product;
use function session;

class CompareController extends Controller
{
    public function add(Product $product)
    {
        if (session()->has('compareProducts')) {
            if (in_array($product->id, session()->get('compareProducts'))) {
                alert()->warning('توجه!', 'محصول مورد نظر به لیست مقایسه اضافه شده است!')->persistent('حله');
                return redirect()->back();
            }
            session()->push('compareProducts', $product->id);
        } else {
            session()->put('compareProducts', [$product->id]);
        }

        alert()->success('با تشکر', 'محصول مورد نظر به لیست مقایسه اضافه شد.');
        return redirect()->back();
    }

    public function index()
    {
        if (session()->has('compareProducts')) {
            $products = Product::query()->findOrFail(session()->get('compareProducts'));
            return view('home.compare.index', compact('products'));
        } else {
            alert()->warning('توجه!', 'ابتدا محصولی را به لیست مقایسه اضافه نمایید!')->persistent('حله');
            return redirect()->back();
        }
    }

    public function remove($productId)
    {
        if (session()->has('compareProducts')) {
            foreach (session()->get('compareProducts') as $key => $item) {
                if ($item == $productId) {
                    session()->pull('compareProducts.' . $key);
                }
            }
            if (session()->get('compareProducts') == []) {
                session()->forget('compareProducts');
                return redirect()->route('home.index');
            }
            return redirect()->route('home.compare.index');
        } else {
            alert()->warning('توجه!', 'ابتدا محصولی را به لیست مقایسه اضافه نمایید!')->persistent('حله');
            return redirect()->back();
        }
    }
}
