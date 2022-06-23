@extends('frontend.layout.layout')

@section('content')
        <div class="background-sub-slider">
            <div class="position-relative">
                <img src="image/about_us.png" alt="">
                <div class="about_us_background">
                    <div class="sub_heading mb-lg-3">{{ $Category->category_name }} setting</div>
                    <div class="about_us_link">
                        <a href="{{ URL('/') }}">home</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none" class="mx-2">
                            <path d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z" fill="white"/>
                            <path d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z" fill="white"/>
                        </svg>
                        <a href="#">{{ $Category->category_name }} setting</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="wire_bangle_page container">
        <div class="row mb-lg-5 pb-lg-5 mb-4  align-items-center step-progressbar-row">
            <div class="col-lg-2 text-center text-lg-start">
                <div class="step-progressbar-side-heading mb-3 mb-lg-0">Create Your {{ $Category->category_name }}</div>
            </div>
            <div class="col-lg-10">
                <div class="flex-container step-progressbar">
                    <div class="flex-row text-center">
                        <div class="flex-col-xs-12">
                            @if($check_diamond == 1)
                            <ul class="tab-steps--list">
                                <li data-step="1">
                                    <div class="step-img">
                                        <img src="{{ url('frontend/image/edit_box_2.png') }}" alt="choose diamond">
                                    </div>
                                    <div class="step-heading mt-2">
                                        choose diamond
                                    </div>
                                    <a href="#" class="step-heading-link mt-2 d-block">browse lab diamonds</a>
                                </li>
                                <li class="active" data-step="2">
                                    <div class="step-img">
                                        <img src="{{ url($Category->category_thumb) }}" alt="choose setting">
                                    </div>
                                    <div class="step-heading mt-2">
                                        choose setting
                                    </div>
                                </li>
                                <li data-step="3">
                                    <div class="step-img">
                                        <img src="{{ url($Category->category_thumb) }}" alt="complete the {{ $Category->category_name }}">
                                    </div>
                                    <div class="step-heading mt-2">
                                        complete the {{ $Category->category_name }}
                                    </div>
                                </li>
                            </ul>
                            @else
                            <ul class="tab-steps--list">
                                <li class="active" data-step="1">
                                    <div class="step-img">
                                        <img src="{{ url($Category->category_thumb) }}" alt="">
                                    </div>
                                    <div class="step-heading mt-2">
                                        choose setting
                                    </div>
                                </li>
                                <li data-step="2">
                                    <div class="step-img">
                                        <img src="{{ url('frontend/image/edit_box_2.png') }}" alt="">
                                    </div>
                                    <div class="step-heading mt-2">
                                        choose diamond
                                    </div>
                                    <a href="#" class="step-heading-link mt-2 d-block">browse lab diamonds</a>
                                </li>
                                <li data-step="3">
                                    <div class="step-img">
                                        <img src="{{ url($Category->category_thumb) }}" alt="">
                                    </div>
                                    <div class="step-heading mt-2">
                                        complete the {{ $Category->category_name }}
                                    </div>
                                </li>
                            </ul>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row" >
            <div class="col-md-6 wire_bangle_padding mb-4" id="vimage">
                <div class="slider slider-single mb-5">
                    <?php 
                    foreach($Product->product_variant as $variant){
                        $images = explode(",",$variant->images);
                        foreach($images as $image){
                    ?>
                    <div class="product_slider_main_item">
                        <img src="{{ URL($image) }}" alt="">
                    </div>     
                    <?php 
                        }
                    }
                    ?> 
                </div>
                <div class="slider slider-nav">
                <?php 
                    foreach($Product->product_variant as $variant){
                        $images = explode(",",$variant->images);
                        foreach($images as $image){
                    ?>
                    <div class="product_slider_item">
                        <h3><img src="{{ URL($image) }}" alt=""></h3>
                    </div>    
                    <?php 
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-6 wire_bangle_padding_2">
                <div class="wire_bangle_content">
                    <div class="">
                        <div class="wire_bangle_heading mb-2 mb-xl-4 pb-xxl-2">{{ $Product->product_title }}</div>
                        <div class="d-flex mb-2 mb-xl-4 pb-xxl-2">
                            <span class="wire_bangle_price ">$<span class="sale_price">{{ $Product->product_variant['0']->sale_price }} </span>
                                @if($Product->product_variant['0']->regular_price != '' || $Product->product_variant['0']->regular_price != 0 )
                                <sub class="ms-2 wire_bangle_dublicate_price ">$<span class="regular_price"> {{ $Product->product_variant['0']->regular_price }} </span></sub>
                                @endif
                            </span>
                        </div>
                        <p class="wire_bangle_paragraph mb-xl-4">{!! Str::limit($Product->desc, 140, '...<a href="#description">read more </a>');  !!}</p>
                       
                        <form action="" class="mb-4 mb-lg-5">
                            <input type="hidden" value="{{ $Product->id }}" name="product_id" id="product_id">
                            <?php
                            $ProductVariantVariant = \App\Models\ProductVariantVariant::with('attribute','attribute_terms')->where('estatus',1)->where('product_id',$Product->id)->groupBy('attribute_id')->get();
                            foreach($ProductVariantVariant as $productvariants){
                               // $categories = \App\Models\Attribute::where('estatus',1)->where('id',$Product->id)->get();
                             if($productvariants->attribute_terms['0']->attrterm_thumb != ''){
                            ?>
                            <div class="wire_bangle_color_heading mb-2">{{ $productvariants->attribute->attribute_name }}</div>
                                <div class="wire_bangle_color mb-xxl-4 pb-md-2 wire_bangle_color_img_part">
                                <?php 
                                $product_attribute = \App\Models\ProductVariantVariant::with('attribute_terms')->where('estatus',1)->where('attribute_id',$productvariants->attribute_id)->where('product_id',$Product->id)->groupBy('attribute_term_id')->get();
                                $ia = 1;
                                ?>    
                                @foreach($product_attribute as $attribute_term)
                                    <span class="form-check d-inline-block">
                                        <input class="form-check-input variant"  {{ $ia == "1" ? "checked" : ""  }} value="{{ $attribute_term->attribute_terms[0]->id }}"  type="radio" name="AtributeVariant{{ $productvariants->attribute->attribute_name }}" id="" title="{{ $attribute_term->attribute_terms[0]->attrterm_name }}">
                                        <img src="{{ url('images/attrTermThumb/'.$attribute_term->attribute_terms[0]->attrterm_thumb) }}" alt="{{ $attribute_term->attribute_terms[0]->attrterm_name }}"  class="wire_bangle_color_img">
                                        <div class="wire_bangle_color_input_label"></div>
                                    </span>
                                <?php $ia++ ?>    
                                @endforeach
                            </div>
                            <?php 
                            }else{ 
                             $iv = 1;
                            ?>
                                <div class="wire_bangle_color_heading mb-2">{{ $productvariants->attribute->attribute_name }}</div>
                                <div class="wire_bangle_carat">
                                <?php 
                                 $product_attribute = \App\Models\ProductVariantVariant::with('attribute_terms')->where('estatus',1)->where('attribute_id',$productvariants->attribute_id)->where('product_id',$Product->id)->groupBy('attribute_term_id')->get();
                                ?>    
                                @foreach($product_attribute as $attribute_term)
                                <span class="form-check d-inline-block position-relative me-2  ps-0 mb-3">
                                        <input class="form-check-input variant" {{ $iv == "1" ? "checked" : ""  }} value="{{ $attribute_term->attribute_terms[0]->id }}"  type="radio" name="AtributeVariant{{ $productvariants->attribute->attribute_name }}" id="AtributeVariant{{ $attribute_term->attribute_terms[0]->id }}">
                                        <label class="form-check-label wire_bangle_carat_label" for="AtributeVariant{{ $attribute_term->attribute_terms[0]->id }}">
                                        {{ $attribute_term->attribute_terms[0]->attrterm_name }}
                                    </label>
                                    </span>
                                    <?php $iv++ ?>    
                                @endforeach    
                                
                            </div>
                            <?php 
                               } 
                            }  
                            ?>

                            <div class="mb-4 " id="speci_multi">
                            </div>
                            <input type="hidden" value="" name="variant_id" id="variant_id">
                            
                            <button id="save_newProductBtn" class="select_setting_btn  btn-hover-effect btn-hover-effect-black diamond-bt">select setting</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-xl-5 pt-xxl-5 mb-xxl-4" id="description">
            <div class="col-md-3">
                <div class="description_heading">
                    description
                </div>
            </div>
            <div class="col-md-9">
                <p class="description_paragraph">{{ $Product->desc }}</p>
            </div>
        </div>
        <div class="accordion wire_bangle_accordion" id="accordionExample">
            <div class="accordion-item">
                <div class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                         Details
                    </button>
                </div>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row" id="specification">
                            <?php
                            $product_attributes_specification = \App\Models\ProductVariantSpecification::leftJoin("attributes", "attributes.id", "=", "product_variant_specifications.attribute_id")->where('product_variant_specifications.estatus',1)->where('is_dropdown',0)->where('product_variant_id',$Product->product_variant[0]->id)->groupBy('attributes.id')->get();
                            foreach($product_attributes_specification as $product_attribute_specification){  
                                $product_attribute_terms = explode(',',$product_attribute_specification->attribute_term_id);
                                $product_attributes_term_val = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id', $product_attribute_terms)->get()->pluck('attrterm_name')->toArray();
                                $product_attribute_term_name = implode(' - ',$product_attributes_term_val);
                            ?>

                            <div class="col-md-6 px-0" >
                                <div class="mt-4 wire_bangle_share">
                                    {{ $product_attribute_specification->attribute_name }} &nbsp;:&nbsp;
                                    <span class="wire_bangle_color_theme">{{ $product_attribute_term_name }}</span>
                                </div>
                            </div>

                            <?php
                                }
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="gemver_diamonds_section" id="spe_desc">
        
        </div>
    </div>

<script>    
$(document).ready(function(){
    filter_data();
    $("#sorting").change(function() {
        filter_data();
    });
    
    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var variant = get_filter('variant');
        var product_id = $('#product_id').val();
        $.ajax({
            url:"{{ url('/product-details-filter') }}",
            method:"POST",
            data:{action:action,variant:variant,product_id:product_id,_token: '{{ csrf_token() }}'},
            success:function(data){
                //console.log(data);
                $('#variant_id').val(data.result.variant_id);
                $('.sale_price').html(data.result.sale_price);
                $('.regular_price').html(data.result.regular_price); 
                $('#SKU').val(data.result.SKU);
                $('#specification').html(data.speci);
                $('#speci_multi').html(data.speci_multi);
                $('#vimage').html(data.vimage);
                $('#spe_desc').html(data.spe_desc);
                selectjs();
                sliderjs();
            }
        });
    }
    
    function selectjs(){ 
    $('select').each(function() {
        var $this = $(this),
        numberOfOptions = $(this).children('option').length;
        $this.addClass('select-hidden');
        $this.wrap('<div class="select"></div>');
        $this.after('<div class="select-styled"></div>');

        var $styledSelect = $this.next('div.select-styled');
        $styledSelect.text($this.children('option').eq(0).text());

        var $list = $('<ul />', {
            'class': 'select-options'
        }).insertAfter($styledSelect);

        for (var i = 0; i < numberOfOptions; i++) {
            $('<li />', {
                text: $this.children('option').eq(i).text(),
                rel: $this.children('option').eq(i).val()
            }).appendTo($list);
            //if ($this.children('option').eq(i).is(':selected')){
            //  $('li[rel="' + $this.children('option').eq(i).val() + '"]').addClass('is-selected')
            //}
        }

        var $listItems = $list.children('li');

        $styledSelect.click(function(e) {
            e.stopPropagation();
            $('div.select-styled.active').not(this).each(function() {
                $(this).removeClass('active').next('ul.select-options').hide();
            });
            $(this).toggleClass('active').next('ul.select-options').toggle();
        });

        $listItems.click(function(e) {
            e.stopPropagation();
            $styledSelect.text($(this).text()).removeClass('active');
            $this.val($(this).attr('rel'));
            $list.hide();
            //console.log($this.val());
        });

        $(document).click(function() {
            $styledSelect.removeClass('active');
            $list.hide();
        });

      });
    }

    function sliderjs(){ 
        $('.slider-single').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            nav: false,
            fade: false,
            adaptiveHeight: true,
            infinite: false,
            useTransform: true,
            speed: 400,
            cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)',
        });
        $('.slider-nav')
        .on('init', function(event, slick) {
            $('.slider-nav .slick-slide.slick-current').addClass('is-active');
        })
        .slick({
            slidesToShow: 5,
            slidesToScroll: 5,
            dots: false,
            nav: false,
            focusOnSelect: false,
            infinite: false,
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5,
                }
            }, {
                breakpoint: 767,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5,
                }
            }, {
                breakpoint: 575,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                }
            }]
        });
        $('.slider-single').on('afterChange', function(event, slick, currentSlide) {
            $('.slider-nav').slick('slickGoTo', currentSlide);
            var currrentNavSlideElem = '.slider-nav .slick-slide[data-slick-index="' + currentSlide + '"]';
            $('.slider-nav .slick-slide.is-active').removeClass('is-active');
            $(currrentNavSlideElem).addClass('is-active');
        });

        $('.slider-nav').on('click', '.slick-slide', function(event) {
            event.preventDefault();
            var goToSingleSlide = $(this).data('slick-index');

            $('.slider-single').slick('slickGoTo', goToSingleSlide);
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }
    $('.variant').click(function(){
        filter_data();
    });

});
</script>


<script type="text/javascript">
$( document ).ready(function() {    
$('body').on('click', '#save_newProductBtn', function () {
    save_cart($(this),'save_new');
});

function save_cart(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();

    var dataarray = [];
    $(".specification").each(function () {
      dataarray.push($(this).val());
    });
    var specification = dataarray.join(",");
    var variant_id = $('#variant_id').val();
    var ip_address = '{{ \Request::ip(); }}';
    var category_id = '{{ $Category->id }}';
    $.ajax({
        type: 'POST',
        url: "{{ route('frontend.cart.save') }}",
        data: {specification:specification,variant_id:variant_id,ip_address:ip_address,category_id:category_id,_token: '{{ csrf_token() }}'},

        success: function (res) {
            if(res.status == 'failed'){
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();

                if (res.errors.name) {
                    $('#name-error').show().text(res.errors.name);
                } else {
                    $('#name-error').hide();
                }
                 
            }
            if(res.status == 200){
                
                var check_diamond = '{{ $check_diamond }}';
                if(check_diamond == 0){
                    $url = "{{ url('diamond-setting') }}" +'/' + category_id
                }else{
                    $url = "{{ url('product_complete') }}" +'/' + category_id
                }
                window.location = $url;
            }

        },
        error: function (data) {
            $(btn).prop('disabled',false);
            $(btn).find('.loadericonfa').hide();
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
}
});
</script>

@endsection
  