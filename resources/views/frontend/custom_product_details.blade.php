@extends('frontend.layout.layout')

@section('content')
        <div class="background-sub-slider">
            <div class="position-relative">
                <img src="image/about_us.png" alt="">
                <div class="about_us_background">
                    <div class="sub_heading mb-lg-3">engagement ring setting</div>
                    <div class="about_us_link">
                        <a href="#">home</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none" class="mx-2">
                            <path d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z" fill="white"/>
                            <path d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z" fill="white"/>
                        </svg>
                        <a href="#">engagement ring setting</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="wire_bangle_page container">
        <div class="row mb-lg-5 pb-lg-5 mb-4  align-items-center step-progressbar-row">
            <div class="col-lg-2 text-center text-lg-start">
                <div class="step-progressbar-side-heading mb-3 mb-lg-0">Create Your Ring</div>
            </div>
            <div class="col-lg-10">
                <div class="flex-container step-progressbar">
                    <div class="flex-row text-center">
                        <div class="flex-col-xs-12">
                            <ul class="tab-steps--list">
                                <li class="active" data-step="1">
                                    <div class="step-img">
                                        <img src="{{ url('frontend/image/step-1.png') }}" alt="">
                                    </div>
                                    <div class="step-heading mt-2">
                                        choose setting
                                    </div>
                                </li>
                                <li data-step="2">
                                    <div class="step-img">
                                        <img src="{{ url('frontend/image/step-2.png') }}" alt="">
                                    </div>
                                    <div class="step-heading mt-2">
                                        choose diamond
                                    </div>
                                    <a href="#" class="step-heading-link mt-2 d-block">browse lab diamonds</a>
                                </li>
                                <li data-step="3">
                                    <div class="step-img">
                                        <img src="{{ url('frontend/image/step-3.png') }}" alt="">
                                    </div>
                                    <div class="step-heading mt-2">
                                        complete the ring
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-6 wire_bangle_padding mb-4">
                <div class="">
                    <div class="slider slider-single mb-5">
                        <div class="product_slider_main_item">
                            <img src="{{ url('frontend/image/slider-1.png') }}" alt="">
                        </div>
                        <div class="product_slider_main_item">
                            <img src="{{ url('frontend/image/slider-2.png') }}" alt="">
                        </div>
                        <div class="product_slider_main_item">
                            <img src="{{ url('frontend/image/slider-3.png') }}" alt="">
                        </div>
                        <div class="product_slider_main_item">
                            <img src="{{ url('frontend/image/slider-1.png') }}" alt="">
                        </div>
                        <div class="product_slider_main_item">
                            <img src="{{ url('frontend/image/slider-2.png') }}" alt="">
                        </div>
                        <div class="product_slider_main_item">
                            <img src="{{ url('frontend/image/slider-3.png') }}" alt="">
                        </div>
                    </div>
                    <div class="slider slider-nav">
                        <div class="product_slider_item">
                            <h3><img src="{{ url('frontend/image/slider-1.png') }}" alt=""></h3>
                        </div>
                        <div class="product_slider_item">
                            <h3><img src="{{ url('frontend/image/slider-2.png') }}" alt=""></h3>
                        </div>
                        <div class="product_slider_item">
                            <h3><img src="{{ url('frontend/image/slider-3.png') }}" alt=""></h3>
                        </div>
                        <div class="product_slider_item">
                            <h3><img src="{{ url('frontend/image/slider-1.png') }}" alt=""></h3>
                        </div>
                        <div class="product_slider_item">
                            <h3><img src="{{ url('frontend/image/slider-2.png') }}" alt=""></h3>
                        </div>
                        <div class="product_slider_item">
                            <h3><img src="{{ url('frontend/image/slider-3.png') }}" alt=""></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 wire_bangle_padding_2">
                <div class="wire_bangle_content">
                    <div class="">
                        <div class="wire_bangle_heading mb-2 mb-xl-4 pb-xxl-2">Janes Chevron Diamond Ring</div>
                        <div class="d-flex mb-2 mb-xl-4 pb-xxl-2">
                            <span class="wire_bangle_price">$390
                                <sub class="ms-2 wire_bangle_dublicate_price">$480</sub>
                            </span>

                        </div>
                        <p class="wire_bangle_paragraph mb-xl-4">Expressing love, affection, and commitment, these heart shaped diamond stud earrings are true stunners. The heart shaped lab diamonds are set in three prongs along with the sturdy post and push-back altogether giving a secured
                            and glamorous look to the wearer.</p>
                        <div class="d-flex mb-md-4 flex-wrap mb-3 mb-md-0">
                            <span class="wire_bangle_input">
                                <div class="wire_bangle_number number-input">
                                    <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></button>
                                    <input class="quantity" min="0" placeholder="0" name="quantity" value="1" type="number">
                                    <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                                </div>
                            </span>
                            <span class="inquiry_now_btn ms-3 ms-md-5">
                                <button class="select_setting_btn diamond-btn" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">inquiry now</button>
                            </span>
                            <div class="modal fade inquiry_now_modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="mb-xxl-5 mb-xl-4 mb-3 product_heading">product inquiry</div>
                                        <div class="row">
                                            <div class="d-flex align-items-center mb-4 col-md-4">
                                                <span class="wire_bangle_color_heading  d-inline-block">color :</span>
                                                <span class="ms-2 d-inline-block wire_bangle_color_heading ">Rose gold</span>
                                            </div>
                                            <div class="d-flex align-items-center mb-4 align-content-center col-md-4">
                                                <span class="wire_bangle_color_heading  d-inline-block">carat :</span>
                                                <span class="ms-2 d-inline-block wire_bangle_color_heading ">10kt</span>
                                            </div>
                                            <div class="d-flex align-items-center mb-4 col-md-4">
                                                <span class="wire_bangle_color_heading  d-inline-block">Prong Type :</span>
                                                <span class="ms-2 d-inline-block wire_bangle_color_heading ">Round</span>
                                            </div>
                                        </div>
                                        <input type="text" placeholder="your name" class="d-block mb-3 wire_bangle_input">
                                        <input type="text" placeholder="phone" class="d-block mb-3 wire_bangle_input">
                                        <input type="text" placeholder="username123@gmail.com" class="d-block mb-3 wire_bangle_input">
                                        <input type="text" placeholder="enquiry" class="d-block mb-3 wire_bangle_input">
                                        <input type="text" placeholder="phone" class="d-block mb-3 wire_bangle_input">
                                        <button class="send_inquiry_btn">send inquiry</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="" class="mb-4 mb-lg-5">
                            <div class="wire_bangle_color_heading mb-2">color</div>
                            <div class="wire_bangle_color mb-xxl-4 pb-md-2">
                                <span class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </span>
                                <span class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                </span>
                                <span class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                                </span>
                            </div>
                            <div class="wire_bangle_carat mb-3 mb-xxl-4">
                                <span class="form-check d-inline-block position-relative me-2 ps-0 mb-3">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault8">
                                        <label class="form-check-label wire_bangle_carat_label" for="flexRadioDefault8">
                                        10 KT
                                    </label>
                                </span>
                                <span class="form-check d-inline-block position-relative me-2 ps-0 mb-3">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault10" checked>
                                    <label class="form-check-label wire_bangle_carat_label" for="flexRadioDefault10">
                                    14 KT
                                     </label>
                                </span>
                                <span class="form-check d-inline-block position-relative me-2 ps-0 mb-3">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault6">
                                        <label class="form-check-label wire_bangle_carat_label" for="flexRadioDefault6">
                                        18 KT
                                    </label>
                                </span>
                                <span class="form-check d-inline-block position-relative me-2 ps-0 mb-3">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault7">
                                        <label class="form-check-label wire_bangle_carat_label" for="flexRadioDefault7">
                                        platinum
                                    </label>
                                </span>
                            </div>
                            <div class="mb-4">
                                <span class="wire_bangle_select mb-3 me-3">
                                    <select id="mounth">
                                        <option value="hide">-- Month --</option>
                                        <option value="january">January</option>
                                        <option value="february">February</option>
                                        <option value="march">March</option>
                                        <option value="april">April</option>
                                        <option value="may">May</option>
                                        <option value="june">June</option>
                                        <option value="july">July</option>
                                        <option value="august">August</option>
                                        <option value="september">September</option>
                                        <option value="october">October</option>
                                        <option value="november">November</option>
                                        <option value="december">December</option>
                                    </select>
                                </span>
                                <span class="wire_bangle_select mb-3">
                                    <select id="mounth">
                                        <option value="hide">-- Month --</option>
                                        <option value="january">January</option>
                                        <option value="february">February</option>
                                        <option value="march">March</option>
                                        <option value="april">April</option>
                                        <option value="may">May</option>
                                        <option value="june">June</option>
                                        <option value="july">July</option>
                                        <option value="august">August</option>
                                        <option value="september">September</option>
                                        <option value="october">October</option>
                                        <option value="november">November</option>
                                        <option value="december">December</option>
                                    </select>
                                </span>
                            </div>
                            <div class="wire_bangle_carat mb-4">
                                <div class="wire_bangle_color_heading mb-2">Prong Type</div>
                                <span class="form-check d-inline-block position-relative me-2  ps-0 mb-3">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault12">
                                        <label class="form-check-label wire_bangle_carat_label" for="flexRadioDefault12">
                                            default
                                    </label>
                                </span>
                                <span class="form-check d-inline-block position-relative me-2 ps-0 mb-3">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault13" checked>
                                    <label class="form-check-label wire_bangle_carat_label" for="flexRadioDefault13">
                                        round
                                     </label>
                                </span>
                                <span class="form-check d-inline-block position-relative me-2 ps-0 mb-3">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault14">
                                        <label class="form-check-label wire_bangle_carat_label" for="flexRadioDefault14">
                                            claw
                                    </label>
                                </span>
                                <span class="form-check d-inline-block position-relative me-2 ps-0">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault15">
                                        <label class="form-check-label wire_bangle_carat_label" for="flexRadioDefault15">
                                            split claw
                                    </label>
                                </span>
                                <span class="form-check d-inline-block position-relative me-2 ps-0">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault16">
                                    <label class="form-check-label wire_bangle_carat_label" for="flexRadioDefault16">
                                        split round
                                </label>
                                </span>
                            </div>
                            <div class="wire_bangle_share mb-4 mb-xxl-5">
                                <span><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                    <path d="M3.30005 6.05005C3.30005 5.3207 3.58978 4.62123 4.10551 4.10551C4.62123 3.58978 5.3207 3.30005 6.05005 3.30005H11.55C12.2794 3.30005 12.9789 3.58978 13.4946 4.10551C14.0103 4.62123 14.3 5.3207 14.3 6.05005C14.3 6.19592 14.2421 6.33581 14.139 6.43896C14.0358 6.5421 13.8959 6.60005 13.75 6.60005C13.6042 6.60005 13.4643 6.5421 13.3611 6.43896C13.258 6.33581 13.2 6.19592 13.2 6.05005C13.2 5.61244 13.0262 5.19276 12.7168 4.88332C12.4073 4.57389 11.9877 4.40005 11.55 4.40005H6.05005C5.61244 4.40005 5.19276 4.57389 4.88332 4.88332C4.57389 5.19276 4.40005 5.61244 4.40005 6.05005V11.55C4.40005 11.9877 4.57389 12.4073 4.88332 12.7168C5.19276 13.0262 5.61244 13.2 6.05005 13.2H11.0154C11.0835 12.5957 11.3716 12.0375 11.8249 11.6321C12.2782 11.2266 12.865 11.0023 13.4731 11.0018C14.0813 11.0014 14.6684 11.2249 15.1223 11.6297C15.5761 12.0345 15.8651 12.5922 15.934 13.1965C16.0029 13.8007 15.8469 14.4092 15.4957 14.9058C15.1446 15.4024 14.6229 15.7523 14.0302 15.8887C13.4376 16.0252 12.8154 15.9386 12.2825 15.6456C11.7495 15.3526 11.3431 14.8736 11.1408 14.3H6.05005C5.3207 14.3 4.62123 14.0103 4.10551 13.4946C3.58978 12.9789 3.30005 12.2794 3.30005 11.55V6.05005ZM12.1 13.475C12.1 13.8397 12.2449 14.1895 12.5028 14.4473C12.7606 14.7052 13.1104 14.85 13.475 14.85C13.8397 14.85 14.1895 14.7052 14.4473 14.4473C14.7052 14.1895 14.85 13.8397 14.85 13.475C14.85 13.1104 14.7052 12.7606 14.4473 12.5028C14.1895 12.2449 13.8397 12.1 13.475 12.1C13.1104 12.1 12.7606 12.2449 12.5028 12.5028C12.2449 12.7606 12.1 13.1104 12.1 13.475ZM8.25005 15.4C8.10418 15.4 7.96428 15.458 7.86114 15.5611C7.75799 15.6643 7.70005 15.8042 7.70005 15.95C7.70005 16.6794 7.98978 17.3789 8.5055 17.8946C9.02123 18.4103 9.7207 18.7 10.45 18.7H15.95C16.6794 18.7 17.3789 18.4103 17.8946 17.8946C18.4103 17.3789 18.7 16.6794 18.7 15.95V10.45C18.7 9.7207 18.4103 9.02123 17.8946 8.5055C17.3789 7.98978 16.6794 7.70005 15.95 7.70005H10.8592C10.657 7.1265 10.2506 6.64751 9.71763 6.35449C9.1847 6.06147 8.56253 5.97493 7.96986 6.11138C7.37719 6.24784 6.85551 6.59774 6.50437 7.09431C6.15323 7.59088 5.99721 8.19935 6.0661 8.80362C6.13499 9.40788 6.42395 9.96563 6.87784 10.3704C7.33174 10.7752 7.91879 10.9987 8.52697 10.9983C9.13514 10.9978 9.72187 10.7735 10.1752 10.368C10.6285 9.96258 10.9166 9.40441 10.9846 8.80005H15.95C16.3877 8.80005 16.8073 8.97389 17.1168 9.28332C17.4262 9.59276 17.6 10.0124 17.6 10.45V15.95C17.6 16.3877 17.4262 16.8073 17.1168 17.1168C16.8073 17.4262 16.3877 17.6 15.95 17.6H10.45C10.0124 17.6 9.59276 17.4262 9.28332 17.1168C8.97389 16.8073 8.80005 16.3877 8.80005 15.95C8.80005 15.8042 8.7421 15.6643 8.63896 15.5611C8.53581 15.458 8.39592 15.4 8.25005 15.4ZM8.52505 7.15005C8.88972 7.15005 9.23946 7.29491 9.49732 7.55278C9.75518 7.81064 9.90005 8.16038 9.90005 8.52505C9.90005 8.88972 9.75518 9.23946 9.49732 9.49732C9.23946 9.75518 8.88972 9.90005 8.52505 9.90005C8.16038 9.90005 7.81064 9.75518 7.55278 9.49732C7.29491 9.23946 7.15005 8.88972 7.15005 8.52505C7.15005 8.16038 7.29491 7.81064 7.55278 7.55278C7.81064 7.29491 8.16038 7.15005 8.52505 7.15005Z" fill="#0B1727"/>
                                </svg></span>
                                <span class="wire_bangle_color_heading mb-2 ms-2 text-uppercase">Share</span>
                                <div class="row">
                                    <div class="col-xl-6 ps-md-0">
                                        <div class="mt-4 wire_bangle_share">
                                            Avg Diamond Color &nbsp;:&nbsp;
                                            <span class="wire_bangle_color_theme">F-G</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 ps-md-0">
                                        <div class="mt-4 wire_bangle_share">
                                            Avg Diamond Clarity&nbsp;:&nbsp;
                                            <span class="wire_bangle_color_theme">VS1-VS2</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 ps-md-0">
                                        <div class="mt-4 wire_bangle_share">
                                            Product Certificate&nbsp;:&nbsp;
                                            <span class="wire_bangle_color_theme">IGI</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 ps-md-0">
                                        <div class="mt-4 wire_bangle_share">
                                            Back Type&nbsp;:&nbsp;
                                            <span class="wire_bangle_color_theme">Push back</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="select_setting_btn btn-hover-effect btn-hover-effect-black diamond-bt">select setting</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-xl-5 pt-xxl-5 mb-xxl-4">
            <div class="col-md-3">
                <div class="description_heading">
                    description
                </div>
            </div>
            <div class="col-md-9">
                <p class="description_paragraph">Expressing love, affection, and commitment, these heart shaped diamond stud earrings are true stunners. The heart shaped lab diamonds are set in three prongs along with the sturdy post and push-back altogether giving a secured and glamorous
                    look to the wearer.</p>
            </div>
        </div>
        <div class="accordion wire_bangle_accordion" id="accordionExample">
            <div class="accordion-item">
                <div class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Stud Earrings Details
                    </button>
                </div>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-6 px-0">
                                <div class="wire_bangle_share">
                                    Product Name &nbsp;:&nbsp;
                                    <span class="wire_bangle_color_theme">3 Prong Heart Lab Diamond Stud Earrings</span>
                                </div>
                            </div>
                            <div class="col-md-6 px-0">
                                <div class="wire_bangle_share">
                                    Avg Diamond Clarity &nbsp;:&nbsp;
                                    <span class="wire_bangle_color_theme">VS1-VS2</span>
                                </div>
                            </div>
                            <div class="col-md-6 px-0">
                                <div class="mt-4 wire_bangle_share">
                                    Product Certificate &nbsp;:&nbsp;
                                    <span class="wire_bangle_color_theme">IGI</span>
                                </div>
                            </div>
                            <div class="col-md-6 px-0">
                                <div class="mt-4 wire_bangle_share">
                                    Back Type &nbsp;:&nbsp;
                                    <span class="wire_bangle_color_theme">Push back</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item mt-3">
                <div class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Diamond Details
                    </button>
                </div>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-6 px-0">
                                <div class="wire_bangle_share">
                                    Product Name &nbsp;:&nbsp;
                                    <span class="wire_bangle_color_theme">3 Prong Heart Lab Diamond Stud Earrings</span>
                                </div>
                            </div>
                            <div class="col-md-6 px-0">
                                <div class="wire_bangle_share">
                                    Avg Diamond Clarity &nbsp;:&nbsp;
                                    <span class="wire_bangle_color_theme">VS1-VS2</span>
                                </div>
                            </div>
                            <div class="col-md-6 px-0">
                                <div class="mt-4 wire_bangle_share">
                                    Product Certificate &nbsp;:&nbsp;
                                    <span class="wire_bangle_color_theme">IGI</span>
                                </div>
                            </div>
                            <div class="col-md-6 px-0">
                                <div class="mt-4 wire_bangle_share">
                                    Back Type &nbsp;:&nbsp;
                                    <span class="wire_bangle_color_theme">Push back</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
@endsection

   