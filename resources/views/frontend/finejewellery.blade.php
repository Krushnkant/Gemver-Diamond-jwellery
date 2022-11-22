@extends('frontend.layout.layout')

@section('content')

<div class="engagement_bg_slider">
    <div class="d-block d-md-none mobile-view-img">  
        <?php $mobile_view_image = ($MenuPage->banner_mobile_image)?$MenuPage->banner_mobile_image:$MenuPage->banner_image; ?>
        <img src="{{ url('images/aboutus/'.$mobile_view_image) }}" alt="">
   </div>
   <div class="d-none d-md-block desktop-view-img">
        <img src="{{ url('images/aboutus/'.$MenuPage->banner_image) }}" alt="">
   </div>
    <!-- <div class="container engagement_text_part">
        <div class="engagement_text_part">
            <h1 class="heading-h1 engagement_heading text-start mb-3">{{ $MenuPage->main_title }}</h1>
            <p class="engagement_paragraph mb-4">
                {{ $MenuPage->main_shotline }}
            </p>
        </div>
    </div> -->
</div>

    <div class="pt-5 py-xl-5 mt-xl-5"> 
        <div class="container">
            <div class="row">
                <div class="choose_your_setting_heading text-center mb-2 mb-md-3">
                    Choose Your Setting Style
                </div>
                <p class="choose_your_setting_paragraph wedding_bands_paragraph text-center mb-3 mb-md-4 mb-xl-5">
                    Whatever the occasion, we've got a beatiful piece of jewellery for you.
                </p>
                @if($MenuPage->menupageshapestyle)
                @foreach($MenuPage->menupageshapestyle as $menupageshapestyle)
                <div class="col-6 col-md-3 col-lg-3 finejewellery-img mb-4 choose_your_setting_col" id="shopProductBtn" data-id="{{ $menupageshapestyle->category_id }}">
                    <img src="{{ url('images/shopstyle_image/'.$menupageshapestyle->image) }}" alt="">
                    <div class="finejewellery-box mt-3">
                        <div class="finejewellery-heading text-center mb-3">
                            {{ $menupageshapestyle->title }}
                        </div>
                         <p class="finejewellery-paragraph">
                            {{ $menupageshapestyle->subdiscription }}
                        </p> 
                    </div>
                </div> 
                @endforeach
                @endif 
                  
            </div>
        </div>
    </div>

    <div class="my-xxl-5">
        <div class="container mb-xl-5">
            <div class="row two_part_box_section">
                <div class="col-md-6 order-2 order-md-1 design_engagemnt_image lab-diamond-img">
                    <img src="{{ url('images/aboutus/'.$MenuPage->section1_image) }}" alt="">
                </div> 
                <div class="col-md-6 order-1 order-md-2 mb-3 mb-md-0">
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

    <div class="container mb-4 pt-4 mb-5 pb-xxl-5">
        <div class="choose_your_setting_heading text-center mb-3 mb-xl-3">{{ $MenuPage->section3_title }}</div>
        <p class="dainty-ring-gifts-paragraph mt-3 mb-4 mb-xl-4">  
            {{ $MenuPage->section3_description }}
        </p>
        <div class="row">
            <div class="col-md-4 mb-3 mb-md-0 shopProductBtn dainty-ring-gifts-icon" data-id="{{ $MenuPage->section31_category_id }}">
                <img src="{{ url('images/aboutus/'.$MenuPage->section31_image) }}" alt="">
            </div>
            <div class="col-md-4 mb-3 mb-md-0 shopProductBtn dainty-ring-gifts-icon" data-id="{{ $MenuPage->section32_category_id }}">
                <img src="{{ url('images/aboutus/'.$MenuPage->section32_image) }}" alt="">
            </div>
            <div class="col-md-4 mb-3 mb-md-0 shopProductBtn dainty-ring-gifts-icon" data-id="{{ $MenuPage->section33_category_id }}">
                <img src="{{ url('images/aboutus/'.$MenuPage->section33_image) }}" alt="">
            </div>
        </div>
        
    </div>

    
 
    <script type="text/javascript">
        $(document).ready(function() {    
            $('body').on('click', '#shopProductBtn', function () {
                var category_id = $(this).attr('data-id');
                var url = "{{ url('shop/') }}" + "/" + category_id;
                window.open(url,"_blank");
            });

            $('body').on('click', '.shopProductBtn', function () {
                var category_id = $(this).attr('data-id');
                var url = "{{ url('shop/') }}" + "/" + category_id;
                window.open(url,"_blank");
            });
        
        });
    </script>

@endsection