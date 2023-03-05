@extends('home.layouts.home')

@section('title')
    نظرات من
@endsection
@section('content')
    <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="{{route('home.index')}}">صفحه ای اصلی</a>
                    </li>
                    <li class="active"> نظرات من</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- my account wrapper start -->
    <div class="my-account-wrapper pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <div class="row text-right" style="direction: rtl;">
                        @include('home.sections.profile_sidebar')
                        <!-- My Account Tab Menu End -->
                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">
                                    <div class="myaccount-content">
                                        <h3> نظرات </h3>
                                        <div class="review-wrapper">
                                            @foreach($comments as $comment)
                                                <div class="single-review">
                                                    <div class="review-img">
                                                        <img src="{{$comment->user->avatar ?? asset('/images/home/user.png')}}" alt="">
                                                    </div>
                                                    <div class="review-content w-100 text-right">
                                                        <p class="text-right">
                                                            {{$comment->text}}
                                                        </p>
                                                        <div class="review-top-wrap">
                                                            <div class="review-name d-flex align-items-center">
                                                                <h4>
                                                                    برای محصول :
                                                                </h4>
                                                                <a class="mr-1" href="{{route('home.products.show', $comment->product->slug)}}" style="color:#ff3535;">
                                                                    {{$comment->product->name}}
                                                                </a>
                                                            </div>
                                                            <div>
                                                                در تاریخ :
                                                                {{verta($comment->created_at)->format('%d %B %Y')}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- My Account Tab Content End -->
                        </div>
                    </div> <!-- My Account Page End -->
                </div>
            </div>
        </div>
    </div>
    <!-- my account wrapper end -->
@endsection
