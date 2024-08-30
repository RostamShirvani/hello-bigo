@extends('admin.layouts.app')

@section('content')
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <form action="" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for=name>نام و نام خانوادگی</label>
                        <input type="text" name="name" class="form-control" value="{{$blacklist->name}}">
                    </div>
                    <div class="mb-3">
                        <label for=blackid>ایدی </label>
                        <input type="text" name="blackid" class="form-control" value="{{$blacklist->blackid}}">
                    </div>
                    <div class="mb-3">
                        <label for=mobile>موبایل </label>
                        <input type="text" name="mobile" class="form-control" value="{{$blacklist->mobile}}">
                    </div>
                    َ
                    <div class="mb-3">
                        <label for="Description">توصیحات </label>
                        <textarea name="Description" id="resume" class="form-control" >{{$blacklist->Description}}</textarea>
                    </div>

                    <button class="btn btn-info">ویرایش</button>
                </form>

            </div>
        </div>
    </div>
@endsection
