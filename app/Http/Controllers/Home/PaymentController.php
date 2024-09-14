<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\ProductVariation;
use App\PaymentGateway\Pay;
use App\PaymentGateway\Payment;
use App\PaymentGateway\Zarinpal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_method' => 'required',
            'confirmation_checkbox' => ['required', 'in:1'],
//            'address_id' => 'required',
        ]);
        if ($validator->fails()) {
            alert()->error('توجه!', 'اتصال به درگاه پرداخت انجام نشد! لطفا درگاه پرداخت و تیک مربوط به شرایط و قوانین سایت را بررسی و مجدد تلاش نمایید.');
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

        if(isset($amounts['paying_amount']) && $amounts['paying_amount'] == 0){
            $payment = new Payment();
            $createOrder = $payment->createOrder($request->get('address_id') ?? null, $amounts, null, 'free');
            if (array_key_exists('error', $createOrder)) {
                return $createOrder;
            }
            $order = $createOrder['order'];
            $updateOrder = $payment->updateOrder('free', 'free', $order->transaction->id);
            if (array_key_exists('error', $updateOrder)) {
                return $updateOrder;
            }
//            \Cart::clear();
            alert()->success('عملیات موفق', 'پرداخت با موفقیت انجام شد.');
            return  redirect()->route('home.users_profile.fallback', $order);
        }

        if ($request->payment_method == 'pay') {
            $payGateway = new Pay();
            $payGatewayResult = $payGateway->send($amounts, $request->address_id);
            if (array_key_exists('error', $payGatewayResult)) {
                alert()->error('توجه!', $payGatewayResult['error'])->persistent('حله');
                return redirect()->back();
            } else {
                return redirect()->to($payGatewayResult['success']);
            }
        }

        if ($request->payment_method == 'zarinpal') {
            $zarinpalGateway = new Zarinpal();
            $zarinpalGatewayResult = $zarinpalGateway->send($amounts, 'خرید تستی', $request->address_id);
            if (array_key_exists('error', $zarinpalGatewayResult)) {
                alert()->error('توجه!', $zarinpalGatewayResult['error'])->persistent('حله');
                return redirect()->back();
            } else {
                return redirect()->to($zarinpalGatewayResult['success']);
            }
        }
        alert()->error('توجه!', 'درگاه پرداخت انتخابی، اشتباه می باشد.');
        return redirect()->back();
    }

    public function paymentVerify(Request $request, $gatewayName)
    {
        if ($gatewayName == 'pay') {
            $payGateway = new Pay();
            $payGatewayResult = $payGateway->verify($request->token, $request->status);
            if (array_key_exists('error', $payGatewayResult)) {
                alert()->error('توجه!', $payGatewayResult['error'])->persistent('حله');
                return redirect()->back();
            } else {
                alert()->success('با تشکر', $payGatewayResult['success']);
                return redirect()->route('home.users_profile.fallback');
            }
        }
        if ($gatewayName == 'zarinpal') {
            $amounts = $this->getAmounts();
            if (array_key_exists('error', $amounts)) {
                alert()->error('توجه!', $amounts['error']);
                return redirect()->route('home.index');
            }

            $zarinpalGateway = new Zarinpal();
            $zarinpalGatewayResult = $zarinpalGateway->verify($amounts['paying_amount'], $request->Authority);
            if (array_key_exists('error', $zarinpalGatewayResult)) {
                alert()->error('توجه!', $zarinpalGatewayResult['error'])->persistent('حله');
                return redirect()->back();
            } else {
                // todo send sms to user
                alert()->success('با تشکر', $zarinpalGatewayResult['success']);
                return redirect()->route('home.users_profile.fallback');
            }
        }

        alert()->error('توجه!', 'مسیر برگشت از درگاه پرداخت اشتباه می باشد.');
        return redirect()->route('home.orders.checkout');

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
            'total_amount' => (\Cart::getTotal() + cartTotalDiscountAmount()) * 10, // Converted to rial
            'delivery_amount' => cartTotalDeliveryAmount() * 10, // Converted to rial
            'coupon_amount' => session()->has('coupon') ? session()->get('coupon.amount') * 10 : 0, // Converted to rial
            'paying_amount' => cartTotalAmount() * 10, // Converted to rial
        ];
    }
}

