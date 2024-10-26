@extends('home.layouts.home')

@section('title')
    فروشگاه - {{$category->name}}
@endsection
@section('content')
    <!-- arshive-product----------------------->
    <div class="container-main">
        <div class="d-block">
            <div class="page-content page-row">
                <div class="main-row">
                    <div id="breadcrumb">
                        <i class="mdi mdi-home"></i>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">خانه</a></li>
                                <li class="breadcrumb-item active" aria-current="page">آرشیو محصولات</li>
                            </ol>
                        </nav>
                    </div>

                    <!-- start sidebar--------------------->
                    <div class="col-lg-3 col-md-3 col-xs-12 pr sticky-sidebar">
                        <div class="shop-archive-sidebar">
                            <div class="sidebar-archive mb-3">
                                <section class="widget-product-categories">
                                    <header class="cat-header">
                                        <h2 class="mb-0">
                                            <button class="btn btn-block text-right" data-toggle="collapse"
                                                    href="#headingOne" role="button" aria-expanded="false"
                                                    aria-controls="headingOne">
                                                دسته بندی
                                                <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                        </h2>
                                    </header>
                                    <div class="product-filter">
                                        <div class="card">
                                            <div class="collapse show" id="headingOne">
                                                <div class="card-main mb-0">
                                                    {{ $category->parent->name }}
                                                    @foreach($category->parent->children as $childCategory)
                                                        <a href="{{route('home.categories.show', $childCategory->slug)}}"
                                                           style="{{$category->slug == $childCategory->slug ? 'color: #ff3535' : ''}}"
                                                        >
                                                            <div class="form-auth-row">
                                                                <label for="#" class="ui-checkbox">
                                                                    <input type="checkbox" value="1" name="login"
                                                                           id="remember">
                                                                    <span class="ui-checkbox-check"></span>
                                                                </label>
                                                                <label for="remember"
                                                                       class="remember-me">{{$childCategory->name}}</label>
                                                            </div>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
{{--                                <section class="widget-product-categories">--}}
{{--                                    <header class="cat-header">--}}
{{--                                        <h2 class="mb-0">--}}
{{--                                            <button class="btn btn-block text-right" data-toggle="collapse"--}}
{{--                                                    href="#headingTwo" role="button" aria-expanded="false"--}}
{{--                                                    aria-controls="headingTwo">--}}
{{--                                                برند ها--}}
{{--                                                <i class="mdi mdi-chevron-down"></i>--}}
{{--                                            </button>--}}
{{--                                        </h2>--}}
{{--                                    </header>--}}
{{--                                    <div class="product-filter">--}}
{{--                                        <div class="card">--}}
{{--                                            <div class="collapse show" id="headingTwo">--}}
{{--                                                <div class="card-main mb-0">--}}
{{--                                                    <div class="form-auth-row">--}}
{{--                                                        <label for="#" class="ui-checkbox">--}}
{{--                                                            <input type="checkbox" value="1" name="login" id="remember">--}}
{{--                                                            <span class="ui-checkbox-check"></span>--}}
{{--                                                        </label>--}}
{{--                                                        <label for="remember" class="remember-me">سامسونگ</label>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-auth-row">--}}
{{--                                                        <label for="#" class="ui-checkbox">--}}
{{--                                                            <input type="checkbox" value="1" name="login" id="remember">--}}
{{--                                                            <span class="ui-checkbox-check"></span>--}}
{{--                                                        </label>--}}
{{--                                                        <label for="remember" class="remember-me">اپل</label>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-auth-row">--}}
{{--                                                        <label for="#" class="ui-checkbox">--}}
{{--                                                            <input type="checkbox" value="1" name="login" id="remember">--}}
{{--                                                            <span class="ui-checkbox-check"></span>--}}
{{--                                                        </label>--}}
{{--                                                        <label for="remember" class="remember-me">نوکیا</label>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-auth-row">--}}
{{--                                                        <label for="#" class="ui-checkbox">--}}
{{--                                                            <input type="checkbox" value="1" name="login" id="remember">--}}
{{--                                                            <span class="ui-checkbox-check"></span>--}}
{{--                                                        </label>--}}
{{--                                                        <label for="remember" class="remember-me">هواوی</label>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-auth-row">--}}
{{--                                                        <label for="#" class="ui-checkbox">--}}
{{--                                                            <input type="checkbox" value="1" name="login" id="remember">--}}
{{--                                                            <span class="ui-checkbox-check"></span>--}}
{{--                                                        </label>--}}
{{--                                                        <label for="remember" class="remember-me">شیایومی</label>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-auth-row">--}}
{{--                                                        <label for="#" class="ui-checkbox">--}}
{{--                                                            <input type="checkbox" value="1" name="login" id="remember">--}}
{{--                                                            <span class="ui-checkbox-check"></span>--}}
{{--                                                        </label>--}}
{{--                                                        <label for="remember" class="remember-me">ال جی</label>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-auth-row">--}}
{{--                                                        <label for="#" class="ui-checkbox">--}}
{{--                                                            <input type="checkbox" value="1" name="login" id="remember">--}}
{{--                                                            <span class="ui-checkbox-check"></span>--}}
{{--                                                        </label>--}}
{{--                                                        <label for="remember" class="remember-me">سونی</label>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-auth-row">--}}
{{--                                                        <label for="#" class="ui-checkbox">--}}
{{--                                                            <input type="checkbox" value="1" name="login" id="remember">--}}
{{--                                                            <span class="ui-checkbox-check"></span>--}}
{{--                                                        </label>--}}
{{--                                                        <label for="remember" class="remember-me">اچ تی سی</label>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </section>--}}
{{--                                <section class="widget-product-categories">--}}
{{--                                    <header class="cat-header">--}}
{{--                                        <h2 class="mb-0">--}}
{{--                                            <button class="btn btn-block text-right collapsed" data-toggle="collapse"--}}
{{--                                                    href="#headingThree" role="button" aria-expanded="false"--}}
{{--                                                    aria-controls="headingThree">--}}
{{--                                                محدوده قیمت--}}
{{--                                                <i class="mdi mdi-chevron-down"></i>--}}
{{--                                            </button>--}}
{{--                                        </h2>--}}
{{--                                    </header>--}}
{{--                                    <div class="product-filter">--}}
{{--                                        <div class="card">--}}
{{--                                            <div class="collapse show" id="headingThree">--}}
{{--                                                <div class="card-main mb-0">--}}
{{--                                                    <div class="box-data">--}}
{{--                                                        <form action="">--}}
{{--                                                            <div class="mt-5 mb-4">--}}
{{--                                                                <div id="slider-non-linear-step"></div>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="filter-range mt-2 mb-2 pr">--}}
{{--                                                                <span>قیمت: </span>--}}
{{--                                                                <span class="example-val"--}}
{{--                                                                      id="slider-non-linear-step-value"></span> تومان--}}
{{--                                                            </div>--}}
{{--                                                            <div class="mt-2 pl">--}}
{{--                                                                <button class="btn btn-range">--}}
{{--                                                                    اعمال--}}
{{--                                                                </button>--}}
{{--                                                            </div>--}}
{{--                                                        </form>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </section>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-xs-12 pl">
                        <div class="shop-archive-content mt-3 d-block">
{{--                            <div class="archive-header">--}}
{{--                                <h2 class="archive-header-title">آرشیو محصولات</h2>--}}
{{--                                <div class="sort-tabs mt-0 d-inline-block pr">--}}
{{--                                    <h4>مرتب‌سازی بر اساس :</h4>--}}
{{--                                </div>--}}
{{--                                <div class="nav-sort-tabs-res">--}}
{{--                                    <ul class="nav sort-tabs-options" id="myTab" role="tablist">--}}
{{--                                        <li class="nav-item">--}}
{{--                                            <a class="nav-link active" id="Most-visited-tab" data-toggle="tab"--}}
{{--                                               href="#Most-visited" role="tab" aria-controls="Most-visited"--}}
{{--                                               aria-selected="true">پربازدیدترین</a>--}}
{{--                                        </li>--}}
{{--                                        <li class="nav-item">--}}
{{--                                            <a class="nav-link" id="Bestselling-tab" data-toggle="tab"--}}
{{--                                               href="#Bestselling" role="tab" aria-controls="Bestselling"--}}
{{--                                               aria-selected="false">پرفروش‌ترین‌</a>--}}
{{--                                        </li>--}}
{{--                                        <li class="nav-item">--}}
{{--                                            <a class="nav-link" id="Most-Popular-tab" data-toggle="tab"--}}
{{--                                               href="#Most-Popular" role="tab" aria-controls="Most-Popular"--}}
{{--                                               aria-selected="false">محبوب‌ترین</a>--}}
{{--                                        </li>--}}
{{--                                        <li class="nav-item">--}}
{{--                                            <a class="nav-link" id="newest-tab" data-toggle="tab" href="#newest"--}}
{{--                                               role="tab" aria-controls="newest" aria-selected="false">جدیدترین</a>--}}
{{--                                        </li>--}}
{{--                                        <li class="nav-item">--}}
{{--                                            <a class="nav-link" id="cheapest-tab" data-toggle="tab" href="#cheapest"--}}
{{--                                               role="tab" aria-controls="cheapest" aria-selected="false">ارزان‌ترین</a>--}}
{{--                                        </li>--}}
{{--                                        <li class="nav-item">--}}
{{--                                            <a class="nav-link" id="most-expensive-tab" data-toggle="tab"--}}
{{--                                               href="#most-expensive" role="tab" aria-controls="most-expensive"--}}
{{--                                               aria-selected="false">گران‌ترین</a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="product-items">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="Most-visited" role="tabpanel"
                                         aria-labelledby="Most-visited-tab">
                                        <div class="row">
                                            @foreach($products as $product)
                                            <div class="col-lg-3 col-md-3 col-xs-12 order-1 d-block mb-3">
                                                <section class="product-box product product-type-simple">
                                                    <div class="thumb">
                                                        <a href="{{route('home.products.show', $product->slug)}}" class="d-block">
{{--                                                            <div class="promotion-badge">فروش ویژه</div>--}}
{{--                                                            <div class="product-rate">--}}
{{--                                                                <i class="fa fa-star active"></i>--}}
{{--                                                                <i class="fa fa-star active"></i>--}}
{{--                                                                <i class="fa fa-star active"></i>--}}
{{--                                                                <i class="fa fa-star active"></i>--}}
{{--                                                                <i class="fa fa-star"></i>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="discount-d">--}}
{{--                                                                <span>20%</span>--}}
{{--                                                            </div>--}}
                                                            <img src="{{asset(env('PRODUCT_IMAGES_UPLOAD_PATH').$product->primary_image)}}" width="100%">
                                                        </a>
                                                    </div>
                                                    <div class="title">
                                                        <a href="{{route('home.products.show', $product->slug)}}">{{$product->name}}</a>
                                                    </div>
                                                    <div class="price">
                                                        @if($product->check_quantity)
                                                            @if($product->check_sale)

                                                                <del>
                                                                    <span class="amount">{{number_format($product->check_sale->price)}}<span>تومان</span></span>
                                                                </del>
                                                                <ins><span class="amount">{{number_format($product->check_sale->sale_price)}}<span>تومان</span></span>
                                                                </ins>
                                                            @else
                                                                <ins>
                                                                    <span class="amount">{{number_format($product->check_price->price)}}<span>تومان</span></span>
                                                                    -
                                                                    <span class="amount">{{number_format($product->expensive_price->price)}}<span>تومان</span></span>
                                                                </ins>
                                                            @endif
                                                        @else
                                                            <del><span>ناموجود</span></del>
                                                        @endif
                                                    </div>
                                                </section>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
{{--                                    <div class="tab-pane fade" id="Bestselling" role="tabpanel"--}}
{{--                                         aria-labelledby="Bestselling-tab">--}}
{{--                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">--}}
{{--                                            <section class="product-box product product-type-simple">--}}
{{--                                                <div class="thumb">--}}
{{--                                                    <a href="#" class="d-block">--}}
{{--                                                        <div class="promotion-badge">فروش ویژه</div>--}}
{{--                                                        <div class="product-rate">--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star"></i>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="discount-d">--}}
{{--                                                            <span>15%</span>--}}
{{--                                                        </div>--}}
{{--                                                        <img--}}
{{--                                                            src="{{ asset('assets/newsite/images/slider-product/t-shirt-1.jpg') }}">--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="title">--}}
{{--                                                    <a href="#">تی شرت به رسم طرح دریم کچر کد 558</a>--}}
{{--                                                </div>--}}
{{--                                                <div class="price">--}}
{{--                                                    <span class="amount">32,000--}}
{{--                                                        <span>تومان</span>--}}
{{--                                                    </span>--}}
{{--                                                </div>--}}
{{--                                            </section>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">--}}
{{--                                            <section class="product-box product product-type-simple">--}}
{{--                                                <div class="thumb">--}}
{{--                                                    <a href="#" class="d-block">--}}
{{--                                                        <div class="product-rate">--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star"></i>--}}
{{--                                                        </div>--}}
{{--                                                        <img--}}
{{--                                                            src="{{ asset('assets/newsite/images/slider-product/camera-instax-mini-70.jpg') }}">--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="title">--}}
{{--                                                    <a href="#">--}}
{{--                                                        دوربین عکاسی چاپ سریع فوجی فیلم مدل Instax mini 70--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="price">--}}
{{--                                                    <span class="amount">4,200,000--}}
{{--                                                        <span>تومان</span>--}}
{{--                                                    </span>--}}
{{--                                                </div>--}}
{{--                                            </section>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">--}}
{{--                                            <section class="product-box product product-type-simple">--}}
{{--                                                <div class="thumb">--}}
{{--                                                    <a href="#" class="d-block">--}}
{{--                                                        <div class="promotion-badge">فروش ویژه</div>--}}
{{--                                                        <div class="product-rate">--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star"></i>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="discount-d">--}}
{{--                                                            <span>25%</span>--}}
{{--                                                        </div>--}}
{{--                                                        <img--}}
{{--                                                            src="{{ asset('assets/newsite/images/slider-product/DNR 290T-366T.jpg') }}">--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="title">--}}
{{--                                                    <a href="#">یخچال و فریزر دو قلوی دونار مدل DNR 290T-366T</a>--}}
{{--                                                </div>--}}
{{--                                                <div class="price">--}}
{{--                                                    <span class="amount">4,200,000--}}
{{--                                                        <span>تومان</span>--}}
{{--                                                    </span>--}}
{{--                                                </div>--}}
{{--                                            </section>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">--}}
{{--                                            <section class="product-box product product-type-simple">--}}
{{--                                                <div class="thumb">--}}
{{--                                                    <a href="#" class="d-block">--}}
{{--                                                        <div class="product-rate">--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star"></i>--}}
{{--                                                        </div>--}}
{{--                                                        <img--}}
{{--                                                            src="{{ asset('assets/newsite/images/slider-product/Samsung-S10Plus.jpg') }}">--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="title">--}}
{{--                                                    <a href="#">--}}
{{--                                                        سامسونگ گلکسی اس 10 پلاس – 128 گیگابایت – دو سیم کارت--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="price">--}}
{{--                                                    <span class="amount">10,500,000--}}
{{--                                                        <span>تومان</span>--}}
{{--                                                    </span>--}}
{{--                                                </div>--}}
{{--                                            </section>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">--}}
{{--                                            <section class="product-box product product-type-simple">--}}
{{--                                                <div class="thumb">--}}
{{--                                                    <a href="#" class="d-block">--}}
{{--                                                        <div class="promotion-badge">فروش ویژه</div>--}}
{{--                                                        <div class="product-rate">--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star"></i>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="discount-d">--}}
{{--                                                            <span>20%</span>--}}
{{--                                                        </div>--}}
{{--                                                        <img--}}
{{--                                                            src="{{ asset('assets/newsite/images/slider-product/btt.jpg') }}">--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="title">--}}
{{--                                                    <a href="#">تی شرت آستین کوتاه تارکان کد btt 152-1</a>--}}
{{--                                                </div>--}}
{{--                                                <div class="price">--}}
{{--                                                    <span class="amount">58,000--}}
{{--                                                        <span>تومان</span>--}}
{{--                                                    </span>--}}
{{--                                                </div>--}}
{{--                                            </section>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">--}}
{{--                                            <section class="product-box product product-type-simple">--}}
{{--                                                <div class="thumb">--}}
{{--                                                    <a href="#" class="d-block">--}}
{{--                                                        <div class="promotion-badge">فروش ویژه</div>--}}
{{--                                                        <div class="product-rate">--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star"></i>--}}
{{--                                                            <i class="fa fa-star"></i>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="discount-d">--}}
{{--                                                            <span>10%</span>--}}
{{--                                                        </div>--}}
{{--                                                        <img--}}
{{--                                                            src="{{ asset('assets/newsite/images/slider-product/boxing.jpg') }}">--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="title">--}}
{{--                                                    <a href="#">تی شرت ورزشی نخی مردانه فلوریزا طرح بوکس کد boxing 002M--}}
{{--                                                        تیشرت</a>--}}
{{--                                                </div>--}}
{{--                                                <div class="price">--}}
{{--                                                    <span class="amount">40,000--}}
{{--                                                        <span>تومان</span>--}}
{{--                                                    </span>--}}
{{--                                                </div>--}}
{{--                                            </section>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">--}}
{{--                                            <section class="product-box product product-type-simple">--}}
{{--                                                <div class="thumb">--}}
{{--                                                    <a href="#" class="d-block">--}}
{{--                                                        <div class="product-rate">--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                        </div>--}}
{{--                                                        <img--}}
{{--                                                            src="{{ asset('assets/newsite/images/slider-product/Avocado.jpg') }}">--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="title">--}}
{{--                                                    <a href="#">آب میوه گیری پارس خزر مدل Avocado</a>--}}
{{--                                                </div>--}}
{{--                                                <div class="price">--}}
{{--                                                    <span class="amount">6,000,000--}}
{{--                                                        <span>تومان</span>--}}
{{--                                                    </span>--}}
{{--                                                </div>--}}
{{--                                            </section>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">--}}
{{--                                            <section class="product-box product product-type-simple">--}}
{{--                                                <div class="thumb">--}}
{{--                                                    <a href="#" class="d-block">--}}
{{--                                                        <div class="product-rate">--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star"></i>--}}
{{--                                                            <i class="fa fa-star"></i>--}}
{{--                                                        </div>--}}
{{--                                                        <img--}}
{{--                                                            src="{{ asset('assets/newsite/images/slider-product/honer.jpg') }}">--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="title">--}}
{{--                                                    <a href="#">هواوی هانر ویوو 20 – 256 گیگابایت – دو سیم کارت</a>--}}
{{--                                                </div>--}}
{{--                                                <div class="price">--}}
{{--                                                    <span class="amount">4,200,000--}}
{{--                                                        <span>تومان</span>--}}
{{--                                                    </span>--}}
{{--                                                </div>--}}
{{--                                            </section>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">--}}
{{--                                            <section class="product-box product product-type-simple">--}}
{{--                                                <div class="thumb">--}}
{{--                                                    <a href="#" class="d-block">--}}
{{--                                                        <div class="product-rate">--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star"></i>--}}
{{--                                                        </div>--}}
{{--                                                        <img--}}
{{--                                                            src="{{ asset('assets/newsite/images/slider-product/zenbook.jpg') }}">--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="title">--}}
{{--                                                    <a href="#">لپ تاپ 13 اینچی ایسوس مدل ZenBook S13 UX392FN - A</a>--}}
{{--                                                </div>--}}
{{--                                                <div class="price">--}}
{{--                                                    <span class="amount">6,000,000--}}
{{--                                                        <span>تومان</span>--}}
{{--                                                    </span>--}}
{{--                                                </div>--}}
{{--                                            </section>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">--}}
{{--                                            <section class="product-box product product-type-simple">--}}
{{--                                                <div class="thumb">--}}
{{--                                                    <a href="#" class="d-block">--}}
{{--                                                        <div class="promotion-badge">فروش ویژه</div>--}}
{{--                                                        <div class="product-rate">--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="discount-d">--}}
{{--                                                            <span>10%</span>--}}
{{--                                                        </div>--}}
{{--                                                        <img--}}
{{--                                                            src="{{ asset('assets/newsite/images/slider-product/camera-nikon-3500D.jpg') }}">--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="title">--}}
{{--                                                    <a href="#">--}}
{{--                                                        دوربین دیجیتال نیکون مدل D3500 به همراه لنز 18-55 میلی متر VR--}}
{{--                                                        AF-P--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="price">--}}
{{--                                                    <span class="amount">2,000,000--}}
{{--                                                        <span>تومان</span>--}}
{{--                                                    </span>--}}
{{--                                                </div>--}}
{{--                                            </section>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">--}}
{{--                                            <section class="product-box product product-type-simple">--}}
{{--                                                <div class="thumb">--}}
{{--                                                    <a href="#" class="d-block">--}}
{{--                                                        <div class="product-rate">--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star"></i>--}}
{{--                                                            <i class="fa fa-star"></i>--}}
{{--                                                        </div>--}}
{{--                                                        <img--}}
{{--                                                            src="{{ asset('assets/newsite/images/slider-product/Stove-lopez.jpg') }}">--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="title">--}}
{{--                                                    <a href="#">اجاق گاز طرح فر لوپز مدل 10000S</a>--}}
{{--                                                </div>--}}
{{--                                                <div class="price">--}}
{{--                                                    <span class="amount">10,500,000--}}
{{--                                                        <span>تومان</span>--}}
{{--                                                    </span>--}}
{{--                                                </div>--}}
{{--                                            </section>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">--}}
{{--                                            <section class="product-box product product-type-simple">--}}
{{--                                                <div class="thumb">--}}
{{--                                                    <a href="#" class="d-block">--}}
{{--                                                        <div class="promotion-badge">فروش ویژه</div>--}}
{{--                                                        <div class="product-rate">--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star"></i>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="discount-d">--}}
{{--                                                            <span>10%</span>--}}
{{--                                                        </div>--}}
{{--                                                        <img--}}
{{--                                                            src="{{ asset('assets/newsite/images/slider-product/SL1200_-300x300.jpg') }}">--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="title">--}}
{{--                                                    <a href="#">لپ تاپ چووی الترابوک 14 اینچ پرو</a>--}}
{{--                                                </div>--}}
{{--                                                <div class="price">--}}
{{--                                                    <span class="amount">2,500,000--}}
{{--                                                        <span>تومان</span>--}}
{{--                                                    </span>--}}
{{--                                                </div>--}}
{{--                                            </section>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">--}}
{{--                                            <section class="product-box product product-type-simple">--}}
{{--                                                <div class="thumb">--}}
{{--                                                    <a href="#" class="d-block">--}}
{{--                                                        <div class="product-rate">--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star active"></i>--}}
{{--                                                            <i class="fa fa-star"></i>--}}
{{--                                                        </div>--}}
{{--                                                        <img--}}
{{--                                                            src="{{ asset('assets/newsite/images/slider-product/iphone-xs-max-space.jpg') }}">--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="title">--}}
{{--                                                    <a href="#">--}}
{{--                                                        اپل آیفون ایکس اس مکس – 256 گیگابایت – دو سیم کارت--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="price">--}}
{{--                                                    <span class="amount">2,000,000--}}
{{--                                                        <span>تومان</span>--}}
{{--                                                    </span>--}}
{{--                                                </div>--}}
{{--                                            </section>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="tab-pane fade" id="Most-Popular" role="tabpanel"
                                         aria-labelledby="Most-Popular-tab">
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/iphone-xs-max-space.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">
                                                        اپل آیفون ایکس اس مکس – 256 گیگابایت – دو سیم کارت
                                                    </a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">2,000,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/zenbook.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">لپ تاپ 13 اینچی ایسوس مدل ZenBook S13 UX392FN - A</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">6,000,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="promotion-badge">فروش ویژه</div>
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                        </div>
                                                        <div class="discount-d">
                                                            <span>10%</span>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/camera-nikon-3500D.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">
                                                        دوربین دیجیتال نیکون مدل D3500 به همراه لنز 18-55 میلی متر VR
                                                        AF-P
                                                    </a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">2,000,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/Stove-lopez.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">اجاق گاز طرح فر لوپز مدل 10000S</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">10,500,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="promotion-badge">فروش ویژه</div>
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <div class="discount-d">
                                                            <span>10%</span>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/SL1200_-300x300.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">لپ تاپ چووی الترابوک 14 اینچ پرو</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">2,500,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="promotion-badge">فروش ویژه</div>
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <div class="discount-d">
                                                            <span>15%</span>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/t-shirt-1.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">تی شرت به رسم طرح دریم کچر کد 558</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">32,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/camera-instax-mini-70.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">
                                                        دوربین عکاسی چاپ سریع فوجی فیلم مدل Instax mini 70
                                                    </a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">4,200,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="promotion-badge">فروش ویژه</div>
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <div class="discount-d">
                                                            <span>25%</span>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/DNR 290T-366T.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">یخچال و فریزر دو قلوی دونار مدل DNR 290T-366T</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">4,200,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/Samsung-S10Plus.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">
                                                        سامسونگ گلکسی اس 10 پلاس – 128 گیگابایت – دو سیم کارت
                                                    </a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">10,500,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="promotion-badge">فروش ویژه</div>
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <div class="discount-d">
                                                            <span>20%</span>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/btt.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">تی شرت آستین کوتاه تارکان کد btt 152-1</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">58,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="promotion-badge">فروش ویژه</div>
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <div class="discount-d">
                                                            <span>10%</span>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/boxing.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">تی شرت ورزشی نخی مردانه فلوریزا طرح بوکس کد boxing 002M
                                                        تیشرت</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">40,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/Avocado.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">آب میوه گیری پارس خزر مدل Avocado</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">6,000,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/honer.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">هواوی هانر ویوو 20 – 256 گیگابایت – دو سیم کارت</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">4,200,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="newest" role="tabpanel" aria-labelledby="newest-tab">
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/honer.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">هواوی هانر ویوو 20 – 256 گیگابایت – دو سیم کارت</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">4,200,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="promotion-badge">فروش ویژه</div>
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <div class="discount-d">
                                                            <span>25%</span>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/DNR 290T-366T.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">یخچال و فریزر دو قلوی دونار مدل DNR 290T-366T</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">4,200,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/Samsung-S10Plus.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">
                                                        سامسونگ گلکسی اس 10 پلاس – 128 گیگابایت – دو سیم کارت
                                                    </a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">10,500,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="promotion-badge">فروش ویژه</div>
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <div class="discount-d">
                                                            <span>20%</span>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/btt.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">تی شرت آستین کوتاه تارکان کد btt 152-1</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">58,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="promotion-badge">فروش ویژه</div>
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <div class="discount-d">
                                                            <span>10%</span>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/boxing.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">تی شرت ورزشی نخی مردانه فلوریزا طرح بوکس کد boxing 002M
                                                        تیشرت</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">40,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/Avocado.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">آب میوه گیری پارس خزر مدل Avocado</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">6,000,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/iphone-xs-max-space.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">
                                                        اپل آیفون ایکس اس مکس – 256 گیگابایت – دو سیم کارت
                                                    </a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">2,000,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/zenbook.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">لپ تاپ 13 اینچی ایسوس مدل ZenBook S13 UX392FN - A</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">6,000,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="promotion-badge">فروش ویژه</div>
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                        </div>
                                                        <div class="discount-d">
                                                            <span>10%</span>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/camera-nikon-3500D.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">
                                                        دوربین دیجیتال نیکون مدل D3500 به همراه لنز 18-55 میلی متر VR
                                                        AF-P
                                                    </a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">2,000,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/Stove-lopez.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">اجاق گاز طرح فر لوپز مدل 10000S</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">10,500,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="promotion-badge">فروش ویژه</div>
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <div class="discount-d">
                                                            <span>10%</span>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/SL1200_-300x300.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">لپ تاپ چووی الترابوک 14 اینچ پرو</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">2,500,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="promotion-badge">فروش ویژه</div>
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <div class="discount-d">
                                                            <span>15%</span>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/t-shirt-1.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">تی شرت به رسم طرح دریم کچر کد 558</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">32,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/camera-instax-mini-70.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">
                                                        دوربین عکاسی چاپ سریع فوجی فیلم مدل Instax mini 70
                                                    </a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">4,200,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="cheapest" role="tabpanel"
                                         aria-labelledby="cheapest-tab">
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/camera-instax-mini-70.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">
                                                        دوربین عکاسی چاپ سریع فوجی فیلم مدل Instax mini 70
                                                    </a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">4,200,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/iphone-xs-max-space.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">
                                                        اپل آیفون ایکس اس مکس – 256 گیگابایت – دو سیم کارت
                                                    </a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">2,000,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/zenbook.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">لپ تاپ 13 اینچی ایسوس مدل ZenBook S13 UX392FN - A</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">6,000,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="promotion-badge">فروش ویژه</div>
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                        </div>
                                                        <div class="discount-d">
                                                            <span>10%</span>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/camera-nikon-3500D.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">
                                                        دوربین دیجیتال نیکون مدل D3500 به همراه لنز 18-55 میلی متر VR
                                                        AF-P
                                                    </a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">2,000,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/Stove-lopez.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">اجاق گاز طرح فر لوپز مدل 10000S</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">10,500,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="promotion-badge">فروش ویژه</div>
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <div class="discount-d">
                                                            <span>10%</span>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/SL1200_-300x300.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">لپ تاپ چووی الترابوک 14 اینچ پرو</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">2,500,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="promotion-badge">فروش ویژه</div>
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <div class="discount-d">
                                                            <span>15%</span>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/t-shirt-1.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">تی شرت به رسم طرح دریم کچر کد 558</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">32,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/iphone-xs-max-space.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">
                                                        اپل آیفون ایکس اس مکس – 256 گیگابایت – دو سیم کارت
                                                    </a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">2,000,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/zenbook.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">لپ تاپ 13 اینچی ایسوس مدل ZenBook S13 UX392FN - A</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">6,000,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="promotion-badge">فروش ویژه</div>
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                        </div>
                                                        <div class="discount-d">
                                                            <span>10%</span>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/camera-nikon-3500D.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">
                                                        دوربین دیجیتال نیکون مدل D3500 به همراه لنز 18-55 میلی متر VR
                                                        AF-P
                                                    </a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">2,000,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/Stove-lopez.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">اجاق گاز طرح فر لوپز مدل 10000S</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">10,500,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="promotion-badge">فروش ویژه</div>
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <div class="discount-d">
                                                            <span>10%</span>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/SL1200_-300x300.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">لپ تاپ چووی الترابوک 14 اینچ پرو</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">2,500,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="promotion-badge">فروش ویژه</div>
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <div class="discount-d">
                                                            <span>15%</span>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/t-shirt-1.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">تی شرت به رسم طرح دریم کچر کد 558</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">32,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/camera-instax-mini-70.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">
                                                        دوربین عکاسی چاپ سریع فوجی فیلم مدل Instax mini 70
                                                    </a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">4,200,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="most-expensive" role="tabpanel"
                                         aria-labelledby="most-expensive-tab">
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="promotion-badge">فروش ویژه</div>
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <div class="discount-d">
                                                            <span>10%</span>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/SL1200_-300x300.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">لپ تاپ چووی الترابوک 14 اینچ پرو</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">2,500,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="promotion-badge">فروش ویژه</div>
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <div class="discount-d">
                                                            <span>15%</span>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/t-shirt-1.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">تی شرت به رسم طرح دریم کچر کد 558</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">32,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/camera-instax-mini-70.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">
                                                        دوربین عکاسی چاپ سریع فوجی فیلم مدل Instax mini 70
                                                    </a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">4,200,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="promotion-badge">فروش ویژه</div>
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <div class="discount-d">
                                                            <span>15%</span>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/t-shirt-1.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">تی شرت به رسم طرح دریم کچر کد 558</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">32,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/iphone-xs-max-space.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">
                                                        اپل آیفون ایکس اس مکس – 256 گیگابایت – دو سیم کارت
                                                    </a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">2,000,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/zenbook.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">لپ تاپ 13 اینچی ایسوس مدل ZenBook S13 UX392FN - A</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">6,000,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="promotion-badge">فروش ویژه</div>
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                        </div>
                                                        <div class="discount-d">
                                                            <span>10%</span>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/camera-nikon-3500D.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">
                                                        دوربین دیجیتال نیکون مدل D3500 به همراه لنز 18-55 میلی متر VR
                                                        AF-P
                                                    </a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">2,000,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/Stove-lopez.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">اجاق گاز طرح فر لوپز مدل 10000S</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">10,500,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="promotion-badge">فروش ویژه</div>
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <div class="discount-d">
                                                            <span>10%</span>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/SL1200_-300x300.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">لپ تاپ چووی الترابوک 14 اینچ پرو</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">2,500,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="promotion-badge">فروش ویژه</div>
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <div class="discount-d">
                                                            <span>15%</span>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/t-shirt-1.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">تی شرت به رسم طرح دریم کچر کد 558</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">32,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/iphone-xs-max-space.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">
                                                        اپل آیفون ایکس اس مکس – 256 گیگابایت – دو سیم کارت
                                                    </a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">2,000,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/zenbook.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">لپ تاپ 13 اینچی ایسوس مدل ZenBook S13 UX392FN - A</a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">6,000,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-xs-12 order-1 pr d-block mb-3">
                                            <section class="product-box product product-type-simple">
                                                <div class="thumb">
                                                    <a href="#" class="d-block">
                                                        <div class="promotion-badge">فروش ویژه</div>
                                                        <div class="product-rate">
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                            <i class="fa fa-star active"></i>
                                                        </div>
                                                        <div class="discount-d">
                                                            <span>10%</span>
                                                        </div>
                                                        <img
                                                            src="{{ asset('assets/newsite/images/slider-product/camera-nikon-3500D.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <a href="#">
                                                        دوربین دیجیتال نیکون مدل D3500 به همراه لنز 18-55 میلی متر VR
                                                        AF-P
                                                    </a>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">2,000,000
                                                        <span>تومان</span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
{{--                            <div class="pagination-product">--}}
{{--                                <nav aria-label="Page navigation example">--}}
{{--                                    <ul class="pagination">--}}
{{--                                        <li class="page-item">--}}
{{--                                            <a class="page-link" href="#" aria-label="Previous">--}}
{{--                                                <span aria-hidden="true">&laquo;</span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                        <li class="page-item">--}}
{{--                                            <a class="page-link active" href="#">1</a>--}}
{{--                                        </li>--}}
{{--                                        <li class="page-item">--}}
{{--                                            <a class="page-link" href="#">2</a>--}}
{{--                                        </li>--}}
{{--                                        <li class="page-item">--}}
{{--                                            <a class="page-link" href="#">3</a>--}}
{{--                                        </li>--}}
{{--                                        <li class="page-item">--}}
{{--                                            <a class="page-link" href="#" aria-label="Next">--}}
{{--                                                <span aria-hidden="true">&raquo;</span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </nav>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- arshive-product----------------------->
@endsection

@section('script')
    <script>
        function filter() {
            let attributes = @json($attributes);
            attributes.map(attribute => {
                let attributeValue = $(`.attribute-${attribute.id}:checked`).map(function () {
                    return this.value;
                }).get().join('-');
                if (attributeValue == "") {
                    $(`#filter-attribute-${attribute.id}`).prop('disabled', true);
                } else {
                    $(`#filter-attribute-${attribute.id}`).val(attributeValue);
                }
            });

            let variation = $('.variation:checked').map(function () {
                return this.value;
            }).get().join('-');
            if (variation == "") {
                $('#filter-variation').prop('disabled', true);
            } else {
                $('#filter-variation').val(variation);
            }

            let sortBy = $('#sort-by').val();
            if (sortBy == "default") {
                $('#filter-sort-by').prop('disabled', true);
            } else {
                $('#filter-sort-by').val(sortBy);
            }

            let search = $('#search-input').val();
            if (search == "") {
                $('#filter-search').prop('disabled', true);
            } else {
                $('#filter-search').val(search);
            }
            $('#filter-form').submit();
        }

        $('#filter-form').on('submit', function (event) {
            event.preventDefault();
            let currentUrl = '{{ url()->current() }}';
            let url = currentUrl + '?' + decodeURIComponent($(this).serialize());
            $(location).attr('href', url);
        });

        $('.variation-select').on('change', function () {
            let variation = JSON.parse(this.value);
            let variationPriceDiv = $('.variation-price');
            variationPriceDiv.empty();
            if (variation.sale_price) {
                let spanSale = $('<span/>', {
                    class: 'new',
                    text: toPersianNum(number_format(variation.sale_price)) + ' تومان'
                });
                let spanPrice = $('<span/>', {
                    class: 'old',
                    text: toPersianNum(number_format(variation.price)) + ' تومان'
                });
                variationPriceDiv.append(spanSale);
                variationPriceDiv.append(spanPrice);
            } else {
                let spanPrice = $('<span/>', {
                    class: 'new',
                    text: toPersianNum(number_format(variation.price)) + ' تومان'
                });
                variationPriceDiv.append(spanPrice);
            }
            $('.quantity-value').attr('data-max', variation.quantity);
            $('.quantity-value').val(1);
        });

        $('#pagination li a').map(function () {
            let decodeUrl = decodeURIComponent($(this).attr('href'));
            if ($(this).attr('href') != decodeUrl) {
                $(this).attr('href', decodeUrl);
            }
        })
    </script>
@endsection
