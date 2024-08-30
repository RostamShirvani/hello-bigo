<?php

namespace App\Repositories\Admin;

use App\Enums\ELoginTokenStatus;
use App\Enums\ELoginTokenType;
use App\Enums\EState;
use App\Models\LoginToken\LoginToken;
use Illuminate\Support\Facades\Auth;

class LoginTokenRepository extends BaseAdminRepository
{
    public function __construct(LoginToken $model)
    {
        $this->setModel($model);
    }

    public function getLoginTokens()
    {
        return LoginToken::query()
            ->orderBy('id', 'desc')
            ->get();
    }

    public function store($request, $token)
    {
        $loginToken = LoginToken::query()
            ->where('bigo_id', $request->input('bigo_id'))
            ->first();

        if (!$loginToken) {
            $loginToken = new LoginToken();
            $loginToken->created_by = Auth::id();
        } else {
            $loginToken->updated_by = Auth::id();
        }

        $loginToken->bigo_id = $request->input('bigo_id');
        $loginToken->token = $token;
        $loginToken->type = ELoginTokenType::BIGO_LIVE;
        $loginToken->status = ELoginTokenStatus::ACTIVE;
        $loginToken->state = EState::ENABLED;
        $loginToken->save();

        return $loginToken;
    }

    public function getLoginTokenByBigoId($bigoId)
    {
        return LoginToken::query()
            ->where('bigo_id', $bigoId)
            ->first();
    }

    public function setLoginTokenAsDeActive($loginToken)
    {
        $loginToken->status = ELoginTokenStatus::DE_ACTIVE;
        $loginToken->synced_at = now();
        $loginToken->save();

        return $loginToken;
    }

    public function setLoginTokenAsActive($loginToken)
    {
        $loginToken->status = ELoginTokenStatus::ACTIVE;
        $loginToken->synced_at = now();
        $loginToken->save();

        return $loginToken;
    }
}
