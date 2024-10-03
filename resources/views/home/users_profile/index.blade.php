@extends('home.layouts.home')

@section('title')
    صفحه ی پروفایل
@endsection
@section('content')
    <!-- profile------------------------------->
    <div class="container-main">
        <div class="d-block">
            <section class="profile-home">
                <div class="col-lg">
                    <div class="post-item-profile order-1 d-block">
                        @include('home.sections.profile_sidebar')
                        <div class="col-lg-9 col-md-9 col-xs-12 pl">
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
                            <form action="{{ route('home.profile.update') }}" method="POST">
                                @csrf
                                <div class="profile-content">
                                    <div class="profile-stats">
                                        <table class="table table-profile table-responsive">
                                            <tbody>
                                            <tr>
                                                <td class="w-50">
                                                    <div class="title">نام:</div>
                                                    {{--                                                    <div class="value">حسن شجاعی</div>--}}
                                                    <input name="name" type="text" id="first-name" class="value"
                                                           value="{{ auth()->user()->name }}"/>
                                                </td>
                                                <td class="w-50">
                                                    <div class="title">نام خانوادگی:</div>
                                                    {{--                                                    <div class="value">شجاعی</div>--}}
                                                    <input name="family" type="text" id="last-name" class="value"
                                                           value="{{ auth()->user()->family }}"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                {{--                                                <td>--}}
                                                {{--                                                    <div class="title">موبایل:</div>--}}
                                                {{--                                                    <div class="value">{{ auth()->user()->cellphone }}</div>--}}
                                                {{--                                                </td>--}}
                                                {{--                                                <td>--}}
                                                {{--                                                    <div class="title">تاریخ عضویت:</div>--}}
                                                {{--                                                    <div class="value">{{ auth()->user()->created_at ? dateTimeFormat(auth()->user()->created_at) : '-' }}</div>--}}
                                                {{--                                                </td>--}}
                                            </tr>
                                            {{--                                            <tr>--}}
                                            {{--                                                <td>--}}
                                            {{--                                                    <div class="title"> دریافت خبرنامه :</div>--}}
                                            {{--                                                    <div class="value">بله</div>--}}
                                            {{--                                                </td>--}}
                                            {{--                                                <td>--}}
                                            {{--                                                    <div class="title"> کد ملی :</div>--}}
                                            {{--                                                    <div class="value">-</div>--}}
                                            {{--                                                </td>--}}
                                            </tr>
                                            </tbody>
                                        </table>
                                        {{--                                        <div class="profile">--}}
                                        {{--                                            <ul class="mb-0">--}}
                                        {{--                                                <li class="profile-item">--}}
                                        {{--                                                    <div class="title">نام و نام خانوادگی:</div>--}}
                                        {{--                                                    <div class="value">حسن شجاعی</div>--}}
                                        {{--                                                </li>--}}
                                        {{--                                                <li class="profile-item">--}}
                                        {{--                                                    <div class="title">پست الکترونیک :</div>--}}
                                        {{--                                                    <div class="value">info@digismart.com</div>--}}
                                        {{--                                                </li>--}}
                                        {{--                                                <li class="profile-item">--}}
                                        {{--                                                    <div class="title">شماره تلفن همراه:</div>--}}
                                        {{--                                                    <div class="value">*******0991</div>--}}
                                        {{--                                                </li>--}}
                                        {{--                                                <li class="profile-item">--}}
                                        {{--                                                    <div class="title">تاریخ عضویت:</div>--}}
                                        {{--                                                    <div class="value">۱۳۹۹/۰۱/۱۲</div>--}}
                                        {{--                                                </li>--}}
                                        {{--                                                <li class="profile-item">--}}
                                        {{--                                                    <div class="title"> دریافت خبرنامه :</div>--}}
                                        {{--                                                    <div class="value">بله</div>--}}
                                        {{--                                                </li>--}}
                                        {{--                                                <li class="profile-item">--}}
                                        {{--                                                    <div class="title"> کد ملی :</div>--}}
                                        {{--                                                    <div class="value">-</div>--}}
                                        {{--                                                </li>--}}
                                        {{--                                            </ul>--}}
                                        {{--                                        </div>--}}
                                        <div class="profile-edit-action">
                                            <button type="submit" class="link-spoiler-edit btn btn-secondary">ویرایش
                                                اطلاعات
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('home.change.password') }}" method="POST">
                                @csrf
                                <div class="profile-content">
                                    <div class="profile-stats">
                                        <table class="table table-profile table-responsive">
                                            <tbody>
                                            <tr>
                                                <td class="col-span-2">
                                                    <div class="title">رمز عبور فعلی:</div>
                                                    <input name="current_password" type="password" required/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="w-50">
                                                    <div class="title">رمز عبور جدید:</div>
                                                    <input name="new_password" type="password" required/>
                                                </td>
                                                <td class="w-50">
                                                    <div class="title">تکرار رمز عبور جدید:</div>
                                                    <input name="new_password_confirmation"  type="password" required/>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="profile-edit-action">
                                            <button type="submit" class="link-spoiler-edit btn btn-secondary">
                                                تغییر رمز عبور
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- profile------------------------------->
@endsection
