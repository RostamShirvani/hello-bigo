@extends('admin.layouts.app')

@section('content')
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <form action="{{ route('admin.gift_charge.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="razer_id">RazerId</label>
                        <input type="text" name="razer_id" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="email_address">EmailAddress</label>
                        <input type="email" name="email_address" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="total_charge_balance">شارژ فعلی</label>
                        <input type="number" name="total_charge_balance" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="charge_ceiling">سقف شارژ</label>
                        <input type="number" name="charge_ceiling" class="form-control">
                    </div>

                    <button class="btn btn-primary">افزودن</button>
                </form>

            </div>
        </div>
    </div>
@endsection