<?php

namespace App\Http\Controllers\Site\Auth;

use App\Http\Controllers\Site\BaseSiteController;
use App\Repositories\Site\AuthRepository;

class AuthController extends BaseSiteController
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }
}
