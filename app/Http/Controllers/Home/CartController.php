<?php

namespace App\Http\Controllers\Home;

use App\Enums\EAppType;
use App\Models\Order;
use App\Models\Province;
use App\Models\UserAddress;
use Cart;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'variation' => 'required',
            'confirmation_checkbox' => ['required', 'in:1'],
        ],
//            [
//                'product_id.required' => 'Product is required.',
//                'variation.required' => 'Variation is required.',
//                'confirmation_checkbox.required' => 'You must confirm the checkbox.',
//                'confirmation_checkbox.in' => 'The confirmation checkbox must be checked.',
//            ]
        );

        if ($validator->fails()) {
            // Get all error messages as a single string
            $errors = implode("\n", $validator->errors()->all());

            // Display warning alert with validation errors
            alert()->warning('توجه!', $errors);

            // Redirect back with errors and input
            return redirect()->back()->withErrors($validator)->withInput();
        }


        // Fetch the product based on the validated product_id
        $product = Product::query()->findOrFail($request->product_id);

        // Perform further validation based on the app_type of the product
        $request->validate([
            'bigo_id' => $product->app_type == EAppType::BIGO_LIVE ? 'required' : '',
            'account_name' => $product->app_type == EAppType::BIGO_LIVE ? 'required' : '',
//            'account_avatar_url' => $product->app_type == EAppType::BIGO_LIVE ? 'required' : '',
//             'qtybutton' => 'required'
        ]);

        $productVariation = ProductVariation::query()->findOrFail(json_decode($request->variation)->id);
        if ($request->qtybutton > $productVariation->quantity) {
            alert()->error('توجه!', 'تعداد محصول خواسته شده، معتبر نمی باشد!');
            return redirect()->back();
        }

        $account_id = $product->app_type == EAppType::BIGO_LIVE ? $request->get('bigo_id') : null;
        $account_name = $product->app_type == EAppType::BIGO_LIVE ? $request->get('account_name') : null;
        $account_avatar_url = $product->app_type == EAppType::BIGO_LIVE ? $request->get('account_avatar_url') : null;

        // add the product to cart
        $rowId = $product->id . '-' . $productVariation->id . '-' . $account_id;
        if (Cart::get($rowId) == null) {
            Cart::add(array(
                'id' => $rowId,
                'name' => $product->name,
                'price' => $productVariation->is_sale ? $productVariation->sale_price : $productVariation->price,
                'quantity' => 1, // In  this shop the quantity of each product is 1
                'attributes' => $productVariation->toArray(),
                'associatedModel' => $product,
            ));

            // Start the session if not already started
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            // Store account_id and account_name and account_username in the session associated with this rowId
            $_SESSION['cart'][$rowId] = array(
                'account_id' => $account_id,
                'account_name' => $account_name,
                'account_avatar_url' => $account_avatar_url,
//                'account_username' => $account_username
            );

        } else {
            alert()->warning('توجه!', 'این محصول قبلا به سبد خرید شما اضافه شده است!');
            return redirect()->back();
        }

        alert()->success('با تشکر', 'محصول مورد نظر به سبد خرید شما اضافه شد.');
        return redirect()->back();
    }

    public function index()
    {
        return view('home.cart.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'qtybutton' => 'required'
        ]);

        foreach ($request->qtybutton as $rowId => $quantity) {

            $item = Cart::get($rowId);
            if ($quantity > $item->attributes->quantity) {
                alert()->error('توجه!', 'تعداد محصول خواسته شده، معتبر نمی باشد!');
                return redirect()->back();
            }
            Cart::update($rowId, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $quantity
                ),
            ));
        }
        alert()->success('با تشکر', 'سبد خرید ویرایش شد.');
        return redirect()->back();

    }

    public function remove($rowId)
    {
        Cart::remove($rowId);
        alert()->success('با تشکر', 'محصول مورد نظر از سبد خرید شما حذف شد.');
        return redirect()->back();
    }

    public function clear()
    {
        Cart::clear();
        alert()->warning('با تشکر', 'سبد خرید شما خالی شد!');
        return redirect()->back();
    }

    public function checkCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required'
        ]);
        if (!auth()->check()) {
            alert()->error('توجه!', 'برای استفاده از کد تخفیف، نیاز است ابتدا وارد سایت شوید!');
            return redirect()->back();
        }
        $result = checkCoupon($request->code);
        if (array_key_exists('error', $result)) {
            alert()->error('توجه!', $result['error']);
        } else {
            alert()->success('با تشکر', $result['success']);
        }
        return redirect()->back();
    }

    public function checkout()
    {
        if (\Cart::isEmpty()) {
            alert()->warning('توجه!', 'سبد خرید شما خالی است!');
            return redirect()->route('home.index');
        }
        $addresses = UserAddress::query()->where('user_id', auth()->id())->get();
        $provinces = Province::all();

        return view('home.cart.checkout', compact('addresses', 'provinces'));
    }

    public function usersProfileIndex()
    {
        $orders = Order::query()
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc') // Sort by created_at in descending order
            ->get();
        return view('home.users_profile.orders', compact('orders'));
    }
}
