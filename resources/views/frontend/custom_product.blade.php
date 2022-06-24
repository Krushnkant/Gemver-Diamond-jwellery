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

    <div class="container round_cut_lab_diamonds_page">
        <div class="round_cut_lab_diamonds_paragraph mt-xxl-5 text-center mt-3 mb-3 mb-md-0">
            Browse through our inventory of certified lab created diamonds, available in various shapes, carat weights, colors and clarities. For a more interactive experience, all our lab diamonds are available to view in 360° HD at 40x superzoom.
        </div>
        <div class="row mt-lg-5 pt-lg-5 mt-3 align-items-center step-progressbar-row">
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
                                        <img src="{{ url('frontend/image/edit_box_2.png') }}" alt="">
                                    </div>
                                    <div class="step-heading mt-2">
                                        choose diamond
                                    </div>
                                    <span><a href="{{ url('/diamond-setting/'. $CatId .'/edit') }}" class="step-heading-link mt-2 d-inline-block">edit</a></span>
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
                                        <img src="{{ url('frontend/image/edit_box_2.png') }}" alt="">
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
        </div>
        <div class="wire_bangle_line mt-4 mt-md-5"></div>
        <div class="row align-items-center d-flex justify-content-center">
            <div class="col-sm-5 col-md-6">
                <div id="datacount" class="my-3 my-xxl-5 wire_bangle_showing_text text-center text-sm-start"></div>
            </div>
            <div class="col-sm-7 col-md-6 text-sm-end mb-3 mb-sm-0 text-center text-sm-start">
                <span class="wire_bangle_select text-start">
                    <select name="sorting" id="sorting">
                        <option value="price">Sort by price: low to high</option>
                        <option value="price-desc">Sort by price: high to low</option>
                    </select>
                </span>
            </div>
        </div>
        <div class="wire_bangle_line mb-md-5"></div>
        <div class="row mb-5">
            <div class="col-md-4 col-lg-3 text-start">
                <div class="round_cut_lab_range_slider mb-xxl-5 mb-4 mt-3 mt-md-0">
                    <div class="round_cut_lab_diamonds_heading mb-4">price</div>
                    <div class="round_cut_lab_diamonds_price mb-4">
                        <div id="slider-range"></div>
                        <p> Price : <span id="amount"></span></p>
                        <input type="hidden" id="hidden_minimum_price" />
                        <input type="hidden" id="hidden_maximum_price" />
                    </div>
                </div>
                
                @foreach($Attributes as $attribute)
                    @if($attribute->is_specification == 0)      
                    <div class="round_cut_lab_range_slider mb-4 mb-xxl-5">
                        <div class="round_cut_lab_diamonds_heading mb-4">{{ $attribute->attribute_name }}</div>
                        <div>    
                            @foreach($attribute->attributeterm as $term)
                            <div class="form-group mb-3">
                                <input type="checkbox" class="common_selector attribute" name="attribute[]"  value="{{ $term->id }}" id="{{ $term->id }}">
                                <label for="{{ $term->id }}">{{ $term->attrterm_name }}</label>
                            </div>
                            @endforeach 
                            </div>
                            </div>
                            @else
                            <div class="round_cut_lab_range_slider mb-4 mb-xxl-5">
                                <div class="round_cut_lab_diamonds_heading mb-4">{{ $attribute->attribute_name }}</div>
                                <div>
                                @foreach($attribute->attributeterm as $term)
                                    <div class="form-group mb-3">
                                        <input type="checkbox" class="common_selector specification" name="specification[]"  value="{{ $term->id }}" id="{{ $term->id }}">
                                        <label for="{{ $term->id }}">{{ $term->attrterm_name }}</label>
                                    </div>
                                @endforeach 
                            </div>
                    </div>
                    @endif
                @endforeach
                <div class="mt-xxl-4 text-center mb-xxl-3 my-2">
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 11 10" fill="none">
                        <path d="M9.09 0L5.5 3.59L1.91 0L0.5 1.41L4.09 5L0.5 8.59L1.91 10L5.5 6.41L9.09 10L10.5 8.59L6.91 5L10.5 1.41L9.09 0Z" fill="#BB9761"/>
                        </svg> -->
                    <span class="ms-3 clear_filter_btn">clear filter</span>
                </div>
                <!-- <div class="text-center text-lg-start">
                    <button class="round_cut_lab_diamonds_filter_btn  btn-hover-effect btn-hover-effect-black mt-3">
                    advance filter
                </button>
                </div> -->
            </div>
            <div class="col-md-8 col-lg-9 mt-4 mt-md-0 px-0 px-md-3">
                <div class="row" id="data-wrapper">
                    <!-- Results -->
                </div>
                <!-- Data Loader -->
                <div class="auto-load text-center">
                    <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                        <path fill="#000"
                            d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                            <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                                from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                        </path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"  />
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
    
        // function infinteLoadMore(page) {
        //     $.ajax({
        //             url: ENDPOINT + "/diamonds?page=" + page,
        //             datatype: "html",
        //             type: "get",
        //             beforeSend: function () {
        //                 $('.auto-load').show();
        //             }
        //         })
        //         .done(function (response) {
        //             if (response.length == 0) {
        //                 $('.auto-load').html("We don't have more data to display :(");
        //                 return;
        //             }
        //             $('.auto-load').hide();
        //             $("#data-wrapper").append(response);
        //         })
        //         .fail(function (jqXHR, ajaxOptions, thrownError) {
        //             console.log('Server error occured');
        //         });
        // }
    </script>

    <script>
        $(document).ready(function(){
            
            var ENDPOINT = "{{ url('/') }}";
            var page = 1;
            $(window).scroll(function () {
                if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                    page++;
                    var scroll = 1;
                    filter_data(page,scroll);
                }
            });
            filter_data(page);
            $("#sorting").change(function() {
                filter_data(page);
            });

            $('.clear_filter_btn').click(function(){
                location.reload();
            });
        
            function filter_data(page,scroll=0)
            {
                $('.filter_data').html('<div id="loading" style="" ></div>');
                var action = 'fetch_data';
                var catid  = '{{ $CatId }}';
                var minimum_price = $('#hidden_minimum_price').val();
                var maximum_price = $('#hidden_maximum_price').val();
                var attribute = get_filter('attribute');
                var specification = get_filter('specification');
                var sorting = $('#sorting :selected').val();
                $.ajax({
                   // url:"{{ url('/product-filter') }}",
                    url: ENDPOINT + "/custom_products?page=" + page,
                    method:"POST",
                    data:{action:action,catid:catid,minimum_price:minimum_price,maximum_price:maximum_price,attribute:attribute,sorting:sorting,specification:specification,_token: '{{ csrf_token() }}'},
                    beforeSend: function() {
                        $('.auto-load').show();
                    },
                    success:function(response){
                        $('#datacount').html('showing '+ response['showdata'] +' of '+ response['totaldata'] +' results');
                        
                        if(scroll == 1){
                            if (response['artilces'] == "") {
                                $('.auto-load').html("We don't have more data to display :");
                                return;
                            }
                            $('.auto-load').hide();   
                            $("#data-wrapper").append(response['artilces']);
                        }else{
                            if (response['artilces'] == "") {
                                $('#data-wrapper').html("No Result Found");
                                $('.auto-load').hide();
                                return;
                            }
                            $("#data-wrapper").html(response['artilces']);
                            $('.auto-load').hide();   
                        }  
                        
                    }
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
        
            $('.common_selector').click(function(){
                filter_data(page);
            });
        
            $(function() {
             var maxPrice = '{{ $Maxprice  }}';
             
            $( "#slider-range" ).slider({
              range: true,
              min: 0,
              max: maxPrice,
              values: [ 0, maxPrice],
              slide: function( event, ui ) {
                $( "#amount" ).html( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
                $( "#hidden_minimum_price" ).val(ui.values[ 0 ]);
                $( "#hidden_maximum_price" ).val(ui.values[ 1 ]);
                filter_data(page);
              }
            });
            $( "#amount" ).html( "$" + $( "#slider-range" ).slider( "values", 0 ) +
             " - $" + $( "#slider-range" ).slider( "values", 1 ) );
             
          });

          $(function() {
             var maxPrice = 7;
             
            $( "#slider-range-carat" ).slider({
              range: true,
              min: 0,
              max: maxPrice,
              step: 0.1,
              values: [ 0, maxPrice],
              slide: function( event, ui ) {
                $( "#carat" ).html( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                $( "#hidden_minimum_price_carat" ).val(ui.values[ 0 ]);
                $( "#hidden_maximum_price_carat" ).val(ui.values[ 1 ]);
                filter_data(page);
              }
            });
            $( "#carat" ).html($( "#slider-range-carat" ).slider( "values", 0 ) +
             " - " + $( "#slider-range-carat" ).slider( "values", 1 ) );
             
          });
        });
   </script>



   @endsection