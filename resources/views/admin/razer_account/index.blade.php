@extends('admin.layouts.admin')

@section('title')
    index razer accounts
@endsection
@section('content')
    <div class="mt-4">
        <div class="flex justify-center items-center">
            <h5 class="text-lg font-semibold text-gray-700">
                مجموع شارژ اکانت ها: <span class="btn btn-outline-success">{{ number_format($totalChargeBalance) }}</span>
            </h5>
        </div>

        <div class="row">
            <div class="col-md-12 text-left py-2">
                <a href="{{ route('admin.razer_accounts.add')}}" class="btn btn-primary btn-sm">افزودن اکانت</a>
            </div>

            <div class="table-responsive">
                <table id="items" class="table table-striped" style="width: 100%">
                    <thead>
                    <tr>
                        <th>آیدی</th>
                        <th>فعال</th>
                        <th>RazerId</th>
                        <th>EmailAddress</th>
                        <th>لوکیشن</th>
                        <th>شارژ فعلی</th>
                        <th>سقف شارژ</th>
                        <th>اولویت</th>
                        <th>بیگو</th>
                        <th>پابجی</th>
                        <th>ویرایش در</th>
                        <th>تاریخ آخرین ویرایش</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    use Carbon\Carbon;

                    ?>
                    @foreach($razerAccounts as $razerAccount)
                            <?php
                            if (!blank($razerAccount->updated_at)) {
                                $updatedAt = $razerAccount->updated_at;
                                $now = Carbon::now();

                                $days = $updatedAt->diffInDays($now);
                                $hours = $updatedAt->copy()->addDays($days)->diffInHours($now);
                                $minutes = $updatedAt->copy()->addDays($days)->addHours($hours)->diffInMinutes($now);

//                        $humanReadableTime = "{$days} روز, {$hours} hours, and {$minutes} minutes ago";
//                        $humanReadableTime = "{$days} روز و {$hours} ساعت و {$minutes} دقیقه پیش";
                                if ($minutes == 0 && $hours == 0 && $days == 0) {
                                    $humanReadableTime = "لحظاتی پیش";
                                } elseif ($minutes > 0 && $hours == 0 && $days == 0) {
                                    $humanReadableTime = "{$minutes} دقیقه پیش";
                                } elseif ($hours > 0 && $days == 0) {
                                    $humanReadableTime = "{$hours} ساعت و {$minutes} دقیقه پیش";
                                } else {
                                    $humanReadableTime = "{$days} روز و {$hours} ساعت و {$minutes} دقیقه پیش";
                                }
                            }
                            if (!blank($razerAccount->pubg_updated_at)) {
                                $updatedAt = $razerAccount->pubg_updated_at;
                                $now = Carbon::now();

                                $days = $updatedAt->diffInDays($now);
                                $hours = $updatedAt->copy()->addDays($days)->diffInHours($now);
                                $minutes = $updatedAt->copy()->addDays($days)->addHours($hours)->diffInMinutes($now);

//                        $humanReadableTime = "{$days} روز, {$hours} hours, and {$minutes} minutes ago";
//                        $humanReadableTime = "{$days} روز و {$hours} ساعت و {$minutes} دقیقه پیش";
                                if ($minutes == 0 && $hours == 0 && $days == 0) {
                                    $pubgHumanReadableTime = "لحظاتی پیش";
                                } elseif ($minutes > 0 && $hours == 0 && $days == 0) {
                                    $pubgHumanReadableTime = "{$minutes} دقیقه پیش";
                                } elseif ($hours > 0 && $days == 0) {
                                    $pubgHumanReadableTime = "{$hours} ساعت و {$minutes} دقیقه پیش";
                                } else {
                                    $pubgHumanReadableTime = "{$days} روز و {$hours} ساعت و {$minutes} دقیقه پیش";
                                }
                            }
                            if (!blank($razerAccount->bigo_updated_at)) {
                                $updatedAt = $razerAccount->bigo_updated_at;
                                $now = Carbon::now();

                                $days = $updatedAt->diffInDays($now);
                                $hours = $updatedAt->copy()->addDays($days)->diffInHours($now);
                                $minutes = $updatedAt->copy()->addDays($days)->addHours($hours)->diffInMinutes($now);

//                        $humanReadableTime = "{$days} روز, {$hours} hours, and {$minutes} minutes ago";
//                        $humanReadableTime = "{$days} روز و {$hours} ساعت و {$minutes} دقیقه پیش";
                                if ($minutes == 0 && $hours == 0 && $days == 0) {
                                    $bigoHumanReadableTime = "لحظاتی پیش";
                                } elseif ($minutes > 0 && $hours == 0 && $days == 0) {
                                    $bigoHumanReadableTime = "{$minutes} دقیقه پیش";
                                } elseif ($hours > 0 && $days == 0) {
                                    $bigoHumanReadableTime = "{$hours} ساعت و {$minutes} دقیقه پیش";
                                } else {
                                    $bigoHumanReadableTime = "{$days} روز و {$hours} ساعت و {$minutes} دقیقه پیش";
                                }
                            }
                            ?>
                        <tr>

                            <td>{{ $razerAccount->id }}</td>
                            <td style="display: flex; align-items: center; justify-content: center;">
                                {!! $razerAccount->id == \App\Models\RazerAccount::getCurrentSelectedRazerAccount()->id
                                    ? '<i class="fas fa-check-circle text-success" title="Online"></i>'
                                    : '<i class="fas fa-times-circle text-danger" title="Offline"></i>' !!}
                            </td>
                            <td>{{ $razerAccount->razer_id }}</td>
                            <td>{{ $razerAccount->email_address }}</td>
                            <td>{{ $razerAccount->location }}</td>
                            <td>{{ number_format($razerAccount->charge_balance) }}</td>
                            <td>{{ number_format($razerAccount->charge_ceiling) }}</td>
                            <td>{{ $razerAccount->priority }}</td>
                            <td>{{ $bigoHumanReadableTime ?? '-' }}</td>
                            <td>{{ $pubgHumanReadableTime ?? '-' }}</td>
                            <td>{{ $humanReadableTime ?? '-' }}</td>
                            <td>{{ $razerAccount->updated_at ? dateTimeFormat($razerAccount->updated_at) : '-' }}</td>
                            <td>
                                <div style="display: flex; gap: 5px;">
                                    <form action="{{ route('admin.razer_accounts.delete', $razerAccount->id)}}"
                                          method="post"
                                          style="display: inline;">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger" type="submit">حذف</button>
                                    </form>
                                    <a class="btn btn-warning"
                                       href="{{ route('admin.razer_accounts.edit', $razerAccount->id)}}"
                                       style="margin-left: 5px;">ویرایش</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>

@endsection
