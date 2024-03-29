@extends('frontend.layout.layout')

@section('content')
<div class="background-sub-slider">
        <div class="">
            <div class="about_us_background">
                <h1 class="sub_heading mb-lg-3">Blog</h1>
                <div class="about_us_link">
                    <a href="{{ URL('/') }}">home</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none" class="mx-2">
                        <path d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z" fill="white"/>
                        <path d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z" fill="white"/>
                    </svg>
                    <a href="#">Blog</a>
                </div>
            </div>
        </div>
    </div>
       
    <div class="container my-5">
            <div class="row d-flex align-items-start">
                <div class="col-lg-8 col-xl-9 px-0 mb-3">
                    <div class="blog_tabs">
                        <ul class="nav nav-tabs owl-carousel owl-theme blog-tabs" id="myTab" role="tablist">
                            <li class="nav-item category blog_tab_input item">
                                <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                <label class="form-check-label nav-link active common_selector blog-tabs-active-part" for="flexRadioDefault1" data-bs-toggle="tab" data-value=""  type="button" role="tab" aria-controls="home" aria-selected="true">
                                    <span class="ms-1">
                                        All Blogs
                                    </span>
                                </label>
                            </li>

                            @foreach($Categories as $Category)
                            <li class="nav-item category blog_tab_input item">
                                <input class="form-check-input common_selector blog-input" type="checkbox" name="category_id" id="category_id{{ $Category->id }}" value="{{ $Category->id }}">
                                <label for="category_id{{ $Category->id }}" class=" form-check-label nav-link active nav-link blog-label" id="category-tab" data-value="{{ $Category->id }}" data-bs-toggle="tab" role="tab" aria-controls="profile" aria-selected="false">
                                    <span class="ms-1">
                                        {{ $Category->category_name }}
                                    </span>
                                </label>
                            </li>
                            @endforeach
                            
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active mt-3 mt-xxl-5"  role="tabpanel" >
                                <div class="row blogs-fetch">
                                    <div class=""></div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3 blog-detail-sidebar px-0 px-lg-3 mt-0">
                    <div class="blog-detail-post-heading">
                        Popular Post
                    </div>
                    @foreach($blogs as $lblog)
                        <div class="row mt-3 d-flex align-items-center item">
                            <div class="col-3 col-lg-4 px-0">
                                <div class="blog-detail-sidebar-img position-relative">
                                    <img src="{{ asset($lblog->blog_thumb)  }}" alt="">
                                </div>
                            </div>
                            <div class="col-9 col-lg-8 px-0 px-3 pe-3 ps-0">
                                <div class="blog-detail-paragraph">
                                    <a href=" {{ url('blog/'.$lblog->slug) }} ">{{ $lblog->title }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if(isset($BlogBanners) && $BlogBanners != "")
                    <?php 
                          
                        $url = "";
                        if(isset($BlogBanners[0]['dropdown_id']) && $BlogBanners[0]['dropdown_id'] == 1){
                            $category = \App\Models\Category::where('estatus',1)->where('id',$BlogBanners[0]['value'])->first();
                            $url = isset($category->slug)?url('shop/'.$category->slug):"";
                        }elseif(isset($BlogBanners[0]['dropdown_id']) && $BlogBanners[0]['dropdown_id'] == 2){
                            $Product = \App\Models\Product::where('id',$BlogBanners[0]['value'])->first();
                            if(isset($Product->product_variant)){
                                $cat_id = $Product->primary_category_id;
                                $var_id = $Product->product_variant[0]->id;
                                $slug = $Product->product_variant[0]->slug;
                                $url = url('product-details/'.$slug);
                            }else{
                                $url = "#";
                            }
                        }
                    ?>
                    <div class="mt-3">
                        <a href="{{ $url }}"><img src="{{ isset($BlogBanners[0]['banner_thumb'])?url($BlogBanners[0]['banner_thumb']):''  }}" alt=""></a>
                    </div>
                    
                    @endif

                    
                   
                    @if(isset($mostviewproducts) && count($mostviewproducts) > 0)
                        <div class="blog-detail-post-heading mt-4">
                            Most Viewed Product
                        </div>
                        <div class="owl-carousel owl-theme most-viewed-slider">
                        @foreach($mostviewproducts as $key => $mostviewproduct)
                        <?php 
                          if(isset($mostviewproduct->product_variant[0]->images)){
                          $productimages = explode(',',$mostviewproduct->product_variant[0]->images);
                          $producturl = url('product-details/'.$mostviewproduct->product_variant[0]->slug); 
                         
                        ?>
                       
                            <div class="mt-3 d-flex align-items-center item">
                                <div class="px-0">
                                    <div class="blog-sidebar-top-selling position-relative">
                                        <img src="{{ asset($productimages['0']) }}" alt="">
                                    </div>
                                </div>
                                <div class="col-9 col-lg-8 px-0 ms-3">
                                    <div class="blog-detail-paragraph">
                                        <a href="{{ $producturl }}" class="top_selling_heading mb-2 d-inline-block">{{ $mostviewproduct->product_title }}</a>
                                        <div class="top_selling_price">$ {{ $mostviewproduct->product_variant[0]->sale_price }}</div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        @endforeach
                        </div>

                    @endif

                    
                    @if(isset($BlogBanners) && $BlogBanners != "")
                        @foreach($BlogBanners as $key => $BlogBanner)
                            <?php 
                            $url = "";
                            if($BlogBanner['dropdown_id'] == 1){
                            $category = \App\Models\Category::where('estatus',1)->where('id',$BlogBanner['value'])->first();
                            $url = isset($category->slug)?url('shop/'.$category->slug):"";
                            }elseif($BlogBanner['dropdown_id'] == 2){
                            $Product = \App\Models\Product::with('product_variant')->where('id',$BlogBanner['value'])->first();
                             if(isset($Product->product_variant)){
                                $cat_id = $Product->primary_category_id;
                                $var_id = $Product->product_variant[0]->id;
                                $slug = $Product->product_variant[0]->slug;
                                $url = url('product-details/'.$slug);
                             }else{
                                $url ="#";
                             }
                            }
                            
                            ?>
                            @if($key != 0)
                                <div class="mt-4">
                                    <a href="{{ $url }}"><img src="{{ url($BlogBanner['banner_thumb']) }}" alt=""></a>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
          
        </div>
    </div>

    <script>
        
        $(document).ready(function(){
            var page = 1;
            filter_data(page);
            $(window).scroll(function () {
                if($(window).scrollTop() + $(window).height() >= $(document).height() - 500) {
                    page++;
                    var scroll = 1;
                    filter_data(page,scroll);
                }
            });
        
            function filter_data(page,scroll=0)
            {
                var action = 'fetch_data';
                var category = get_filter('category');
             
                $.ajax({
                    url:"{{ url('/blogs-filter?page=') }}"+ page,
                    method:"POST",
                    data:{action:action,category:category,_token: '{{ csrf_token() }}'},
                    success:function(data){
                        console.log(data);
                        
                        if(scroll == 1){
                            console.log('scroll');
                            if(data['output'] != ""){
                                $('.blogs-fetch').append(data['output']); 
                            }
                        }else{
                            $('.blogs-fetch').html(data['output']); 
                        }
                    }
                });
            }
        
            function get_filter(class_name)
            {
                var cattab = $(".category .active");
                var cattabval = cattab.attr("data-value");
                
                var radioValue = $("input[name='category_id']:checked").val();
              
                return radioValue;
            }
        
            $('.common_selector').click(function(){
                var page = 1;
                filter_data(page);
            });

            $(document).on('click','.cat-details',function(){
                var cat_id = $(this).attr("data-value");
                window.location.href = "{{ url('/blog/') }}" +'/'+ cat_id ;
            });
    
        });
        </script>

@endsection

  