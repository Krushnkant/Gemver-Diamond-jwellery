@extends('frontend.layout.layout')

@section('content')
<div class="background-sub-slider">
    <div class="">
        <!-- <img src="{{ asset('frontend/image/about_us.png') }}" alt=""> -->
        <div class="about_us_background">
            <h1 class="sub_heading mb-lg-3 main_header_title">{{ isset($Category)?$Category->category_name:' Shop ' }}</h1>
            <div class="about_us_link">
                <a href="{{ URL('/') }}">home</a>
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none"
                    class="mx-2">
                    <path
                        d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z"
                        fill="white" />
                    <path
                        d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z"
                        fill="white" />
                </svg>
                <a href="#" class="main_header_title">{{ isset($Category)?$Category->category_name:' Shop ' }}</a>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="slug" value="{{ $id }}" />
@if(isset($Category) && $Category->category_description)
<div class="container shop_page round_cut_lab_diamonds_page">
    <div class="row my-3">
        <div class="col-md-12 px-0">
            <div class="row">
                <div class="text-left">{!! $Category->category_description !!}</div>
            </div>
        </div>
    </div>
</div>
@endif
<div class="container shop_page round_cut_lab_diamonds_page">
    <div class="row my-3">
        <div class="col-md-12 px-0">
            <div class="row">
                <div class="round_cut_lab_diamonds_heading col-lg-12 mb-2">category</div>
                <div class="wire_bangle_carat col-lg-12 owl-carousel owl-theme category-slider">
                    @foreach($Categories as $category)
                    <span class="item form-check d-inline-block position-relative me-1 ps-0">
                        <input class="form-check-input category common_selector"
                            data-title="{{ $category->category_name }}" type="checkbox" {{ ($CatId==$category->id) ?
                        "checked" : "" }} value="{{ $category->id}}" name="category[]" id="category{{ $category->id}}">
                        <label class="form-check-label wire_bangle_carat_label" for="category{{ $category->id}}">
                            {{ $category->category_name }}
                        </label>
                    </span>
                    @endforeach
                    {{-- @if($CatId > 0)
                    <input class="form-check-input category common_selector" type="checkbox" checked
                        value="{{ $CatId }}" name="category[]">
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
    <div class="row filter-data pt-3 d-md-flex mb-4">
        <div class="text-end close-icon d-lg-none">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <div class="col-lg-6 mb-3 mb-md-2">
            <div class="round_cut_lab_range_slider mt-md-0 row">
                <div class="round_cut_lab_diamonds_heading col-lg-12 mb-2">price</div>
                <div class="round_cut_lab_diamonds_price col-lg-12">
                    <div class="align-items-center mb-2 position-relative">
                        <div id="slider-range" class="mb-0"></div>
                        <div class="d-flex mt-3">
                            <span class="from_text"><input type="numner" name="" id="minimum_price" placeholder="From"
                                    class="d-block wire_bangle_input amount_input" value="0"></span>
                            <span class="to_text"><input type="numner" name="" id="maximum_price" placeholder="To"
                                    class="d-block wire_bangle_input amount_input" value="{{ $Maxprice  }}"></span>
                        </div>
                    </div>
                    <!-- <p class="mb-0"> <span id="amount"></span></p> -->
                    <p class="mb-0 range-slider-p"><span id="amount-start"></span><span id="amount-end"></span></p>
                    <input type="hidden" id="hidden_minimum_price" />
                    <input type="hidden" id="hidden_maximum_price" />
                </div>
            </div>
        </div>

        @foreach($Attributes as $attribute)
        @if($attribute->attribute_name == "Karat")
        <div class="col-lg-6 mb-3 mb-md-2">
            <div class="round_cut_lab_range_slider">
                <ul class="right_side_ul round_cut_lab_range_slider row">
                    <li class="round_cut_lab_diamonds_heading col-lg-12 mb-2 carat-input-part">{{
                        $attribute->display_attrname }}</li>
                    <div class="col-lg-12">

                        <div class="d-flex align-items-center carat-input-part">
                            <div class="from_text me-4">
                                <div class="d-flex align-items-center">
                                    <input type="text" name="" id="minimum_carat_input" placeholder="From"
                                        class="wire_bangle_input common_input comman_input_part w-100" value="0">
                                    <span class="ms-2 filter_ct">ct</span>
                                </div>
                            </div>
                            <div class="me-4 text-center"> to</div>
                            <div class="to_text d-flex align-items-center" style="position: initial !important;">
                                <input type="text" name="" id="maximum_carat_input" placeholder="To"
                                    class="wire_bangle_input common_input comman_input_part w-100" value="7">
                                <span class="ms-2 filter_ct">ct</span>
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
        @elseif($attribute->id == 15)
        {{-- <div class="col-lg-6 mb-3 mb-md-2">
            <div class="round_cut_lab_range_slider">
                <ul class="right_side_ul round_cut_lab_range_slider row">
                    <li class="round_cut_lab_diamonds_heading col-lg-12 mb-2 carat-input-part">{{
                        $attribute->display_attrname }}</li>
                    <div class="col-lg-12">

                        <div class="d-flex align-items-center carat-input-part">
                            <div class="from_text me-4">
                                <div class="d-flex align-items-center">
                                    <input type="text" name="" id="minimum_carat_input" placeholder="From"
                                        class="wire_bangle_input common_input comman_input_part w-100" value="0">
                                    <span class="ms-2 filter_ct">ct</span>
                                </div>
                            </div>
                            <div class="me-4 text-center"> to</div>
                            <div class="to_text d-flex align-items-center" style="position: initial !important;">
                                <input type="text" name="" id="maximum_carat_input" placeholder="To"
                                    class="wire_bangle_input common_input comman_input_part w-100" value="7">
                                <span class="ms-2 filter_ct">ct</span>
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
        </div> --}}
        <div class="col-lg-6 mb-3 mb-md-2">
            <div class="round_cut_lab_range_slider  row">
                <div class="round_cut_lab_diamonds_heading col-lg-12 mb-2">{{ $attribute->display_attrname }}</div>
                <div class="round_cut_lab_diamonds_price col-lg-12">
                    <div class="align-items-center mb-2 position-relative">
                        <div id="slider-range-carat" class="mb-0"></div>
                        <div class="d-flex mt-3">
                            <span class="from_text"><input type="numner" name="" id="minimum_carat" placeholder="From"
                                    class="d-block wire_bangle_input amount_input" value="0"></span>
                            <span class="to_text"><input type="numner" name="" id="maximum_carat" placeholder="To"
                                    class="d-block wire_bangle_input amount_input" value="20"></span>
                        </div>
                    </div>
                    <!-- <p class="mb-0"> <span id="amount"></span></p> -->
                    <p class="mb-0 range-slider-p"><span id="carat-start"></span><span id="carat-end"></span></p>
                    <input type="hidden" id="hidden_minimum_carat" />
                    <input type="hidden" id="hidden_maximum_carat" />
                </div>
            </div>
        </div>
        @elseif($attribute->id == 18)

        <div class="col-lg-6 mb-3 mb-md-2 round_cut_lab_filter">
            <div class="round_cut_lab_checkbox row mb-2">
                <span class="round_cut_lab_diamonds_heading col-md-12 mb-2">{{ $attribute->display_attrname }}</span>
                <div class="col-md-12 shape-part-img">
                    @foreach($attribute->attributeterm as $term)
                    <span class="form-check position-relative ps-0 round_checkbox_part attr-shape-check-span"
                        data-toggle="tooltip" data-placement="top" title="{{ $term->attrterm_name }}">
                        <input class="form-check-input attribute common_selector attr-shape-check"
                            value="{{ $term->id }}" type="checkbox" name="shape[]"
                            id="flexRadioDefault{{ $term->attrterm_name }}">
                        <img src="{{ url('images/attrTermThumb/'.$term->attrterm_thumb) }}"
                            alert="{{ $term->attrterm_name }}" class="attr-img" width="45" height="45">
                    </span>

                    @endforeach
                </div>
            </div>
        </div>
        @else

        @if($attribute->id == 19)
        @if(isset($Category) && $Category->mainparentid == 4)
        <div class="col-lg-6 mb-3 mb-md-2">
            <div class="round_cut_lab_range_slider">
                <ul class="right_side_ul round_cut_lab_range_slider row">
                    <li class="round_cut_lab_diamonds_heading col-lg-12 mb-2">{{ $attribute->display_attrname }}</li>
                    <div class="col-lg-12">
                        <select name="attribute[]" class="selectattribute common_selector attribute" multiple>
                            @foreach($attribute->attributeterm as $term)
                            {{-- <div class="form-group mb-3 d-inline-block me-3">
                                <input type="checkbox" class="common_selector attribute" name="attribute[]"
                                    value="{{ $term->id }}" id="{{ $term->id }}">
                                <label for="{{ $term->id }}">{{ $term->attrterm_name }}</label>
                            </div> --}}
                            <option value="{{ $term->id }}">{{ $term->attrterm_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </ul>
            </div>
        </div>
        @endif

        @elseif($attribute->id == 20)
        @if(isset($Category) && $Category->mainparentid == 24)
        <div class="col-lg-6 mb-3 mb-md-2">
            <div class="round_cut_lab_range_slider">
                <ul class="right_side_ul round_cut_lab_range_slider row">
                    <li class="round_cut_lab_diamonds_heading col-lg-12 mb-2">{{ $attribute->display_attrname }}</li>
                    <div class="col-lg-12">
                        <select name="attribute[]" class="selectattribute common_selector attribute" multiple>
                            @foreach($attribute->attributeterm as $term)
                            {{-- <div class="form-group mb-3 d-inline-block me-3">
                                <input type="checkbox" class="common_selector attribute" name="attribute[]"
                                    value="{{ $term->id }}" id="{{ $term->id }}">
                                <label for="{{ $term->id }}">{{ $term->attrterm_name }}</label>
                            </div> --}}
                            <option value="{{ $term->id }}">{{ $term->attrterm_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </ul>
            </div>
        </div>
        @endif
        @elseif($attribute->id == 21 || $attribute->id == 9)
        @if(isset($Category) && $Category->mainparentid == 46)
        <div class="col-lg-6 mb-3 mb-md-2">
            <div class="round_cut_lab_range_slider">
                <ul class="right_side_ul round_cut_lab_range_slider row">
                    <li class="round_cut_lab_diamonds_heading col-lg-12 mb-2">{{ $attribute->display_attrname }}</li>
                    <div class="col-lg-12">
                        <select name="attribute[]" class="selectattribute common_selector attribute" multiple>
                            @foreach($attribute->attributeterm as $term)
                            {{-- <div class="form-group mb-3 d-inline-block me-3">
                                <input type="checkbox" class="common_selector attribute" name="attribute[]"
                                    value="{{ $term->id }}" id="{{ $term->id }}">
                                <label for="{{ $term->id }}">{{ $term->attrterm_name }}</label>
                            </div> --}}
                            <option value="{{ $term->id }}">{{ $term->attrterm_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </ul>
            </div>
        </div>
        @endif
        @elseif($attribute->id == 22)
        @if(isset($Category) && $Category->mainparentid == 50)
        <div class="col-lg-6 mb-3 mb-md-2">
            <div class="round_cut_lab_range_slider">
                <ul class="right_side_ul round_cut_lab_range_slider row">
                    <li class="round_cut_lab_diamonds_heading col-lg-12 mb-2">{{ $attribute->display_attrname }}</li>
                    <div class="col-lg-12">
                        <select name="attribute[]" class="selectattribute common_selector attribute" multiple>
                            @foreach($attribute->attributeterm as $term)
                            {{-- <div class="form-group mb-3 d-inline-block me-3">
                                <input type="checkbox" class="common_selector attribute" name="attribute[]"
                                    value="{{ $term->id }}" id="{{ $term->id }}">
                                <label for="{{ $term->id }}">{{ $term->attrterm_name }}</label>
                            </div> --}}
                            <option value="{{ $term->id }}">{{ $term->attrterm_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </ul>
            </div>
        </div>
        @endif
        @elseif($attribute->id == 23)
        @if(isset($Category) && $Category->mainparentid == 55)
        <div class="col-lg-6 mb-3 mb-md-2">
            <div class="round_cut_lab_range_slider">
                <ul class="right_side_ul round_cut_lab_range_slider row">
                    <li class="round_cut_lab_diamonds_heading col-lg-12 mb-2">{{ $attribute->display_attrname }}</li>
                    <div class="col-lg-12">
                        <select name="attribute[]" class="selectattribute common_selector attribute" multiple>
                            @foreach($attribute->attributeterm as $term)
                            {{-- <div class="form-group mb-3 d-inline-block me-3">
                                <input type="checkbox" class="common_selector attribute" name="attribute[]"
                                    value="{{ $term->id }}" id="{{ $term->id }}">
                                <label for="{{ $term->id }}">{{ $term->attrterm_name }}</label>
                            </div> --}}
                            <option value="{{ $term->id }}">{{ $term->attrterm_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </ul>
            </div>
        </div>
        @endif
        @else
        <div class="col-lg-6 mb-3 mb-md-2">
            <div class="round_cut_lab_range_slider ">
                <ul class="right_side_ul round_cut_lab_range_slider row">
                    <li class="round_cut_lab_diamonds_heading col-lg-12 mb-2">{{ $attribute->display_attrname }}</li>
                    <div class="col-lg-12">
                        <select name="attribute[]" class="selectattribute common_selector attribute" multiple>
                            @foreach($attribute->attributeterm as $term)
                            {{-- <div class="form-group mb-3 d-inline-block me-3">
                                <input type="checkbox" class="common_selector attribute" name="attribute[]"
                                    value="{{ $term->id }}" id="{{ $term->id }}">
                                <label for="{{ $term->id }}">{{ $term->attrterm_name }}</label>
                            </div> --}}
                            <option value="{{ $term->id }}">{{ $term->attrterm_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </ul>
            </div>
        </div>
        @endif
        @endif
        @endforeach
        {{-- <div class="text-end mb-3">
            <div class="col-md-12 ">
                <button type="button" id="reSet" style="border: 1px var(--primary) solid"
                    class="reset-btn btn-hover-effect btn-hover-effect-black diamond-btn buy_lab_diamonds_btn mt-4">Reset</button>
            </div>

        </div> --}}
        <div class="row align-items-center">
            <div class="col-md-12 text-center text-md-end px-0 mt-4">
                <div class="reset-btn-position d-inline-block d-flex d-lg-inline-block justify-content-between">
                    <span class="d-inline-block d-lg-none  apply-btn me-3">
                        <button type="button" class="apply-btn">Apply</button>
                    </span>
                    <span class="d-inline-block reset-btn reset-btn-part">
                        <button type="button" id="reSet"
                            class="reset-btn btn-hover-effect btn-hover-effect-black diamond-btn buy_lab_diamonds_btn border-0">Reset</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="wire_bangle_line"></div>
    <div class="row align-items-center mt-4 justify-content-end">
        <div class="col-lg-6  text-sm-start">
            <div class="row no-gutters mb-3 align-items-center justify-content-start">
                <div class="col-12 col-md-auto px-0">
                    Result (<span class="total-product"> </span>)
                </div>
            </div>
        </div>
        <div class="col-3 col-md-6 d-lg-none">
            <button type="button" class="btn btn-primary filter-btn mobile-view-filter-btn d-flex align-items-center">
                <i class="fa-solid fa-filter"></i>
                <span class="ms-2 d-sm-inline-block">Search</span>
            </button>
        </div>
        <div class="col-9 col-md-6 text-center text-sm-end mb-sm-0 d-flex justify-content-end justify-content-sm-end">
            <span class="wire_bangle_select text-start wire_bangle_shop wire_bangle_select_box_sort select_box_option ">
                <select class="form-control" name="sorting" id="sorting" class="">
                    <option value="">default sorting</option>
                    <option value="date">Sort by newness</option>
                    <option value="price">Sort by price: low to high</option>
                    <option value="price-desc">Sort by price: high to low</option>
                </select>
            </span>
        </div>
    </div>

    <div class="row mt-0 mb-5 filter_data">
    </div>
    <div class="auto-load text-center mt-4 mb-5">
        <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
            y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
            <path fill="#000"
                d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50"
                    to="360 50 50" repeatCount="indefinite" />
            </path>
        </svg>
    </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>

    $(document).ready(function () {


        $('.selectattribute').on('change', function () {
            page = 1;
            filter_data(page);
        });
        // $(".selectattribute").click(function() {
        //     alert();
        //     //You need a id for set values
        //     $.each($(".Books_Illustrations"), function(){
        //             $(this).select2('val', selectedValues);
        //     });
        // });

        $('.selectattribute').select2({
            width: '100%',
            multiple: true,
            placeholder: "Select...",
            allowClear: true,
            autoclose: false,
            closeOnSelect: false,
        });

        var page = 1;

        $(window).scroll(function () {
            //if($(window).scrollTop() + $(window).height() >= $(document).height() - 500) {

            //if($(window).scrollTop() + $(window).height() >= $(document).height()) {  
            if ($(window).scrollTop() + $(window).height() > $(document).height() - 400) {
                page++;
                var scroll = 1;
                filter_data(page, scroll);
            }
        });


        filter_data(page);

        //$('product-image').hover(function () {
        $('body').on('mouseover', '.product-image', function () {
        }, function () {
            var product_image = $(this).attr('src');
            var data_id = $(this).attr('data-id');
            $('.main-product-image-' + data_id).attr("src", product_image);

        });

        $("#sorting").change(function () {
            page = 1;
            filter_data(page);
        });

        function filter_data(page, scroll = 0) {
            // var cart = $('.selectattribute'); //

            // var val = [];
            // $('.selectattribute').each(function(i){
            // val[i] = $(this).val();
            // });
            // console.log(val);


            //var selectedValues = [];
            // $('.selectattribute').each(function(i){
            //     selectedValues[i] = $(this).val();
            // });
            // console.log(selectedValues);



            // $('.selectattribute').on('click', function(){
            //  alert('dsfdfdsf');   
            //     console.log($(this));
            //     selectedValues.push( $(this).val() );
            //     console.log(selectedValues); // < read the length of the amended array here
            // });

            // $.each(cart, function(index, value){
            //     console.log($(value).val());
            // });


            // var selectedValues = $('.selectattribute').select2('data').map(function(elem){ 
            //     return elem.id 
            // });

            var selectedValues = [];
            var array = [];
            $('.selectattribute').each(function () {
                if ($(this).val() != "") {
                    var array = $(this).val();
                    $.each(array, function (key, value) {
                        selectedValues.push(value);
                    });
                }
            });

            // $('.filter_data').html('<div id="loading" style="" ></div>');
            var keyword = "{{ isset($_GET['s'])?$_GET['s']:"" }}";
            var action = 'fetch_data';
            var slug = $('#slug').val();
            var minimum_price = $('#hidden_minimum_price').val();
            var maximum_price = $('#hidden_maximum_price').val();
            var minimum_price_input = $('#minimum_price').val();
            var maximum_price_input = $('#maximum_price').val();
            var category = get_filter('category');
            var attribute = get_filter('attribute');
            var selectattribute = selectedValues;
            var specification = get_filter('specification');
            var sorting = $('#sorting :selected').val();
            $.ajax({
                url: "{{ url('/product-filter') }}?page=" + page,
                method: "POST",
                data: { action: action, keyword: keyword, minimum_price_input: minimum_price_input, maximum_price_input: maximum_price_input, minimum_price: minimum_price, maximum_price: maximum_price, category: category, sorting: sorting, attribute: attribute, specification: specification, selectattribute: selectattribute, slug: slug, _token: '{{ csrf_token() }}' },
                beforeSend: function () {
                    $('.auto-load').show();
                },
                success: function (data) {

                    if (scroll == 1) {
                        if (data['output'] == "") {
                            $('.auto-load').html("We don't have more data to display ");
                            return;
                        }
                        $('.filter_data').append(data['output']);
                        $(".total-product").html(data['datacount']);
                        $('.auto-load').hide();

                    } else {
                        if (data['output'] == "") {
                            $('.filter_data').html(data['output']);
                            $(".total-product").html(data['datacount']);
                            $('.auto-load').html("We don't have more data to display ");
                            return;
                        } else {
                            $('.filter_data').html(data['output']);
                            $(".total-product").html(data['datacount']);
                            $('.auto-load').hide();
                        }

                    }

                    $('#datacount').html('showing ' + data['datacount'] + ' results');
                }
            });
        }

        function get_filter(class_name) {
            var filter = [];
            $('.' + class_name + ':checked').each(function () {
                filter.push($(this).val());
            });
            return filter;
        }



        $('.common_selector').click(function () {
            page = 1;
            filter_data(page);
        });

        $(".amount_input").keyup(function () {
            page = 1;
            filter_data(page);
        });

        ['minimum_price', 'maximum_price'].map(x => document.getElementById(x)).forEach(x => x.addEventListener('change', function (e) {
            let [minimum_price, maximum_price] = $("#slider-range").slider('values');
            if (e.target.id === 'minimum_price') {
                minimum_price = parseInt(e.target.value, 10);
            } else if (e.target.id === 'maximum_price') {
                maximum_price = parseInt(e.target.value, 10);
            }

            $("#slider-range").slider({
                values: [minimum_price, maximum_price],
            });

            $("#amount-start").html("$" + minimum_price);
            $("#amount-end").html(" $" + maximum_price);

        }));


        $(function () {

            var maxPrice = '{{ $Maxprice  }}';

            $("#slider-range").slider({
                range: true,
                min: 0,
                max: maxPrice,
                values: [0, maxPrice],
                slide: function (_, { values: [min, max] }) {
                    page = 1;
                    $("#amount-start").html("$" + min);
                    $("#amount-end").html(" $" + max);
                    $("#hidden_minimum_price").val(min);
                    $("#minimum_price").val(min);
                    $("#hidden_maximum_price").val(max);
                    $("#maximum_price").val(max);
                    //filter_data(page);
                },
                stop: function (event, ui) {
                    filter_data(page);
                }

            });
            //$( "#amount" ).html( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );
            $("#amount-start").html(" $" + $("#slider-range").slider("values", 0));
            $("#amount-end").html(" $" + $("#slider-range").slider("values", 1));

        });

        ['minimum_carat', 'maximum_carat'].map(x => document.getElementById(x)).forEach(x => x.addEventListener('change', function (e) {
            let [minimum_carat, maximum_carat] = $("#slider-range-carat").slider('values');
            if (e.target.id === 'minimum_carat') {
                minimum_carat = parseInt(e.target.value, 10);
            } else if (e.target.id === 'maximum_carat') {
                maximum_carat = parseInt(e.target.value, 10);
            }

            $("#slider-range-carat").slider({
                values: [minimum_price, maximum_carat],
            });

            $("#carat-start").html("$" + minimum_carat);
            $("#carat-end").html(" $" + maximum_carat);

        }));


        $(function () {

            var maxCarat = 20;

            $("#slider-range-carat").slider({
                range: true,
                min: 0,
                //step: 0.1,
                max: maxCarat,
                values: [0, maxCarat],
                slide: function (_, { values: [min, max] }) {
                    page = 1;
                    $("#carat-start").html("$" + min);
                    $("#carat-end").html(" $" + max);
                    $("#hidden_minimum_carat").val(min);
                    $("#minimum_carat").val(min);
                    $("#hidden_maximum_carat").val(max);
                    $("#maximum_carat").val(max);
                    //filter_data(page);
                },
                stop: function (event, ui) {
                    filter_data(page);
                }

            });
            //$( "#amount" ).html( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );
            $("#carat-start").html(" $" + $("#slider-range-carat").slider("values", 0));
            $("#carat-end").html(" $" + $("#slider-range-carat").slider("values", 1));

        });

        // $('.category').on('click', function() {
        //     var array = "";
        //     var num = 1; 
        //     $(".category:checked").each(function() {
        //         //array.push($(this).attr('data-title'));
        //         if(num == 1){
        //           array = array  +$(this).attr('data-title');
        //         }else{
        //           array = array + " | " +$(this).attr('data-title') ;
        //         }
        //         num++;
        //     });
        //     if(array == ""){
        //         $('.main_header_title').text('shop');
        //     }else{
        //         $('.main_header_title').text(array);
        //     }

        // });

    });




</script>




@endsection