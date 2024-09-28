@extends('home.layouts.home')

@section('title')
    سفارش خرید
@endsection
@section('content')
    <!-- checkout------------------------------>
    <div class="container-main">
        <div class="d-block">
            <section class="blog-checkout d-block order-1">
                <div class="col-lg">
                    <div class="checkout woocommerce-checkout">
                        <div class="content-checkout container">
                            <div class="notices-wrapper">
                                <div class="col-12">
                                    @if(! session()->has('coupon'))
                                        <div class="form-coupon-toggle">
                                            <div class="info">
                                                کد تخفیف دارید؟
                                                <a href="#" class="showcoupon">برای نوشتن کد اینجا کلیک کنید</a>
                                            </div>
                                            <div class="checkout-coupon form-coupon">
                                                <p>اگر کد تخفیف دارید، لطفا وارد کنید.</p>
                                                <form action="{{route('home.coupons.check')}}" method="POST"
                                                      class="form-coupon">
                                                    @csrf
                                                    <div class="form-row">
                                                        <input type="text" name="code" class="checkout-discount-code"
                                                               placeholder="کد تخفیف">
                                                        <div class="append pl">
                                                            <button class="btn-append btn btn-primary" type="submit">
                                                                اعمال
                                                                تخفیف
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="middle-container">
                                <form action="{{route('home.payment')}}" method="POST">
                                    @csrf
                                    <div class="your-order-area">
                                        <h3> سفارش شما </h3>
                                        <div class="your-order-wrap gray-bg-4">
                                            <div class="your-order-info-wrap">
                                                <div class="your-order-info">
                                                    <ul>
                                                        <li> محصول <span> جمع </span></li>
                                                    </ul>
                                                </div>
                                                <div class="your-order-middle">
                                                    <ul>
                                                        <?php session_start(); ?>
                                                        @foreach(\Cart::getContent() as $item)
                                                            <li class="d-flex justify-content-between">
                                                                <div>
                                                                    <a href="{{route('home.products.show', $item->associatedModel->slug)}}"> {{$item->name}} </a>
                                                                    <p style="font-size: 12px; color: red">
                                                                        {{\App\Models\Attribute::find($item->attributes->attribute_id)->name}}
                                                                        :
                                                                        {{$item->attributes->value}} الماس
                                                                        <br>
                                                                        آی دی:
                                                                            <?= $_SESSION['cart'][$item->id]['account_id'] ?? '-' ?>
                                                                        <br>
                                                                        نام اکانت:
                                                                            <?= $_SESSION['cart'][$item->id]['account_name'] ?? '-' ?>
                                                                    </p>
                                                                </div>
                                                                <span>
                                                        {{number_format($item->price)}}
                                                        تومان
                                                        @if($item->attributes->is_sale)
                                                                        <p style="font-size: 12px;color: red">
                                                            {{$item->attributes->discount_percent}}%
                                                            تخفیف
                                                        </p>
                                                                    @endif
                                                    </span>
                                                            </li>
                                                        @endforeach()
                                                    </ul>
                                                </div>
                                                <div class="your-order-info order-subtotal">
                                                    <ul>
                                                        <li> مبلغ
                                                            <span>
                                                {{number_format(\Cart::getTotal() + cartTotalDiscountAmount())}}
                                                تومان
                                                </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                @if(cartTotalDiscountAmount() > 0)
                                                    <div class="your-order-info order-subtotal">
                                                        <ul>
                                                            <li>
                                                                مبلغ تخفیف کالاها :
                                                                <span style="color: red">
                                            {{number_format(cartTotalDiscountAmount())}}
                                            تومان
                                        </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endif
                                                @if(session()->has('coupon'))
                                                    <div class="your-order-info order-subtotal">
                                                        <ul>
                                                            <li>
                                                                مبلغ کد تخفیف :
                                                                <span style="color: red">
                                                        {{number_format(session()->get('coupon.amount'))}}
                                                        تومان
                                                    </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endif
                                                <div class="your-order-info order-shipping">
                                                    <ul>
                                                        <li> هزینه ارسال
                                                            @if(cartTotalDeliveryAmount() == 0)
                                                                <span style="color: red">
                                                رایگان
                                            </span>
                                                            @else
                                                                <span>
                                                {{number_format(cartTotalDeliveryAmount())}}
                                                تومان
                                            </span>
                                                            @endif
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="your-order-info order-total">
                                                    <ul>
                                                        <li>جمع کل
                                                            <span>
                                                        {{number_format(cartTotalAmount())}}
                                                        تومان </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div>
                                                <p>
                                                    من <span class="text-danger text-bold">آیدی و بسته</span> خود را چک
                                                    کردم و
                                                    هرگونه اشتباه بر <span
                                                        class="text-danger text-bold">عهده خودم</span> می
                                                    باشد<br>
                                                    قبل از ورود به درگاه بانک حتما فیلتر شکن خود را خاموش کنید <span
                                                        class="text-warning text-bold">(در غیر این صورت درگاه باز نمی شود )</span>
                                                </p>

                                                <!-- Confirmation Checkbox -->
                                                <div class="text-right mt-3 confirmation-section">
                                                    <label class="form-check-label" id="confirmation-label"></label>

                                                    <!-- Flex container for the checkbox and label -->
                                                    <div
                                                        style="display: flex; flex-direction: column-reverse; position: relative; align-items: flex-start;">

                                                        <!-- Flex container for checkbox and label side by side -->
                                                        <div
                                                            style="display: flex; align-items: center; justify-content: flex-start;">
                                                            <input type="hidden" name="confirmation_checkbox" value="0">

                                                            <!-- Checkbox -->
                                                            <input type="checkbox" class="form-check-input" id=""
                                                                   name="confirmation_checkbox"
                                                                   value="1"
                                                                   style="width: 16px; height: 16px; margin: 0 5px; vertical-align: middle;">

                                                            <!-- Label (on the right) -->
                                                            <label for="confirmation-checkbox"
                                                                   class="form-check-label mr-4"
                                                                   id="confirmation-label"
                                                                   style="vertical-align: middle;">
                                                                من
                                                                <span id="terms-link" class="text-danger text-bold"
                                                                      style="cursor: pointer;">شرایط و مقررات سایت</span>
                                                                را خوانده ام و آن را می پذیرم.
                                                                <span class="text-danger text-bold">*</span>
                                                            </label>
                                                        </div>

                                                        <!-- Hidden text to fade in (above label) -->
                                                        <div id="terms-text"
                                                             style="display:none; position: relative; bottom: 10px; background-color: rgba(52, 53, 56, 0.1); padding: 10px; text-align: justify;">
                                                            کاربر گرامی لطفاً موارد زیر را جهت استفاده بهینه از خدمات
                                                            سایت “بیگو
                                                            پلاس” به دقت ملاحظه فرمایید، زیرا استفاده از سایت “بیگو
                                                            پلاس” به
                                                            معنی آگاهی و توافق کامل شما با شرایط و ضوابط ذیل تلقی می
                                                            گردد.

                                                            محتویات این صفحه در هر زمانی قابل تغییر است و این حق برای
                                                            “بیگو
                                                            پلاس” محفوظ بوده که بدون اطلاع و هماهنگی قبلی، اقدام به
                                                            تغییر یا به
                                                            روز رسانی محتوای این صفحه کند. کاربران موظف هستند که به صورت
                                                            دوره ای
                                                            این صفحه را مرور کرده تا از تغییرات احتمالی در قوانین آگاه
                                                            شوند.

                                                            خریدار با تایید قوانین و مقررات سایت تایید میکند که اید خود
                                                            را بررسی
                                                            کرده و مسولیت هرگونه اشتباه درثبت ایدی بر عهده خود خریدار
                                                            میباشد .

                                                            قوانین عمومی

                                                            تمام فعالیت های فروشگاه اینترنتی “بیگو پلاس” منطبق با قوانین
                                                            جمهوری
                                                            اسلامی ایران، قانون تجارت الکترونیک و قانون حمایت از حقوق
                                                            مصرف کننده
                                                            است.

                                                            شرایط تحویل کالا

                                                            تحویل کالا در این فروشگاه به صورت انی و فقط در اکانت ثبت شده
                                                            در
                                                            هنگام خرید ارسال میشود .
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="payment-method">
                                                @if(\App\Models\Setting::get()->zarinpal_gateway)
                                                    <div class="pay-top sin-payment">
                                                        <input id="zarinpal" class="input-radio" type="radio"
                                                               value="zarinpal"
                                                               checked="checked" name="payment_method">
                                                        <label for="zarinpal"> درگاه پرداخت زرین پال </label>
                                                        {{--                                            <div class="payment-box payment_method_bacs">--}}
                                                        {{--                                                <p>--}}
                                                        {{--                                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده--}}
                                                        {{--                                                    از طراحان گرافیک است.--}}
                                                        {{--                                                </p>--}}
                                                        {{--                                            </div>--}}
                                                    </div>
                                                @endif
                                                @if(\App\Models\Setting::get()->pay_gateway)
                                                    <div class="pay-top sin-payment">
                                                        <input id="pay" class="input-radio" type="radio" value="pay"
                                                               name="payment_method">
                                                        <label for="pay">درگاه پرداخت پی</label>
                                                        {{--                                            <div class="payment-box payment_method_bacs">--}}
                                                        {{--                                                <p>--}}
                                                        {{--                                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با--}}
                                                        {{--                                                    استفاده--}}
                                                        {{--                                                    از طراحان گرافیک است.--}}
                                                        {{--                                                </p>--}}
                                                        {{--                                            </div>--}}
                                                    </div>
                                                @endif
                                                @if(\App\Models\Setting::get()->zibal_gateway)
                                                    <div class="pay-top sin-payment">
                                                        <input id="zibal" class="input-radio" type="radio" value="zibal"
                                                               name="payment_method">
                                                        <label for="zibal">درگاه پرداخت زیبال</label>
                                                        {{--                                                <div class="payment-box payment_method_bacs">--}}
                                                        {{--                                                    <p>--}}
                                                        {{--                                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با--}}
                                                        {{--                                                        استفاده--}}
                                                        {{--                                                        از طراحان گرافیک است.--}}
                                                        {{--                                                    </p>--}}
                                                        {{--                                                </div>--}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="Place-order mt-40">
                                            <button type="submit" class="btn-Order btn btn-primary mt-4 mb-3"
                                                    style="background-color: #651fff; border-color: #651fff; border-radius: 20px; font-size: 14px; outline: none !important;">
                                                ثبت سفارش
                                            </button>
                                        </div>
                                    </div>
                                    <input type="hidden" id="address-input" name="address_id">
                                    <input type="hidden" name="mobile" value="{{auth()->user()->cellphone}}">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- checkout------------------------------>
@endsection

@section('script')
    <script>
        $('#address-input').val($('#address-select').val());
        $('#address-select').change(function () {
            $('#address-input').val($(this).val());
        });
        $('.province-select').change(function () {

            var provinceID = $(this).val();

            if (provinceID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-province-cities-list') }}?province_id=" + provinceID,
                    success: function (res) {
                        if (res) {
                            $(".city-select").empty();

                            $.each(res, function (key, city) {
                                console.log(city);
                                $(".city-select").append('<option value="' + city.id + '">' +
                                    city.name + '</option>');
                            });

                        } else {
                            $(".city-select").empty();
                        }
                    }
                });
            } else {
                $(".city-select").empty();
            }
        });
        $('#terms-link').on('click', function () {
            $('#terms-text').fadeToggle(500); // Toggle fade in/out the text over 500ms
        });
    </script>
@endsection
