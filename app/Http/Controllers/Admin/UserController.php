<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user->update([
            "name" => $request->name,
            "cellphone" => $request->cellphone,
        ]);
        alert()->success( 'با تشکر', 'کاربر مورد نظر ویرایش شد.');
        return redirect()->route('admin.users.index');
    }
}
