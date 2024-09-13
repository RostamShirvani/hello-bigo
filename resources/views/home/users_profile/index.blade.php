@extends('home.layouts.home')

@section('title')
    صفحه ی پروفایل
@endsection
@section('content')
    <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{route('home.index')}}">صفحه ای اصلی</a>
                </li>
                <li class="active"> پروفایل </li>
            </ul>
        </div>
    </div>
</div>

<!-- my account wrapper start -->
<div class="my-account-wrapper pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- My Account Page Start -->
                <div class="myaccount-page-wrapper">
                    <!-- My Account Tab Menu Start -->
                    <div class="row text-right" style="direction: rtl;">
                        @include('home.sections.profile_sidebar')
                        <!-- My Account Tab Menu End -->
                        <!-- My Account Tab Content Start -->
                        <div class="col-lg-9 col-md-8">
                            <div class="tab-content" id="myaccountContent">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <!-- Single Tab Content Start -->
                                <div class="myaccount-content">
                                    <h3> پروفایل </h3>
                                    <div class="account-details-form">
                                        <form action="{{ route('home.profile.update') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="single-input-item">
                                                        <label for="first-name" class="required">
                                                            نام
                                                        </label>
                                                        <input name="name" type="text" id="first-name" value="{{ auth()->user()->name }}" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="single-input-item">
                                                        <label for="last-name" class="required">
                                                            نام خانوادگی
                                                        </label>
                                                        <input name="family" type="text" id="last-name"  value="{{ auth()->user()->family }}"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="single-input-item">
                                                        <label for="last-name" class="required">
                                                            موبایل
                                                        </label>
                                                        <input name="cellphone" type="text" id="cellphone"  value="{{ auth()->user()->cellphone }}" disabled/>
                                                    </div>
                                                </div>
{{--                                                <div class="col-lg-6">--}}
{{--                                                    <div class="single-input-item">--}}
{{--                                                        <label for="email" class="required"> ایمیل </label>--}}
{{--                                                        <input type="email" id="email"  value="{{ auth()->user()->email }}" disabled />--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
                                            </div>

                                            <div class="single-input-item">
                                                <button class="check-btn sqr-btn "> تبت تغییرات </button>
                                            </div>

                                        </form>
                                        <form action="{{ route('home.change.password') }}" method="POST">
                                            @csrf
                                            <fieldset>
                                                <legend> تغییر پسورد </legend>
                                                <div class="single-input-item">
                                                    <label for="current_password" class="required">
                                                        رمز عبور فعلی را وارد نمایید
                                                    </label>
                                                    <input name="current_password" type="password" id="current_password" />
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="new_password" class="required">
                                                                رمز عبور جدید
                                                            </label>
                                                            <input name="new_password" type="password" id="new_password" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="new_password_confirmation" class="required"> تکرار
                                                                رمز عبور </label>
                                                            <input name="new_password_confirmation"  type="password" id="new_password_confirmation" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="single-input-item">
                                                <button class="check-btn sqr-btn "> تغییر رمز عبور </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->
                            </div>
                        </div> <!-- My Account Tab Content End -->
                    </div>
                </div> <!-- My Account Page End -->
            </div>
        </div>
    </div>
</div>
<!-- my account wrapper end -->

@endsection
