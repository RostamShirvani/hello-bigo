<?php

namespace App\Http\Controllers\API\System;

use App\Http\Controllers\API\BaseAPIController;
use App\Repositories\API\SystemRepository;
use App\ThirdParties\BigoAPI\BigoAPI;

class SystemController extends BaseAPIController
{
    protected $systemRepository;

    public function __construct(SystemRepository $systemRepository)
    {
        $this->systemRepository = $systemRepository;
    }

    public function health()
    {
        return BigoAPI::getSystemHealth();
    }
}
