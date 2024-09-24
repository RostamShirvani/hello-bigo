<!-- header-------------------------------->
<header class="header-main">
    <div class="d-block">
        <section class="h-main-row">
            <div class="col-lg-9 col-md-12 col-xs-12 pr">
                <div class="header-right">
                    <div class="col-lg-3 pr">
                        <div class="header-logo row text-right">
                            <a href="/">
                                <img src="{{ asset('/assets/newsite/images/logo-300x58-1-1.png') }}"
                                     alt="{{ env('APP_NAME') }}">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 pr">
                        <div class="header-search row text-right">
                            <div class="header-search-box">
                                <form action="#" class="form-search">
                                    <input type="search" class="header-search-input" name="search-input"
                                        {{--                                    <input type="search" class="header-search-input" name="search-input"--}}
                                        {{--                                           placeholder="نام کالا، برند و یا دسته مورد نظر خود را جستجو کنید…"--}}
                                    >
                                    <div class="action-btns">
                                        <button class="btn btn-search"
                                                {{--                                                type="submit"--}}
                                                type="button"
                                        >
                                            <img src="{{ asset('/assets/newsite/images/search.png') }}" alt="search">
                                        </button>
                                        {{--                                        <div class="search-filter">--}}
                                        {{--                                            <div class="form-ui">--}}
                                        {{--                                                <div class="custom-select-ui">--}}
                                        {{--                                                    <select class="right">--}}
                                        {{--                                                        <option>همه دسته ها</option>--}}
                                        {{--                                                        <option>کالای دیجیتال</option>--}}
                                        {{--                                                        <option>آرایشی بهداشتی</option>--}}
                                        {{--                                                        <option>ابزاری اداری</option>--}}
                                        {{--                                                        <option>مد پوشاک</option>--}}
                                        {{--                                                        <option>خانه آشپز خانه</option>--}}
                                        {{--                                                        <option>لوازم تحریر و هنر</option>--}}
                                        {{--                                                        <option>کودک و نوزاد</option>--}}
                                        {{--                                                    </select>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                    </div>
                                </form>
                                {{--                                <div class="search-result">--}}
                                {{--                                    <ul class="search-result-list mb-0">--}}
                                {{--                                        <li>--}}
                                {{--                                            <a href="#"><i class="mdi mdi-clock-outline"></i>--}}
                                {{--                                                کالای دیجیتال--}}
                                {{--                                                <button class="btn btn-light btn-continue-search" type="submit">--}}
                                {{--                                                    <i class="fa fa-angle-left"></i>--}}
                                {{--                                                </button>--}}
                                {{--                                            </a>--}}
                                {{--                                        </li>--}}
                                {{--                                        <li>--}}
                                {{--                                            <a href="#"><i class="mdi mdi-clock-outline"></i>--}}
                                {{--                                                آرایشی و بهداشتی--}}
                                {{--                                                <button class="btn btn-light btn-continue-search" type="submit">--}}
                                {{--                                                    <i class="fa fa-angle-left"></i>--}}
                                {{--                                                </button>--}}
                                {{--                                            </a>--}}
                                {{--                                        </li>--}}
                                {{--                                        <li>--}}
                                {{--                                            <a href="#"><i class="mdi mdi-clock-outline"></i>--}}
                                {{--                                                گوشی موبایل--}}
                                {{--                                                <button class="btn btn-light btn-continue-search" type="submit">--}}
                                {{--                                                    <i class="fa fa-angle-left"></i>--}}
                                {{--                                                </button>--}}
                                {{--                                            </a>--}}
                                {{--                                        </li>--}}
                                {{--                                        <li>--}}
                                {{--                                            <a href="#"><i class="mdi mdi-clock-outline"></i>--}}
                                {{--                                                تبلت--}}
                                {{--                                                <button class="btn btn-light btn-continue-search" type="submit">--}}
                                {{--                                                    <i class="fa fa-angle-left"></i>--}}
                                {{--                                                </button>--}}
                                {{--                                            </a>--}}
                                {{--                                        </li>--}}
                                {{--                                        <li>--}}
                                {{--                                            <a href="#"><i class="mdi mdi-clock-outline"></i>--}}
                                {{--                                                لپ تاپ--}}
                                {{--                                                <button class="btn btn-light btn-continue-search" type="submit">--}}
                                {{--                                                    <i class="fa fa-angle-left"></i>--}}
                                {{--                                                </button>--}}
                                {{--                                            </a>--}}
                                {{--                                        </li>--}}
                                {{--                                        <li>--}}
                                {{--                                            <a href="#"><i class="mdi mdi-clock-outline"></i>--}}
                                {{--                                                دوربین--}}
                                {{--                                                <button class="btn btn-light btn-continue-search" type="submit">--}}
                                {{--                                                    <i class="fa fa-angle-left"></i>--}}
                                {{--                                                </button>--}}
                                {{--                                            </a>--}}
                                {{--                                        </li>--}}
                                {{--                                    </ul>--}}
                                {{--                                    <div class="localSearchSimple"></div>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-0 col-xs-12 pl">
                <div class="header-left">
                    <div class="header-account text-left">
                        <div class="d-block">
                            <div class="account-box">
                                <div class="nav-account d-block pl">
                                            <span class="icon-account">
                                            <img src="{{ asset('/assets/newsite/images/man.png') }}" class="avator">
                                        </span>
                                    <span class="title-account">
                                        @auth()
                                            {{ auth()->user()->name }} {{ auth()->user()->family }}
                                        @else
                                            ورود/عضویت
                                        @endauth
                                    </span>
                                    <div class="dropdown-menu">
                                        <ul class="account-uls mb-0">
                                            @auth()
                                                @if(auth()->user()->hasRole('super_admin'))
                                                    <li class="account-item">
                                                        <a href="{{route('dashboard')}}" class="account-link">پنل
                                                            مدیریت</a>
                                                    </li>
                                                @endif
                                                <li class="account-item">
                                                    <a href="{{route('home.users_profile.index')}}"
                                                       class="account-link">پروفایل</a>
                                                </li>
                                                <li class="account-item">
                                                    <a href="{{route('home.users_profile.orders')}}"
                                                       class="account-link">سفارشات من</a>
                                                </li>
                                                <form action="{{route('logout')}}" method="post" id="logout">
                                                    @csrf
                                                    <li class="account-item">
                                                        <a href=""
                                                           onclick="event.preventDefault(); document.getElementById('logout').submit();"
                                                           class="account-link">خروج</a>
                                                    </li>
                                                </form>
                                            @else
                                                <li class="account-item">
                                                    <a class="account-link" href="{{ route('login') }}">ورود/عضویت</a>
                                                </li>
                                            @endauth
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <nav class="header-main-nav">
            <div class="d-block">
                <div class="align-items-center">
                    <ul class="menu-ul mega-menu-level-one">
                        @php
                            $parentCategories = \App\Models\Category::query()->where('parent_id', 0)->get();
                        @endphp
                        <li id="nav-menu-item" class="menu-item nav-overlay">
                            <a href="#" class="current-link-menu">
                                <img src="{{ asset('/assets/newsite/images/menu-main/category/smartphone.png') }}"
                                     alt="menu" width="22px">
                                محصولات فروشگاه
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="sub-menu is-mega-menu mega-menu-level-two">
                                @foreach($parentCategories as $parentCategory)
                                    <li class="menu-mega-item menu-item-type-mega-menu">
                                        {{--                                        <a href="/" class="mega-menu-link">--}}
                                        {{--                                            {{ $parentCategory->name }}--}}
                                        {{--                                        </a>--}}
                                        @if($parentCategory->children->count() > 0)
                                            <ul class="sub-menu mega-menu-level-three">
                                                @foreach($parentCategory->children as $childCategory)
                                                    <li class="menu-mega-item-three">
                                                        <a href="{{ route('home.categories.show', $childCategory->slug) }}">
                                                            {{ $childCategory->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                                {{--                                <li class="bg-image">--}}
                                {{--                                    <img src="{{ asset('/assets/newsite/images/menu-main/digital.png') }}" alt="">--}}
                                {{--                                </li>--}}
                            </ul>
                        </li>
                        <li class="divider-space-card">
                            <div class="header-cart-basket">
                                <a href="#" class="cart-basket-box">
                                        <span class="icon-cart">
                                            <i class="mdi mdi-shopping"></i>
                                        </span>
                                    <span class="title-cart">سبد خرید</span>
                                    <span class="price-cart">
                                        {{number_format(\Cart::getTotal())}} تومان
                                    </span>
                                    <span class="count-cart">{{ count(\Cart::getContent()) }}</span>
                                </a>
                                <div class="widget-shopping-cart">
                                    <div class="widget-shopping-cart-content">
                                        <div class="wrapper">
                                            <div class="scrollbar" id="style-1">
                                                <div class="force-overflow">
                                                    <ul class="product-list-widget">
                                                        @foreach(\Cart::getContent() as $item)
                                                            <li class="mini-cart-item">
                                                                <div class="mini-cart-item-content">
                                                                    <a href="{{route('home.cart.remove', $item->id)}}"
                                                                       class="mini-cart-item-close">
                                                                        <i class="mdi mdi-close"></i>
                                                                    </a>
                                                                    <a href="{{route('home.products.show', $item->associatedModel->slug)}}"
                                                                       class="mini-cart-item-image d-block">
                                                                        <img
                                                                            src="{{asset(env('PRODUCT_IMAGES_UPLOAD_PATH').$item->associatedModel->primary_image)}}">
                                                                    </a>
                                                                    <span
                                                                        class="product-name-card">{{$item->name}}</span>
                                                                    <div class="variation">
                                                                        {{--                                                                        <span class="variation-n">فروشنده :--}}
                                                                        {{--                                                                        </span>--}}
                                                                        {{--                                                                        <span class="variation-n">{{$item->quantity}} x {{number_format($item->price)}}</span>--}}
                                                                        <p class="mb-0">
                                                                            {{\App\Models\Attribute::find($item->attributes->attribute_id)->name}}
                                                                            :
                                                                            {{$item->attributes->value}}</p>
                                                                    </div>
                                                                    {{--                                                                    <div class="header-basket-list-item-color-badge">--}}
                                                                    {{--                                                                        رنگ:--}}
                                                                    {{--                                                                        <span style="background: #000"></span>--}}
                                                                    {{--                                                                    </div>--}}
                                                                    <div class="quantity">
                                                                        <span class="quantity-Price-amount">
{{--                                                                            {{$item->quantity}} x {{number_format($item->price)}}--}}
                                                                            {{number_format($item->price)}}
                                                                            <span>تومان</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                        {{--                                                        <li class="mini-cart-item">--}}
                                                        {{--                                                            <div class="mini-cart-item-content">--}}
                                                        {{--                                                                <a href="#" class="mini-cart-item-close">--}}
                                                        {{--                                                                    <i class="mdi mdi-close"></i>--}}
                                                        {{--                                                                </a>--}}
                                                        {{--                                                                <a href="#" class="mini-cart-item-image d-block">--}}
                                                        {{--                                                                    <img--}}
                                                        {{--                                                                        src="assets/images/menu-main/img-card-2.jpg">--}}
                                                        {{--                                                                </a>--}}
                                                        {{--                                                                <span class="product-name-card">هواوای میت--}}
                                                        {{--                                                                        بوک X پرو--}}
                                                        {{--                                                                        13.9 اینچ</span>--}}
                                                        {{--                                                                <div class="variation">--}}
                                                        {{--                                                                        <span class="variation-n">فروشنده :--}}
                                                        {{--                                                                        </span>--}}
                                                        {{--                                                                    <p class="mb-0">کالامارکت </p>--}}
                                                        {{--                                                                </div>--}}
                                                        {{--                                                                <div class="header-basket-list-item-color-badge">--}}
                                                        {{--                                                                    رنگ:--}}
                                                        {{--                                                                    <span style="background: #ccc"></span>--}}
                                                        {{--                                                                </div>--}}
                                                        {{--                                                                <div class="quantity">--}}
                                                        {{--                                                                        <span class="quantity-Price-amount">--}}
                                                        {{--                                                                            10,000,000--}}
                                                        {{--                                                                            <span>تومان</span>--}}
                                                        {{--                                                                        </span>--}}
                                                        {{--                                                                </div>--}}
                                                        {{--                                                            </div>--}}
                                                        {{--                                                        </li>--}}
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mini-card-total">
                                            <strong>قیمت کل : </strong>
                                            <span class="price-total"> {{number_format(\Cart::getTotal())}}
                                                    <span>تومان</span>
                                                </span>
                                        </div>
                                        <div class="mini-card-button">
                                            <a href="{{route('home.cart.index')}}" class="view-card">مشاهده سبد خرید</a>
                                            <a href="{{route('home.orders.checkout')}}" class="card-checkout">تسویه
                                                حساب</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--                            <div class="header-cart-interest">--}}
                            {{--                                <a href="#" class="d-block">--}}
                            {{--                                    <i class="fa fa-heart"></i>--}}
                            {{--                                    <span class="counter">۲</span>--}}
                            {{--                                </a>--}}
                            {{--                            </div>--}}
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
        <!--    responsive-megamenu-mobile----------------->
        <nav class="sidebar">
            <div class="nav-header">
                <div class="header-cover"></div>
                <div class="logo-wrap">
                    <a class="logo-icon" href="#"><img alt="logo-icon"
                                                       src="{{ asset('/assets/newsite/images/logo-300x58-1-1.png') }}"
                                                       width="40"></a>
                </div>
            </div>
            <ul class="nav-categories ul-base">
                @foreach($parentCategories as $parentCategory)
                    @if($parentCategory->children->count() > 0)
                        @foreach($parentCategory->children as $childCategory)
                            <li><a href="{{ route('home.categories.show', $childCategory->slug) }}">
                                    {{ $childCategory->name }}
                                </a>
                            </li>
                        @endforeach
                    @endif
                @endforeach

            </ul>
        </nav>
        <div class="nav-btn nav-slider">
            <span class="linee1"></span>
            <span class="linee2"></span>
            <span class="linee3"></span>
        </div>
        <div class="overlay"></div>
        <!-- bottom-menu-joomy -->
        <div class="bottom-menu-joomy">
            <ul class="mb-0">
                <li>
                    <a href="/">
                        <i class="mdi mdi-home"></i>
                        صفحه اصلی
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="nav-btn nav-slider">
                            <i class="mdi mdi-menu" aria-hidden="true"></i>
                        </div>
                        دسته بندی ها
                    </a>
                </li>
                <li>
                    <a href="{{route('home.cart.index')}}">
                        <i class="mdi mdi-cart"></i>
                        سبد خرید
                        <div class="shopping-bag-item">{{ count(\Cart::getContent()) }}</div>
                    </a>
                </li>
                {{--                <li>--}}
                {{--                    <a href="#" data-toggle="modal" data-target="#exampleModalCenter">--}}
                {{--                        <i class="mdi mdi-magnify"></i>--}}
                {{--                        جستجو--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                <li>
                    <a href="{{ route('home.users_profile.index') }}">
                        <i class="mdi mdi-account"></i>
                        حساب کاربری
                    </a>
                </li>
            </ul>
        </div>
        <!--    responsive-megamenu-mobile----------------->
    </div>
</header>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">جستجو</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="header-search text-right">
                    <div class="header-search-box">
                        <form action="#" class="form-search">
                            <input type="search" class="header-search-input" name="search-input"
                                   placeholder="نام کالا، برند و یا دسته مورد نظر خود را جستجو کنید…">
                            <div class="action-btns">
                                <button class="btn btn-search" type="submit">
                                    <img src="{{ asset('/assets/newsite/images/search.png') }}" alt="search">
                                </button>
                                {{--                                <div class="search-filter">--}}
                                {{--                                    <div class="form-ui">--}}
                                {{--                                        <div class="custom-select-ui">--}}
                                {{--                                            <select class="right">--}}
                                {{--                                                <option>همه دسته ها</option>--}}
                                {{--                                                <option>کالای دیجیتال</option>--}}
                                {{--                                                <option>آرایشی بهداشتی</option>--}}
                                {{--                                                <option>ابزاری اداری</option>--}}
                                {{--                                                <option>مد پوشاک</option>--}}
                                {{--                                                <option>خانه آشپز خانه</option>--}}
                                {{--                                                <option>لوازم تحریر و هنر</option>--}}
                                {{--                                                <option>کودک و نوزاد</option>--}}
                                {{--                                            </select>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                            </div>
                        </form>
                        <div class="search-result">
                            <ul class="search-result-list mb-0">
                                <li>
                                    <a href="#"><i class="mdi mdi-clock-outline"></i>
                                        کالای دیجیتال
                                        <button class="btn btn-light btn-continue-search" type="submit">
                                            <i class="fa fa-angle-left"></i>
                                        </button>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><i class="mdi mdi-clock-outline"></i>
                                        آرایشی و بهداشتی
                                        <button class="btn btn-light btn-continue-search" type="submit">
                                            <i class="fa fa-angle-left"></i>
                                        </button>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><i class="mdi mdi-clock-outline"></i>
                                        گوشی موبایل
                                        <button class="btn btn-light btn-continue-search" type="submit">
                                            <i class="fa fa-angle-left"></i>
                                        </button>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><i class="mdi mdi-clock-outline"></i>
                                        تبلت
                                        <button class="btn btn-light btn-continue-search" type="submit">
                                            <i class="fa fa-angle-left"></i>
                                        </button>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><i class="mdi mdi-clock-outline"></i>
                                        لپ تاپ
                                        <button class="btn btn-light btn-continue-search" type="submit">
                                            <i class="fa fa-angle-left"></i>
                                        </button>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><i class="mdi mdi-clock-outline"></i>
                                        دوربین
                                        <button class="btn btn-light btn-continue-search" type="submit">
                                            <i class="fa fa-angle-left"></i>
                                        </button>
                                    </a>
                                </li>
                            </ul>
                            <div class="localSearchSimple"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="nav-categories-overlay"></div>
<div class="overlay-search-box"></div>
<!-- header-------------------------------->
