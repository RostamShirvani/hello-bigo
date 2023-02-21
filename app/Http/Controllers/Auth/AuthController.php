<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handelProviderCallback($provider)
    {
        try{
        $socialite_user = Socialite::driver($provider)->user();
        }catch (\Exception $exception){
            return redirect()->route('login');
        }
        $user = User::query()->where('email', $socialite_user->getEmail())->first();
        if(!$user){
            $user = User::create([
               'name' => $socialite_user->getName(),
               'provider_name' => $provider,
               'avatar' => $socialite_user->getAvatar(),
               'email' => $socialite_user->getEmail(),
                'password' => Hash::make($socialite_user->getId()),
                'email_verified_at' => Carbon::now()
            ]);
        }
        auth()->login($user, $remember = true);
        alert()->success('تشکر', 'ورود شما موفقیت آمیز بود.')->persistent('حله');
        return redirect()->route('home.index');
    }
}
