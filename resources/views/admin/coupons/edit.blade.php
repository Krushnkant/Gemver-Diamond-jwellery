<form class="form-valide" action="" id="CouponForm" method="post">

    <div id="attr-cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
    <input type="hidden" name="coupon_id" value="{{ isset($Coupon)?($Coupon->id):'' }}">

    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 container justify-content-center">
        <div class="form-group">
            <label class="col-form-label" for="Coupon_Code">Coupon Code <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control input-flat" id="coupon_code" name="coupon_code" value="{{ $Coupon->coupon_code }}">
            <div id="coupon_code-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
        </div>

        <div class="form-group">
            <label class="col-form-label" for="discount_type_id">Discount Type</label>
            <select class="form-control" id="discount_type_id" name="discount_type_id">
                @foreach($DiscountTypes as $DiscountType)
                    <option value="{{ $DiscountType->id }}" @if($DiscountType->id == $Coupon->discount_type_id) selected @endif>{{ $DiscountType->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <?php
            if ($Coupon->discount_type_id == 1){
                $Coupon_Amount_label = "Coupon Percentage (%)";
            }
            elseif ($Coupon->discount_type_id == 2){
                $Coupon_Amount_label = "Coupon Amount";
            }
            ?>
            <label class="col-form-label" for="Coupon_Amount" id="Coupon_Amount_label">{{ $Coupon_Amount_label }} <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control input-flat" id="coupon_amount" name="coupon_amount" value="{{ $Coupon->coupon_amount }}">
            <div id="coupon_amount-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
        </div>

        <div class="form-group">
            <label class="col-form-label" for="allow_cod">Does Allow in Cash On Delivery?</label>
            <div>
                <label class="radio-inline mr-3"><input type="radio" name="allow_cod" value="1" @if($Coupon->allow_cod == 1) checked @endif> Yes</label>
                <label class="radio-inline mr-3"><input type="radio" name="allow_cod" value="0" @if($Coupon->allow_cod == 0) checked @endif> No</label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-form-label" for="Usage_Per_User">Usage Per User <span class="text-danger">*</span>
            </label>
            <input type="number" class="form-control input-flat" id="usage_per_user" name="usage_per_user" value="{{ $Coupon->usage_per_user }}">
            <div id="usage_per_user-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
        </div>

        <div class="form-group">
            <label class="col-form-label" for="expiry_date">Coupon Expiry Date <span class="text-danger">*</span>
            </label>
            <div class="input-group">
                <input type="text" class="form-control custom_date_picker" id="expiry_date" name="expiry_date" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" value="{{ $Coupon->expiry_date }}"> <span class="input-group-append"><span class="input-group-text"><i class="mdi mdi-calendar-check"></i></span></span>
                <div id="expiry_date-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
        <button type="button" class="btn btn-outline-primary" id="save_newCouponBtn" data-action="update">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>&nbsp;&nbsp;
        <button type="button" class="btn btn-primary" id="save_closeCouponBtn" data-action="update">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>

    </div>
</form>

