@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 text-left py-2">
                <a href="{{ route('admin.gift_charge.add')}}" class="btn btn-primary btn-sm">افزودن اکانت</a>
            </div>

            <table id="items" class="table table-striped" style="width: 100%">
                <thead>
                <tr>

                    <th>آیدی</th>
                    <th>RazerId</th>
                    <th>EmailAddress</th>
                    <th>شارژ فعلی</th>
                    <th>سقف شارژ</th>
                    <th>ویرایش در</th>
                    <th>تاریخ ویرایش</th>
                </tr>
                </thead>
                <tbody>
                <?php

                use Carbon\Carbon;

                ?>
                @foreach($giftCharges as $giftCharge)
                        <?php
                        $updatedAt = $giftCharge->updated_at;
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
                        ?>
                    <tr>

                        <td>{{ $giftCharge->id }}</td>
                        <td>{{ $giftCharge->razer_id }}</td>
                        <td>{{ $giftCharge->email_address }}</td>
                        <td>{{ $giftCharge->total_charge_balance }}</td>
                        <td>{{ $giftCharge->charge_ceiling }}</td>
                        <td>{{ $humanReadableTime }}</td>
                        <td>{{ dateTimeFormat($giftCharge->updated_at) }}</td>
                        <td>
                            <div style="display: flex; gap: 5px;">
                                <form action="{{ route('admin.gift_charge.delete', $giftCharge->id)}}" method="post"
                                      style="display: inline;">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" type="submit">حذف</button>
                                </form>
                                <a class="btn btn-warning" href="{{ route('admin.gift_charge.edit', $giftCharge->id)}}"
                                   style="margin-left: 5px;">ویرایش</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


        </div>
    </div>

@endsection