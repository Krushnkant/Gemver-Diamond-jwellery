@extends('frontend.layout.layout')
@section('content')
        <div class="background-sub-slider">
            <div class="">
                <!-- <img src="{{ asset('frontend/image/about_us.png') }}" alt=""> -->
                <div class="about_us_background">
                    <div class="sub_heading mb-lg-3">Blog detail page</div>
                    <div class="about_us_link">
                        <a href="{{ URL('/') }}">home</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none" class="mx-2">
                            <path d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z" fill="white"/>
                            <path d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z" fill="white"/>
                        </svg>
                        <a href="#">blog detail page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row my-3 my-lg-5 d-flex align-items-start">
            <div class="col-lg-8 col-xl-9 px-0 px-lg-3">
                <div class="blog-detail-main-img">
                    <img src="{{ asset($blog->blog_thumb)  }}" alt="{{ $blog->category->category_name }}">
                </div>
                <div class="blog-detail-sub-heading mt-2">
                {{ $blog->category->category_name }}
                </div>
                <div class="blog-detail-heading my-2">
                {{ $blog->title }}
                </div>
                <div class="blog-detail-img-date d-flex align-items-center">
                    <!-- <span class="blog-detail-img"><img src="{{ asset('frontend/image/icon-1.png') }}" alt=""></span>                   -->
                    <span class="blog-deatil-date">{{ date('d M, Y', strtotime($blog->created_at)) }}</span>
                </div>
                <div class="blog-detail-paragraph mt-2">
                    {!! $blog->description !!}
                </div>
            </div>
            <div class="col-lg-4 col-xl-3 blog-detail-sidebar px-0 px-lg-3">
                <div class="blog-detail-post-heading">
                    Recent Post
                </div>

                @foreach($blogs as $lblog)
                <div class="row mt-3 d-flex align-items-center">
                    <div class="col-3 col-lg-4 px-0">
                        <div class="blog-detail-sidebar-img position-relative">
                            <img src="{{ asset($lblog->blog_thumb)  }}" alt="">
                        </div>
                    </div>
                    <div class="col-9 col-lg-8 px-0 px-3 pe-3">
                        <div class="blog-detail-paragraph">
                            <a href=" {{ url('/blog/'.$lblog->id) }} ">{{ $lblog->title }}</a>
                        </div>
                    </div>
                </div>
                @endforeach
                    
                    @if(isset($BlogBanners) && $BlogBanners != "")
                    <?php 
                        $url = "";
                        if($BlogBanners['0']['dropdown_id'] == 1){
                            $url = url('/shop/'.$BlogBanners['0']['value']); 
                        }elseif($BlogBanners['0']['dropdown_id'] == 2){
                            $Product = \App\Models\Product::where('id',$BlogBanners['0']['value'])->first();
                            $cat_id = $Product->primary_category_id;
                            $var_id = $Product->product_variant[0]->id;
                            $url = url('/product-details/'.$BlogBanners['0']['value'].'/'.$var_id);
                        }
                    ?>
                    <div class="mt-3">
                       <a href="{{ $url }}"><img src="{{ url($BlogBanners['0']['banner_thumb']) }}" alt=""></a>
                    </div>
                    
                    @endif


            
                    @if(isset($mostviewproducts) && $mostviewproducts != "")
                        <div class="blog-detail-post-heading mt-4">
                            Most Viewed
                        </div>
                        @foreach($mostviewproducts as $key => $mostviewproduct)
                        <?php 
                          $productimages = explode(',',$mostviewproduct->product_variant[0]->images);
                          $producturl = url('product-details/'.$mostviewproduct->id.'/'.$mostviewproduct->product_variant[0]->id); 
                        ?>
                        <div class="mt-3 d-flex align-items-center">
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
                        @endforeach
                    @endif
                    
                   
                    @if(isset($BlogBanners) && $BlogBanners != "")
                        @foreach($BlogBanners as $key => $BlogBanner)
                            <?php 
                            $url = "";
                            if($BlogBanner['dropdown_id'] == 1){
                             $url = url('/shop/'.$BlogBanner['value']); 
                            }elseif($BlogBanner['dropdown_id'] == 2){
                            $Product = \App\Models\Product::with('product_variant')->where('id',$BlogBanner['value'])->first();
                             //dd($Product->product_variant[0]->id);
                             $cat_id = $Product->primary_category_id;
                             $var_id = $Product->product_variant[0]->id;
                             $url = url('/product-details/'.$cat_id.'/'.$var_id);
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
    @endsection



    