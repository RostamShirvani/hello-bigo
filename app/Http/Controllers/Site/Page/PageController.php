<?php

namespace App\Http\Controllers\Site\Page;

use App\Http\Controllers\Site\BaseSiteController;
use App\Repositories\Site\PageRepository;

class PageController extends BaseSiteController
{
    protected $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function show($slug)
    {
        $page = $this->pageRepository->getPage($slug);

        return view('site.page.show', compact('page'));
    }
}
