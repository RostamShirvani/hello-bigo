<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariation;
use App\Models\Transaction;
use App\PaymentGateway\Pay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        //for (zarrinpal) gateway payment:
//        $data = array(
//            'MerchantID' => 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx',
//            'Amount' => 10000,
//            'CallbackURL' => route('home.payment_verify'),
//            'Description' => 'خرید تست'
//        );
//
//
//        $jsonData = json_encode($data);
//        $ch = curl_init('https://sandbox.zarinpal.com/pg/rest/WebGate/PaymentRequest.json');
//        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
//        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//            'Content-Type: application/json',
//            'Content-Length: ' . strlen($jsonData)
//        ));
//
//
//        $result = curl_exec($ch);
//        $err = curl_error($ch);
//        $result = json_decode($result, true);
//        curl_close($ch);
//
//
//        if ($err) {
//            echo "cURL Error #:" . $err;
//        } else {
//            if ($result["Status"] == 100) {
//                return redirect()->to('https://sandbox.zarinpal.com/pg/StartPay/' . $result["Authority"]);
//            } else {
//                echo 'ERR: ' . $result["Status"];
//            }
//        }


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
        $payGateway = new Pay();
        $payGatewayResult = $payGateway->send($amounts, $request->address_id);
        if (array_key_exists('error', $payGatewayResult)) {
            alert()->error('توجه!', $payGatewayResult['error'])->persistent('حله');
            return redirect()->back();
        }else{
            return redirect()->to($payGatewayResult['success']);
        }
    }

    public function paymentVerify(Request $request)
    {
        //for (pay) payment gateway
        $payGateway = new Pay();
        $payGatewayResult = $payGateway->verify($request->token, $request->status);
        if (array_key_exists('error', $payGatewayResult)) {
            alert()->error('توجه!', $payGatewayResult['error'])->persistent('حله');
            return redirect()->back();
        }else{
            alert()->success('با تشکر', $payGatewayResult['success']);
            return redirect()->route('home.index');
        }

        //for (zarrinpal) payment gateway:
//        $MerchantID = 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx';
//
//
//        $Authority = $request->Authority;
//
//        $data = array('MerchantID' => $MerchantID, 'Authority' => $Authority, 'Amount' => 10000);
//        $jsonData = json_encode($data);
//        $ch = curl_init('https://sandbox.zarinpal.com/pg/rest/WebGate/PaymentVerification.json');
//        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
//        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//            'Content-Type: application/json',
//            'Content-Length: ' . strlen($jsonData)
//        ));
//        $result = curl_exec($ch);
//        $err = curl_error($ch);
//        curl_close($ch);
//        $result = json_decode($result, true);
//        if ($err) {
//            echo "cURL Error #:" . $err;
//        } else {
//            if ($result['Status'] == 100) {
//                echo 'Transation success. RefID:' . $result['RefID'];
//            } else {
//                echo 'Transation failed. Status:' . $result['Status'];
//            }
//        }
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

