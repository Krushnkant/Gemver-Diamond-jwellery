@extends('frontend.layout.layout')

@section('content')

<div class="container">
   <div class="message_box my-5 py-5 text-center">
        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="mb-3 mb-md-5 message_box_icon" width="83" height="60" viewBox="0 0 83 60" fill="none">
            <path d="M8.89258 0C3.95612 0 0 4.21666 0 9.21886V50.7497C0 55.7519 3.9563 60 8.89258 60H74.1074C79.0439 60 83 55.7519 83 50.7497V9.21886C83 4.21666 79.0437 0 74.1074 0H8.89258ZM9.32473 6.00043H73.7067L43.2608 35.2508C42.1532 36.3152 40.9132 36.3166 39.8021 35.2508L9.32473 6.00043ZM5.92813 11.0005L26.1225 30.3757L5.92813 50.751V11.0005ZM77.0716 11.0005V50.751L56.939 30.3436L77.0716 11.0005ZM52.6778 34.4704L71.914 54.0028H11.1157L30.4155 34.5026L35.7269 39.596C38.9463 42.6841 44.1185 42.6889 47.3373 39.596L52.6778 34.4704Z" fill="#008FE7"/>
        </svg> --}}
        <img src="{{ url('/images/cancel.png') }}" class="logo-image mb-5">
        <div class="message_box_heading mb-3 mb-xl-5">
            Payment was cancelled.
        </div>
        {{-- <p class="message_box_paragraph">
            A link to reset your password has been sent to
            {{ session('customer.email') }}
        </p> --}}
        <div class="login_btn mt-3 mt-md-4 mt-xl-5">
            <button class="login_button continue_shopping_btn" >Continue Shopping</button>
        </div>
   </div>

   {{-- <div class="true_icon_box d-flex mx-auto mb-5 align-items-center">
       <span>
        <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 42 42" fill="none">
                <circle cx="21" cy="21" r="21" fill="white"/>
                <path d="M32.9997 13.8852C33.0084 13.3677 32.8263 12.9284 32.4538 12.5669C32.0724 12.1974 31.6175 12.0085 31.089 12.0003C30.5429 11.992 30.0794 12.1685 29.698 12.53L16.6606 24.4926L12.3971 19.9958C12.0332 19.6181 11.5826 19.4168 11.0452 19.3922C10.508 19.3594 10.0401 19.5154 9.64152 19.8604C9.24288 20.1971 9.03048 20.6201 9.00452 21.1294C8.96985 21.6384 9.13451 22.0862 9.4985 22.4722L15.1138 28.3981C15.3478 28.6444 15.6381 28.8169 15.9847 28.9154C16.3227 29.0141 16.6649 29.0265 17.0116 28.9524C17.3582 28.8704 17.6615 28.7143 17.9215 28.4844L32.4147 15.1789C32.796 14.8176 32.991 14.3864 32.9997 13.8854L32.9997 13.8852Z" fill="#367A01"/>
            </svg>
       </span>
        <span class="ms-3 true_icon_box_heading">
            Password reset link has been sent to your
            Email Address
        </span>
   </div> --}}
</div>

<script type="text/javascript">
    $(document).ready(function() {    
        $('.continue_shopping_btn').click(function () {
         location.href="{{ url('/shop') }}";
      });
    });
</script>
  
@endsection()
