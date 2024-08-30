<!DOCTYPE html>
<html dir="rtl" lang="fa-IR">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="auth-sync" content="{{ route('site.auth.ajax.sync') }}">
    <meta name="auth-logout" content="{{ route('site.auth.ajax.logout') }}">
    <meta name="token-crisp" content="{{ env('CRISP_TOKEN') }}">

    @yield('metas')

    <link rel="stylesheet" href="{{ asset('site/plugins/bootstrap/css/bootstrap.rtl.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('site/css/style.css') }}"/>
    <link rel="stylesheet" href="{{ asset('site/css/responsive.css') }}"/>
    <link rel="stylesheet" href="{{ asset('site/plugins/swiper/swiper-bundle.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('site/plugins/bootstrap-icons/bootstrap-icons.css') }}"/>
    <link rel="stylesheet" href="{{ asset('site/plugins/nprogress/nprogress.css') }}"/>
    <link rel="stylesheet" href="{{ asset('site/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}"/>
    <link rel="stylesheet" href="{{ asset('site/plugins/ladda/ladda-themeless-rtl.min.css') }}"/>

    @yield('styles')
</head>
<body class="{{ auth()->check() ? 'authenticated' : '' }}">

<x-site-header/>

@if(session()->get('success'))
    <div class="container mt-4">
        <div class="alert alert-success">
            <ul>
                <li>{{ session()->get('success') }}</li>
            </ul>
        </div>
    </div>
@endif

@if(session()->get('error'))
    <div class="container mt-4">
        <div class="alert alert-danger">
            <ul>
                <li>{{ session()->get('error') }}</li>
            </ul>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="container mt-4">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@yield('content')

<footer class="text-muted pt-5 pb-2">
    <div class="container">

    </div>
</footer>

@include('site.modals.auth')

<script src="{{ asset('site/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('site/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('site/plugins/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('site/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('site/plugins/jquery-mask/jquery.mask.min.js') }}"></script>
<script src="{{ asset('site/plugins/nprogress/nprogress.js') }}"></script>
<script src="{{ asset('site/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
<script src="{{ asset('site/plugins/ladda/ladda.min.js') }}"></script>
<script src="{{ asset('site/plugins/ladda/spin.min.js') }}"></script>
<script src="{{ asset('site/js/script.js') }}"></script>

<script>
    @if(session()->get('success'))
    Swal.fire({
        icon: 'success',
        title: '{{ __trans('admin/general', 'success-operation') }}',
        html: '{{ session()->get('success') }}',
    });
    @endif

    @if(session()->get('error'))
    Swal.fire({
        icon: 'error',
        title: '{{ __trans('admin/general', 'failed-operation') }}',
        html: '{{ session()->get('error') }}',
    });
    @endif

    @if ($errors->any())
    Swal.fire({
        icon: 'error',
        title: '{{ __trans('admin/general', 'failed-operation') }}',
        html: 'اطلاعات وارد شده اشتباه میباشند!',
    });
    @endif
</script>

@yield('scripts')

</body>
</html>
