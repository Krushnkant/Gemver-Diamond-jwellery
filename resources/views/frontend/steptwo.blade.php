@extends('frontend.layout.layout')

@section('content')

        <div class="background-sub-slider">
            <div class="">
                <!-- <img src="{{ url('images/steps/'.$Step->step2_header_image) }}" alt=""> -->
                <div class="about_us_background">
                    <div class="sub_heading mb-lg-3">Step 2</div>
                    <div class="about_us_link">
                        <a href="#">{{ $Step->step2_title }}</a>
                        <p class="mt-2 ste_1_paragraph">
                        {!! $Step->step2_shotline !!}
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
                        <p class="customer_stories_paragraph">{!! $Step->step2_section1_description !!}</p>
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
                        <p class="customer_stories_paragraph">{!! $Step->step2_section2_description1 !!}</p>
                        <div class="cut_shape_heading mb-3">{{ $Step->step2_section2_title2 }}</div>
                        <p class="customer_stories_paragraph">{!! $Step->step2_section2_description2 !!}</p>
                        <div class="cut_shape_heading mb-3">
                        {{ $Step->step2_section2_title3 }}
                        </div>
                        <p class="customer_stories_paragraph">{!! $Step->step2_section2_description3 !!}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container where_to_start_section">
            <div class="row position-relative align-items-center">
                <div class="col-md-12 order-2 order-md-1">
                    <div class="jewellery-paragraph-box text-center text-md-start">
                        <div class="cut_shape_heading mb-3">{{ $Step->step2_section3_title }}</div>
                        <p class="customer_stories_paragraph">{!! $Step->step2_section3_description !!}</p>
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
                        <p class="customer_stories_paragraph">{!! $Step->step2_section4_description !!}</p>
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
                        <p class="customer_stories_paragraph">{!! $Step->step2_section5_description !!}</p>
                        
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
                        <a href="{{ url('/lab-diamond/round') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/round.png') }}" alt="Round">
                        </a>
                        <div class="shape_heading">Round</div>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lab-diamond/oval') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/oval.png') }}" alt="oval">
                        </a>
                        <div class="shape_heading">oval</div>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lab-diamond/princess') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/princess.png') }}" alt="">
                        </a>
                        <div class="shape_heading">princess</div>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lab-diamond/cushion') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/cushion.png') }}" alt="cushion">
                        </a>
                        <div class="shape_heading">cushion</div>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lab-diamond/marquise') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/marquise.png') }}" alt="marquise">
                        </a>
                        <div class="shape_heading">marquise</div>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lab-diamond/pear') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/pear.png') }}" alt="pear">
                        </a>
                        <div class="shape_heading">pear</div>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lab-diamond/radiant') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/radiant.png') }}" alt="radiant">
                        </a>
                        <div class="shape_heading">radiant</div>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lab-diamond/heart') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/heart.png') }}" alt="heart">
                        </a>
                        <div class="shape_heading">heart</div>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lab-diamond/emerald') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/emerald.png') }}" alt="emerald">
                        </a>
                        <div class="shape_heading">emerald</div>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lab-diamond/asscher') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/asscher.png') }}" alt="">
                        </a>
                        <div class="shape_heading">asscher</div>
                    </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="choose_setting_section where_to_start_section_2">
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
                            <p class="customer_stories_paragraph">{!! $Step->step3_shotline !!}</p>
                            <a href="{{ url('/step/'.$Step->slug.'/three'); }}" class="explore-ring-btn btn-hover-effect banner-url d-inline-block text-center know_more_btn">know more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection