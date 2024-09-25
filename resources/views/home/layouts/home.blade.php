<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{env('APP_NAME')}} - @yield('title')</title>
    <!-- font---------------------------------------->
    <link rel="stylesheet" href="{{ asset('/assets/newsite/css/vendor/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/newsite/css/vendor/materialdesignicons.css') }}">
    <!-- plugin-------------------------------------->
    <!-- Custom styles for this template-->
{{--    <link href="{{asset('/css/home.css')}}" rel="stylesheet">--}}
{{--    <link rel="stylesheet" href="{{ asset('/assets/site/css/style.css') }}"/>--}}
    {{--    @vite(['resources/css/app.css', 'resources/js/admin/admin.js', 'resources/js/home/home.js'])--}}

    <link rel="stylesheet" href="{{ asset('/assets/newsite/css/vendor/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/newsite/css/vendor/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/newsite/css/vendor/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/newsite/css/vendor/jquery.jqZoom.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/newsite/css/vendor/sweetalert2.min.css') }}">
    <!-- main-style---------------------------------->
    <link rel="stylesheet" href="{{ asset('/assets/newsite/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/newsite/css/responsive.css') }}">


    @yield('style')

    {!! SEO::generate() !!}

</head>

<body>

    @include('home.sections.header')

    @yield('content')

    @include('home.sections.footer')
</body>
<!-- file js---------------------------------------------------->
<script src="{{ asset('/assets/newsite/js/vendor/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('/assets/newsite/js/vendor/bootstrap.js') }}"></script>
<!-- plugin----------------------------------------------------->
<script src="{{ asset('/assets/newsite/js/vendor/owl.carousel.min.js') }}"></script>
<script src="{{ asset('/assets/newsite/js/vendor/jquery.countdown.js') }}"></script>
<script src="{{ asset('/assets/newsite/js/vendor/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('/assets/newsite/js/vendor/jquery.jqZoom.js') }}"></script>
<script src="{{ asset('/assets/newsite/js/vendor/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('/js/home.js') }}"></script>
{{--<script src="{{ asset('/assets/admin/js/script.js') }}"></script>--}}
<!-- main js---------------------------------------------------->
<script src="{{ asset('/assets/newsite/js/main.js') }}"></script>
@include('sweetalert::alert')
@yield('script')
{!!  GoogleReCaptchaV3::init() !!}
{{--<script>--}}
{{--    $(window).load(function(){--}}
{{--        $(".loader").delay(300).fadeOut("slow");--}}
{{--        $("#overlayer").delay(300).fadeOut("slow");--}}
{{--    });--}}
{{--</script>--}}
<script>
    window.addEventListener('load', function() {
        // Select the loader element
        var loader = document.querySelector('.P-loader');

        // Hide the loader by setting display to none
        loader.style.display = 'none';
    });
</script>
</html>
