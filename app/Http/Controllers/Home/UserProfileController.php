<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function index()
    {
        return view('home.users_profile.index');
    }

    public function usersProfileIndex()
    {
        $orders = Order::query()
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc') // Sort by created_at in descending order
            ->paginate(10); // Paginate by 10 records per page

        return view('home.users_profile.orders', compact('orders'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'family' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->family = $request->input('family');
        $user->save();

//        alert()->success('عملیات موفق', 'پروفایل با موفقیت به روز رسانی شد.');
        return redirect()->back()->with('success', 'پروفایل با موفقیت به روز رسانی شد.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->password = Hash::make($request->input('new_password'));
        $user->save();

//        alert()->success('عملیات موفق', 'پسورد با موفقیت تغییر یافت');
        return redirect()->back()->with('success', 'پسورد با موفقیت تغییر یافت.');
    }

    public function fallback(Order $order)
    {
        // Retrieve the cart content
        $cartContent = \Cart::getContent();
        $cartContentTotal = \Cart::getTotal();

        // Clear the cart after storing its content
        \Cart::clear();

        // Pass both the order and the cart content to the view
        return view('home.users_profile.fallback', compact('order', 'cartContent', 'cartContentTotal'));
    }

}
