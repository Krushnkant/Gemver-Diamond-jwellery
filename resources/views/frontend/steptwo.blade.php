@extends('frontend.layout.layout')

@section('content')

        <div class="background-sub-slider">
            <div class="position-relative">
                <img src="{{ url('images/steps/'.$Step->step2_header_image) }}" alt="">
                <div class="about_us_background">
                    <div class="sub_heading mb-lg-3">Step 2</div>
                    <div class="about_us_link">
                        <a href="#">{{ $Step->step2_title }}</a>
                        <p class="mt-3 ste_1_paragraph">
                        {{ $Step->step2_shotline }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="step_two_design">

        <div class="container where_to_start_section">
            <div class="row position-relative align-items-center">
                <div class="col-md-12 order-2 order-md-1">
                    <div class="jewellery-paragraph-box text-center text-md-start">
                        <div class="cut_shape_heading mb-3">{{ $Step->step2_section1_title }}</div>
                        <p class="customer_stories_paragraph">{{ $Step->step2_section1_description }}</p>
                    </div>
                    <div class="row mt-3 mt-md-5">
                        <div class="col-md-4">
                            <div class="jewellery-diamond-shape">
                                <img src="{{ url('images/steps/'.$Step->step2_section1_image) }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container where_to_start_section">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div>
                        <img src="{{ url('images/steps/'.$Step->step2_section2_image) }}" alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="jewellery-paragraph-box text-center text-md-start">
                        <div class="cut_shape_heading mb-3">{{ $Step->step2_section2_title1 }} </div>
                        <p class="customer_stories_paragraph">{{ $Step->step2_section2_description1 }}</p>
                        <div class="cut_shape_heading mb-3">{{ $Step->step2_section2_title2 }}</div>
                        <p class="customer_stories_paragraph">{{ $Step->step2_section2_description2 }}</p>
                        <div class="cut_shape_heading mb-3">
                        {{ $Step->step2_section2_title3 }}
                        </div>
                        <p class="customer_stories_paragraph">{{ $Step->step2_section2_description3 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container where_to_start_section">
            <div class="row position-relative align-items-center">
                <div class="col-md-12 order-2 order-md-1">
                    <div class="jewellery-paragraph-box text-center text-md-start">
                        <div class="cut_shape_heading mb-3">{{ $Step->step2_section3_title }}</div>
                        <p class="customer_stories_paragraph">{{ $Step->step2_section3_description }}</p>
                    </div>
                    <div class="jewellery-step-two-img mt-3">
                        <img src="{{ url('images/steps/'.$Step->step2_section3_image) }}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="container where_to_start_section">
            <div class="row position-relative align-items-center">
                <div class="col-md-12 order-2 order-md-1">
                    <div class="jewellery-paragraph-box text-center text-md-start">
                        <div class="cut_shape_heading mb-3">{{ $Step->step2_section4_title }}</div>
                        <p class="customer_stories_paragraph">{{ $Step->step2_section4_description }}</p>
                    </div>
                    <div class="jewellery-step-two-img">
                        <img src="{{ url('images/steps/'.$Step->step2_section4_image) }}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="container where_to_start_section">
            <div class="row position-relative align-items-center">
                <div class="col-md-12 order-2 order-md-1">
                    <div class="jewellery-paragraph-box text-center text-md-start">
                        <div class="cut_shape_heading mb-3">{{ $Step->step2_section5_title }}</div>
                        <p class="customer_stories_paragraph">{{ $Step->step2_section5_description }}</p>
                        
                    </div>
                    <div class="jewellery-step-two-img mt-4">
                        <img src="{{ url('images/steps/'.$Step->step2_section5_image) }}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="container where_to_start_section">
            <div class="row position-relative align-items-center">
                <div class="col-md-12 order-2 order-md-1">
                    <div class="jewellery-paragraph-box text-center text-md-start">
                        <div class="cut_shape_heading mb-3">IMPACT OF CARAT WEIGHT ON PRICE</div>
                        <p class="customer_stories_paragraph">The price of a diamond rises with carat weight exponentially. Two diamonds of the same quality may not cost the same if there is a difference in their carat weight. Bigger diamonds are valued at a higher price because they are
                            rare. Meanwhile, there are under sizes, which weigh just below the cut-off weight. The cut-off weights are 0.30, 0.40, 0.50, 0.70, 0.90, 1.00, 1.50 and 2.00 ct. These are rare and of great value. Prices become exponentially
                            higher when these weights are crossed.</p>
                        <p class="customer_stories_paragraph">
                            To know how much to spend on a diamond engagement or wedding ring,
                        </p>
                        <a href="#" class="customer_stories_paragraph click_here_btn text-center d-inline-block">click here.</a>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="container where_to_start_section">
            <div class="">
                <div class="cut_shape_heading  text-center text-md-start mb-3">SHOP LAB DIAMONDS BY SHAPE </div>
                <div>
                    <div class="owl-carousel owl-theme shop-dimond-by-shape-slider shop-lab-diamonds-by-shape-slider">
                        <div class="item">
                            <a href="{{ url('/lad-diamond/round') }}">
                                <img src="{{url('frontend/image/dimond-1.png') }}" alt="Round">
                            </a>
                            <div class="shape_heading">Round</div>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lad-diamond/oval') }}">
                                <img src="{{url('frontend/image/dimond-2.png') }}" alt="Oval">
                            </a>
                            <div class="shape_heading">Oval</div>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lad-diamond/princess') }}">
                                <img src="{{url('frontend/image/dimond-3.png') }}" alt="Princess">
                            </a>
                            <div class="shape_heading">Princess</div>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lad-diamond/cushion') }}">
                                <img src="{{url('frontend/image/dimond-4.png') }}" alt="cushion">
                            </a>
                            <div class="shape_heading">Cushion</div>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lad-diamond/marquise') }}">
                                <img src="{{url('frontend/image/dimond-5.png') }}" alt="Marquise">
                            </a>
                            <div class="shape_heading">Marquise</div>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lad-diamond/pear') }}">
                                <img src="{{url('frontend/image/dimond-6.png') }}" alt="Pear">
                            </a>
                            <div class="shape_heading">Pear</div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="choose_setting_section">
            <div class="container where_to_start_section">
                <div class="row position-relative align-items-center">
                    <div class="col-md-5 mb-4">
                        <div class="where_to_start_img">
                            <img src="{{ url('frontend/image/ring-step-3.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="col-md-7 mb-4 mb-md-0">
                        <div class="jewellery-paragraph-box text-center text-md-start">
                            <div class="mb-3 cut_shape_heading ">{{ $Step->step3_title }}</div>
                            <p class="customer_stories_paragraph">{{ $Step->step3_shotline }}</p>
                            <a href="{{ url('/step/'.$Step->slug.'/three'); }}" class="explore-ring-btn btn-hover-effect banner-url d-inline-block text-center know_more_btn">know more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection