@extends('admin.layouts.admin')

@section('title')
    index other pins
@endsection
@section('style')
    <style>
        .lowsize-placeholder::placeholder {
            font-size: 10px; /* Adjust the font size here */
            color: #aaa; /* Optionally, change the color */
        }
    </style>
@endsection
@section('content')
    <div class="m-4">
        <div class="row">
            <div class="col-md-12 text-left py-2">
                <a href="{{ route('admin.other-pins.create') }}" class="btn btn-primary btn-sm">&#1575;&#1601;&#1586;&#1608;&#1583;&#1606;
                    &#1578;&#1705;&#1740;</a>
                <a href="{{ route('admin.other-pins.create', ['type' => 'bulk']) }}" class="btn btn-primary btn-sm">&#1575;&#1601;&#1586;&#1608;&#1583;&#1606;
                    &#1711;&#1585;&#1608;&#1607;&#1740;</a>
                <a href="{{ route('admin.other-pins.create', ['type' => 'file']) }}" class="btn btn-primary btn-sm">&#1575;&#1601;&#1586;&#1608;&#1583;&#1606;
                    &#1601;&#1575;&#1740;&#1604;</a>
            </div>
            <?php

            use Carbon\Carbon;

            $results = \App\Models\OtherPin\OtherPin::select('amount')
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

        <form action="{{ route('admin.other-pins.index') }}" method="GET">
            <table id="items" class="table table-striped" style="width: 100%">
                <thead>
                <tr>
                    <th>آیدی</th>
                    <th>مبلغ</th>
                    <th>شماره سفارش</th>
                    <th>شماره آیتم سفارش</th>
                    <th>آیدی کاربر</th>
                    <th>تاریخ استفاده</th>
                    <th>وضعیت</th>
                    <th>نوع</th>
                    <th>پین</th>
                    <th>الماس</th>
                    <th>موبایل</th>
                    <th>عملیات</th>
                </tr>
                <tr>
                    <th>
                        <input type="text" name="id" class="form-control" placeholder=""
                               value="{{ request('id') }}">
                    </th>
                    <th>
                        <input type="text" name="amount" class="form-control" placeholder=""
                               value="{{ request('amount') }}">
                    </th>
                    <th>
                        <input type="text" name="order_id" class="form-control" placeholder=""
                               value="{{ request('order_id') }}">
                    </th>
                    <th>
                        <input type="text" name="order_item_id" class="form-control" placeholder=""
                               value="{{ request('order_item_id') }}">
                    </th>
                    <th>
                        <input type="text" name="used_by" class="form-control" placeholder=""
                               value="{{ request('used_by') }}">
                    </th>
                    <th>
                        <input type="text" id="used_at" name="used_at" class="form-control lowsize-placeholder"
                               placeholder="مثال: 1403/06/26" value="{{ request()->input('used_at') }}">
                    </th>
                    <th>
                        <select name="status" class="form-control">
                            <option value="">همه</option>
                            @foreach(\App\Enums\EPaymentPinStatus::all() as $key => $value)
                                <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </th>
                    <th>
                        <select name="app_type" class="form-control">
                            <option value="">همه</option>
                            @foreach(\App\Enums\EAppType::other() as $key => $value)
                                <option value="{{ $key }}" {{ request('app_type') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </th>

                    <th>
                        <input type="text" name="pin" class="form-control" placeholder=""
                               value="{{ request('pin') }}">
                    </th>
                    <th>
                        <input type="text" name="value" class="form-control" placeholder=""
                               value="{{ request('value') }}">
                    </th>
                    <th>
                        <input type="text" name="used_by_mobile" class="form-control" placeholder=""
                               value="{{ request('used_by_mobile') }}">
                    </th>
                    <th>
                        <button type="submit" class="btn btn-primary">فیلتر</button>
                    </th>
                </tr>
                </thead>
                <tbody>
                @if($otherPins->count() > 0)
                    @foreach($otherPins as $otherPin)
                        <tr>
                            <td data-id="{{ $otherPin->id }}">{{ $otherPin->id }}</td>
                            <td>${{ $otherPin->amount }}</td>
                            <td style="width: 150px;">
                                <input type="text" value="{{ $otherPin->order_id }}" class="form-control" readonly
                                       data-order-id="{{ $otherPin->order_id }}">
                            </td>
                            <td style="width: 150px;">
                                <input type="text" value="{{ $otherPin->order_item_id }}" class="form-control" readonly
                                       data-order-item-id="{{ $otherPin->order_item_id }}">
                            </td>
                            <td>{{ $otherPin->used_by }}</td>
                            <td>
                                @if(!empty($otherPin->used_at))
                                    {{ dateTimeFormat($otherPin->used_at) }}
                                @else
                                    تعریف نشده
                                @endif
                            </td>

                            <td>
                                @if($otherPin->status === \App\Enums\EPaymentPinStatus::UNUSED)
                                    <span class="badge bg-success">{{ $otherPin->status_text }}</span>

                                    {{--                                <div class="d-inline-block">--}}
                                    {{--                                    <span--}}
                                    {{--                                            class="badge cursor-pointer {{ $otherPin->state == \App\Enums\EState::ENABLED ? 'bg-success' : 'bg-danger' }}"--}}
                                    {{--                                            data-stateable-id="{{ $otherPin->id }}"--}}
                                    {{--                                            data-stateable-type="{{ \App\Models\PaymentPin\OtherPin::class }}"--}}
                                    {{--                                    >{{ \App\Enums\EState::getTrans($otherPin->state) }}</span>--}}
                                    {{--                                </div>--}}
                                    <div class="d-inline-block">
                                    <span
                                        class="badge cursor-pointer toggle-state {{ $otherPin->state == \App\Enums\EState::ENABLED ? 'bg-success' : 'bg-danger' }}"
                                        data-id="{{ $otherPin->id }}"
                                        data-state="{{ $otherPin->state }}"
                                    >{{ \App\Enums\EState::getTrans($otherPin->state) }}</span>
                                    </div>
                                @elseif($otherPin->status === \App\Enums\EPaymentPinStatus::USED)
                                    <span class="badge bg-danger">{{ $otherPin->status_text }}</span>
                                @else
                                    <span class="badge bg-warning">{{ $otherPin->status_text }}</span>
                                @endif
                            </td>

                            <td>{{ \App\Enums\EAppType::getName($otherPin->app_type) }}</td>
                            <td>{{ $otherPin->pin }}</td>
                            <td>{{ $otherPin->value }}</td>
                            <td>{{ $otherPin->used_by_mobile }}</td>

                            <td>
                                <button type="button" class="btn btn-sm btn-warning edit-btn">ویرایش</button>
                                <button type="button" class="btn btn-sm btn-success save-btn d-none">ذخیره</button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="12">
                            <div class="container mt-4 text-center text-secondary">
                                <i class="bi bi-box" style="font-size: 3rem"></i>

                                <div>هیچ رکوردی برای نمایش وجود ندارد.</div>
                            </div>
                        </td>

                    </tr>

                @endif
                </tbody>
            </table>
        </form>

        <div class="d-flex justify-content-center mt-4">{!! $otherPins->links('pagination::bootstrap-4') !!}</div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            // Edit button functionality
            $('.edit-btn').click(function () {
                var row = $(this).closest('tr');
                row.find('input').removeAttr('readonly');  // Enable input fields for the row
                $(this).addClass('d-none');  // Hide Edit button
                row.find('.save-btn').removeClass('d-none');  // Show Save button
            });

            // Save button functionality (with Ajax)
            $('.save-btn').click(function () {
                var row = $(this).closest('tr');

                // Retrieve the 'data-id' from the <td> element
                var otherPinId = row.find('td').data('id');

                // Retrieve values from data attributes in the input elements
                var updatedData = {
                    order_id: row.find('input[data-order-id]').data('order-id'),
                    order_item_id: row.find('input[data-order-item-id]').data('order-item-id'),
                };

                // Send Ajax request
                $.ajax({
                    url: '/admin/other-pins/update/' + otherPinId,
                    type: 'POST',
                    data: updatedData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // for CSRF protection
                    },
                    success: function (response) {
                        // Handle success response (e.g., show a success message)
                        // alert('Updated successfully!');

                        // Make inputs readonly again
                        row.find('input').attr('readonly', 'readonly');

                        // Toggle buttons
                        row.find('.save-btn').addClass('d-none');
                        row.find('.edit-btn').removeClass('d-none');
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr);  // Inspect the full response object
                        console.log(status);
                        console.log(error);
                        alert('Error updating the record!');
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Select all elements with the class 'toggle-state'
            const toggleElements = document.querySelectorAll('.toggle-state');

            toggleElements.forEach(element => {
                element.addEventListener('click', function () {
                    let paymentPinId = this.getAttribute('data-id');
                    let currentState = this.getAttribute('data-state');

                    // Prepare the new state based on the current state
                    let newState = (currentState == 1) ? 2 : 1;

                    fetch(`/admin/other-pins/toggle-state/${paymentPinId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({state: newState})
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Update the badge color and text based on the new state
                                this.classList.toggle('bg-success', newState == 1);
                                this.classList.toggle('bg-danger', newState == 2);
                                this.textContent = (newState == 1) ? "{{ \App\Enums\EState::getTrans(\App\Enums\EState::ENABLED) }}" : "{{ \App\Enums\EState::getTrans(\App\Enums\EState::DISABLED) }}";

                                // Update data-state attribute
                                this.setAttribute('data-state', newState);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });
            });
        });
    </script>
@endsection
