<?php

namespace App\Http\Controllers\Site\Home;

use App\Http\Controllers\Site\BaseSiteController;
use App\Models\PaymentPin\PaymentPin;
use App\Repositories\Site\HomeRepository;

class HomeController extends BaseSiteController
{
    protected $homeRepository;

    public function __construct(HomeRepository $homeRepository)
    {
        $this->homeRepository = $homeRepository;
    }

    public function index()
    {
        $slides = $this->homeRepository->getSlides();

        PaymentPin::query()->where('amount', 1)->update(['likee_value' => 38]);
        

        return view('site.home.index', compact('slides'));
    }
}
