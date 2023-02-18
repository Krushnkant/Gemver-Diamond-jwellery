@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Footer Page</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    <form class="form-valide" action="" id="MenuForm" method="post">
    <div id="cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
   
   
    <input type="hidden" name="attr_term_ids" id="attr_term_ids" value="">
    <input type="hidden" name="term_no" id="term_no" value="0">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            About
                        </h4>
                       
                        <div class="row add-value">
                            <div class="row col-lg-12">
                                <div class="col-lg-2 ">
                                    <div class="form-group ">
                                        <label class="col-form-label" for="section_category_title"> Select  
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <label class="col-form-label" for="section_category_title"> Title 
                                        </label>
                                   </div>
                                </div>
                               
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <label class="col-form-label" for="section_category_title"> Category/Page 
                                        </label>
                                    </div>
                                </div>
                                
                            </div>
                            @if(count($footerpage) <= 0)
                            <div class="row col-lg-12">
                                <div class="col-lg-2 ">
                                    <div class="form-group ">
                                        <input type="radio" class="selectpage" name="selectpage0" value="page" checked> <label class="radio-inline mr-3"> Page </label>
                                        <input type="radio" class="selectpage" name="selectpage0" value="category"> <label class="radio-inline mr-3"> Product Category </label>
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <input type="text" class="form-control input-flat" id="subtitle" name="subtitle[]" placeholder="Enter Title">
                                        <div id="subtitle-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <select  name="pageurl[]" class="form-control category_id">
                                            <option value="infopage/contact-us">Contact Us</option>
                                            <option value="infopage/about-us">About Us</option>
                                            <option value="infopage/testimonials">Testimonials</option>
                                            <option value="infopage/blogs"  >Blogs</option>
                                            <option value="infopage/customer-values">Customer Values</option>
                                            <option value="term-condition"  >Term-Condition</option>
                                            <option value="privacy-policy"  >Privacy-Policy</option>
                                            <option value="free-shipping"  >Free-Shipping</option>
                                            <option value="return-days"  >Return-Days</option>
                                            <option value="lifetime-upgrade"  >Lifetime-Upgrade</option>
                                            <option value="free-resizing"  >Free-Resizing</option>
                                            <option value="lifetime-warranty"  >lifetime-warranty</option>
                                            <option value="free-engraving"  >Free-Engraving</option>
                                            <option value="payment-options"  >Payment-Options</option>
                                            <option value="labgrowndiamonds"  >Lab Grown Diamonds</option>
                                            <option value="engagement"  >Engagement Rings</option>
                                            <option value="weddingbands"  >Wedding Rings</option>
                                            <option value="finejewellery"  >Fine Jewellery</option>
                                            <option value="custommadejewellery"  >Custom Made Jewellery</option>
                                            @foreach($custompages as $custompage)
                                                <option value="info/{{ $custompage->slug }}"  >{{ $custompage->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if(isset($footerpage))
                            @foreach($footerpage as $key => $footer)
                            
                            <div class="row col-lg-12">
                                <input type="hidden" name="footer_id[]" id="footer_id" value="{{ $footer->id }}">
                                <div class="col-lg-2">
                                    <div class="form-group ">
                                        <input type="radio" class="selectpage" name="selectpageold{{ $key }}" value="page" {{ ($footer->type == "page") ? "checked" : "" }}> <label class="radio-inline mr-3"> Page </label>
                                        <input type="radio" class="selectpage" name="selectpageold{{ $key }}" value="category" {{ ($footer->type == "category") ? "checked" : "" }}> <label class="radio-inline mr-3"> Product Category </label>
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <input type="text" class="form-control input-flat" id="subtitleold" value="{{ $footer->title }}" name="subtitleold[]">
                                        <div id="subtitle-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        @if($footer->type == "category")
                                        <select  name="pageurl_old[]" class="form-control category_id">
                                        <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="shop/{{ $category['slug'] }}" {{ ($footer->value== "shop/".$category['slug']) ? "selected" : "" }} >{{ $category['category_name'] }}</option>
                                            @endforeach
                                        </select>
                                        @else
                                        <select  name="pageurl_old[]" class="form-control category_id">
                                            <option value="infopage/contact-us" {{ ($footer->value == "infopage/contact-us") ? "selected" : "" }}>Contact Us</option>
                                            <option value="infopage/about-us" {{ ($footer->value == "infopage/about-us") ? "selected" : "" }}>About Us</option>
                                            <option value="infopage/testimonials" {{ ($footer->value == "infopage/testimonials") ? "selected" : "" }}>Testimonials</option>
                                            <option value="infopage/blogs" {{ ($footer->value == "infopage/blogs") ? "selected" : "" }}>Blogs</option>
                                            <option value="infopage/customer-values" {{ ($footer->value == "infopage/customer-values") ? "selected" : "" }}>Customer Values</option>
                                            <option value="term-condition"  {{ ($footer->value == "term-condition") ? "selected" : "" }}>Term-Condition</option>
                                            <option value="privacy-policy"  {{ ($footer->value == "privacy-policy") ? "selected" : "" }}>Privacy-Policy</option>
                                            <option value="free-shipping"  {{ ($footer->value == "free-shipping") ? "selected" : "" }}>Free-Shipping</option>
                                            <option value="return-days"  {{ ($footer->value == "return-days") ? "selected" : "" }}>Return-Days</option>
                                            <option value="lifetime-upgrade"  {{ ($footer->value == "lifetime-upgrade") ? "selected" : "" }}>Lifetime-Upgrade</option>
                                            <option value="free-resizing"  {{ ($footer->value == "free-resizing") ? "selected" : "" }}>Free-Resizing</option>
                                            <option value="lifetime-warranty"  {{ ($footer->value == "lifetime-warranty") ? "selected" : "" }}>lifetime-warranty</option>
                                            <option value="free-engraving"  {{ ($footer->value == "free-engraving") ? "selected" : "" }}>Free-Engraving</option>
                                            <option value="payment-options"  {{ ($footer->value == "payment-options") ? "selected" : "" }}>Payment-Options</option>
                                            <option value="labgrowndiamonds"  {{ ($footer->value == "labgrowndiamonds") ? "selected" : "" }}>Lab Grown Diamonds</option>
                                            <option value="engagement"  {{ ($footer->value == "engagement") ? "selected" : "" }}>Engagement Rings</option>
                                            <option value="weddingbands"  {{ ($footer->value == "weddingbands") ? "selected" : "" }}>Wedding Rings</option>
                                            <option value="finejewellery"  {{ ($footer->value == "finejewellery") ? "selected" : "" }}>Fine Jewellery</option>
                                            <option value="custommadejewellery"  {{ ($footer->value == "custommadejewellery") ? "selected" : "" }}>Custom Made Jewellery</option>
                                            @foreach($custompages as $custompage)
                                                <option value="info/{{ $custompage->slug }}"  {{ ($footer->value == "info/".$custompage->slug) ? "selected" : "" }}>{{ $custompage->title }}</option>
                                            @endforeach
                                        </select>
                                        @endif
                                    </div>
                                </div>
                                @if($key != 0)
                                <div class="col-lg-2 ">
                                    <button type="button" class="minus_btn btn mb-1  btn-outline-danger" ><i class='fa fa-remove'></i> </button>
                                </div>
                                @endif
                            </div>

                            
                                 
                            @endforeach
                            @endif
                            
                        </div>
                        <div class="col-lg-12 mt-3 text-center">
                            <div class="form-group">
                            <button type="button" class="btn btn-gray " id="Add" data-action="add">Add New </button>
                           </div>
                        </div>
                        <button type="button" class="btn btn-primary " id="saveMenuPage">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa mt-2" style="display:none;"></i></button>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</form>


<form class="form-valide" action="" id="whyMenuForm" method="post">
    <div id="cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
   
   
    <input type="hidden" name="whyattr_term_ids" id="whyattr_term_ids" value="">
    <input type="hidden" name="whyterm_no" id="whyterm_no" value="0">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            Why Gemver?
                        </h4>
                       
                        <div class="row whyadd-value">
                            <div class="row col-lg-12">
                                <div class="col-lg-2 ">
                                    <div class="form-group ">
                                        <label class="col-form-label" for="section_category_title"> Select  
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <label class="col-form-label" for="section_category_title"> Title 
                                        </label>
                                   </div>
                                </div>
                               
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <label class="col-form-label" for="section_category_title"> Category/Page 
                                        </label>
                                    </div>
                                </div>
                                
                            </div>
                           
                            @if(count($footerpage2) <= 0)
                           
                            <div class="row col-lg-12">
                                <div class="col-lg-2 ">
                                    <div class="form-group ">
                                        <input type="radio" class="whyselectpage" name="whyselectpage0" value="page" checked> <label class="radio-inline mr-3"> Page </label>
                                        <input type="radio" class="whyselectpage" name="whyselectpage0" value="category"> <label class="radio-inline mr-3"> Product Category </label>
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <input type="text" class="form-control input-flat" id="whysubtitle" name="whysubtitle[]" placeholder="Enter Title">
                                        <div id="subtitle-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <select  name="whypageurl[]" class="form-control whycategory_id">
                                            <option value="infopage/contact-us">Contact Us</option>
                                            <option value="infopage/about-us">About Us</option>
                                            <option value="infopage/testimonials">Testimonials</option>
                                            <option value="infopage/blogs"  >Blogs</option>
                                            <option value="infopage/customer-values">Customer Values</option>
                                            <option value="term-condition"  >Term-Condition</option>
                                            <option value="privacy-policy"  >Privacy-Policy</option>
                                            <option value="free-shipping"  >Free-Shipping</option>
                                            <option value="return-days"  >Return-Days</option>
                                            <option value="lifetime-upgrade"  >Lifetime-Upgrade</option>
                                            <option value="free-resizing"  >Free-Resizing</option>
                                            <option value="lifetime-warranty"  >lifetime-warranty</option>
                                            <option value="free-engraving"  >Free-Engraving</option>
                                            <option value="payment-options"  >Payment-Options</option>
                                            <option value="labgrowndiamonds"  >Lab Grown Diamonds</option>
                                            <option value="engagement"  >Engagement Rings</option>
                                            <option value="weddingbands"  >Wedding Rings</option>
                                            <option value="finejewellery"  >Fine Jewellery</option>
                                            <option value="custommadejewellery"  >Custom Made Jewellery</option>
                                            @foreach($custompages as $custompage)
                                                <option value="info/{{ $custompage->slug }}"  >{{ $custompage->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if(isset($footerpage2))
                            @foreach($footerpage2 as $key => $footer)
                            
                            <div class="row col-lg-12">
                                <input type="hidden" name="whyfooter_id[]" id="whyfooter_id" value="{{ $footer->id }}">
                                <div class="col-lg-2">
                                    <div class="form-group ">
                                        <input type="radio" class="whyselectpage" name="whyselectpageold{{ $key }}" value="page" {{ ($footer->type == "page") ? "checked" : "" }}> <label class="radio-inline mr-3"> Page </label>
                                        <input type="radio" class="whyselectpage" name="whyselectpageold{{ $key }}" value="category" {{ ($footer->type == "category") ? "checked" : "" }}> <label class="radio-inline mr-3"> Product Category </label>
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <input type="text" class="form-control input-flat" id="whysubtitleold" value="{{ $footer->title }}" name="whysubtitleold[]">
                                        <div id="subtitle-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        @if($footer->type == "category")
                                        
                                        <select  name="whypageurl_old[]" class="form-control whycategory_id">
                                        <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="shop/{{ $category['slug'] }}" {{ ($footer->value== "shop/".$category['slug']) ? "selected" : "" }} >{{ $category['category_name'] }}</option>
                                            @endforeach
                                        </select>
                                        @else
                                        <select  name="whypageurl_old[]" class="form-control whycategory_id">
                                            <option value="infopage/contact-us" {{ ($footer->value == "infopage/contact-us") ? "selected" : "" }}>Contact Us</option>
                                            <option value="infopage/about-us" {{ ($footer->value == "infopage/about-us") ? "selected" : "" }}>About Us</option>
                                            <option value="infopage/testimonials" {{ ($footer->value == "infopage/testimonials") ? "selected" : "" }}>Testimonials</option>
                                            <option value="infopage/blogs" {{ ($footer->value == "infopage/blogs") ? "selected" : "" }}>Blogs</option>
                                            <option value="infopage/customer-values" {{ ($footer->value == "infopage/customer-values") ? "selected" : "" }}>Customer Values</option>
                                            <option value="term-condition"  {{ ($footer->value == "term-condition") ? "selected" : "" }}>Term-Condition</option>
                                            <option value="privacy-policy"  {{ ($footer->value == "privacy-policy") ? "selected" : "" }}>Privacy-Policy</option>
                                            <option value="free-shipping"  {{ ($footer->value == "free-shipping") ? "selected" : "" }}>Free-Shipping</option>
                                            <option value="return-days"  {{ ($footer->value == "return-days") ? "selected" : "" }}>Return-Days</option>
                                            <option value="lifetime-upgrade"  {{ ($footer->value == "lifetime-upgrade") ? "selected" : "" }}>Lifetime-Upgrade</option>
                                            <option value="free-resizing"  {{ ($footer->value == "free-resizing") ? "selected" : "" }}>Free-Resizing</option>
                                            <option value="lifetime-warranty"  {{ ($footer->value == "lifetime-warranty") ? "selected" : "" }}>lifetime-warranty</option>
                                            <option value="free-engraving"  {{ ($footer->value == "free-engraving") ? "selected" : "" }}>Free-Engraving</option>
                                            <option value="payment-options"  {{ ($footer->value == "payment-options") ? "selected" : "" }}>Payment-Options</option>
                                            <option value="labgrowndiamonds"  {{ ($footer->value == "labgrowndiamonds") ? "selected" : "" }}>Lab Grown Diamonds</option>
                                            <option value="engagement"  {{ ($footer->value == "engagement") ? "selected" : "" }}>Engagement Rings</option>
                                            <option value="weddingbands"  {{ ($footer->value == "weddingbands") ? "selected" : "" }}>Wedding Rings</option>
                                            <option value="finejewellery"  {{ ($footer->value == "finejewellery") ? "selected" : "" }}>Fine Jewellery</option>
                                            <option value="custommadejewellery"  {{ ($footer->value == "custommadejewellery") ? "selected" : "" }}>Custom Made Jewellery</option>
                                            @foreach($custompages as $custompage)
                                                <option value="info/{{ $custompage->slug }}"  {{ ($footer->value == "info/".$custompage->slug) ? "selected" : "" }} >{{ $custompage->title }}</option>
                                            @endforeach
                                            
                                        </select>
                                        @endif
                                    </div>
                                </div>
                                @if($key != 0)
                                <div class="col-lg-2 ">
                                    <button type="button" class="minus_btn btn mb-1  btn-outline-danger" ><i class='fa fa-remove'></i> </button>
                                </div>
                                @endif
                            </div>

                            
                                 
                            @endforeach
                            @endif
                            
                        </div>
                        <div class="col-lg-12 mt-3 text-center">
                            <div class="form-group">
                            <button type="button" class="btn btn-gray " id="whyAdd" data-action="add">Add New </button>
                           </div>
                        </div>
                        <button type="button" class="btn btn-primary " id="whysaveMenuPage">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa mt-2" style="display:none;"></i></button>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</form>

<form class="form-valide" action="" id="contactMenuForm" method="post">
    <div id="cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
   
   
    <input type="hidden" name="contactattr_term_ids" id="contactattr_term_ids" value="">
    <input type="hidden" name="contactterm_no" id="contactterm_no" value="0">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            Contact 
                        </h4>
                       
                        <div class="row contactadd-value">
                            <div class="row col-lg-12">
                                <div class="col-lg-2 ">
                                    <div class="form-group ">
                                        <label class="col-form-label" for="section_category_title"> Select  
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <label class="col-form-label" for="section_category_title"> Title 
                                        </label>
                                   </div>
                                </div>
                               
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <label class="col-form-label" for="section_category_title"> Category/Page 
                                        </label>
                                    </div>
                                </div>
                                
                            </div>
                           
                            @if(count($footerpage3) <= 0)
                           
                            <div class="row col-lg-12">
                                <div class="col-lg-2 ">
                                    <div class="form-group ">
                                        <input type="radio" class="contactselectpage" name="contactselectpage0" value="page" checked> <label class="radio-inline mr-3"> Page </label>
                                        <input type="radio" class="contactselectpage" name="contactselectpage0" value="category"> <label class="radio-inline mr-3"> Product Category </label>
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <input type="text" class="form-control input-flat" id="contactsubtitle" name="contactsubtitle[]" placeholder="Enter Title">
                                        <div id="subtitle-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <select  name="contactpageurl[]" class="form-control contactcategory_id">
                                            <option value="infopage/contact-us">Contact Us</option>
                                            <option value="infopage/about-us">About Us</option>
                                            <option value="infopage/testimonials">Testimonials</option>
                                            <option value="infopage/blogs"  >Blogs</option>
                                            <option value="infopage/customer-values">Customer Values</option>
                                            <option value="term-condition"  >Term-Condition</option>
                                            <option value="privacy-policy"  >Privacy-Policy</option>
                                            <option value="free-shipping"  >Free-Shipping</option>
                                            <option value="return-days"  >Return-Days</option>
                                            <option value="lifetime-upgrade"  >Lifetime-Upgrade</option>
                                            <option value="free-resizing"  >Free-Resizing</option>
                                            <option value="lifetime-warranty"  >lifetime-warranty</option>
                                            <option value="free-engraving"  >Free-Engraving</option>
                                            <option value="payment-options"  >Payment-Options</option>
                                            <option value="labgrowndiamonds"  >Lab Grown Diamonds</option>
                                            <option value="engagement"  >Engagement Rings</option>
                                            <option value="weddingbands"  >Wedding Rings</option>
                                            <option value="finejewellery"  >Fine Jewellery</option>
                                            <option value="custommadejewellery"  >Custom Made Jewellery</option>
                                            @foreach($custompages as $custompage)
                                                <option value="info/{{ $custompage->slug }}"  >{{ $custompage->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if(isset($footerpage3))
                            @foreach($footerpage3 as $key => $footer)
                            
                            <div class="row col-lg-12">
                                <input type="hidden" name="contactfooter_id[]" id="contactfooter_id" value="{{ $footer->id }}">
                                <div class="col-lg-2">
                                    <div class="form-group ">
                                        <input type="radio" class="contactselectpage" name="contactselectpageold{{ $key }}" value="page" {{ ($footer->type == "page") ? "checked" : "" }}> <label class="radio-inline mr-3"> Page </label>
                                        <input type="radio" class="contactselectpage" name="contactselectpageold{{ $key }}" value="category" {{ ($footer->type == "category") ? "checked" : "" }}> <label class="radio-inline mr-3"> Product Category </label>
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <input type="text" class="form-control input-flat" id="contactsubtitleold" value="{{ $footer->title }}" name="contactsubtitleold[]">
                                        <div id="subtitle-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        @if($footer->type == "category")
                                        
                                        <select  name="contactpageurl_old[]" class="form-control contactcategory_id">
                                        <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="shop/{{ $category['slug'] }}" {{ ($footer->value== "shop/".$category['slug']) ? "selected" : "" }} >{{ $category['category_name'] }}</option>
                                            @endforeach
                                        </select>
                                        @else
                                        <select  name="contactpageurl_old[]" class="form-control contactcategory_id">
                                            <option value="infopage/contact-us" {{ ($footer->value == "infopage/contact-us") ? "selected" : "" }}>Contact Us</option>
                                            <option value="infopage/about-us" {{ ($footer->value == "infopage/about-us") ? "selected" : "" }}>About Us</option>
                                            <option value="infopage/testimonials" {{ ($footer->value == "infopage/testimonials") ? "selected" : "" }}>Testimonials</option>
                                            <option value="infopage/blogs" {{ ($footer->value == "infopage/blogs") ? "selected" : "" }}>Blogs</option>
                                            <option value="infopage/customer-values" {{ ($footer->value == "infopage/customer-values") ? "selected" : "" }}>Customer Values</option>
                                            <option value="term-condition"  {{ ($footer->value == "term-condition") ? "selected" : "" }}>Term-Condition</option>
                                            <option value="privacy-policy"  {{ ($footer->value == "privacy-policy") ? "selected" : "" }}>Privacy-Policy</option>
                                            <option value="free-shipping"  {{ ($footer->value == "free-shipping") ? "selected" : "" }}>Free-Shipping</option>
                                            <option value="return-days"  {{ ($footer->value == "return-days") ? "selected" : "" }}>Return-Days</option>
                                            <option value="lifetime-upgrade"  {{ ($footer->value == "lifetime-upgrade") ? "selected" : "" }}>Lifetime-Upgrade</option>
                                            <option value="free-resizing"  {{ ($footer->value == "free-resizing") ? "selected" : "" }}>Free-Resizing</option>
                                            <option value="lifetime-warranty"  {{ ($footer->value == "lifetime-warranty") ? "selected" : "" }}>lifetime-warranty</option>
                                            <option value="free-engraving"  {{ ($footer->value == "free-engraving") ? "selected" : "" }}>Free-Engraving</option>
                                            <option value="payment-options"  {{ ($footer->value == "payment-options") ? "selected" : "" }}>Payment-Options</option>
                                            <option value="labgrowndiamonds"  {{ ($footer->value == "labgrowndiamonds") ? "selected" : "" }}>Lab Grown Diamonds</option>
                                            <option value="engagement"  {{ ($footer->value == "engagement") ? "selected" : "" }}>Engagement Rings</option>
                                            <option value="weddingbands"  {{ ($footer->value == "weddingbands") ? "selected" : "" }}>Wedding Rings</option>
                                            <option value="finejewellery"  {{ ($footer->value == "finejewellery") ? "selected" : "" }}>Fine Jewellery</option>
                                            <option value="custommadejewellery"  {{ ($footer->value == "custommadejewellery") ? "selected" : "" }}>Custom Made Jewellery</option>
                                            @foreach($custompages as $custompage)
                                                <option value="info/{{ $custompage->slug }}"   {{ ($footer->value == "info/".$custompage->slug) ? "selected" : "" }} >{{ $custompage->title }}</option>
                                            @endforeach
                                        </select>
                                        @endif
                                    </div>
                                </div>
                                @if($key != 0)
                                <div class="col-lg-2 ">
                                    <button type="button" class="minus_btn btn mb-1  btn-outline-danger" ><i class='fa fa-remove'></i> </button>
                                </div>
                                @endif
                            </div>  
                            @endforeach
                            @endif
                            
                        </div>
                        <div class="col-lg-12 mt-3 text-center">
                            <div class="form-group">
                            <button type="button" class="btn btn-gray " id="contactAdd" data-action="add">Add New </button>
                           </div>
                        </div>
                        <button type="button" class="btn btn-primary " id="contactsaveMenuPage">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa mt-2" style="display:none;"></i></button>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</form>


@endsection

@section('js')
<!-- settings JS start -->
<script type="text/javascript">
    

    $('body').on('click', '#saveMenuPage', function () {
        $('#saveMenuPage').prop('disabled',true);
        $('#saveMenuPage').find('.loadericonfa').show();
        var formData = new FormData($("#MenuForm")[0]);
        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updatefooterpage') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#saveMenuPage').prop('disabled',false);
                    $('#saveMenuPage').find('.loadericonfa').hide();

                    if (res.errors.main_title) {
                        $('#main_title-error').show().text(res.errors.main_title);
                    } else {
                        $('#main_title-error').hide();
                    }
                }

                if(res.status == 200){
                    $('#saveMenuPage').prop('disabled',false);
                    $('#saveMenuPage').find('.loadericonfa').hide();
                    toastr.success("Footer Page Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                   
                    $('#saveMenuPage').prop('disabled',false);
                    $('#saveMenuPage').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
             
                $('#saveMenuPage').prop('disabled',false);
                $('#saveMenuPage').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });

    $('body').on('click', '#whysaveMenuPage', function () {
        $('#whysaveMenuPage').prop('disabled',true);
        $('#whysaveMenuPage').find('.loadericonfa').show();
        var formData = new FormData($("#whyMenuForm")[0]);
        $.ajax({
            type: 'POST',
            url: "{{ url('admin/whyupdatefooterpage') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#whysaveMenuPage').prop('disabled',false);
                    $('#whysaveMenuPage').find('.loadericonfa').hide();

                    if (res.errors.main_title) {
                        $('#main_title-error').show().text(res.errors.main_title);
                    } else {
                        $('#main_title-error').hide();
                    }
                }

                if(res.status == 200){
                    $('#whysaveMenuPage').prop('disabled',false);
                    $('#whysaveMenuPage').find('.loadericonfa').hide();
                    toastr.success("Footer Page Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                   
                    $('#whysaveMenuPage').prop('disabled',false);
                    $('#whysaveMenuPage').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
             
                $('#whysaveMenuPage').prop('disabled',false);
                $('#whysaveMenuPage').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });

    $('body').on('click', '#contactsaveMenuPage', function () {
        $('#contactsaveMenuPage').prop('disabled',true);
        $('#contactsaveMenuPage').find('.loadericonfa').show();
        var formData = new FormData($("#contactMenuForm")[0]);
        $.ajax({
            type: 'POST',
            url: "{{ url('admin/contactupdatefooterpage') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#contactsaveMenuPage').prop('disabled',false);
                    $('#contactsaveMenuPage').find('.loadericonfa').hide();

                    if (res.errors.main_title) {
                        $('#main_title-error').show().text(res.errors.main_title);
                    } else {
                        $('#main_title-error').hide();
                    }
                }

                if(res.status == 200){
                    $('#contactsaveMenuPage').prop('disabled',false);
                    $('#contactsaveMenuPage').find('.loadericonfa').hide();
                    toastr.success("Footer Page Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                   
                    $('#contactsaveMenuPage').prop('disabled',false);
                    $('#contactsaveMenuPage').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
             
                $('#contactsaveMenuPage').prop('disabled',false);
                $('#contactsaveMenuPage').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });


    

    let TermSelCheckbox = ['0'];
    $('body').on('click', '#Add', function(){
        
        var term_no = $("#term_no").val();
        
        term_no ++;
        $("#term_no").val(term_no);
        
        TermSelCheckbox.push(term_no);
        var attr_term_ids = TermSelCheckbox.join(",");
        $("#attr_term_ids").val(attr_term_ids);
      var html = '';
      html += '<div class="row col-lg-12"><div class="col-lg-2 ">'+
        '<div class="form-group ">'+
        '<input type="radio" class="selectpage" name="selectpage'+term_no+'" value="page" checked> <label class="radio-inline mr-3"> Page </label>'+
        '<input type="radio" class="selectpage" name="selectpage'+term_no+'" value="category"> <label class="radio-inline mr-3"> Product Category </label>'+
        '</div>'+
        '</div>'+
        '<div class="col-lg-4 ">'+
        '<div class="form-group">'+
       
        '<input type="text" class="form-control input-flat" id="subtitle" placeholder="Enter Title" name="subtitle[]">'+
        '<div id="title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>'+
        '</div>'+
        '</div>'+
        '<div class="col-lg-4 ">'+
        '<div class="form-group">'+
        '<select  name="pageurl[]" class="form-control category_id">'+
        '<option value="infopage/contact-us">Contact Us</option>'+
        '<option value="infopage/about-us">About Us</option>'+
        '<option value="infopage/testimonials">Testimonials</option>'+
        '<option value="infopage/blogs"  >Blogs</option>'+
        '<option value="infopage/customer-values">Customer Values</option>'+
        '<option value="term-condition"  >Term-Condition</option>'+
        '<option value="privacy-policy"  >Privacy-Policy</option>'+
        '<option value="free-shipping"  >Free-Shipping</option>'+
        '<option value="return-days"  >Return-Days</option>'+
        '<option value="lifetime-upgrade"  >Lifetime-Upgrade</option>'+
        '<option value="free-resizing"  >Free-Resizing</option>'+
        '<option value="lifetime-warranty"  >lifetime-warranty</option>'+
        '<option value="free-engraving"  >Free-Engraving</option>'+
        '<option value="payment-options"  >Payment-Options</option>'+
        '<option value="labgrowndiamonds"  >Lab Grown Diamonds</option>'+
        '<option value="engagement"  >Engagement Rings</option>'+
        '<option value="weddingbands"  >Wedding Rings</option>'+
        '<option value="finejewellery"  >Fine Jewellery</option>'+
        '<option value="custommadejewellery"  >Custom Made Jewellery</option>'+

        ' foreach($custompages as $custompage){ '+
            '<option value="info/{{ $custompage->slug }}"   {{ ($footer->value == "info/".$custompage->slug) ? "selected" : "" }} >{{ $custompage->title }}</option>'+
        ' } '+
    
        '</select>'+
        '</div>'+
        '</div>'+
        '<div class="col-md-2">'+
            '<button type="button"  class="minus_btn btn mb-1 btn-outline-danger" data-id="'+term_no+'" ><i class="fa fa-remove"></i>'+
        '</div>'+
        '</div></div>';
               
        $(".add-value").append(html);
        $('.category_id').select2({
            width: '100%',
            placeholder: "Select Category",
            allowClear: false
        });
    });

   
    $('body').on('click', '#whyAdd', function(){
       
        var term_no = $("#whyterm_no").val();
        
        term_no ++;
        $("#whyterm_no").val(term_no);
        
        TermSelCheckbox.push(term_no);
        var attr_term_ids = TermSelCheckbox.join(",");
        $("#whyattr_term_ids").val(attr_term_ids);
      var html = '';
      html += '<div class="row col-lg-12"><div class="col-lg-2 ">'+
        '<div class="form-group ">'+
        '<input type="radio" class="whyselectpage" name="whyselectpage'+term_no+'" value="page" checked> <label class="radio-inline mr-3"> Page </label>'+
        '<input type="radio" class="whyselectpage" name="whyselectpage'+term_no+'" value="category"> <label class="radio-inline mr-3"> Product Category </label>'+
        '</div>'+
        '</div>'+
        '<div class="col-lg-4 ">'+
        '<div class="form-group">'+
       
        '<input type="text" class="form-control input-flat" id="whysubtitle" placeholder="Enter Title" name="whysubtitle[]">'+
        '<div id="title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>'+
        '</div>'+
        '</div>'+
        '<div class="col-lg-4 ">'+
        '<div class="form-group">'+
        '<select  name="whypageurl[]" class="form-control whycategory_id">'+
        '<option value="infopage/contact-us">Contact Us</option>'+
        '<option value="infopage/about-us">About Us</option>'+
        '<option value="infopage/testimonials">Testimonials</option>'+
        '<option value="infopage/blogs"  >Blogs</option>'+
        '<option value="infopage/customer-values">Customer Values</option>'+
        '<option value="term-condition"  >Term-Condition</option>'+
        '<option value="privacy-policy"  >Privacy-Policy</option>'+
        '<option value="free-shipping"  >Free-Shipping</option>'+
        '<option value="return-days"  >Return-Days</option>'+
        '<option value="lifetime-upgrade"  >Lifetime-Upgrade</option>'+
        '<option value="free-resizing"  >Free-Resizing</option>'+
        '<option value="lifetime-warranty"  >lifetime-warranty</option>'+
        '<option value="free-engraving"  >Free-Engraving</option>'+
        '<option value="payment-options"  >Payment-Options</option>'+
        '<option value="labgrowndiamonds"  >Lab Grown Diamonds</option>'+
        '<option value="engagement"  >Engagement Rings</option>'+
        '<option value="weddingbands"  >Wedding Rings</option>'+
        '<option value="finejewellery"  >Fine Jewellery</option>'+
        '<option value="custommadejewellery"  >Custom Made Jewellery</option>'+

        ' foreach($custompages as $custompage){ '+
            '<option value="info/{{ $custompage->slug }}"   {{ ($footer->value == "info/".$custompage->slug) ? "selected" : "" }} >{{ $custompage->title }}</option>'+
        ' } '+
    
        '</select>'+
        '</div>'+
        '</div>'+
        '<div class="col-md-2">'+
            '<button type="button"  class="minus_btn btn mb-1 btn-outline-danger" data-id="'+term_no+'" ><i class="fa fa-remove"></i>'+
        '</div>'+
        '</div></div>';
               
        $(".whyadd-value").append(html);
        $('.category_id').select2({
            width: '100%',
            placeholder: "Select Category",
            allowClear: false
        });
    });

    $('body').on('click', '#contactAdd', function(){
       
       var term_no = $("#contactterm_no").val();
       
       term_no ++;
       $("#contactterm_no").val(term_no);
       
       TermSelCheckbox.push(term_no);
       var attr_term_ids = TermSelCheckbox.join(",");
       $("#contactattr_term_ids").val(attr_term_ids);
     var html = '';
     html += '<div class="row col-lg-12"><div class="col-lg-2 ">'+
       '<div class="form-group ">'+
       '<input type="radio" class="contactselectpage" name="contactselectpage'+term_no+'" value="page" checked> <label class="radio-inline mr-3"> Page </label>'+
       '<input type="radio" class="contactselectpage" name="contactselectpage'+term_no+'" value="category"> <label class="radio-inline mr-3"> Product Category </label>'+
       '</div>'+
       '</div>'+
       '<div class="col-lg-4 ">'+
       '<div class="form-group">'+
      
       '<input type="text" class="form-control input-flat" id="contactsubtitle" placeholder="Enter Title" name="contactsubtitle[]">'+
       '<div id="title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>'+
       '</div>'+
       '</div>'+
       '<div class="col-lg-4 ">'+
       '<div class="form-group">'+
       '<select  name="contactpageurl[]" class="form-control contactcategory_id">'+
        '<option value="infopage/contact-us">Contact Us</option>'+
        '<option value="infopage/about-us">About Us</option>'+
        '<option value="infopage/testimonials">Testimonials</option>'+
        '<option value="infopage/blogs"  >Blogs</option>'+
        '<option value="infopage/customer-values">Customer Values</option>'+
        '<option value="term-condition"  >Term-Condition</option>'+
        '<option value="privacy-policy"  >Privacy-Policy</option>'+
        '<option value="free-shipping"  >Free-Shipping</option>'+
        '<option value="return-days"  >Return-Days</option>'+
        '<option value="lifetime-upgrade"  >Lifetime-Upgrade</option>'+
        '<option value="free-resizing"  >Free-Resizing</option>'+
        '<option value="lifetime-warranty"  >lifetime-warranty</option>'+
        '<option value="free-engraving"  >Free-Engraving</option>'+
        '<option value="payment-options"  >Payment-Options</option>'+
        '<option value="labgrowndiamonds"  >Lab Grown Diamonds</option>'+
        '<option value="engagement"  >Engagement Rings</option>'+
        '<option value="weddingbands"  >Wedding Rings</option>'+
        '<option value="finejewellery"  >Fine Jewellery</option>'+
        '<option value="custommadejewellery"  >Custom Made Jewellery</option>'+

        ' foreach($custompages as $custompage){ '+
            '<option value="info/{{ $custompage->slug }}"   {{ ($footer->value == "info/".$custompage->slug) ? "selected" : "" }} >{{ $custompage->title }}</option>'+
        ' } '+
   
       '</select>'+
       '</div>'+
       '</div>'+
       '<div class="col-md-2">'+
           '<button type="button"  class="minus_btn btn mb-1 btn-outline-danger" data-id="'+term_no+'" ><i class="fa fa-remove"></i>'+
       '</div>'+
       '</div></div>';
              
       $(".contactadd-value").append(html);
       $('.category_id').select2({
           width: '100%',
           placeholder: "Select Category",
           allowClear: false
       });
   });

    $('body').on('click', '.minus_btn', function(){


        var boxid = $(this).attr("data-id");
       // console.log(TermSelCheckbox);
        //alert(boxid);
         TermSelCheckbox = jQuery.grep(TermSelCheckbox, function(value) {
             //alert(value);
           return value != boxid;
         });
         var attr_term_ids = TermSelCheckbox.join(",");
        // console.log(attr_term_ids);
        $("#attr_term_ids").val(attr_term_ids);



        var tthis = $(this).parent().parent();
        var ddd = tthis.remove()
    });


    $('body').on('change','.selectpage',function(){
        //$('input[type=radio][name=selectpage]').change(function() {

        

            var cat = $(this).parent().parent().parent().find('.category_id');
            cat.find('option').remove();
            if(this.value == "page"){
                var myOptions = {
                    'infopage/contact-us' : 'Contact Us',
                    'infopage/about-us' : 'About Us',
                    'infopage/testimonials' : 'Testimonials',
                    'infopage/blogs' : 'Blogs',
                    'infopage/customer-values' : 'Customer Values',
                    'term-condition' : 'Term-Condition',
                    'privacy-policy' : 'Privacy-Policy',
                    'free-shipping' : 'Free-Shipping',
                    'return-days' : 'Return-Days',
                    'lifetime-upgrade' : 'Lifetime-Upgrade',
                    'free-resizing' : 'Free-Resizing',
                    'lifetime-warranty' : 'Lifetime-Warranty',
                    'free-engraving' : 'Free-Engraving',
                    'payment-options' : 'Payment-Options',
                    'labgrowndiamonds' : 'Lab Grown Diamonds',
                    'engagement' : 'Engagement Rings',
                    'weddingbands' : 'Wedding Rings',
                    'finejewellery' : 'Fine Jewellery',
                    'custommadejewellery' : 'Custom Made Jewellery'
                };
                $.each(myOptions, function(val, text) {
                   cat.append( new Option(text,val)).trigger("change");
                });
            }else{
                $.getJSON("{{ url('admin/footerpagecategory')}}", 
                { option: $(this).val() }, 
                function(data) {
                    
                   
                    $.each(data, function(index, element) {
                        cat.append("<option value='shop/"+element.slug+"'>" + element.category_name + "</option>");
                    });
                });
            }      
        });


    $('body').on('change','.whyselectpage',function(){
        //$('input[type=radio][name=selectpage]').change(function() {

            var cat = $(this).parent().parent().parent().find('.whycategory_id');
            cat.find('option').remove();
            if(this.value == "page"){
                var myOptions = {
                    'infopage/contact-us' : 'Contact Us',
                    'infopage/about-us' : 'About Us',
                    'infopage/testimonials' : 'Testimonials',
                    'infopage/blogs' : 'Blogs',
                    'infopage/customer-values' : 'Customer Values',
                    'term-condition' : 'Term-Condition',
                    'privacy-policy' : 'Privacy-Policy',
                    'free-shipping' : 'Free-Shipping',
                    'return-days' : 'Return-Days',
                    'lifetime-upgrade' : 'Lifetime-Upgrade',
                    'free-resizing' : 'Free-Resizing',
                    'lifetime-warranty' : 'Lifetime-Warranty',
                    'free-engraving' : 'Free-Engraving',
                    'payment-options' : 'Payment-Options',
                    'labgrowndiamonds' : 'Lab Grown Diamonds',
                    'engagement' : 'Engagement Rings',
                    'weddingbands' : 'Wedding Rings',
                    'finejewellery' : 'Fine Jewellery',
                    'custommadejewellery' : 'Custom Made Jewellery'
                };
                $.each(myOptions, function(val, text) {
                   cat.append( new Option(text,val)).trigger("change");
                });
            }else{
                $.getJSON("{{ url('admin/footerpagecategory')}}", 
                { option: $(this).val() }, 
                function(data) {
                    console.log(data)
                   
                    $.each(data, function(index, element) {
                        cat.append("<option value='shop/"+element.slug+"'>" + element.category_name + "</option>");
                    });
                });
            }      
        });

        $('body').on('change','.contactselectpage',function(){
        //$('input[type=radio][name=selectpage]').change(function() {

            var cat = $(this).parent().parent().parent().find('.contactcategory_id');
            cat.find('option').remove();
            if(this.value == "page"){
                var myOptions = {
                    'infopage/contact-us' : 'Contact Us',
                    'infopage/about-us' : 'About Us',
                    'infopage/testimonials' : 'Testimonials',
                    'infopage/blogs' : 'Blogs',
                    'infopage/customer-values' : 'Customer Values',
                    'term-condition' : 'Term-Condition',
                    'privacy-policy' : 'Privacy-Policy',
                    'free-shipping' : 'Free-Shipping',
                    'return-days' : 'Return-Days',
                    'lifetime-upgrade' : 'Lifetime-Upgrade',
                    'free-resizing' : 'Free-Resizing',
                    'lifetime-warranty' : 'Lifetime-Warranty',
                    'free-engraving' : 'Free-Engraving',
                    'payment-options' : 'Payment-Options',
                    'labgrowndiamonds' : 'Lab Grown Diamonds',
                    'engagement' : 'Engagement Rings',
                    'weddingbands' : 'Wedding Rings',
                    'finejewellery' : 'Fine Jewellery',
                    'custommadejewellery' : 'Custom Made Jewellery'
                };
                $.each(myOptions, function(val, text) {
                   cat.append( new Option(text,val)).trigger("change");
                });
            }else{
                $.getJSON("{{ url('admin/footerpagecategory')}}", 
                { option: $(this).val() }, 
                function(data) {
                    
                   
                    $.each(data, function(index, element) {
                        cat.append("<option value='"+element.slug+"'>" + element.category_name + "</option>");
                    });
                });
            }      
        });

        $('body').on('change','.category_id',function(){
            var cat = $(this).find("option:selected").text();
            var valu = $(this).parent().parent().parent().find('.input-flat').val();
            if(valu == ""){
               $(this).parent().parent().parent().find('.input-flat').val(cat);
            }   
        });


        $('body').on('change','.contactcategory_id',function(){
            var cat = $(this).find("option:selected").text();
            var valu = $(this).parent().parent().parent().find('.input-flat').val();
            if(valu == ""){
               $(this).parent().parent().parent().find('.input-flat').val(cat);
            }   
        });

        $('body').on('change','.whycategory_id',function(){
            var cat = $(this).find("option:selected").text();
            var valu = $(this).parent().parent().parent().find('.input-flat').val();
            if(valu == ""){
               $(this).parent().parent().parent().find('.input-flat').val(cat);
            }  
        });

        


        
    
</script>
<!-- settings JS end -->
@endsection
