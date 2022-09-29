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
                           
                            <div class="col-md-4 col-lg-6 text-end">
                                <div class="home-page-header navbar_header">
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

                            <div class="col-md-4 col-lg-3 text-center">
                                <div class="home-page-header">
                                    <a class="header-icon-part" href="{{ URL('/wishlist') }}" ><span class="header-icon me-3"><i class="fa fa-heart"></i> Wishlist  <span class="basket-item-count"> 0 </span> </span></a>
                                    <a class="header-icon-part" href="{{ URL('/cart') }}" ><span class="header-icon me-3"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        Cart
                                        <span class="basket-item-count-cart">
                                             0 
                                        </span>
                                    </a>
                                    @if(session()->has('customer'))
                                    <a class="header-icon-part" href="{{ URL('frontend/logout') }}"><span class="header-icon me-3">  Logout </span></a>
                                    @else
                                    <a class="header-icon-part" href="{{ URL('/login') }}"><span class="header-icon me-3">  Login </span></a>
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="container">
                <div class="row align-items-center header_row">
                <div class="col-12 col-lg-12 header_col d-flex justify-content-between">
                    <div class="logo-image header-logo mx-lg-auto">
                        <a href="{{ URL('/') }}">
                            <img src="{{ URL('images/company/'.$settings->company_logo) }}" alt="">
                        </a>
                    </div>
                    <span class="d-flex align-items-center justify-content-end">
                        <div class="cart-icon-part">
                            <span class="position-relative dropdown">
                               <a href="#" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                        <path d="M12.9281 1.28566C13.3235 1.28566 16.7942 1.40862 16.7942 5.66679C16.7942 9.74438 13.7221 12.4739 8.99974 16.3748C4.27727 12.4743 1.20579 9.74505 1.20579 5.66679C1.20579 1.40863 4.67606 1.28566 5.07153 1.28566C6.81061 1.28566 8.12232 2.68565 8.13085 2.69429L8.99491 3.64184L9.86484 2.69972C9.87804 2.685 11.1891 1.28566 12.9282 1.28566M12.9282 0C10.6253 0 9.00016 1.80327 9.00016 1.80327C9.00016 1.80327 7.37437 0 5.07148 0C2.99149 0 0 1.38785 0 5.66712C0.000203061 10.5688 3.708 13.6402 9.00026 18C14.2917 13.6399 18 10.5689 18 5.66712C18 1.38818 15.0077 0.000554306 12.9281 0.000554306L12.9282 0Z" fill="#2E2E2E"/>
                                    </svg>
                                    <span class="cart-icon-label">2</span>
                                </a>
                            </span>
                            <span class="position-relative dropdown shopping-part">
                               <a href="#" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="cart-icon-svg" width="20" height="18" version="1.1" viewBox="0 0 700 700">
                                        <g>
                                        <path d="m162.24 481.46c5.1797 17.312 21.398 29.398 39.457 29.398h296.59c18.059 0 34.301-12.086 39.457-29.398l88.992-297.62c2.7773-9.3555 1.0273-19.203-4.8086-27.02-5.8086-7.8164-14.77-12.297-24.523-12.297h-110.34c-21.184-57.145-76.02-95.387-137.06-95.387-62.742 0-116.41 39.762-137.06 95.387h-110.37c-9.7539 0-18.691 4.4805-24.523 12.297-5.8125 7.8398-7.5859 17.664-4.7852 27.043zm187.76-413.65c50.914 0 96.832 30.496 116.97 76.742h-233.91c19.645-45.129 64.68-76.742 116.95-76.742zm-256.97 100.19c2.2617-3.0352 5.7383-4.8086 9.543-4.8086h104.81c-2.332 10.312-3.5469 21.047-3.5469 32.035 0 5.1562 4.1992 9.332 9.332 9.332s9.332-4.1758 9.332-9.332c0-11.059 1.4219-21.793 4.082-32.035h246.8c2.707 10.383 4.0586 21.117 4.0586 32.035 0 5.1562 4.1992 9.332 9.332 9.332 5.1328 0 9.332-4.1758 9.332-9.332 0-10.875-1.1914-21.605-3.5234-32.035h104.79c3.8047 0 7.3047 1.75 9.5664 4.7852 2.2617 3.0586 2.9414 6.8828 1.8672 10.523l-88.969 297.59c-2.8477 9.4727-11.715 16.078-21.605 16.078h-296.54c-9.8945 0-18.762-6.625-21.605-16.078l-88.922-297.57c-1.0977-3.6406-0.42187-7.4883 1.8672-10.523z"/>
                                        <path d="m203.91 298.36h292.18c5.1562 0 9.332-4.1758 9.332-9.332s-4.1992-9.332-9.332-9.332l-292.18-0.003907c-5.1562 0-9.332 4.1758-9.332 9.332 0 5.1602 4.1758 9.3359 9.332 9.3359z"/>
                                        <path d="m474.46 344.56h-248.9c-5.1562 0-9.332 4.1758-9.332 9.332s4.1992 9.332 9.332 9.332h248.9c5.1562 0 9.332-4.1758 9.332-9.332s-4.1758-9.332-9.332-9.332z"/>
                                        <path d="m460.93 409.43h-221.85c-5.1562 0-9.332 4.1758-9.332 9.332s4.1992 9.332 9.332 9.332h221.85c5.1562 0 9.332-4.1758 9.332-9.332 0.003907-5.1562-4.1992-9.332-9.332-9.332z"/>
                                        </g>
                                    </svg>
                                    <span class="cart-icon-label">3</span>
                                </a>
                            </span>
                            <span class="position-relative dropdown">
                               <a href="#" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="" width="15" height="20" viewBox="0 0 15 20" fill="none">
                                            <path d="M7.50004 0.9C5.33142 0.9 3.57653 2.78765 3.57653 5.09089C3.57653 7.39412 5.33142 9.28177 7.50004 9.28177C9.66865 9.28177 11.4235 7.39412 11.4235 5.09089C11.4235 2.78765 9.66865 0.9 7.50004 0.9ZM7.50004 1.9181C9.1324 1.9181 10.4589 3.32731 10.4589 5.09089C10.4589 6.85443 9.13256 8.26367 7.50004 8.26367C5.86767 8.26367 4.54116 6.85447 4.54116 5.09089C4.54116 3.32734 5.86751 1.9181 7.50004 1.9181ZM4.05888 10.7181C2.30941 10.7181 0.9 12.236 0.9 14.0908V18.5908C0.9 18.8654 1.10972 19.1 1.38245 19.1H13.6177C13.8904 19.1 14.1 18.8655 14.1 18.591V14.091C14.1 12.2362 12.6906 10.7182 10.9411 10.7182L4.05888 10.7181ZM10.9412 11.7362C12.1572 11.7362 13.1353 12.7725 13.1353 14.0907V18.0815H1.86474V14.0907C1.86474 12.7725 2.84283 11.7362 4.05888 11.7362H10.9412Z" fill="#2E2E2E" stroke="#2E2E2E" stroke-width="0.2"/>
                                        </svg>
                                </a>
                               <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">My Account </a></li>
                                    <li><a class="dropdown-item" href="#">Logout</a></li>
                                </ul>
                            </span>
                            
                        </div>
                        <div id="nav-icon1" class="d-block d-lg-none">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </span>
                </div>
                        <div class="col-6 col-lg-12 text-center header">
                            <div class="mobile-menu text-end text-lg-center">
                                <!-- <div id="nav-icon1" class="d-block d-lg-none">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div> -->
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
                                            <div class="mega-menu-{{ $menu_colum }}-part  ">
                                                <?php
                                                foreach($megamenu->sub_menu as $sub)
                                                {
                                                if(count($sub->sub_category) > 0){
                                                    $twocolum = "";
                                                    if(count($sub->sub_category) > 5){
                                                        $twocolum = 'mega-menu-two-colum';
                                                    }
                                                ?>
                                                <div class="submenu-box">
                                                <div class="d-block mb-2">
                                                    <span class="menus_title menus_title_part">{{ $sub->title }}</span>
                                                </div>      
                                                <ul class="{{ $twocolum }}">
                                                    
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
                                                </div>
                                                <?php
                                                
                                                }
                                                }
                                                ?>
                                                <div class="submenu-box">
                                                <ul class="">
                                                    <li class="menu-part-img"><img src="{{ url('images/megamenu/'.$megamenu->menu_thumb) }}" alt=" "></li>
                                                </ul>
                                                </div>
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
                                                    $twocolum = "";
                                                    if(count($sub->sub_category) > 5){
                                                        $twocolum = 'mega-menu-two-colum';
                                                    }
                                                ?>
                                                <div class="submenu-box">
                                                <div class="d-block mb-2">
                                                    <span class="menus_title menus_title_part">{{ $sub->title }}</span>
                                                </div>
                                                <ul class="{{ $twocolum }}">
                                                    
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
                                                </div>
                                                <?php
                                                }
                                                }
                                                ?>
                                                <div class="submenu-box">
                                                <ul class="">
                                                    <li class="menu-part-img"><img src="{{ url('images/megamenu/'.$megamenu->menu_thumb) }}" alt=" "></li>
                                                </ul>
                                                </div>
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
                                                    $twocolum = "";
                                                    if(count($sub->sub_category) > 5){
                                                        $twocolum = 'mega-menu-two-colum';
                                                    }
                                                ?>
                                                <div class="submenu-box">
                                                <div class="d-block mb-2">
                                                    <span class="menus_title menus_title_part">{{ $sub->title }}</span>
                                                </div>
                                                <ul class="{{ $twocolum }}">  
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
                                                </div>
                                                <?php
                                                }
                                                }
                                                ?>
                                                <div class="submenu-box">
                                                    <ul class="">
                                                        <li class="menu-part-img"><img src="{{ url('images/megamenu/'.$megamenu->menu_thumb) }}" alt=" "></li>
                                                    </ul>
                                                </div>
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
                                        $megamenu = \App\Models\MegaMenu::where('estatus',1)->where('id',4)->first();
                                        //dd($megamenu->sub_menu);
                                        if($megamenu != ""){   
                                    ?>
                                    <li class="{{ (request()->segment(1) == 'lab-diamond') ? 'active' : '' }}" ><a href="# ">{{  $megamenu->title }}
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
                                            
                                            <div class="mega-menu-two-part">
                                                        <div class="submenu-box">
                                            
                                                        <div class="d-block mb-2">
                                                            <span class="menus_title menus_title_part">loose lab diamonds</span>
                                                        </div>
                                                        <ul class="mega-menu-two-colum">
            
                                                            <li>
                                                                <a href="{{ url('/lab-diamond/ROUND') }}" class="d-flex">
                                                                    <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/round.png') }}" alt="ROUND" class="diamond-mega-menu-img "></span>
                                                                    <span class="ms-2 ms-md-3 d-inline-block">round</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ url('/lab-diamond/HEART') }}" class="d-flex">
                                                                    <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/heart.png') }}" alt="HEART" class="diamond-mega-menu-img "></span>
                                                                    <span class="ms-2 ms-md-3 d-inline-block">heart</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ url('/lab-diamond/PRINCESS') }}" class="d-flex">
                                                                    <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/princess.png') }}" alt="PRINCESS" class="diamond-mega-menu-img "></span>
                                                                    <span class="ms-2 ms-md-3 d-inline-block">princess</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ url('/lab-diamond/PEAR') }}" class="d-flex">
                                                                    <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/pear.png') }}" alt="PEAR" class="diamond-mega-menu-img "></span>
                                                                    <span class="ms-2 ms-md-3 d-inline-block">pear</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ url('/lab-diamond/OVAL') }}" class="d-flex">
                                                                    <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/oval.png') }}" alt="OVAL" class="diamond-mega-menu-img "></span>
                                                                    <span class="ms-2 ms-md-3 d-inline-block">oval</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ url('/lab-diamond/CUSHION') }}" class="d-flex">
                                                                    <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/cushion.png') }}" alt="CUSHION" class="diamond-mega-menu-img "></span>
                                                                    <span class="ms-2 ms-md-3 d-inline-block">cushion</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ url('/lab-diamond/EMERALD') }}" class="d-flex">
                                                                    <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/emerald.png') }}" alt="EMERALD" class="diamond-mega-menu-img "></span>
                                                                    <span class="ms-2 ms-md-3 d-inline-block">emerald</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ url('/lab-diamond/MARQUISE') }}" class="d-flex">
                                                                    <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/marquise.png') }}" alt="MARQUISE" class="diamond-mega-menu-img "></span>
                                                                    <span class="ms-2 ms-md-3 d-inline-block">marquise</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ url('/lab-diamond/ASSCHER') }}" class="d-flex">
                                                                    <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/asscher.png') }}" alt="ASSCHER" class="diamond-mega-menu-img "></span>
                                                                    <span class="ms-2 ms-md-3 d-inline-block">asscher</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ url('/lab-diamond/RADIANT') }}" class="d-flex">
                                                                    <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/radiant.png') }}" alt="RADIANT" class="diamond-mega-menu-img "></span>
                                                                    <span class="ms-2 ms-md-3 d-inline-block">radiant</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="submenu-box">
                                                        <ul>
                                                            <li class="menu-part-img two_part_padding">
                                                            <img src="{{ url('images/megamenu/'.$megamenu->menu_thumb) }}" alt="">
                                                            </li>
                                                        </ul>
                                                    </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php } ?>
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
                                                <div class="submenu-box1">
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
                                                </div>
                                                <?php $cat_no++;  } ?>
                                                
                                                <div class="submenu-box1">
                                                    <ul>
                                                        <img src="{{ url('images/megamenu/'.$megamenu->menu_thumb) }}" alt="">
                                                    </ul>
                                                </div>   
                                                
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
                                                        <a href="{{ Route('frontend.customervalues')}}"><span class="ms-2 ms-lg-0">Customer Values</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ Route('frontend.marketneed')}}"><span class="ms-2 ms-lg-0">Market Need</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ Route('frontend.ethicaledge')}}"><span class="ms-2 ms-lg-0">Why Gemver?</span></a>
                                                    </li>
                                                </ul>

                                                <ul>
                                                    <li>
                                                        <span class="menus_title">Diamond Anatomy </span>
                                                    </li>
                                                    <li>
                                                        <a href="{{ Route('frontend.diamondanatomy')}}#cut"> <span class="ms-2 ms-lg-0">Cut</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ Route('frontend.diamondanatomy')}}#color"><span class="ms-2 ms-lg-0">Color</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ Route('frontend.diamondanatomy')}}#clarity"><span class="ms-2 ms-lg-0">Clarity</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ Route('frontend.diamondanatomy')}}#carat"><span class="ms-2 ms-lg-0">Carat</span></a>
                                                    </li>
                                                </ul>

                                                <ul>
                                                    <li>
                                                        <span class="menus_title">Learn More </span>
                                                    </li>
                                                    <li>
                                                        <a href="{{ Route('frontend.learnaboutlabmadediamonds')}}"> <span class="ms-2 ms-lg-0">Learn About Lab Diamonds</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ Route('frontend.conflictfreediamonds')}}"><span class="ms-2 ms-lg-0">Ethical And Conflict Free Diamonds</span></a>
                                                    </li>
                                                    
                                                    
                                                </ul>

                                                <ul>
                                                    <li>
                                                        <span class="menus_title">Pages </span>
                                                    </li>
                                                    <li>
                                                        <a href="{{ Route('frontend.aboutus')}}"> <span class="ms-2 ms-lg-0">About Us</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ Route('frontend.testimonials')}}"> <span class="ms-2 ms-lg-0">Testimonials</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ Route('frontend.blogs')}}"><span class="ms-2 ms-lg-0">Blogs</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ Route('frontend.contactus')}}"><span class="ms-2 ms-lg-0">Contact Us</span></a>
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
                                                                <a href="{{ url('/lab-diamond/ROUND') }}" class="d-flex">
                                                                    <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/round.png') }}" alt="ROUND" class="diamond-mega-menu-img "></span>
                                                                    <span class="ms-2 ms-md-3 d-inline-block">round</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ url('/lab-diamond/HEART') }}" class="d-flex">
                                                                    <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/heart.png') }}" alt="HEART" class="diamond-mega-menu-img "></span>
                                                                    <span class="ms-2 ms-md-3 d-inline-block">heart</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ url('/lab-diamond/PRINCESS') }}" class="d-flex">
                                                                    <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/princess.png') }}" alt="PRINCESS" class="diamond-mega-menu-img "></span>
                                                                    <span class="ms-2 ms-md-3 d-inline-block">princess</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ url('/lab-diamond/PEAR') }}" class="d-flex">
                                                                    <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/pear.png') }}" alt="PEAR" class="diamond-mega-menu-img "></span>
                                                                    <span class="ms-2 ms-md-3 d-inline-block">pear</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ url('/lab-diamond/OVAL') }}" class="d-flex">
                                                                    <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/oval.png') }}" alt="OVAL" class="diamond-mega-menu-img "></span>
                                                                    <span class="ms-2 ms-md-3 d-inline-block">oval</span>
                                                                </a>
                                                            </li>
                                                            
                                                        </ul>
                                                        <ul class="mega-menu-diamond-part">
                                                            
                                                        
                                                            <li>
                                                                <a href="{{ url('/lab-diamond/CUSHION') }}" class="d-flex">
                                                                    <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/cushion.png') }}" alt="CUSHION" class="diamond-mega-menu-img "></span>
                                                                    <span class="ms-2 ms-md-3 d-inline-block">cushion</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ url('/lab-diamond/EMERALD') }}" class="d-flex">
                                                                    <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/emerald.png') }}" alt="EMERALD" class="diamond-mega-menu-img "></span>
                                                                    <span class="ms-2 ms-md-3 d-inline-block">emerald</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ url('/lab-diamond/MARQUISE') }}" class="d-flex">
                                                                    <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/marquise.png') }}" alt="MARQUISE" class="diamond-mega-menu-img "></span>
                                                                    <span class="ms-2 ms-md-3 d-inline-block">marquise</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ url('/lab-diamond/ASSCHER') }}" class="d-flex">
                                                                    <span class="d-inline-block"><img src="{{ url('/frontend/image/header-image/asscher.png') }}" alt="ASSCHER" class="diamond-mega-menu-img "></span>
                                                                    <span class="ms-2 ms-md-3 d-inline-block">asscher</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ url('/lab-diamond/RADIANT') }}" class="d-flex">
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
          
        </div>