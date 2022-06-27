@extends('frontend.layout.layout')

@section('content')
<div class="background-sub-slider">
            <div class="position-relative">
                <img src="{{ asset('frontend/image/about_us.png') }}" alt="">
                <div class="about_us_background">
                    <div class="sub_heading mb-lg-3"> Lad Diamond</div>
                    <div class="about_us_link">
                        <a href="{{ URL('/') }}">home</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none" class="mx-2">
                            <path d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z" fill="white"/>
                            <path d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z" fill="white"/>
                        </svg>
                        <a href="#">Lad Diamond </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container round_cut_lab_diamonds_page">
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
                <div class="round_cut_lab_checkbox mb-xxl-5 mb-4">
                    <div class="round_cut_lab_diamonds_heading mb-4">shape</div>
                    <span class="form-check position-relative ps-0 mb-2 pb-1">
                        <img src="{{ url('frontend/image/diamod_shape_1.png') }}" alt="" class="shape_img ms-4">
                            <input class="form-check-input shape common_selector" value="round" type="checkbox" <?php if($shap == 'round'){ echo 'checked'; } ?> name="shape[]" id="flexRadioDefault12">
                            <label class="form-check-label round_cut_lab_label" for="flexRadioDefault12">
                                round
                            </label>
                    </span>
                    <span class="form-check position-relative ps-0 mb-2 pb-1">
                        <img src="{{ url('frontend/image/diamod_shape_2.png') }}" alt="" class="shape_img ms-4">
                                <input class="form-check-input shape common_selector" value="oval" <?php if($shap == 'oval'){ echo 'checked'; } ?> type="checkbox" name="shape[]" id="flexRadioDefault13">
                                <label class="form-check-label round_cut_lab_label" for="flexRadioDefault13">
                                    oval
                                </label>
                            </span>
                    <span class="form-check position-relative  ps-0 mb-2 pb-1 pb-2">
                        <img src="{{ url('frontend/image/diamod_shape_3.png') }}" alt="" class="shape_img ms-4">
                            <input class="form-check-input shape common_selector" value="emerald" <?php if($shap == 'emerald'){ echo 'checked'; } ?> type="checkbox" name="shape[]" id="flexRadioDefault14">
                            <label class="form-check-label round_cut_lab_label" for="flexRadioDefault14">
                                emerald
                            </label>
                    </span>
                    <span class="form-check position-relative ps-0 mb-2 pb-1">
                        <img src="{{ url('frontend/image/diamod_shape_4.png') }}" alt="" class="shape_img ms-4">
                            <input class="form-check-input shape common_selector" value="princess" <?php if($shap == 'princess'){ echo 'checked'; } ?> type="checkbox" name="shape[]" id="flexRadioDefault15">
                            <label class="form-check-label round_cut_lab_label" for="flexRadioDefault15">
                                princess
                        </label>
                    </span>
                    <span class="form-check position-relative ps-0 mb-2 pb-1">
                    <img src="{{ url('frontend/image/diamod_shape_5.png') }}" alt="" class="shape_img ms-4">
                            <input class="form-check-input shape common_selector" value="cushion" <?php if($shap == 'cushion'){ echo 'checked'; } ?> type="checkbox" name="shape[]" id="flexRadioDefault16">
                            <label class="form-check-label round_cut_lab_label" for="flexRadioDefault16">
                                cushion
                        </label>
                    </span>
                    <span class="form-check position-relative ps-0 mb-2 pb-1">
                    <img src="{{ url('frontend/image/diamod_shape_6.png') }}" alt="" class="shape_img ms-4">
                            <input class="form-check-input shape common_selector" value="marquise" <?php if($shap == 'marquise'){ echo 'checked'; } ?> type="checkbox" name="shape[]" id="flexRadioDefault17">
                            <label class="form-check-label round_cut_lab_label" for="flexRadioDefault17">
                                marquise
                        </label>
                    </span>

                    <span class="form-check position-relative ps-0 mb-2 pb-1">
                    <img src="{{ url('frontend/image/diamod_shape_7.png') }}" alt="" class="shape_img ms-4">
                            <input class="form-check-input shape common_selector" value="pear"  <?php if($shap == 'pear'){ echo 'checked'; } ?> type="checkbox" name="shape[]" id="flexRadioDefault170">
                            <label class="form-check-label round_cut_lab_label" for="flexRadioDefault170">
                                pear
                        </label>
                    </span>

                    <span class="form-check position-relative ps-0 mb-2 pb-1">
                    <img src="{{ url('frontend/image/diamod_shape_8.png') }}" alt="" class="shape_img ms-4">
                            <input class="form-check-input shape common_selector" value="heart" <?php if($shap == 'heart'){ echo 'checked'; } ?> type="checkbox" name="shape[]" id="flexRadioDefault171">
                            <label class="form-check-label round_cut_lab_label" for="flexRadioDefault171">
                            heart
                        </label>
                    </span>

                    <span class="form-check position-relative ps-0 mb-2 pb-1">
                    <img src="{{ url('frontend/image/asscher.png') }}" alt="" class="shape_img ms-4">
                            <input class="form-check-input shape common_selector" value="asscher" <?php if($shap == 'asscher'){ echo 'checked'; } ?> type="checkbox" name="shape[]" id="flexRadioDefault172">
                            <label class="form-check-label round_cut_lab_label" for="flexRadioDefault172">
                            asscher
                        </label>
                    </span>

                    <span class="form-check position-relative ps-0 mb-2 pb-1">
                    <img src="{{ url('frontend/image/radiant.png') }}" alt="" class="shape_img ms-4">
                            <input class="form-check-input shape common_selector" <?php if($shap == 'radiant'){ echo 'checked'; } ?> value="radiant" type="checkbox" name="shape[]" id="flexRadioDefault173">
                            <label class="form-check-label round_cut_lab_label" for="flexRadioDefault173">
                            radiant
                        </label>
                    </span>
                    

                </div>
                <div class="round_cut_lab_range_slider mb-4  mb-xxl-5 round_cut_lab_range_color">
                    <div class="round_cut_lab_diamonds_heading mb-4">color</div>
                    <div>
                        <div class="form-group mb-3 me-2 d-inline-block">
                            <input type="checkbox"  value="M" name="color[]" class="color common_selector" id="9">
                            <label for="9">M</label>
                        </div>
                        <div class="form-group mb-3 me-2 d-inline-block">
                            <input type="checkbox" value="L" name="color[]" class="color common_selector" id="10">
                            <label for="10">L</label>
                        </div>
                        <div class="form-group mb-3 me-2 d-inline-block">
                            <input type="checkbox" value="K" name="color[]" class="color common_selector" id="11">
                            <label for="11">K</label>
                        </div>
                        <div class="form-group mb-3 me-2 d-inline-block">
                            <input type="checkbox" value="I" name="color[]" class="color common_selector" id="12">
                            <label for="12">I</label>
                        </div>
                        <div class="form-group mb-3 me-2 d-inline-block">
                            <input type="checkbox" value="H" name="color[]" class="color common_selector" id="13">
                            <label for="13">H</label>
                        </div>
                        <div class="form-group mb-3 me-2 d-inline-block">
                            <input type="checkbox" value="G" name="color[]" class="color common_selector" id="14">
                            <label for="14">G</label>
                        </div>
                        <div class="form-group mb-3 me-2 d-inline-block">
                            <input type="checkbox" value="F" name="color[]" class="color common_selector" id="15">
                            <label for="15">F</label>
                        </div>
                        <div class="form-group mb-3 me-2 d-inline-block">
                            <input type="checkbox" value="E" name="color[]" class="color common_selector" id="16">
                            <label for="16">E</label>
                        </div>
                        <div class="form-group mb-3 me-2 d-inline-block">
                            <input type="checkbox" value="D" name="color[]" class="color common_selector" id="17">
                            <label for="17">D</label>
                        </div>
                    </div>
                </div>

                <div class="round_cut_lab_range_slider mb-xxl-5 mb-4 mt-3 mt-md-0">
                    <div class="round_cut_lab_diamonds_heading mb-4">carat</div>
                    <div class="round_cut_lab_diamonds_price mb-4">
                        <div id="slider-range-carat"></div>
                        <p> Carat : <span id="carat"></span></p>
                        <input type="hidden" id="hidden_minimum_carat" />
                        <input type="hidden" id="hidden_maximum_carat" />
                    </div>
                </div>

             
                <div class="round_cut_lab_range_slider mb-xxl-5 mb-3 round_cut_lab_range_color">
                    <div class="round_cut_lab_diamonds_heading mb-4">clarity</div>
             
                    <div>
                        <div class="form-group mb-3 me-2 d-inline-block">
                            <input type="checkbox" value="I1" name="clarity[]" class="clarity common_selector" id="18">
                            <label for="18">I1</label>
                        </div>
                        <div class="form-group mb-3 me-2 d-inline-block">
                            <input type="checkbox" value="SI2" name="clarity[]" class="clarity common_selector" id="19">
                            <label for="19">SI2</label>
                        </div>
                        <div class="form-group mb-3 me-2 d-inline-block">
                            <input type="checkbox" value="SI1" name="clarity[]" class="claritycommon_selector" id="20">
                            <label for="20">SI1</label>
                        </div>
                        <div class="form-group mb-3 me-2 d-inline-block">
                            <input type="checkbox" value="VS2" name="clarity[]" class="clarity common_selector" id="21">
                            <label for="21">VS2</label>
                        </div>
                        <div class="form-group mb-3 me-2 d-inline-block">
                            <input type="checkbox" value="VS1" name="clarity[]" class="clarity common_selector" id="22">
                            <label for="22">VS1</label>
                        </div>
                        <div class="form-group mb-3 me-2 d-inline-block">
                            <input type="checkbox" value="VVS2" name="clarity[]" class="clarity common_selector" id="23">
                            <label for="23">VVS2</label>
                        </div>
                        <div class="form-group mb-3 me-2 d-inline-block">
                            <input type="checkbox" value="VVS1" name="clarity[]" class="clarity common_selector" id="24">
                            <label for="24">VVS1</label>
                        </div>
                        <div class="form-group mb-3 me-2 d-inline-block">
                            <input type="checkbox" value="IF" name="clarity[]" class="clarity common_selector" id="25">
                            <label for="25">IF</label>
                        </div>
                    </div>
                </div>
                <div class="round_cut_lab_range_slider mb-4 mb-xxl-5">
                    <div class="round_cut_lab_diamonds_heading mb-4">cut</div>
                    <div>
                        <div class="form-group mb-3">
                            <input type="checkbox" value="FA" class="cut common_selector" name="cut[]" id="1">
                            <label for="1">fair</label>
                        </div>
                        <div class="form-group mb-3">
                            <input type="checkbox" value="GO" class="cut common_selector" name="cut[]" id="2">
                            <label for="2">good</label>
                        </div>
                        <div class="form-group mb-3"> 
                            <input type="checkbox" value="VE" class="cut common_selector" name="cut[]" id="3">
                            <label for="3">very good</label>
                        </div>
                        <div class="form-group mb-3">
                            <input type="checkbox" value="EX" class="cut common_selector" name="cut[]" id="4">
                            <label for="4">excellent</label>
                        </div>
                        <div class="form-group mb-3">
                            <input type="checkbox" value="ID" class="cut common_selector" name="cut[]" id="5">
                            <label for="5">ideal</label>
                        </div>
                    </div>
                </div>
                <div class="round_cut_lab_range_slider mb-3 mb-xxl-5">
                    <div class="round_cut_lab_diamonds_heading mb-4">report</div>
                    <div>
                        <div class="form-group mb-3">
                            <input type="checkbox" name="report[]" value="gia" class="report common_selector" id="6">
                            <label for="6">gia</label>
                        </div>
                        <div class="form-group mb-3">
                            <input type="checkbox" name="report[]" value="igi" class="report common_selector" id="7">
                            <label for="7">igi</label>
                        </div>
                        <div class="form-group mb-3">
                            <input type="checkbox" name="report[]" value="gcal" class="report common_selector" id="8">
                            <label for="8">gcal</label>
                        </div>
                    </div>
                </div>
                <div class="mt-xxl-4 text-center mb-xxl-3 my-2">
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="11" height="10" viewBox="0 0 11 10" fill="none">
                        <path d="M9.09 0L5.5 3.59L1.91 0L0.5 1.41L4.09 5L0.5 8.59L1.91 10L5.5 6.41L9.09 10L10.5 8.59L6.91 5L10.5 1.41L9.09 0Z" fill="#BB9761"/>
                        </svg> -->
                    <span style="display:none;" class="ms-3 clear_filter_btn">clear filter</span>
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
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 500) {
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
                var minimum_price = $('#hidden_minimum_price').val();
                var maximum_price = $('#hidden_maximum_price').val();
                var shape = get_filter('shape');
                var color = get_filter('color');
                var clarity = get_filter('clarity');
                var cut = get_filter('cut');
                var report = get_filter('report');
                var sorting = $('#sorting :selected').val();
                var minimum_carat = $('#hidden_minimum_carat').val();
                var maximum_carat = $('#hidden_maximum_carat').val();
                $.ajax({
                   // url:"{{ url('/product-filter') }}",
                    url: ENDPOINT + "/alllad-diamond?page=" + page,
                    method:"POST",
                    data:{action:action,minimum_price:minimum_price,maximum_price:maximum_price,shape:shape,sorting:sorting,color:color,clarity:clarity,cut:cut,minimum_carat:minimum_carat,maximum_carat:maximum_carat,report:report,_token: '{{ csrf_token() }}'},
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