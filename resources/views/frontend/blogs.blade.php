@extends('frontend.layout.layout')

@section('content')
<div class="background-sub-slider">
        <div class="position-relative">
            <img src="{{ asset('frontend/image/about_us.png') }}" alt="">
            <div class="about_us_background">
                <div class="sub_heading mb-lg-3">Blog</div>
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
                        <div class="blog_filter_btn d-md-none">
                            filter btn
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                        <ul class="nav nav-tabs blog_filter_btn_ul" id="myTab" role="tablist">
                            <li class="nav-item category" >
                                <button class="nav-link active common_selector"  data-bs-toggle="tab" data-value=""  type="button" role="tab" aria-controls="home" aria-selected="true">
                                    <span class="ms-1">
                                        All Blogs
                                    </span>
                                </button>
                            </li>

                            @foreach($Categories as $Category)
                            <li class="nav-item category">
                                <button class="nav-link common_selector" id="category-tab" data-value="{{ $Category->id }}" data-bs-toggle="tab" role="tab" aria-controls="profile" aria-selected="false">
                                    <span class="ms-1">{{ $Category->category_name }}</span>
                                </button>
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
                        Recent Post
                    </div>
                    <div class="mt-3 d-flex align-items-center">
                        <div class="px-0">
                            <div class="blog-sidebar-top-selling position-relative">
                                <img src="{{ asset('frontend/image/top_selling_2.png') }}" alt="">
                            </div>
                        </div>
                        <div class="px-0 ms-3">
                            <div class="blog-detail-paragraph">
                                <a href="#" class="top_selling_heading mb-2 d-inline-block">Unique Diamond Pendant</a>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <img src="{{ asset('frontend/image/blog-sidebar.png') }}" alt="">
                    </div>
                    <div class="blog-detail-post-heading mt-4">
                        Top Selling
                    </div>
                    <div class="mt-3 d-flex align-items-center">
                        <div class="px-0">
                            <div class="blog-sidebar-top-selling position-relative">
                                <img src="{{ asset('frontend/image/top_selling_1.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col-9 col-lg-8 px-0 ms-3">
                            <div class="blog-detail-paragraph">
                                <a href="#" class="top_selling_heading mb-2 d-inline-block">Unique Diamond Pendant</a>
                                <div class="top_selling_price">$ 1490</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 d-flex align-items-center">
                        <div class="px-0">
                            <div class="blog-sidebar-top-selling position-relative">
                                <img src="{{ asset('frontend/image/top_selling_2.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col-9 col-lg-8 px-0 ms-3">
                            <div class="blog-detail-paragraph">
                                <a href=" # " class="top_selling_heading mb-2 d-inline-block">Fancy Gold Bracelet</a>
                                <div class="top_selling_price">$ 2,845</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 d-flex align-items-center">
                        <div class="px-0">
                            <div class="blog-sidebar-top-selling position-relative">
                                <img src="{{ asset('frontend/image/top_selling_3.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col-9 col-lg-8 px-0 ms-3">
                            <div class="blog-detail-paragraph">
                                <a href="#" class="top_selling_price mb-2 d-inline-block">Moissanite Rose Ring </a>
                                <div class="top_selling_price">$ 860</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 d-flex align-items-center">
                        <div class="px-0">
                            <div class="blog-sidebar-top-selling position-relative">
                                <img src="{{ asset('frontend/image/top_selling_4.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col-9 col-lg-8 px-0 ms-3">
                            <div class="blog-detail-paragraph">
                                <a href="#" class="top_selling_price mb-2 d-inline-block">lakshmi Bangles</a>
                                <div class="top_selling_price">$ 2,500</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <img src="{{ asset('frontend/image/blog-sidebar-2.png') }}" alt="">
                    </div>
                </div>
            </div>
          
        </div>
    </div>

    <script>
        
        $(document).ready(function(){
            filter_data();
            $("#sorting").change(function() {
                filter_data();
            });
        
            function filter_data()
            {
                $('.blogs-fetch').html('<div id="loading" style="" ></div>');
                var action = 'fetch_data';
                var category = get_filter('category');
                $.ajax({
                    url:"{{ url('/blogs-filter') }}",
                    method:"POST",
                    data:{action:action,category:category,_token: '{{ csrf_token() }}'},
                    success:function(data){
                        $('.blogs-fetch').html(data['output']);
                    }
                });
            }
        
            function get_filter(class_name)
            {
                var cattab = $(".category .active");
                var cattabval = cattab.attr("data-value");
              
                return cattabval;
            }
        
            $('.common_selector').click(function(){
                filter_data();
            });

            $(document).on('click','.cat-details',function(){
                var cat_id = $(this).attr("data-value");
                window.location.href = "{{ url('/blog/') }}" +'/'+ cat_id ;
            });
    
        });
        </script>

@endsection

  