<?php

namespace App\PaymentGateway;

use App\Http\Controllers\Admin\PaymentPin\PaymentPinController;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentPin\PaymentPin;
use App\Models\ProductVariation;
use App\Models\Transaction;
use App\Notifications\PaymentReceiptNotification;
use App\Repositories\Admin\PaymentPinRepository;
use Illuminate\Support\Facades\DB;

class Payment
{

    public function createOrder($addressId, $amounts, $token, $gateway_name)
    {
        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => auth()->id(),
                'address_id' => $addressId,
                'coupon_id' => session()->has('coupon') ? session()->get('coupon.id') : null,
                'total_amount' => (int)$amounts['total_amount'],
                'delivery_amount' => (int)$amounts['delivery_amount'],
                'coupon_amount' => (int)$amounts['coupon_amount'],
                'paying_amount' => (int)$amounts['paying_amount'],
                'payment_type' => 'online',
            ]);

            session_start();
            foreach (\Cart::getContent() as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->associatedModel->id,
                    'product_variation_id' => $item->attributes->id,
                    'price' => (int)$item->price,
                    'account_id' => $_SESSION['cart'][$item->id]['account_id'] ?? null,
                    'account_username' => $_SESSION['cart'][$item->id]['account_username'] ?? null,
                    'account_name' => $_SESSION['cart'][$item->id]['account_name'] ?? null,
                    'account_avatar_url' => $_SESSION['cart'][$item->id]['account_avatar_url'] ?? null,
                    'quantity' => (int)$item->quantity,
                    'subtotal' => (int)($item->quantity * $item->price),
                ]);
            }

            Transaction::create([
                'user_id' => auth()->id(),
                'order_id' => $order->id,
                'amount' => (int)$amounts['paying_amount'],
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

            // Do charge account
            $model = new PaymentPin();
            $paymentPinRepository = new PaymentPinRepository($model);
            $paymentPin = new PaymentPinController($paymentPinRepository);
            foreach ($order->orderItems as $orderItem) {
                $paymentPin->storeUsingAfterPay($orderItem);
            }

            foreach (\Cart::getContent() as $item) {
                $variation = ProductVariation::query()->findOrFail($item->attributes->id);
                $variation->update([
                    'quantity' => PaymentPin::getActivePaymentPinsCountByValue($variation->value,$variation->product->app_type)
//                    'quantity' => $variation->quantity - $item->quantity
                ]);
            }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return ['error' => $ex->getMessage()];
        }
        auth()->user()->notify(new PaymentReceiptNotification($order->id, $order->paying_amount, $refId));
        return ['success' => 'success!'];
    }
}
