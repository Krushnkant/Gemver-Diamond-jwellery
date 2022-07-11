@extends('frontend.layout.layout')

@section('content')


<div class="background-sub-slider">
            <div class="position-relative">
                <img src="{{ asset('frontend/image/about_us.png') }}" alt="">
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
        <div class="mt-4 mt-md-5"></div>
        <div class="row">
            <div class="col-md-6 mb-4">
                    <div class="round_cut_lab_checkbox row">
                        <div class="round_cut_lab_diamonds_heading mb-4 col-md-2">shape</div>
                        <div class="col-md-10">
                            <?php $no_shap = 1;  ?>
                            @foreach($diamondshape as $shape)  
                            <span class="form-check position-relative ps-0 mb-2 pb-1 round_checkbox_part" data-toggle="tooltip" data-placement="top" title="This is a Tooltip">
                                    <input class="form-check-input shape common_selector" value="{{ $shape }}" type="checkbox" name="shape[]" {{ ( isset($ShopBy->attribute_terms) && $ShopBy->attribute_terms == $shape) ? 'checked' : '' }}  id="flexRadioDefault{{ $no_shap }}">
                                    <img src="{{ url('frontend/image/'.ltrim($shape,' ').'.png') }}" alt="" class="shape_img">
                                    <!-- <label class="form-check-label round_cut_lab_label" for="flexRadioDefault{{ $no_shap }}">
                                    {{ $shape }}
                                    </label> -->
                            </span>
                            <?php $no_shap++;  ?>
                            @endforeach
                        </div>
                    </div>
                </div>
            <div class="col-md-6 mb-4">
                <div class="round_cut_lab_range_slider mt-3 mt-md-0 row">
                    <div class="round_cut_lab_diamonds_heading mb-4 col-md-2">price</div>
                    <div class="round_cut_lab_diamonds_price mb-4 col-md-10">
                        <div id="slider-range"></div>
                        <p> Price : <span id="amount"></span></p>
                        <input type="hidden" id="hidden_minimum_price" />
                        <input type="hidden" id="hidden_maximum_price" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="round_cut_lab_range_slider mb-4 round_cut_lab_range_color row">
                    <div class="round_cut_lab_diamonds_heading mb-4 col-md-2">color</div>
                    <div class="col-md-10">
                        @foreach($diamondcolor as $color) 
                        <div class="form-group mb-3 me-2 d-inline-block">
                            <input type="checkbox"  value="{{ $color }}" name="color[]" class="color common_selector" id="colors{{ $color }}">
                            <label for="colors{{ $color }}">{{ $color }}</label>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="round_cut_lab_range_slider row">
                    <div class="round_cut_lab_diamonds_heading mb-4 col-md-2">carat</div>
                    <div class="round_cut_lab_diamonds_price mb-4 col-md-10">
                        <div id="slider-range-carat"></div>
                        <p> Carat : <span id="carat"></span></p>
                        <input type="hidden" id="hidden_minimum_carat" />
                        <input type="hidden" id="hidden_maximum_carat" />
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="round_cut_lab_range_slider round_cut_lab_range_color row">
                        <div class="round_cut_lab_diamonds_heading mb-4 col-md-2">clarity</div>
                
                        <div class="col-md-10">
                            @foreach($diamondclarity as $clarity) 
                            <div class="form-group mb-3 me-2 d-inline-block">
                                <input type="checkbox" value="{{ $clarity }}" name="clarity[]" class="clarity common_selector" id="clarity{{ $clarity }}">
                                <label for="clarity{{ $clarity }}">{{ $clarity }}</label>
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
            </div>
            <div class="col-md-6">
                <div class="round_cut_lab_range_slider mb-3 mb-xxl-4 row">
                        <div class="round_cut_lab_diamonds_heading mb-4 col-md-2">report</div>
                        <div class="col-md-10">
                            @foreach($diamondreport as $report) 
                            <div class="form-group mb-3 d-inline-block me-3">
                                <input type="checkbox" name="report[]" value="{{ $report }}" class="report common_selector" id="report{{ $report }}">
                                <label for="report{{ $report }}">{{ $report }}</label>
                            </div>
                            @endforeach
                            
                        </div>
                    </div> 
            </div>
            <div class="col-md-6 mb-4">
                <div class="round_cut_lab_range_slider row">
                    <div class="round_cut_lab_diamonds_heading col-md-2">cut</div>
                    <div class="col-md-10">
                        @foreach($diamondcut as $cut) 
                        <div class="form-group mb-3 d-inline-block me-3">
                            <input type="checkbox" value="{{ $cut }}" class="cut common_selector" name="cut[]" id="cut{{ $cut }}">
                            <label for="cut{{ $cut }}">{{ $cut }}</label>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        
           
        </div>
        <div class="row align-items-center step-progressbar-row mt-4">
            <div class="col-lg-2 text-center text-lg-start">
                <div class="step-progressbar-side-heading mb-3 mb-lg-0">Create Your {{ $Category->category_name }}</div>
            </div>
            <div class="col-lg-10">
                <div class="flex-container step-progressbar">
                    <div class="flex-row text-center">
                        <div class="flex-col-xs-12">
                            @if($check_variant == 1)
                            <ul class="tab-steps--list">
                               
                                <li class="active" data-step="1">
                                    <div class="step-img">
                                        <img src="{{ url($Category->category_thumb) }}" alt="">
                                    </div>
                                    <div class="step-heading mt-2">
                                        choose setting
                                    </div>
                                    <span><a href="{{ url('/product-setting/'. $CatId .'/edit') }}" class="step-heading-link mt-2 d-inline-block">edit</a></span>
                                    <!-- <span> <a href="#" class="step-heading-link mt-2 d-inline-block ms-4">view</a></span> -->
                                </li>

                                <li class="active" data-step="2">
                                    <div class="step-img">
                                        <img src="{{ url('frontend/image/diamon_img.jpeg') }}" alt="">
                                    </div>
                                    <div class="step-heading mt-2">
                                        choose diamond
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
                                        <img src="{{ url('frontend/image/diamon_img.jpeg') }}" alt="">
                                    </div>
                                    <div class="step-heading mt-2">
                                        choose diamond
                                    </div>
                                </li>
                                <li  data-step="2">
                                    <div class="step-img">
                                        <img src="{{ url($Category->category_thumb) }}" alt="">
                                    </div>
                                    <div class="step-heading mt-2">
                                        choose setting
                                    </div>
                                    <a href="{{ url('/product-setting/'. $CatId) }}" class="step-heading-link mt-2 d-block">browse lab diamonds</a>
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
        <div class="row align-items-center">
            <div class="col-sm-5 col-md-6">
                <div id="datacount" class="my-3 my-xxl-5 wire_bangle_showing_text text-center text-sm-start"></div>
            </div>
            <div class="col-sm-3 col-md-6 text-center text-sm-end mb-sm-0 d-flex justify-content-center justify-content-sm-end">
                <span class="wire_bangle_select text-center select_box_option">
                    <select class="form-control w-auto ms-auto" name="sorting" id="sorting">
                        <option value="price">Sort by price: low to high</option>
                        <option value="price-desc">Sort by price: high to low</option>
                    </select>
                </span>
                <span class="d-inline-block ms-4">
                    <button class="filter-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M5.8335 9.16665H14.1668V10.8333H5.8335V9.16665ZM3.3335 5.83331H16.6668V7.49998H3.3335V5.83331ZM8.3335 12.5H11.6668V14.1666H8.3335V12.5Z" fill="#0B1727"/>
                        </svg>
                        <span>filter</span>
                    </button>
                </span>
                <!-- <div class="right_side_panel scrollbar" id="style-1">
                    <span> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x close_icon_svg" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
                        </svg>
                    </span>
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
                        <div class="">  
                            <?php $no_shap = 1;  ?>
                            @foreach($diamondshape as $shape)  
                            <span class="form-check position-relative ps-0 mb-2 pb-1 me-2 round_checkbox_part">
                                    <input class="form-check-input shape common_selector" value="{{ $shape }}" type="checkbox" name="shape[]" {{ ( isset($ShopBy->attribute_terms) && $ShopBy->attribute_terms == $shape) ? 'checked' : '' }}  id="flexRadioDefault{{ $no_shap }}">
                                    <img src="{{ url('frontend/image/'.ltrim($shape,' ').'.png') }}" alt="" class="shape_img">
                            </span>
                            <?php $no_shap++;  ?>
                            @endforeach
                        </div>
                        
                        

                    </div>
                    <div class="round_cut_lab_range_slider mb-4  mb-xxl-5 round_cut_lab_range_color">
                        <div class="round_cut_lab_diamonds_heading mb-4">color</div>
                        <div>
                            @foreach($diamondcolor as $color) 
                            <div class="form-group mb-3 me-2 d-inline-block">
                                <input type="checkbox"  value="{{ $color }}" name="color[]" class="color common_selector" id="colors{{ $color }}">
                                <label for="colors{{ $color }}">{{ $color }}</label>
                            </div>
                            @endforeach
                            
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
                            @foreach($diamondclarity as $clarity) 
                            <div class="form-group mb-3 me-2 d-inline-block">
                                <input type="checkbox" value="{{ $clarity }}" name="clarity[]" class="clarity common_selector" id="clarity{{ $clarity }}">
                                <label for="clarity{{ $clarity }}">{{ $clarity }}</label>
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                    <div class="round_cut_lab_range_slider mb-4 mb-xxl-5">
                        <div class="round_cut_lab_diamonds_heading mb-4">cut</div>
                        <div>
                            @foreach($diamondcut as $cut) 
                            <div class="form-group mb-3">
                                <input type="checkbox" value="{{ $cut }}" class="cut common_selector" name="cut[]" id="cut{{ $cut }}">
                                <label for="cut{{ $cut }}">{{ $cut }}</label>
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                    <div class="round_cut_lab_range_slider mb-3 mb-xxl-5">
                        <div class="round_cut_lab_diamonds_heading mb-4">report</div>
                        <div>
                            @foreach($diamondreport as $report) 
                            <div class="form-group mb-3">
                                <input type="checkbox" name="report[]" value="{{ $report }}" class="report common_selector" id="report{{ $report }}">
                                <label for="report{{ $report }}">{{ $report }}</label>
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                    <div class="mt-xxl-4 text-center mb-xxl-3 my-2">
                        
                        <span class="ms-3 clear_filter_btn">clear filter</span>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="wire_bangle_line mb-md-5"></div>
        <div class="row mb-5">
        <div class="col-md-4 col-lg-3 text-start">
               
        </div>

         
       <div id="exTab1" class="container">	
        <ul  class="nav nav-tabs mb-5" id="myTab" role="tablist">
			<li class="active nav-item">
                <a  class="nav-link " href="#1a" data-toggle="tab">Result </a>
			</li>
			<li>
                <a class="nav-link " href="#2a" data-toggle="tab"><i class="fa fa-balance-scale"></i> Compare (<span class="totlecpmpare">0</span>)</a>
			</li>
		</ul>
        <div class="tab-content clearfix">
			<div class="tab-pane active" id="1a">
                <div class="col-md-12 col-lg-12 mt-4 mt-md-0 px-0 px-md-3">
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
        
            <div class="tab-pane" id="2a">
                <table class="table table-bordered table-hover">
                <thead>
                    <tr class="table-active">
                        <th>Image</th>
                        <th>Shape</th>
                        <th>Carat</th>
                        <th>Cut</th>
                        <th>Color</th>
                        <th>Clarity</th>
                        <th>Certificate</th>
                        <th>Price</th>
                        <th>Compare</th>
                    </tr>
                </thead>
                <tbody class="comparelist">
                    
                </tbody>  
                </table>
            </div>
        </div>
        </div>
        </div>
    </div>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript">
    $(document).ready(function() { 
        compare_data();
        function compare_data()
        {
            var ENDPOINT = "{{ url('/compare/'.$CatId) }}";
            $.ajax({
                type: 'GET',
                url: ENDPOINT,
                success:function(response){ 
                     $(".totlecpmpare").text(response.totalcompare);    
                     $(".comparelist").html(response.artilces);    
                }   
            });
        }    

    $('body').on('click', '.comparesave', function () {
        save_compare($(this));
    });

    function save_compare(btn){
        var diamond_id = $(btn).attr('data-id');
        var ip_address = '{{ \Request::ip(); }}';
        $.ajax({
            type: 'POST',
            url: "{{ route('frontend.compare.save') }}",
            data: {diamond_id:diamond_id,ip_address:ip_address,_token: '{{ csrf_token() }}'},

            success: function (res) {
                if(res.status == 'failed'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();    
                }
                if(res.status == 200){
                    compare_data();
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

    <script>
        $(document).ready(function(){
            
            var ENDPOINT = "{{ url('/') }}";
            var page = 1;
            $(window).scroll(function () {
                if($(window).scrollTop() + $(window).height() >= $(document).height() - 500) {
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
                    url: ENDPOINT + "/diamonds?page=" + page,
                    method:"POST",
                    data:{action:action,catid:catid,minimum_price:minimum_price,maximum_price:maximum_price,shape:shape,sorting:sorting,color:color,clarity:clarity,cut:cut,minimum_carat:minimum_carat,maximum_carat:maximum_carat,report:report,_token: '{{ csrf_token() }}'},
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
             var maxPrice = '{{ $MaxCarat  }}';
             
            $( "#slider-range-carat" ).slider({
              range: true,
              min: 0,
              max: maxPrice,
              step: 0.1,
              values: [ 0, maxPrice],
              slide: function( event, ui ) {
                $( "#carat" ).html( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                $( "#hidden_minimum_carat" ).val(ui.values[ 0 ]);
                $( "#hidden_maximum_carat" ).val(ui.values[ 1 ]);
                filter_data(page);
              }
            });
            $( "#carat" ).html($( "#slider-range-carat" ).slider( "values", 0 ) +
             " - " + $( "#slider-range-carat" ).slider( "values", 1 ) );
             
          });
        });
   </script>



   @endsection