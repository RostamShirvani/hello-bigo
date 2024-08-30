<?php

namespace App\Repositories\Site;

use App\Models\User\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthRepository extends BaseSiteRepository
{
    public function isMobileExists($mobile)
    {
        return User::query()
            ->where('mobile', $mobile)
            ->exists();
    }

    public function getUserByMobile($mobile)
    {
        return User::query()
            ->where('mobile', $mobile)
            ->select([
                'id',
                'mobile',
                'password',
            ])
            ->first();
    }

    public function getUserByBigoId($bigoId)
    {
        return User::query()
            ->where('bigo_id', $bigoId)
            ->select([
                'id',
                'bigo_id',
                'password',
            ])
            ->first();
    }

    public function setUserToken($bigoId, $loginToken)
    {
        User::query()
            ->where('mobile', $bigoId)
            ->update([
                'remember_token' => $loginToken,
            ]);
    }

    public function checkUserPassword($user, $password)
    {
        return Hash::check($password, $user->password);
    }

    public function store($request)
    {
        DB::beginTransaction();

        try {

            $user = new User();
            $user->name = $request->input('name');
            $user->surname = $request->input('surname');
            $user->mobile = $request->input('mobile');
            $user->password = Hash::make(Str::random(16));
            $user->save();

            DB::commit();
            return $user;

        } catch (Exception $exception) {

            DB::rollBack();
            return null;

        }
    }
}
