@extends('admin.layouts.admin')

@section('title')
    index payment pins
@endsection
@section('content')
    <div class="m-4">
        <div class="row">
            <div class="col-md-12 text-left py-2">

                <a href="{{ route('admin.payment-pins.create') }}" class="btn btn-primary btn-sm">&#1575;&#1601;&#1586;&#1608;&#1583;&#1606; &#1578;&#1705;&#1740;</a>
                <a href="{{ route('admin.payment-pins.create', ['type' => 'bulk']) }}" class="btn btn-primary btn-sm">&#1575;&#1601;&#1586;&#1608;&#1583;&#1606;
                    &#1711;&#1585;&#1608;&#1607;&#1740;</a>
                <a href="{{ route('admin.payment-pins.create', ['type' => 'file']) }}" class="btn btn-primary btn-sm">&#1575;&#1601;&#1586;&#1608;&#1583;&#1606;
                    &#1601;&#1575;&#1740;&#1604;</a>
            </div>
 <?php
            use Carbon\Carbon;

            $results = \App\Models\PaymentPin\PaymentPin::select('amount')
                ->selectRaw('SUM(CASE WHEN status = 1 AND state = 1 THEN 1 ELSE 0 END) as free_count')
                ->selectRaw('SUM(CASE WHEN status = 1 AND state = 2 THEN 1 ELSE 0 END) as free_count2')
                ->selectRaw('SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) as used_count')
                ->selectRaw('SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as rejected_count')
                ->selectRaw('SUM(CASE WHEN DATE(used_at) = CURDATE() THEN 1 ELSE 0 END) as used_count_today')
               ->selectRaw('SUM(CASE WHEN DATE(used_at) = CURDATE() - INTERVAL 1 DAY THEN 1 ELSE 0 END) as used_count_yesterday')
                ->groupBy('amount')
                ->get();
                $results = $results->sortBy('amount');
            ?>


            <table id="itemsw" class="table table-striped" style="width: 100%">
                <thead>
                <tr>
                    <th style="text-align: center;">مبلغ</th>
                    <th style="text-align: center;">موجودی</th>
                    <th style="text-align: center;">غیر فعال</th>
                    <th style="text-align: center;">سفارشات</th>
                    <th style="text-align: center;">رد شده</th>
                    <th style="text-align: center;">سفارشات امروز</th>
                    <th style="text-align: center;">سفارشات دیروز</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($results as $result) {
                    echo "<tr>";
                    echo "<td>" . $result->amount . "</td>";
                    echo "<td style='background-color: #1f6e44; color: white; border-radius: 5px; text-align: center;'>" . $result->free_count . "</td>";
                    echo "<td style='background-color: #1988b9; color: white; border-radius: 5px; text-align: center;'>" . $result->free_count2 . "</td>";
                    echo "<td style='background-color: #6e1f1f; color: white; border-radius: 5px; text-align: center;'>" . $result->used_count . "</td>";
                    echo "<td style='background-color: #d59a05; color: white; border-radius: 5px; text-align: center;'>" . $result->rejected_count . "</td>";
                    echo "<td style='background-color: #64326d; color: white; border-radius: 5px; text-align: center;'>" . $result->used_count_today . "</td>";
                    echo "<td style='background-color: #1f3e44; color: white; border-radius: 5px; text-align: center;'>" . $result->used_count_yesterday . "</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>

        @if($paymentPins->count() > 0)
            <table id="items" class="table table-striped" style="width: 100%">
                <thead>
                <tr>
                    <th>مبلغ</th>
                    <th>شماره سفارش</th>
                    <th>ایدی کاربر</th>
                    <th>تاریخ استفاده</th>
                    <th>وضعیت</th>
                    <th>سریال</th>
                    <th>پین</th>
                    <th>بیگو</th>
                    <th>لایکی</th>
                    <th>موبایل</th>
                </tr>
                </thead>
                <tbody>
                @foreach($paymentPins as $paymentPin)
                    <tr>
                        <td>${{ $paymentPin->amount }}</td>
                        <td>
                            {{ $paymentPin->wp_order_id }}
                        </td>
                        <td>{{ $paymentPin->used_by }}</td>
                        <td>
                            @if(!empty($paymentPin->used_at))
                                {{ dateTimeFormat($paymentPin->used_at) }}
                            @else
                                تعریف نشده
                            @endif
                        </td>

                        <td>
                            @if($paymentPin->status === \App\Enums\EPaymentPinStatus::UNUSED)
                                <span class="badge bg-success">{{ $paymentPin->status_text }}</span>

                                <div class="d-inline-block">
                                    <span
                                            class="badge cursor-pointer {{ $paymentPin->state == \App\Enums\EState::ENABLED ? 'bg-success' : 'bg-danger' }}"
                                            data-stateable-id="{{ $paymentPin->id }}"
                                            data-stateable-type="{{ \App\Models\PaymentPin\PaymentPin::class }}"
                                    >{{ \App\Enums\EState::getTrans($paymentPin->state) }}</span>
                                </div>
                            @elseif($paymentPin->status === \App\Enums\EPaymentPinStatus::USED)
                                <span class="badge bg-danger">{{ $paymentPin->status_text }}</span>
                            @else
                                <span class="badge bg-warning">{{ $paymentPin->status_text }}</span>
                            @endif
                        </td>

                        <td>{{ $paymentPin->serial_number }}</td>
                        <td>{{ $paymentPin->pin }}</td>
                        <td>{{ $paymentPin->value }}</td>
                        <td>{{ $paymentPin->likee_value }}</td>
                        <td>{{ $paymentPin->used_by_mobile }}</td>


                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="container mt-4 text-center text-secondary">
                <i class="bi bi-box" style="font-size: 3rem"></i>

                <div>هیچ رکوردی برای نمایش وجود ندارد.</div>
            </div>
        @endif
    </div>
@endsection
