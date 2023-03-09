<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariation;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        //for (zarrinpal) gateway payment:
        $data = array(
            'MerchantID' => 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx',
            'Amount' => 10000,
            'CallbackURL' => route('home.payment_verify'),
            'Description' => 'خرید تست'
        );


        $jsonData = json_encode($data);
        $ch = curl_init('https://sandbox.zarinpal.com/pg/rest/WebGate/PaymentRequest.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));


        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true);
        curl_close($ch);


        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            if ($result["Status"] == 100) {
                return redirect()->to('https://sandbox.zarinpal.com/pg/StartPay/' . $result["Authority"]);
            } else {
                echo 'ERR: ' . $result["Status"];
            }
        }

        // for (pay) payment gateway:
//        $validator = Validator::make($request->all(), [
//            'payment_method' => 'required',
//            'address_id' => 'required',
//        ]);
//        if ($validator->fails()) {
//            alert()->error('توجه!', 'اتصال به درگاه پرداخت انجام نشد! لطفا مجدد تلاش نمایید.');
//            return redirect()->back();
//        }
//
//        $checkCart = $this->checkCart();
//        if (array_key_exists('error', $checkCart)) {
//            alert()->error('توجه!', $checkCart['error']);
//            return redirect()->route('home.index');
//        }
//
//        $amounts = $this->getAmounts();
//        if (array_key_exists('error', $amounts)) {
//            alert()->error('توجه!', $amounts['error']);
//            return redirect()->route('home.index');
//        }
//
//        $api = 'test';
//        $amount = $amounts['paying_amount'];
////        $mobile = "شماره موبایل";
////        $factorNumber = "شماره فاکتور";
////        $description = "توضیحات";
//        $redirect = route('home.payment_verify');
//        $result = $this->send($api, $amount, $redirect);
//        $result = json_decode($result);
//        if ($result->status) {
//            $createOrder = $this->createOrder($request->address_id, $amounts, $result->token, 'pay');
//            if (array_key_exists('error', $createOrder)) {
//                alert()->error('توجه!', $createOrder['error'])->persistent('حله');
//                return redirect()->back();
//            }
//            $go = "https://pay.ir/pg/$result->token";
//            return redirect()->to($go);
//        } else {
//            alert()->error('توجه!', $result->errorMessage)->persistent('حله');
//            return redirect()->back();
//        }
    }

    public function paymentVerify(Request $request)
    {
        //for (zarrinpal) payment gateway:
        $MerchantID = 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx';


        $Authority = $request->Authority;

        $data = array('MerchantID' => $MerchantID, 'Authority' => $Authority, 'Amount' => 10000);
        $jsonData = json_encode($data);
        $ch = curl_init('https://sandbox.zarinpal.com/pg/rest/WebGate/PaymentVerification.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            if ($result['Status'] == 100) {
                echo 'Transation success. RefID:' . $result['RefID'];
            } else {
                echo 'Transation failed. Status:' . $result['Status'];
            }
        }

        //for (pay) payment gateway:
//        $api = 'test';
//        $token = $request->token;
//        $result = json_decode($this->verify($api, $token));
//        if (isset($result->status)) {
//            if ($result->status == 1) {
//                $updateOrder = $this->updateOrder($token, $result->transId);
//                if (array_key_exists('error', $updateOrder)) {
//                    alert()->error('توجه!', $updateOrder['error'])->persistent('حله');
//                    return redirect()->back();
//                }
//                \Cart::clear();
//                alert()->success( 'با تشکر', 'پرداخت با موفقیت انجام شد. شماره ی تراکنش: '.$result->transId)->persistent('حله');
//                return redirect()->route('home.index');
//            } else {
//                alert()->error( 'خطا!', 'پرداخت با خطا مواجه شد. شماره ی وضعیت: '.$result->status)->persistent('حله');
//                return redirect()->route('home.index');
//            }
//        } else {
//            if ($request->status == 0) {
//                alert()->error( 'خطا!', 'پرداخت با خطا مواجه شد. شماره ی وضعیت: '.$request->status)->persistent('حله');
//                return redirect()->route('home.index');
//            }
//        }
    }

    public function send($api, $amount, $redirect, $mobile = null, $factorNumber = null, $description = null)
    {
        return $this->curl_post('https://pay.ir/pg/send', [
            'api' => $api,
            'amount' => $amount,
            'redirect' => $redirect,
            'mobile' => $mobile,
            'factorNumber' => $factorNumber,
            'description' => $description,
        ]);
    }

    public function curl_post($url, $params)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        return $res;
    }

    public function verify($api, $token)
    {
        return $this->curl_post('https://pay.ir/pg/verify', [
            'api' => $api,
            'token' => $token,
        ]);
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

    public function createOrder($addressId, $amounts, $token, $gateway_name)
    {
        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => auth()->id(),
                'address_id' => $addressId,
                'coupon_id' => session()->has('coupon') ? session()->get('coupon.id') : null,
                'total_amount' => $amounts['total_amount'],
                'delivery_amount' => $amounts['delivery_amount'],
                'coupon_amount' => $amounts['coupon_amount'],
                'paying_amount' => $amounts['paying_amount'],
                'payment_type' => 'online',
            ]);

            foreach (\Cart::getContent() as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->associatedModel->id,
                    'product_variation_id' => $item->attributes->id,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'subtotal' => ($item->quantity * $item->price),
                ]);
            }

            Transaction::create([
                'user_id' => auth()->id(),
                'order_id' => $order->id,
                'amount' => $amounts['paying_amount'],
                'token' => $token,
                'gateway_name' => $gateway_name,
            ]);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return ['error' => $ex->getMessage()];
        }
        return ['success' => 'success!'];
    }

    public function updateOrder($token, $refId)
    {
        try {
            DB::beginTransaction();
            $transaction = Transaction::query()->where('token', $token)->firstOrFail();
            $transaction->update([
                'status' => 1,
                'ref_id' => $refId
            ]);

            $order = Order::query()->findOrFail($transaction->order_id);
            $order->update([
                'payment_status' => 1,
                'status' => 1
            ]);
            foreach (\Cart::getContent() as $item) {
                $variation = ProductVariation::query()->findOrFail($item->attributes->id);
                $variation->update([
                    'quantity' => $variation->quantity - $item->quantity
                ]);
            }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return ['error' => $ex->getMessage()];
        }
        return ['success' => 'success!'];
    }
}
