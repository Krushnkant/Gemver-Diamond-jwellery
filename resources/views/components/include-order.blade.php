@if(isset($OrderIncludes->orderincludesdata))
        <div class="row mt-md-0 mt-xl-4 align-items-center">
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
            </div>
            @endif
        </div>