@extends('admin.layouts.app')

@section('content')
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <form action="{{ route('admin.blacklist.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for=name>نام و نام خانوادگی</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for=blackid>ایدی </label>
                        <input type="text" name="blackid" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for=mobile>موبایل </label>
                        <input type="number" name="mobile" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for=amount>مبلغ </label>
                        <input type="number" name="amount" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="Description">توصیحات </label>
                        <textarea name="Description" id="resume" class="form-control"></textarea>
                    </div>

                    <button class="btn btn-primary">افزودن</button>
                </form>

            </div>
        </div>
    </div>
@endsection