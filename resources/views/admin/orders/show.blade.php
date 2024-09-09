@extends('admin.layouts.admin')

@section('title')
    show attribute
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold ">سفارش : {{$order->id}}</h5>
            </div>
            <hr>
            <div class="row">
                <div class="form-group col-md-3">
                    <label>نام کاربر</label>
                    <input class="form-control" type="text" value="{{$order->user->name ?? 'کاربر'}}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>نام کوپن</label>
                    <input class="form-control" type="text"
                           value="{{$order->coupon_id ? $order->coupon->name : 'استفاده نشده'}}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>وضعیت</label>
                    <input class="form-control" type="text" value="{{$order->status}}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>مبلغ</label>
                    <input class="form-control" type="text" value="{{number_format($order->total_amount)}}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>هزینه ی ارسال</label>
                    <input class="form-control" type="text" value="{{number_format($order->delivery_amount)}}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>مبلغ کد تخفیف</label>
                    <input class="form-control" type="text" value="{{number_format($order->coupon_amount)}}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>مبلغ پرداختی</label>
                    <input class="form-control" type="text" value="{{number_format($order->paying_amount)}}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>نوع پرداخت</label>
                    <input class="form-control" type="text" value="{{$order->payment_type}}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>وضعیت پرداخت</label>
                    <input class="form-control" type="text" value="{{$order->payment_status}}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>تاریخ ایجاد</label>
                    <input class="form-control" type="text" value="{{verta($order->created_at)}}" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label>آدرس</label>
                    <textarea class="form-control" disabled>{{$order->address?->address}}</textarea>
                </div>
                <div class="form-group col-md-6">
                    <label>توضیحات</label>
                    <textarea class="form-control" name="description" disabled>{{ $order->description }}</textarea>
                    @error('description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label>توضیحات وضعیت</label>
                    <textarea class="form-control" name="status_description" disabled>{{ $order->status_description }}</textarea>
                    @error('status_description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <hr>
                    <h5>محصولات:</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center">
                            <thead>
                            <tr>
                                <th>شماره آیتم</th>
                                <th>تصویر محصول</th>
                                <th>نام محصول</th>
                                <th>آواتار</th>
                                <th>وضعیت</th>
                                {{--                                                <th> فی</th>--}}
                                {{--                                                <th> تعداد</th>--}}
                                <th>قیمت کل</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->orderItems as $item)
                                <tr>
                                    <td style="width: 100px;">
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
                                        <img class="avatar rounded-circle" loading="lazy"
                                             style="width: 40px; height: 40px;" src="{{$item->account_avatar_url}}">
                                    </td>
                                    <td>
                                        @switch($item->getRawOriginal('status'))
                                            @case(\App\Models\OrderItem::STATUS_CHARGED)
                                                <span class="text-success">شارژ شده</span>
                                                @break

                                            @case(\App\Models\OrderItem::STATUS_NEW)
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
                </div>

            </div>
            <a href="{{route('admin.attributes.index')}}" class="btn btn-dark mt-5">بازگشت</a>
        </div>
    </div>
@endsection
