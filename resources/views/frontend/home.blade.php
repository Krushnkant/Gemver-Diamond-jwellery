@extends('frontend.layout.layout')

@section('content')

        <!--<div class="background-slider">-->
        <!--    <div class="background-smoke-slider position-relative">-->
        <!--        <img src="{{ asset('frontend/image/smoke-2.png') }}" alt="">-->
        <!--        <div class="background-text-part">-->
        <!--            <img src="{{ asset('frontend/image/line.png') }}" alt="" class="line-image d-none d-md-block mx-auto">-->
        <!--            <h1 class="heading-h1 m-0 mt-md-3">Jewellery for each event.</h1>-->
        <!--            <div class="paragraph mt-0 mt-md-3">-->
        <!--                Tiniest piece of jewellery tells a great story-->
        <!--            </div>-->
        <!--            <button class="explore-ring-btn mt-3 mt-md-4 mt-xxl-5 btn-hover-effect">-->
        <!--                explore ring-->
        <!--            </button>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        
        @if(count($banners) > 0)
         <div class="owl-carousel owl-theme home-page-slider">
            @foreach($banners as $banner)  
            <div class="item">
                <div class="background-slider ">
                    <div class="background-smoke-slider position-relative ">
                        <img src="{{ asset($banner->banner_thumb) }}" alt=" ">
                        <div class="background-text-part ">
                            <!-- <img src="{{ asset('frontend/image/line.png') }} " alt=" " class="line-image d-none d-md-block mx-auto "> -->
                            <h1 class="heading-h1 m-0 mt-md-3 ">{{ $banner->title }}</h1>
                            <div class="paragraph mt-0 mt-md-3 ">
                            {{ $banner->description }}
                            </div>
                            @if($banner->button_name != "")
                            <button  class="explore-ring-btn mt-3 mt-md-4 mt-xxl-5 btn-hover-effect banner-url" data-value='{{ ($banner->button_url != "") ? $banner->button_url : '#'; }}'>
                                {{ $banner->button_name }}
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    
    @if(count($categories) > 0)
    <div class="shop_by_category">
        <div class="row">
            <div class="col-md-5 text-center d-flex justify-content-center align-items-center position-relative">
                <div>
                    <h2 class="heading-h2 mb-md-5 mt-5 mb-3 mt-md-0">Shop by category</h2>
                    <button class="explore-category-btn btn-hover-effect btn-hover-effect-black mb-5 mb-md-0">explore ring</button>
                </div>
                <div class="category-line-img d-none d-md-block">
                    <img src="{{ asset('frontend/image/category-line.png') }}" alt="">
                </div>
            </div>
            <div class="col-md-7 pe-md-0 mb-5 mb-md-0">
                <div class="row">
                  <?php
                   $col = 6;
                   if(count($categories) > 4){  
                       $col = 4;
                   }  
                   ?> 
                  @foreach($categories as $category)
                    <a href="{{ URL('/shop/'.$category->id)}}" class="col-sm-{{$col}} col-md-{{$col}} px-0 position-relative shop_by_category_hover">
                        <img src="{{ url($category->category_thumb) }}" alt="{{ $category->category_name }}" width="100%">
                        <div class="category-heading">
                            {{ $category->category_name }}
                        </div>
                    </a>
                  @endforeach 
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="shop_dimond_by_shape">
        <h2 class="heading-h2 mb-4 mb-md-5 pb-md-4  text-center text-white">Shop dimond by shape</h2>

        <div>
            <div class="owl-carousel owl-theme shop-dimond-by-shape-slider">
                <div class="item">
                    <a href="">
                        <img src="{{ asset('frontend/image/dimond-1.png') }}" alt="">
                    </a>
                </div>
                <div class="item">
                    <a href="">
                        <img src="{{ asset('frontend/image/dimond-2.png') }}" alt="">
                    </a>
                </div>
                <div class="item">
                    <a href="">
                        <img src="{{ asset('frontend/image/dimond-3.png') }}" alt="">
                    </a>
                </div>
                <div class="item">
                    <a href="">
                        <img src="{{ asset('frontend/image/dimond-4.png') }}" alt="">
                    </a>
                </div>
                <div class="item">
                    <a href="">
                        <img src="{{ asset('frontend/image/dimond-5.png') }}" alt="">
                    </a>
                </div>
                <div class="item">
                    <a href="">
                        <img src="{{ asset('frontend/image/dimond-6.png') }}" alt="">
                    </a>
                </div>
                <div class="item">
                    <a href="">
                        <img src="{{ asset('frontend/image/dimond-1.png') }}" alt="">
                    </a>
                </div>
                  <div class="item">
                    <a href="">
                        <img src="{{ asset('frontend/image/dimond-1.png') }}" alt="">
                    </a>
                </div>
                <div class="item">
                    <a href="">
                        <img src="{{ asset('frontend/image/dimond-2.png') }}" alt="">
                    </a>
                </div>
                <div class="item">
                    <a href="">
                        <img src="{{ asset('frontend/image/dimond-3.png') }}" alt="">
                    </a>
                </div>
                <div class="item">
                    <a href="">
                        <img src="{{ asset('frontend/image/dimond-4.png') }}" alt="">
                    </a>
                </div>
                <div class="item">
                    <a href="">
                        <img src="{{ asset('frontend/image/dimond-5.png') }}" alt="">
                    </a>
                </div>
                <div class="item">
                    <a href="">
                        <img src="{{ asset('frontend/image/dimond-6.png') }}" alt="">
                    </a>
                </div>
                <div class="item">
                    <a href="">
                        <img src="{{ asset('frontend/image/dimond-1.png') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if(count($testimonials) > 0)

    <div class="customer_stories">
        <div class="row">
            <div class="col-lg-5">
                <div class="">
                    <h2 class="heading-h2 text-white heading-h2-yellow-color text-center text-lg-start">Customer Stories</h2>
                    <div class="customer_stories_paragraph mb-3 mb-lg-0 text-center text-lg-start">don’t take our word for it, trust our <br> customers.</div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="owl-carousel owl-theme customer-stories">
                @foreach($testimonials as $testimonial)

                    <div class="item">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ url('images/testimonials/'.$testimonial->image) }}" alt="{{ $testimonial->name }}">
                            </div>
                            <div class="col-md-8 customer-stories-quotes d-flex flex-column justify-content-between">
                                <div class="customer-stories-paragraph mt-3 mt-md-0">
                                {!! $testimonial->description !!}
                                </div>
                                <div class="text-end mt-0 pt-0 mt-4 mt-xxl-5 pt-xxl-5">
                                    <div class="customer-name">{{ $testimonial->name }}</div>
                                    <div class="customer-country mt-2">{{ $testimonial->country }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                @endforeach    
                </div>
            </div>
        </div>
    </div>

    @endif
    <div class="engagement_ring_section">
        <div>
            <h2 class="heading-h2 text-center text-white">how to buy your diamond engagement ring?</h2>
            <div class="engagement_ring_paragraph mb-3 pb-0 mb-xl-4 mb-xxl-5 pb-xxl-5">Creating your lab grown diamond jewelry is simple. Follow the steps mentioned below when customizing your engagement ring.</div>
            <div class="row">
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
                    <div class="engagement_ring_box">
                        <div class="engagement_ring_number">1</div>
                        <div class="engagement_ring_heading mb-4">set a budget</div>
                        <p class="engagement_ring_paragraph text-start">Plan your budget before buying diamond jewelry, especially if it's your engagement ring.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
                    <div class="engagement_ring_box">
                        <div class="engagement_ring_number">2</div>
                        <div class="engagement_ring_heading mb-4">choose a diamond</div>
                        <p class="engagement_ring_paragraph text-start">Choose a lab diamond based on its 4C's: Cut, Color, Clarity and Carat Weight.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
                    <div class="engagement_ring_box">
                        <div class="engagement_ring_number">3</div>
                        <div class="engagement_ring_heading mb-4">choose a ring setting</div>
                        <p class="engagement_ring_paragraph text-start">Choose various styles and settings ranging from halos, solitaires and three stones.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
                    <div class="engagement_ring_box">
                        <div class="engagement_ring_number">4</div>
                        <div class="engagement_ring_heading mb-4">complate your ring</div>
                        <p class="engagement_ring_paragraph text-start">Select your ring size, customize it with an engraving according to your preference and complete your ring.</p>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button class="explore-ring-btn mt-3 mb-4 mt-md-5 mb-md-0 btn-hover-effect btn-hover-effect-black mobile-btn-effect">
                    learn more
                </button>
            </div>
        </div>
    </div>

    <div class="customise_own_ring_section">
        <div class="row">
            <div class="col-md-7 text-center text-md-start">
                <h2 class="heading-h2 text-white heading-h2-yellow-color text-center text-md-start">Customise Your Own Ring</h2>
                <div class="customer_stories_paragraph  mb-3 mb-lg-5">Let the promises be true for all the times to come. All the times that <br> your very own magnificent solitaire ring will bear witness to.</div>
                <button class="explore-category-btn btn-hover-effect btn-hover-effect-black diamond-btn">start with a diamond</button>
            </div>
            <div class="col-md-5 mt-4 mt-md-0">
                <div>
                    <img src="{{ asset('frontend/image/pink-image-ring.png') }}" alt="" width="100%">
                </div>
            </div>
        </div>
    </div>

    <div class="engagement_ring_section">
        <div>
            <h2 class="heading-h2 text-center text-white mb-3 mb-md-5">Shop by style</h2>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="owl-carousel owl-theme shop-by-style-slider">
                        <div class="item">
                            <a href="">
                                <img src="{{ asset('frontend/image/shop-1.png') }}" alt="">
                            </a>
                        </div>
                        <div class="item">
                            <a href="">
                                <img src="{{ asset('frontend/image/shop-2.png') }}" alt="">
                            </a>
                        </div>
                        <div class="item">
                            <a href="">
                                <img src="{{ asset('frontend/image/shop-3.png') }}" alt="">
                            </a>
                        </div>
                        <div class="item">
                            <a href="">
                                <img src="{{ asset('frontend/image/shop-1.png') }}" alt="">
                            </a>
                        </div>
                        <div class="item">
                            <a href="">
                                <img src="{{ asset('frontend/image/shop-2.png') }}" alt="">
                            </a>
                        </div>
                        <div class="item">
                            <a href="">
                                <img src="{{ asset('frontend/image/shop-3.png') }}" alt="">
                            </a>
                        </div>
                        <div class="item">
                            <a href="">
                                <img src="{{ asset('frontend/image/shop-1.png') }}" alt="">
                            </a>
                        </div>
                        <div class="item">
                            <a href="">
                                <img src="{{ asset('frontend/image/shop-2.png') }}" alt="">
                            </a>
                        </div>
                        <div class="item">
                            <a href="">
                                <img src="{{ asset('frontend/image/shop-3.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="gemver_diamonds_section">
        <div class="px-3">
            <h2 class="heading-h2 text-white heading-h2-yellow-color text-center text-md-start">why gemver diamonds?</h2>
            <div class="customer_stories_paragraph mb-3 mb-md-5 text-center text-md-start">We offer eco-friendly, sustainable gems at budget-friendly rates when <br> creating your own engagement ring & other fine jewelry.</div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-4 mt-md-0 px-0 px-md-3 position-relative ">
                <div>
                    <img src="{{ asset('frontend/image/smoke-bg.png') }}" alt="" width="100%">
                    <div class="diamonds_part">
                        <div class="diamonds_heading mb-3">
                            Customize Your Jewelry
                        </div>
                        <p class="diamonds_paragraph">Follow a four-step process to create a one-of-a-kind jewelry piece according to your preference and style.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-4 mt-md-0 px-0 px-md-3 position-relative">
                <div>
                    <img src="{{ asset('frontend/image/smoke-bg-2.png') }}" alt="" width="100%">
                </div>
            </div>
            <div class="col-md-6 mt-4 px-0 px-md-3 position-relative">
                <div>
                    <img src="{{ asset('frontend/image/smoke-bg-3.png') }}" alt="" width="100%">
                </div>
            </div>
            <div class="col-md-6 mt-4 px-0 px-md-3 position-relative">
                <div>
                    <img src="{{ asset('frontend/image/smoke-bg.png') }}" alt="" width="100%">
                    <div class="diamonds_part">
                        <div class="diamonds_heading mb-3">
                            Book Your Virtual Appointment
                        </div>
                        <p class="diamonds_paragraph">Consult with a qualified gemologist at absolutely no extra cost to handpick the perfect jewelry.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
     <script>
        
        $(document).ready(function(){
            
            $(document).on('click','.banner-url',function(){
                var banner_url = $(this).attr("data-value");
                window.location.href = banner_url;
            });
    
        });
        </script>
 @endsection
   