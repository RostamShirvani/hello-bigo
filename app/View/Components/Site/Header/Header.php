<?php

namespace App\View\Components\Site\Header;

use App\Enums\EAppType;
use App\View\Components\Site\SiteBaseComponent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Header extends SiteBaseComponent
{
    public $componentId;
    public $socialNetworks;
    public $mobileMenuItems;

    public function __construct()
    {
        $this->componentId = Str::random(8);
        $this->socialNetworks = [
        ];

        $this->mobileMenuItems = [

        ];

        $this->mobileMenuItems = array_merge($this->socialNetworks, $this->mobileMenuItems);

        if (Auth::check()) {
            $user = Auth::user();
            if ($user->hasRole(['super_admin', 'admin'])) {
                $this->mobileMenuItems[] = [
                    'class' => null,
                    'icon' => '<i class="bi bi-journal-check"></i>',
                    'text' => 'پین ها',
                    'link' => route('admin.payment-pins.index'),
                ];
                $this->mobileMenuItems[] = [
                    'class' => null,
                    'icon' => '<i class="bi bi-lightning-charge"></i>',
                    'text' => 'شارژ سریع بیگو',
                    'link' => route('admin.payment-pins.using', ['app_type' => EAppType::BIGO_LIVE]),
                ];
                $this->mobileMenuItems[] = [
                    'class' => null,
                    'icon' => '<i class="bi bi-lightning-charge"></i>',
                    'text' => 'شارژ سریع لایکی',
                    'link' => route('admin.payment-pins.using', ['app_type' => EAppType::LIKEE]),
                ];
                $this->mobileMenuItems[] = [
                    'class' => null,
                    'icon' => '<i class="bi bi-key"></i>',
                    'text' => 'توکن ها',
                    'link' => route('admin.login-tokens.index'),
                ];
                $this->mobileMenuItems[] = [
                    'class' => null,
                    'icon' => '<i class="bi bi-gear"></i>',
                    'text' => 'تنظیمات',
                    'link' => route('admin.settings.index'),
                ];
            }
        }
    }

    public function render()
    {
        return view($this->getViewName('header', 'default'));
    }
}
