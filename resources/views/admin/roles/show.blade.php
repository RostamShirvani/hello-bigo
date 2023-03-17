@extends('admin.layouts.admin')

@section('title')
show role
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">نمایش نقش کاربری: {{$role->display_name}}</h5>
            </div>
            <hr>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">نام</label>
                        <input class="form-control" name="name" type="text" value="{{$role->name}}" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="name">نام نمایشی</label>
                        <input class="form-control" name="display_name" type="text" value="{{$role->display_name}}" disabled>
                    </div>

                    <div class="accordion mt-3 col-md-12" id="accordionPermission">
                        <div class="card">
                            <div class="card-header p-1" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-right" type="button" data-toggle="collapse" data-target="#collapsePermission" aria-expanded="true" aria-controls="collapsePermission">
                                        مجوزهای دسترسی
                                    </button>
                                </h2>
                            </div>

                            <div id="collapsePermission" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionPermission">
                                <div class="card-body row">
                                    @foreach($role->permissions as $permission)
                                        <div class="col-md-3">
                                            <span>{{$permission->display_name}}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <a href="{{route('admin.roles.index')}}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
        </div>
    </div>
@endsection
