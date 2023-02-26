<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use App\Models\ProductRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required|min:5|max:7000',
            'rate' => 'required|digits_between:0,5'
        ]);

        if ($validator->fails()) {
            return redirect()->to(url()->previous() . '#comments')->withErrors($validator);
        }
        if (auth()->check()) {
            try {
                DB::beginTransaction();
                Comment::create([
                   'user_id' => auth()->id(),
                   'product_id' => $product->id,
                   'text' => $request->text
                ]);
                if($product->rates()->where('user_id', auth()->id())->exists()){
                    $productRate = $product->rates()->where('user_id', auth()->id())->first();
                    $productRate->update([
                        'rate' => $request->rate
                    ]);
                }else{
                    ProductRate::create([
                        'user_id' => auth()->id(),
                        'product_id' => $product->id,
                        'rate' => $request->rate
                    ]);
                }
                DB::commit();

                alert()->success( 'با تشکر', 'نظر شما با موفقیت ثبت شد.');
                return redirect()->back();
            } catch (\Exception $e) {
                DB::rollBack();
                alert()->error('مشکل در ثبت نظر', $e->getMessage())->persistent('حله');
                return redirect()->back();
            }
        } else {
            alert()->warning('توجه!', 'برای ثبت نظر، ابتدا وارد سایت شوید!')->persistent('حله');
        }
    }

    public function userProfileComment()
    {
        return view('home.users_profile.comments');
    }
}
