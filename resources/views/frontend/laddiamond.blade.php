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
        <div class="mt-4 mt-md-5"></div>
        <div class="row">
            <div class="col-lg-6 round_cut_lab_filter">
                <div class="round_cut_lab_checkbox row mb-2">
                    <span class="round_cut_lab_diamonds_heading col-md-12 mb-2">shape </span>
                    <div class="col-md-12">
                            <span class="form-check position-relative ps-0 round_checkbox_part " data-toggle="tooltip" data-placement="top" title="Round">
                                    <input class="form-check-input shape common_selector" value="round" type="checkbox" name="shape[]" {{ ( strtolower($shap) ==  'round'  ) ? 'checked' : '' }}  id="flexRadioDefaultround">
                                    <img src="{{ url('frontend/image/round.png') }}" alt="round" class="shape_img">
                            </span>
                            <span class="form-check position-relative ps-0 round_checkbox_part " data-toggle="tooltip" data-placement="top" title="Princess">
                                    <input class="form-check-input shape common_selector" value="princess" type="checkbox" name="shape[]"  {{ ( strtolower($shap) ==  'princess'  ) ? 'checked' : '' }} id="flexRadioDefaultprincess">
                                    <img src="{{ url('frontend/image/princess.png') }}" alt="princess" class="shape_img">
                            </span>
                            <span class="form-check position-relative ps-0 round_checkbox_part " data-toggle="tooltip" data-placement="top" title="Cushion">
                                    <input class="form-check-input shape common_selector" value="cushion" type="checkbox" name="shape[]" {{ ( strtolower($shap) ==  'cushion'  ) ? 'checked' : '' }}  id="flexRadioDefaultcushion">
                                    <img src="{{ url('frontend/image/cushion.png') }}" alt="cushion" class="shape_img">
                            </span>
                            <span class="form-check position-relative ps-0 round_checkbox_part " data-toggle="tooltip" data-placement="top" title="Asscher">
                                    <input class="form-check-input shape common_selector" value="asscher" type="checkbox" name="shape[]" {{ ( strtolower($shap) ==  'asscher'  ) ? 'checked' : '' }} id="flexRadioDefaultasscher">
                                    <img src="{{ url('frontend/image/asscher.png') }}" alt="asscher" class="shape_img">
                            </span>
                            <span class="form-check position-relative ps-0 round_checkbox_part " data-toggle="tooltip" data-placement="top" title="Emerald">
                                    <input class="form-check-input shape common_selector" value="emerald" type="checkbox" name="shape[]" {{ ( strtolower($shap) ==  'emerald'  ) ? 'checked' : '' }}   id="flexRadioDefaultemerald">
                                    <img src="{{ url('frontend/image/emerald.png') }}" alt="emerald" class="shape_img">
                            </span>
                            <span class="form-check position-relative ps-0 round_checkbox_part " data-toggle="tooltip" data-placement="top" title="Oval">
                                    <input class="form-check-input shape common_selector" value="oval" type="checkbox" name="shape[]" {{ ( strtolower($shap) ==  'oval'  ) ? 'checked' : '' }}   id="flexRadioDefaultoval">
                                    <img src="{{ url('frontend/image/oval.png') }}" alt="oval" class="shape_img">
                            </span>
                            <span class="form-check position-relative ps-0 round_checkbox_part " data-toggle="tooltip" data-placement="top" title="Radiant">
                                    <input class="form-check-input shape common_selector" value="radiant" type="checkbox" name="shape[]" {{ ( strtolower($shap) ==  'radiant'  ) ? 'checked' : '' }}  id="flexRadioDefaultradiant">
                                    <img src="{{ url('frontend/image/radiant.png') }}" alt="radiant" class="shape_img">
                            </span>
                            <span class="form-check position-relative ps-0 round_checkbox_part " data-toggle="tooltip" data-placement="top" title="Marquise">
                                    <input class="form-check-input shape common_selector" value="marquise" type="checkbox" name="shape[]"  {{ ( strtolower($shap) ==  'marquise'  ) ? 'checked' : '' }}  id="flexRadioDefaultmarquise">
                                    <img src="{{ url('frontend/image/marquise.png') }}" alt="marquise" class="shape_img">
                            </span>
                            <span class="form-check position-relative ps-0 round_checkbox_part " data-toggle="tooltip" data-placement="top" title="Heart">
                                    <input class="form-check-input shape common_selector" value="heart" type="checkbox" name="shape[]" {{ ( strtolower($shap) ==  'heart'  ) ? 'checked' : '' }}  id="flexRadioDefaultrheart">
                                    <img src="{{ url('frontend/image/heart.png') }}" alt="heart" class="shape_img">
                            </span>
                            <span class="form-check position-relative ps-0 round_checkbox_part " data-toggle="tooltip" data-placement="top" title="Pear">
                                    <input class="form-check-input shape common_selector" value="pear" type="checkbox" name="shape[]"  {{ ( strtolower($shap) ==  'pear'  ) ? 'checked' : '' }}  id="flexRadioDefaultpear">
                                    <img src="{{ url('frontend/image/pear.png') }}" alt="pear" class="shape_img">
                            </span>
                    </div>
                </div>
                
            </div>
            <div class="col-lg-6 round_cut_lab_filter">
                <div class="row">
                    <span class="round_cut_lab_diamonds_heading col-md-12 mb-2">price</span>
                    <span class="round_cut_lab_diamonds_price col-md-12">
                        <div id="slider-range"></div>
                        <p class="mb-0"> <span id="amount" class="ps-0"></span></p>
                        <input type="hidden" id="hidden_minimum_price" />
                        <input type="hidden" id="hidden_maximum_price" />
                    </span>
                </div>
            </div>
            <div class="col-lg-6 round_cut_lab_filter">
                <div class="round_cut_lab_range_slider round_cut_lab_range_color row">
                    <span class="round_cut_lab_diamonds_heading col-md-12 mb-2">color</span>
                    <span class="col-md-12">
                        @foreach($diamondcolor as $color) 
                        <div class="form-group d-inline-block mb-2">
                            <input type="checkbox"  value="{{ $color }}" name="color[]" class="color common_selector" id="colors{{ $color }}">
                            <label for="colors{{ $color }}">{{ $color }}</label>
                        </div>
                        @endforeach
                    </span>
                </div>
            </div>
            <div class="col-lg-6 round_cut_lab_filter">
                <div class="round_cut_lab_range_slider row">
                    <span class="round_cut_lab_diamonds_heading col-md-12 mb-2">carat</span>
                    <span class="round_cut_lab_diamonds_price col-md-12">
                        <div id="slider-range-carat"></div>
                        <p class="mb-0"> <span id="carat"></span></p>
                        <input type="hidden" id="hidden_minimum_carat" />
                        <input type="hidden" id="hidden_maximum_carat" />
                    </span>
                </div>
            </div>
            <div class="col-lg-6 round_cut_lab_filter">
                <div class="round_cut_lab_range_slider round_cut_lab_range_color row">
                    <span class="round_cut_lab_diamonds_heading col-md-12 mb-2">clarity</span>
                    <span class="col-md-12">
                        @foreach($diamondclarity as $clarity) 
                        <div class="form-group d-inline-block mb-0">
                            <input type="checkbox" value="{{ $clarity }}" name="clarity[]" class="clarity common_selector" id="clarity{{ $clarity }}">
                            <label for="clarity{{ $clarity }}">{{ $clarity }}</label>
                        </div>
                        @endforeach
                    </span>
                </div>
            </div>
            <div class="col-lg-6 round_cut_lab_filter">
                <div class="round_cut_lab_range_slider row"> 
                    <span class="round_cut_lab_diamonds_heading d-inline-block col-md-12 mb-2">report</span>
                    <span class="col-md-12">
                        @foreach($diamondreport as $report) 
                        <div class="form-group d-inline-block mb-2">
                            <input type="checkbox" name="report[]" value="{{ $report }}" class="report common_selector" id="report{{ $report }}">
                            <label for="report{{ $report }}">{{ $report }}</label>
                        </div>
                        @endforeach
                    </span>
                </div>
            </div>
            <div class="col-lg-6 collapse round_cut_lab_filter" id="collapseExample">
                    <div class="round_cut_lab_range_slider row">
                        <span class="round_cut_lab_diamonds_heading col-md-12 mb-2">cut</span>
                        <span class="col-md-12">
                            @foreach($diamondcut as $cut) 
                            <div class="form-group d-inline-block me-3 mb-0">
                                <input type="checkbox" value="{{ $cut }}" class="cut common_selector" name="cut[]" id="cut{{ $cut }}">
                                <label for="cut{{ $cut }}">{{ $cut }}</label>
                            </div>
                            @endforeach
                        </span>
                    </div>
            </div>

            <div class="col-lg-6 collapse round_cut_lab_filter" id="collapseExample">
                <div class="round_cut_lab_range_slider row">
                    <span class="round_cut_lab_diamonds_heading col-md-12 mb-2">Depth %</span>
                    <span class="round_cut_lab_diamonds_price col-md-12">
                        <div id="slider-range-depth"></div>
                        <p class="mb-0"> <span id="depth"></span></p>
                        <input type="hidden" id="hidden_minimum_depth" />
                        <input type="hidden" id="hidden_maximum_depth" />
                    </span>
                </div>
            </div>

            <div class="col-lg-6 collapse round_cut_lab_filter" id="collapseExample">
                    <div class="round_cut_lab_range_slider row">
                        <span class="round_cut_lab_diamonds_heading col-md-12 mb-2">Polish</span>
                        <span class="col-md-12">
                            @foreach($diamondpolish as $polish) 
                            <div class="form-group d-inline-block me-3 mb-0">
                                <input type="checkbox" value="{{ $polish }}" class="polish common_selector" name="polish[]" id="polish{{ $polish }}">
                                <label for="polish{{ $polish }}">{{ $polish }}</label>
                            </div>
                            @endforeach
                        </span>
                    </div>
            </div>

            <div class="col-lg-6 collapse round_cut_lab_filter" id="collapseExample">
            <div class="round_cut_lab_range_slider row">
                    <span class="round_cut_lab_diamonds_heading col-md-12 mb-2">L/W Ratio</span>
                    <span class="round_cut_lab_diamonds_price col-md-12">
                        <div id="slider-range-ratio"></div>
                        <p class="mb-0"> <span id="ratio"></span></p>
                        <input type="hidden" id="hidden_minimum_ratio" />
                        <input type="hidden" id="hidden_maximum_ratio" />
                    </span>
                </div>
            </div>
 
            <div class="col-lg-6 collapse round_cut_lab_filter" id="collapseExample">
                    <div class="round_cut_lab_range_slider row">
                        <span class="round_cut_lab_diamonds_heading col-md-12 mb-2">Sym.</span>
                        <span class="col-md-12">
                            @foreach($diamondsymm as $symm) 
                            <div class="form-group d-inline-block me-3">
                                <input type="checkbox" value="{{ $symm }}" class="symm common_selector" name="symm[]" id="symm{{ $symm }}">
                                <label for="symm{{ $symm }}">{{ $symm }}</label>
                            </div>
                            @endforeach
                        </span>
                    </div>
            </div>

            <div class="col-lg-6 collapse round_cut_lab_filter" id="collapseExample">
            <div class="round_cut_lab_range_slider row">
                    <span class="round_cut_lab_diamonds_heading col-md-12 mb-2">Table %</span>
                    <span class="round_cut_lab_diamonds_price col-md-12">
                        <div id="slider-range-table"></div>
                        <p class="mb-0"> <span id="table"></span></p>
                        <input type="hidden" id="hidden_minimum_table" />
                        <input type="hidden" id="hidden_maximum_table" />
                    </span>
                </div>
            </div>

            <span class="d-inline-block">
                <div class="round_cut_lab_range_slider text-end me-3">
                    <div class="form-group mb-3 d-inline-block" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <input type="checkbox" value="" name="advance" class=" common_selector1" id="checkbox_1">
                        <label for="checkbox_1">advanced filters</label>
                    </div>
                </div>
            </span>
           
        </div>
        <div class="wire_bangle_line "></div>

        <div class="row my-4">
            <div class="col-sm-6 text-center text-sm-start">
                <ul  class="nav wire_bangle_tabs_part justify-content-center justify-sm-content-center" id="myTab" role="tablist">
                    <li class="active nav-item">
                        <a  class="nav-link " href="#1a" data-toggle="tab">Result </a>
                    </li>
                    <li>
                        <a class="nav-link " href="#2a" data-toggle="tab"><i class="fa fa-balance-scale"></i> Compare (<span class="totlecpmpare">0</span>)</a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-6 text-center text-sm-end">
               
                <span class="wire_bangle_select text-center text-md-end select_box_option d-inline-block">
                    <select class="form-control w-auto ms-auto"  name="sorting" id="sorting">
                        <option value="price">Sort by price: low to high</option>
                        <option value="price-desc">Sort by price: high to low</option>
                    </select>
                </span>
            </div>
        </div>
        <div class="row mb-5">
            
            <!-- <div class="wire_bangle_line mb-md-5"></div> -->

            
            <div id="exTab1" class="container px-0">	

            <div class="tab-content clearfix">
			    <div class="tab-pane active" id="1a">
                    <div class="col-md-12 col-lg-12 mt-4 mt-md-0 px-0">
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
                    <table class="table table-bordered table-hover table_part_product">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"  />
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   
    <script type="text/javascript">
    $(document).ready(function() { 
        compare_data();
        function compare_data()
        {
            var ENDPOINT = "{{ url('/compareladdiamond/') }}";
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
                var polish = get_filter('polish');
                var symm = get_filter('symm');
                var sorting = $('#sorting :selected').val();
                var minimum_carat = $('#hidden_minimum_carat').val();
                var maximum_carat = $('#hidden_maximum_carat').val();

                var minimum_depth = $('#hidden_minimum_depth').val();
                var maximum_depth = $('#hidden_maximum_depth').val();

                var minimum_ratio = $('#hidden_minimum_ratio').val();
                var maximum_ratio = $('#hidden_maximum_ratio').val();

                var minimum_table = $('#hidden_minimum_table').val();
                var maximum_table = $('#hidden_maximum_table').val();
                $.ajax({
                   // url:"{{ url('/product-filter') }}",
                    url: ENDPOINT + "/alllad-diamond?page=" + page,
                    method:"POST",
                    data:{action:action,minimum_price:minimum_price,maximum_price:maximum_price,shape:shape,sorting:sorting,color:color,clarity:clarity,cut:cut,minimum_carat:minimum_carat
                        ,maximum_carat:maximum_carat,minimum_depth:minimum_depth,maximum_depth:maximum_depth,minimum_ratio:minimum_ratio,maximum_ratio:maximum_ratio,minimum_table:minimum_table,maximum_table:maximum_table,report:report,polish:polish,symm:symm,_token: '{{ csrf_token() }}'},
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
                $( "#hidden_minimum_carat" ).val(ui.values[ 0 ]);
                $( "#hidden_maximum_carat" ).val(ui.values[ 1 ]);
                filter_data(page);
              }
            });
            $( "#carat" ).html($( "#slider-range-carat" ).slider( "values", 0 ) +
             " - " + $( "#slider-range-carat" ).slider( "values", 1 ) );
             
          });

          $(function() {
             var maxDepth = '{{ $MaxDepth  }}';
             
            $( "#slider-range-depth" ).slider({
              range: true,
              min: 40,
              max: maxDepth,
              step: 0.1,
              values: [ 0, maxDepth],
              slide: function( event, ui ) {
                
                $( "#depth" ).html( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                $( "#hidden_minimum_depth" ).val(ui.values[ 0 ]);
                $( "#hidden_maximum_depth" ).val(ui.values[ 1 ]);
                filter_data(page);
              }
            });
            $( "#depth" ).html($( "#slider-range-depth" ).slider( "values", 0 ) +
             " - " + $( "#slider-range-depth" ).slider( "values", 1 ) );
             
          });

          $(function() {
             var maxRatio = 3;
             
            $( "#slider-range-ratio" ).slider({
              range: true,
              min: 0,
              max: maxRatio,
              step: 0.1,
              values: [ 0, maxRatio],
              slide: function( event, ui ) {
                
                $( "#ratio" ).html( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                $( "#hidden_minimum_ratio" ).val(ui.values[ 0 ]);
                $( "#hidden_maximum_ratio" ).val(ui.values[ 1 ]);
                filter_data(page);
              }
            });
            $( "#ratio" ).html($( "#slider-range-ratio" ).slider( "values", 0 ) +
             " - " + $( "#slider-range-ratio" ).slider( "values", 1 ) );
             
          });

          $(function() {
             var maxTable = '{{ $MaxTable  }}';
             
            $( "#slider-range-table" ).slider({
              range: true,
              min: 40,
              max: maxTable,
              step: 0.1,
              values: [ 0, maxTable],
              slide: function( event, ui ) {
                
                $( "#table" ).html( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                $( "#hidden_minimum_table" ).val(ui.values[ 0 ]);
                $( "#hidden_maximum_table" ).val(ui.values[ 1 ]);
                filter_data(page);
              }
            });
            $( "#table" ).html($( "#slider-range-table" ).slider( "values", 0 ) +
             " - " + $( "#slider-range-table" ).slider( "values", 1 ) );
             
          });

        });
   </script>



   @endsection