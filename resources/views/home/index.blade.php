@extends('home.layouts.home')

@section('title')
    صفحه ی اصلی
@endsection
@section('content')
    <!-- slider-main--------------------------->
    <div class="container-main">
        <div class="d-block">
            <div class="col-lg-8 col-xs-12 pr">
                <div class="slider-main-container d-block">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('/assets/newsite/images/slider-main/sm-1.jpg') }}"
                                     class="d-block w-100" alt="...">
                            </div>
{{--                            <div class="carousel-item">--}}
{{--                                <img src="{{ asset('/assets/newsite/images/slider-main/sm-2.jpg') }}"--}}
{{--                                     class="d-block w-100" alt="...">--}}
{{--                            </div>--}}
{{--                            <div class="carousel-item">--}}
{{--                                <img src="{{ asset('/assets/newsite/images/slider-main/sm-3.jpg') }}"--}}
{{--                                     class="d-block w-100" alt="...">--}}
{{--                            </div>--}}
{{--                            <div class="carousel-item">--}}
{{--                                <img src="{{ asset('/assets/newsite/images/slider-main/sm-4.jpg') }}"--}}
{{--                                     class="d-block w-100" alt="...">--}}
{{--                            </div>--}}
{{--                            <div class="carousel-item">--}}
{{--                                <img src="{{ asset('/assets/newsite/images/slider-main/sm-5.jpg') }}"--}}
{{--                                     class="d-block w-100" alt="...">--}}
{{--                            </div>--}}
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                           data-slide="prev">
                            <span class="fa fa-angle-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                           data-slide="next">
                            <span class="fa fa-angle-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- adplacement--------------------------->
            <div class="col-lg-4 col-md-4 col-xs-12 pl mt-1">
                <div class="adplacement-container-column">
                    <a href="#" class="adplacement-item">
                        <div class="adplacement-sponsored-box">
                            <img src="{{ asset('/assets/newsite/images/adplacement/a-1.jpg') }}">
                        </div>
                    </a>
                    <a href="#" class="adplacement-item">
                        <div class="adplacement-sponsored-box">
                            <img src="{{ asset('/assets/newsite/images/adplacement/a-2.jpg') }}">
                        </div>
                    </a>
                </div>
            </div>
            {{--        <div class="col-lg-3 col-md-3 col-xs-12 pr">--}}
            {{--            <div class="adplacement-container-column mt-4">--}}
            {{--                <a href="#" class="adplacement-item img-banner">--}}
            {{--                    <div class="adplacement-sponsored-box">--}}
            {{--                        <img src="{{ asset('/assets/newsite/images/adplacement/a-3.jpg') }}">--}}
            {{--                    </div>--}}
            {{--                </a>--}}
            {{--            </div>--}}
            {{--        </div>--}}
            <!-- adplacement--------------------------->

            <!-- slider-amazing------------------------>
            {{--        <div class="slider-widget-products slider-content-tabs slider-amazing-product">--}}
            {{--            <div class="widget widget-product card slider-content-tabs">--}}
            {{--                <header class="card-header">--}}
            {{--                    <span class="title-one">محصولات شگفت انگیز</span>--}}
            {{--                    <h3 class="card-title"></h3>--}}
            {{--                </header>--}}
            {{--                <div class="product-carousel product-amazing owl-carousel owl-theme owl-rtl owl-loaded owl-drag">--}}
            {{--                    <div class="owl-stage-outer">--}}
            {{--                        <div class="owl-stage"--}}
            {{--                             style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1162px;">--}}
            {{--                            <div class="owl-item tab-item active" style="width: 222.313px; margin-left: 10px;">--}}
            {{--                                <div class="item">--}}
            {{--                                    <a href="#" class="d-block hover-img-link">--}}
            {{--                                        <img src="{{ asset('/assets/newsite/images/slider-amazing/as-1.jpg') }}" class="img-fluid" alt="">--}}
            {{--                                    </a>--}}
            {{--                                    <h2 class="post-title">--}}
            {{--                                        <a href="#">--}}
            {{--                                            لپ تاپ ۱۵ اینچی ایسوس مدل VivoBook Flip TP510UQ – C--}}
            {{--                                        </a>--}}
            {{--                                    </h2>--}}
            {{--                                    <div class="price">--}}
            {{--                                        <del><span>12,000,000<span>تومان</span></span></del>--}}
            {{--                                        <ins><span>11,180,000<span>تومان</span></span></ins>--}}
            {{--                                    </div>--}}
            {{--                                    <div class="countdown-timer">--}}
            {{--                                        <div class="countdown h4" data-date-time="10/10/2025 12:00"--}}
            {{--                                             data-labels="{&quot;label-day&quot;: &quot;روز&quot;, &quot;label-hour&quot;: &quot;ساعت&quot;, &quot;label-minute&quot;: &quot;دقیقه&quot;, &quot;label-second&quot;: &quot;ثانیه&quot;}">--}}
            {{--                                            <div class="countdown-item">--}}
            {{--                                                <div class="countdown-value">155</div>--}}
            {{--                                                <div class="countdown-label">روز</div>--}}
            {{--                                            </div>--}}
            {{--                                            <div class="countdown-item">--}}
            {{--                                                <div class="countdown-value">10</div>--}}
            {{--                                                <div class="countdown-label">ساعت</div>--}}
            {{--                                            </div>--}}
            {{--                                            <div class="countdown-item">--}}
            {{--                                                <div class="countdown-value">16</div>--}}
            {{--                                                <div class="countdown-label">دقیقه</div>--}}
            {{--                                            </div>--}}
            {{--                                            <div class="countdown-item">--}}
            {{--                                                <div class="countdown-value">01</div>--}}
            {{--                                                <div class="countdown-label">ثانیه</div>--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="owl-item tab-item active" style="width: 222.313px; margin-left: 10px;">--}}
            {{--                                <div class="item">--}}
            {{--                                    <a href="#" class="d-block hover-img-link">--}}
            {{--                                        <img src="{{ asset('/assets/newsite/images/slider-amazing/as-2.jpg') }}" class="img-fluid" alt="">--}}
            {{--                                    </a>--}}
            {{--                                    <h2 class="post-title">--}}
            {{--                                        <a href="#">--}}
            {{--                                            یخچال و فریزر سامسونگ مدل HM34--}}
            {{--                                        </a>--}}
            {{--                                    </h2>--}}
            {{--                                    <div class="price">--}}
            {{--                                        <del><span>9,000,000<span>تومان</span></span></del>--}}
            {{--                                        <ins><span>8,500,000<span>تومان</span></span></ins>--}}
            {{--                                    </div>--}}
            {{--                                    <div class="countdown-timer">--}}
            {{--                                        <div class="countdown h4" data-date-time="10/10/2025 12:00"--}}
            {{--                                             data-labels="{&quot;label-day&quot;: &quot;روز&quot;, &quot;label-hour&quot;: &quot;ساعت&quot;, &quot;label-minute&quot;: &quot;دقیقه&quot;, &quot;label-second&quot;: &quot;ثانیه&quot;}">--}}
            {{--                                            <div class="countdown-item">--}}
            {{--                                                <div class="countdown-value">155</div>--}}
            {{--                                                <div class="countdown-label">روز</div>--}}
            {{--                                            </div>--}}
            {{--                                            <div class="countdown-item">--}}
            {{--                                                <div class="countdown-value">10</div>--}}
            {{--                                                <div class="countdown-label">ساعت</div>--}}
            {{--                                            </div>--}}
            {{--                                            <div class="countdown-item">--}}
            {{--                                                <div class="countdown-value">16</div>--}}
            {{--                                                <div class="countdown-label">دقیقه</div>--}}
            {{--                                            </div>--}}
            {{--                                            <div class="countdown-item">--}}
            {{--                                                <div class="countdown-value">01</div>--}}
            {{--                                                <div class="countdown-label">ثانیه</div>--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="owl-item tab-item active" style="width: 222.313px; margin-left: 10px;">--}}
            {{--                                <div class="item">--}}
            {{--                                    <a href="#" class="d-block hover-img-link">--}}
            {{--                                        <img src="{{ asset('/assets/newsite/images/slider-amazing/as-3.jpg') }}" class="img-fluid" alt="">--}}
            {{--                                    </a>--}}
            {{--                                    <h2 class="post-title">--}}
            {{--                                        <a href="#">--}}
            {{--                                            کامپیوتر همه کاره 21.5 اینچی ایسوس مدل AIO V222UAK-B--}}
            {{--                                        </a>--}}
            {{--                                    </h2>--}}
            {{--                                    <div class="price">--}}
            {{--                                        <del><span>12,000,000<span>تومان</span></span></del>--}}
            {{--                                        <ins><span>11,180,000<span>تومان</span></span></ins>--}}
            {{--                                    </div>--}}
            {{--                                    <div class="countdown-timer">--}}
            {{--                                        <div class="countdown h4" data-date-time="10/10/2025 12:00"--}}
            {{--                                             data-labels="{&quot;label-day&quot;: &quot;روز&quot;, &quot;label-hour&quot;: &quot;ساعت&quot;, &quot;label-minute&quot;: &quot;دقیقه&quot;, &quot;label-second&quot;: &quot;ثانیه&quot;}">--}}
            {{--                                            <div class="countdown-item">--}}
            {{--                                                <div class="countdown-value">155</div>--}}
            {{--                                                <div class="countdown-label">روز</div>--}}
            {{--                                            </div>--}}
            {{--                                            <div class="countdown-item">--}}
            {{--                                                <div class="countdown-value">10</div>--}}
            {{--                                                <div class="countdown-label">ساعت</div>--}}
            {{--                                            </div>--}}
            {{--                                            <div class="countdown-item">--}}
            {{--                                                <div class="countdown-value">16</div>--}}
            {{--                                                <div class="countdown-label">دقیقه</div>--}}
            {{--                                            </div>--}}
            {{--                                            <div class="countdown-item">--}}
            {{--                                                <div class="countdown-value">01</div>--}}
            {{--                                                <div class="countdown-label">ثانیه</div>--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="owl-item tab-item active" style="width: 222.313px; margin-left: 10px;">--}}
            {{--                                <div class="item">--}}
            {{--                                    <a href="#" class="d-block hover-img-link">--}}
            {{--                                        <img src="{{ asset('/assets/newsite/images/slider-amazing/as-4.jpg') }}" class="img-fluid" alt="">--}}
            {{--                                    </a>--}}
            {{--                                    <h2 class="post-title">--}}
            {{--                                        <a href="#">--}}
            {{--                                            شارژر بی سیم مدل EP-NG930--}}
            {{--                                        </a>--}}
            {{--                                    </h2>--}}
            {{--                                    <div class="price">--}}
            {{--                                        <del><span>8,000,000<span>تومان</span></span></del>--}}
            {{--                                        <ins><span>6,500,000<span>تومان</span></span></ins>--}}
            {{--                                    </div>--}}
            {{--                                    <div class="countdown-timer">--}}
            {{--                                        <div class="countdown h4" data-date-time="10/10/2025 12:00"--}}
            {{--                                             data-labels="{&quot;label-day&quot;: &quot;روز&quot;, &quot;label-hour&quot;: &quot;ساعت&quot;, &quot;label-minute&quot;: &quot;دقیقه&quot;, &quot;label-second&quot;: &quot;ثانیه&quot;}">--}}
            {{--                                            <div class="countdown-item">--}}
            {{--                                                <div class="countdown-value">155</div>--}}
            {{--                                                <div class="countdown-label">روز</div>--}}
            {{--                                            </div>--}}
            {{--                                            <div class="countdown-item">--}}
            {{--                                                <div class="countdown-value">10</div>--}}
            {{--                                                <div class="countdown-label">ساعت</div>--}}
            {{--                                            </div>--}}
            {{--                                            <div class="countdown-item">--}}
            {{--                                                <div class="countdown-value">16</div>--}}
            {{--                                                <div class="countdown-label">دقیقه</div>--}}
            {{--                                            </div>--}}
            {{--                                            <div class="countdown-item">--}}
            {{--                                                <div class="countdown-value">01</div>--}}
            {{--                                                <div class="countdown-label">ثانیه</div>--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="owl-item tab-item" style="width: 222.313px; margin-left: 10px;">--}}
            {{--                                <div class="item">--}}
            {{--                                    <a href="#" class="d-block hover-img-link">--}}
            {{--                                        <img src="{{ asset('/assets/newsite/images/slider-amazing/as-5.jpg') }}" class="img-fluid" alt="">--}}
            {{--                                    </a>--}}
            {{--                                    <h2 class="post-title">--}}
            {{--                                        <a href="#">--}}
            {{--                                            تلویزیون ال ای دی هوشمند سامسونگ مدل 55NU7900 سایز 55 اینچ--}}
            {{--                                        </a>--}}
            {{--                                    </h2>--}}
            {{--                                    <div class="price">--}}
            {{--                                        <del><span>14,500,000<span>تومان</span></span></del>--}}
            {{--                                        <ins><span>13,500,000<span>تومان</span></span></ins>--}}
            {{--                                    </div>--}}
            {{--                                    <div class="countdown-timer">--}}
            {{--                                        <div class="countdown h4" data-date-time="10/10/2025 12:00"--}}
            {{--                                             data-labels="{&quot;label-day&quot;: &quot;روز&quot;, &quot;label-hour&quot;: &quot;ساعت&quot;, &quot;label-minute&quot;: &quot;دقیقه&quot;, &quot;label-second&quot;: &quot;ثانیه&quot;}">--}}
            {{--                                            <div class="countdown-item">--}}
            {{--                                                <div class="countdown-value">155</div>--}}
            {{--                                                <div class="countdown-label">روز</div>--}}
            {{--                                            </div>--}}
            {{--                                            <div class="countdown-item">--}}
            {{--                                                <div class="countdown-value">10</div>--}}
            {{--                                                <div class="countdown-label">ساعت</div>--}}
            {{--                                            </div>--}}
            {{--                                            <div class="countdown-item">--}}
            {{--                                                <div class="countdown-value">16</div>--}}
            {{--                                                <div class="countdown-label">دقیقه</div>--}}
            {{--                                            </div>--}}
            {{--                                            <div class="countdown-item">--}}
            {{--                                                <div class="countdown-value">01</div>--}}
            {{--                                                <div class="countdown-label">ثانیه</div>--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--        </div>--}}
            {{--        <div class="col-lg-9 col-md-9 col-xs-12 pl">--}}
            {{--            <div class="content-widget-amazing pb-4 mt-2">--}}
            {{--                <section id="amazing-slider" class="carousel slide carousel-fade card" data-ride="carousel">--}}
            {{--                    <div class="row m-0">--}}
            {{--                        <ol class="carousel-indicators pr-0">--}}
            {{--                            <li class="active" data-target="#amazing-slider" data-slide-to="0">--}}
            {{--                                <img src="{{ asset('/assets/newsite/images/slider-amazing/as-1.jpg') }}" class="img-fluid">--}}
            {{--                            </li>--}}
            {{--                            <li data-target="#amazing-slider" data-slide-to="1" class="">--}}
            {{--                                <img src="{{ asset('/assets/newsite/images/slider-amazing/as-2.jpg') }}" class="img-fluid">--}}
            {{--                            </li>--}}
            {{--                            <li data-target="#amazing-slider" data-slide-to="2" class="">--}}
            {{--                                <img src="{{ asset('/assets/newsite/images/slider-amazing/as-3.jpg') }}" class="img-fluid">--}}
            {{--                            </li>--}}
            {{--                            <li data-target="#amazing-slider" data-slide-to="3" class="">--}}
            {{--                                <img src="{{ asset('/assets/newsite/images/slider-amazing/as-4.jpg') }}" class="img-fluid">--}}
            {{--                            </li>--}}
            {{--                            <li data-target="#amazing-slider" data-slide-to="4" class="">--}}
            {{--                                <img src="{{ asset('/assets/newsite/images/slider-amazing/as-5.jpg') }}" class="img-fluid">--}}
            {{--                            </li>--}}
            {{--                            <a class="carousel-control-prev" href="#amazing-slider" role="button" data-slide="prev">--}}
            {{--                                <span class="fa fa-angle-left" aria-hidden="true"></span>--}}
            {{--                                <span class="sr-only">Previous</span>--}}
            {{--                            </a>--}}
            {{--                            <a class="carousel-control-next" href="#amazing-slider" role="button" data-slide="next">--}}
            {{--                                <span class="fa fa-angle-right" aria-hidden="true"></span>--}}
            {{--                                <span class="sr-only">Next</span>--}}
            {{--                            </a>--}}
            {{--                        </ol>--}}
            {{--                        <div class="carousel-inner p-0 col-12">--}}
            {{--                            <div class="carousel-item active">--}}
            {{--                                <div class="row m-0">--}}
            {{--                                    <div class="right-col col-5 d-flex align-items-center">--}}
            {{--                                        <a class="w-100 text-center img-link-amazing" href="#">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/slider-amazing/as-1.jpg') }}" class="img-fluid"--}}
            {{--                                                 alt="">--}}
            {{--                                        </a>--}}
            {{--                                    </div>--}}
            {{--                                    <div class="col-7">--}}
            {{--                                        <div class="carousel-content">--}}
            {{--                                            <div class="discount">--}}
            {{--                                                    <span class="discount-percent">6.2--}}
            {{--                                                        <i class="fa fa-percent"></i>--}}
            {{--                                                    </span>--}}
            {{--                                            </div>--}}
            {{--                                            <h2 class="product-title">--}}
            {{--                                                <a href="#"> لپ تاپ ۱۵ اینچی ایسوس مدل VivoBook Flip TP510UQ – C--}}
            {{--                                                </a>--}}
            {{--                                            </h2>--}}
            {{--                                            <div class="price text-center">--}}
            {{--                                                <del><span>12,000,000<span>تومان</span></span></del>--}}
            {{--                                                <ins><span>11,180,000<span>تومان</span></span></ins>--}}
            {{--                                            </div>--}}
            {{--                                            <ul class="list-group">--}}
            {{--                                                <li class="list-group-item">--}}
            {{--                                                    <i class="mdi mdi-check text-success"></i>--}}
            {{--                                                    <span class="title">ظرفیت حافظه داخلی: </span>--}}
            {{--                                                    <span class="text">یک ترابایت </span>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="list-group-item">--}}
            {{--                                                    <i class="mdi mdi-check text-success"></i>--}}
            {{--                                                    <span class="title">ظرفیت حافظه رم: </span>--}}
            {{--                                                    <span class="text">8 گیگابایت </span>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="list-group-item">--}}
            {{--                                                    <i class="mdi mdi-check text-success"></i>--}}
            {{--                                                    <span class="title">سری پردازنده: </span>--}}
            {{--                                                    <span class="text">Core i5 </span>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="list-group-item">--}}
            {{--                                                    <i class="mdi mdi-check text-success"></i>--}}
            {{--                                                    <span class="title">دقت صفحه نمایش: </span>--}}
            {{--                                                    <span class="text"> 1080 × 1920 </span>--}}
            {{--                                                </li>--}}
            {{--                                            </ul>--}}
            {{--                                            <div class="countdown-timer">--}}
            {{--                                                <div class="countdown h4" data-date-time="10/10/2025 12:00"--}}
            {{--                                                     data-labels='{"label-day": "روز", "label-hour": "ساعت", "label-minute": "دقیقه", "label-second": "ثانیه"}'>--}}
            {{--                                                </div>--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="carousel-item">--}}
            {{--                                <div class="row m-0">--}}
            {{--                                    <div class="right-col col-5 d-flex align-items-center">--}}
            {{--                                        <a class="w-100 text-center img-link-amazing" href="#">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/slider-amazing/as-2.jpg') }}" class="img-fluid"--}}
            {{--                                                 alt="">--}}
            {{--                                        </a>--}}
            {{--                                    </div>--}}
            {{--                                    <div class="col-7">--}}
            {{--                                        <div class="carousel-content">--}}
            {{--                                            <div class="discount">--}}
            {{--                                                    <span class="discount-percent">3.2--}}
            {{--                                                        <i class="fa fa-percent"></i>--}}
            {{--                                                    </span>--}}
            {{--                                            </div>--}}
            {{--                                            <h2 class="product-title">--}}
            {{--                                                <a href="#"> یخچال و فریزر سامسونگ مدل HM34 </a>--}}
            {{--                                            </h2>--}}
            {{--                                            <div class="price text-center">--}}
            {{--                                                <del><span>9,000,000<span>تومان</span></span></del>--}}
            {{--                                                <ins><span>8,500,000<span>تومان</span></span></ins>--}}
            {{--                                            </div>--}}
            {{--                                            <ul class="list-group">--}}
            {{--                                                <li class="list-group-item">--}}
            {{--                                                    <i class="mdi mdi-check text-success"></i>--}}
            {{--                                                    <span class="title">قفل کودک: </span>--}}
            {{--                                                    <span class="text">دارد</span>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="list-group-item">--}}
            {{--                                                    <i class="mdi mdi-check text-success"></i>--}}
            {{--                                                    <span class="title">اخطار باز ماندن درب: </span>--}}
            {{--                                                    <span class="text">بله</span>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="list-group-item">--}}
            {{--                                                    <i class="mdi mdi-check text-success"></i>--}}
            {{--                                                    <span class="title">آبسردکن: </span>--}}
            {{--                                                    <span class="text">دارد</span>--}}
            {{--                                                </li>--}}
            {{--                                            </ul>--}}
            {{--                                            <div class="countdown-timer">--}}
            {{--                                                <div class="countdown h4" data-date-time="10/10/2025 12:00"--}}
            {{--                                                     data-labels='{"label-day": "روز", "label-hour": "ساعت", "label-minute": "دقیقه", "label-second": "ثانیه"}'>--}}
            {{--                                                </div>--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="carousel-item">--}}
            {{--                                <div class="row m-0">--}}
            {{--                                    <div class="right-col col-5 d-flex align-items-center">--}}
            {{--                                        <a class="w-100 text-center img-link-amazing" href="#">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/slider-amazing/as-3.jpg') }}" class="img-fluid"--}}
            {{--                                                 alt="">--}}
            {{--                                        </a>--}}
            {{--                                    </div>--}}
            {{--                                    <div class="col-7">--}}
            {{--                                        <div class="carousel-content">--}}
            {{--                                            <div class="discount">--}}
            {{--                                                    <span class="discount-percent">2.2--}}
            {{--                                                        <i class="fa fa-percent"></i>--}}
            {{--                                                    </span>--}}
            {{--                                            </div>--}}
            {{--                                            <h2 class="product-title">--}}
            {{--                                                <a href="#">کامپیوتر همه کاره 21.5 اینچی ایسوس مدل AIO V222UAK-B</a>--}}
            {{--                                            </h2>--}}
            {{--                                            <div class="price text-center">--}}
            {{--                                                <del><span>12,000,000<span>تومان</span></span></del>--}}
            {{--                                                <ins><span>11,180,000<span>تومان</span></span></ins>--}}
            {{--                                            </div>--}}
            {{--                                            <ul class="list-group">--}}
            {{--                                                <li class="list-group-item">--}}
            {{--                                                    <i class="mdi mdi-check text-success"></i>--}}
            {{--                                                    <span class="title">ظرفیت حافظه داخلی: </span>--}}
            {{--                                                    <span class="text">500 گیگابایت</span>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="list-group-item">--}}
            {{--                                                    <i class="mdi mdi-check text-success"></i>--}}
            {{--                                                    <span class="title">ظرفیت حافظه رم: </span>--}}
            {{--                                                    <span class="text">4 گیگابایت </span>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="list-group-item">--}}
            {{--                                                    <i class="mdi mdi-check text-success"></i>--}}
            {{--                                                    <span class="title">سری پردازنده: </span>--}}
            {{--                                                    <span class="text">Pentium </span>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="list-group-item">--}}
            {{--                                                    <i class="mdi mdi-check text-success"></i>--}}
            {{--                                                    <span class="title">دقت صفحه نمایش: </span>--}}
            {{--                                                    <span class="text"> 1080 × 1920 </span>--}}
            {{--                                                </li>--}}
            {{--                                            </ul>--}}
            {{--                                            <div class="countdown-timer">--}}
            {{--                                                <div class="countdown h4" data-date-time="10/10/2025 12:00"--}}
            {{--                                                     data-labels='{"label-day": "روز", "label-hour": "ساعت", "label-minute": "دقیقه", "label-second": "ثانیه"}'>--}}
            {{--                                                </div>--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="carousel-item">--}}
            {{--                                <div class="row m-0">--}}
            {{--                                    <div class="right-col col-5 d-flex align-items-center">--}}
            {{--                                        <a class="w-100 text-center img-link-amazing" href="#">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/slider-amazing/as-4.jpg') }}" class="img-fluid"--}}
            {{--                                                 alt="">--}}
            {{--                                        </a>--}}
            {{--                                    </div>--}}
            {{--                                    <div class="col-7">--}}
            {{--                                        <div class="carousel-content">--}}
            {{--                                            <div class="discount">--}}
            {{--                                                    <span class="discount-percent">4.2--}}
            {{--                                                        <i class="fa fa-percent"></i>--}}
            {{--                                                    </span>--}}
            {{--                                            </div>--}}
            {{--                                            <h2 class="product-title">--}}
            {{--                                                <a href="#">--}}
            {{--                                                    شارژر بی سیم مدل EP-NG930--}}
            {{--                                                </a>--}}
            {{--                                            </h2>--}}
            {{--                                            <div class="price text-center">--}}
            {{--                                                <del><span>8,000,000<span>تومان</span></span></del>--}}
            {{--                                                <ins><span>6,500,000<span>تومان</span></span></ins>--}}
            {{--                                            </div>--}}
            {{--                                            <ul class="list-group">--}}
            {{--                                                <li class="list-group-item">--}}
            {{--                                                    <i class="mdi mdi-check text-success"></i>--}}
            {{--                                                    <span class="title">شدت جریان خروجی: </span>--}}
            {{--                                                    <span class="text"> 2.0 آمپر مخصوص تبلت و موبایل </span>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="list-group-item">--}}
            {{--                                                    <i class="mdi mdi-check text-success"></i>--}}
            {{--                                                    <span class="title">تعداد درگاه خروجی: </span>--}}
            {{--                                                    <span class="text">1</span>--}}
            {{--                                                </li>--}}
            {{--                                            </ul>--}}
            {{--                                            <div class="countdown-timer">--}}
            {{--                                                <div class="countdown h4" data-date-time="10/10/2025 12:00"--}}
            {{--                                                     data-labels='{"label-day": "روز", "label-hour": "ساعت", "label-minute": "دقیقه", "label-second": "ثانیه"}'>--}}
            {{--                                                </div>--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="carousel-item  finished">--}}
            {{--                                <div class="row m-0">--}}
            {{--                                    <div class="right-col col-5 d-flex align-items-center">--}}
            {{--                                        <a class="w-100 text-center img-link-amazing" href="#">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/slider-amazing/as-5.jpg') }}" class="img-fluid"--}}
            {{--                                                 alt="">--}}
            {{--                                        </a>--}}
            {{--                                    </div>--}}
            {{--                                    <div class="col-7">--}}
            {{--                                        <div class="carousel-content">--}}
            {{--                                            <div class="discount">--}}
            {{--                                                    <span class="discount-percent">5.2--}}
            {{--                                                        <i class="fa fa-percent"></i>--}}
            {{--                                                    </span>--}}
            {{--                                            </div>--}}
            {{--                                            <h2 class="product-title">--}}
            {{--                                                <a href="#">--}}
            {{--                                                    تلویزیون ال ای دی هوشمند سامسونگ مدل 55NU7900 سایز 55 اینچ--}}
            {{--                                                </a>--}}
            {{--                                            </h2>--}}
            {{--                                            <div class="price text-center">--}}
            {{--                                                <del><span>14,500,000<span>تومان</span></span></del>--}}
            {{--                                                <ins><span>13,500,000<span>تومان</span></span></ins>--}}
            {{--                                            </div>--}}
            {{--                                            <ul class="list-group">--}}
            {{--                                                <li class="list-group-item">--}}
            {{--                                                    <i class="mdi mdi-check text-success"></i>--}}
            {{--                                                    <span class="title">درگاه USB: </span>--}}
            {{--                                                    <span class="text">دارد </span>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="list-group-item">--}}
            {{--                                                    <i class="mdi mdi-check text-success"></i>--}}
            {{--                                                    <span class="title">کیفیت تصویر: </span>--}}
            {{--                                                    <span class="text">Ultra HD - 4K</span>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="list-group-item">--}}
            {{--                                                    <i class="mdi mdi-check text-success"></i>--}}
            {{--                                                    <span class="title">رابط هوشمند: </span>--}}
            {{--                                                    <span class="text">دارد </span>--}}
            {{--                                                </li>--}}
            {{--                                            </ul>--}}
            {{--                                            <div class="countdown-timer">--}}
            {{--                                                <div class="countdown h4" data-date-time="10/10/2025 12:00"--}}
            {{--                                                     data-labels='{"label-day": "روز", "label-hour": "ساعت", "label-minute": "دقیقه", "label-second": "ثانیه"}'>--}}
            {{--                                                </div>--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </section>--}}
            {{--            </div>--}}
            {{--        </div>--}}
            <!-- slider-amazing------------------------>
        </div>
    </div>
    <!-- adplacement--------------------------->
    {{--<div class="container-main">--}}
    {{--    <div class="d-block">--}}
    {{--        <div class="adplacement-container-row">--}}
    {{--            <div class="col-12">--}}
    {{--                <a href="#" class="adplacement-item mb-4">--}}
    {{--                    <div class="adplacement-sponsored_box">--}}
    {{--                        <img src="{{ asset('/assets/newsite/images/adplacement/a-8.jpg') }}">--}}
    {{--                    </div>--}}
    {{--                </a>--}}
    {{--            </div>--}}
    {{--            <div class="col-6 col-lg-3 pr">--}}
    {{--                <a href="#" class="adplacement-item">--}}
    {{--                    <div class="adplacement-sponsored_box">--}}
    {{--                        <img src="{{ asset('/assets/newsite/images/adplacement/a-4.jpg') }}">--}}
    {{--                    </div>--}}
    {{--                </a>--}}
    {{--            </div>--}}
    {{--            <div class="col-6 col-lg-3 pr">--}}
    {{--                <a href="#" class="adplacement-item">--}}
    {{--                    <div class="adplacement-sponsored_box">--}}
    {{--                        <img src="{{ asset('/assets/newsite/images/adplacement/a-5.jpg') }}">--}}
    {{--                    </div>--}}
    {{--                </a>--}}
    {{--            </div>--}}
    {{--            <div class="col-6 col-lg-3 pr">--}}
    {{--                <a href="#" class="adplacement-item">--}}
    {{--                    <div class="adplacement-sponsored_box">--}}
    {{--                        <img src="{{ asset('/assets/newsite/images/adplacement/a-6.jpg') }}">--}}
    {{--                    </div>--}}
    {{--                </a>--}}
    {{--            </div>--}}
    {{--            <div class="col-6 col-lg-3 pr">--}}
    {{--                <a href="#" class="adplacement-item">--}}
    {{--                    <div class="adplacement-sponsored_box">--}}
    {{--                        <img src="{{ asset('/assets/newsite/images/adplacement/a-7.jpg') }}">--}}
    {{--                    </div>--}}
    {{--                </a>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--</div>--}}
    <!-- adplacement--------------------------->

    <!-- slidre-product------------------------>
    <div class="container-main">
        <div class="d-block">
            {{--        <div class="col-lg-9 col-md-9 col-xs-12 pr order-1 d-block">--}}
            {{--            <div class="slider-widget-products">--}}
            {{--                <div class="widget widget-product card">--}}
            {{--                    <header class="card-header">--}}
            {{--                        <span class="title-one">دوربین</span>--}}
            {{--                        <h3 class="card-title"></h3>--}}
            {{--                    </header>--}}
            {{--                    <div class="product-carousel owl-carousel owl-theme owl-rtl owl-loaded owl-drag">--}}
            {{--                        <div class="owl-stage-outer">--}}
            {{--                            <div class="owl-stage"--}}
            {{--                                 style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2234px;">--}}
            {{--                                <div class="owl-item active" style="width: 309.083px; margin-left: 10px;">--}}
            {{--                                    <div class="item">--}}
            {{--                                        <a href="#" class="d-block hover-img-link" data-toggle="modal"--}}
            {{--                                           data-target="#exampleModal">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/slider-product/camera-canon-4000D.jpg') }}"--}}
            {{--                                                 class="img-fluid" alt="">--}}
            {{--                                            <span class="icon-view">--}}
            {{--                                                    <strong><i class="fa fa-eye"></i></strong>--}}
            {{--                                                </span>--}}
            {{--                                        </a>--}}
            {{--                                        <h2 class="post-title">--}}
            {{--                                            <a href="#">--}}
            {{--                                                دوربین دیجیتال کانن مدل EOS 4000D به همراه لنز 18-55 میلی متر IS II--}}
            {{--                                            </a>--}}
            {{--                                        </h2>--}}
            {{--                                        <div class="price">--}}
            {{--                                            <del><span>۱۲,۰۰۰,۰۰<span>تومان</span></span></del>--}}
            {{--                                            <ins><span>۱۰,۵۰۰,۰۰۰<span>تومان</span></span></ins>--}}
            {{--                                        </div>--}}
            {{--                                        <div class="actions">--}}
            {{--                                            <ul>--}}
            {{--                                                <li class="action-item like">--}}
            {{--                                                    <button class="btn btn-light add-product-wishes" type="submit">--}}
            {{--                                                        <i class="fa fa-heart-o"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="action-item compare">--}}
            {{--                                                    <button class="btn btn-light btn-compare" type="submit">--}}
            {{--                                                        <i class="fa fa-random"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="action-item add-to-cart">--}}
            {{--                                                    <button class="btn btn-light btn-add-to-cart" type="submit">--}}
            {{--                                                        <i class="fa fa-shopping-cart"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                            </ul>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                                <div class="owl-item active" style="width: 309.083px; margin-left: 10px;">--}}
            {{--                                    <div class="item">--}}
            {{--                                        <a href="#" class="d-block hover-img-link" data-toggle="modal"--}}
            {{--                                           data-target="#exampleModal">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/slider-product/camera-samsung.jpg') }}"--}}
            {{--                                                 class="img-fluid" alt="">--}}
            {{--                                            <span class="icon-view">--}}
            {{--                                                    <strong><i class="fa fa-eye"></i></strong>--}}
            {{--                                                </span>--}}
            {{--                                        </a>--}}
            {{--                                        <h2 class="post-title">--}}
            {{--                                            <a href="#">--}}
            {{--                                                دوربین دیجیتال سامسونگ مدل ST150F--}}
            {{--                                            </a>--}}
            {{--                                        </h2>--}}
            {{--                                        <div class="price">--}}
            {{--                                            <del><span>۳,۲۰۰,۰۰۰<span>تومان</span></span></del>--}}
            {{--                                            <ins><span>۲,۵۰۰,۰۰۰<span>تومان</span></span></ins>--}}
            {{--                                        </div>--}}
            {{--                                        <div class="actions">--}}
            {{--                                            <ul>--}}
            {{--                                                <li class="action-item like">--}}
            {{--                                                    <button class="btn btn-light add-product-wishes" type="submit"--}}
            {{--                                                            data-toggle="tooltip" data-placement="top"--}}
            {{--                                                            title="Tooltip on top">--}}
            {{--                                                        <i class="fa fa-heart-o"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="action-item compare">--}}
            {{--                                                    <button class="btn btn-light btn-compare" type="submit">--}}
            {{--                                                        <i class="fa fa-random"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="action-item add-to-cart">--}}
            {{--                                                    <button class="btn btn-light btn-add-to-cart" type="submit">--}}
            {{--                                                        <i class="fa fa-shopping-cart"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                            </ul>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                                <div class="owl-item active" style="width: 309.083px; margin-left: 10px;">--}}
            {{--                                    <div class="item">--}}
            {{--                                        <a href="#" class="d-block hover-img-link" data-toggle="modal"--}}
            {{--                                           data-target="#exampleModal">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/slider-product/camera-nikon-3500D.jpg') }}"--}}
            {{--                                                 class="img-fluid" alt="">--}}
            {{--                                            <span class="icon-view">--}}
            {{--                                                    <strong><i class="fa fa-eye"></i></strong>--}}
            {{--                                                </span>--}}
            {{--                                        </a>--}}
            {{--                                        <h2 class="post-title">--}}
            {{--                                            <a href="#">--}}
            {{--                                                دوربین دیجیتال نیکون مدل D3500 به همراه لنز 18-55 میلی متر VR AF-P--}}
            {{--                                            </a>--}}
            {{--                                        </h2>--}}
            {{--                                        <div class="price">--}}
            {{--                                            <del><span>۳,۵۰۰,۰۰۰<span>تومان</span></span></del>--}}
            {{--                                            <ins><span>۲,۰۰۰,۰۰۰<span>تومان</span></span></ins>--}}
            {{--                                        </div>--}}
            {{--                                        <div class="actions">--}}
            {{--                                            <ul>--}}
            {{--                                                <li class="action-item like">--}}
            {{--                                                    <button class="btn btn-light add-product-wishes" type="submit"--}}
            {{--                                                            data-toggle="tooltip" data-placement="top"--}}
            {{--                                                            title="Tooltip on top">--}}
            {{--                                                        <i class="fa fa-heart-o"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="action-item compare">--}}
            {{--                                                    <button class="btn btn-light btn-compare" type="submit">--}}
            {{--                                                        <i class="fa fa-random"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="action-item add-to-cart">--}}
            {{--                                                    <button class="btn btn-light btn-add-to-cart" type="submit">--}}
            {{--                                                        <i class="fa fa-shopping-cart"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                            </ul>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                                <div class="owl-item active" style="width: 309.083px; margin-left: 10px;">--}}
            {{--                                    <div class="item">--}}
            {{--                                        <a href="#" class="d-block hover-img-link" data-toggle="modal"--}}
            {{--                                           data-target="#exampleModal">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/slider-product/camera-instax-mini-70.jpg') }}"--}}
            {{--                                                 class="img-fluid" alt="">--}}
            {{--                                            <span class="icon-view">--}}
            {{--                                                    <strong><i class="fa fa-eye"></i></strong>--}}
            {{--                                                </span>--}}
            {{--                                        </a>--}}
            {{--                                        <h2 class="post-title">--}}
            {{--                                            <a href="#">--}}
            {{--                                                دوربین عکاسی چاپ سریع فوجی فیلم مدل Instax mini 70--}}
            {{--                                            </a>--}}
            {{--                                        </h2>--}}
            {{--                                        <div class="price">--}}
            {{--                                            <del><span>۶,۵۰۰,۰۰۰<span>تومان</span></span></del>--}}
            {{--                                            <ins><span>۴,۲۰۰,۰۰۰<span>تومان</span></span></ins>--}}
            {{--                                        </div>--}}
            {{--                                        <div class="actions">--}}
            {{--                                            <ul>--}}
            {{--                                                <li class="action-item like">--}}
            {{--                                                    <button class="btn btn-light add-product-wishes" type="submit"--}}
            {{--                                                            data-toggle="tooltip" data-placement="top"--}}
            {{--                                                            title="Tooltip on top">--}}
            {{--                                                        <i class="fa fa-heart-o"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="action-item compare">--}}
            {{--                                                    <button class="btn btn-light btn-compare" type="submit">--}}
            {{--                                                        <i class="fa fa-random"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="action-item add-to-cart">--}}
            {{--                                                    <button class="btn btn-light btn-add-to-cart" type="submit">--}}
            {{--                                                        <i class="fa fa-shopping-cart"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                            </ul>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                                <div class="owl-item" style="width: 309.083px; margin-left: 10px;">--}}
            {{--                                    <div class="item">--}}
            {{--                                        <a href="#" class="d-block hover-img-link" data-toggle="modal"--}}
            {{--                                           data-target="#exampleModal">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/slider-product/camera-nikon.jpg') }}"--}}
            {{--                                                 class="img-fluid" alt="">--}}
            {{--                                            <span class="icon-view">--}}
            {{--                                                    <strong><i class="fa fa-eye"></i></strong>--}}
            {{--                                                </span>--}}
            {{--                                        </a>--}}
            {{--                                        <h2 class="post-title">--}}
            {{--                                            <a href="#">--}}
            {{--                                                دوربین دیجیتال بدون آینه نیکون مدل Z6 به همراه لنز 24-70 میلی متر--}}
            {{--                                                f/4 S--}}
            {{--                                            </a>--}}
            {{--                                        </h2>--}}
            {{--                                        <div class="price">--}}
            {{--                                            <del><span>۷,۵۰۰,۰۰۰<span>تومان</span></span></del>--}}
            {{--                                            <ins><span>۶,۰۰۰,۰۰۰<span>تومان</span></span></ins>--}}
            {{--                                        </div>--}}
            {{--                                        <div class="actions">--}}
            {{--                                            <ul>--}}
            {{--                                                <li class="action-item like">--}}
            {{--                                                    <button class="btn btn-light add-product-wishes" type="submit"--}}
            {{--                                                            data-toggle="tooltip" data-placement="top"--}}
            {{--                                                            title="Tooltip on top">--}}
            {{--                                                        <i class="fa fa-heart-o"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="action-item compare">--}}
            {{--                                                    <button class="btn btn-light btn-compare" type="submit">--}}
            {{--                                                        <i class="fa fa-random"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="action-item add-to-cart">--}}
            {{--                                                    <button class="btn btn-light btn-add-to-cart" type="submit">--}}
            {{--                                                        <i class="fa fa-shopping-cart"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                            </ul>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <!-- Modal -->--}}
            {{--                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"--}}
            {{--                     aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
            {{--                    <div class="modal-dialog">--}}
            {{--                        <div class="modal-content">--}}
            {{--                            <div class="modal-header">--}}
            {{--                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
            {{--                                    <span aria-hidden="true">&times;</span>--}}
            {{--                                </button>--}}
            {{--                            </div>--}}
            {{--                            <div class="modal-body">--}}
            {{--                                <div class="col-lg-6 pr">--}}
            {{--                                    <div class="thum-img">--}}
            {{--                                        <div class="widget widget-product card mb-0">--}}
            {{--                                            <div--}}
            {{--                                                class="product-carousel-more owl-carousel owl-theme owl-rtl owl-loaded owl-drag">--}}
            {{--                                                <div class="owl-stage-outer">--}}
            {{--                                                    <div class="owl-stage"--}}
            {{--                                                         style="transform: translate3d(1652px, 0px, 0px); transition: all 0.25s ease 0s; width: 2065px;">--}}
            {{--                                                        <div class="owl-item"--}}
            {{--                                                             style="width: 403px; margin-left: 10px;">--}}
            {{--                                                            <div class="item">--}}
            {{--                                                                <a href="#" class="d-block hover-img-link"--}}
            {{--                                                                   data-toggle="modal" data-target="#exampleModal">--}}
            {{--                                                                    <div class="zoom-box">--}}
            {{--                                                                        <img src="{{ asset('/assets/newsite/images/slider-product/computer-appel.jpg') }}"--}}
            {{--                                                                             width="200" height="150" />--}}
            {{--                                                                        <div class="discount-m">--}}
            {{--                                                                            <span>10%</span>--}}
            {{--                                                                        </div>--}}
            {{--                                                                    </div>--}}
            {{--                                                                </a>--}}
            {{--                                                            </div>--}}
            {{--                                                        </div>--}}
            {{--                                                        <div class="owl-item"--}}
            {{--                                                             style="width: 403px; margin-left: 10px;">--}}
            {{--                                                            <div class="item">--}}
            {{--                                                                <a href="#" class="d-block hover-img-link"--}}
            {{--                                                                   data-toggle="modal" data-target="#exampleModal">--}}
            {{--                                                                    <div class="zoom-box">--}}
            {{--                                                                        <img src="{{ asset('/assets/newsite/images/slider-product/computer-appel.jpg') }}"--}}
            {{--                                                                             width="200" height="150" />--}}
            {{--                                                                        <div class="discount-m">--}}
            {{--                                                                            <span>10%</span>--}}
            {{--                                                                        </div>--}}
            {{--                                                                    </div>--}}
            {{--                                                                </a>--}}
            {{--                                                            </div>--}}
            {{--                                                        </div>--}}
            {{--                                                        <div class="owl-item"--}}
            {{--                                                             style="width: 403px; margin-left: 10px;">--}}
            {{--                                                            <div class="item">--}}
            {{--                                                                <a href="#" class="d-block hover-img-link"--}}
            {{--                                                                   data-toggle="modal" data-target="#exampleModal">--}}
            {{--                                                                    <div class="zoom-box">--}}
            {{--                                                                        <img src="{{ asset('/assets/newsite/images/slider-product/computer-appel.jpg') }}"--}}
            {{--                                                                             width="200" height="150" />--}}
            {{--                                                                        <div class="discount-m">--}}
            {{--                                                                            <span>10%</span>--}}
            {{--                                                                        </div>--}}
            {{--                                                                    </div>--}}
            {{--                                                                </a>--}}
            {{--                                                            </div>--}}
            {{--                                                        </div>--}}
            {{--                                                        <div class="owl-item"--}}
            {{--                                                             style="width: 403px; margin-left: 10px;">--}}
            {{--                                                            <div class="item">--}}
            {{--                                                                <a href="#" class="d-block hover-img-link"--}}
            {{--                                                                   data-toggle="modal" data-target="#exampleModal">--}}
            {{--                                                                    <div class="zoom-box">--}}
            {{--                                                                        <img src="{{ asset('/assets/newsite/images/slider-product/computer-appel.jpg') }}"--}}
            {{--                                                                             width="200" height="150" />--}}
            {{--                                                                        <div class="discount-m">--}}
            {{--                                                                            <span>10%</span>--}}
            {{--                                                                        </div>--}}
            {{--                                                                    </div>--}}
            {{--                                                                </a>--}}
            {{--                                                            </div>--}}
            {{--                                                        </div>--}}
            {{--                                                        <div class="owl-item active"--}}
            {{--                                                             style="width: 403px; margin-left: 10px;">--}}
            {{--                                                            <div class="item">--}}
            {{--                                                                <a href="#" class="d-block hover-img-link"--}}
            {{--                                                                   data-toggle="modal" data-target="#exampleModal">--}}
            {{--                                                                    <div class="zoom-box">--}}
            {{--                                                                        <img src="{{ asset('/assets/newsite/images/slider-product/computer-appel.jpg') }}"--}}
            {{--                                                                             width="200" height="150" />--}}
            {{--                                                                        <div class="discount-m">--}}
            {{--                                                                            <span>10%</span>--}}
            {{--                                                                        </div>--}}
            {{--                                                                    </div>--}}
            {{--                                                                </a>--}}
            {{--                                                            </div>--}}
            {{--                                                        </div>--}}
            {{--                                                    </div>--}}
            {{--                                                </div>--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                                <div class="col-lg-6 pr">--}}
            {{--                                    <div class="product-box-modal-title">--}}
            {{--                                        <h2 class="post-title">--}}
            {{--                                            <a href="#">--}}
            {{--                                                کامپیوتر همه کاره 27 اینچی اپل مدل iMac CTO - A 2019 با صفحه نمایش--}}
            {{--                                                رتینا 5K--}}
            {{--                                            </a>--}}
            {{--                                        </h2>--}}
            {{--                                    </div>--}}
            {{--                                    <div class="small-gutters align-items-stretch mb-4">--}}
            {{--                                        <div class="col-lg-12 pr-0 pl-0 pr">--}}
            {{--                                            <div class="product-box-modal_price mt-12 mt-auto">--}}
            {{--                                                <div class="price">--}}
            {{--                                                    <del><span>۳,۵۰۰,۰۰۰<span>تومان</span></span></del>--}}
            {{--                                                    <ins><span>۲,۰۰۰,۰۰۰<span>تومان</span></span></ins>--}}
            {{--                                                </div>--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                        <div class="small-gutters">--}}
            {{--                                            <div class="col-lg-12 mb-8 pr-0 pl-0 pr mt-3">--}}
            {{--                                                <div class="product-box_action">--}}
            {{--                                                    <button class="btn btn-gradient-primary add-to-cart"--}}
            {{--                                                            type="submit">افزودن به سبد</button>--}}
            {{--                                                    <a href="#" class="btn btn-outline-dark btn-block">مشاهده--}}
            {{--                                                        جزئیات</a>--}}
            {{--                                                </div>--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--        </div>--}}
            <!-- slider-moment------------------------->
            {{--        <div class="col-lg-3 col-md-3 col-xs-12 pl order-1 d-block">--}}
            {{--            <div class="slider-moments">--}}
            {{--                <div class="widget-suggestion widget card">--}}
            {{--                    <header class="card-header promo-single-headline">--}}
            {{--                        <h3 class="card-title float-none">پیشنهاد لحظه‌ای</h3>--}}
            {{--                    </header>--}}
            {{--                    <div id="suggestion-slider" class="owl-carousel owl-theme owl-rtl owl-loaded owl-drag">--}}
            {{--                        <div class="owl-stage-outer">--}}
            {{--                            <div class="owl-stage"--}}
            {{--                                 style="transform: translate3d(1369px, 0px, 0px); transition: all 0.25s ease 0s; width: 2190px;">--}}
            {{--                                <div class="owl-item cloned" style="width: 273.75px;">--}}
            {{--                                    <div class="item">--}}
            {{--                                        <a href="#">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/slider-moment/sm-1.jpg') }}" class="w-100" alt="">--}}
            {{--                                        </a>--}}
            {{--                                        <h3 class="product-title">--}}
            {{--                                            <a href="#"> تیشرت آستین کوتاه مردانه مدل T41 </a>--}}
            {{--                                        </h3>--}}
            {{--                                        <div class="price">--}}
            {{--                                                <span class="amount">۲۳,۰۰۰--}}
            {{--                                                    <span>تومان</span>--}}
            {{--                                                </span>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                                <div class="owl-item cloned" style="width: 273.75px;">--}}
            {{--                                    <div class="item">--}}
            {{--                                        <a href="#">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/slider-moment/sm-2.jpg') }}" class="w-100" alt="">--}}
            {{--                                        </a>--}}
            {{--                                        <h3 class="product-title">--}}
            {{--                                            <a href="#">تی شرت آستین کوتاه تارکان کد btt 152-1</a>--}}
            {{--                                        </h3>--}}
            {{--                                        <div class="price">--}}
            {{--                                                <span class="amount">۵۹,۰۰۰--}}
            {{--                                                    <span>تومان</span>--}}
            {{--                                                </span>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                                <div class="owl-item" style="width: 273.75px;">--}}
            {{--                                    <div class="item">--}}
            {{--                                        <a href="#">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/slider-moment/sm-3.jpg') }}" class="w-100" alt="">--}}
            {{--                                        </a>--}}
            {{--                                        <h3 class="product-title">--}}
            {{--                                            <a href="#"> لپ تاپ 17 اینچی ایسوس مدل VivoBook A712FB-P </a>--}}
            {{--                                        </h3>--}}
            {{--                                        <div class="price">--}}
            {{--                                                <span class="amount">۱۳,۰۰۰,۰۰۰--}}
            {{--                                                    <span>تومان</span>--}}
            {{--                                                </span>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                                <div class="owl-item" style="width: 273.75px;">--}}
            {{--                                    <div class="item">--}}
            {{--                                        <a href="#">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/slider-moment/sm-4.jpg') }}" class="w-100" alt="">--}}
            {{--                                        </a>--}}
            {{--                                        <h3 class="product-title">--}}
            {{--                                            <a href="#"> لپ تاپ 16 اینچی اپل مدل MacBook Pro MVVK2 2019 همراه با تاچ--}}
            {{--                                                بار--}}
            {{--                                            </a>--}}
            {{--                                        </h3>--}}
            {{--                                        <div class="price">--}}
            {{--                                                <span class="amount">۴۷,۰۰۰,۰۰۰--}}
            {{--                                                    <span>تومان</span>--}}
            {{--                                                </span>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                                <div class="owl-item" style="width: 273.75px;">--}}
            {{--                                    <div class="item">--}}
            {{--                                        <a href="#">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/slider-moment/sm-5.jpg') }}" class="w-100" alt="">--}}
            {{--                                        </a>--}}
            {{--                                        <h3 class="product-title">--}}
            {{--                                            <a href="#">گوشی موبایل سامسونگ مدل Galaxy S10 SM-G973F/DS دو سیم کارت--}}
            {{--                                                ظرفیت 128 گیگابایت--}}
            {{--                                            </a>--}}
            {{--                                        </h3>--}}
            {{--                                        <div class="price">--}}
            {{--                                                <span class="amount">۱۱,۰۰۰,۰۰۰--}}
            {{--                                                    <span>تومان</span>--}}
            {{--                                                </span>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}

            {{--                    <div id="progressBar">--}}
            {{--                        <div class="slide-progress" style="width: 100%; transition: width 5000ms ease 0s;"></div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--        </div>--}}
            <!-- slider-moment------------------------->
            <div class="col-lg-12 col-md-12 col-xs-12 pr order-1 d-block">
                <div class="slider-widget-products">
                    <div class="widget widget-product card">
                        <header class="card-header">
                            <span class="title-one">محصولات</span>
                            <h3 class="card-title"></h3>
                        </header>
                        <div class="product-carousel owl-carousel owl-theme owl-rtl owl-loaded owl-drag">
                            <div class="owl-stage-outer">
                                <div class="owl-stage"
                                     style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2234px;">
                                    @foreach($products as $product)
                                        <div class="owl-item" style="width: 309.083px; margin-left: 10px;">
                                            <a href="{{route('home.products.show', $product->slug)}}">
                                                <div class="item" style="border-radius: 10px;">
                                                    <a href="{{route('home.products.show', $product->slug)}}"
                                                       class="d-block hover-img-link" data-toggle="modal"
                                                       data-target="#exampleModal">
                                                        <img
                                                            src="{{asset(env('PRODUCT_IMAGES_UPLOAD_PATH').$product->primary_image)}}"
                                                            class="img-fluid" alt="" style="border-radius: 10px;">
                                                        {{--                                                    <span class="icon-view">--}}
                                                        {{--                                                    <strong><i class="fa fa-eye"></i></strong>--}}
                                                        {{--                                                </span>--}}
                                                    </a>
                                                    <h2 class="post-title">
                                                        <a href="{{route('home.products.show', $product->slug)}}">
                                                            {{$product->name}}
                                                        </a>
                                                    </h2>
                                                    <div class="price">
                                                        @if($product->check_quantity)
                                                            @if($product->check_sale)

                                                                <del>
                                                                    <span>{{number_format($product->check_sale->price)}}<span>تومان</span></span>
                                                                </del>
                                                                <ins><span>{{number_format($product->check_sale->sale_price)}}<span>تومان</span></span>
                                                                </ins>
                                                            @else
                                                                <ins>
                                                                    <span>{{number_format($product->check_price->price)}}<span>تومان</span></span>
                                                                    -
                                                                    <span>{{number_format($product->expensive_price->price)}}<span>تومان</span></span>
                                                                </ins>
                                                            @endif
                                                        @else
                                                            <del><span>ناموجود</span></del>
                                                        @endif
                                                    </div>
                                                    {{--                                                <div class="actions">--}}
                                                    {{--                                                    <ul>--}}
                                                    {{--                                                        <li class="action-item like">--}}
                                                    {{--                                                            <button class="btn btn-light add-product-wishes"--}}
                                                    {{--                                                                    type="submit"--}}
                                                    {{--                                                                    data-toggle="tooltip" data-placement="top"--}}
                                                    {{--                                                                    title="Tooltip on top">--}}
                                                    {{--                                                                <i class="fa fa-heart-o"></i>--}}
                                                    {{--                                                            </button>--}}
                                                    {{--                                                        </li>--}}
                                                    {{--                                                        <li class="action-item compare">--}}
                                                    {{--                                                            <button class="btn btn-light btn-compare" type="submit">--}}
                                                    {{--                                                                <i class="fa fa-random"></i>--}}
                                                    {{--                                                            </button>--}}
                                                    {{--                                                        </li>--}}
                                                    {{--                                                        <li class="action-item add-to-cart">--}}
                                                    {{--                                                            <button class="btn btn-light btn-add-to-cart" type="submit">--}}
                                                    {{--                                                                <i class="fa fa-shopping-cart"></i>--}}
                                                    {{--                                                            </button>--}}
                                                    {{--                                                        </li>--}}
                                                    {{--                                                    </ul>--}}
                                                    {{--                                                </div>--}}
                                                    <a class="btn btn-primary" href="{{route('home.products.show', $product->slug)}}">مشاهده و خرید</a>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--        <div class="col-lg-12 col-md-12 col-xs-12 pr order-1 d-block">--}}
            {{--            <div class="slider-widget-products">--}}
            {{--                <div class="widget widget-product card">--}}
            {{--                    <header class="card-header">--}}
            {{--                        <span class="title-one">لوازم خانگی</span>--}}
            {{--                        <h3 class="card-title"></h3>--}}
            {{--                    </header>--}}
            {{--                    <div class="product-carousel owl-carousel owl-theme owl-rtl owl-loaded owl-drag">--}}
            {{--                        <div class="owl-stage-outer">--}}
            {{--                            <div class="owl-stage"--}}
            {{--                                 style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2234px;">--}}
            {{--                                <div class="owl-item active" style="width: 309.083px; margin-left: 10px;">--}}
            {{--                                    <div class="item">--}}
            {{--                                        <a href="#" class="d-block hover-img-link" data-toggle="modal"--}}
            {{--                                           data-target="#exampleModal">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/slider-product/Stove-lopez.jpg') }}"--}}
            {{--                                                 class="img-fluid" alt="">--}}
            {{--                                            <span class="icon-view">--}}
            {{--                                                    <strong><i class="fa fa-eye"></i></strong>--}}
            {{--                                                </span>--}}
            {{--                                        </a>--}}
            {{--                                        <h2 class="post-title">--}}
            {{--                                            <a href="#">--}}
            {{--                                                اجاق گاز طرح فر لوپز مدل 10000S--}}
            {{--                                            </a>--}}
            {{--                                        </h2>--}}
            {{--                                        <div class="price">--}}
            {{--                                            <del><span>۱۲,۰۰۰,۰۰۰<span>تومان</span></span></del>--}}
            {{--                                            <ins><span>۱۰,۵۰۰,۰۰۰<span>تومان</span></span></ins>--}}
            {{--                                        </div>--}}
            {{--                                        <div class="actions">--}}
            {{--                                            <ul>--}}
            {{--                                                <li class="action-item like">--}}
            {{--                                                    <button class="btn btn-light add-product-wishes" type="submit"--}}
            {{--                                                            data-toggle="tooltip" data-placement="top"--}}
            {{--                                                            title="Tooltip on top">--}}
            {{--                                                        <i class="fa fa-heart-o"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="action-item compare">--}}
            {{--                                                    <button class="btn btn-light btn-compare" type="submit">--}}
            {{--                                                        <i class="fa fa-random"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="action-item add-to-cart">--}}
            {{--                                                    <button class="btn btn-light btn-add-to-cart" type="submit">--}}
            {{--                                                        <i class="fa fa-shopping-cart"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                            </ul>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                                <div class="owl-item active" style="width: 309.083px; margin-left: 10px;">--}}
            {{--                                    <div class="item">--}}
            {{--                                        <a href="#" class="d-block hover-img-link" data-toggle="modal"--}}
            {{--                                           data-target="#exampleModal">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/slider-product/SWF-40R.jpg') }}" class="img-fluid"--}}
            {{--                                                 alt="">--}}
            {{--                                            <span class="icon-view">--}}
            {{--                                                    <strong><i class="fa fa-eye"></i></strong>--}}
            {{--                                                </span>--}}
            {{--                                        </a>--}}
            {{--                                        <h2 class="post-title">--}}
            {{--                                            <a href="#">--}}
            {{--                                                آون توستر سان ورد مدل SWF-40R--}}
            {{--                                            </a>--}}
            {{--                                        </h2>--}}
            {{--                                        <div class="price">--}}
            {{--                                            <del><span>۳,۲۰۰,۰۰۰<span>تومان</span></span></del>--}}
            {{--                                            <ins><span>۲,۵۰۰,۰۰۰<span>تومان</span></span></ins>--}}
            {{--                                        </div>--}}
            {{--                                        <div class="actions">--}}
            {{--                                            <ul>--}}
            {{--                                                <li class="action-item like">--}}
            {{--                                                    <button class="btn btn-light add-product-wishes" type="submit"--}}
            {{--                                                            data-toggle="tooltip" data-placement="top"--}}
            {{--                                                            title="Tooltip on top">--}}
            {{--                                                        <i class="fa fa-heart-o"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="action-item compare">--}}
            {{--                                                    <button class="btn btn-light btn-compare" type="submit">--}}
            {{--                                                        <i class="fa fa-random"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="action-item add-to-cart">--}}
            {{--                                                    <button class="btn btn-light btn-add-to-cart" type="submit">--}}
            {{--                                                        <i class="fa fa-shopping-cart"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                            </ul>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                                <div class="owl-item active" style="width: 309.083px; margin-left: 10px;">--}}
            {{--                                    <div class="item">--}}
            {{--                                        <a href="#" class="d-block hover-img-link" data-toggle="modal"--}}
            {{--                                           data-target="#exampleModal">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/slider-product/ECM2013.jpg') }}" class="img-fluid"--}}
            {{--                                                 alt="">--}}
            {{--                                            <span class="icon-view">--}}
            {{--                                                    <strong><i class="fa fa-eye"></i></strong>--}}
            {{--                                                </span>--}}
            {{--                                        </a>--}}
            {{--                                        <h2 class="post-title">--}}
            {{--                                            <a href="#">--}}
            {{--                                                اسپرسوساز مباشی مدل ECM2013--}}
            {{--                                            </a>--}}
            {{--                                        </h2>--}}
            {{--                                        <div class="price">--}}
            {{--                                            <del><span>۳,۵۰۰,۰۰۰<span>تومان</span></span></del>--}}
            {{--                                            <ins><span>۲,۰۰۰,۰۰۰<span>تومان</span></span></ins>--}}
            {{--                                        </div>--}}
            {{--                                        <div class="actions">--}}
            {{--                                            <ul>--}}
            {{--                                                <li class="action-item like">--}}
            {{--                                                    <button class="btn btn-light add-product-wishes" type="submit"--}}
            {{--                                                            data-toggle="tooltip" data-placement="top"--}}
            {{--                                                            title="Tooltip on top">--}}
            {{--                                                        <i class="fa fa-heart-o"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="action-item compare">--}}
            {{--                                                    <button class="btn btn-light btn-compare" type="submit">--}}
            {{--                                                        <i class="fa fa-random"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="action-item add-to-cart">--}}
            {{--                                                    <button class="btn btn-light btn-add-to-cart" type="submit">--}}
            {{--                                                        <i class="fa fa-shopping-cart"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                            </ul>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                                <div class="owl-item active" style="width: 309.083px; margin-left: 10px;">--}}
            {{--                                    <div class="item">--}}
            {{--                                        <a href="#" class="d-block hover-img-link" data-toggle="modal"--}}
            {{--                                           data-target="#exampleModal">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/slider-product/DNR 290T-366T.jpg') }}"--}}
            {{--                                                 class="img-fluid" alt="">--}}
            {{--                                            <span class="icon-view">--}}
            {{--                                                    <strong><i class="fa fa-eye"></i></strong>--}}
            {{--                                                </span>--}}
            {{--                                        </a>--}}
            {{--                                        <h2 class="post-title">--}}
            {{--                                            <a href="#">--}}
            {{--                                                یخچال و فریزر دو قلوی دونار مدل DNR 290T-366T--}}
            {{--                                            </a>--}}
            {{--                                        </h2>--}}
            {{--                                        <div class="price">--}}
            {{--                                            <del><span>۶,۵۰۰,۰۰۰<span>تومان</span></span></del>--}}
            {{--                                            <ins><span>۴,۲۰۰,۰۰۰<span>تومان</span></span></ins>--}}
            {{--                                        </div>--}}
            {{--                                        <div class="actions">--}}
            {{--                                            <ul>--}}
            {{--                                                <li class="action-item like">--}}
            {{--                                                    <button class="btn btn-light add-product-wishes" type="submit"--}}
            {{--                                                            data-toggle="tooltip" data-placement="top"--}}
            {{--                                                            title="Tooltip on top">--}}
            {{--                                                        <i class="fa fa-heart-o"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="action-item compare">--}}
            {{--                                                    <button class="btn btn-light btn-compare" type="submit">--}}
            {{--                                                        <i class="fa fa-random"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="action-item add-to-cart">--}}
            {{--                                                    <button class="btn btn-light btn-add-to-cart" type="submit">--}}
            {{--                                                        <i class="fa fa-shopping-cart"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                            </ul>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                                <div class="owl-item" style="width: 309.083px; margin-left: 10px;">--}}
            {{--                                    <div class="item">--}}
            {{--                                        <a href="#" class="d-block hover-img-link" data-toggle="modal"--}}
            {{--                                           data-target="#exampleModal">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/slider-product/Avocado.jpg') }}" class="img-fluid"--}}
            {{--                                                 alt="">--}}
            {{--                                            <span class="icon-view">--}}
            {{--                                                    <strong><i class="fa fa-eye"></i></strong>--}}
            {{--                                                </span>--}}
            {{--                                        </a>--}}
            {{--                                        <h2 class="post-title">--}}
            {{--                                            <a href="#">--}}
            {{--                                                آب میوه گیری پارس خزر مدل Avocado--}}
            {{--                                            </a>--}}
            {{--                                        </h2>--}}
            {{--                                        <div class="price">--}}
            {{--                                            <del><span>۷,۵۰۰,۰۰۰<span>تومان</span></span></del>--}}
            {{--                                            <ins><span>۶,۰۰۰,۰۰۰<span>تومان</span></span></ins>--}}
            {{--                                        </div>--}}
            {{--                                        <div class="actions">--}}
            {{--                                            <ul>--}}
            {{--                                                <li class="action-item like">--}}
            {{--                                                    <button class="btn btn-light add-product-wishes" type="submit"--}}
            {{--                                                            data-toggle="tooltip" data-placement="top"--}}
            {{--                                                            title="Tooltip on top">--}}
            {{--                                                        <i class="fa fa-heart-o"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="action-item compare">--}}
            {{--                                                    <button class="btn btn-light btn-compare" type="submit">--}}
            {{--                                                        <i class="fa fa-random"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="action-item add-to-cart">--}}
            {{--                                                    <button class="btn btn-light btn-add-to-cart" type="submit">--}}
            {{--                                                        <i class="fa fa-shopping-cart"></i>--}}
            {{--                                                    </button>--}}
            {{--                                                </li>--}}
            {{--                                            </ul>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--        </div>--}}
            <!-- brand--------------------------------------->
            {{--        <div class="col-lg-12 col-md-12 col-xs-12 pr order-1 d-block">--}}
            {{--            <div class="slider-widget-products">--}}
            {{--                <div class="widget widget-product card mb-0">--}}
            {{--                    <div class="product-carousel-brand owl-carousel owl-theme owl-rtl owl-loaded owl-drag">--}}
            {{--                        <div class="owl-stage-outer">--}}
            {{--                            <div class="owl-stage"--}}
            {{--                                 style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2234px;">--}}
            {{--                                <div class="owl-item active" style="width: 190.75px; margin-left: 10px;">--}}
            {{--                                    <div class="item">--}}
            {{--                                        <a href="#" class="d-block hover-img-link">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/brand/shahab.png') }}" class="img-fluid img-brand"--}}
            {{--                                                 alt="">--}}
            {{--                                        </a>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                                <div class="owl-item active" style="width: 190.75px; margin-left: 10px;">--}}
            {{--                                    <div class="item">--}}
            {{--                                        <a href="#" class="d-block hover-img-link mt-0">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/brand/adata.png') }}" class="img-fluid img-brand"--}}
            {{--                                                 alt="">--}}
            {{--                                        </a>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                                <div class="owl-item active" style="width: 190.75px; margin-left: 10px;">--}}
            {{--                                    <div class="item">--}}
            {{--                                        <a href="#" class="d-block hover-img-link mt-0">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/brand/huawei.png') }}" class="img-fluid img-brand"--}}
            {{--                                                 alt="">--}}
            {{--                                        </a>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                                <div class="owl-item active" style="width: 190.75px; margin-left: 10px;">--}}
            {{--                                    <div class="item">--}}
            {{--                                        <a href="#" class="d-block hover-img-link mt-0">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/brand/nokia.png') }}" class="img-fluid img-brand"--}}
            {{--                                                 alt="">--}}
            {{--                                        </a>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                                <div class="owl-item active" style="width: 190.75px; margin-left: 10px;">--}}
            {{--                                    <div class="item">--}}
            {{--                                        <a href="#" class="d-block hover-img-link mt-0">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/brand/panasonic.png') }}" class="img-fluid img-brand"--}}
            {{--                                                 alt="">--}}
            {{--                                        </a>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                                <div class="owl-item active" style="width: 190.75px; margin-left: 10px;">--}}
            {{--                                    <div class="item">--}}
            {{--                                        <a href="#" class="d-block hover-img-link mt-0">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/brand/parskhazar.png') }}"--}}
            {{--                                                 class="img-fluid img-brand" alt="">--}}
            {{--                                        </a>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                                <div class="owl-item active" style="width: 190.75px; margin-left: 10px;">--}}
            {{--                                    <div class="item">--}}
            {{--                                        <a href="#" class="d-block hover-img-link mt-0">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/brand/samsung.png') }}" class="img-fluid img-brand"--}}
            {{--                                                 alt="">--}}
            {{--                                        </a>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                                <div class="owl-item active" style="width: 190.75px; margin-left: 10px;">--}}
            {{--                                    <div class="item">--}}
            {{--                                        <a href="#" class="d-block hover-img-link mt-0">--}}
            {{--                                            <img src="{{ asset('/assets/newsite/images/brand/xvison.png') }}" class="img-fluid img-brand"--}}
            {{--                                                 alt="">--}}
            {{--                                        </a>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--        </div>--}}
            <!-- brand----------------------------------------->
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            let variation = JSON.parse($('.variation-select').val());
            $('.quantity-value').attr('data-max', variation.quantity);
        });
        $('.variation-select').on('change', function () {
            let variation = JSON.parse(this.value);
            let variationPriceDiv = $('.variation-price-' + $(this).data('id'));
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
    </script>
@endsection
