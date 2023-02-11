@extends('admin.layouts.admin')

@section('title')
    edit product images
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ویرایش تصاویر محصول: {{$product->name}}</h5>
            </div>
            <hr>
            @include('admin.sections.errors')

            {{--Show primary image--}}
            <div class="row">
                <div class="col-12 col-md-12 mb-5">
                    <h5>تصویر اصلی :</h5>
                </div>
                <div class="col-12 col-md-3 mb-5">
                    <div class="card">
                        <img class="card-img-top" src="{{url(env('PRODUCT_IMAGES_UPLOAD_PATH').$product->primary_image)}}"
                             alt="{{$product->name}}">
                    </div>
                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-12 col-md-12 mb-5">
                    <h5>تصاویر :</h5>
                </div>
                @foreach($product->images as $image)
                    <div class="col-md-3">
                        <div class="card">
                            <img class="card-img-top"
                                 src="{{url(env('PRODUCT_IMAGES_UPLOAD_PATH').$image->image)}}"
                                 alt="{{$product->name}}">
                            <div class="card-body text-center">
                                <form action="{{route('admin.products.images.destroy', $product->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="image_id" value="{{$image->id}}">
                                    <button class="btn btn-danger btn-sm mb-3" type="submit">حذف</button>
                                </form>
                                <form action="{{route('admin.products.images.set_primary', $product->id)}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="image_id" value="{{$image->id}}">
                                    <button class="btn btn-primary btn-sm mb-3" type="submit">انتخاب به عنوان تصویر اصلی</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <hr>
            <form action="{{route('admin.products.images.add', $product->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label for="primary_image">انتخاب تصویر اصلی</label>
                        <input type="file" name="primary_image" id="primary_image" class="custom-file-input"/>
                        <label class="custom-file-label" for="primary_image"> انتخاب فایل </label>
                    </div>

                    <div class="col-md-4">
                        <label for="images">انتخاب تصاویر</label>
                        <input type="file" name="images[]" id="images" class="custom-file-input" multiple/>
                        <label class="custom-file-label" for="images"> انتخاب فایل ها </label>
                    </div>
                </div>

                <button class="btn btn-outline-primary mt-5" type="submit">ویرایش</button>
                <a href="{{route('admin.products.index')}}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>

        </div>
    </div>
@endsection

@section('js')
<script>
    // show file name
    $('#primary_image').change(function () {
        // get the file name
        var filename = $(this).val();
        // replace the "Choose s file" label
        $(this).next('.custom-file-label').html(filename)
    });

    $('#images').change(function () {
        // get the file name
        var filename = $(this).val();
        // replace the "Choose s file" label
        $(this).next('.custom-file-label').html(filename)
    });
</script>
@endsection
