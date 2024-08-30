<?php

namespace App\Http\Controllers\Admin\LoginToken;

use App\Enums\ELoginTokenStatus;
use App\Enums\EState;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Admin\LoginToken\StoreLoginTokenRequest;
use App\Repositories\Admin\LoginTokenRepository;
use App\ThirdParties\BigoAPI\BigoAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class LoginTokenAjaxController extends BaseAdminController
{
    protected $loginTokenRepository;

    public function __construct(LoginTokenRepository $loginTokenRepository)
    {
        $this->loginTokenRepository = $loginTokenRepository;
    }

    public function store(StoreLoginTokenRequest $request)
    {
        $bigoId = $request->input('bigo_id');
        $verificationCode = $request->input('verification_code');

        $bigoAPI = new BigoAPI($bigoId);
        $token = $bigoAPI->login($verificationCode);

        if (empty($token)) {
            return Response::json([
                'status' => false,
                'errors' => [
                    'verification_code' => [__trans('site/auth', 'wrong-otp')],
                ],
                'message' => __trans('site/auth', 'wrong-otp'),
            ], 422);
        }

        $loginToken = $this->loginTokenRepository->store($request, $token);

        return Response::json([
            'status' => true,
            'message' => [
                'title' => __trans('admin/general', 'success-operation'),
                'body' => __trans('admin/general', 'success-insert'),
            ]
        ]);
    }

    public function sync(Request $request)
    {
        $bigoId = $request->input('id');

        $loginToken = $this->loginTokenRepository->getLoginTokenByBigoId($bigoId);

        $systemHealthStatus = BigoAPI::getSystemHealth($bigoId);

        if (!empty($systemHealthStatus['status'])) {
            $loginToken = $this->loginTokenRepository->setLoginTokenAsActive($loginToken);
        } else {
            $loginToken = $this->loginTokenRepository->setLoginTokenAsDeActive($loginToken);
        }

        return Response::json([
            'status' => $loginToken->status == ELoginTokenStatus::ACTIVE,
            'synced_at' => dateTimeFormat($loginToken->synced_at),
            'message' => [
                'title' => $loginToken->status_text,
                'body' => $systemHealthStatus['message']['body'] ?? null,
            ],
        ]);
    }
}
