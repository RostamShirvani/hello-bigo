<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
//            'user_id' => 'required|exists:users,id',
//            'address_id' => 'required|exists:user_addresses,id',
            'coupon_id' => 'nullable|exists:coupons,id',
            'status' => 'required|integer',
            'total_amount' => 'required|integer',
            'delivery_amount' => 'nullable|integer',
            'coupon_amount' => 'nullable|integer',
            'paying_amount' => 'required|integer',
            'payment_type' => 'required|in:pos,cash,shabaNumber,cardToCart,online',
            'payment_status' => 'required|integer',
            'description' => 'nullable|string',
            'status_description' => 'nullable|string',  // Add validation for status_description
        ]);

        if($order->update($validatedData)){
            alert()->success('عملیات موفق', 'سفارش با موفقیت به روز رسانی شد.');
            return redirect()->route('admin.orders.index');
        }

        alert()->error('عملیات ناموفق!', 'عملیات با خطا مواجه شد!');
        return redirect()->route('admin.orders.index');
    }
}
