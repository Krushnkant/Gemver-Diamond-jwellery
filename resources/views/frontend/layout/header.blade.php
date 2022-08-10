    <div class="home-page-slider-header @if(Request::route()->getName() != 'frontend.home') sub_header @endif">
        <div class="home-page-bg">
                    <div class="container">
                        <div class="row mt-0 mb-0 align-items-center">
                            <div class="col-md-4 col-lg-3 text-center">
                                <div class="home-page-header">
                                    <a class="header-icon-part" href="tel:{{ $settings->company_mobile_no }}" ><span class="me-3 header-icon"><i class="fa-solid fa-phone me-2"></i> Call Us </span></a>
                                    <a class="header-icon-part" href="mailto:{{ $settings->company_email }}" ><span class="me-3 header-icon"><i class="fa-solid fa-envelope me-2"></i> Email </span></a>
                                    <a class="header-icon-part" href="https://api.whatsapp.com/send?phone={{ $settings->company_mobile_no }}" target="_blank" ><span class="header-icon"><i class="fa-brands fa-whatsapp"></i> Chat </span></a>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-9 text-end">
                                <div class="home-page-header">
                                  <?php 
                                      $offers = \App\Models\Offer::where('estatus',1)->get();
                                  ?>
                                    <marquee>
                                        @foreach($offers as $offer)
                                        <span class="me-3 header-icon" style="padding-right:300px;" >{{ $offer->title }}</span>
                                        @endforeach
                                    </marquee>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="row align-items-center header_row">
                <div class="col-6 col-lg-12 mb-md-3">
                    <div class="logo-image header-logo mx-lg-auto">
                        <a href="{{ URL('/') }}">
                            <img src="{{ URL('images/company/'.$settings->company_logo) }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-6 col-lg-12 text-center header">
                    <div class="mobile-menu text-end text-lg-center">
                        <div id="nav-icon1" class="d-block d-lg-none">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <!-- <div class="sub-pack">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" fill="none" class="mobile-sub-menu-icon">
                                <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z" fill="#000"/>
                            </svg>
                        </div> -->
                      
                        <ul class="mobile-sub-menu">
                            <div id="nav-icon1" class="mega-menu-mobile-icon d-block d-lg-none open">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <li class="{{ (request()->is('/')) ? 'active' : '' }}" ><a href="{{ URL('/') }}">home</a></li>
                            <?php 
                                $megamenu = \App\Models\MegaMenu::where('estatus',1)->where('id',4)->first();
                                //dd($megamenu->sub_menu);
                                if($megamenu != ""){   
                            ?>
                            <li class="{{ (request()->segment(1) == 'lad-diamond') ? 'active' : '' }}" ><a href="# ">{{  $megamenu->title }}
                                <svg xmlns="http://www.w3.org/2000/svg " width="12 " height="8 " viewBox="0 0 12 8 " fill="none " class="mobile-menu-icon ">
                                    <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z " fill="white "/>
                                    </svg>
                                </a>
                                <div class="mega-menu ">
                                    <div class="sub-pack">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" fill="none" class="mobile-sub-menu-icon">
                                            <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z" fill="#000"/>
                                        </svg>
                                    </div>
                                    <div id="nav-icon1" class="mega-menu-mobile-icon d-block d-lg-none open">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    
                                    <div class="mega-menu-two-three-part mega-menu-three-part">
                                        <div>
                                                <div class="d-block">
                                                    <span class="menus_title menus_title_part">loose lab diamonds</span>
                                                </div>
                                                <ul class="mega-menu-diamond-part">
        
                                                    <li>
                                                        <a href="{{ url('/lad-diamond/ROUND') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/round.png') }}" alt="ROUND" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-3 d-inline-block">round</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lad-diamond/HEART') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/heart.png') }}" alt="HEART" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-3 d-inline-block">heart</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lad-diamond/PRINCESS') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/princess.png') }}" alt="PRINCESS" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-3 d-inline-block">princess</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lad-diamond/PEAR') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/pear.png') }}" alt="PEAR" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-3 d-inline-block">pear</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lad-diamond/OVAL') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/oval.png') }}" alt="OVAL" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-3 d-inline-block">oval</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lad-diamond/CUSHION') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/cushion.png') }}" alt="CUSHION" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-3 d-inline-block">cushion</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lad-diamond/EMERALD') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/emerald.png') }}" alt="EMERALD" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-3 d-inline-block">emerald</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lad-diamond/MARQUISE') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/marquise.png') }}" alt="MARQUISE" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-3 d-inline-block">marquise</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lad-diamond/ASSCHER') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/asscher.png') }}" alt="ASSCHER" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-3 d-inline-block">asscher</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lad-diamond/RADIANT') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/radiant.png') }}" alt="RADIANT" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-3 d-inline-block">radiant</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            
                                            <ul>
                                                <img src="{{ url('images/megamenu/'.$megamenu->menu_thumb) }}" alt="">
                                            </ul>
                                          
                                    </div>
                                </div>
                            </li>
                            <?php } ?>
                            <?php 
                                $megamenu = \App\Models\MegaMenu::with('sub_menu.sub_category.category')->where('estatus',1)->where('id',1)->first();
                                //dd($megamenu->sub_menu);
                                if($megamenu != ""){   
                            ?>
                            <li class="" ><a href="#">{{ $megamenu->title }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" fill="none" class="mobile-menu-icon">
                                    <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z" fill="white"/>
                                    </svg>
                                </a>
                                
                                <div class="mega-menu">
                                    <div class="sub-pack">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" fill="none" class="mobile-sub-menu-icon">
                                            <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z" fill="#000"/>
                                        </svg>
                                    </div>
                                    <div id="nav-icon1" class="mega-menu-mobile-icon d-block d-lg-none open">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <?php
                                        $menu_no = 1;
                                        $menu_colum = "two";
                                        foreach($megamenu->sub_menu as $sub1)
                                        {
                                            if(count($sub1->sub_category) > 0){
                                                if($menu_no == 1){
                                                    $menu_colum = "two"; 
                                                }else if($menu_no == 2){
                                                    $menu_colum = "three";
                                                }else if($menu_no == 3){
                                                    $menu_colum = "four";
                                                }else{
                                                    $menu_colum = "four";
                                                }
                                                $menu_no = ++$menu_no;
                                            }
                                        }
                                       
                                    ?>
                                    <div class="mega-menu-{{ $menu_colum }}-part {{$menu_no}}">
                                        <?php
                                        foreach($megamenu->sub_menu as $sub)
                                        {
                                        if(count($sub->sub_category) > 0){
                                        ?>
                                        <ul>
                                            <li>
                                                <span class="menus_title">{{ $sub->title }}</span>
                                            </li>   
                                        <?php 
                                          foreach($sub->sub_category as $car)
                                          {
                                            if($car->icon != ""){
                                                $icon = url('images/categoryicon/'.$car->icon);
                                            }else{
                                                $icon = url($car->category->category_thumb);
                                            }
                                            ?>
                                            <li>
                                                <a href="{{ URL('/shop/'.$car->category_id)}}">
                                                    <img src="{{ $icon }}" alt="" class="diamond-mega-menu-img "> <span class="ms-3 ms-lg-2">{{ $car->title }}</span>
                                                </a>
                                            </li>
                                            <?php 
                                          }
                                        ?>
                                        </ul>
                                        <?php
                                         
                                        }
                                         }
                                        ?>
                                        <ul class="">
                                            <li class="menu-part-img"><img src="{{ url('images/megamenu/'.$megamenu->menu_thumb) }}" alt=" "></li>
                                        </ul>
                                    </div>
                                </div>
                                
                            </li>
                            <?php } ?>
                            <?php 
                                $megamenu = \App\Models\MegaMenu::with('sub_menu.sub_category.category')->where('estatus',1)->where('id',2)->first();
                                //dd($megamenu->sub_menu);
                                if($megamenu != ""){   
                            ?>

                            <li class="" ><a href="#">{{ $megamenu->title }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" fill="none" class="mobile-menu-icon">
                                    <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z" fill="white"/>
                                    </svg>
                                </a>
                               
                                <div class="mega-menu">
                                    <div class="sub-pack">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" fill="none" class="mobile-sub-menu-icon">
                                            <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z" fill="#000"/>
                                        </svg>
                                    </div>
                                    <div id="nav-icon1" class="mega-menu-mobile-icon d-block d-lg-none open">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <?php
                                        $menu_no = 1;
                                        $menu_colum = "two";
                                        foreach($megamenu->sub_menu as $sub1)
                                        {
                                            if(count($sub1->sub_category) > 0){
                                                if($menu_no == 1){
                                                    $menu_colum = "two"; 
                                                }else if($menu_no == 2){
                                                    $menu_colum = "three";
                                                }else if($menu_no == 3){
                                                    $menu_colum = "four";
                                                }else{
                                                    $menu_colum = "four";
                                                }
                                                $menu_no = ++$menu_no;
                                            }
                                        }
                                       
                                    ?>
                                    <div class="mega-menu-{{ $menu_colum }}-part ">
                                        <?php
                                        foreach($megamenu->sub_menu as $sub)
                                        {
                                           if(count($sub->sub_category) > 0){
                                        ?>
                                        <ul>
                                            <li>
                                                <span class="menus_title">{{ $sub->title }} </span>
                                            </li>   
                                        <?php 
                                          foreach($sub->sub_category as $car)
                                          {
                                            if($car->icon != ""){
                                                $icon = url('images/categoryicon/'.$car->icon);
                                            }else{
                                                $icon = url($car->category->category_thumb);
                                            }
                                            ?>
                                            <li>
                                                <a href="{{ URL('/shop/'.$car->category_id)}}">
                                                    <img src="{{ $icon }}" alt="" class="diamond-mega-menu-img "> <span class="ms-3 ms-lg-2">{{ $car->title }}</span>
                                                </a>
                                            </li>
                                            <?php 
                                            
                                          }
                                        ?>
                                        </ul>
                                        <?php
                                        }
                                         }
                                        ?>
                                        <ul class="">
                                            <li class="menu-part-img"><img src="{{ url('images/megamenu/'.$megamenu->menu_thumb) }}" alt=" "></li>
                                        </ul>
                                    </div>
                                </div>
                                
                            </li>
                            <?php } ?>

                            <?php 
                                $megamenu = \App\Models\MegaMenu::with('sub_menu.sub_category.category')->where('estatus',1)->where('id',3)->first();
                                //dd($megamenu->sub_menu);
                                if($megamenu != ""){   
                            ?>

                            <li class="" ><a href="#">Fine Jewelry 
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" fill="none" class="mobile-menu-icon">
                                    <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z" fill="white"/>
                                    </svg>
                                </a>
                                
                                <div class="mega-menu">
                                    <div class="sub-pack">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" fill="none" class="mobile-sub-menu-icon">
                                            <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z" fill="#000"/>
                                        </svg>
                                    </div>
                                    <div id="nav-icon1" class="mega-menu-mobile-icon d-block d-lg-none open">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <?php
                                        $menu_no = 1;
                                        $menu_colum = "two";
                                        foreach($megamenu->sub_menu as $sub1)
                                        {
                                            if(count($sub1->sub_category) > 0){
                                                if($menu_no == 1){
                                                    $menu_colum = "two"; 
                                                }else if($menu_no == 2){
                                                    $menu_colum = "three";
                                                }else if($menu_no == 3){
                                                    $menu_colum = "four";
                                                }else{
                                                    $menu_colum = "four";
                                                }
                                                $menu_no = ++$menu_no;
                                            }
                                        }
                                       
                                    ?>
                                    <div class="mega-menu-{{ $menu_colum }}-part ">
                                        <?php
                                        foreach($megamenu->sub_menu as $sub)
                                        {
                                           if(count($sub->sub_category) > 0){
                                        ?>
                                        <ul>
                                            <li>
                                                <span class="menus_title">{{ $sub->title }} </span>
                                            </li>   
                                        <?php 
                                        foreach($sub->sub_category as $car)
                                        {
                                            if($car->icon != ""){
                                                $icon = url('images/categoryicon/'.$car->icon);
                                            }else{
                                                $icon = url($car->category->category_thumb);
                                            }
                                        ?>
                                            <li>
                                                <a href="{{ URL('/shop/'.$car->category_id)}}">
                                                    <img src="{{ $icon }}" alt="" class="diamond-mega-menu-img "> <span class="ms-3 ms-lg-2">{{ $car->title }}</span>
                                                </a>
                                            </li>
                                        <?php 
                                        }
                                        ?>
                                        </ul>
                                        <?php
                                        }
                                        }
                                        ?>
                                        <ul class="">
                                            <li class="menu-part-img"><img src="{{ url('images/megamenu/'.$megamenu->menu_thumb) }}" alt=" "></li>
                                        </ul>
                                    </div>
                                </div>
                                
                            </li>
                            <?php } ?>
                            <!--<li>-->
                            <!--    <a href="# ">collections-->
                            <!--    <svg xmlns="http://www.w3.org/2000/svg " width="12 " height="8 " viewBox="0 0 12 8 " fill="none " class="mobile-menu-icon ">-->
                            <!--    <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z " fill="white "/>-->
                            <!--    </svg>-->
                            <!--</a>-->
                            <!--    <div class="mega-menu">-->
                            <!--        <div class="mega-menu-two-part ">-->
                            <!--            <ul>-->
                            <!--                <li>-->
                            <!--                    <span class="menus_title ">create your own ring</span>-->
                            <!--                </li>-->
                            <!--                <li>-->
                            <!--                    <a href="# ">-->
                            <!--                        <img src="{{ asset('frontend/image/mega-menu-img-1.png') }}" alt=" " class="mega-menu-img "> <span class="ms-2 ">Start with a Setting</span></a>-->
                            <!--                </li>-->
                            <!--                <li>-->
                            <!--                    <a href="# "><img src="{{ asset('frontend/image/mega-menu-img-2.png') }}" alt=" " class="mega-menu-img "><span class="ms-2 ">Start with a Lab Diamond</span></a>-->
                            <!--                </li>-->
                            <!--            </ul>-->
                            <!--            <ul>-->
                            <!--                <img src="{{ asset('frontend/image/category-1.png') }} " alt=" ">-->
                            <!--            </ul>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</li>-->
                            <?php 
                                $megamenu = \App\Models\MegaMenu::where('estatus',1)->where('id',5)->first();
                                if($megamenu != ""){   
                            ?>
                            
                            <li class="{{ (request()->segment(1) == 'diamond-setting' || request()->segment(1) == 'product-setting' || request()->segment(1) == 'diamond-details' || request()->segment(1) == 'custom-product-details') ? 'active' : '' }}" ><a href="# ">{{ $megamenu->title }}
                                <svg xmlns="http://www.w3.org/2000/svg " width="12 " height="8 " viewBox="0 0 12 8 " fill="none " class="mobile-menu-icon ">
                                    <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z " fill="white "/>
                                    </svg>
                                </a>
                                <div class="mega-menu ">
                                    <div class="sub-pack">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" fill="none" class="mobile-sub-menu-icon">
                                            <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z" fill="#000"/>
                                        </svg>
                                    </div>
                                    <div id="nav-icon1" class="mega-menu-mobile-icon d-block d-lg-none open">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <div class="mega-menu-four-part ">
                                        <div>
                                    <?php 
                                         $categories = \App\Models\Category::where('estatus',1)->where('is_custom',1)->get();
                                         $img_no = 1;
                                         $cat_no = 1;
                                         foreach($categories as $car)
                                         {
                                            
                                            if($img_no == 1){
                                               $defalt_image = $car->category_thumb;
                                            }
                                            $img_no++; 
                                            ?>
                                        <ul>
                                            <li>
                                                <span class="menus_title ">create your own {{ $car->category_name }}</span>
                                            </li>
                                            <li>
                                                <a href="{{ URL('/product-setting/'.$car->id)}}" class="d-flex">
                                                    <img src="{{ url($car->category_thumb) }}" alt=" " class="mega-menu-img "> <span class="ms-3 ms-lg-2">Start with a Setting</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ URL('/diamond-setting/'.$car->id)}}" class="d-flex"><img src="{{ url('frontend/image/mega-menu-img-2.png') }}" alt=" " class="mega-menu-img "><span class="ms-3 ms-lg-2">Start with a Lab Diamond</span></a>
                                            </li>
                                        </ul>

                                        <?php $cat_no++;  } ?>
                                        </div>
                                       
                                            <ul>
                                                <img src="{{ url('images/megamenu/'.$megamenu->menu_thumb) }}" alt="">
                                            </ul>
                                        
                                    </div>
                                </div>
                            </li>
                            <?php } ?>

                            <?php 
                                $megamenu = \App\Models\MegaMenu::where('estatus',1)->where('id',6)->first();
            
                                if($megamenu != ""){   
                            ?>
                            
                            <li class="{{ (request()->is('infopage*')) ? 'active' : '' }}">
                                <a href="#">{{ $megamenu->title }}
                                <svg xmlns="http://www.w3.org/2000/svg " width="12 " height="8 " viewBox="0 0 12 8 " fill="none " class="mobile-menu-icon ">
                                    <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z " fill="white "/>
                                </svg>
                                </a>
                                <div class="mega-menu ">
                                    <div class="sub-pack">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" fill="none" class="mobile-sub-menu-icon">
                                            <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z" fill="#000"/>
                                        </svg>
                                    </div>
                                    <div id="nav-icon1" class="mega-menu-mobile-icon d-block d-lg-none open">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <div class="mega-menu-four-part ">
                                        <ul>
                                            <li>
                                                <span class="menus_title">About Us </span>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.customervalues')}}"><span class="ms-2 ms-lg-2">Customer Values</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.marketneed')}}"><span class="ms-2 ms-lg-2">Market Need</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.ethicaledge')}}"><span class="ms-2 ms-lg-2">Why Friendly?</span></a>
                                            </li>
                                        </ul>

                                        <ul>
                                            <li>
                                                <span class="menus_title">Diamond Anatomy </span>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.diamondanatomy')}}#cut"> <span class="ms-2 ms-lg-2">Cut</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.diamondanatomy')}}#color"><span class="ms-2 ms-lg-2">Color</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.diamondanatomy')}}#clarity"><span class="ms-2 ms-lg-2">Clarity</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.diamondanatomy')}}#carat"><span class="ms-2 ms-lg-2">Carat</span></a>
                                            </li>
                                        </ul>

                                        <ul>
                                            <li>
                                                <span class="menus_title">Learn More </span>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.learnaboutlabmadediamonds')}}"> <span class="ms-2 ms-lg-2">Learn About Lab Diamonds</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.conflictfreediamonds')}}"><span class="ms-2 ms-lg-2">Ethical And Conflict Free Diamonds</span></a>
                                            </li>
                                            
                                            
                                        </ul>

                                        <ul>
                                            <li>
                                                <span class="menus_title">Pages </span>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.aboutus')}}"> <span class="ms-2 ms-lg-2">About Us</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.testimonials')}}"> <span class="ms-2 ms-lg-2">Testimonials</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.blogs')}}"><span class="ms-2 ms-lg-2">Blogs</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.contactus')}}"><span class="ms-2 ms-lg-2">Contact Us</span></a>
                                            </li>
                                            
                                        </ul>
                                        
                                            <ul>
                                                <img src="{{ url('images/megamenu/'.$megamenu->menu_thumb) }}" alt="">
                                            </ul>
                                        
                                    </div>
                                </div>
                                
                            </li>
                            <?php } ?>
                            <!-- <li class="{{ (request()->is('infopage*')) ? 'active' : '' }}">
                                <a href="#"> engagement
                                <svg xmlns="http://www.w3.org/2000/svg " width="12 " height="8 " viewBox="0 0 12 8 " fill="none " class="mobile-menu-icon ">
                                    <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z " fill="white "/>
                                </svg>
                                </a>
                                <div class="mega-menu ">
                                    <div class="sub-pack">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" fill="none" class="mobile-sub-menu-icon">
                                            <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z" fill="#000"/>
                                        </svg>
                                    </div>
                                    <div id="nav-icon1" class="mega-menu-mobile-icon d-block d-lg-none open">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <div class="mega-menu-four-part engagement">
                                        <ul>
                                            <li>
                                                <span class="menus_title">design your own ring </span>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.customervalues')}}"><span class="ms-2 ms-lg-2">Start with a Setting</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.customervalues')}}"><span class="ms-2 ms-lg-2">Start with a Lab Diamond</span></a>
                                            </li>
                                           
                                        </ul>

                                        <ul>
                                            <li>
                                                <span class="menus_title">shop by metal </span>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.diamondanatomy')}}#cut">
                                                 <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/round.png') }}" alt="ROUND" class="diamond-mega-menu-img "></span>
                                                 <span class="ms-2 ms-lg-2">White Gold</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.diamondanatomy')}}#color">
                                                  <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/round.png') }}" alt="ROUND" class="diamond-mega-menu-img "></span>
                                                  <span class="ms-2 ms-lg-2"> Yellow Gold</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.diamondanatomy')}}#clarity">
                                                   <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/round.png') }}" alt="ROUND" class="diamond-mega-menu-img "></span>
                                                   <span class="ms-2 ms-lg-2">Rose Gold</span>
                                                </a>
                                            </li>
                                           
                                        </ul>

                                        <ul>
                                            <li>
                                                <span class="menus_title">shop by style </span>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.learnaboutlabmadediamonds')}}"> 
                                                 <span class="d-inline-block"><img src="{{ url('/frontend/image/shopbystyle/round.png') }}" alt="ROUND" class="diamond-mega-menu-img "></span>
                                                 <span class="ms-2 ms-lg-2"> Solitaire</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.learnaboutlabmadediamonds')}}"> 
                                                  <span class="d-inline-block"><img src="{{ url('/frontend/image/shopbystyle/round.png') }}" alt="ROUND" class="diamond-mega-menu-img "></span>
                                                  <span class="ms-2 ms-lg-2"> Halo</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.learnaboutlabmadediamonds')}}">
                                                  <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/round.png') }}" alt="ROUND" class="diamond-mega-menu-img "></span>
                                                  <span class="ms-2 ms-lg-2"> Three Stone</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.learnaboutlabmadediamonds')}}"> 
                                                 <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/round.png') }}" alt="ROUND" class="diamond-mega-menu-img "></span>
                                                 <span class="ms-2 ms-lg-2"> Side Stone</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.learnaboutlabmadediamonds')}}">
                                                    <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/round.png') }}" alt="ROUND" class="diamond-mega-menu-img "></span> 
                                                    <span class="ms-2 ms-lg-2"> Vintage</span>
                                                </a>
                                            </li>
                                            
                                        </ul>

                                              <div>
                                                <div class="d-block">
                                                    <span class="menus_title menus_title_part">start with a lab diamond</span>
                                                </div>
                                                <ul class="mega-menu-diamond-part">
                                    
                                                    <li>
                                                        <a href="{{ url('/lad-diamond/ROUND') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/round.png') }}" alt="ROUND" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-3 d-inline-block">round</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lad-diamond/HEART') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/heart.png') }}" alt="HEART" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-3 d-inline-block">heart</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lad-diamond/PRINCESS') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/princess.png') }}" alt="PRINCESS" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-3 d-inline-block">princess</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lad-diamond/PEAR') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/pear.png') }}" alt="PEAR" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-3 d-inline-block">pear</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lad-diamond/OVAL') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/oval.png') }}" alt="OVAL" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-3 d-inline-block">oval</span>
                                                        </a>
                                                    </li>
                                                    
                                                </ul>
                                                <ul class="mega-menu-diamond-part">
                                                    
                                                   
                                                    <li>
                                                        <a href="{{ url('/lad-diamond/CUSHION') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/cushion.png') }}" alt="CUSHION" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-3 d-inline-block">cushion</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lad-diamond/EMERALD') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/emerald.png') }}" alt="EMERALD" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-3 d-inline-block">emerald</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lad-diamond/MARQUISE') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/marquise.png') }}" alt="MARQUISE" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-3 d-inline-block">marquise</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lad-diamond/ASSCHER') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/asscher.png') }}" alt="ASSCHER" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-3 d-inline-block">asscher</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lad-diamond/RADIANT') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/radiant.png') }}" alt="RADIANT" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-3 d-inline-block">radiant</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                </div>
                                                
                                            
                                        
                                    </div>
                                </div>
                                
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>