@extends('frontend.layout.layout')

@section('content')

<div class="engagement_bg_slider">
    <img src="{{ asset('frontend/image/engagement-bg.png') }}" alt="">
    <div class="container engagement_text_part">
        <div class="engagement_text_part">
            <h1 class="heading-h1 engagement_heading text-start mb-3">Engagement Ring</h1>
            <p class="engagement_paragraph mb-4">
                Create your unique engagement ring from either the setting or a diamond.
            </p>
            <div class="engagement_button">
                <button class="engagement_start_diamond">Start with Diamond</button>
                <button class="engagement_start_setting ms-2 ms-md-3">Start with setting</button>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="choose_your_setting_section">
        <div class="choose_your_setting_heading text-center mb-3 mb-md-4 mb-lg-5">
            Choose Your Setting Stlye
        </div>
        <div class="row">
            <div class="col-sm-4 col-md-4 col-lg-2 text-center mb-3 mb-lg-0">
                <img src="{{ asset('frontend/image/ring_setting_1.png') }}" alt="">
                <div class="choose_sub_heading mt-3">
                    Solitaire
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-2 text-center mb-3 mb-lg-0">
                <img src="{{ asset('frontend/image/ring_setting_2.png') }}" alt="">
                <div class="choose_sub_heading mt-3">
                    Halo
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-2 text-center mb-3 mb-lg-0">
                <img src="{{ asset('frontend/image/ring_setting_3.png') }}" alt="">
                <div class="choose_sub_heading mt-3">
                    Three Stone
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-2 text-center mb-3 mb-lg-0">
                <img src="{{ asset('frontend/image/ring_setting_4.png') }}" alt="">
                <div class="choose_sub_heading mt-3">
                    Vintage
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-2 text-center mb-3 mb-lg-0">
                <img src="{{ asset('frontend/image/ring_setting_5.png') }}" alt="">
                <div class="choose_sub_heading mt-3">
                    Bridal Sets
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-2 text-center mb-3 mb-lg-0">
                <img src="{{ asset('frontend/image/ring_setting_5.png') }}" alt="">
                <div class="choose_sub_heading mt-3">
                    Bridal Sets
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6 order-2 order-md-1">
            <div class="choose_your_setting_box text-center">
                <div class="">
                    <div class="custom_made_heading text-center mb-0 mb-xl-3">
                        Custom-Made Engagement Rings
                    </div>
                    <p class="custom_engagement_paragrph">
                        Need some ring-spiration? Get inspired by some of our custom-made rings to help you get started on planning for your ideal engagement ring.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 order-1 order-md-2 mb-3 mb-md-0">
            <img src="{{ asset('frontend/image/choose_made_engagement.png') }}" alt="">
        </div>  
    </div>
</div>
 
<div class="create_your_own_section my-5">
   <div class="container">
    <div class="row">
            <div class="col-md-12">
                <div class="choose_your_setting_heading text-center mb-5">
                    Create your own Engegement Ring
                </div>
                <div class="row">
                    <div class="col-md-4 position-relative create_your_own_icon">
                        <div class="create_your_own_image">
                            <img src="{{ asset('frontend/image/engagement_1.png') }}" alt="">
                        </div>
                        <div class="text-center create_your_own_heading mb-3">
                            Choose Setting
                        </div>
                        <p class="create_your_own_paragraph">
                            Select an engagement ring setting to pair with your diamond.
                        </p>
                        <div class="create_your_own_icon_part">
                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="32" viewBox="0 0 31 32" fill="none">
                                <path d="M30.0254 12.416V19.3008H0.787109V12.416H30.0254ZM19.127 0.667969V31.7227H11.7148V0.667969H19.127Z" fill="#0B1727"/>
                            </svg>
                        </div>
                    </div>
                   
                    <div class="col-md-4 position-relative">
                        <div class="create_your_own_image">
                            <img src="{{ asset('frontend/image/engagement_2.png') }}" alt="">
                        </div>
                        <div class="text-center create_your_own_heading mb-3">
                            Choose Diamond
                        </div>
                        <p class="create_your_own_paragraph">
                            Select an engagement ring setting to pair with your diamond.
                        </p>
                        <div class="create_your_own_icon_part">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="20" viewBox="0 0 26 20" fill="none">
                                <path d="M25.9414 0.318359V6.55859H0.0722656V0.318359H25.9414ZM25.9414 12.8574V19.0977H0.0722656V12.8574H25.9414Z" fill="#0B1727"/>
                            </svg>
                        </div>
                    </div>
                   
                    <div class="col-md-4 position-relative">
                        <div class="create_your_own_image">
                            <img src="{{ asset('frontend/image/engagement_3.png') }}" alt="">
                        </div>
                        <div class="text-center create_your_own_heading mb-3">
                            Complete your Ring
                        </div>
                        <p class="create_your_own_paragraph">
                            Select an engagement ring setting to pair with your diamond.
                        </p>
                    </div>
                </div>
            </div>  
        </div>
   </div>
</div>

<div class="container mb-5 pb-5">
    <div class="row">
        <div class="col-md-6">
            <div class="choose_your_setting_box text-center">
                <div class="">
                    <div class="custom_made_heading text-center mb-0 mb-xl-3">
                        Ready to Ship
                    </div>
                    <p class="custom_engagement_paragrph">
                        Ready to ship brings you engagement ring you
                        can get when you are in a rush.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <img src="{{ asset('frontend/image/ready_to_ship.png') }}" alt="">
        </div>  
    </div>
</div>

@endsection