<form class="form-valide" action="" id="CouponForm" method="post">

    <div id="attr-cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 container justify-content-center">
        <div class="form-group">
            <label class="col-form-label" for="Coupon_Code">Coupon Code <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control input-flat" id="coupon_code" name="coupon_code">
            <div id="coupon_code-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
        </div>

        <div class="form-group">
            <label class="col-form-label" for="discount_type_id">Discount Type</label>
            <select class="form-control" id="discount_type_id" name="discount_type_id">
                @foreach($DiscountTypes as $DiscountType)
                    <option value="{{ $DiscountType->id }}" @if($DiscountType->id==1) selected @endif>{{ $DiscountType->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="col-form-label" for="Coupon_Amount" id="Coupon_Amount_label">Coupon Percentage (%) <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control input-flat" id="coupon_amount" name="coupon_amount">
            <div id="coupon_amount-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
        </div>

        <div class="form-group">
            <label class="col-form-label" for="allow_cod">Does Allow in Cash On Delivery?</label>
            <div>
                <label class="radio-inline mr-3"><input type="radio" name="allow_cod" value="1" checked> Yes</label>
                <label class="radio-inline mr-3"><input type="radio" name="allow_cod" value="0"> No</label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-form-label" for="Usage_Per_User">Usage Per User <span class="text-danger">*</span>
            </label>
            <input type="number" class="form-control input-flat" id="usage_per_user" name="usage_per_user" value="1">
            <div id="usage_per_user-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
        </div>

        <div class="form-group">
            <label class="col-form-label" for="expiry_date">Coupon Expiry Date <span class="text-danger">*</span>
            </label>
            <div class="input-group">
                <input type="text" class="form-control custom_date_picker" id="expiry_date" name="expiry_date" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd"> <span class="input-group-append"><span class="input-group-text"><i class="mdi mdi-calendar-check"></i></span></span>
                <div id="expiry_date-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
        <button type="button" class="btn btn-outline-primary" id="save_newCouponBtn" data-action="add">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>&nbsp;&nbsp;
        <button type="button" class="btn btn-primary" id="save_closeCouponBtn" data-action="add">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>

    </div>
</form>

