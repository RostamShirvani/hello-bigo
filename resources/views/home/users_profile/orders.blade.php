@extends('home.layouts.home')

@section('title')
    سفارشات من
@endsection
@section('content')
    <!-- orders------------------------------->
    <div class="container-main">
        <div class="d-block">
            <section class="profile-home">
                <div class="col-lg">
                    <div class="post-item-profile order-1 d-block">
                        @include('home.sections.profile_sidebar')
                        <div class="col-lg-9 col-md-9 col-xs-12 pl">
                            <div class="profile-content">
                                <div class="profile-stats">
                                    <div class="table-orders">
                                        <table class="table table-profile-orders table-responsive">
                                            <thead class="thead-light">
                                            <tr>
                                                <th scope="col">شماره سفارش</th>
                                                <th scope="col">تاریخ ثبت سفارش</th>
                                                <th scope="col">وضعیت</th>
                                                <th scope="col">مجموع</th>
                                                <th scope="col">جزئیات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($orders as $order)
                                                <tr>
                                                    <td class="order-code">{{$order->id}}</td>
                                                    <td>{{ verta($order->created_at)->format('H:i:s - d F Y') }}</td>
                                                    <td class="Waiting text-success">
                                                        @switch($order->getRawOriginal('status'))
                                                            @case(\App\Models\Order::STATUS_PAID_AND_COMPLETED)
                                                                <span class="text-success">{{ $order->status }}</span>
                                                                @break

                                                            @case(\App\Models\Order::STATUS_NEW)
                                                                <span class="text-warning">{{ $order->status }}</span>
                                                                @break

                                                            @case(\App\Models\Order::STATUS_PAID_AND_IN_PROGRESS)
                                                                <span class="text-gray-500">{{ $order->status }}</span>
                                                                @break

                                                            @default
                                                                <span class="text-danger">{{ $order->status }}</span>
                                                        @endswitch
                                                    </td>
                                                    <td class="totla">
                                                        <span class="amount">{{number_format($order->paying_amount/10)}}
                                                            <span>تومان</span>
                                                        </span>
                                                    </td>
                                                    <td class="detail">
                                                        <a href="#" data-toggle="modal" data-target="#ordersDetiles-{{$order->id}}" class="btn btn-secondary d-block">نمایش</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-4">{!! $orders->links('pagination::bootstrap-4') !!}</div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- orders------------------------------->
    @foreach($orders as $order)
        <!-- Modal Order -->
        <div class="modal fade" id="ordersDetiles-{{$order->id}}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12" style="direction: rtl;">
                                <form action="#">
                                    <div class="table-content table-responsive cart-table-content">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th>شماره آیتم</th>
                                                <th>تصویر محصول</th>
                                                <th>نام محصول</th>
                                                <th>آواتار</th>
                                                <th>وضعیت</th>
                                                {{--                                                <th> فی</th>--}}
                                                {{--                                                <th> تعداد</th>--}}
                                                <th> قیمت کل</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($order->orderItems as $item)
                                                <tr>
                                                    <td>
                                                        {{$item->id}}
                                                    </td>
                                                    <td class="product-thumbnail">
                                                        <a href="{{route('home.products.show', $item->product->slug)}}">
                                                            <img width="70"
                                                                 src="{{asset(env('PRODUCT_IMAGES_UPLOAD_PATH').$item->product->primary_image)}}"
                                                                 alt="{{$item->product->name}}">
                                                        </a>
                                                    </td>
                                                    {{--                                                    <td class="product-name"><a--}}
                                                    {{--                                                            href="{{route('home.products.show', $item->product->slug)}}">{{$item->product->name}}</a>--}}
                                                    {{--                                                    </td>--}}
                                                    <td class="product-name">
                                                        <a href="{{route('home.products.show', $item->product->slug)}}"> {{$item->product->name}} </a>
                                                        <p style="font-size: 12px;">
                                                            {{$item->productVariation->attribute->name}}
                                                            :
                                                            {{$item->productVariation->value}} الماس
                                                            <br>
                                                            آی دی:
                                                            {{ $item->account_id ?? '-' }}<br>
                                                            نام اکانت:
                                                            {{ $item->account_name ?? '-' }}
                                                        </p>
                                                    </td>
                                                    {{--                                                    <td class="product-price-cart">--}}
                                                    {{--                                                        <span--}}
                                                    {{--                                                            class="amount">{{number_format($item->price)}} تومان</span>--}}
                                                    {{--                                                    </td>--}}
                                                    {{--                                                    <td class="product-quantity">--}}
                                                    {{--                                                        {{$item->quantity}}--}}
                                                    {{--                                                    </td>--}}
                                                    <td>
                                                        <img class="avatar rounded-circle" loading="lazy" style="width: 40px; height: 40px;" src="{{$item->account_avatar_url}}">
                                                    </td>
                                                    <td>
                                                        @switch($item->getRawOriginal('status'))
                                                            @case(\App\Models\OrderItem::STATUS_CHARGED)
                                                                <span class="text-success">شارژ شده</span>
                                                                @break

                                                            @case(\App\Models\OrderItem::STATUS_NEW)
                                                                <span class="text-gray-500">در انتظار پرداخت</span>
                                                                @break

                                                            @case(\App\Models\OrderItem::STATUS_PAID_AND_IN_PROGRESS)
                                                                <span class="text-gray-500">در حال انجام ...</span>
                                                                @break

                                                            @default
                                                                <span class="text-warning">در حال بررسی</span>
                                                        @endswitch
                                                    </td>
                                                    <td class="product-subtotal">
                                                        {{number_format($item->subtotal)}}
                                                        تومان
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end -->
    @endforeach
@endsection
