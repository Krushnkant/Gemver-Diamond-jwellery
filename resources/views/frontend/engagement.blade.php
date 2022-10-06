@extends('frontend.layout.layout')

@section('content')

<div class="engagement_bg_slider">
    <img src="{{ url('images/aboutus/'.$MenuPage->banner_image) }}" alt="">
    <div class="container engagement_text_part">
        <div class="engagement_text_part">
            <h1 class="heading-h1 engagement_heading text-start mb-3">{{ $MenuPage->main_title }}</h1>
            <p class="engagement_paragraph mb-4">
                {{ $MenuPage->main_shotline }}
            </p>
            <div class="engagement_button">
                <button class="engagement_start_diamond">{{ $MenuPage->main_first_button_name }}</button>
                <button class="engagement_start_setting ms-2 ms-md-3">{{ $MenuPage->main_second_button_name }}</button>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="choose_your_setting_section">
        <div class="choose_your_setting_heading text-center mb-3 mb-md-4 mb-lg-5">
            Choose Your Setting Stlye
        </div>
        <div class="row">
            @if($MenuPage->menupageshapestyle)
            @foreach($MenuPage->menupageshapestyle as $menupageshapestyle)
            <div class="col-sm-4 col-md-4 col-lg-2 text-center mb-3 mb-lg-0">
                <img src="{{ url('images/shopstyle_image/'.$menupageshapestyle->image) }}" alt="">
                <div class="choose_sub_heading mt-3">
                    {{ $menupageshapestyle->title }}
                </div>
            </div>
            @endforeach
            @endif
            
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6 order-2 order-md-1">
            <div class="choose_your_setting_box text-center">
                <div class="">
                    <div class="custom_made_heading text-center mb-0 mb-xl-3">
                        {{ $MenuPage->section1_title }}
                    </div>
                    <p class="custom_engagement_paragrph">
                        {{ $MenuPage->section1_description }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 order-1 order-md-2 mb-3 mb-md-0">
            <img src="{{ url('images/aboutus/'.$MenuPage->section1_image) }}" alt="">
        </div>  
    </div>
</div>
 
<div class="create_your_own_section my-5">
   <div class="container">
    <div class="row">
            <div class="col-md-12">
                <div class="choose_your_setting_heading text-center mb-5">
                    {{ $MenuPage->section3_title }}
                </div>
                <div class="row">
                    <div class="col-md-4 position-relative create_your_own_icon">
                        <div class="create_your_own_image">
                            <img src="{{ url('images/aboutus/'.$MenuPage->section31_image) }}" alt="">
                        </div>
                        <div class="text-center create_your_own_heading mb-3">
                            {{ $MenuPage->section31_title }}
                        </div>
                        <p class="create_your_own_paragraph">
                            {{ $MenuPage->section31_description }}
                        </p>
                        <div class="create_your_own_icon_part">
                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="32" viewBox="0 0 31 32" fill="none">
                                <path d="M30.0254 12.416V19.3008H0.787109V12.416H30.0254ZM19.127 0.667969V31.7227H11.7148V0.667969H19.127Z" fill="#0B1727"/>
                            </svg>
                        </div>
                    </div>
                   
                    <div class="col-md-4 position-relative">
                        <div class="create_your_own_image">
                            <img src="{{ url('images/aboutus/'.$MenuPage->section32_image) }}" alt="">
                        </div>
                        <div class="text-center create_your_own_heading mb-3">
                            {{ $MenuPage->section32_title }}
                        </div>
                        <p class="create_your_own_paragraph">
                            {{ $MenuPage->section32_description }}
                        </p>
                        <div class="create_your_own_icon_part">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="20" viewBox="0 0 26 20" fill="none">
                                <path d="M25.9414 0.318359V6.55859H0.0722656V0.318359H25.9414ZM25.9414 12.8574V19.0977H0.0722656V12.8574H25.9414Z" fill="#0B1727"/>
                            </svg>
                        </div>
                    </div>
                   
                    <div class="col-md-4 position-relative">
                        <div class="create_your_own_image">
                            <img src="{{ url('images/aboutus/'.$MenuPage->section33_image) }}" alt="">
                        </div>
                        <div class="text-center create_your_own_heading mb-3">
                            {{ $MenuPage->section33_title }}
                        </div>
                        <p class="create_your_own_paragraph">
                            {{ $MenuPage->section33_description }}
                        </p>
                    </div>
                </div>
            </div>  
        </div>
   </div>
</div>

<div class="container mb-5 pb-5">
    <div class="row">
        <div class="col-md-6">
            <div class="choose_your_setting_box text-center">
                <div class="">
                    <div class="custom_made_heading text-center mb-0 mb-xl-3">
                        {{ $MenuPage->section4_title }}
                    </div>
                    <p class="custom_engagement_paragrph">
                        {{ $MenuPage->section4_description }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <img src="{{ url('images/aboutus/'.$MenuPage->section4_image) }}" alt="">
        </div>  
    </div>
</div>

@endsection