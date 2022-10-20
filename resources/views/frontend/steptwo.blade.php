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
                        <div class="col-md-12 text-center">
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


        <div class="shop_dimond_by_shape explore_diamonds_section mt-3 my-md-5">
            <div class="container">
                <div class="mb-4 text-center ">
                    <div class="choose_your_setting_heading text-center mb-2 mb-md-3 explore_diamonds_heading">SHOP LAB DIAMONDS BY SHAPE</div>
                </div>
                <div>
                    <div class="owl-carousel owl-theme shop-dimond-by-shape-slider explore_diamonds_section">
                        <div class="item">
                            <a href="{{ url('/lab-diamond/round') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/round.png') }}" alt="">
                                <div class="shop_by_diamond_shpae_name">round</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/oval') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/oval.png') }}" alt="">
                                <div class="shop_by_diamond_shpae_name">oval</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/princess') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/princess.png') }}" alt="">
                                <div class="shop_by_diamond_shpae_name">princess</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/cushion') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/cushion.png') }}" alt="">
                                <div class="shop_by_diamond_shpae_name">cushion</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/marquise') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/marquise.png') }}" alt="">
                                <div class="shop_by_diamond_shpae_name">marquise</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/pear') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/pear.png') }}" alt="">
                                <div class="shop_by_diamond_shpae_name">pear</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/radiant') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/radiant.png') }}" alt="">
                                <div class="shop_by_diamond_shpae_name">radiant</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/heart') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/heart.png') }}" alt="">
                                <div class="shop_by_diamond_shpae_name">heart</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/emerald') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/emerald.png') }}" alt="">
                                <div class="shop_by_diamond_shpae_name">emerald</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/asscher') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/asscher.png') }}" alt="">
                                <div class="shop_by_diamond_shpae_name">asscher</div>
                            </a>
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