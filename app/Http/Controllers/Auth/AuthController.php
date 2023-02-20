<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
    }
}
