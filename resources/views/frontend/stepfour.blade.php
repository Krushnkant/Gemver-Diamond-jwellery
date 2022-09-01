@extends('frontend.layout.layout')

@section('content')


		<div class="background-sub-slider">
			<div class="">
				<!-- <img src="{{ url('images/steps/'.$Step->step4_header_image) }}" alt=""> -->
				<div class="about_us_background">
					<div class="sub_heading mb-lg-3">Step 4</div>
					<div class="about_us_link">
						<a href="#">{{ $Step->step4_title }}</a>
						<p class="mt-2 ste_1_paragraph">
                            {!! $Step->step4_shotline !!}
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="step_four_design">

		<div class="container where_to_start_section where_to_start_section_2">
			<div class="row position-relative align-items-center">
				<div class="col-md-12 order-2 order-md-1">
					<div class="jewellery-paragraph-box text-center text-md-start">
						<div class="cut_shape_heading mb-3">{{ $Step->step4_section1_title }}</div>
						<p class="customer_stories_paragraph">{!! $Step->step4_section1_description !!}</p>
					</div>
				</div>
			</div>
		</div>

		<div class="container where_to_start_section pt-0">
			<div class="row align-items-center where_to_start_section_2">
				<div class="col-md-5">
					<div>
						<img src="{{ url('images/steps/'.$Step->step4_section2_image) }}" alt="">
					</div>
				</div>
				<div class="col-md-7">
					<div class="jewellery-paragraph-box text-center text-md-start">
						<div class="cut_shape_heading mb-3">{{ $Step->step4_section2_title }}
						</div>
						<p class="customer_stories_paragraph">{!! $Step->step4_section2_description !!}</p>
					</div>
				</div>
			</div>
			<div class="row align-items-center">
				<div class="col-md-5">
					<div>
						<img src="{{ url('images/steps/'.$Step->step4_section3_image) }}" alt="">
					</div>
				</div>
				<div class="col-md-7">
					<div class="jewellery-paragraph-box text-center text-md-start">
						<div class="cut_shape_heading mb-3">
                        {{ $Step->step4_section3_title }}
						</div>
						<span class="customer_stories_paragraph">
							<p>
                              {!! $Step->step4_section3_description !!}
							</p>
							
						</span>
					</div>
					<div class="jewellery-paragraph-box text-center text-md-start">
						<div class="cut_shape_heading mb-3">
                        {{ $Step->step4_section4_title }}
						</div>
						<span class="customer_stories_paragraph">
							<p>
                               {!! $Step->step4_section4_description !!}
							</p>
							
						</span>
					</div>
				</div>
			</div>
			<div class="row align-items-center where_to_start_section">
				<div class="col-md-7">
					<div class="jewellery-paragraph-box text-center text-md-start">
						<div class="cut_shape_heading mb-3">
                           {{ $Step->step4_section5_title }}
						</div>
						<p class="customer_stories_paragraph">
                           {!! $Step->step4_section5_description !!}
						</p>
					</div>
					<div class="jewellery-paragraph-box text-center text-md-start">
						<div class="cut_shape_heading mb-3">
                        {{ $Step->step4_section6_title }}
						</div>
						<span class="customer_stories_paragraph">
							<p>
                            {!! $Step->step4_section6_description !!}
							</p>
						
						</span>
					</div>
					<!-- <div class="jewellery-paragraph-box text-center text-md-start">
						<div class="cut_shape_heading mb-3">
                        {{ $Step->step4_section7_title }}
						</div>
						<span class="customer_stories_paragraph">
							<p>
                            {!! $Step->step4_section7_description !!}
							</p>
							
						</span>
					</div> -->
				</div>
				<div class="col-md-5">
					<div>
						<img src="{{ url('images/steps/'.$Step->step4_section5_image) }}" alt="">
					</div>
				</div>
			</div>
		</div>

		<div class="container where_to_start_section where_to_start_section_2">
			<div class="row position-relative align-items-center">
				<div class="col-md-12 order-2 order-md-1">
					<div class="jewellery-paragraph-box text-center text-md-start">
						<div class="cut_shape_heading mb-3">{{ $Step->step4_section8_title }}</div>
						<p class="customer_stories_paragraph">{!! $Step->step4_section8_description !!}
						</p>
						
					</div>
				</div>
			</div>
		</div>

		<div class="container where_to_start_section pt-0">
			<div class="row align-items-center">
				<div class="col-md-5">
					<div>
						<img src="{{ url('images/steps/'.$Step->step4_section9_image) }}" alt="">
					</div>
				</div>
				<div class="col-md-7">
					<div class="jewellery-paragraph-box text-center text-md-start">
						<div class="cut_shape_heading mb-3">{{ $Step->step4_section9_title }}</div>
						<p class="customer_stories_paragraph">
                        {{ $Step->step4_section9_description }}</p>
						
					</div>
					<div class="jewellery-paragraph-box text-center text-md-start">
						<div class="cut_shape_heading mb-3">{{ $Step->step4_section10_title }}</div>
						<p class="customer_stories_paragraph">{!! $Step->step4_section10_description !!}</p>
						
					</div>
				</div>
			</div>
		</div>
		<div class="pb-5 where_to_start_section where_to_start_section_2">
			<div class="container">
				<div class="">
					<div class="text-center">
						<div class="cut_shape_heading mb-md-5">{{ $Step->step4_section11_title }}
						</div>
						<div class="row">
							<div class="col-md-6 text-end mb-3 mb-md-0">
								<a href="{{ url('product-setting/'.$Step->category_id) }}" class="maximise_your_budget_box">
									<div>
										<img src="{{ url('images/steps/'.$Step->step4_section11_image1) }}" alt="" class="maximise_your_budget_img">
									</div>
									<div class="category-heading category-heading-part ps-2 ps-md-4">
                                    {{ $Step->step4_section11_title1 }}
									</div>
                                </a>
							</div>
							<div class="col-md-6 text-end">
							    <a href="{{ url('diamond-setting/'.$Step->category_id) }}" class="maximise_your_budget_box">
									<img src="{{ url('images/steps/'.$Step->step4_section11_image2) }}" alt="" class="maximise_your_budget_img">
									<div class="category-heading category-heading-part ps-2 ps-md-4">
                                    {{ $Step->step4_section11_title2 }}
									</div>
                                </a>
							</div>
						
						</div>

					</div>
				</div>
			</div>
		</div>



	</div>



@endsection