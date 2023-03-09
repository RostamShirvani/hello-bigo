<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\ProductVariation;
use App\PaymentGateway\Zarinpal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_method' => 'required',
            'address_id' => 'required',
        ]);
        if ($validator->fails()) {
            alert()->error('توجه!', 'اتصال به درگاه پرداخت انجام نشد! لطفا مجدد تلاش نمایید.');
            return redirect()->back();
        }

        $checkCart = $this->checkCart();
        if (array_key_exists('error', $checkCart)) {
            alert()->error('توجه!', $checkCart['error']);
            return redirect()->route('home.index');
        }

        $amounts = $this->getAmounts();
        if (array_key_exists('error', $amounts)) {
            alert()->error('توجه!', $amounts['error']);
            return redirect()->route('home.index');
        }
        // for (pay) payment gateway:
//        $payGateway = new Pay();
//        $payGatewayResult = $payGateway->send($amounts, $request->address_id);
//        if (array_key_exists('error', $payGatewayResult)) {
//            alert()->error('توجه!', $payGatewayResult['error'])->persistent('حله');
//            return redirect()->back();
//        }else{
//            return redirect()->to($payGatewayResult['success']);
//        }

        // for (zarinpal) payment gateway:
        $zarinpalGateway = new Zarinpal();
        $zarinpalGatewayResult = $zarinpalGateway->send($amounts, 'خرید تستی', $request->address_id);
        if (array_key_exists('error', $zarinpalGatewayResult)) {
            alert()->error('توجه!', $zarinpalGatewayResult['error'])->persistent('حله');
            return redirect()->back();
        }else{
            return redirect()->to($zarinpalGatewayResult['success']);
        }
    }

    public function paymentVerify(Request $request)
    {
        //for (pay) payment gateway
//        $payGateway = new Pay();
//        $payGatewayResult = $payGateway->verify($request->token, $request->status);
//        if (array_key_exists('error', $payGatewayResult)) {
//            alert()->error('توجه!', $payGatewayResult['error'])->persistent('حله');
//            return redirect()->back();
//        }else{
//            alert()->success('با تشکر', $payGatewayResult['success']);
//            return redirect()->route('home.index');
//        }

        //for (zarrinpal) payment gateway:
        $amounts = $this->getAmounts();
        if (array_key_exists('error', $amounts)) {
            alert()->error('توجه!', $amounts['error']);
            return redirect()->route('home.index');
        }

        $zarinpalGateway = new Zarinpal();
        $zarinpalGatewayResult = $zarinpalGateway->verify($request->Authority, $amounts['paying_amount']);
        if (array_key_exists('error', $zarinpalGatewayResult)) {
            alert()->error('توجه!', $zarinpalGatewayResult['error'])->persistent('حله');
            return redirect()->back();
        }else{
            alert()->success('با تشکر', $zarinpalGatewayResult['success']);
            return redirect()->route('home.index');
        }
    }

    public function checkCart()
    {
        if (\Cart::isEmpty()) {
            return ['error' => 'سبد خرید شما خالی است!'];
        }
        foreach (\Cart::getContent() as $item) {
            $variation = ProductVariation::query()->findOrFail($item->attributes->id);
            $price = $variation->is_sale ? $variation->sale_price : $variation->price;
            if ($item->price != $price) {
                \Cart::clear();
                return ['error' => 'قیمت محصولات تغییر کرده است'];
            }
            if ($item->quantity > $variation->quantity) {
                \Cart::clear();
                return ['error' => 'موجودی محصولات تغییر کرده است.'];
            }
        }
        return ['success' => 'success!'];
    }

    public function getAmounts()
    {
        if (session()->has('coupon')) {
            $checkCoupon = checkCoupon(session()->get('coupon.code'));
            if (array_key_exists('error', $checkCoupon)) {
                return $checkCoupon;
            }
        }

        return [
            'total_amount' => (\Cart::getTotal() + cartTotalDiscountAmount()),
            'delivery_amount' => cartTotalDeliveryAmount(),
            'coupon_amount' => session()->has('coupon') ? session()->get('coupon.amount') : 0,
            'paying_amount' => cartTotalAmount(),
        ];
    }
}

