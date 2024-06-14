<?php
$settings = \App\Models\Settings::first();
?>

<!doctype html>
<html>

<head>
    <!-- Required meta tags -->
    <title>{{ isset($meta_title) ? $meta_title : $settings->company_name }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL('images/company/'.$settings->company_favicon) }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="canonical" href="{{ url()->full() }}" />
    <meta name="title" content="{{ isset($meta_title) ? $meta_title:"" }}"/>
    <meta name="description" content="{{ isset($meta_description) ? $meta_description :"" }}"/>
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}">
    <link href="{{ asset('plugins/toastr/css/toastr.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick-lightbox.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.35/sweetalert2.css"  /> --}}
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/> --}}
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.css" rel="stylesheet" /> --}}
    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
    <!-- TrustBox script -->
    {{-- <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script> --}}
    <!-- End TrustBox script -->

    <!-- Google tag (gtag.js) -->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-962R43V393"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'AW-11131777521');
    </script> -->
    
    <!-- Google tag (gtag.js) -->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-962R43V393"></script>
    
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-962R43V393');
    </script> -->

    <!-- Google Tag Manager -->
        <!-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-K6JH68V');</script> -->
    <!-- End Google Tag Manager -->

    <!-- <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "g2tcy46q6v");
    </script> -->

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KFKXFNTF');</script>
    <!-- End Google Tag Manager -->

    <!-- Meta Pixel Code -->
    <!-- <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1935321983596004');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1935321983596004&ev=PageView&noscript=1"/></noscript> -->
    <!-- End Meta Pixel Code -->
    
</head>
<body>
<!-- Google Tag Manager (noscript) -->
    <!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K6JH68V"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->
<!-- End Google Tag Manager (noscript) -->

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KFKXFNTF"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div class="header-loader">
    <div class="loader-btn" role="status"> 
    <img src="{{ asset('frontend/image/page-loader.gif') }}" alt="">
    </div>
</div> 

<input type="hidden" name="web_url" value="{{ url("/") }}" id="web_url">

@include('frontend.layout.header')
@yield('content')
@include('frontend.layout.footer')
<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/custom.js') }}"></script>
<script src="{{ asset('frontend/js/slick.js') }}"></script>   
{{-- <script src="{{ asset('frontend/js/all.min.js') }}"></script>     --}}
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.0/jquery.cookie.min.js"></script> --}}
<script src="{{ asset('frontend/js/jquery.cookie.min.js') }}"></script>  
<script src="{{ asset('plugins/toastr/js/toastr.min.js') }}"></script>
<script src="{{ asset('plugins/toastr/js/toastr.init.js') }}"></script>
<script src="{{ asset('frontend/js/select2.min.js') }}"></script> 
<script src="{{ asset('frontend/js/sweetalert2.min.js') }}"></script> 
<script src="{{ asset('frontend/js/slick-lightbox.min.js') }}"></script> 

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.35/sweetalert2.min.js" ></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.min.js"></script> --}}
<script src="//code.tidio.co/tq3yyhojklue6eb308n5honxttekkw0y.js" async></script>
<script>
    $(document).ready(function() {   
        $("#main_search").keyup(function() {
            search_data($(this).val());
        });

        function search_data(keyword)
        {
        
            var action = "search";
            $.ajax({
            // url:"{{ url('/product-filter') }}",
            // url: ENDPOINT + "/search_products",
                url:"{{ url('/search_products') }}",
                method:"POST",
                data:{action:action,keyword:keyword,_token: '{{ csrf_token() }}'},
                beforeSend: function() {
                    $('.serach-load').show();
                },
                success:function(response){
                    if(response != ""){
                        $('#mega-menu-scrollbar').show();
                        $('.main_search_section').html(response);
                        $('.serach-load').hide(); 
                    }else{
                        $('#mega-menu-scrollbar').hide();
                        $('.main_search_section').html(response);
                        $('.serach-load').hide();   
                    }
                    // if(scroll == 1){
                    //     if (response['artilces'] == "") {
                    //         $('.auto-load').html("We don't have more data to display ");
                    //         return;
                    //     }
                    //     $('.auto-load').hide();   
                    //     $("#data-wrapper").append(response['artilces']);
                    // }else{
                    //     if (response['artilces'] == "") {
                    //         $('#data-wrapper').html("No Result Found");
                    //         $('.auto-load').hide();
                    //         return;
                    //     }
                    //     $("#data-wrapper").html(response['artilces']);  
                    //     $('.auto-load').hide(); 
                    // }  
                    
                }
            });
        }

        $('body').on('click', '#searchBtn', function () {
            var main_search = $("#main_search").val();
            location.href = "{{ url('shop') }}?s="+main_search;
        });
   });
</script>
<script>
    window.addEventListener('load', function() {

        jQuery('body').on('mousedown', '[href*="https://api.whatsapp.com/"]', function() {
        gtag('event', 'conversion', {
            'send_to': 'AW-11131777521/QLl9CPLT-pwYEPHjhbwp'
        });
        })

        jQuery('body').on('mousedown', '[href*="tel:"]', function() {
            gtag('event', 'conversion', {
                'send_to': 'AW-11131777521/WxyzCN6p7pwYEPHjhbwp'
            });
        })

        jQuery('body').on('mousedown', '[href*="mailto:"]', function() {
            gtag('event', 'conversion', {
                'send_to': 'AW-11131777521/abGNCOGp7pwYEPHjhbwp'
            });
        })


    });

</script>
</body>
</html>

