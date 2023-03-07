@if(count($ProductRelated) > 0)
    <div class="container">
        <div class="shop_by_category pt-0">
            <div class="row">
                <div class="col-md-12 text-center d-flex justify-content-center align-items-center position-relative">
                    <div>
                        <h2 class="heading-h2 mb-xl-5 mb-3 mt-md-0">Related Product </h2>
                    </div>
                </div>
                <div class="owl-carousel owl-theme product-detail mb-5 px-0">
                    @foreach($ProductRelated as $key => $Related)
                    <?php
                       
                     $images = explode(",",$Related->product_variant[$key]->images);
                     $image = URL($images['0']);
                     $sale_price = $Related->product_variant[$key]->sale_price;
                     $regular_price =  $Related->product_variant[$key]->regular_price ;
                     if($iscustom == 1){
                        $url =  URL('custom-product-details/'.$Cslug.'/'.$Related->product_variant[$key]->slug); 
                     }else{
                        $url =  URL('product-details/'.$Related->product_variant[$key]->slug); 
                     }
                     

                    $alt_text = "";
                    if($Related->product_variant[$key]->alt_text != ""){
                        $alt_texts = explode(",",$Related->product_variant[$key]->alt_text);
                        $alt_text = $alt_texts['0'];
                    }
                    
                    ?>
                    <div class="hover_effect_part wire_bangle_shop_radio" >
                        <div class="wire_bangle_img_radio_button">
                            <div class="wire_bangle_img mb-3 position-relative">
                                <a class="wire_bangle_hover_a" href="{{ $url }}"><img src="{{ $image }}" alt="{{ $alt_text }}"></a>
                            </div>
                            <div class="wire_bangle_description p-2">
                                <?php 
                                    $ProductVariantVariant = \App\Models\ProductVariantVariant::with('attribute','attribute_terms')->where('estatus',1)->where('product_id',$Related->id)->groupBy('attribute_id')->get();
                                    foreach($ProductVariantVariant as $productvariants){
                                        if($productvariants->attribute_terms['0']->attrterm_thumb != ''){
                                            ?>
                                            <span class="wire_bangle_color wire_bangle_color_img_part text-center wire_bangle_color_ring_part">
                                                <div class="wire_bangle_color_part mb-2">
                                                    <?php
                                                        $product_attribute = \App\Models\ProductVariantVariant::with('attribute_terms','product_variant')->where('estatus',1)->where('attribute_id',$productvariants->attribute_id)->where('product_id',$Related->id)->groupBy('attribute_term_id')->get();
                                                        $ia = 1;
                                                        foreach($product_attribute as $attribute_term){
                                                            $attributeurl =  URL('product-details/'.$attribute_term->product_variant->slug); 
                                                            ?>
                                                            <span class="form-check d-inline-block">
                                                                <a href="{{ $attributeurl }}">
                                                                <img src="{{ url('images/attrTermThumb/'.$attribute_term->attribute_terms[0]->attrterm_thumb) }}" alt="{{ $attribute_term->attribute_terms[0]->attrterm_name }}"  class="wire_bangle_color_img pe-auto">
                                                                </a>
                                                                <div class="wire_bangle_color_input_label"></div>
                                                            </span>
                                                            <?php        
                                                            $ia++;    
                                                        }
                                                    ?>
                                                </div>
                                            </span>
                                            <?php
                                        } 
                                    }
                                ?>
                                <div class="wire_bangle_heading mb-2">
                                    {{ $Related->primary_category->category_name }}
                                    <input type="hidden" class="variant_id" value="{{ $Related->product_variant[$key]->id }}">    
                                    <input type="hidden" class="item_type" value="0">    
                                    <span type="button" class="btn btn-default add-to-wishlist-btn" data-toggle="tooltip" data-placement="right" title="Wishlist">
                                        <?php 
                                        if(is_wishlist($Related->product_variant[$key]->id,0)){ 
                                            ?>
                                            <i class="fas fa-heart heart-icon-part"></i>
                                            <?php 
                                        } else { 
                                            ?>
                                            <i class="far fa-heart"></i> 
                                            <?php 
                                        }
                                        ?>
                                    </span>
                                </div>
                                <div class="wire_bangle_sub_heading wire_bangle_description"><a href="{{ $url }}">{{ $Related->product_title }}</a></div>
                                <div class="d-flex justify-content-between  align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="wire_bangle_price wire_bangle_price_part">
                                            ${{ $sale_price }}
                                        </span>
                                        <span class="ms-2 wire_bangle_dublicate_price product_detail_regular_price">$<span class="regular_price">{{ $regular_price }}</span></span>
                                    </div>
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