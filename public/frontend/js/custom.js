//var base_url = window.location.origin + '/public';
//var base_url = window.location.origin;
var base_url = $("#web_url").val();
$(document).ready(function () {

    var asset = $('#asset').val();

    "use strict";
    var offSetTop = 100;
    var $scrollToTopButton = $('.scrollToTop');
    $(window).scroll(function () {
        if ($(this).scrollTop() > offSetTop) {
            $scrollToTopButton.fadeIn();
        } else {
            $scrollToTopButton.fadeOut();
        }
    });

    $scrollToTopButton.click(function () {
        $('html, body').animate({ scrollTop: 0 }, 800);
        return false;
    });


    $('.engagement-section').owlCarousel({
        loop: false,
        margin: 10,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
            },
            600: {
                items: 3,
            },
            768: {
                items: 5,
            },
            1000: {
                items: 6
            }
        }
    })




    $('.product-detail-modal-popup').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });


    $('.Instagram-post-slider').owlCarousel({
        loop: false,
        margin: 0,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 2
            },
            576: {
                items: 3
            },
            992: {
                items: 4
            },
            1000: {
                items: 5
            }
        }
    });

    $('.shop-dimond-by-shape-slider').owlCarousel({
        loop: false,
        dots: false,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 4
            },
            576: {
                items: 5
            },
            610: {
                items: 6
            },
            767: {
                items: 7
            },
            992: {
                items: 8
            },
            1400: {
                items: 8
            },
            1800: {
                items: 9
            }
        }
    });
    $('#customer-stories').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 1,
                autoHeight: true,
            },
            768: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });
    $('#trustby-slider').owlCarousel({
        autoplay: true,
        rewind: true,
        responsiveClass: true,
        autoHeight: true,
        autoplayTimeout: 7000,
        smartSpeed: 800,
        margin: 50,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 2,
                autoHeight: true,
            },
            768: {
                items: 4
            },
            1000: {
                items: 5
            }
        }
    });
    $('.shop-by-style-slider').owlCarousel({
        loop: true,
        dots: false,
        margin: 25,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2,
            },
            768: {
                items: 3,
            },
            1200: {
                items: 3
            }
        }
    });
    $('.shop-by-category').owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 2,
            },
            576: {
                items: 3,
            },
            767: {
                items: 4,
            },
            992: {
                items: 5,
            },
            1200: {
                items: 5
            }
        }
    });
    $('.products_item').owlCarousel({
        loop: false,
        margin: 0,
        nav: true,
        dots: false,
        autoHeight: false,
        responsive: {
            0: {
                items: 2
            },
            767: {
                items: 3,
            },
            990: {
                items: 4
            },
            1366: {
                items: 5
            }
        }
    });
    $('.product-detail').owlCarousel({
        loop: false,
        margin: 20,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 2,
            },
            767: {
                items: 3,
            },
            990: {
                items: 4
            },
            1366: {
                items: 5
            }
        }
    });

    $('.excellent-slider').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });

    $('.category-slider').owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        autoWidth: true,
        dots: false,
        slideBy: 6,
        responsive: {
            0: {
                items: 1,
                slideBy: 1,
            },
            768: {
                items: 3,
                slideBy: 6,
            },
            1000: {
                items: 8
            }
        }
    });

    $(".mobile-search-close").click(function () {
        $(".mobile-menu-search-box-part").toggleClass("active-part-cart");
    });
    $(".search-box-icon").click(function () {
        $(".mega-menu-part").toggleClass("mega-menu-deactive-box");
    });
    $(".search-icon-part").click(function () {
        $(".mega-menu-part").toggleClass("mega-menu-deactive-box");
    });
    $(".mega-menu-part").removeClass("mega-menu-deactive-box");
    $(".mobile-search-close").click(function () {
        $(this).toggleClass("mobile-search-close-active");
    });
    $(".footer-ul-part").css({ "display": "none" });

    $(".mobile-view-filter-btn").click(function () {
        $(".filter-data").toggleClass("filter-data-active");
        $("body").toggleClass("mobile-sub-menu-active");
    });
    $(".close-icon").click(function () {
        $(".filter-data").removeClass("filter-data-active");
        $("body").removeClass("mobile-sub-menu-active");
    });
    $(".apply-btn").click(function () {
        $(".filter-data").removeClass("filter-data-active");
        $("body").removeClass("mobile-sub-menu-active");
    });

    if ($(window).width() < 767) {
        $(".footer-heading").click(function () {
            $(this).toggleClass("foote-heading-acive");
            $(this).parent(".footer-col").find(".footer-ul-part").slideToggle();
        });
    }

    $(".advanced-filter").click(function () {
        $(".form-group").toggleClass("form-group-active");
    });


    $(".blog_filter_btn").click(function () {
        $(".blog_filter_btn_ul").slideToggle();
    });
    $('#mobile-nav-icon1').click(function() {
        $(this).toggleClass('open');
        $(".mobile-sub-menu").toggleClass("active");
        $("body").toggleClass("mobile-sub-menu-active");
    });
    $('.menu-toggle-button').click(function () {
        // $(this).toggleClass('open');
        $(".mobile-sub-menu").toggleClass("active");
        $("body").toggleClass("mobile-sub-menu-active");
    });

    // $(".mobile-sub-menu>li>a").click(function() {
    //     $(this).parent(".mobile-sub-menu>li").find(".mega-menu").toggleClass("slide_up_menu");
    // });
    $(document).ready(function () {
        $(".accordion").on("click", function () {
            $(this).toggleClass("active");
            $(this).next().slideToggle(200);
        });
    });

    $(".sub-pack").click(function () {
        $(".mega-menu").removeClass("slide_up_menu");
        // if ($(".mega-menu").hasClass("slide_up_menu")) {
        //     $(".mega-menu").removeClass("slide_up_menu");
        // } else {
        //     $(".mega-menu").addClass("slide_up_menu");
        // }

        // if ($(".mega-menu").hasClass("slide_up_menu")) {
        //     $(".sub-pack").addClass("sub-pack-active");
        // } else {
        //     $(".sub-pack").removeClass("sub-pack-active");
        // }
    });

    $(".mobile-menu-icon").click(function () {
        if ($(".mega-menu").hasClass("slide_up_menu")) {
            $(this).parent(".mobile-sub-menu>li").find(".mega-menu").removeClass("slide_up_menu");
        } else {
            $(this).parent(".mobile-sub-menu>li").find(".mega-menu").addClass("slide_up_menu");
        }
    });
    $(".mega-menu-mobile-icon").click(function () {
        // $("#nav-icon1").removeClass('open');
        $(".mobile-sub-menu").removeClass("active");
        $("body").removeClass("mobile-sub-menu-active");
        $(".mega-menu").removeClass("slide_up_menu");
    });

    $('.slider-single').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        nav: false,
        fade: false,
        adaptiveHeight: true,
        infinite: false,
        useTransform: true,
        speed: 400,
        cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)',
    });

    $('.slider-nav')
        .on('init', function (event, slick) {
            $('.slider-nav .slick-slide.slick-current').addClass('is-active');
        })
        .slick({
            slidesToShow: 5,
            slidesToScroll: 5,
            dots: false,
            nav: false,
            adaptiveHeight: true,
            focusOnSelect: false,
            infinite: false,
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5,
                }
            }, {
                breakpoint: 767,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5,
                }
            }, {
                breakpoint: 575,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                }
            }]
        });
    $('.slider-single').on('afterChange', function (event, slick, currentSlide) {
        $('.slider-nav').slick('slickGoTo', currentSlide);
        var currrentNavSlideElem = '.slider-nav .slick-slide[data-slick-index="' + currentSlide + '"]';
        $('.slider-nav .slick-slide.is-active').removeClass('is-active');
        $(currrentNavSlideElem).addClass('is-active');
    });

    $('.slider-nav').on('click', '.slick-slide', function (event) {
        event.preventDefault();
        var goToSingleSlide = $(this).data('slick-index');

        $('.slider-single').slick('slickGoTo', goToSingleSlide);
    });

    // var $this = $('.round_cut_lab_checkbox');
    // if ($this.find('span').length > 2) {
    //     $('.round_cut_lab_checkbox').append('<div><a href="javascript:;" class="showMore"></a></div>');
    // }

    // $('.round_cut_lab_checkbox .form-check').slice(0, 3).addClass('shown');
    // $('.round_cut_lab_checkbox .form-check').not('.shown').hide();
    // $('.round_cut_lab_checkbox .showMore').on('click', function() {
    //     $('.round_cut_lab_checkbox .form-check').not('.shown').toggle(300);
    //     $(this).toggleClass('showLess');
    // });


    $(".filter-btn").click(function () {
        $(".right_side_panel").toggleClass("right_side_open");
    });
    $(".close_icon_svg").click(function () {
        $(".right_side_panel").toggleClass("right_side_open");
    });

    // $('select').each(function() {
    //     var $this = $(this),
    //         numberOfOptions = $(this).children('option').length;

    //     $this.addClass('select-hidden');
    //     $this.wrap('<div class="select"></div>');
    //     $this.after('<div class="select-styled"></div>');

    //     var $styledSelect = $this.next('div.select-styled');
    //     $styledSelect.text($this.children('option').eq(0).text());

    //     var $list = $('<ul />', {
    //         'class': 'select-options'
    //     }).insertAfter($styledSelect);

    //     for (var i = 0; i < numberOfOptions; i++) {
    //         $('<li />', {
    //             text: $this.children('option').eq(i).text(),
    //             rel: $this.children('option').eq(i).val()
    //         }).appendTo($list);
    //         //if ($this.children('option').eq(i).is(':selected')){
    //         //  $('li[rel="' + $this.children('option').eq(i).val() + '"]').addClass('is-selected')
    //         //}
    //     }

    //     var $listItems = $list.children('li');

    //     $styledSelect.click(function(e) {
    //         e.stopPropagation();
    //         $('div.select-styled.active').not(this).each(function() {
    //             $(this).removeClass('active').next('ul.select-options').hide();
    //         });
    //         $(this).toggleClass('active').next('ul.select-options').toggle();
    //     });

    //     $listItems.click(function(e) {
    //         e.stopPropagation();
    //         $styledSelect.text($(this).text()).removeClass('active');
    //         $this.val($(this).attr('rel'));
    //         $list.hide();
    //         //console.log($this.val());
    //     });

    //     $(document).click(function() {
    //         $styledSelect.removeClass('active');
    //         $list.hide();
    //     });

    // });


    $('.home-page-slider').owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 5000,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });
    $('.blog-tabs').owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        dots: false,
        autoWidth: true,
        autoplay: true,
        autoplayTimeout: 5000,
        responsive: {
            0: {
                items: 3
            },
            600: {
                items: 3
            },
            1000: {
                items: 7
            }
        }
    });
    $('.finejewellery-slider').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 5000,
        responsive: {
            0: {
                items: 1,

            },
            400: {
                items: 2,
            },
            768: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    })
    $('.gifts-slider').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 2000,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            768: {
                items: 3
            },
            1000: {
                items: 3,
                dots: false,
                nav: false,
                autoplay: false,
            }
        }
    });


    $('.home-page-slider').owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 5000,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });
    $('.about-us-slider').owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 5000,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            768: {
                items: 3
            },
            1200: {
                items: 4
            }
        }
    });

    $('.fancy-color-diamonds').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: false,
        autoplay: false,
        autoplayTimeout: 5000,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });
    $('.most-viewed-slider').owlCarousel({
        loop: true,
        margin: 10,
        dots: false,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            992: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    $(function () {
        var owl = $(".animation-slider-text");
        owl.owlCarousel({
            items: 1,
            loop: true,
            nav: false,
            dots: false,
            mouseDrag: false,
            autoplay: true,
            autoplayTimeout: 5000,
            smartSpeed: 5000,
            // animateOut: "slideOutLeft",
            // animateIn: "slideInLeft",
        });
    });


    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // $(".owl-nav >  .owl-prev").html('<i class="fa-solid fa-chevron-left"></i>');
    // $(".owl-nav > .owl-next").html('<i class="fa-solid fa-chevron-right"></i>');

    $(".shop-dimond-by-shape-slider > .owl-nav >  .owl-prev").html('<svg xmlns="http://www.w3.org/2000/svg" class="" width="9" height="13" viewBox="0 0 9 13" fill="none"><path d="M0.632325 6.50016L6.89274 12.7606L8.3667 11.2887L3.57503 6.50016L8.3667 1.71266L6.89378 0.239746L0.632325 6.50016Z" fill="#0b1727"/></svg>');
    $(".shop-dimond-by-shape-slider > .owl-nav > .owl-next").html('<svg xmlns="http://www.w3.org/2000/svg" class="" width="9" height="13" viewBox="0 0 9 13" fill="none"><path d="M8.36767 6.49984L2.10726 0.239422L0.633301 1.7113L5.42497 6.49984L0.633301 11.2873L2.10622 12.7603L8.36767 6.49984Z" fill="#0b1727"/></svg>');
    $(".Instagram-post-slider > .owl-nav >  .owl-prev").html('<svg xmlns="http://www.w3.org/2000/svg" class="" width="9" height="13" viewBox="0 0 9 13" fill="none"><path d="M0.632325 6.50016L6.89274 12.7606L8.3667 11.2887L3.57503 6.50016L8.3667 1.71266L6.89378 0.239746L0.632325 6.50016Z" fill="#0b1727"/></svg>');
    $(".Instagram-post-slider > .owl-nav > .owl-next").html('<svg xmlns="http://www.w3.org/2000/svg" class="" width="9" height="13" viewBox="0 0 9 13" fill="none"><path d="M8.36767 6.49984L2.10726 0.239422L0.633301 1.7113L5.42497 6.49984L0.633301 11.2873L2.10622 12.7603L8.36767 6.49984Z" fill="#0b1727"/></svg>');
    $(".shop-by-category > .owl-nav >  .owl-prev").html('<svg xmlns="http://www.w3.org/2000/svg" class="" width="9" height="13" viewBox="0 0 9 13" fill="none"><path d="M0.632325 6.50016L6.89274 12.7606L8.3667 11.2887L3.57503 6.50016L8.3667 1.71266L6.89378 0.239746L0.632325 6.50016Z" fill="#0b1727"/></svg>');
    $(".shop-by-category > .owl-nav > .owl-next").html('<svg xmlns="http://www.w3.org/2000/svg" class="" width="9" height="13" viewBox="0 0 9 13" fill="none"><path d="M8.36767 6.49984L2.10726 0.239422L0.633301 1.7113L5.42497 6.49984L0.633301 11.2873L2.10622 12.7603L8.36767 6.49984Z" fill="#0b1727"/></svg>');
    $(".product-detail > .owl-nav >  .owl-prev").html('<svg xmlns="http://www.w3.org/2000/svg" class="" width="9" height="13" viewBox="0 0 9 13" fill="none"><path d="M0.632325 6.50016L6.89274 12.7606L8.3667 11.2887L3.57503 6.50016L8.3667 1.71266L6.89378 0.239746L0.632325 6.50016Z" fill="#0b1727"/></svg>');
    $(".product-detail > .owl-nav > .owl-next").html('<svg xmlns="http://www.w3.org/2000/svg" class="" width="9" height="13" viewBox="0 0 9 13" fill="none"><path d="M8.36767 6.49984L2.10726 0.239422L0.633301 1.7113L5.42497 6.49984L0.633301 11.2873L2.10622 12.7603L8.36767 6.49984Z" fill="#0b1727"/></svg>');
    $(".customer-stories > .owl-nav > .owl-prev").html('<svg xmlns="http://www.w3.org/2000/svg" width="9" class="ms-3" height="13" viewBox="0 0 9 13" fill="none"><path d="M0.632325 6.50016L6.89274 12.7606L8.3667 11.2887L3.57503 6.50016L8.3667 1.71266L6.89378 0.239746L0.632325 6.50016Z" fill="#0B1727"/></svg>');
    $(".customer-stories > .owl-nav > .owl-next").html('<svg xmlns="http://www.w3.org/2000/svg" width="9" class="ms-3" height="13" viewBox="0 0 9 13" fill="none"><path d="M8.36767 6.49984L2.10726 0.239422L0.633301 1.7113L5.42497 6.49984L0.633301 11.2873L2.10622 12.7603L8.36767 6.49984Z" fill="#0B1727"/></svg>');
    $(".shop-by-style-slider > .owl-nav > .owl-next").html('<svg xmlns="http://www.w3.org/2000/svg" width="9" class="" height="13" viewBox="0 0 9 13" fill="none"><path d="M8.36767 6.49984L2.10726 0.239422L0.633301 1.7113L5.42497 6.49984L0.633301 11.2873L2.10622 12.7603L8.36767 6.49984Z" fill="#0b1727"/></svg>');
    $(".shop-by-style-slider > .owl-nav > .owl-prev").html('<svg xmlns="http://www.w3.org/2000/svg" width="9" class="" height="13" viewBox="0 0 9 13" fill="none"><path d="M0.632325 6.50016L6.89274 12.7606L8.3667 11.2887L3.57503 6.50016L8.3667 1.71266L6.89378 0.239746L0.632325 6.50016Z" fill="#0b1727"/></svg>');
    $(".home-page-slider > .owl-nav > .owl-next").html('<svg xmlns="http://www.w3.org/2000/svg" width="9" class="" height="13" viewBox="0 0 9 13" fill="none"><path d="M8.36767 6.49984L2.10726 0.239422L0.633301 1.7113L5.42497 6.49984L0.633301 11.2873L2.10622 12.7603L8.36767 6.49984Z" fill="#fff"/></svg>');
    $(".home-page-slider > .owl-nav > .owl-prev").html('<svg xmlns="http://www.w3.org/2000/svg" width="9" class="" height="13" viewBox="0 0 9 13" fill="none"><path d="M0.632325 6.50016L6.89274 12.7606L8.3667 11.2887L3.57503 6.50016L8.3667 1.71266L6.89378 0.239746L0.632325 6.50016Z" fill="#fff"/></svg>');
    $(".products_item > .owl-nav > .owl-next").html('<svg xmlns="http://www.w3.org/2000/svg" width="9" class="" height="13" viewBox="0 0 9 13" fill="none"><path d="M8.36767 6.49984L2.10726 0.239422L0.633301 1.7113L5.42497 6.49984L0.633301 11.2873L2.10622 12.7603L8.36767 6.49984Z" fill="#fff"/></svg>');
    $(".products_item > .owl-nav > .owl-prev").html('<svg xmlns="http://www.w3.org/2000/svg" width="9" class="" height="13" viewBox="0 0 9 13" fill="none"><path d="M0.632325 6.50016L6.89274 12.7606L8.3667 11.2887L3.57503 6.50016L8.3667 1.71266L6.89378 0.239746L0.632325 6.50016Z" fill="#fff"/></svg>');
    $(".product-detail-modal-popup > .owl-nav > .owl-next").html('<svg xmlns="http://www.w3.org/2000/svg" width="9" class="" height="13" viewBox="0 0 9 13" fill="none"><path d="M8.36767 6.49984L2.10726 0.239422L0.633301 1.7113L5.42497 6.49984L0.633301 11.2873L2.10622 12.7603L8.36767 6.49984Z" fill="#fff"/></svg>');
    $(".product-detail-modal-popup > .owl-nav > .owl-prev").html('<svg xmlns="http://www.w3.org/2000/svg" width="9" class="" height="13" viewBox="0 0 9 13" fill="none"><path d="M0.632325 6.50016L6.89274 12.7606L8.3667 11.2887L3.57503 6.50016L8.3667 1.71266L6.89378 0.239746L0.632325 6.50016Z" fill="#fff"/></svg>');
    $(".category-slider > .owl-nav > .owl-next").html('<svg xmlns="http://www.w3.org/2000/svg" width="9" class="" height="13" viewBox="0 0 9 13" fill="none"><path d="M8.36767 6.49984L2.10726 0.239422L0.633301 1.7113L5.42497 6.49984L0.633301 11.2873L2.10622 12.7603L8.36767 6.49984Z" fill="#2c3e50"/></svg>');
    $(".category-slider > .owl-nav > .owl-prev").html('<svg xmlns="http://www.w3.org/2000/svg" width="9" class="" height="13" viewBox="0 0 9 13" fill="none"><path d="M0.632325 6.50016L6.89274 12.7606L8.3667 11.2887L3.57503 6.50016L8.3667 1.71266L6.89378 0.239746L0.632325 6.50016Z" fill="#2c3e50"/></svg>');
    $(".engagement-section > .owl-nav > .owl-next").html('<svg xmlns="http://www.w3.org/2000/svg" width="9" class="" height="13" viewBox="0 0 9 13" fill="none"><path d="M8.36767 6.49984L2.10726 0.239422L0.633301 1.7113L5.42497 6.49984L0.633301 11.2873L2.10622 12.7603L8.36767 6.49984Z" fill="#2c3e50"/></svg>');
    $(".engagement-section > .owl-nav > .owl-prev").html('<svg xmlns="http://www.w3.org/2000/svg" width="9" class="" height="13" viewBox="0 0 9 13" fill="none"><path d="M0.632325 6.50016L6.89274 12.7606L8.3667 11.2887L3.57503 6.50016L8.3667 1.71266L6.89378 0.239746L0.632325 6.50016Z" fill="#2c3e50"/></svg>');
    $(".gifts-slider > .owl-nav > .owl-next").html('<svg xmlns="http://www.w3.org/2000/svg" width="9" class="" height="13" viewBox="0 0 9 13" fill="none"><path d="M8.36767 6.49984L2.10726 0.239422L0.633301 1.7113L5.42497 6.49984L0.633301 11.2873L2.10622 12.7603L8.36767 6.49984Z" fill="#2c3e50"/></svg>');
    $(".gifts-slider > .owl-nav > .owl-prev").html('<svg xmlns="http://www.w3.org/2000/svg" width="9" class="" height="13" viewBox="0 0 9 13" fill="none"><path d="M0.632325 6.50016L6.89274 12.7606L8.3667 11.2887L3.57503 6.50016L8.3667 1.71266L6.89378 0.239746L0.632325 6.50016Z" fill="#2c3e50"/></svg>');
    $(".about-us-slider > .owl-nav > .owl-next").html('<svg xmlns="http://www.w3.org/2000/svg" width="9" class="" height="13" viewBox="0 0 9 13" fill="none"><path d="M8.36767 6.49984L2.10726 0.239422L0.633301 1.7113L5.42497 6.49984L0.633301 11.2873L2.10622 12.7603L8.36767 6.49984Z" fill="#2c3e50"/></svg>');
    $(".about-us-slider > .owl-nav > .owl-prev").html('<svg xmlns="http://www.w3.org/2000/svg" width="9" class="" height="13" viewBox="0 0 9 13" fill="none"><path d="M0.632325 6.50016L6.89274 12.7606L8.3667 11.2887L3.57503 6.50016L8.3667 1.71266L6.89378 0.239746L0.632325 6.50016Z" fill="#2c3e50"/></svg>');
    $(".finejewellery-slider > .owl-nav > .owl-next").html('<svg xmlns="http://www.w3.org/2000/svg" width="9" class="" height="13" viewBox="0 0 9 13" fill="none"><path d="M8.36767 6.49984L2.10726 0.239422L0.633301 1.7113L5.42497 6.49984L0.633301 11.2873L2.10622 12.7603L8.36767 6.49984Z" fill="#2c3e50"/></svg>');
    $(".finejewellery-slider > .owl-nav > .owl-prev").html('<svg xmlns="http://www.w3.org/2000/svg" width="9" class="" height="13" viewBox="0 0 9 13" fill="none"><path d="M0.632325 6.50016L6.89274 12.7606L8.3667 11.2887L3.57503 6.50016L8.3667 1.71266L6.89378 0.239746L0.632325 6.50016Z" fill="#2c3e50"/></svg>');
    $(".most-viewed-slider > .owl-nav > .owl-next").html('<svg xmlns="http://www.w3.org/2000/svg" width="9" class="" height="13" viewBox="0 0 9 13" fill="none"><path d="M8.36767 6.49984L2.10726 0.239422L0.633301 1.7113L5.42497 6.49984L0.633301 11.2873L2.10622 12.7603L8.36767 6.49984Z" fill="#2c3e50"/></svg>');
    $(".most-viewed-slider > .owl-nav > .owl-prev").html('<svg xmlns="http://www.w3.org/2000/svg" width="9" class="" height="13" viewBox="0 0 9 13" fill="none"><path d="M0.632325 6.50016L6.89274 12.7606L8.3667 11.2887L3.57503 6.50016L8.3667 1.71266L6.89378 0.239746L0.632325 6.50016Z" fill="#2c3e50"/></svg>');
    $(".blog-tabs > .owl-nav > .owl-next").html('<svg xmlns="http://www.w3.org/2000/svg" width="9" class="" height="13" viewBox="0 0 9 13" fill="none"><path d="M8.36767 6.49984L2.10726 0.239422L0.633301 1.7113L5.42497 6.49984L0.633301 11.2873L2.10622 12.7603L8.36767 6.49984Z" fill="#2c3e50"/></svg>');
    $(".blog-tabs > .owl-nav > .owl-prev").html('<svg xmlns="http://www.w3.org/2000/svg" width="9" class="" height="13" viewBox="0 0 9 13" fill="none"><path d="M0.632325 6.50016L6.89274 12.7606L8.3667 11.2887L3.57503 6.50016L8.3667 1.71266L6.89378 0.239746L0.632325 6.50016Z" fill="#2c3e50"/></svg>');
});
$(window).scroll(function () {
    var sticky = $('.header-part'),
        scroll = $(window).scrollTop();

    if (scroll > 50) {
        sticky.addClass('sticky-header');
    } else {
        sticky.removeClass('sticky-header');

    }
});


$(document).on("click", "#cust_btn", function () {

    $("#myModal").modal("toggle");

});

$(window).on('load', function () { // makes sure the whole site is loaded 
    $('body').css({ 'overflow': 'hidden' });
    $('.loader-btn').fadeOut(); // will first fade out the loading animation 
    $('.header-loader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website. 
    $('body').delay(350).css({ 'overflow': 'visible' });
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

$(document).ready(function () {
    cartload();

    //$('.add-to-wishlist-btn').click(function (e) {
    $(document).on('click', '.add-to-wishlist-btn', function (e) {


        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var thisdata = $(this);

        var variant_id = $(this).closest('.wire_bangle_shop_radio').find('.variant_id').val();
        var item_type = $(this).closest('.wire_bangle_shop_radio').find('.item_type').val();

        $.ajax({
            url: base_url + "/add-to-wishlist",
            method: "POST",
            data: {
                'variant_id': variant_id,
                'item_type': item_type,
            },
            success: function (response) {
                if (response.action == 'add') {
                    thisdata.closest('.wire_bangle_shop_radio').find('.add-to-wishlist-btn').html('<i class="fas fa-heart heart-icon-part"></i>');
                    // wishload();
                } else if (response.action == 'remove') {
                    thisdata.closest('.wire_bangle_shop_radio').find('.add-to-wishlist-btn').html('<i class="far fa-heart" ></i>');
                    //wishload();
                }
            },
        });
    });


    $(document).on('click', '.add-to-wishlist-btn-details', function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var thisdata = $(this);
        var variant_id = $(this).attr('data-variant_id');
        var item_type = $(this).attr('data-item_typ');

        $.ajax({
            url: base_url + "/add-to-wishlist",
            method: "POST",
            data: {
                'variant_id': variant_id,
                'item_type': item_type,
            },
            success: function (response) {
                if (response.action == 'add') {
                    thisdata.html('<i class="fas fa-heart heart-icon-part"></i> &nbsp; Add to Wishlist');
                    // wishload();
                } else if (response.action == 'remove') {
                    thisdata.html('<i class="far fa-heart" ></i> &nbsp; Add to Wishlist');
                    //wishload();
                }
            },
        });
    });

    $(document).on('click', '.add-to-wishlist-btn-diamond', function (e) {

        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var thisdata = $(this);

        var diamond_id = $(this).closest('.round_cut_lab_diamonds_box').find('.diamond_id').val();
        var item_type = $(this).closest('.round_cut_lab_diamonds_box').find('.item_type').val();

        $.ajax({
            url: base_url + "/add-to-wishlist",
            method: "POST",
            data: {
                'variant_id': diamond_id,
                'item_type': item_type,
            },
            success: function (response) {
                if (response.action == 'add') {
                    thisdata.closest('.round_cut_lab_diamonds_box').find('.add-to-wishlist-btn-diamond').html('<i class="fas fa-heart heart-icon-part"></i>');
                    //wishload();
                } else if (response.action == 'remove') {
                    thisdata.closest('.round_cut_lab_diamonds_box').find('.add-to-wishlist-btn-diamond').html('<i class="far fa-heart"></i>');
                    //wishload();
                }
            },
        });
    });

    $(document).on('click', '.add-to-wishlist-btn-diamond-details', function (e) {

        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var thisdata = $(this);

        var diamond_id = $(this).attr('data-variant_id');
        var item_type = 1;

        $.ajax({
            url: base_url + "/add-to-wishlist",
            method: "POST",
            data: {
                'variant_id': diamond_id,
                'item_type': item_type,
            },
            success: function (response) {
                // console.log(response);
                if (response.action == 'add') {
                    thisdata.html('<i class="fas fa-heart heart-icon-part"></i> &nbsp; Add to Wishlist');
                    //wishload();
                } else if (response.action == 'remove') {
                    thisdata.html('<i class="far fa-heart"></i> &nbsp; Add to Wishlist');
                    //wishload();
                }
            },
        });
    });
});


function cartload() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: base_url + '/load-cart-data',
        method: "GET",
        success: function (response) {
            $('.basket-item-count-cart').html('');
            var parsed = jQuery.parseJSON(response)
            var value = parsed; //Single Data Viewing
            $('.basket-item-count-cart').html(value['totalcart']);
        }
    });
}

$('body').on('click', '#reSet', function () {
    var onlyUrl = window.location.href.replace(window.location.search, '');
    window.location.href = onlyUrl;
    //location.reload();
});
// ------------------------------------------------------//
if ($(window).width() <= 767) {
    $(".row-grid-list").addClass("list");
    $(".table-view-part.list").addClass("list-active");
    $(".table-view-part.grid").removeClass("grid-active");
}

$('.table-grid-view>.table-view-part').on('click', function (e) {
    if ($(this).hasClass('list')) {
        $('.row-grid-list').removeClass('grid').addClass('list');
    } else if ($(this).hasClass('grid')) {
        $('.row-grid-list').removeClass('list').addClass('grid');
    }
});

$(".table-grid-view>.table-view-part.grid").click(function () {
    $(this).addClass("grid-active");
    $(".table-view-part.list").removeClass("list-active");
});
$(".table-grid-view>.table-view-part.list").click(function () {
    $(this).addClass("list-active");
    $(".table-view-part.grid").removeClass("grid-active");
});

// ------------------------------------------------------------//
// $(window).on('load', function() {
//     $(".header-part").css('top', $(".home-page-slider-header").height() + "px");
// });