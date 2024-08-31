@extends('admin.layouts.admin')

@section('content')
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <form action="" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for=name>نام و نام خانوادگی</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$blacklist->name}}">
                    </div>
                    <div class="mb-3">
                        <label for=black_id>ایدی </label>
                        <input type="text" name="black_id" id="black_id" class="form-control" value="{{$blacklist->blackid}}">
                    </div>
                    <div class="mb-3">
                        <label for=mobile>موبایل </label>
                        <input type="text" name="mobile" id="mobile" class="form-control" value="{{$blacklist->mobile}}">
                    </div>
                    َ
                    <div class="mb-3">
                        <label for="description">توصیحات </label>
                        <textarea name="description" id="description" class="form-control" >{{$blacklist->Description}}</textarea>
                    </div>

                    <button class="btn btn-info">ویرایش</button>
                </form>

            </div>
        </div>
    </div>
@endsection
