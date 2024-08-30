<header
    class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 no-select">
    <a href="/"
       class="header-logo-element d-flex align-items-center col-md-2 mb-2 mb-md-0 text-dark text-decoration-none">
    </a>

    <button class="btn btn-toggle" type="button">
        <i class="bi bi-list"></i>
        <i class="bi bi-person"></i>
    </button>

    <div class="mobile-menu-overlay"></div>
    <div class="mobile-menu">
        <div class="mobile-menu-header">
            <div class="auth-sync">
                <div class="user-image">
                    <i class="bi bi-person"></i>
                </div>
                <div class="user-name">
                    @if(auth()->check())
                        {{ auth()->user()->fullname }}
                    @else
                        {{ __trans('site/auth', 'you-are-not-logged-in') }}
                    @endif
                </div>
                <div class="mobile-menu-buttons">
                    <button type="button" class="btn btn-outline-secondary btn-has-loader btn-logout">
                        <i class="bi bi-back"></i>
                        {{ __trans('site/auth', 'logout-from-account') }}
                    </button>
                    <button type="button" class="btn btn-outline-secondary btn-has-loader open-auth-modal">
                        <i class="bi bi-back"></i>
                        {{ __trans('site/auth', 'login-to-account') }}
                    </button>
                </div>
            </div>
        </div>

        @if(!empty($mobileMenuItems))
            <ul class="mobile-menu-items">
                @foreach($mobileMenuItems as $mobileMenuItem)
                    <li class="mobile-menu-item {{ $mobileMenuItem['class'] ?: '' }}">
                        <a href="{{ $mobileMenuItem['link'] }}">
                            {!! $mobileMenuItem['icon'] !!}
                            {{ $mobileMenuItem['text'] }}
                        </a>
                        @if(!empty($mobileMenuItem['badge']))
                            <div class="badge-container">
                                <span class="badge rounded-pill bg-danger">{{ $mobileMenuItem['badge'] }}</span>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="col-md-12 text-end auth-sync hide-on-mobile">
        <div class="user">
            @if(auth()->check())
                @if(auth()->user()->hasRole(['super_admin', 'admin']))
                    <div class="d-inline-block mx-2">
                        <a href="{{ route('admin.payment-pins.index') }}" style="text-decoration: none; color: black">
                            <i class="bi bi-journal-check"></i>
                            پین ها
                        </a>
                    </div>
                    <div class="d-inline-block mx-2">
                        <a href="{{ route('admin.payment-pins.using', ['app_type' => \App\Enums\EAppType::BIGO_LIVE]) }}"
                           style="text-decoration: none; color: black">
                            <i class="bi bi-lightning-charge"></i>
                            شارژ سریع بیگو
                        </a>
                    </div>
                    <div class="d-inline-block mx-2">
                        <a href="{{ route('admin.payment-pins.using', ['app_type' => \App\Enums\EAppType::LIKEE]) }}"
                           style="text-decoration: none; color: black">
                            <i class="bi bi-lightning-charge"></i>
                            شارژ سریع لایکی
                        </a>
                    </div>
                    <div class="d-inline-block mx-2">
                        <a href="{{ route('admin.login-tokens.index') }}"
                           style="text-decoration: none; color: black">
                            <i class="bi bi-key"></i>
                            توکن ها
                        </a>
                    </div>
                    <div class="d-inline-block mx-2">
                        <a href="{{ route('admin.blacklist.index') }}"
                           style="text-decoration: none; color: black">
                            <i class="bi bi-gear"></i>
                            بلک لیست
                        </a>
                        <div class="d-inline-block mx-2">
                            <a href="{{ route('admin.gift_charge.index') }}"
                               style="text-decoration: none; color: black">
                                <i class="bi bi-lightning-charge"></i>
                                اکانت ها
                            </a>
                        </div>
                    </div>
                @endif
            @endif
            <div class="user-image">
                <i class="bi bi-person"></i>
            </div>
            <div class="user-name"> {{ auth()->check() ? auth()->user()->fullname : '' }}</div>
            <button class="btn btn-sm btn-logout">خروج</button>
        </div>
        <button class="btn btn-outline-dark btn-has-loader open-auth-modal">
            <div class="title">
                <i class="bi bi-person"></i>
                ورود
            </div>
        </button>
    </div>
</header>
