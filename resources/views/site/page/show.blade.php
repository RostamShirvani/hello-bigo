@extends('site.layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>{{ $page->title }}</h1>
    </div>

    <div class="container">
        {!! $page->body !!}
    </div>
@endsection
