@extends('admin.layouts.admin')

@section('title')
    تنظیمات کلی سایت
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">تنظیمات کلی سایت: </h5>
            </div>
            <hr>
            @include('admin.sections.errors')
            <form action="{{route('admin.settings.update')}}" method="POST">
                @csrf
                @method('put')

                @if(isset($setting))
                    <div class="form-group col-md-6">
                        <label>توکن:</label>
                        <textarea id="tokenTextarea" rows="4" class="form-control" name="token" readonly>{{ $setting->token }}</textarea>
                    </div>

                    <button type="button" id="editButton" class="btn btn-primary" onclick="toggleReadonly()">تغییر توکن</button>
<span class="text-danger">توجه! این دکمه صرفا جهت جلوگیری از ویرایش سهوی توکن می باشد. برای اعمال تغییرات نهایی، بر روی دکمه ی ویرایش پایین صفحه کلیک نمایید.</span>

                    {{-- Gateway Section --}}
                    <div class="col-md-12">
                        <hr>
                        <p>درگاه های پرداخت: </p>
                    </div>

                    <!-- Checkbox for zarinpal_gateway -->
                    <div class="form-group col-md-3 form-check">
                        <input type="checkbox" name="zarinpal_gateway" id="zarinpal_gateway" class="form-check-input" value="{{ $setting?->zarinpal_gateway }}" {{ $setting?->zarinpal_gateway ? 'checked' : '' }}>
                        <label class="form-check-label mr-4" for="zarinpal_gateway">درگاه زرین پال</label>
                    </div>
                    <!-- Checkbox for zibal_gateway -->
                    <div class="form-group col-md-3 form-check">
                        <input type="checkbox" name="zibal_gateway" id="zibal_gateway" class="form-check-input" value="{{ $setting?->zibal_gateway }}" {{ $setting?->zibal_gateway ? 'checked' : '' }}>
                        <label class="form-check-label mr-4" for="zibal_gateway">درگاه زیبال</label>
                    </div>
                    {{-- SMS Section --}}
                    <div class="col-md-12">
                        <hr>
                        <p>پنل پیامک: </p>
                    </div>
                    <!-- SMS chanel -->
                    <div class="form-group col-md-3">
{{--                        <label for="sms_channel">پنل پیامک</label>--}}
                        <select class="form-control" id="sms_channel" name="sms_channel" type="text">
                            @foreach(\App\Enums\ESMSChannel::all() as $key => $value)
                                <option value="{{$key}}"
                                    {{$setting->sms_channel == $key ? 'selected' : ''}}
                                >{{$value}}</option>
                            @endforeach
                        </select>
                    </div>

                    <button class="btn btn-outline-primary mt-5" type="submit">ویرایش</button>
                @endif
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function toggleReadonly() {
            const textarea = document.getElementById('tokenTextarea');
            const button = document.getElementById('editButton');

            // Toggle the readonly attribute
            if (textarea.hasAttribute('readonly')) {
                textarea.removeAttribute('readonly');
                button.textContent = 'پایان تغییر';  // Change button text
            } else {
                textarea.setAttribute('readonly', 'readonly');
                button.textContent = 'تغییر توکن';  // Change button text
            }
        }
    </script>
@endsection
