@extends('admin.layouts.admin')

@section('title')
    show product
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">محصول : {{$product->name}}</h5>
            </div>
            <hr>
            <div class="row">
                <div class="form-group col-md-3">
                    <label>نام</label>
                    <input class="form-control" type="text" value="{{$product->name}}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>نام برند</label>
                    <input class="form-control" type="text" value="{{$product->brand->name}}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>دسته بندی</label>
                    <input class="form-control" type="text" value="{{$product->category->name}}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>وضعیت</label>
                    <input class="form-control" type="text" value="{{$product->is_active}}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>تگ ها</label>
                    <div class="form-control div-disabled">
                        @foreach($product->tags as $tag)
                            {{$tag->name}} {{$loop->last ? '': ','}}
                            @endforeach
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label>تاریخ ایجاد</label>
                    <input class="form-control" type="text" value="{{verta($product->created_at)}}" disabled>
                </div>
                <div class="form-group col-md-12">
                    <label>توضیحات</label>
                    <textarea class="form-control" rows="3" disabled>{{$product->description}}</textarea>
                </div>

                {{-- Delivery Section --}}
                <div class="col-md-12">
                    <hr>
                    <p>هزینه ی ارسال: </p>
                </div>
                <div class="form-group col-md-3">
                    <label>هزینه ی ارسال</label>
                    <input class="form-control" type="text" value="{{$product->delivery_amount}}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>هزینه ی ارسال به ازای هر محصول اضافی</label>
                    <input class="form-control" type="text" value="{{$product->delivery_amount_per_product}}" disabled>
                </div>


                {{-- Attibutes & variations Section --}}
                <div class="col-md-12">
                    <hr>
                    <p>ویژگی ها: </p>
                </div>
                @foreach($productAttributes as $productAttribute)
                    <div class="form-group col-md-3">
                        <label>{{$productAttribute->attribute->name}}</label>
                        <input class="form-control" type="text" value="{{$productAttribute->value}}" disabled>
                    </div>
                @endforeach

                @foreach($productVariations as $variation)
                    <div class="col-md-12">
                        <hr>
                        <div class="d-flex">
                            <p class="mb-0">قیمت و موجودی برای متغیر ( {{$variation->value}} ) : </p>
                            <p class="mb-0 mr-3">
                                <button class="btn btn-sm btn-primary" type="button" data-toggle="collapse"
                                        data-target="#collapse-{{$variation->id}}">
                                    نمایش
                                </button>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="collapse mt-2" id="collapse-{{$variation->id}}">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>قیمت</label>
                                        <input class="form-control" type="text" value="{{$variation->price}}" disabled>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>تعداد</label>
                                        <input class="form-control" type="text" value="{{$variation->quantity}}"
                                               disabled>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>sku</label>
                                        <input class="form-control" type="text" value="{{$variation->sku}}" disabled>
                                    </div>
                                    {{--Sale section--}}
                                    <div class="col-md-12">
                                        <p>حراج: </p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>قیمت حراجی</label>
                                        <input class="form-control" type="text" value="{{$variation->sale_price}}"
                                               disabled>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>تاریخ شروع حراجی</label>
                                        <input class="form-control" type="text"
                                               value="{{$variation->date_on_sale_from == null ? null : verta($variation->date_on_sale_from)}}"
                                               disabled>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>تاریخ پایان حراجی</label>
                                        <input class="form-control" type="text"
                                               value="{{$variation->date_on_sale_to == null ? null : verta($variation->date_on_sale_to)}}"
                                               disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{--Sale section--}}
                <div class="col-md-12">
                    <p>حراج: </p>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <img class="card-img-top"
                             src="{{url(env('PRODUCT_IMAGES_UPLOAD_PATH').$product->primary_image)}}"
                             alt="{{$product->name}}">
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                </div>
                @foreach($images as $image)
                    <div class="col-md-3">
                        <div class="card">
                            <img class="card-img-top"
                                 src="{{url(env('PRODUCT_IMAGES_UPLOAD_PATH').$image->image)}}"
                                 alt="{{$product->name}}">
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="{{route('admin.tags.index')}}" class="btn btn-dark mt-5">بازگشت</a>
        </div>
    </div>
@endsection
