@extends('home.layouts.home')

@section('title')
    سبد خرید
@endsection
@section('content')
    <!-- cart---------------------------------->
    @if(\Cart::isEmpty())
        <div class="container-main">
            <div class="d-block">
                <div class="main-row">
                    <section class="cart-home">
                        <div class="post-item-cart d-block order-2">
                            <div class="content-page">
                                <div class="cart-form">
                                    <div class="cart-empty text-center d-block">
                                        <div class="cart-empty-img mb-4 mt-4">
                                            <img src="{{ asset('assets/newsite/images/shopping-cart.png') }}">
                                        </div>
                                        <p class="cart-empty-title">سبد خرید شما در حال حاضر خالی است.</p>
                                        <div class="return-to-shop">
                                            <a href="/" class="backward btn btn-secondary">بازگشت به صفحه اصلی</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    @else
        <div class="container-main">
            <div class="d-block">
                <div class="main-row">
                    <div id="breadcrumb">
                        <i class="mdi mdi-home"></i>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">خانه</a></li>
                                <li class="breadcrumb-item active" aria-current="page">سبد خرید</li>
                            </ol>
                        </nav>
                    </div>
                    <section class="cart-home">
                        <div class="post-item-cart d-block order-2">
                            <div class="content-page">
                                <div class="cart-form">
                                    <form action="{{route('home.cart.update')}}" class="c-form" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <table class="table-cart cart table table-borderless">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="product-cart-name">تصویر محصول</th>
                                                <th scope="col" class="product-cart-name">نام محصول</th>
                                                <th scope="col" class="product-cart-price">آواتار</th>
                                                <th scope="col" class="product-cart-price">قیمت</th>
                                                {{--                                                <th scope="col" class="product-cart-quantity">تعداد مورد نیاز</th>--}}
                                                <th scope="col" class="product-cart-Total">عملیات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php session_start(); ?>
                                            @foreach(\Cart::getContent() as $item)
                                                <tr>
                                                    <td class="product-cart-name">
                                                        <div class="">
                                                            <a href="{{route('home.products.show', $item->associatedModel->slug)}}">
                                                                <img width="100"
                                                                     src="{{asset(env('PRODUCT_IMAGES_UPLOAD_PATH').$item->associatedModel->primary_image)}}"
                                                                     alt="">
                                                            </a>
                                                            {{--                                                            <div class="product-remove">--}}
                                                            {{--                                                                <a href="#" class="remove">--}}
                                                            {{--                                                                    <i class="mdi mdi-close"></i>--}}
                                                            {{--                                                                </a>--}}
                                                            {{--                                                            </div>--}}
                                                        </div>
                                                    </td>
                                                    <td class="product-cart-name">
                                                        <div class="product-title">
                                                            <a href="{{route('home.products.show', $item->associatedModel->slug)}}">
                                                                {{$item->name}}
                                                            </a>
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
                                                            {{--                                                            <div class="variation">--}}
                                                            {{--                                                                <div class="variant-color">--}}
                                                            {{--                                                                    <span class="variant-color-title">سفید</span>--}}
                                                            {{--                                                                    <div class="variant-shape"></div>--}}
                                                            {{--                                                                </div>--}}
                                                            {{--                                                                <div class="variant-guarantee">--}}
                                                            {{--                                                                    <i class="mdi mdi-check"></i>--}}
                                                            {{--                                                                    گارانتی ۱۸ ماهه--}}
                                                            {{--                                                                </div>--}}
                                                            {{--                                                                <div class="seller">--}}
                                                            {{--                                                                    <i class="mdi mdi-storefront"></i>--}}
                                                            {{--                                                                    فروشنده :--}}
                                                            {{--                                                                    <span>کالا مارکت</span>--}}
                                                            {{--                                                                </div>--}}
                                                            {{--                                                            </div>--}}
                                                        </div>
                                                    </td>
                                                    <td class="">
                                                        <img class="avatar rounded-circle"
                                                             style="width: 40px; height: 40px;"
                                                             src="<?=$_SESSION['cart'][$item->id]['account_avatar_url'] ?? '' ?>">
                                                    </td>
                                                    <td class="product-cart-price">
                                                    <span
                                                        class="amount">{{number_format($item->quantity * $item->price)}}</span>
                                                        <span>تومان</span>
                                                    </td>
                                                    {{--                                                <td class="product-cart-quantity">--}}
                                                    {{--                                                    <div class="required-number before">--}}
                                                    {{--                                                        <div class="quantity">--}}
                                                    {{--                                                            <input type="number" min="1" max="100" step="1"--}}
                                                    {{--                                                                   value="1">--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                    </div>--}}
                                                    {{--                                                </td>--}}
                                                    {{--                                                <td class="product-subtotal">--}}
                                                    {{--                                                    {{number_format($item->quantity * $item->price)}}--}}
                                                    {{--                                                    تومان--}}
                                                    {{--                                                </td>--}}
                                                    <td class="product-remove" style="vertical-align: middle;">
                                                        <a href="{{route('home.cart.remove', $item->id)}}"
                                                           class="remove">
                                                            <i class="mdi mdi-close"></i>
                                                        </a>
                                                    </td>
                                                    {{--                                                    <td class="product-remove">--}}
                                                    {{--                                                        <a href="{{route('home.cart.remove', $item->id)}}"><i class="sli sli-close"></i></a>--}}
                                                    {{--                                                    </td>--}}
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                        {{--                                        <div class="col-lg-12">--}}
                                        {{--                                            <div class="cart-shiping-update-wrapper">--}}
                                        {{--                                                <div class="cart-shiping-update">--}}
                                        {{--                                                    <a href="{{route('home.index')}}"> ادامه خرید </a>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="cart-clear">--}}
                                        {{--                                                    <button> به روز رسانی سبد خرید </button>--}}
                                        {{--                                                    <a href="{{route('home.cart.clear')}}"> پاک کردن سبد خرید </a>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                    </form>
                                    <div class="cart-collaterals">
                                        <div class="totals d-block">
                                            <h3 class="Total-cart-total">مجموع کل سبد خرید</h3>
                                            <div class="checkout-summary">
                                                <ul class="checkout-summary-summary">
                                                    {{--                                                    <li class="cart-subtotal">--}}
                                                    {{--                                                        <span class="amount">قیمت کل</span>--}}
                                                    {{--                                                        <span> {{number_format(\Cart::getTotal() + cartTotalDiscountAmount())}} تومان</span>--}}
                                                    {{--                                                    </li>--}}
                                                    {{--                                                    <li class="shipping-totals">--}}
                                                    {{--                                                        <span class="amount">حمل و نقل</span>--}}
                                                    {{--                                                        <div class="shipping-totals-item">--}}
                                                    {{--                                                            <div class="shipping-totals-outline">--}}
                                                    {{--                                                                <label for="#" class="outline-radio">--}}
                                                    {{--                                                                    <input type="radio" name="payment_method"--}}
                                                    {{--                                                                           id="payment-option-online" checked="checked">--}}
                                                    {{--                                                                    <span class="outline-radio-check"></span>--}}
                                                    {{--                                                                </label>--}}
                                                    {{--                                                                <label for="#" class="shipping-totals-title-row">--}}
                                                    {{--                                                                    <div class="shipping-totals-title">حمل و نقل رایگان--}}
                                                    {{--                                                                    </div>--}}
                                                    {{--                                                                </label>--}}
                                                    {{--                                                            </div>--}}
                                                    {{--                                                            <div class="shipping-totals-outline">--}}
                                                    {{--                                                                <label for="#" class="outline-radio">--}}
                                                    {{--                                                                    <input type="radio" name="payment_method"--}}
                                                    {{--                                                                           id="payment-option-online">--}}
                                                    {{--                                                                    <span class="outline-radio-check"></span>--}}
                                                    {{--                                                                </label>--}}
                                                    {{--                                                                <label for="#" class="shipping-totals-title-row">--}}
                                                    {{--                                                                    <div class="shipping-totals-title">حمل و نقل معمولی:--}}
                                                    {{--                                                                        20,000 تومان--}}
                                                    {{--                                                                    </div>--}}
                                                    {{--                                                                </label>--}}
                                                    {{--                                                            </div>--}}
                                                    {{--                                                            <span class="shipping-destination">حمل و نقل به خراسان--}}
                                                    {{--                                                            شمالی</span>--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                    </li>--}}
                                                    {{--                                                    <li class="order-total">--}}
                                                    {{--                                                        <span class="amount"> مجموع</span>--}}
                                                    {{--                                                        <span> 6,032,000 تومان</span>--}}
                                                    {{--                                                    </li>--}}
                                                    <li class="discount-code">
                                                        <div class=" align-items-center">
{{--                                                            <div class="col-md-7 pr mt-5">--}}
{{--                                                                <div class="coupon">--}}
{{--                                                                    <form action="{{route('home.coupons.check')}}" method="POST">--}}
{{--                                                                        @csrf--}}
{{--                                                                        <input type="text" required="" name="code"--}}
{{--                                                                               class="input-coupon-code"--}}
{{--                                                                               placeholder="كد تخفیف:">--}}
{{--                                                                        <button class="btn btn-coupon"--}}
{{--                                                                                type="submit">اعمال--}}
{{--                                                                        </button>--}}
{{--                                                                    </form>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
                                                            <div class="col-md-2 pl">
                                                                <div class="mb-3">
                                                                    <span class="amount">قیمت کل</span>
                                                                    @if(session()->has('coupon'))
                                                                        <hr>
                                                                        <h5>
                                                                            مبلغ کد تخفیف :
                                                                            <span style="color: red">
                                                                                {{number_format(session()->get('coupon.amount'))}}
                                                                                تومان
                                                                            </span>
                                                                        </h5>
                                                                    @endif
                                                                    @if(false)
                                                                        <h5>
                                                                            هزینه ارسال :
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
                                                                        </h5>
                                                                    @endif
                                                                    <span> {{number_format(\Cart::getTotal() + cartTotalDiscountAmount())}} تومان</span>
                                                                </div>
                                                                <div class="proceed-to-checkout">
                                                                    <a href="{{route('home.orders.checkout')}}"
                                                                       class="checkout-button d-block">تسویه
                                                                        حساب</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    @endif
    <!-- cart---------------------------------->
@endsection
