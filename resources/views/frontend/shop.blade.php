@extends('frontend.layout.layout')

@section('content')
        <div class="background-sub-slider">
            <div class="position-relative">
                <img src="{{ asset('frontend/image/about_us.png') }}" alt="">
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
                            <div class="round_cut_lab_diamonds_heading col-md-1">category</div>
                            <div class="wire_bangle_carat mb-3 col-md-9">
                                @foreach($Categories as $category)
                                <span class="form-check d-inline-block position-relative me-1 ps-0 mb-3">
                                        <input class="form-check-input category common_selector" type="radio" {{ ($CatId == $category->id) ? "checked" : "" }} value="{{ $category->id}}"  name="category[]" id="category{{ $category->id}}">
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
                            <div class="round_cut_lab_diamonds_heading col-md-2">price</div>
                            <div class="round_cut_lab_diamonds_price col-md-10">
                                <div id="slider-range"></div>
                                <p class="mb-0"> Price : <span id="amount"></span></p>
                                <input type="hidden" id="hidden_minimum_price" />
                                <input type="hidden" id="hidden_maximum_price" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="round_cut_lab_range_slider mb-xxl-4 mb-4 mt-3 mt-md-0">
                                    @foreach($Attributes as $attribute)
                                    @if($attribute->is_specification == 0)
                                    <ul class="right_side_ul round_cut_lab_range_slider row">
                                        <li class="round_cut_lab_diamonds_heading col-md-2">{{ $attribute->attribute_name }}</li>
                                        <div class="col-md-10">
                                            @foreach($attribute->attributeterm as $term)
                                                <div class="form-group mb-3 d-inline-block me-3">
                                                    <input type="checkbox" class="common_selector attribute" name="attribute[]"  value="{{ $term->id }}" id="{{ $term->id }}">
                                                    <label for="{{ $term->id }}">{{ $term->attrterm_name }}</label>
                                                </div>
                                            @endforeach 
                                        </div>
                                    </ul>
                                    @else
                                    <ul class="right_side_ul round_cut_lab_range_slider">
                                        <li class="col-md-6">{{ $attribute->attribute_name }}</li>
                                        @foreach($attribute->attributeterm as $term)
                                            <div class="form-group mb-3 d-inline-block">
                                                <input type="checkbox" class="common_selector specification" name="specification[]"  value="{{ $term->id }}" id="{{ $term->id }}">
                                                <label for="{{ $term->id }}">{{ $term->attrterm_name }}</label>
                                            </div>
                                        @endforeach 
                                    </ul>
                                    @endif
                                @endforeach    
                        </div>
                    </div>
                        
                </div>
                
                <div class="container">
                    <div class="wire_bangle_line"></div>
                    <div class="row align-items-center">
                        <div class="col-sm-5 col-md-6">
                            <div class="my-4 my-xxl-5 wire_bangle_showing_text text-center text-sm-start" id="datacount"></div>
                        </div>
                        <div class="col-sm-3 col-md-6 text-center text-sm-end mb-sm-0 d-flex justify-content-center justify-content-sm-end">
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
                <!-- @foreach($Products as $product)

                <div class="col-sm-6 col-lg-4 col-xl-3 mt-3 mt-md-4">
                    <div class="wire_bangle_img mb-3 position-relative">
                        <img src="{{ asset($product->product_variant[0]->images) }}" alt="">

                    </div>
                    <div class="wire_bangle_description">

                        <div class="wire_bangle_heading mb-2 mb-md-3"><a href="{{ URL('/product-details/'.$product->id) }}">{{ $product->primary_category->category_name }}</a></div>
                        <div class="wire_bangle_sub_heading mb-2 mb-md-3">{{ $product->product_title}}</div>
                        <div class="wire_bangle_paragraph mb-2 mb-md-3">
                           {{ $product->desc}}
                        </div>
                        <div class="wire_bangle_price">
                            ${{ $product->product_variant[0]->sale_price}}
                        </div>
                    </div>
                </div>

                @endforeach -->
               
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"  />
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
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
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var category = get_filter('category');
        var attribute = get_filter('attribute');
        var specification = get_filter('specification');
        var sorting = $('#sorting :selected').val();
        $.ajax({
            url:"{{ url('/product-filter') }}",
            method:"POST",
            data:{action:action,minimum_price:minimum_price,maximum_price:maximum_price,category:category,sorting:sorting,attribute:attribute,specification:specification,_token: '{{ csrf_token() }}'},
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
        filter_data();
      }
    });
    $( "#amount" ).html( "$" + $( "#slider-range" ).slider( "values", 0 ) +
     " - $" + $( "#slider-range" ).slider( "values", 1 ) );
     
  });
});
</script>


@endsection