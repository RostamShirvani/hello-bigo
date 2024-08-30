@extends('admin.layouts.app')

@section('content')
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <form action="{{ route('admin.payment-pins.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="serial_number" class="form-label">سریال نامبر</label>
                        <input type="text"
                               class="form-control"
                               name="serial_number"
                               id="serial_number">
                    </div>

                    <div class="mb-3">
                        <label for="pin" class="form-label">پین</label>
                        <input type="text"
                               class="form-control"
                               name="pin"
                               id="pin">
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label">مقدار ($)</label>
                        <input type="number"
                               class="form-control"
                               name="amount"
                               id="amount">
                    </div>

                    <div class="mb-3">
                        <label for="value" class="form-label">تعداد الماس</label>
                        <input type="number"
                               class="form-control"
                               name="value"
                               id="value">
                    </div>

                    <button type="submit" class="btn btn-primary">ثبت</button>
                </form>
            </div>
        </div>
    </div>
@endsection
