@extends('frontend.layout.layout')

@section('content')
        <div class="background-sub-slider">
            <div class="">
                <!-- <img src="{{ url('images/steps/'.$Step->step1_header_image) }}" alt=""> -->
                <div class="about_us_background">
                    <div class="sub_heading mb-lg-3">Step 1</div>
                    <div class="about_us_link">
                        <a href="#">{{ $Step->step1_title }}</a>
                        <p class="mt-2 ste_1_paragraph">
                            {{ $Step->step1_shotline }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
      
    </div>

    <div class="step_four_design">
    <div class="container where_to_start_section">
            <div class="row position-relative align-items-center">
                <div class="col-md-7 order-2 order-md-1">
                    <div class="jewellery-paragraph-box">
                        <div class="cut_shape_heading mb-3">{{ $Step->step1_section1_title }}</div>
                        <p class="customer_stories_paragraph">{!! $Step->step1_section1_description !!}</p>
                    </div>
                </div>
                <div class="col-md-5 order-1 order-md-2 mb-4 mb-md-0">
                    <div class="where_to_start_img">
                        <img src="{{ url('images/steps/'.$Step->step1_section1_image) }}" alt="">
                    </div>
                </div>
            </div>
        </div>

    <!-- <div class="maximise-your-budget-background">
        <div class="container text-center">
            <h2 class="maximise_your_budget_heading">{{ $Step->step1_section2_title }}</h2>
            <p class="customer_stories_paragraph">{{ $Step->step1_section1_description }}</p>
        </div>
    </div> -->

    <div class="where_to_start_section">
        <div class="container">
            <div class="">
                <div class="text-center">
                    <div class="cut_shape_heading mb-md-5">{{ $Step->step1_section2_title }}</div>
                    <div class="row">
                        <div class="col-md-6 text-end mb-3 mb-md-0">
                            <a href="{{ url('product-setting/'.$Step->category_id) }}" class="maximise_your_budget_box">
                                <div>
                                    <img src="{{ url('images/steps/'.$Step->step1_section2_image1) }}" alt="" class="maximise_your_budget_img">
                                </div>
                                <div class="category-heading category-heading-part ps-2 ps-md-4">
                                    {{ $Step->step1_section2_title1 }}
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ url('diamond-setting/'.$Step->category_id) }}" class="maximise_your_budget_box">
                                <img src="{{ url('images/steps/'.$Step->step1_section2_image2) }}" alt="" class="maximise_your_budget_img">
                                <div class="category-heading category-heading-part ps-2 ps-md-4">
                                    {{ $Step->step1_section2_title2 }}
                                </div>
                            </a>
                        </div>
                        <!-- <div class="col-md-4 px-0">
                            <div class="maximise_your_budget_box">
                                <img src="image/step_3.jpg" alt="" class="maximise_your_budget_img">
                                <div class="category-heading">
                                    Request a special design
                                </div>
                            </div>
                        </div> -->
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container where_to_start_section where_to_start_section_2">
        <div class="row position-relative align-items-center">
            <div class="col-md-5">
                <div class="where_to_start_img">
                    <img src="{{ url('frontend/image/diamond.jpg') }}" alt="">
                </div>
            </div>
            <div class="col-md-7 mb-4 mb-md-0">
                <div class="jewellery-paragraph-box">
                    <div class="cut_shape_heading mb-md-3">{{ strtolower($Step->step2_title) }}</div>
                    <p class="customer_stories_paragraph">{!! $Step->step2_shotline !!}</p>
                    <a href="{{ url('/step/'.$Step->slug.'/two'); }}" class="explore-ring-btn btn-hover-effect banner-url d-inline-block text-center know_more_btn">know more</a>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection