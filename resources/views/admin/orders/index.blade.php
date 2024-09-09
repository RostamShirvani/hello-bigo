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
                        <th>تعداد آیتم</th>
                        <th>توضیحات وضعیت</th>
                        <th>تاریخ ایجاد</th>
                        <th>تاریخ ویرایش</th>
                        <th>عملیات</th>
                    </tr>

                    </thead>
                    <tbody>
                    @foreach($orders as $key=>$order)
                        <tr>
{{--                            <th>{{$orders->firstItem() + $key}}</th>--}}
                            <td>{{$order->id}}</td>
                            <td>{{$order->user->name ?? 'کاربر'}}</td>
                            <td>
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
                            <td>{{number_format($order->total_amount)}}</td>
                            <td>{{number_format($order->orderItems->count())}}</td>
                            <td>{!! $order->status_description !!}</td>
                            <td>
                                {{ $order->created_at ? dateTimeFormat($order->created_at, 'Y-m-d') : '-' }}<br>
                                {{ $order->created_at ? dateTimeFormat($order->created_at, 'H:i:s') : '-' }}
                            </td>
                            <td>
                                {{ $order->updated_at ? dateTimeFormat($order->updated_at, 'Y-m-d') : '-' }}<br>
                                {{ $order->updated_at ? dateTimeFormat($order->updated_at, 'H:i:s') : '-' }}
                            </td>
                            <td>
                                <a class="btn btn-sm btn-outline-success"
                                   href="{{route('admin.orders.show', $order->id)}}">نمایش</a>
                                <a class="btn btn-sm btn-outline-info mr-3"
                                   href="{{route('admin.orders.edit', $order->id)}}">ویرایش</a>
                            </td>
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
