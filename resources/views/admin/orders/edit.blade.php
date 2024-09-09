@extends('admin.layouts.admin')

@section('title')
    edit order
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ویرایش سفارش : {{$order->id}}</h5>
            </div>
            <hr>
            <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group col-md-3">
                        <label>نام کاربر</label>
                        <input class="form-control" type="text" value="{{ $order->user->name ?? 'کاربر' }}" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <label>نام کوپن</label>
                        <input class="form-control" type="text" value="{{ $order->coupon_id ? $order->coupon->name : 'استفاده نشده' }}" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <label>وضعیت</label>
                        <select class="form-control" name="status">
                            <option value="{{ \App\Models\Order::STATUS_NEW }}" {{ old('status', $order->getRawOriginal('status')) == \App\Models\Order::STATUS_NEW ? 'selected' : '' }}>
                                {{ $order->getStatusAttribute(\App\Models\Order::STATUS_NEW) }}
                            </option>
                            <option value="{{ \App\Models\Order::STATUS_PAID_AND_COMPLETED }}" {{ old('status', $order->getRawOriginal('status')) == \App\Models\Order::STATUS_PAID_AND_COMPLETED ? 'selected' : '' }}>
                                {{ $order->getStatusAttribute(\App\Models\Order::STATUS_PAID_AND_COMPLETED) }}
                            </option>
                            <option value="{{ \App\Models\Order::STATUS_PAID_AND_NOT_COMPLETED }}" {{ old('status', $order->getRawOriginal('status')) == \App\Models\Order::STATUS_PAID_AND_NOT_COMPLETED ? 'selected' : '' }}>
                                {{ $order->getStatusAttribute(\App\Models\Order::STATUS_PAID_AND_NOT_COMPLETED) }}
                            </option>
                            <!-- Add other statuses if needed -->
                        </select>
                        @error('status')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label>مبلغ</label>
                        <input class="form-control" type="number" name="total_amount" value="{{ old('total_amount', $order->total_amount) }}">
                        @error('total_amount')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label>هزینه ی ارسال</label>
                        <input class="form-control" type="number" name="delivery_amount" value="{{ old('delivery_amount', $order->delivery_amount) }}">
                        @error('delivery_amount')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label>مبلغ کد تخفیف</label>
                        <input class="form-control" type="number" name="coupon_amount" value="{{ old('coupon_amount', $order->coupon_amount) }}">
                        @error('coupon_amount')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label>مبلغ پرداختی</label>
                        <input class="form-control" type="number" name="paying_amount" value="{{ old('paying_amount', $order->paying_amount) }}">
                        @error('paying_amount')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label>نوع پرداخت</label>
                        <select class="form-control" name="payment_type">
                            <option value="pos" {{ old('payment_type', $order->getRawOriginal('payment_type')) == 'pos' ? 'selected' : '' }}>
                                {{ $order->getPaymentTypeAttribute('pos') }}
                            </option>
                            <option value="online" {{ old('payment_type', $order->getRawOriginal('payment_type')) == 'online' ? 'selected' : '' }}>
                                {{ $order->getPaymentTypeAttribute('online') }}
                            </option>
                        </select>
                        @error('payment_type')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label>وضعیت پرداخت</label>
                        <select class="form-control" name="payment_status">
                            <option value="0" {{ old('payment_status', $order->getRawOriginal('payment_status')) == 0 ? 'selected' : '' }}>
                                {{ $order->getPaymentStatusAttribute(0) }}
                            </option>
                            <option value="1" {{ old('payment_status', $order->getRawOriginal('payment_status')) == 1 ? 'selected' : '' }}>
                                {{ $order->getPaymentStatusAttribute(1) }}
                            </option>
                        </select>
                        @error('payment_status')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label>توضیحات</label>
                        <textarea class="form-control" name="description">{{ old('description', $order->description) }}</textarea>
                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label>توضیحات وضعیت</label>
                        <textarea class="form-control" name="status_description">{{ old('status_description', $order->status_description) }}</textarea>
                        @error('status_description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">بروزرسانی سفارش</button>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-dark mt-3">بازگشت</a>
            </form>
        </div>
    </div>
@endsection
