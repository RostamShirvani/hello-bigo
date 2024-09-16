@extends('admin.layouts.admin')

@section('title')
    create other pin
@endsection

@section('content')
    <div class="p-4">
        <div class="row">

            <div class="col-md-5 mx-auto">
                <form action="{{ route('admin.other-pins.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="pin" class="form-label">پین</label>
                        <input type="text"
                               class="form-control"
                               name="pin"
                               id="pin"
                               value="{{ old('pin') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="app_type">نوع پین</label>
                        <select id="typeSelect" name="app_type" class="form-control" data-live-search="true">
                            <option value="">انتخاب کنید ...</option>
                            @foreach(\App\Enums\EAppType::other() as $key => $value)
                                <option value="{{ $key }}" {{ $key == old('app_type') ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label">مقدار ($)</label>
                        <input type="number"
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
@endsection
