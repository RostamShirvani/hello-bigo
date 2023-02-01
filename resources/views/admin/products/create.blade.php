@extends('admin.layouts.admin')

@section('title')
    create product
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">ایجاد محصول</h5>
            </div>
            <hr>
            @include('admin.sections.errors')
            <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">نام</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{old('name')}}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="brand_id">برند</label>
                        <select id="brandSelect" name="brand_id" class="form-control" data-live-search="true">
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="is_active">وضعیت</label>
                        <select class="form-control" id="is_active" name="is_active">
                            <option value="1" selected>فعال</option>
                            <option value="0">غیرفعال</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="tag_ids">تگ</label>
                        <select id="tagSelect" name="tag_ids[]" class="form-control" multiple
                                data-live-search="true">
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="description">توضیحات</label>
                        <textarea class="form-control" id="description" name="description"
                                  type="text">{{old('description')}}</textarea>
                    </div>

                    {{-- Product Image Section --}}

                    <div class="col-md-12">
                        <hr>
                        <p>تصاویر محصول: </p>
                    </div>

                    <div class="col-md-3">
                        <label for="primary_image">انتخاب تصویر اصلی</label>
                        <input type="file" name="primary_image" id="primary_image" class="custom-file-input" />
                        <label class="custom-file-label" for="primary_image"> انتخاب فایل </label>
                    </div>

                    <div class="col-md-3">
                        <label for="images">انتخاب تصاویر</label>
                        <input type="file" name="images[]" id="images" class="custom-file-input" multiple />
                        <label class="custom-file-label" for="images"> انتخاب فایل ها </label>
                    </div>

                </div>
                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{route('admin.products.index')}}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#brandSelect').selectpicker({
            'title': 'انتخاب برند'
        });
        $('#tagSelect').selectpicker({
            'title': 'انتخاب تگ'
        });
        // show file name
        $('#primary_image').change(function(){
            // get the file name
            var filename = $(this).val();
            // replace the "Choose s file" label
            $(this).next('.custom-file-label').html(filename)
        });

        $('#images').change(function(){
            // get the file name
            var filename = $(this).val();
            // replace the "Choose s file" label
            $(this).next('.custom-file-label').html(filename)
        });
    </script>
@endsection
