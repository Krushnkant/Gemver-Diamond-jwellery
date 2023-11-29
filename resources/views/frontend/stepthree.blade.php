@extends('frontend.layout.layout')

@section('content')


<div class="background-sub-slider">
	<div class="">
		<!-- <img src="{{ url('images/steps/'.$Step->step3_header_image) }}" alt=""> -->
		<div class="about_us_background">
			<h1 class="sub_heading mb-lg-3">Step 3</h1>
			<div class="about_us_link">
				<a href="#">{{ $Step->step3_title }}</a>
				<p class="mt-2 ste_1_paragraph">
					{!! $Step->step3_shotline !!}
				</p>
			</div>
		</div>
	</div>
</div>
</div>

<div class="step_three_design">

	<div class="container where_to_start_section">
		<div class="row position-relative align-items-center">
			<div class="col-md-12 order-2 order-md-1">
				<div class="jewellery-paragraph-box text-center text-md-start">
					<div class="cut_shape_heading mb-3">{{ $Step->step3_section1_title }}</div>
					<p class="customer_stories_paragraph">{!! $Step->step3_section1_description !!}</p>
				</div>
			</div>
		</div>
	</div>

	<div class="container where_to_start_section pt-0">
		<div class="row align-items-center">
			<div class="col-md-5">
				<div>
					<img src="{{ url('images/steps/'.$Step->step3_section2_image) }}" alt="">
				</div>
			</div>
			<div class="col-md-7">
				<div class="jewellery-paragraph-box text-center text-md-start">
					<div class="cut_shape_heading mb-3">{{ $Step->step3_section2_title }}</div>
					<p class="customer_stories_paragraph">{!! $Step->step3_section2_description !!}</p>
					<!-- <a href=" " class="jewellery_paragraph_box_link text-decoration-underline">Shop Solitaire
							Engagement Ring</a> -->
				</div>
			</div>
			<div class="col-md-7">
				<div class="jewellery-paragraph-box text-center text-md-start">
					<div class="cut_shape_heading mb-3">{{ $Step->step3_section3_title }}</div>
					<p class="customer_stories_paragraph">{!! $Step->step3_section3_description !!}</p>
					<!-- <a href=" " class="jewellery_paragraph_box_link text-decoration-underline">Shop Halo Engagement
							Ring</a> -->
				</div>
			</div>
			<div class="col-md-5">
				<div>
					<img src="{{ url('images/steps/'.$Step->step3_section3_image) }}" alt="">
				</div>
			</div>
			<div class="col-md-5">
				<div>
					<img src="{{ url('images/steps/'.$Step->step3_section4_image) }}" alt="">
				</div>
			</div>
			<div class="col-md-7">
				<div class="jewellery-paragraph-box text-center text-md-start">
					<div class="cut_shape_heading mb-3">{{ $Step->step3_section4_title }}</div>
					<p class="customer_stories_paragraph">{!! $Step->step3_section4_description !!}</p>

				</div>
			</div>
			<div class="col-md-7">
				<div class="jewellery-paragraph-box text-center text-md-start">
					<div class="cut_shape_heading mb-3">{{ $Step->step3_section5_title }}</div>
					<p class="customer_stories_paragraph">{!! $Step->step3_section5_description !!}</p>

				</div>
			</div>
			<div class="col-md-5">
				<div>
					<img src="{{ url('images/steps/'.$Step->step3_section5_image) }}" alt="">
				</div>
			</div>
			<div class="col-md-5">
				<div>
					<img src="{{ url('images/steps/'.$Step->step3_section6_image) }}" alt="">
				</div>
			</div>
			<div class="col-md-7">
				<div class="jewellery-paragraph-box text-center text-md-start">
					<div class="cut_shape_heading mb-3">{{ $Step->step3_section6_title }}</div>
					<p class="customer_stories_paragraph">{!! $Step->step3_section6_description !!}</p>

				</div>
			</div>
		</div>
	</div>

	<div class="container where_to_start_section">
		<div class="row position-relative align-items-center">
			<div class="col-md-12 order-2 order-md-1 where_to_start_section_2">
				<div class="jewellery-paragraph-box text-center text-md-start">
					<div class="cut_shape_heading mb-3">{{ $Step->step3_section7_title }}</div>
					<p class="customer_stories_paragraph">{!! $Step->step3_section7_description !!}
					</p>

				</div>
			</div>
		</div>
	</div>

	<div class="container where_to_start_section pt-0">
		<div class="row align-items-center">
			<div class="col-md-5">
				<div>
					<img src="{{ url('images/steps/'.$Step->step3_section8_image) }}" alt="">
				</div>
			</div>
			<div class="col-md-7">
				<div class="jewellery-paragraph-box text-center text-md-start">
					<div class="cut_shape_heading mb-3">{{ $Step->step3_section8_title }}</div>
					<p class="customer_stories_paragraph">{!! $Step->step3_section8_description !!}</p>

				</div>
			</div>
			<div class="col-md-7">
				<div class="jewellery-paragraph-box text-center text-md-start">
					<div class="cut_shape_heading mb-3">{{ $Step->step3_section9_title }}</div>
					<p class="customer_stories_paragraph">{!! $Step->step3_section9_description !!}</p>

				</div>
			</div>
			<div class="col-md-5">
				<div>
					<img src="{{ url('images/steps/'.$Step->step3_section9_image) }}" alt="">
				</div>
			</div>
			<div class="col-md-5">
				<div>
					<img src="{{ url('images/steps/'.$Step->step3_section10_image) }}" alt="">
				</div>
			</div>
			<div class="col-md-7">
				<div class="jewellery-paragraph-box text-center text-md-start">
					<div class="cut_shape_heading mb-3">{{ $Step->step3_section10_title }}</div>
					<p class="customer_stories_paragraph">{!! $Step->step3_section10_description !!}</p>

				</div>
			</div>
			<div class="col-md-7">
				<div class="jewellery-paragraph-box text-center text-md-start">
					<div class="cut_shape_heading mb-3">{{ $Step->step3_section11_title }}</div>
					<p class="customer_stories_paragraph">{!! $Step->step3_section11_description !!}</p>

				</div>
			</div>
			<div class="col-md-5">
				<div>
					<img src="{{ url('images/steps/'.$Step->step3_section11_image) }}" alt="">
				</div>
			</div>
		</div>
	</div>

	<div class="choose_setting_section where_to_start_section_2">
		<div class="container where_to_start_section pt-0">
			<div class="row position-relative align-items-center">
				<div class="col-md-5 mb-4">
					<div class="where_to_start_img">
						<img src="{{ url('frontend/image/ring-step-3.jpg') }}" alt="">
					</div>
				</div>
				<div class="col-md-7 mb-4 mb-md-0">
					<div class="jewellery-paragraph-box text-center text-md-start">
						<div class="mb-3 cut_shape_heading">{{ $Step->step4_title }}</div>
						<p class="customer_stories_paragraph">{!! $Step->step4_shotline !!}</p>
						<a href="{{ url('/step/'.$Step->slug.'/four') }}"
							class="explore-ring-btn btn-hover-effect banner-url d-inline-block text-center know_more_btn">know
							more</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection