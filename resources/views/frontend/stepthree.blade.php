@extends('frontend.layout.layout')

@section('content')


		<div class="background-sub-slider">
			<div class="">
				<!-- <img src="{{ url('images/steps/'.$Step->step3_header_image) }}" alt=""> -->
				<div class="about_us_background">
					<div class="sub_heading mb-lg-3">Step 3</div>
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
			<!-- <div class="pick_metal container">
				<div class="cut_shape_heading mb-3">Time to Pick a Metal of your choice</div>
				<div class="pick_metal_table">
					<div class="d-flex w-100 table">
						<div class="table_row">
							<div class="table_cell_head empty_cell">
								empty
							</div>
							<div class="table_cell">
								Durability
							</div>
							<div class="table_cell">
								Price
							</div>
						</div>
						<div class="table_row">
							<div class="table_cell_head">
								10K Gold
							</div>
							<div class="table_cell">
								From the three gold purities, 10k gold is the most durable. It has the lowest gold
								content of up to 41%. The rest of the components are mixed metals and alloys. It is best
								used in everyday-wear jewelry such as chains, rings, and earrings. 10k gold could cause
								skin irritation if you are allergic to any of the metals.
							</div>
							<div class="table_cell">10KT gold is the cheapest form of gold. It is best used in
								everyday-wear jewelry as it is an affordable option.</div>
						</div>
						<div class="table_row">
							<div class="table_cell_head">
								14K Gold
							</div>
							<div class="table_cell">
								14kt gold has the perfect balance between purity and durability. 14kt gold has about 58%
								gold content while still being more durable and affordable than 18kt gold. It is most
								popularly used in minimalist engagement ring designs.
							</div>
							<div class="table_cell">While being more expensive than 10k gold, 14kt is the more
								affordable option when it comes to gold jewelry. 14kt has an advantage over 18kt in
								terms of affordability and durability</div>
						</div>
						<div class="table_row">
							<div class="table_cell_head">
								18K Gold
							</div>
							<div class="table_cell">
								18kt gold has about 75% gold and 25% metals, making it one of the purest forms of gold
								used to make diamond-studded jewelry. This form of gold is less durable than 14kt and
								10kt gold. 18kt gold is most popularly used in engagement rings with large diamonds and
								other exquisite pieces.
							</div>
							<div class="table_cell">18kt gold is more expensive as it has a higher gold component.
								However 18kt gold is yet more affordable than Platinum making it a more commonly used
								metal for jewelry. It is usually used in jewelry with larger diamonds and other
								exquisite pieces.</div>
						</div>
						<div class="table_row">
							<div class="table_cell_head">
								Platinum
							</div>
							<div class="table_cell">
								Platinum is more durable than gold because of its extreme density and chemical
								structure. For example, the prongs holding the center stone of a platinum engagement
								ring are less likely to break than those of a gold engagement ring. Platinum will take
								longer to wear away than gold.
							</div>
							<div class="table_cell">While gold and platinum costs similar by price per gram, platinum is
								denser, so more of it is used when making jewelry. Additionally, platinum rings are
								usually 95% pure, whereas gold comes in different purities. Because platinum jewelry is
								heavier and more pure than gold, it is more expensive.</div>
						</div>
					</div>
				</div>
			</div>
			<div class="pick_metal_color container">
				<div class="cut_shape_heading mb-3">Choose the metal color of your choice</div>
				<div class="pick_metal_table">
					<div class="d-flex w-100 table">
						<div class="table_row">
							<div class="table_cell_head yellow_gold_bg">
								Yellow Gold
							</div>
							<div class="table_cell">
								<p> Naturally, gold is yellow and is considered a timeless color that won’t become
									dated.
									Yellow gold is featured in all engagement ring styles ranging from antique to
									modern.
									Yellow gold acts as a beautiful background, elevating the look of white diamonds on
									it.
									Go for Yellow gold as your metal color choice if you’d like your ring the classic,
									traditional way.
								</p>
								<a href=" " class="jewellery_paragraph_box_link text-decoration-underline">Shop Yellow
									Gold Engagement Rings</a>
							</div>
						</div>
						<div class="table_row">
							<div class="table_cell_head white_gold_bg">
								White Gold
							</div>
							<div class="table_cell">
								<p>
									White gold as a choice for engagement and wedding ring bands has
									skyrocketed in the last decade. So much, that it has replaced yellow gold as the
									most
									popular choice!
								</p>
								<p>
									It has a silvery white appearance making it a stunning choice for modern and
									minimalistic designs.
								</p>
								<p>
									One downside to white gold is its tendency to emphasize the yellow or blue tone of a
									diamond that has a low color grade.</p>
								<a href=" " class="jewellery_paragraph_box_link text-decoration-underline">Shop White
									Gold Engagement Rings</a>
							</div>
						</div>
						<div class="table_row">
							<div class="table_cell_head rose_gold_bg">
								Rose Gold
							</div>
							<div class="table_cell">
								<p> Rose gold is created by combining silver, copper, and gold. It’s the
									combination of copper and silver that gives it a rosy glow. Rose gold gives that
									dreamy,
									romantic pink hue to your engagement ring. Go for rose gold to make your ring stand
									out
									as a unique creation.
								</p>
								<a href=" " class="jewellery_paragraph_box_link text-decoration-underline">Shop Rose
									Gold Engagement Rings</a>
							</div>
						</div>
					</div>
				</div>
			</div> -->
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
							<a href="{{ url('/step/'.$Step->slug.'/four'); }}" class="explore-ring-btn btn-hover-effect banner-url d-inline-block text-center know_more_btn">know more</a>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>



@endsection