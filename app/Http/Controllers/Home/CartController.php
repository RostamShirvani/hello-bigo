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
        // Fetch the product based on the validated product_id
        $product = Product::query()->findOrFail($request->product_id);

        // Create a custom validator with all rules
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'confirmation_checkbox' => ['required', 'in:1'],
            'variation' => ['required', function ($attribute, $value, $fail) {
                $variationData = json_decode($value, true);

                if (!isset($variationData['id'])) {
                    return $fail('لطفا تعداد الماس را انتخاب نمایید.');
                }

                $productVariation = ProductVariation::find($variationData['id']);

                if (!$productVariation) {
                    return $fail('تعداد الماس انتخاب شده، یافت نشد.');
                }

                if ($productVariation->freeCount() <= 0) {
                    return $fail('تعداد الماس انتخاب شده، ناموجود می باشد، لطفا بررسی نمایید.');
                }
            }],
            'bigo_id' => (in_array($request->product_type, [EAppType::BIGO_LIVE, EAppType::LIKEE]) ? 'required' : ''),
            'account_name' => [
                $request->product_type == EAppType::BIGO_LIVE ? 'required' : '',
                function ($attribute, $value, $fail) {
                    if ($value === 'یافت نشد') {
                        $fail('نام اکانت ("یافت نشد") نامعتبر است، لطفا مجدد بررسی نمایید.');
                    }
                },
            ],
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            // Get all error messages as a single string
            $errors = implode("\n", $validator->errors()->all());

            // Display warning alert with validation errors
            alert()->warning('توجه!', $errors);

            // Redirect back with errors and input
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $productVariation = ProductVariation::query()->findOrFail(json_decode($request->variation)->id);
        if ($request->qtybutton > $productVariation->quantity) {
            alert()->error('توجه!', 'تعداد محصول خواسته شده، معتبر نمی باشد!');
            return redirect()->back();
        }

        if (($product->app_type == EAppType::BIGO_LIVE || $product->app_type == EAppType::LIKEE)) {
            $account_id = $request->get('bigo_id') ?? null;
            $account_name = $request->get('account_name') ?? null;
            $account_avatar_url = $request->get('account_avatar_url') ?? null;
        }

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

}
