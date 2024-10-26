@extends('admin.layouts.admin')

@section('title')
    Add black list
@endsection
@section('content')
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <form action="{{ route('admin.blacklist.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for=name>نام و نام خانوادگی</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for=black_id>ایدی </label>
                        <input type="text" name="black_id" id="black_id" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for=mobile>موبایل </label>
                        <input type="number" name="mobile" id="mobile" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for=amount>مبلغ </label>
                        <input type="number" name="amount" id="amount" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="description">توضیحات </label>
                        <textarea name="description" id="description" class="form-control"></textarea>
                    </div>

                    <button class="btn btn-primary">افزودن</button>
                </form>

            </div>
        </div>
    </div>
@endsection
