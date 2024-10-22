<header class="main-header">
    <div class="container">
        <div class="header-row">
            <!-- User Icon (Left) -->
            <a href="{{ route('home.users_profile.index') }}" class="header-icon user-icon">
                <i class="mdi mdi-account"></i>
            </a>
            <!-- Logo (Center) -->
            <div class="header-logo">
                <a href="/">
                    <img src="{{ asset('/assets/newsite/images/logo-300x58-1-1.png') }}"
                         alt="{{ env('APP_NAME') }}" class="logo-img">
                </a>
            </div>

            <!-- Cart Icon (Right) -->
            <a href="{{ route('home.cart.index') }}" class="header-icon cart-icon">
                <i class="mdi mdi-cart"></i>
                <span class="cart-count">{{ count(\Cart::getContent()) }}</span> <!-- نمایش تعداد محصولات -->
            </a>
        </div>
    </div>
</header>
