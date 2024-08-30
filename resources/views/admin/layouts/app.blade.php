@extends('site.layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('site/plugins/datatables/datatables.min.css') }}">

    <link rel="stylesheet"
          href="{{ asset('site/plugins/datatables/DataTables-1.11.5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('site/plugins/datatables/Responsive-2.2.9/css/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('site/plugins/datatables/Responsive-2.2.9/css/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/plugins/datatables/Responsive-2.2.9/css/responsive.bulma.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('site/plugins/datatables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('site/plugins/datatables/Responsive-2.2.9/css/responsive.foundation.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('site/plugins/datatables/Responsive-2.2.9/css/responsive.jqueryui.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('site/plugins/datatables/Responsive-2.2.9/css/responsive.semanticui.min.css') }}">

    <link rel="stylesheet"
          href="{{ asset('site/plugins/datatables/SearchBuilder-1.3.2/css/searchBuilder.bootstrap5.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('site/plugins/datatables/SearchBuilder-1.3.2/css/searchBuilder.bulma.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('site/plugins/datatables/SearchBuilder-1.3.2/css/searchBuilder.dataTables.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('site/plugins/datatables/SearchBuilder-1.3.2/css/searchBuilder.foundation.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('site/plugins/datatables/SearchBuilder-1.3.2/css/searchBuilder.jqueryui.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('site/plugins/datatables/SearchBuilder-1.3.2/css/searchBuilder.semanticui.min.css') }}">
@endsection

@section('metas')
    <meta name="state-url" content="{{ route('admin.states.ajax.update') }}">
@endsection

@section('scripts')
    <script src="{{ asset('site/plugins/datatables/datatables.min.js') }}"></script>

    <script src="{{ asset('site/plugins/datatables/DataTables-1.11.5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('site/plugins/datatables/Responsive-2.2.9/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('site/plugins/datatables/Responsive-2.2.9/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('site/plugins/datatables/Responsive-2.2.9/js/responsive.bulma.min.js') }}"></script>
    <script src="{{ asset('site/plugins/datatables/Responsive-2.2.9/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ asset('site/plugins/datatables/Responsive-2.2.9/js/responsive.foundation.min.js') }}"></script>
    <script src="{{ asset('site/plugins/datatables/Responsive-2.2.9/js/responsive.jqueryui.min.js') }}"></script>
    <script src="{{ asset('site/plugins/datatables/Responsive-2.2.9/js/responsive.semanticui.min.js') }}"></script>

    <script
        src="{{ asset('site/plugins/datatables/SearchBuilder-1.3.2/js/dataTables.searchBuilder.min.js') }}"></script>
    <script
        src="{{ asset('site/plugins/datatables/SearchBuilder-1.3.2/js/searchBuilder.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('site/plugins/datatables/SearchBuilder-1.3.2/js/searchBuilder.bulma.min.js') }}"></script>
    <script
        src="{{ asset('site/plugins/datatables/SearchBuilder-1.3.2/js/searchBuilder.dataTables.min.js') }}"></script>
    <script
        src="{{ asset('site/plugins/datatables/SearchBuilder-1.3.2/js/searchBuilder.foundation.min.js') }}"></script>
    <script src="{{ asset('site/plugins/datatables/SearchBuilder-1.3.2/js/searchBuilder.jqueryui.min.js') }}"></script>
    <script
        src="{{ asset('site/plugins/datatables/SearchBuilder-1.3.2/js/searchBuilder.semanticui.min.js') }}"></script>

    <script src="{{ asset('admin/js/script.js') .'?t='.time() }}"></script>
@endsection

