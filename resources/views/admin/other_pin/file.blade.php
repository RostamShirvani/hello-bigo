@extends('admin.layouts.admin')

@section('title')
    file other pins
@endsection

@section('content')
    <div class="p-4">
        <div class="row">
            <div class="col-md-6 m-auto">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <form action="{{ route('admin.other-pins.store') }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="type" value="file">

                            <div class="mb-3">
                                <label for="file" class="form-label">فایل</label>
                                <input class="form-control" type="file" name="file" id="file" required>
                            </div>
                            <div class="mb-3">
                                <label for="app_type">نوع پین</label>
                                <select id="typeSelect" name="app_type" class="form-control" data-live-search="true">
                                    <option value="">انتخاب کنید ...</option>
                                    @foreach(\App\Enums\EAppType::other() as $key => $value)
                                        <option value="{{ $key }}" {{ $key == old('type') ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="amount" class="form-label">مقدار ($)</label>
                                <input type="text"
                                       class="form-control"
                                       name="amount"
                                       id="amount"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label for="value" class="form-label">تعداد الماس</label>
                                <input type="number"
                                       class="form-control"
                                       name="value"
                                       id="value"
                                       required>
                            </div>

                            <button type="submit" class="btn btn-primary">ثبت</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container pt-8">
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
@endsection
