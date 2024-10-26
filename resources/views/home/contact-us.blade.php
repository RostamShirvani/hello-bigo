@extends('home.layouts.home')

@section('title')
    تماس با ما
@endsection

@section('style')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
          integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
          crossorigin=""/>
@endsection
@section('content')
    <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="index.html">صفحه ای اصلی</a>
                    </li>
                    <li class="active">فروشگاه</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="contact-area pt-100 pb-100">
        <div class="container">
            <div class="row text-right" style="direction: rtl;">
                <div class="col-lg-12 col-md-12">
                    <div class="contact-info-area">
                        <h2> بیگو پلاس </h2>
                        <p>
                            فروشگاه اینترنتی Bigoplus امن ترین و سریع ترین فروشگاه اینترنتی خرید الماس بیگولایو و لایکی را به صورت کاملا اتوماتیک در اختیار شما مشتریان گرامی قرار داده است .اکانت  شما پس از پرداخت در عرض کمتر از ده ثانیه توسط سیستم اتوماتیک  ما شارژ خواهد شد و نگرانی از بابت ثبت و خرید الماس خود نداشته باشید. پشتیبانان تیم بیگو پلاس از طریق واتساپ همواره در خدمت شما مشتریان گرامی میباشد.
                        </p>
                        <div class="contact-info-wrap">
{{--                            <div class="single-contact-info">--}}
{{--                                <div class="contact-info-icon">--}}
{{--                                    <i class="sli sli-location-pin"></i>--}}
{{--                                </div>--}}
{{--                                <div class="contact-info-content">--}}
{{--                                    <p>{{$setting->address}}</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="single-contact-info">--}}
{{--                                <div class="contact-info-icon">--}}
{{--                                    <i class="sli sli-envelope"></i>--}}
{{--                                </div>--}}
{{--                                <div class="contact-info-content">--}}
{{--                                    <p><a href="#">info@example.com</a> / <a href="#">info@example.com</a></p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="single-contact-info">
                                <div class="contact-info-icon">
                                    <i class="sli sli-screen-smartphone"></i>
                                </div>
                                <div class="contact-info-content">
{{--                                    <p style="direction: ltr;"> {{$setting->telephone}} / {{$setting->telephone2}} </p>--}}
                                    <p style="direction: ltr;">شماره واتساپ {{$setting->telephone}} </p>
                                </div>
                            </div>
                            <p>ساعت پاسخگویی
                                <br>
                                ساعت 8 تا 24
                                <br>
                                روزهای تعطیل 10 تا 24</p>
                        </div>
                    </div>
                </div>
{{--                <div class="col-lg-7 col-md-6">--}}
{{--                    <div class="contact-from contact-shadow">--}}
{{--                        <form id="contact-form" action="{{route('home.contact-us.form')}}" method="post">--}}
{{--                            @csrf--}}
{{--                            <input name="name" type="text" placeholder="نام شما" value="{{old('name')}}">--}}
{{--                            @error('name')--}}
{{--                            <p class="input-error-validation">--}}
{{--                                <strong>{{$message}}</strong>--}}
{{--                            </p>--}}
{{--                            @enderror--}}
{{--                            <input name="email" type="email" placeholder="ایمیل شما" value="{{old('email')}}">--}}
{{--                            @error('email')--}}
{{--                            <p class="input-error-validation">--}}
{{--                                <strong>{{$message}}</strong>--}}
{{--                            </p>--}}
{{--                            @enderror--}}
{{--                            <input name="subject" type="text" placeholder="موضوع پیام" value="{{old('subject')}}">--}}
{{--                            @error('subject')--}}
{{--                            <p class="input-error-validation">--}}
{{--                                <strong>{{$message}}</strong>--}}
{{--                            </p>--}}
{{--                            @enderror--}}
{{--                            <textarea name="text" placeholder="متن پیام">{{old('text')}}</textarea>--}}
{{--                            @error('text')--}}
{{--                            <p class="input-error-validation">--}}
{{--                                <strong>{{$message}}</strong>--}}
{{--                            </p>--}}
{{--                            @enderror--}}
{{--                            <div id="contact_us_id"></div>--}}
{{--                            @error('g-recaptcha-response')--}}
{{--                            <p class="input-error-validation">--}}
{{--                                <strong>{{$message}}</strong>--}}
{{--                            </p>--}}
{{--                            @enderror--}}
{{--                            <button class="submit" type="submit"> ارسال پیام</button>--}}
{{--                        </form>--}}
{{--                        {!!  GoogleReCaptchaV3::render(['contact_us_id'=>'contact_us']) !!}--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
{{--            <div class="contact-map pt-100">--}}
{{--                <div id="map"></div>--}}
{{--            </div>--}}
        </div>
    </div>
@endsection

{{--@section('script')--}}
{{--    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"--}}
{{--            integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="--}}
{{--            crossorigin="">--}}
{{--    </script>--}}
{{--    <script>--}}
{{--        var map = L.map('map').setView([{{$setting->latitude}}, {{$setting->longitude}}], 12);--}}
{{--        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {--}}
{{--            maxZoom: 19,--}}
{{--            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'--}}
{{--        }).addTo(map);--}}
{{--        var marker = L.marker([{{$setting->latitude}}, {{$setting->longitude}}]).addTo(map);--}}
{{--        marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();--}}
{{--    </script>--}}
{{--@endsection--}}
