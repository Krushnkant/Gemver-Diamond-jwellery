
        <div class="header @if(Request::route()->getName() != 'frontend.home') sub_header @endif">
            <div class="row align-items-center">
                <div class="col-4 col-md-3 col-lg-2 col-xl-3">
                    <div class="logo-image">
                        <a href="{{ URL('/') }}">
                        <img src="{{ URL('images/company/'.$settings->company_logo) }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-8 col-md-9 col-lg-10 col-xl-9 text-center">
                    <div class="mobile-menu text-end text-md-center">
                        <div id="nav-icon1" class="d-block d-lg-none">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <ul class="mobile-sub-menu">
                            <li class="active"><a href="{{ URL('/') }}">home</a></li>
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
                            <li><a href="{{ Route('frontend.aboutus')}}">about us</a></li>
                            <li><a href="# ">create your own
                                <svg xmlns="http://www.w3.org/2000/svg " width="12 " height="8 " viewBox="0 0 12 8 " fill="none " class="mobile-menu-icon ">
                                    <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z " fill="white "/>
                                    </svg>
                                </a>
                                <div class="mega-menu ">
                                    <div class="mega-menu-four-part ">
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