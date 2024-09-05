@extends('admin.layouts.admin')

@section('title')
    using payment pins
@endsection

@section('content')
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-5 mx-auto mt-4" style="position: relative">
                <form action="{{ route('admin.payment-pins.using') }}"
                      method="POST"
                      class="ajax-form">
                    @csrf

                    <input type="hidden" name="app_type" id="app_type"
                           value="{{ request()->input('app_type') ?? \App\Enums\EAppType::BIGO_LIVE }}">

                    @if(request()->input('app_type') == \App\Enums\EAppType::LIKEE)
                        <h3>شارژ اکانت لایکی</h3>
                    @else
                        <h3>شارژ اکانت بیگو</h3>
                    @endif
                    <br>

                    <div class="mb-3" style="position:relative;">
                        <div class="user-preview">
                            <div class="avatar"></div>
                            <div class="name"></div>
                        </div>

                        <label for="bigo_id" class="form-label">آی دی اکانت</label>
                        <input type="text"
                               class="form-control user-preview-toggler"
                               name="bigo_id"
                               id="bigo_id"
                               value="{{ old('bigo_id') }}">
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label">میزان شارژ</label>
                        <select class="form-control"
                                name="amount"
                                id="amount">
                            <option value="" selected disabled></option>
                            @foreach($paymentPins as $paymentPin)
                                <option
                                    value="{{ $paymentPin->amount }}" {{ old('amount') == $paymentPin->id ? 'selected' : '' }}>
                                    ${{ $paymentPin->amount . ' ( '. (request()->input('app_type') == \App\Enums\EAppType::LIKEE ? $paymentPin->likee_value : $paymentPin->value) .' الماس )' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary btn-has-loader w-100">ثبت</button>
                        <button type="button" id="edit_account" class="btn btn-warning btn-has-loader w-100 d-none">
                            ویرایش اکانت
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container pt-8">
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
@endsection
