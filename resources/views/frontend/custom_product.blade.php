@extends('frontend.layout.layout')

@section('content')
<div class="background-sub-slider">
    <div class="">
        <!-- <img src="{{ asset('frontend/image/about_us.png') }}" alt=""> -->
        <div class="about_us_background">
            <h1 class="sub_heading mb-lg-3">{{ $Category->category_name }} setting</h1>
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
                <a href="#">{{ $Category->category_name }} setting</a>
            </div>
        </div>
    </div>

</div>
</div>

<div class="container round_cut_lab_diamonds_page">
    <!-- <div class="round_cut_lab_diamonds_paragraph mt-xxl-5 text-center mt-3 mb-3 mb-md-0">
            Browse through our inventory of certified lab created diamonds, available in various shapes, carat weights, colors and clarities. For a more interactive experience, all our lab diamonds are available to view in 360° HD at 40x superzoom.
        </div> -->

    <!-- <div class="row align-items-center step-progressbar-row">
            <div class="col-lg-2 text-center text-lg-start">
                <div class="step-progressbar-side-heading mb-3 mb-lg-0">Create Your {{ $Category->category_name }}</div>
            </div>
            <div class="col-lg-10">
                <div class="flex-container step-progressbar">
                    <div class="flex-row text-center">
                        <div class="flex-col-xs-12">
                        @if($check_diamond == 1)
                            <ul class="tab-steps--list">
                                
                                <li class="active" data-step="1">
                                    <div class="step-img">
                                        <img src="{{ url('frontend/image/diamon_img.jpeg') }}" alt="">
                                    </div>
                                    <div class="step-heading mt-2">
                                        choose diamond
                                    </div>
                                    <span><a href="{{ url('diamond-setting-edit/'. $CatId .'/edit') }}" class="step-heading-link mt-2 d-inline-block">edit</a></span>
                                </li>
                                <li class="active" data-step="2">
                                    <div class="step-img">
                                        <img src="{{ url($Category->category_thumb) }}" alt="">
                                    </div>
                                    <div class="step-heading mt-2">
                                        choose setting
                                    </div>
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
                                        <img src="{{ url('frontend/image/diamon_img.jpeg') }}" alt="">
                                    </div>
                                    <div class="step-heading mt-2">
                                        choose diamond
                                    </div>
                                    <a href="{{ url('/diamond-setting/'. $CatId) }}" class="step-heading-link mt-2 d-block">browse lab diamonds</a>
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
        </div> -->
    <div class="mt-5 px-3">
        @if($check_diamond == 1)
        <ul class="d-block d-lg-flex progressbar_ul">
            <li class="step-progressbar-part">
                <div class="step-progressbar-step-part ">
                    <span class="step-progressbar-img ms-3">
                        {{-- <img src="{{ url('frontend/image/step_1.png') }}" alt=""> --}}
                        <img src="{{ url('images/steppopup/'.$StepPopup[1]->icon) }}" alt="">
                    </span>
                    <div>
                        <span class="step-progressbar-text">
                            choose diamonds
                        </span>
                        <div class="d-flex edit_price_text mt-1">
                            <span class="me-2">
                                <a href="{{ url('diamond-setting-edit/'. $Category->slug .'/edit') }}"
                                    class="edit_text">Edit</a>
                            </span>
                            <span>
                                |
                            </span>
                            <div class="d-flex ms-2">
                                <span class="price_text me-2">
                                    price:
                                </span>
                                <span class="price_part">
                                    ${{ $DiamondPrice }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            </li>
            <li class="step-progressbar-part active">
                <div class="step-progressbar-step-part">
                    <span class="step-progressbar-img ms-3">
                        {{-- <img src="{{ url('frontend/image/step_2.png') }}" alt=""> --}}
                        <img src="{{ url('images/steppopup/'.$StepPopup[0]->icon) }}" alt="">
                    </span>
                    <div>
                        <span class="step-progressbar-text">
                            choose settings
                        </span>

                    </div>
                </div>

            </li>
            <li class="step-progressbar-part">
                <div class="step-progressbar-step-part">
                    <span class="step-progressbar-img ms-3">
                        {{-- <img src="{{ url('frontend/image/step_3.png') }}" alt=""> --}}
                        <img src="{{ url('images/steppopup/'.$StepPopup[2]->icon) }}" alt="">
                    </span>
                    <div>
                        <span class="step-progressbar-text">
                            complete the {{ $Category->category_name }}
                        </span>

                    </div>
                </div>

            </li>
        </ul>
        @else
        <ul class="d-block d-lg-flex progressbar_ul">
            <li class="step-progressbar-part active">
                <div class="step-progressbar-step-part">
                    <span class="step-progressbar-img ms-3">
                        {{-- <img src="{{ url('frontend/image/step_2.png') }}" alt=""> --}}
                        <img src="{{ url('images/steppopup/'.$StepPopup[0]->icon) }}" alt="">
                    </span>
                    <div>
                        <span class="step-progressbar-text">
                            choose settings
                        </span>

                    </div>
                </div>
            </li>
            <li class="step-progressbar-part ">
                <div class="step-progressbar-step-part">

                    <span class="step-progressbar-img ms-3">
                        {{-- <img src="{{ url('frontend/image/step_1.png') }}" alt=""> --}}
                        <img src="{{ url('images/steppopup/'.$StepPopup[1]->icon) }}" alt="">
                    </span>
                    <div>
                        <span class="step-progressbar-text">
                            choose diamonds
                        </span>
                        <div class="d-flex edit_price_text mt-1">
                            <span class="me-2">
                                <a href="{{ url('diamond-setting/'. $Category->slug) }}" class="edit_text">Browse Lab
                                    Diamonds</a>
                            </span>
                        </div>

                    </div>
                </div>
            </li>
            <li class="step-progressbar-part">
                <div class="step-progressbar-step-part">
                    <span class="step-progressbar-img ms-3">
                        {{-- <img src="{{ url('frontend/image/step_3.png') }}" alt=""> --}}
                        <img src="{{ url('images/steppopup/'.$StepPopup[2]->icon) }}" alt="">
                    </span>
                    <div>
                        <span class="step-progressbar-text">
                            complete the {{ $Category->category_name }}
                        </span>

                    </div>
                </div>
            </li>
        </ul>
        @endif
    </div>
    <div class="row filter-data pt-3 d-md-flex mb-4">
        <div class="text-end close-icon d-lg-none">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <div class="col-lg-6">
            <div class="row round_cut_lab_range_slider">
                <div class="round_cut_lab_diamonds_heading mb-2 col-md-12">price</div>
                <div class="round_cut_lab_diamonds_price mb-2 col-md-12">
                    <div class="align-items-center mb-2 position-relative">
                        <div id="slider-range" class="mb-0"></div>
                        <div class="d-flex mt-3">
                            <span class="from_text"><input type="text" name="" id="minimum_price" placeholder="From"
                                    class="d-block wire_bangle_input amount_input" value="0"></span>
                            <span class="to_text"><input type="text" name="" id="maximum_price" placeholder="To"
                                    class="d-block wire_bangle_input amount_input" value="{{ $Maxprice  }}"></span>
                        </div>
                    </div>
                    <p class="mb-0 range-slider-p"><span id="amount-start"></span><span id="amount-end"></span></p>
                    <input type="hidden" id="hidden_minimum_price" />
                    <input type="hidden" id="hidden_maximum_price" />
                </div>
            </div>
        </div>
        @foreach($Attributes as $attribute)

        @if($attribute->id == 19)
        @if($Category->mainparentid == 2)
        <div class="col-md-6 mt-2">
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
        @if($Category->mainparentid == 24)
        <div class="col-md-6 mt-2">
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
        @if($Category->mainparentid == 44)
        <div class="col-md-6 mt-2">
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
        @if($Category->mainparentid == 45)
        <div class="col-md-6 mt-2">
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

        @elseif($attribute->id == 13)
        <div class="col-md-6 mt-2">
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

        @endforeach

        {{-- <div class="row text-end mb-3">
            <div class="col-md-12">
                <button type="button" id="reSet"
                    class="reset-btn btn-hover-effect btn-hover-effect-black diamond-btn buy_lab_diamonds_btn mt-4">Reset</button>
            </div>
        </div> --}}
        <div class="row align-items-center">
            <div class="col-md-12 text-center text-md-end px-0 mt-4">
                <!-- <div class="reset-btn-position d-inline-block d-flex d-lg-inline-block justify-content-between">
                    <span class="d-inline-block d-lg-none  apply-btn me-3">
                        <button type="button" class="apply-btn">Apply</button>
                    </span>
                    <span class="d-inline-block reset-btn reset-btn-part">
                        <button type="button" id="reSet"
                            class="reset-btn btn-hover-effect btn-hover-effect-black diamond-btn buy_lab_diamonds_btn border-0">Reset</button>
                    </span>
                </div> -->
                <div class="reset-btn-position d-inline-block d-flex d-lg-inline-block justify-content-between">
                    <button type="button" id="apply-btn" class="diamond-btn btn-hover-effect btn-hover-effect-black apply-btn-cust apply-btn-border">Apply</button>
                    <button type="button" id="reSet" class="btn-hover-effect btn-hover-effect-black diamond-btn apply-btn-border">Reset</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="wire_bangle_line"></div>
    <div class="row my-3 align-items-center">
        <div class="col-lg-6 text-center text-sm-start">
            <div class="row no-gutters mb-3 mb-lg-0 align-items-center justify-content-start">
                <div class="col-12 col-md-auto px-0">
                    <ul class="nav wire_bangle_tabs_part" id="myTab" role="tablist">
                        <li class="active nav-item">
                            Result (<span class="total-product"> </span>)
                        </li>
                    </ul>
                    
                </div>
            </div>
        </div>
        <div class="col-3 col-md-6 d-lg-none ps-0">
            <button type="button" class="btn btn-primary filter-btn mobile-view-filter-btn d-flex align-items-center">
                <i class="fa-solid fa-filter"></i>
                <span class="ms-2 d-sm-inline-block">Search</span>
            </button>
        </div>
        <div class="col-9 col-md-6 text-center text-sm-end mb-sm-0 d-flex justify-content-end justify-content-sm-end pe-0">
            <span class="wire_bangle_select text-center text-md-end select_box_option">
                <select class="form-control" name="sorting" id="sorting">
                    <option value="price">Sort by price: low to high</option>
                    <option value="price-desc">Sort by price: high to low</option>
                </select>
            </span>
        </div>
    </div>
    <div class="row gx-md-4 gy-md-4 gx-3 gy-3" id="data-wrapper">
        <!-- Results -->
    </div>
    <!-- Data Loader -->
    <div class="auto-load text-center mt-4 mb-5">
        <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="60" viewBox="0 0 100 100"
            enable-background="new 0 0 0 0" xml:space="preserve">
            <path fill="#000"
                d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                    from="0 50 50" to="360 50 50" repeatCount="indefinite" />
            </path>
        </svg>
    </div>
    <div class="reponse-msg-box text-center mt-4 mb-5" style="display: none;"></div>
</div>

@php
$hidemodel = 0;
@endphp
@foreach($StepPopup as $Step)
@if($Step->title == null)
@php
$hidemodel = 1;
@endphp
@endif
@endforeach

@if(count($StepPopup) > 0)
@if($hidemodel == 0)
<div class="modal fade inquiry_now_modal product_modal" id="myStep" tabindex="-1" aria-labelledby="myStepLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable text-center">
        <div class="modal-content">
            <button type="button" class="btn-close close-button" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="row">
                <h2 class="heading-h2 text-white popup_heading text-center text-capitalize mb-3">Create Your Own
                    Engagement Ring</h2>
                <!-- <div class="col-12 ps-0 text-start"> -->
                <ul class="row p-0">
                    @foreach($StepPopup as $key => $Step)
                    @php
                    $key += 1;
                    @endphp
                    <li class="col-12 col-md-4">
                        <div class="row cnt-block equal-hight popup_part mb-3 mb-md-0">
                            <div class="col-md-12 col-3 thumbbox">
                                <figure class="popup_img"><img src="{{ url('images/steppopup/'.$Step->icon) }}"
                                        class="img-responsive" alt=""></figure>
                            </div>
                            <div class="col-md-12 col-9 descbox">
                                <div class="step-title">Step {{ $key }}</div>
                                <h5 class="popup_sub_heading">{{ $Step->title }}</h5>
                                <p class="popup_paragraph">{{ $Step->description }} </p>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>
@endif
@endif
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script>
    $(document).ready(function () {

        $('.selectattribute').select2({
            width: '100%',
            multiple: true,
            placeholder: "Select...",
            allowClear: true,
            autoclose: false,
            closeOnSelect: false,
        });

        // $('.selectattribute').on('change', function () {
        //     page = 1;
        //     filter_data(page);
        // });

        $('body').on('mouseover', '.product-image', function () {}, function () {
            var product_image = $(this).attr('src');
            var data_id = $(this).attr('data-id');
            $('.main-product-image-' + data_id).attr("src", product_image);

        });

        var ENDPOINT = "{{ url('/') }}";
        var page = 1;
        var isDataLoading = false;
        footerElement = document.querySelector(".footer-part-section");
        footerHeight = footerElement.offsetHeight;
        var diffofHeight = 0;
        $(window).scroll(function () {
            diffofHeight = $(document).height() - $(window).height();
            if ($(window).scrollTop() <= diffofHeight - footerHeight + 100 && $(window).scrollTop() >= diffofHeight - footerHeight) {  
                if(isDataLoading === false){
                    page++;
                    var scroll = 1;
                    filter_data(page, scroll, false);
                }
            }
        });
        filter_data(page, 0, false);
        $("#sorting").change(function () {
            page = 1;
            filter_data(page, 0, true);
        });

        $("#apply-btn").click(function () {
            page = 1;
            $(this).prop('disabled', true);
            filter_data(page, 0, true);
        });

        $('body').on('click', '#reSet', function () {
            location.reload();
        });

        function filter_data(page, scroll = 0, isfilterApply) {
            $('.filter_data').html('<div id="loading" style="" ></div>');

            var selectedValues = [];
            var array = [];
            isDataLoading = true;
            if(isfilterApply == true){
                $("#data-wrapper").html('');
            }

            $('.selectattribute').each(function () {
                if ($(this).val() != "") {
                    var array = $(this).val();
                    $.each(array, function (key, value) {
                        selectedValues.push(value);
                    });
                }
            });
            // var selectedValues = $('.selectattribute').select2('data').map(function(elem){ 
            //     return elem.id 
            // });
            // console.log(selectedValues);
            var action = 'fetch_data';
            var catid = '{{ $CatId }}';
            var minimum_price = $('#hidden_minimum_price').val();
            var maximum_price = $('#hidden_maximum_price').val();
            var minimum_price_input = $('#minimum_price').val();
            var maximum_price_input = $('#maximum_price').val();
            var attribute = get_filter('attribute');
            var selectattribute = selectedValues;
            var specification = get_filter('specification');
            var sorting = $('#sorting :selected').val();
            $.ajax({
                // url:"{{ url('/product-filter') }}",
                url: ENDPOINT + "/custom_products?page=" + page,
                method: "POST",
                data: { action: action, minimum_price_input: minimum_price_input, maximum_price_input: maximum_price_input, catid: catid, minimum_price: minimum_price, maximum_price: maximum_price, attribute: attribute, sorting: sorting, specification: specification, selectattribute: selectattribute, _token: '{{ csrf_token() }}' },
                beforeSend: function () {
                    $('.auto-load').show();
                },
                success: function (response) {
                    $('#datacount').html('showing ' + response['showdata'] + ' of ' + response['totaldata'] + ' results');

                    if (scroll == 1) {
                        if (response['artilces'] == "") {
                            datawrpper_message(true, "We don't have more data to display");
                            return;
                        }
                        datawrpper_message(false, "");
                        $("#data-wrapper").append(response['artilces']);
                        $(".total-product").html(response['datacount']);
                        isDataLoading = false;

                    } else {
                        if (response['artilces'] == "") {
                            $('#data-wrapper').html("No Result Found");
                            $(".total-product").html(response['datacount']);
                            datawrpper_message(true, "No Result Found");
                            return;
                        }
                        $("#data-wrapper").html(response['artilces']);
                        $(".total-product").html(response['datacount']);
                        datawrpper_message(false, "");
                        isDataLoading = false;
                    }
                    $("#apply-btn").prop('disabled', false);
                }
            });
        }

        function datawrpper_message(isDisplay, message){
            if(isDisplay === true){
                $('.reponse-msg-box').html(message).fadeIn();
            } else {
                $('.reponse-msg-box').html("").fadeOut();
            }
            $('.auto-load').hide();
        }

        function get_filter(class_name) {
            var filter = [];
            $('.' + class_name + ':checked').each(function () {
                filter.push($(this).val());
            });
            return filter;
        }

        // $('.common_selector').click(function () {
        //     filter_data(page);
        // });

        // $(".amount_input").keyup(function () {
        //     filter_data(page);
        // });

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
                    $("#amount-start").html("$" + min);
                    $("#amount-end").html(" $" + max);
                    $("#hidden_minimum_price").val(min);
                    $("#minimum_price").val(min);
                    $("#hidden_maximum_price").val(max);
                    $("#maximum_price").val(max);
                    //filter_data();
                },
                stop: function (event, ui) {
                    // filter_data(page);
                }
            });
            //$( "#amount" ).html( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );
            $("#amount-start").html(" $" + $("#slider-range").slider("values", 0));
            $("#amount-end").html(" $" + $("#slider-range").slider("values", 1));

        });

        $(function () {
            var maxPrice = 7;

            $("#slider-range-carat").slider({
                range: true,
                min: 0,
                max: maxPrice,
                step: 0.1,
                values: [0, maxPrice],
                slide: function (event, ui) {
                    $("#carat").html(ui.values[0] + " - " + ui.values[1]);
                    $("#hidden_minimum_price_carat").val(ui.values[0]);
                    $("#hidden_maximum_price_carat").val(ui.values[1]);
                    //filter_data(page);
                },
                stop: function (event, ui) {
                    // filter_data(page);
                }
            });
            $("#carat").html($("#slider-range-carat").slider("values", 0) + " - " + $("#slider-range-carat").slider("values", 1));
        });
    });
</script>

<script>
    // $(document).ready(function() {
    //    // if ($.cookie('pop') == null) {

    //         $(window).on('load', function() {
    //           // $('#myModal').modal('show');
    //            $('#myStep').modal('show');
    //         });
    //        // $.cookie('pop', '1');
    //    // }
    // });

    $(window).on('load', function () {
        var delayMs = 2000; // delay in milliseconds
        //$('#myStep').delay(2000).fadeIn(450);
        $('#myStep').delay(1000).fadeOut('slow');

        setTimeout(function () {
            $('#myStep').modal('show');
        }, delayMs);
    });
</script>
@endsection