<?php

namespace App\Http\Controllers\Admin\LoginToken;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Repositories\Admin\LoginTokenRepository;

class LoginTokenController extends BaseAdminController
{
    protected $bookingRepository;

    public function __construct(LoginTokenRepository $loginTokenRepository)
    {
        $this->loginTokenRepository = $loginTokenRepository;
    }

    public function index()
    {
        $loginTokens = $this->loginTokenRepository->getLoginTokens();
        return view('admin.login_token.index', compact('loginTokens'));
    }
}
