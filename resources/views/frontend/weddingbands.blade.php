@extends('frontend.layout.layout')

@section('content')

<div class="engagement_bg_slider">
    <img src="{{ asset('frontend/image/engagement-bg.png') }}" alt="">
    <div class="container engagement_text_part">
        <div class="engagement_text_part">
            <h1 class="heading-h1 engagement_heading text-start mb-3">Wedding Bands</h1>
            <p class="engagement_paragraph mb-4">
                A wedding band is a symbol of commitment; a
                promise, a pledge, and a vow.
            </p>
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
        <div class="col-md-6">
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
        <div class="col-md-6">
            <img src="{{ asset('frontend/image/choose_made_engagement.png') }}" alt="">
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