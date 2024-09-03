<?php

namespace App\Http\Controllers\Site\Page;

use App\Http\Controllers\Site\BaseSiteController;
use App\Repositories\Site\PageRepository;

class PageAjaxController extends BaseSiteController
{
    protected $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }
}
