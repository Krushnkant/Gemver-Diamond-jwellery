@extends('frontend.layout.layout')

@section('content')
        <div class="background-sub-slider">
            <div class="">
            <!-- <img src="{{ asset('frontend/image/about_us.png') }}" alt=""> -->
                <div class="about_us_background">
                    <h1 class="sub_heading mb-lg-3">testimonials</div>
                    <div class="about_us_link">
                    <a href="{{ URL('/')}}">home</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none" class="mx-2">
                            <path d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z" fill="white"/>
                            <path d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z" fill="white"/>
                        </svg>
                        <a href="#">testimonials</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container mb-5">
        <div class="row mt-4 mt-lg-0">
            @foreach($Testimonials as $Testimonial)
            <div class="col-md-6 mt-5 pt-lg-5 pt-4">
                <div class="testimonial-box">
                    <div class="testimonial-img">
                        <img src="{{ url('images/testimonials/'.$Testimonial->image) }}" alt="">
                    </div>
                    <div class="testimonial-box-des">
                        <div class="testimonial-heading mb-1">
                            {{ $Testimonial->name }}
                        </div>
                        <div class="testimonial-sub-heading mb-2">
                            {{ $Testimonial->country }}
                        </div>
                        <p class="testimonial-paragraph">
                           {!! $Testimonial->description !!}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
     
    </div>
    @endsection