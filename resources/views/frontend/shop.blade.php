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
                        <div class="row">
                            <div class="round_cut_lab_diamonds_heading col-lg-12 mb-2">category</div>
                            <div class="wire_bangle_carat col-lg-12">
                                @foreach($Categories as $category)
                                <span class="form-check d-inline-block position-relative me-1 ps-0 mb-3">
                                        <input class="form-check-input category common_selector" type="checkbox" {{ ($CatId == $category->id) ? "checked" : "" }} value="{{ $category->id}}"  name="category[]" id="category{{ $category->id}}">
                                        <label class="form-check-label wire_bangle_carat_label" for="category{{ $category->id}}">
                                            {{ $category->category_name }}
                                    </label>
                                </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="round_cut_lab_range_slider mt-3 mt-md-0 row">
                            <div class="round_cut_lab_diamonds_heading col-lg-12 mb-2">price</div>
                            <div class="round_cut_lab_diamonds_price col-lg-12">
                                <div class="d-flex align-items-center mb-2 position-relative">
                                    <span class="from_text me-2"><input type="numner" name="" id="minimum_price" placeholder="From" class="d-block wire_bangle_input amount_input"></span>
                                    <span class="to_text me-2"><input type="numner" name="" id="maximum_price" placeholder="To" class="d-block wire_bangle_input amount_input"></span>
                                    <div id="slider-range" class="mb-0"></div>
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
                        <div class="round_cut_lab_range_slider mb-xxl-4 mb-4 mt-3 mt-md-0">
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
                
                <div class="container">
                    <div class="wire_bangle_line"></div>
                    <div class="row align-items-center">
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
                        
                            <span class="d-inline-block">
                                <!-- <button class="filter-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M5.8335 9.16665H14.1668V10.8333H5.8335V9.16665ZM3.3335 5.83331H16.6668V7.49998H3.3335V5.83331ZM8.3335 12.5H11.6668V14.1666H8.3335V12.5Z" fill="#0B1727"/>
                                    </svg>
                                    <span>filter</span>
                            </button> -->
                            </span>
                            <form method="post" name="ProductFilter" id="ProductFilter" action="{{ Route('frontend.product.productfilter') }}">
                            @csrf 
                            <!-- <div class="right_side_panel scrollbar" id="style-1">
                            
                                <span> 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x close_icon_svg" viewBox="0 0 16 16">
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </span>
                                
                           
                             </div> -->
                            </form>
                    </div>
                </div>
            
            <!-- <div class="wire_bangle_line"></div> -->
            <div class="row mt-0 mb-5 filter_data">
                
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"  />
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
        
$(document).ready(function(){
    filter_data();

    //$('product-image').hover(function () {
    $('body').on('mouseover', '.product-image', function () {    
    }, function () {
        var product_image = $(this).attr('src');
        var data_id = $(this).attr('data-id');
        $('.main-product-image-'+data_id).attr("src", product_image);
       
    });

    $("#sorting").change(function() {
        filter_data();
    });

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
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
            url:"{{ url('/product-filter') }}",
            method:"POST",
            data:{action:action,minimum_price_input:minimum_price_input,maximum_price_input:maximum_price_input,minimum_price:minimum_price,maximum_price:maximum_price,category:category,sorting:sorting,attribute:attribute,specification:specification,_token: '{{ csrf_token() }}'},
            success:function(data){
                //console.log(data);
                $('.filter_data').html(data['output']);
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
        filter_data();
    });

    $(".amount_input").keyup(function(){
        filter_data();  
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