@extends('frontend.layout.layout')

@section('content')

<div class="engagement_bg_slider">
    <img src="{{ asset('frontend/image/finejewellery.png') }}" alt="">
    <div class="container engagement_text_part">
        <div class="engagement_text_part">
            <h1 class="heading-h1 engagement_heading text-start mb-3">Fine Jewellery</h1>
            <p class="engagement_paragraph mb-4">
                Covetable jewellery pieces hand-crafted for any  occasion Explore our extensive collection of  everyday jewellery.
            </p>
        </div>
    </div>
</div>

    <div class="pt-5 py-xl-5 mt-xl-5"> 
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 finejewellery-img mb-4">
                    <img src="{{ asset('frontend/image/ring-part.png') }}" alt="">
                    <div class="finejewellery-box mt-3">
                        <div class="finejewellery-heading text-center mb-3">
                            Rings
                        </div>
                        <p class="finejewellery-paragraph">
                            Classic, opulent, or delicate - regardless of the occasion, we have the perfect ring to complement every look.
                        </p>
                    </div>
                </div>  
                <div class="col-md-6 col-lg-3 finejewellery-img mb-4">
                    <img src="{{ asset('frontend/image/earrings-part.png') }}" alt="">
                    <div class="finejewellery-box mt-3">
                        <div class="finejewellery-heading text-center mb-3">
                            Earrings
                        </div>
                        <p class="finejewellery-paragraph">
                            From classic designs to creative twists, our exquisite hand-crafted earrings are a must-have fashion accessory.
                        </p>
                    </div>
                </div>  
                <div class="col-md-6 col-lg-3 finejewellery-img mb-4">
                    <img src="{{ asset('frontend/image/couple-ring-part.png') }}" alt="">
                    <div class="finejewellery-box mt-3">
                        <div class="finejewellery-heading text-center mb-3">
                            Couple Rings
                        </div>
                        <p class="finejewellery-paragraph">
                            Classic, opulent, or delicate - regardless of the occasion, we have the perfect ring to complement every look.
                        </p>
                    </div>
                </div>  
                <div class="col-md-6 col-lg-3 finejewellery-img mb-4">
                    <img src="{{ asset('frontend/image/bracelets-part.png') }}" alt="">
                    <div class="finejewellery-box mt-3">
                        <div class="finejewellery-heading text-center mb-3">
                            Bracelets
                        </div>
                        <p class="finejewellery-paragraph">
                            Hand-crafted to flatter every jewellery style.
                        </p>
                    </div>
                </div>      
            </div>
        </div>
    </div>

    <div class="my-xxl-5">
        <div class="container mb-xl-5">
            <div class="row">
                <div class="col-md-6 mb-3 mb-md-0 design_engagemnt_image lab-diamond-img pe-md-0">
                    <img src="{{ asset('frontend/image/gifts.png') }}" alt="">
                </div> 
                <div class="col-md-6 ps-md-0">
                    <div class="choose_your_setting_box text-center">
                        <div class="">
                            <div class="custom_made_heading text-center mb-2 mb-xl-3">
                                Gifts
                            </div>
                            <p class="custom_engagement_paragrph">
                                Shop our dainty jewellery pieces that make the perfect personalised gift for any special occasion.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-4 pt-4">
        <div class="choose_your_setting_heading text-center mb-3 mb-xl-5">Dainty Ring Gifts</div>
        <div class="row">
            <div class="col-md-4 mb-3 mb-md-0">
                <img src="{{ asset('frontend/image/dainty-ring-1.png') }}" alt="">
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <img src="{{ asset('frontend/image/dainty-ring-2.png') }}" alt="">
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <img src="{{ asset('frontend/image/dainty-ring-3.png') }}" alt="">
            </div>
        </div>
        <p class="dainty-ring-gifts-paragraph mt-3 mt-xl-5 mb-xl-5 pb-xl-5">  
            Minimalist and classic dainty rings. Stacked or alone, our dainty rings make the perfect gift and a quintessential addition to any jewellery collection.
        </p>
    </div>

    
 


@endsection