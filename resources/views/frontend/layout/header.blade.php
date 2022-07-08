    <div class="home-page-slider-header @if(Request::route()->getName() != 'frontend.home') sub_header @endif">
        <div class="home-page-bg">
                    <div class="container">
                        <div class="row mt-0 mb-0">
                            <div class="col-md-4 text-center">
                                <div class="home-page-header">
                                    <span class="me-3 header-icon"><i class="fa-solid fa-phone me-2"></i>Call Us : {{ $settings->company_mobile_no }}</a></span>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="home-page-header">
                                    <span class="me-3 header-icon">Special Offers! - Get 50% Off On jewellery</span>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="home-page-header">
                                    <span class="me-3 header-icon"><i class="fa-solid fa-envelope me-2"></i> Email : {{ $settings->company_email }}</span>
                                    <a style="color:#0b1727;" href="https://api.whatsapp.com/send?phone={{ $settings->company_mobile_no }}" target="_blank" ><span class="ms-3 header-icon"><i class="fa-brands fa-whatsapp"></i> Chat </span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="row align-items-center position-relative">
                <div class="col-6 col-lg-12 mb-3">
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
                        <ul class="mobile-sub-menu">
                            <li class="active"><a href="{{ URL('/') }}">home</a></li>
                            <!-- <li><a href="{{ Route('frontend.aboutus')}}">about us</a></li> -->
                            <li>
                                <a href="#">about us
                                <svg xmlns="http://www.w3.org/2000/svg " width="12 " height="8 " viewBox="0 0 12 8 " fill="none " class="mobile-menu-icon ">
                                    <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z " fill="white "/>
                                </svg>
                                </a>
                                <div class="mega-menu ">
                                    <div class="mega-menu-four-part ">
                                        <ul>
                                            <li>
                                                <a href="{{ Route('frontend.aboutus')}}" class="menus_title"><span class="">About Us </span></a>
                                            </li>
                                        
                                            <li>
                                                <a href="{{ Route('frontend.customervalues')}}"><span class="">Customer Values</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.marketneed')}}"><span class="">Market Need</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.ethicaledge')}}"><span class="">Why Friendly?</span></a>
                                            </li>
                                        </ul>

                                        <ul>
                                            <li>
                                                <span class="menus_title">Diamond Anatomy </span>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.diamondanatomy')}}"> <span class="">Cut</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.diamondanatomy')}}"><span class="">Color</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.diamondanatomy')}}"><span class="">Clarity</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.diamondanatomy')}}"><span class="">Carat</span></a>
                                            </li>
                                        </ul>

                                        <ul>
                                            <li>
                                                <span class="menus_title">Learn More </span>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.learnaboutlabmadediamonds')}}"> <span class="">Learn About Lab Diamonds</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.conflictfreediamonds')}}"><span class="">Ethical And Conflict Free Diamonds</span></a>
                                            </li>
                                            
                                            
                                        </ul>

                                        <ul>
                                            <li>
                                                <span class="menus_title">Pages </span>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.testimonials')}}"> <span class="">Testimonials</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.blogs')}}"><span class="">Blogs</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ Route('frontend.contactus')}}"><span class="">Contact Us</span></a>
                                            </li>
                                            
                                        </ul>
                                        <ul>
                                            <img src="{{ url('frontend/image/mega-menu-img-2.png') }}" alt=" ">
                                        </ul>
                                    </div>
                                </div>
                                
                            </li>
                            <li><a href="#">jewellery
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" fill="none" class="mobile-menu-icon">
                                    <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z" fill="white"/>
                                    </svg>
                                </a>
                                <?php 
                                    $categories = \App\Models\Category::where('estatus',1)->get();
                                    if(count($categories) > 0){
                                ?>
                                <div class="mega-menu">
                                    <div class="mega-menu-two-part ">
                                        <ul>
                                        <?php 
                                         
                                          $img_no = 1;
                                          foreach($categories as $car)
                                          {
                                             if($img_no == 1){
                                                $defalt_image = $car->category_thumb;
                                             }
                                             $img_no++; 
                                             ?>
                                            <li>
                                                <a href="{{ URL('/shop/'.$car->id)}}">
                                                    <img src="{{ url($car->category_thumb) }}" alt="{{ $car->category_name }}" class="mega-menu-img "> <span class="ms-2 ">{{ $car->category_name }}</span>
                                                </a>
                                            </li>
                                            <?php 
                                          }
                                        ?>
                                        </ul>
                                        <ul class="">
                                            <li class="menu-part-img"><img src="{{ url($defalt_image) }}" alt=" "></li>
                                        </ul>
                                    </div>
                                </div>
                                <?php } ?>
                            </li>
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
                            
                            <li><a href="# ">create your own
                                <svg xmlns="http://www.w3.org/2000/svg " width="12 " height="8 " viewBox="0 0 12 8 " fill="none " class="mobile-menu-icon ">
                                    <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z " fill="white "/>
                                    </svg>
                                </a>
                                <div class="mega-menu ">
                                    <div class="mega-menu-four-part ">
                                        <div>
                                    <?php 
                                         
                                         $img_no = 1;
                                         $cat_no = 1;
                                         foreach($categories as $car)
                                         {
                                            if($cat_no < 4){
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
                                                <a href="{{ URL('/product-setting/'.$car->id)}}">
                                                    <img src="{{ url($car->category_thumb) }}" alt=" " class="mega-menu-img "> <span class="ms-2 ">Start with a Setting</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ URL('/diamond-setting/'.$car->id)}}"><img src="{{ url('frontend/image/mega-menu-img-2.png') }}" alt=" " class="mega-menu-img "><span class="ms-2 ">Start with a Lab Diamond</span></a>
                                            </li>
                                        </ul>

                                        
                                        <?php $cat_no++; } } ?>
                                        </div>
                                        <ul>
                                            <img src="{{ url($defalt_image) }}" alt=" ">
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>