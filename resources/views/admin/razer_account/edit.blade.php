@extends('admin.layouts.admin')

@section('content')
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <form action="{{ route('admin.razer_accounts.update', ['id' => $razerAccount->id,  'type' => 'manual']) }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="razer_id">RazerId</label>
                        <input type="text" name="razer_id" class="form-control" value="{{$razerAccount->razer_id}}">
                    </div>

                    <div class="mb-3">
                        <label for="email_address">EmailAddress</label>
                        <input type="email" name="email_address" class="form-control" value="{{$razerAccount->email_address}}">
                    </div>

                    <div class="mb-3">
                        <label for="location">لوکیشن</label>
                        <input type="text" name="location" class="form-control" value="{{$razerAccount->location}}">
                    </div>

                    <div class="mb-3">
                        <label for="charge_balance">شارژ فعلی</label>
                        <input type="number" name="charge_balance" class="form-control" value="{{$razerAccount->charge_balance}}">
                    </div>

                    <div class="mb-3">
                        <label for="charge_ceiling">سقف شارژ</label>
                        <input type="number" name="charge_ceiling" class="form-control" value="{{$razerAccount->charge_ceiling}}">
                    </div>

                    <button class="btn btn-info">ویرایش</button>
                </form>

            </div>
        </div>
    </div>
@endsection
