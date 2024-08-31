@extends('admin.layouts.admin')

@section('title')
    create payment pins
@endsection

@section('content')
    <div class="p-4">
        <div class="row">

            <div class="col-md-5 mx-auto">
                <form action="{{ route('admin.payment-pins.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="serial_number" class="form-label">سریال نامبر</label>
                        <input type="text"
                               class="form-control"
                               name="serial_number"
                               id="serial_number"
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="pin" class="form-label">پین</label>
                        <input type="text"
                               class="form-control"
                               name="pin"
                               id="pin"
                               required>
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
                        <label for="value" class="form-label">الماس بیگو</label>
                        <input type="number"
                               class="form-control"
                               name="value"
                               id="value"
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="likee_value" class="form-label">الماس لایکی</label>
                        <input type="number"
                               class="form-control"
                               name="likee_value"
                               id="likee_value"
                               required>
                    </div>

                    <button type="submit" class="btn btn-primary">ثبت</button>
                </form>
            </div>
        </div>
    </div>
@endsection
