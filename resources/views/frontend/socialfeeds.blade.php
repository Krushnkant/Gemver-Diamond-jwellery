@extends('frontend.layout.layout')
@section('content')
        <div class="background-sub-slider">
            <div class="">
                <!-- <img src="{{ asset('frontend/image/about_us.png') }}" alt=""> -->
                <div class="about_us_background">
                    <h1 class="sub_heading mb-lg-3">Social Feeds</h1>
                    <div class="about_us_link">
                        <a href="{{ URL('/') }}">home</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none" class="mx-2">
                            <path d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z" fill="white"/>
                            <path d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z" fill="white"/>
                        </svg>
                        <a href="#">Social Feeds</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


  
         <div class="container py-5 mb-5">
        <div class="social-act-list-box">
            @foreach($socialfeeds as $socialfeed)
            <div class="social-act-blog">
                <div class="row">
                    <div class="col-md-5 dedication-section-img">
                        <div class="about_us_img">
                            <img src="{{ url($socialfeed->blog_thumb) }}" alt="" width="">
                        </div>
                    </div>
                    <div class="col-md-7 py-4 dedication-section-content">
                        <div class="">
                            <span class="">{{ $socialfeed->sub_title  }}</span>
                            <h2 class="heading-h2 mb-4 mt-2">{{ $socialfeed->title  }}</h2>
                            <div class="about_content">
                                {!! $socialfeed->description  !!}
                            </div>
                            {{-- <div class="btn-section">
                                <a href="#">Learn More</a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
           
        </div>
        {{-- <div class="button-box text-center mt-5">
            <a href="#" class="load-more-btn">Load More</a>
        </div> --}}
    </div> 
    @endsection



    