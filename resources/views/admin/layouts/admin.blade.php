<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ecommerce - @yield('title')</title>

    <!-- Custom styles for this template-->
    <link href="{{asset('/css/admin.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/assets/site/css/style.css') }}"/>

    @yield('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    @include('admin.sections.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            @include('admin.sections.topbar')
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        @include('admin.sections.footer')
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
@include('admin.sections.scroll_top')

<!-- JavaScript-->
<script src="{{ asset('/js/admin.js') }}"></script>
<script src="{{ asset('/assets/admin/js/script.js') }}"></script>
@yield('script')
@include('sweetalert::alert')
</body>

</html>
