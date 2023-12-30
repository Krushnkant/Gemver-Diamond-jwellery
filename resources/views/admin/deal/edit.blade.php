<form class="form-valide" action="" id="dealForm" method="post">

    <div id="attr-cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
    <input type="hidden" name="deal_id" value="{{ isset($deal)?($deal->id):'' }}">

    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 container justify-content-center">
        <div class="form-group">
            <label class="col-form-label" for="title">Title <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control input-flat" id="title" name="title" value="{{ isset($deal)?($deal->title):'' }}">
            <div id="title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
        </div>
        <div class="form-group">
            <label class="col-form-label" for="start_date">Sale Start Date<span class="text-danger">*</span>
            </label>
            <div class="form-group">
                <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="{{ isset($deal)?($deal->start_date):'' }}"> 
                <div id="start_date-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>
        
       
        <div class="form-group">
            <label class="col-form-label" for="text_button">Button Text <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control input-flat" id="text_button" name="text_button" value="{{ isset($deal)?($deal->text_button):'' }}">
            <div id="text_button-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
        </div>
        <div class="form-group">
            <label class="col-form-label" for="date_title"> Date Prefix Title<span class="text-danger">*</span>
            </label>
            <div class="form-group">
                <input type="text" class="form-control" id="date_title" name="date_title" value="{{ isset($deal)?($deal->date_title):'' }}"> 
                <div id="date_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>
        {{-- <div class="form-group">
            <label class="col-form-label" for="url_button">Button Redirect URL <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control input-flat" id="url_button" name="url_button" value="{{ isset($deal)?($deal->url_button):'' }}">
            <div id="url_button-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
        </div> --}}

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="col-form-label" for="background_color">Background Color <span class="text-danger">*</span></label>
                    <input type="color" class="form-control input-flat" id="background_color" name="background_color" value="{{ isset($deal)?($deal->background_color):'#2C3E50' }}">
                    <div id="background_color-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="col-form-label" for="text_color">Text Color <span class="text-danger">*</span></label>
                    <input type="color" class="form-control input-flat" id="text_color" name="text_color" value="{{ isset($deal)?($deal->text_color):'#FFFFFF' }}">
                    <div id="text_color-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="col-form-label" for="button_color">Button Text Color <span class="text-danger">*</span></label>
                    <input type="color" class="form-control input-flat" id="button_color" name="button_color" value="{{ isset($deal)?($deal->button_color):'#FFFFFF' }}">
                    <div id="button_color-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                </div>
            </div>
        </div>

            {{-- <div class="form-group">
                <label class="col-form-label" for="url_button">Button Redirect URL <span class="text-danger">*</span>
                </label>
                <select class="form-control" id="BannerInfo" name="BannerInfo">
                    @foreach($application_dropdowns as $application_dropdown)
                    <option value="{{ $application_dropdown->id }}" @if($application_dropdown->id == $deal->application_dropdown_id) selected @endif>{{ $application_dropdown->title }}</option>
                    @endforeach
                </select>
            </div>

            <div id="infoBox" class=""></div>
            <div id="productDropdownBox" class="pb-2"></div> --}}

            <div class="form-group">
                <label class="col-form-label" for="url_button">Button Redirect URL <span class="text-danger">*</span>
                </label>
                <select class="form-control" id="BannerInfo" name="BannerInfo">
                    @foreach($application_dropdowns as $application_dropdown)
                    <option value="{{ $application_dropdown->id }}" @if($application_dropdown->id == $deal->application_dropdown_id) selected @endif>{{ $application_dropdown->title }}</option>
                    @endforeach
                </select>
            </div>
    
            <div id="infoBox" class="">
                @if($deal->application_dropdown_id == 2)
                    <div class="form-group" id="category_dropdown">
                        <label class="col-form-label" for="category">Select Category</label>
                        <select id="value" name="value" class="category_dropdown_catalog">
                            <option></option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($category->id == $deal->value) selected @endif>{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        <div id="value-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                @elseif($deal->application_dropdown_id == 3)
                    <div class="form-group" id="category_dropdown">
                        <label class="col-form-label" for="category">Select Category</label>
                        <select id="value" name="value" class="">
                            <option></option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($category->id == $deal->value) selected @endif>{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        <div id="value-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
            
                @elseif($deal->application_dropdown_id == 4)
                    <div class="form-group">
                        <label class="col-form-label" for="bannerUrl">Banner URL</label>
                        <input type="text" class="form-control input-flat" id="value" name="value" value="{{ $deal->value }}">
                        <div id="value-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                @endif
            </div>
    
            <div id="productDropdownBox" class="pb-2">
                @if($deal->application_dropdown_id == 2)
                    <div class="form-group" id="">
                        <label class="col-form-label" for="product">Select Product</label>
                        <select id="product" name="product" class="">
                            <option></option>
                            @foreach($products as $product)
                                <option value="{{ $product['id'] }}" @if($product['id'] == $deal->product_variant_id) selected @endif>{{ $product['product_title'] }}</option>
                            @endforeach
                        </select>
                        <div id="product-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                @endif
            </div>
       

        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
        <button type="button" class="btn btn-outline-primary mt-4" id="save_newdealBtn" data-action="update">Save  <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>

    </div>
</form>

