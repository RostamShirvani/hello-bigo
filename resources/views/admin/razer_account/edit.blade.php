@extends('admin.layouts.admin')

@section('content')
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <form action="{{ route('admin.razer_accounts.update', ['id' => $razerAccount->id,  'type' => 'manual']) }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="razer_id">RazerId</label>
                        <input type="text" name="razer_id" id="razer_id" class="form-control" value="{{$razerAccount->razer_id}}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="email_address">EmailAddress</label>
                        <input type="email" name="email_address" id="email_address" class="form-control" value="{{$razerAccount->email_address}}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="location">لوکیشن</label>
                        <input type="text" name="location" id="location" class="form-control" value="{{$razerAccount->location}}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="charge_balance">شارژ فعلی</label>
                        <input type="number" name="charge_balance" id="charge_balance" class="form-control" value="{{$razerAccount->charge_balance}}">
                    </div>

                    <div class="mb-3">
                        <label for="charge_ceiling">سقف شارژ</label>
                        <input type="number" name="charge_ceiling" id="charge_ceiling" class="form-control" value="{{$razerAccount->charge_ceiling}}">
                    </div>

                    <div class="mb-3">
                        <label for="priority">اولویت</label>
                        <input type="number" name="priority" id="priority" class="form-control" value="{{$razerAccount->priority}}">
                    </div>

                    <!-- Checkbox for bigo_updated_at -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="bigo_updated_at" id="bigo_updated_at" class="form-check-input" value="1">
                        <label class="form-check-label mr-4" for="bigo_updated_at">به روز رسانی بیگو</label>
                    </div>

                    <!-- Checkbox for pubg_updated_at -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="pubg_updated_at" id="pubg_updated_at" class="form-check-input" value="1">
                        <label class="form-check-label mr-4" for="pubg_updated_at">به روز رسانی پابجی</label>
                    </div>

                    <button class="btn btn-info">ویرایش</button>
                </form>

            </div>
        </div>
    </div>
@endsection
