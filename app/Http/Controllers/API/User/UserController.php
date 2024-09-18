<?php

namespace App\Http\Controllers\API\User;

use App\Enums\EAppType;
use App\Http\Controllers\API\BaseAPIController;
use App\Http\Requests\API\User\GetUserDetailRequest;
use App\Repositories\API\UserRepository;
use App\ThirdParties\BigoAPI\BigoAPI;
use App\ThirdParties\LikeeAPI\LikeeAPI;
use Illuminate\Support\Facades\Response;

class UserController extends BaseAPIController
{
    protected $userPinRepository;

    public function __construct(UserRepository $userPinRepository)
    {
        $this->userPinRepository = $userPinRepository;
    }

    public function getUserDetail(GetUserDetailRequest $request)
    {
        $bigo_id = $request->input('bigo_id');

        // Convert Persian numbers to English numbers
        $bigo_id_converted = convertPersianNumbers($bigo_id);

        // Continue using the $bigo_id_converted
        $request->merge(['bigo_id' => $bigo_id_converted]);

        $accountId = $request->input('bigo_id');

        $appType = $request->input('app_type') ?? EAppType::BIGO_LIVE;
        $clientAPI = null;

        if ($appType == EAppType::BIGO_LIVE) {
            $clientAPI = new BigoAPI($accountId);
        } elseif ($appType == EAppType::LIKEE) {
            $clientAPI = new LikeeAPI($accountId);
        }

        if (!$clientAPI) {
            return Response::json([
                'status' => false,
                'message' => 'no client api'
            ], 422);
        }

        $userDetail = $clientAPI->getUserDetail();

        if (!empty($userDetail)) {
            $userDetail['status'] = true;

            if ($appType == EAppType::BIGO_LIVE && !empty($request->input('send_verification_code'))) {
                $clientAPI->sendVerificationCode();
            }

            return Response::json($userDetail);
        }

        return Response::json([
            'status' => false,
            'message' => 'empty detail'
        ], 422);
    }
}
