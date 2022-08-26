@extends('frontend.layout.layout')

@section('content')

        <div class="background-sub-slider">
            <div class="">
                <!-- <img src="{{ url('images/aboutus/'.$DiamondAnatomy->header_image) }}" alt=""> -->
                <div class="about_us_background">
                    <div class="about_us_link">
                        <a href="#">{{ $DiamondAnatomy->header_title }}</a>
                        <p class="mt-2 ste_1_paragraph">
                        {{ $DiamondAnatomy->header_shotline }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="step_two_design mt-md-5 mb-md-5">

        <div class="container where_to_start_section" id="cut">
            <div class="row position-relative align-items-center">
                <div class="col-md-12 order-2 order-md-1">
                    <div class="jewellery-paragraph-box text-center text-md-start">
                        <div class="cut_shape_heading mb-3">{{ $DiamondAnatomy->section1_title }}</div>
                        <p class="customer_stories_paragraph">{{ $DiamondAnatomy->section1_description }}</p>
                    </div>
                    <div class="row mt-3 mt-md-5">
                        <div class="col-md-4">
                            <div class="jewellery-diamond-shape">
                                <img src="{{ url('images/aboutus/'.$DiamondAnatomy->section2_image) }}" alt="">
                                <div class="jewellery-diamond-shape-name text-center">{{ $DiamondAnatomy->section2_title }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="jewellery-diamond-shape">
                                <img src="{{ url('images/aboutus/'.$DiamondAnatomy->section3_image) }}" alt="">
                                <div class="jewellery-diamond-shape-name text-center">{{ $DiamondAnatomy->section3_title }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="jewellery-diamond-shape">
                                <img src="{{ url('images/aboutus/'.$DiamondAnatomy->section4_image) }}" alt="">
                                <div class="jewellery-diamond-shape-name text-center">{{ $DiamondAnatomy->section4_title }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container where_to_start_section pt-0 mt-5">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div>
                        <img src="{{ url('images/aboutus/'.$DiamondAnatomy->section5_image) }}" alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="jewellery-paragraph-box text-center text-md-start">
                        <div class="cut_shape_heading mb-3">{{ $DiamondAnatomy->section2_title }} </div>
                        <p class="customer_stories_paragraph">{{ $DiamondAnatomy->section2_description }}
                        </p>
                        <div class="cut_shape_heading mb-3">{{ $DiamondAnatomy->section3_title }} </div>
                        <p class="customer_stories_paragraph">{{ $DiamondAnatomy->section3_description }}
                        </p>
                        <div class="cut_shape_heading mb-3">{{ $DiamondAnatomy->section4_title }} </div>
                        <p class="customer_stories_paragraph">{{ $DiamondAnatomy->section4_description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container where_to_start_section pt-0 mt-5" id="color">
            <div class="row position-relative align-items-center">
                <div class="col-md-12 order-2 order-md-1">
                    <div class="jewellery-paragraph-box text-center text-md-start">
                        <div class="cut_shape_heading mb-3">{{ $DiamondAnatomy->section6_title }}</div>
                        <p class="customer_stories_paragraph">{{ $DiamondAnatomy->section6_description }}</p>
                    </div>
                    <div class="jewellery-step-two-img mt-3">
                        <img src="{{ url('images/aboutus/'.$DiamondAnatomy->section6_image) }}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="container where_to_start_section pt-0 mt-5" id="clarity">
            <div class="row position-relative align-items-center">
                <div class="col-md-12 order-2 order-md-1">
                    <div class="jewellery-paragraph-box text-center text-md-start">
                        <div class="cut_shape_heading mb-3">{{ $DiamondAnatomy->section7_title }}</div>
                        <p class="customer_stories_paragraph">{{ $DiamondAnatomy->section7_description }}</p>
                    </div>
                    <div class="jewellery-step-two-img">
                        <img src="{{ url('images/aboutus/'.$DiamondAnatomy->section7_image) }}" alt="">
                    </div>
                    <div class="jewellery-step-two-img">
                        <img src="{{ url('images/aboutus/'.$DiamondAnatomy->section7_image2) }}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="container where_to_start_section pt-0 mt-5" id="carat">
            <div class="row position-relative align-items-center">
                <div class="col-md-12 order-2 order-md-1">
                    <div class="jewellery-paragraph-box text-center text-md-start">
                        <div class="cut_shape_heading mb-3">{{ $DiamondAnatomy->section8_title }}</div>
                        <p class="customer_stories_paragraph">{{ $DiamondAnatomy->section8_description }}</p>
                        
                    </div>
                    <div class="jewellery-step-two-img mt-4">
                        <img src="{{ url('images/aboutus/'.$DiamondAnatomy->section8_image) }}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="container where_to_start_section pt-0 mt-5" >
            <div class="row position-relative align-items-center">
                <div class="col-md-12 order-2 order-md-1">
                    <div class="jewellery-paragraph-box text-center text-md-start">
                        <div class="cut_shape_heading mb-3">{{ $DiamondAnatomy->section9_title }}</div>
                        <p class="customer_stories_paragraph">{{ $DiamondAnatomy->section9_description }}</p>
                    </div>
                </div>
            </div>
        </div>
      
    </div>

@endsection