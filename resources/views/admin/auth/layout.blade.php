
<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $page }}</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
    <link href="{{asset('plugins/toastr/css/toastr.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

</head>

<body class="h-100">

<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="loader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
        </svg>
    </div>
</div>
<!--*******************
    Preloader end
********************-->
<div class="login-form-bg h-100">
    <div class="container h-100">
        @yield('content')
    </div>
</div>

<!--**********************************
    Scripts
***********************************-->
<script src="{{asset('js/common.min.js') }}"></script>
<script src="{{asset('js/custom.min.js') }}"></script>
<script src="{{asset('js/settings.js') }}"></script>
<script src="{{asset('js/gleek.js') }}"></script>
<script src="{{asset('js/styleSwitcher.js') }}"></script>
<script src="{{asset('plugins/toastr/js/toastr.min.js') }}"></script>
<script src="{{asset('plugins/toastr/js/toastr.init.js') }}"></script>

<!--login page JS start -->
<script type="text/javascript">
    $('#LoginForm').on('submit', function (e) {
        $("#email-error").html("");
        $("#password-error").html("");
        var thi = $(this);
        $('#loginSubmit').find('.loadericonfa').show();
        $('#loginSubmit').prop('disabled',true);
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: "{{ route('admin.postlogin') }}",
            data: formData,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#loginSubmit').find('.loadericonfa').hide();
                    $('#loginSubmit').prop('disabled',false);
                    if (res.errors.email) {
                        $('#email-error').show().text(res.errors.email);
                    } else {
                        $('#email-error').hide();
                    }

                    if (res.errors.password) {
                        $('#password-error').show().text(res.errors.password);
                    } else {
                        $('#password-error').hide();
                    }
                }

                if(res.status == 200){
                    $('#loginSubmit').prop('disabled',false);
                    toastr.success("You have Successfully loggedin",'Success',{timeOut: 5000});
                    location.href ="{{ url('admin/dashboard') }}";
                }

                if(res.status == 300){
                    $('#loginSubmit').find('.loadericonfa').hide();
                    $('#loginSubmit').prop('disabled',false);
                    toastr.error("Your Account is Deactive..Please Contact Admin",'Error',{timeOut: 5000});
                }

                if(res.status == 400){
                    $('#loginSubmit').find('.loadericonfa').hide();
                    $('#loginSubmit').prop('disabled',false);
                    toastr.error("Opps! You have entered invalid credentials",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $('#loginSubmit').find('.loadericonfa').hide();
                $('#loginSubmit').prop('disabled',false);
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });
</script>
<!--login page JS end -->

</body>
</html>





