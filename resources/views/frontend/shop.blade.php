@extends('frontend.layout.layout')

@section('content')
        <div class="background-sub-slider">
            <div class="">
                <!-- <img src="{{ asset('frontend/image/about_us.png') }}" alt=""> -->
                <div class="about_us_background">
                    <div class="sub_heading mb-lg-3">shop</div>
                    <div class="about_us_link">
                        <a href="{{ URL('/') }}">home</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none" class="mx-2">
                            <path d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z" fill="white"/>
                            <path d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z" fill="white"/>
                        </svg>
                        <a href="#">shop</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container shop_page round_cut_lab_diamonds_page">
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="row mb-4">
                        <div class="round_cut_lab_diamonds_heading col-lg-12 mb-2">category</div>
                        <div class="wire_bangle_carat col-lg-12 owl-carousel owl-theme category-slider">
                            @foreach($Categories as $category)
                            <span class="item form-check d-inline-block position-relative me-1 ps-0">
                                    <input class="form-check-input category common_selector" type="checkbox" {{ ($CatId == $category->id) ? "checked" : "" }} value="{{ $category->id}}"  name="category[]" id="category{{ $category->id}}">
                                    <label class="form-check-label wire_bangle_carat_label" for="category{{ $category->id}}">
                                        {{ $category->category_name }}
                                </label>
                            </span>
                            @endforeach
                            {{-- @if($CatId > 0)
                                <input class="form-check-input category common_selector" type="checkbox"  checked value="{{ $CatId }}"  name="category[]">
                            @endif --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="round_cut_lab_range_slider mt-md-0 row">
                        <div class="round_cut_lab_diamonds_heading col-lg-12 mb-2">price</div>
                        <div class="round_cut_lab_diamonds_price col-lg-12">
                            <div class="align-items-center mb-2 position-relative">
                                <div id="slider-range" class="mb-0"></div>
                                <div class="d-flex mt-3">
                                    <span class="from_text"><input type="numner" name="" id="minimum_price" placeholder="From" class="d-block wire_bangle_input amount_input" value="0"></span>
                                    <span class="to_text"><input type="numner" name="" id="maximum_price" placeholder="To" class="d-block wire_bangle_input amount_input" value="{{ $Maxprice  }}"></span>
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
                <div class="col-md-6">
                    <div class="round_cut_lab_range_slider">
                        <ul class="right_side_ul round_cut_lab_range_slider row">
                            <li class="round_cut_lab_diamonds_heading col-lg-12 mb-2">{{ $attribute->attribute_name }}</li>
                            <div class="col-lg-12">
                                @foreach($attribute->attributeterm as $term)
                                    <div class="form-group mb-3 d-inline-block me-3">
                                        <input type="checkbox" class="common_selector attribute" name="attribute[]"  value="{{ $term->id }}" id="{{ $term->id }}">
                                        <label for="{{ $term->id }}">{{ $term->attrterm_name }}</label>
                                    </div>
                                @endforeach 
                            </div>
                        </ul>
                    </div>
                </div>
                @endforeach    
                    
                    
            </div>
            <div class="row text-end mb-3">
                <div class="col-md-12">
                    <button type="button" id="reSet" class="reset-btn btn-hover-effect btn-hover-effect-black diamond-btn buy_lab_diamonds_btn mt-4">Reset</button>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="wire_bangle_line"></div>
            <div class="row align-items-center w-100">
                <div class="col-sm-6 col-md-6">
                    <div class="my-5 my-xxl-5 wire_bangle_showing_text text-center text-sm-start" id="datacount"></div>
                </div>
                <div class="col-sm-6 col-md-6 text-center text-sm-end mb-sm-0 d-flex justify-content-center justify-content-sm-end">
                    <span class="wire_bangle_select text-start wire_bangle_shop wire_bangle_select_box_sort select_box_option">
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
            <div class="auto-load text-center mt-4 mb-4">
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"  />
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script>
        
        $(document).ready(function(){
            var page = 1;

            

            
          
            $(window).scroll(function () {
                //if($(window).scrollTop() + $(window).height() >= $(document).height() - 500) {
                  
                if($(window).scrollTop() + $(window).height() >= $(document).height()) {   
                    page++;
                    var scroll = 1;
                    filter_data(page,scroll);
                }
            });
            

            filter_data(page);
            
            //$('product-image').hover(function () {
            $('body').on('mouseover', '.product-image', function () {    
            }, function () {
                var product_image = $(this).attr('src');
                var data_id = $(this).attr('data-id');
                $('.main-product-image-'+data_id).attr("src", product_image);
            
            });

            $("#sorting").change(function() {
                filter_data(page);
            });

            function filter_data(page,scroll=0)
            {
               // $('.filter_data').html('<div id="loading" style="" ></div>');
                var keyword = "{{ isset($_GET['s'])?$_GET['s']:"" }}";
                var action = 'fetch_data';
                var minimum_price = $('#hidden_minimum_price').val();
                var maximum_price = $('#hidden_maximum_price').val();
                var minimum_price_input = $('#minimum_price').val();
                var maximum_price_input = $('#maximum_price').val();
                var category = get_filter('category');
                var attribute = get_filter('attribute');
                var specification = get_filter('specification');
                var sorting = $('#sorting :selected').val();
                $.ajax({
                    url:"{{ url('/product-filter') }}?page=" + page,
                    method:"POST",
                    data:{action:action,keyword:keyword,minimum_price_input:minimum_price_input,maximum_price_input:maximum_price_input,minimum_price:minimum_price,maximum_price:maximum_price,category:category,sorting:sorting,attribute:attribute,specification:specification,_token: '{{ csrf_token() }}'},
                    beforeSend: function() {
                        $('.auto-load').show();
                    },
                    success:function(data){
                        if(scroll == 1){
                            if (data['output'] == "") {
                                $('.auto-load').html("We don't have more data to display ");
                                return;
                            }
                            $('.auto-load').hide(); 
                            $('.filter_data').append(data['output']);
       
                        }else{
                            if (data['output'] == "") {
                                $('.auto-load').html("We don't have more data to display ");
                                return;
                            }else{
                                $('.auto-load').hide();
                                $('.filter_data').html(data['output']);
                            }
                            
                        }
                        
                        $('#datacount').html('showing '+ data['datacount'] +' results');
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

            $(".amount_input").keyup(function(){
                filter_data(page);  
            });

            ['minimum_price', 'maximum_price'].map(x => document.getElementById(x)).forEach(x => x.addEventListener('change', function (e) {
            let [minimum_price, maximum_price] = $("#slider-range").slider('values');
            if (e.target.id === 'minimum_price') {
                minimum_price = parseInt(e.target.value, 10);
            } else if (e.target.id === 'maximum_price') {
                maximum_price = parseInt(e.target.value, 10);
            }

            $( "#slider-range" ).slider({
            values: [ minimum_price, maximum_price],
            });

            $( "#amount-start" ).html( "$" + minimum_price);
            $( "#amount-end" ).html( " $" + maximum_price);

            }));


            $(function() {
                
                var maxPrice = '{{ $Maxprice  }}';
                
                $( "#slider-range" ).slider({
                range: true,
                min: 0,
                max: maxPrice,
                values: [ 0, maxPrice],
                slide: function (_, { values: [min, max] }) {
                    $( "#amount-start" ).html( "$" + min);
                    $( "#amount-end" ).html( " $" + max );
                    $( "#hidden_minimum_price" ).val(min);
                    $( "#minimum_price" ).val(min);
                    $( "#hidden_maximum_price" ).val(max);
                    $( "#maximum_price" ).val(max);
                    filter_data();
                }

                });
                //$( "#amount" ).html( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );
                $( "#amount-start" ).html(" $" + $( "#slider-range" ).slider( "values", 0 ) );
                $( "#amount-end" ).html( " $" + $( "#slider-range" ).slider( "values", 1 ) );
            
            });

        });

    
</script>


@endsection