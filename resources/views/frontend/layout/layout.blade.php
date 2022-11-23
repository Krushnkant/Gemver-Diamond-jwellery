<?php
$settings = \App\Models\Settings::first();
?>

<!doctype html>
<html>

<head>
    <!-- Required meta tags -->
    <title>{{ $settings->company_name }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL('images/company/'.$settings->company_favicon) }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="title" content="{{ isset($meta_title) ? $meta_title:"" }}"/>
    <meta name="description" content="{{ isset($meta_description) ? $meta_description :"" }}"/>
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}">
    <link href="{{ asset('plugins/toastr/css/toastr.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.35/sweetalert2.css"  />
    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
    <!-- TrustBox script -->
    <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
<!-- End TrustBox script -->
    
</head>
<body>


{{-- <div class="header-loader">
    <div class="loader-btn" role="status"> 
    <img src="{{ asset('frontend/image/loader.gif') }}" alt="">
    </div>
</div> --}}
<input type="hidden" name="web_url" value="{{ url("/") }}" id="web_url">
<div class="">

@include('frontend.layout.header')
@yield('content')
@include('frontend.layout.footer')
        

<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/custom.js') }}"></script>
<script src="{{ asset('frontend/js/slick.js') }}"></script>   
<script src="{{ asset('frontend/js/all.min.js') }}"></script>   
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.0/jquery.cookie.min.js"></script>

<script src="{{ asset('plugins/toastr/js/toastr.min.js') }}"></script>
<script src="{{ asset('plugins/toastr/js/toastr.init.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.35/sweetalert2.min.js" ></script>
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

</body>
</html>

