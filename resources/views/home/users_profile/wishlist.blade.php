@extends('home.layouts.home')

@section('title')
    لیست علاقه مندی های من
@endsection
@section('content')
    <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="{{route('home.index')}}">صفحه ای اصلی</a>
                    </li>
                    <li class="active">لیست علاقه مندی های من</li>
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

                                    <div class="tab-pane fade" id="address" role="tabpanel">
                                        <div class="myaccount-content address-content">
                                            <h3> آدرس ها </h3>

                                            <div>
                                                <address>
                                                    <p>
                                                        <strong> علی شیخ </strong>
                                                        <span class="mr-2"> عنوان آدرس : <span> منزل </span> </span>
                                                    </p>
                                                    <p>
                                                        خ شهید فلان ، کوچه ۸ فلان ،فرعی فلان ، پلاک فلان
                                                        <br>
                                                        <span> استان : تهران </span>
                                                        <span> شهر : تهران </span>
                                                    </p>
                                                    <p>
                                                        کدپستی :
                                                        89561257
                                                    </p>
                                                    <p>
                                                        شماره موبایل :
                                                        89561257
                                                    </p>

                                                </address>
                                                <a href="#" class="check-btn sqr-btn collapse-address-update">
                                                    <i class="sli sli-pencil"></i>
                                                    ویرایش آدرس
                                                </a>

                                                <div class="collapse-address-update-content">

                                                    <form action="#">

                                                        <div class="row">

                                                            <div class="tax-select col-lg-6 col-md-6">
                                                                <label>
                                                                    عنوان
                                                                </label>
                                                                <input type="text" required="" name="title">
                                                            </div>
                                                            <div class="tax-select col-lg-6 col-md-6">
                                                                <label>
                                                                    شماره تماس
                                                                </label>
                                                                <input type="text">
                                                            </div>
                                                            <div class="tax-select col-lg-6 col-md-6">
                                                                <label>
                                                                    استان
                                                                </label>
                                                                <select class="email s-email s-wid">
                                                                    <option>Bangladesh</option>
                                                                    <option>Albania</option>
                                                                    <option>Åland Islands</option>
                                                                    <option>Afghanistan</option>
                                                                    <option>Belgium</option>
                                                                </select>
                                                            </div>
                                                            <div class="tax-select col-lg-6 col-md-6">
                                                                <label>
                                                                    شهر
                                                                </label>
                                                                <select class="email s-email s-wid">
                                                                    <option>Bangladesh</option>
                                                                    <option>Albania</option>
                                                                    <option>Åland Islands</option>
                                                                    <option>Afghanistan</option>
                                                                    <option>Belgium</option>
                                                                </select>
                                                            </div>
                                                            <div class="tax-select col-lg-6 col-md-6">
                                                                <label>
                                                                    آدرس
                                                                </label>
                                                                <input type="text">
                                                            </div>
                                                            <div class="tax-select col-lg-6 col-md-6">
                                                                <label>
                                                                    کد پستی
                                                                </label>
                                                                <input type="text">
                                                            </div>

                                                            <div class=" col-lg-12 col-md-12">
                                                                <button class="cart-btn-2" type="submit"> ویرایش
                                                                    آدرس
                                                                </button>
                                                            </div>

                                                        </div>

                                                    </form>

                                                </div>

                                            </div>

                                            <hr>

                                            <div>
                                                <address>
                                                    <p>
                                                        <strong> علی شیخ </strong>
                                                        <span class="mr-2"> عنوان آدرس : <span> محل کار </span>
                                                            </span>
                                                    </p>
                                                    <p>
                                                        خ شهید فلان ، کوچه ۸ فلان ،فرعی فلان ، پلاک فلان
                                                        <br>
                                                        <span> استان : تهران </span>
                                                        <span> شهر : تهران </span>
                                                    </p>
                                                    <p>
                                                        کدپستی :
                                                        89561257
                                                    </p>
                                                    <p>
                                                        شماره موبایل :
                                                        89561257
                                                    </p>

                                                </address>
                                                <a href="#" class="check-btn sqr-btn ">
                                                    <i class="sli sli-pencil"></i>
                                                    ویرایش آدرس
                                                </a>
                                            </div>

                                            <hr>

                                            <button class="collapse-address-create mt-3" type="submit"> ایجاد آدرس
                                                جدید </button>
                                            <div class="collapse-address-create-content">

                                                <form action="#">

                                                    <div class="row">

                                                        <div class="tax-select col-lg-6 col-md-6">
                                                            <label>
                                                                عنوان
                                                            </label>
                                                            <input type="text" required="" name="title">
                                                        </div>
                                                        <div class="tax-select col-lg-6 col-md-6">
                                                            <label>
                                                                شماره تماس
                                                            </label>
                                                            <input type="text">
                                                        </div>
                                                        <div class="tax-select col-lg-6 col-md-6">
                                                            <label>
                                                                استان
                                                            </label>
                                                            <select class="email s-email s-wid">
                                                                <option>Bangladesh</option>
                                                                <option>Albania</option>
                                                                <option>Åland Islands</option>
                                                                <option>Afghanistan</option>
                                                                <option>Belgium</option>
                                                            </select>
                                                        </div>
                                                        <div class="tax-select col-lg-6 col-md-6">
                                                            <label>
                                                                شهر
                                                            </label>
                                                            <select class="email s-email s-wid">
                                                                <option>Bangladesh</option>
                                                                <option>Albania</option>
                                                                <option>Åland Islands</option>
                                                                <option>Afghanistan</option>
                                                                <option>Belgium</option>
                                                            </select>
                                                        </div>
                                                        <div class="tax-select col-lg-6 col-md-6">
                                                            <label>
                                                                آدرس
                                                            </label>
                                                            <input type="text">
                                                        </div>
                                                        <div class="tax-select col-lg-6 col-md-6">
                                                            <label>
                                                                کد پستی
                                                            </label>
                                                            <input type="text">
                                                        </div>

                                                        <div class=" col-lg-12 col-md-12">

                                                            <button class="cart-btn-2" type="submit"> ثبت آدرس
                                                            </button>
                                                        </div>



                                                    </div>

                                                </form>

                                            </div>

                                        </div>
                                    </div>

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
