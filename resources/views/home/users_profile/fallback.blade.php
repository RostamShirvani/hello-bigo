@extends('home.layouts.home')

@section('title')
    تشکر خرید
@endsection
@section('content')
    @if(isset($order))
        <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <ul>
                        <li class="active">تشکر خرید</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="checkout-main-area pt-70 pb-70 text-right" style="direction: rtl;">
            <div class="container">
                <div class="d-flex justify-content-center text-success p-4"
                     style="border: seagreen; border-style: dashed; font-size: xx-large">
                    متشکریم، سفارش شما دریافت شد.
                </div>
                <div class="row your-order-area pt-3 mt-1">
                    <div class="col-lg-4">
                        شماره سفارش: {{ $order->id ?? '-' }}
                    </div>
                    <div class="col-lg-4">
                        تاریخ: {{ $order->created_at ? verta($order->created_at)->format('d F Y - H:i:s') : '' }}
                    </div>
                    <div class="col-lg-4">
                        مبلغ نهایی: <span>{{number_format(cartTotalAmount())}}تومان </span>
                    </div>
                </div>

                <div class="checkout-wrap pt-30">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="your-order-area">
                                <h3> مشخصات سفارش </h3>
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
                                                        {{$item->price}}
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
                                        {{--                                    <div class="your-order-info order-shipping">--}}
                                        {{--                                        <ul>--}}
                                        {{--                                            <li> هزینه ارسال--}}
                                        {{--                                                @if(cartTotalDeliveryAmount() == 0)--}}
                                        {{--                                                <span style="color: red">--}}
                                        {{--                                                رایگان--}}
                                        {{--                                            </span>--}}
                                        {{--                                                @else--}}
                                        {{--                                                <span>--}}
                                        {{--                                                {{number_format(cartTotalDeliveryAmount())}}--}}
                                        {{--                                                تومان--}}
                                        {{--                                            </span>--}}
                                        {{--                                                @endif--}}
                                        {{--                                            </li>--}}
                                        {{--                                        </ul>--}}
                                        {{--                                    </div>--}}
                                        <div class="your-order-info order-total">
                                            <ul>
                                                <li>جمع کل
                                                    <span>{{number_format(cartTotalAmount())}}تومان </span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="your-order-info order-total">
                                            <ul>
                                                <li>مشخصات کاربر:
                                                    <span>{{ auth()->user()->name . ' ' .auth()->user()->family ?? ''  }}</span><br>
                                                    <span>{{ auth()->user()->cellphone }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    @else
        <script>
            window.location.href = "{{ route('home.orders.users_profile.index') }}";
        </script>
    @endif
@endsection
