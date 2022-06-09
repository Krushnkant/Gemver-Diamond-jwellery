@extends('frontend.layout.layout')
@section('content')
        <div class="background-sub-slider">
            <div class="position-relative">
                <img src="{{ asset('frontend/image/about_us.png') }}" alt="">
                <div class="about_us_background">
                    <div class="sub_heading mb-lg-3">Blog detail page</div>
                    <div class="about_us_link">
                        <a href="{{ URL('/') }}">home</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none" class="mx-2">
                            <path d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z" fill="white"/>
                            <path d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z" fill="white"/>
                        </svg>
                        <a href="#">blog detail page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row my-3 my-lg-5 d-flex align-items-start">
            <div class="col-lg-8 px-0 px-lg-3">
                <div class="blog-detail-main-img">
                    <img src="{{ asset($blog->blog_thumb)  }}" alt="{{ $blog->category->category_name }}">
                </div>
                <div class="blog-detail-sub-heading mt-2">
                {{ $blog->category->category_name }}
                </div>
                <h5 class="blog-detail-heading mt-3">
                {{ $blog->title }}
                </h5>
                <div class="blog-detail-img-date mt-3 d-flex align-items-center">
                    <!-- <span class="blog-detail-img"><img src="{{ asset('frontend/image/icon-1.png') }}" alt=""></span>                   -->
                    <span class="blog-deatil-date ms-3">{{ date('d M, Y', strtotime($blog->created_at)) }}</span>
                </div>
                <div class="blog-detail-paragraph">
                    {!! $blog->description !!}
                </div>
            </div>
            <div class="col-lg-4 blog-detail-sidebar px-0 px-lg-3">
                <div class="blog-detail-post-heading">
                    Recent Post
                </div>

                @foreach($blogs as $lblog)
                <div class="row mt-3 d-flex align-items-center">
                    <div class="col-md-4 px-0">
                        <div class="blog-detail-sidebar-img">
                            <img src="{{ asset($lblog->blog_thumb)  }}" alt="">
                        </div>
                    </div>
                    <div class="col-md-8 px-0 px-md-3 pe-md-3">
                        <div class="blog-detail-paragraph">
                            <a href=" {{ url('/blog/'.$lblog->id) }} ">{{ $lblog->title }}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            
                
            </div>
        </div>
    </div>
    @endsection



    