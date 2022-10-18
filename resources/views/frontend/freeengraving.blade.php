@extends('frontend.layout.layout')

@section('content')
        <div class="background-sub-slider">
            <div class="">
                <!-- <img src="{{ asset('frontend/image/about_us.png') }}" alt=""> -->
                <div class="about_us_background">
                    <div class="sub_heading mb-lg-3">FREE ENGRAVING</div>
                    <div class="about_us_link">
                        <a href="{{ URL('/')}}">home</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none" class="mx-2">
                            <path d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z" fill="white"/>
                            <path d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z" fill="white"/>
                        </svg>
                        <a href="#">FREE ENGRAVING</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="container">
           <div class="row">
                <div class="col-md-12">
                    <div class="policy_page_section mt-3 mt-md-5 mb-md-5">
                    {!! $Infopage->free_engraving !!} 
                    </div>
                </div>
           </div>
        </div>
    </div>
  @endsection