@if(isset($OrderIncludes->orderincludesdata))
    <!-- <div class="row mt-md-0 mt-xl-4 align-items-center">
        <div class="col-md-12 col-lg-12 col-lg-12 order-part px-0">
            <div class="your-order-include-img">
                <img src="{{ asset('frontend/image/your-order-include.png') }}">
            </div>
            <div class="row mt-2 mt-md-0 justify-content-center your_order_include_img">
                <div class="your_include_boxes_img_part">
                <div class="offset-md-6 col-md-6">
                    <div class="row">
                        <div class="order-includes-heading text-start text-lg-center d-xl-block mb-3 mb-md-4">
                            {{ $OrderIncludes->title }}
                        </div>
                        @foreach($OrderIncludes->orderincludesdata as $orderincludesdata)
                            <div class="col-sm-6 col-md-6 col-xl-6 order-box-part px-0 px-md-3 order-include-col">
                                <div class="order-box d-flex align-items-center">
                                <span class="order-img d-block mb-2">
                                    <img src="{{ url('images/order_image/'.$orderincludesdata->image) }}" alt="">   
                                </span>
                                <span class="order-text text-center d-block">
                                    {{ $orderincludesdata->title }}
                                </span>
                                </div>    
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- <div class="order-includes-sections">
        <div class="your_order_include_img container">
            <div class="your_include_boxes_img_part">
                <div class="offset-md-4 col-md-8">
                    <div class="row order-content-box">
                        <div class="order-includes-heading text-start text-lg-center d-xl-block mb-3 mb-md-4">
                            {{ $OrderIncludes->title }}
                        </div>
                        @foreach($OrderIncludes->orderincludesdata as $orderincludesdata)
                            <div class="col-sm-12 col-md-4 col-xl-4 order-box-part px-0 px-md-3 order-include-col">
                                <div class="order-box d-flex align-items-center">
                                    <span class="order-img d-block mb-2">
                                        <img src="{{ url('images/order_image/'.$orderincludesdata->image) }}" alt="">   
                                    </span>
                                    <span class="order-text text-center d-block">
                                        {{ $orderincludesdata->title }}
                                    </span>
                                </div>    
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- <div class="customise_own_ring_section mb-5" style="background-color:#3E9F8E;color:white; border-radius: 0px; ">
        <div class="row">
            <div class="col-md-6 px-4 engagement_ring_col_part px-0 mt-md-0 py-4 order-2 order-md-1">
                <div class="engagement_ring_diamond_part">
                    <h2 >{{ $OrderIncludes->title }}</h2>
                    <div class="customer_stories_paragraph  mb-3 mb-lg-4">{{ $OrderIncludes->description }}</div>
                </div>
            </div>
            <div class="col-md-6 pe-0 px-0 order-1 order-md-2 " style="margin-bottom:70px;margin-top:50px;">
            <div class="choose_your_setting_faq">
                <div class="row">
                @foreach($OrderIncludes->orderincludesdata as $orderincludesdata)
                    <div class="col-md-8  offset-md-2 ">
                        <button class="accordion order-box-part">
                        <div class="order-box d-flex align-items-center">
                                <span class="order-img d-block ">
                                    <img src="{{ url('images/order_image/'.$orderincludesdata->image) }}" alt="">   
                                </span>
                                <span class="order-text text-center d-block">
                                    {{ $orderincludesdata->title }}
                                </span>
                            </div> 
                        </button>
                        <div class="panel" style="display: none;">
                        {{ $orderincludesdata->description }}
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
            </div>
        </div>
    </div> -->
@endif
<!-- </div> -->