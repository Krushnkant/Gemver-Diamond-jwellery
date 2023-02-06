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

$(".Instagram-post-slider > .owl-nav >  .owl-prev").html('<svg xmlns="http://www.w3.org/2000/svg" class="" width="9" height="13" viewBox="0 0 9 13" fill="none"><path d="M0.632325 6.50016L6.89274 12.7606L8.3667 11.2887L3.57503 6.50016L8.3667 1.71266L6.89378 0.239746L0.632325 6.50016Z" fill="#0b1727"/></svg>');
$(".Instagram-post-slider > .owl-nav > .owl-next").html('<svg xmlns="http://www.w3.org/2000/svg" class="" width="9" height="13" viewBox="0 0 9 13" fill="none"><path d="M8.36767 6.49984L2.10726 0.239422L0.633301 1.7113L5.42497 6.49984L0.633301 11.2873L2.10622 12.7603L8.36767 6.49984Z" fill="#0b1727"/></svg>');