<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\OTPSmsNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->method() == 'GET') {
            return view('auth.login');
        }
        $request->validate([
            'cellphone' => 'required|iran_mobile'
        ]);

        try {
            $user = User::query()->where('cellphone', $request->cellphone)->first();
            $OTPCode = mt_rand(100000, 999999);
            $loginToken = Hash::make(Str::random());
            if ($user) {
                $user->update([
                    'otp' => $OTPCode,
                    'login_token' => $loginToken
                ]);
            } else {
                $user = User::create([
                    'cellphone' => $request->cellphone,
                    'otp' => $OTPCode,
                    'login_token' => $loginToken
                ]);
            }
            $user->notify(new OTPSmsNotification($OTPCode));
            return response(['login_token' => $loginToken], 200);
        } catch (\Exception $exception) {
            return response(['errors' => $exception->getMessage()], 422);
        }
    }

    public function checkOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
            'login_token' => 'required'
        ]);
        try {
            $user = User::query()->where('login_token', $request->login_token)->firstOrFail();
            if ($user->otp == $request->otp) {
                auth()->login($user, $remember = true);
                return response(['ورود با موفقیت انجام شد.'], 200);
            } else {
                return response(['errors' => ['otp' => ['کد تأییدیه نادرست است!']]], 422);
            }
        } catch (\Exception $exception) {
            return response(['errors' => $exception->getMessage()], 422);
        }
    }
}
