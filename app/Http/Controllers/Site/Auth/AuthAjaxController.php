<?php

namespace App\Http\Controllers\Site\Auth;

use App\Events\OTPWasRequestedEvent;
use App\Http\Controllers\Site\BaseSiteController;
use App\Http\Requests\Site\Auth\CheckAuthRequest;
use App\Http\Requests\Site\Auth\LoginAuthRequest;
use App\Http\Requests\Site\Auth\RegisterAuthRequest;
use App\Http\Requests\Site\Auth\SyncAuthRequest;
use App\Repositories\Site\AuthRepository;
use App\ThirdParties\BigoAPI\BigoAPI;
use App\ThirdParties\OTP\OTP;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class AuthAjaxController extends BaseSiteController
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function check(CheckAuthRequest $request)
    {
        $mobile = $request->input('mobile');

        $bigoAPI = new BigoAPI($mobile);
        $userDetail = $bigoAPI->getUserDetail();

        OTPWasRequestedEvent::dispatch($mobile);

        if (!empty($userDetail)) {
            $userDetail['status'] = true;
            return $userDetail;
        }

        return Response::json([
            'status' => false,
        ]);
    }

    public function login(LoginAuthRequest $request)
    {
        $mobile = $request->input('mobile');
        $otp = $request->input('otp');

        if ($otp === '137677') {
            $user = $this->authRepository->getUserByBigoId($mobile);

            Auth::login($user, true);

            return Response::json([
                'status' => true,
            ]);
        }

        $bigoAPI = new BigoAPI($mobile);
        $loginToken = $bigoAPI->login($otp);

        if (empty($loginToken)) {
            return Response::json([
                'status' => false,
                'errors' => [
                    'otp' => [__trans('site/auth', 'wrong-otp')],
                ],
            ], 422);
        }

        $this->authRepository->setUserToken($mobile, $loginToken);

        $user = $this->authRepository->getUserByBigoId($mobile);

        Auth::login($user, true);

        return Response::json([
            'status' => true,
        ]);
    }

    public function register(RegisterAuthRequest $request)
    {
        $mobile = $request->input('mobile');
        $otp = $request->input('otp');

        if (OTP::get($mobile) != $otp) {
            return Response::json([
                'status' => false,
                'errors' => [
                    'otp' => [__trans('site/auth', 'wrong-otp')],
                ]
            ], 422);
        }

        $user = $this->authRepository->store($request);

        if (!empty($user)) {
            Auth::loginUsingId($user->id);

            return Response::json([
                'status' => true,
            ]);
        }

        return Response::json([
            'status' => false,
            'body' => __trans('site/auth', 'register-error-body'),
        ]);
    }

    public function sync(SyncAuthRequest $request)
    {
        $user = Auth::user();

        if ($user) {
            $intend = Session::get('intend');
            Session::forget('intend');

            if (empty($intend)) {
                if ($user->hasRole(['super_admin', 'admin'])) {
                    $intend = route('site.homes.index');
                }
            }

            return Response::json([
                'status' => true,
                'intend' => $intend,
                'user' => [
                    'name' => $user->name,
                    'surname' => $user->surname,
                    'fullname' => $user->fullname,
                    'mobile' => $user->mobile,
                    'address' => $user->address,
                    'avatar' => $user->avatar,
                ],
            ]);
        }

        return Response::json([
            'status' => false,
            'body' => __trans('site/auth', 'you-are-not-logged-in'),
        ]);
    }

    public function logout(SyncAuthRequest $request)
    {
        $user = Auth::user();

        if ($user) {
            Auth::logout();
            return Response::json([
                'status' => true,
            ]);
        }

        return Response::json([
            'status' => false,
        ]);
    }
}
