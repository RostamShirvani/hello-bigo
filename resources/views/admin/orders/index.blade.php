@extends('admin.layouts.admin')

@section('title')
    index orders
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 d-flex flex-column text-center flex-md-row justify-content-md-between">
                <h5 class="font-weight-bold mb-3 mb-md-0">لیست سفارشات ({{ $orders->total() }})</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                    <tr>
{{--                        <th>#</th>--}}
                        <th>ID</th>
                        <th>نام کاربر</th>
                        <th>وضعیت</th>
                        <th>مبلغ</th>
                        <th>نوع پرداخت</th>
                        <th>وضعیت پرداخت</th>
                        <th>توضیحات وضعیت</th>
                        <th>عملیات</th>
                    </tr>

                    </thead>
                    <tbody>
                    @foreach($orders as $key=>$order)
                        <tr>
{{--                            <th>{{$orders->firstItem() + $key}}</th>--}}
                            <th>{{$order->id}}</th>
                            <th>{{$order->user->name ?? 'کاربر'}}</th>
                            <th>
                                @switch($order->getRawOriginal('status'))
                                    @case(\App\Models\Order::STATUS_PAID_AND_COMPLETED)
                                        <span class="badge bg-success">{{ $order->status }}</span>
                                        @break

                                    @case(\App\Models\Order::STATUS_NEW)
                                        <span class="badge bg-warning">{{ $order->status }}</span>
                                        @break

                                    @default
                                        <span class="badge bg-danger">{{ $order->status }}</span>
                                @endswitch
                            </th>
                            <th>{{number_format($order->total_amount)}}</th>
                            <th>{{$order->payment_type}}</th>
                            <th>{{$order->payment_status}}</th>
                            <th>{!! $order->status_description !!}</th>
                            <th>
                                <a class="btn btn-sm btn-outline-success"
                                   href="{{route('admin.orders.show', $order->id)}}">نمایش</a>
                                <a class="btn btn-sm btn-outline-info mr-3"
                                   href="{{route('admin.orders.edit', $order->id)}}">ویرایش</a>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-5">
                {{$orders->render()}}
            </div>
        </div>
    </div>
@endsection
