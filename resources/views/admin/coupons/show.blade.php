@extends('admin.layouts.admin')

@section('title')
    show coupon
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold ">کوپن : {{$coupon->name}}</h5>
            </div>
            <hr>
            <div class="row">
                <div class="form-group col-md-3">
                    <label>نام</label>
                    <input class="form-control" type="text" value="{{$coupon->name}}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>کد</label>
                    <input class="form-control" type="text" value="{{$coupon->code}}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>نوع</label>
                    <input class="form-control" type="text" value="{{$coupon->type}}" disabled>
                </div>
                @if($coupon->getRawOriginal('type') == 'amount')
                    <div class="form-group col-md-3">
                        <label>مبلغ تخفیف</label>
                        <input class="form-control" type="text" value="{{$coupon->amount}}" disabled>
                    </div>
                @else
                    <div class="form-group col-md-3">
                        <label>درصد تخفیف</label>
                        <input class="form-control" type="text" value="{{$coupon->percentage}}" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <label>حداکثر مبلغ تخفیف</label>
                        <input class="form-control" type="text" value="{{$coupon->max_percentage_amount}}" disabled>
                    </div>
                @endif
                <div class="form-group col-md-3">
                    <label>تاریخ انقضاء</label>
                    <div class="input-group">
                        <div class="input-group-prepend order-2">
                                <span class="input-group-text" id="expireDate">
                                    <i class="fa fa-clock"></i>
                                </span>
                        </div>
                        <input type="text" class="form-control"
                               id="expireInput"
                               name="expired_at"
                               value="{{$coupon->expired_at == null ? null : verta($coupon->expired_at)}}"
                               disabled>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label>تاریخ ایجاد</label>
                    <input class="form-control" type="text" value="{{verta($coupon->created_at)}}" disabled>
                </div>
                <div class="form-group col-md-12">
                    <label for="description">توضیحات</label>
                    <textarea class="form-control" id="description" name="description"
                              type="text" disabled>{{$coupon->description}}</textarea>
                </div>
            </div>
            <a href="{{route('admin.coupons.index')}}" class="btn btn-dark mt-5">بازگشت</a>
        </div>
    </div>
@endsection
