<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

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

}
