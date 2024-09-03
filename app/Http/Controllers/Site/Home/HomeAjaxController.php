<?php

namespace App\Http\Controllers\Site\Home;

use App\Http\Controllers\Site\BaseSiteController;
use App\Repositories\Site\HomeRepository;

class HomeAjaxController extends BaseSiteController
{
    protected $homeRepository;

    public function __construct(HomeRepository $homeRepository)
    {
        $this->homeRepository = $homeRepository;
    }
}
