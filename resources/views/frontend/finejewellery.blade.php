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
        </div>
    </div>
</div>

    <div class="pt-5 py-xl-5 mt-xl-5"> 
        <div class="container">
            <div class="row">

                @if($MenuPage->menupageshapestyle)
                @foreach($MenuPage->menupageshapestyle as $menupageshapestyle)
                <div class="col-md-6 col-lg-3 finejewellery-img mb-4">
                    <img src="{{ url('images/shopstyle_image/'.$menupageshapestyle->image) }}" alt="">
                    <div class="finejewellery-box mt-3">
                        <div class="finejewellery-heading text-center mb-3">
                            {{ $menupageshapestyle->title }}
                        </div>
                        {{-- <p class="finejewellery-paragraph">
                            Classic, opulent, or delicate - regardless of the occasion, we have the perfect ring to complement every look.
                        </p> --}}
                    </div>
                </div> 
                @endforeach
                @endif 
                  
            </div>
        </div>
    </div>

    <div class="my-xxl-5">
        <div class="container mb-xl-5">
            <div class="row">
                <div class="col-md-6 mb-3 mb-md-0 design_engagemnt_image lab-diamond-img pe-md-0">
                    <img src="{{ url('images/aboutus/'.$MenuPage->section1_image) }}" alt="">
                </div> 
                <div class="col-md-6 ps-md-0">
                    <div class="choose_your_setting_box text-center">
                        <div class="">
                            <div class="custom_made_heading text-center mb-2 mb-xl-3">
                                {{ $MenuPage->section1_title }}
                            </div>
                            <p class="custom_engagement_paragrph">
                                {{ $MenuPage->section1_description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-4 pt-4">
        <div class="choose_your_setting_heading text-center mb-3 mb-xl-5">{{ $MenuPage->section3_title }}</div>
        <div class="row">
            <div class="col-md-4 mb-3 mb-md-0">
                <img src="{{ url('images/aboutus/'.$MenuPage->section31_image) }}" alt="">
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <img src="{{ url('images/aboutus/'.$MenuPage->section32_image) }}" alt="">
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <img src="{{ url('images/aboutus/'.$MenuPage->section33_image) }}" alt="">
            </div>
        </div>
        <p class="dainty-ring-gifts-paragraph mt-3 mt-xl-5 mb-xl-5 pb-xl-5">  
            {{ $MenuPage->section3_description }}
        </p>
    </div>

    
 


@endsection