@extends('frontend.layout.layout')

@section('content')

<div class="background-sub-slider">
            <div class="">
                <div class="about_us_background">
                    <div class="sub_heading mb-lg-3"> My Account</div>
                    <div class="about_us_link">
                        <a href="{{ URL('/') }}">home</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none" class="mx-2">
                            <path d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z" fill="white"/>
                            <path d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z" fill="white"/>
                        </svg>
                        <a href="#">My Account </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <div class="my_account_heading">
                    Hi {{ session("customer.full_name") }} <br>
                    Welcome to your Account
                </div>
            </div>
        </div>
        <ul class="nav nav-pills my-4 my_account_tab" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="order-part-tab" data-bs-toggle="pill" data-bs-target="#order-part" type="button" role="tab" aria-controls="order-part" aria-selected="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="21" viewBox="0 0 17 21" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.442129 9.18474L0.454905 9.18049L5.08119 7.52421L6.07983 8.65632L2.50281 9.93643L8.50009 12.763L14.4974 9.93643L10.9366 8.662L11.9271 7.52707L16.5453 9.18065L16.5581 9.1849C16.5662 9.18836 16.5736 9.19119 16.5817 9.1948L16.5999 9.20251L16.6187 9.21163L16.6281 9.21651C16.6322 9.21855 16.6355 9.22075 16.6396 9.2228L16.6504 9.22909L16.6564 9.23255C16.6934 9.25362 16.7278 9.27909 16.7601 9.30725L16.7736 9.3192L16.7851 9.32973L16.7924 9.33744L16.8025 9.34735L16.8147 9.36071L16.8288 9.37691L16.8348 9.38399C16.8402 9.39028 16.8456 9.39673 16.8503 9.40302L16.8625 9.41859L16.8685 9.42771L16.8805 9.44469L16.8886 9.45806L16.8981 9.47284L16.9089 9.49108L16.9109 9.49454C16.9149 9.50225 16.919 9.51011 16.9223 9.51703L16.931 9.53402L16.9337 9.54031C16.9411 9.55587 16.9478 9.57207 16.9539 9.58827L16.9579 9.59881C16.9633 9.61579 16.9693 9.63262 16.9741 9.65023L16.9769 9.66218C16.9802 9.67492 16.9836 9.68829 16.9863 9.70087L16.9896 9.72052L16.9923 9.73609L16.9943 9.74883L16.9962 9.76927L16.9982 9.79113L16.9988 9.80104L16.9994 9.81441L17 9.83548V16.2036C17 16.4706 16.8559 16.7144 16.6283 16.8334L8.80097 20.9281L8.69726 20.9719L8.57265 20.9986L8.44534 21L8.31938 20.9767L8.20019 20.9288L0.371711 16.8333C0.144145 16.7142 0 16.4705 0 16.2034V9.82403L0.000601229 9.81349L0.00120246 9.79793L0.00255522 9.77968L0.00390799 9.76915L0.00526075 9.75782L0.00661351 9.74304L0.0106718 9.72055L0.0139786 9.7009C0.0166841 9.68816 0.019991 9.67479 0.0234479 9.66221L0.0261534 9.65026C0.0315643 9.63265 0.0369754 9.61566 0.0423866 9.59884L0.0464449 9.5883C0.0524572 9.5721 0.0592209 9.5559 0.0665861 9.54034L0.0753039 9.52272L0.0780094 9.51706C0.0813161 9.50998 0.0853744 9.50228 0.0894327 9.49457L0.0995039 9.47759L0.108221 9.46344L0.113632 9.45494L0.120396 9.44441L0.128513 9.43246L0.137982 9.4183L0.144746 9.40981L0.150157 9.40273C0.154816 9.39644 0.160227 9.39 0.165638 9.38371L0.178414 9.36814L0.193294 9.35257L0.200058 9.34486L0.208776 9.33637L0.217494 9.32725L0.232975 9.3131L0.240341 9.3068C0.272656 9.27866 0.307078 9.25334 0.344052 9.23211L0.354122 9.22581L0.360886 9.22235C0.364945 9.22031 0.368252 9.21811 0.37231 9.21606L0.383733 9.2104L0.400567 9.20191L0.410638 9.19767L0.418755 9.19421C0.426871 9.19075 0.434236 9.18791 0.442353 9.1843L0.442129 9.18474ZM8.02434 10.3409C8.15225 10.4861 8.33202 10.5685 8.52064 10.5678C8.70912 10.5672 8.88904 10.484 9.01621 10.3382L12.707 6.1111C12.8868 5.9054 12.9332 5.60738 12.8254 5.3523C12.7184 5.0966 12.4766 4.93164 12.2093 4.93164H10.6418L11.2054 0.803928C11.2331 0.601693 11.1758 0.397397 11.0479 0.243126C10.92 0.0888548 10.7341 0 10.5388 0H6.49856C6.30391 0 6.11813 0.0886937 5.99022 0.243126C5.86231 0.397397 5.80504 0.601677 5.8327 0.803928L6.3956 4.93164H4.79031C4.52231 4.93164 4.28062 5.09724 4.17284 5.35371C4.06583 5.6102 4.11362 5.90819 4.29534 6.11392L8.02446 10.3411L8.02434 10.3409Z" fill="#0B1727"/>
                </svg>
                <span class="ms-2 ms-md-2">
                    <a href="{{ url('/cart') }}"> Order </a>
                </span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="cart-part-tab" data-bs-toggle="pill" data-bs-target="#cart-part" type="button" role="tab" aria-controls="cart-part" aria-selected="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.9257 0.209157C11.0597 0.0752338 11.2413 0 11.4307 0C11.6201 0 11.8018 0.0752338 11.9357 0.209157L16.7243 4.99828H18.5714C18.9503 4.99828 19.3137 5.14881 19.5816 5.41675C19.8495 5.68468 20 6.04809 20 6.42701V8.57012C20 8.94904 19.8495 9.31244 19.5816 9.58038C19.3137 9.84832 18.9503 9.99885 18.5714 9.99885H17.8571L16.6036 18.7734C16.5549 19.1139 16.3851 19.4254 16.1253 19.6507C15.8655 19.876 15.5332 20 15.1893 20H4.81071C4.46684 20 4.1345 19.876 3.8747 19.6507C3.6149 19.4254 3.44509 19.1139 3.39643 18.7734L2.14286 9.99885H1.42857C1.04969 9.99885 0.686328 9.84832 0.418419 9.58038C0.15051 9.31244 0 8.94904 0 8.57012V6.42701C0 6.04809 0.15051 5.68468 0.418419 5.41675C0.686328 5.14881 1.04969 4.99828 1.42857 4.99828H3.32857C3.33929 4.98613 3.35 4.97399 3.36214 4.96256L8.11429 0.209871C8.249 0.0797436 8.42943 0.00773938 8.61672 0.00936701C8.804 0.0109946 8.98315 0.086124 9.11559 0.218574C9.24802 0.351023 9.32314 0.530195 9.32477 0.7175C9.3264 0.904805 9.2544 1.08526 9.12429 1.21999L5.34643 4.99899H14.7036L10.925 1.21927C10.7911 1.08531 10.7159 0.90364 10.7159 0.714215C10.7159 0.52479 10.7918 0.343121 10.9257 0.209157ZM11.4286 12.142C11.4286 11.9525 11.5038 11.7708 11.6378 11.6368C11.7717 11.5029 11.9534 11.4276 12.1429 11.4276C12.3323 11.4276 12.514 11.5029 12.6479 11.6368C12.7819 11.7708 12.8571 11.9525 12.8571 12.142V16.4282C12.8571 16.6176 12.7819 16.7993 12.6479 16.9333C12.514 17.0673 12.3323 17.1425 12.1429 17.1425C11.9534 17.1425 11.7717 17.0673 11.6378 16.9333C11.5038 16.7993 11.4286 16.6176 11.4286 16.4282V12.142ZM7.85714 11.4276C7.6677 11.4276 7.48602 11.5029 7.35207 11.6368C7.21811 11.7708 7.14286 11.9525 7.14286 12.142V16.4282C7.14286 16.6176 7.21811 16.7993 7.35207 16.9333C7.48602 17.0673 7.6677 17.1425 7.85714 17.1425C8.04658 17.1425 8.22826 17.0673 8.36222 16.9333C8.49617 16.7993 8.57143 16.6176 8.57143 16.4282V12.142C8.57143 11.9525 8.49617 11.7708 8.36222 11.6368C8.22826 11.5029 8.04658 11.4276 7.85714 11.4276Z" fill="#0B1727"/>
                    </svg>
                    <span class="ms-2 ms-md-1">
                       <a href="{{ url('/cart') }}"> Cart </a>
                    </span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link heart-icon" id="wishlist-part-tab" data-bs-toggle="pill" data-bs-target="#wishlist-part" type="button" role="tab" aria-controls="wishlist-part" aria-selected="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="15" viewBox="0 0 19 15" fill="none">
                        <path d="M13.8221 0C10.5897 0 9.5 2.63022 9.5 2.63022C9.5 2.63022 8.41149 0 5.17786 0C1.94634 0 0 2.82455 0 5.1525C0 9.05384 9.5 15 9.5 15C9.5 15 19 9.05518 19 5.1533C19 2.82453 17.0544 0 13.8221 0Z" fill="#0B1727"/>
                    </svg>
                    <span class="ms-2 ms-md-1"> 
                        <a href="{{ url('/wishlist') }}"> Wishlist </a>
                    </span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="address-part-tab" data-bs-toggle="pill" data-bs-target="#address-part" type="button" role="tab" aria-controls="address-part" aria-selected="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="23" viewBox="0 0 18 23" fill="none">
                        <path d="M16.9849 4.4348C14.7656 0.465198 9.35242 -1.13233 4.91367 0.85252C0.474931 2.83741 -1.2302 7.84774 0.935044 11.6479C1.9094 13.3422 5.69852 19.2482 7.70142 22.3465C8.26989 23.2178 9.65014 23.2178 10.1914 22.3465C12.1942 19.2481 15.9564 13.3422 16.9849 11.6479C18.3653 9.42105 18.3111 6.78272 16.9849 4.43484V4.4348ZM8.9735 11.5268C6.83542 11.5268 5.07602 9.97772 5.07602 8.04129C5.07602 6.12919 6.80821 4.55574 8.9735 4.55574C11.1388 4.55574 12.871 6.12897 12.871 8.04129C12.8708 9.95356 11.1386 11.5268 8.9735 11.5268Z" fill="#0B1727"/>
                    </svg>
                    <span class="ms-2 ms-md-1">
                        <a href="{{ url('/address') }}"> Address </a>
                    </span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="account-part-tab" data-bs-toggle="pill" data-bs-target="#account-part" type="button" role="tab" aria-controls="account-part" aria-selected="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                        <path d="M20.35 6.6V5.5H1.65V6.6H19.8H20.35ZM1.1 20.9H0V22H22V20.9H20.9H1.1ZM18.15 7.7H19.25V17.6H18.15V7.7ZM10.45 7.7H11.55V17.6H10.45V7.7ZM12.65 7.7H17.05V17.6H12.65V7.7ZM1.65 19.8H20.35V18.7H1.65V19.8ZM2.75 7.7H3.85V17.6H2.75V7.7ZM4.95 7.7H9.35V17.6H4.95V7.7ZM11 0L0 3.135V4.4H22V3.19L11 0ZM7.15 3.3C6.82 3.3 6.6 3.08 6.6 2.75C6.6 2.42 6.82 2.2 7.15 2.2C7.48 2.2 7.7 2.42 7.7 2.75C7.7 3.08 7.48 3.3 7.15 3.3ZM11 3.3C10.395 3.3 9.9 2.805 9.9 2.2C9.9 1.595 10.395 1.1 11 1.1C11.605 1.1 12.1 1.595 12.1 2.2C12.1 2.805 11.605 3.3 11 3.3ZM14.85 3.3C14.52 3.3 14.3 3.08 14.3 2.75C14.3 2.42 14.52 2.2 14.85 2.2C15.18 2.2 15.4 2.42 15.4 2.75C15.4 3.08 15.18 3.3 14.85 3.3Z" fill="#BB9761"/>
                    </svg>
                    <span class="ms-2 ms-md-1">
                        <a href="{{ url('/account') }}">Account </a>
                    </span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="logout-part-tab" data-bs-toggle="pill" data-bs-target="#logout-part" type="button" role="tab" aria-controls="logout-part" aria-selected="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 20 22" fill="none">
                        <path d="M10.0023 0C9.32774 0 8.62711 0.794737 8.64293 1.46669V10.2668C8.63223 11.0418 9.2463 11.7335 10.0023 11.7335C10.7584 11.7335 11.3724 11.0418 11.3617 10.2668V1.46669C11.3826 0.579134 10.6769 0 10.0023 0ZM5.21767 3.66673C5.09294 3.69505 4.97204 3.74154 4.85993 3.80423C0.567919 6.1092 -0.746913 10.8414 0.388029 14.7587C1.52338 18.6748 5.08152 22 9.95736 22C14.7641 22 18.3672 18.8481 19.5721 14.9875C20.7754 11.127 19.489 6.44637 15.1002 3.84949C14.4791 3.47758 13.5848 3.71755 13.2214 4.35365C12.8586 4.98961 13.0927 5.90675 13.7136 6.2787C17.1348 8.30244 17.8384 11.4037 16.978 14.162C16.1175 16.9202 13.6239 19.2036 9.95736 19.2036C6.27141 19.2036 3.80798 16.7832 2.98171 13.9327C2.15524 11.0822 2.91448 7.99557 6.1116 6.27829C6.65347 5.97578 6.94032 5.26258 6.76382 4.65659C6.58751 4.05042 5.96642 3.61486 5.3514 3.6659C5.30668 3.66377 5.2618 3.66377 5.21725 3.6659L5.21767 3.66673Z" fill="#0B1727"/>
                    </svg>
                    <span class="ms-2 ms-md-1">
                       <a href="/frontend/logout"> Logout</a> 
                    </span>
                </button>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="account-part" role="tabpanel" aria-labelledby="account-part-tab">
                <div class="account-part">
                    <form action="" class="mb-0">
                        <div class="row">
                            <div class="col-12 col-lg-7">
                                <div class="row">
                                    <div class="password_heading mb-4">
                                        Profile
                                    </div>
                                    <div class="col-md-6 mb-3 mb-md-4 popup_padding">
                                        <label for="" class="form-label form_heading">First name</label>
                                        <input type="email" class="form-control" id="" placeholder="Emily" value="{{ $user->first_name }}">
                                    </div>
                                    <div class="col-md-6 mb-3 mb-md-4">
                                        <label for="" class="form-label form_heading">Last name</label>
                                        <input type="email" class="form-control" id="" placeholder="John" value="{{ $user->last_name }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3 mb-md-4">
                                        <label for="" class="form-label form_heading">Phone number</label>
                                        <input type="number" class="form-control" id="" placeholder="123-456-2369" value="{{ $user->mobile_no }}">
                                    </div>
                                    <div class="col-md-12 mb-3 mb-md-4">
                                        <label for="" class="form-label form_heading">Email Address</label>
                                        <input type="email" class="form-control" id="" placeholder="Emilyjohn1212@gmail.com" value="{{ $user->email }}">
                                    </div>
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-secondary save_chnages_btn d-inline-block">Save</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-5 mt-4 mt-lg-0 ps-xxl-5">
                                <div class="row">
                                    <div class="password_heading mb-4">
                                        Password Change
                                    </div>
                                    <div class="col-md-6 mb-3 mb-md-4 popup_padding">
                                        <label for="" class="form-label form_heading">Current Password</label>
                                        <input type="email" class="form-control" id="" placeholder="**********">
                                    </div>
                                    <div class="col-md-6 mb-3 mb-md-4">
                                        <label for="" class="form-label form_heading">New Password</label>
                                        <input type="email" class="form-control" id="" placeholder="**********">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3 mb-md-4">
                                        <label for="" class="form-label form_heading">New Password</label>
                                        <input type="number" class="form-control" id="" placeholder="123-456-2369">
                                    </div>
                                    <div class="col-md-12 mb-3 mb-md-4">
                                        <label for="" class="form-label form_heading">Confirm New Password</label>
                                        <input type="email" class="form-control" id="" placeholder="***********">
                                    </div>
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-secondary save_chnages_btn d-inline-block">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  

@endsection()
