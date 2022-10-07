@extends('admin.layout')

@section('content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Add Review</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Review</h4>
                    <div class="product-section">
                        <form class="form-valide" action="#" id="reviewForm" method="post">
                            {{ csrf_field() }}
                            <div id="CoverSpin" class="cover-spin"></div>
                            <div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-10 offset-sm-1  col-xs-12 offset-sm-0">
                                <div class="form-group row">
                                    <label class="col-lg-12 col-form-label" for="reviewer">Reviewer Name <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control input-default" id="reviewer" name="reviewer" value="">
                                        <div id="reviewer-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-12 col-form-label">Rating <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <label class="radio-inline mr-3">
                                            <input type="radio" name="ratingStar" value="1"> 1 <i class="fa fa-star checked"></i></label>
                                        <label class="radio-inline mr-3">
                                            <input type="radio" name="ratingStar" value="2"> 2 <i class="fa fa-star checked"></i></label>
                                        <label class="radio-inline mr-3">
                                            <input type="radio" name="ratingStar" value="3"> 3 <i class="fa fa-star checked"></i></label>
                                        <label class="radio-inline mr-3">
                                            <input type="radio" name="ratingStar" value="4"> 4 <i class="fa fa-star checked"></i></label>
                                        <label class="radio-inline mr-3">
                                            <input type="radio" name="ratingStar" checked="checked" value="5"> 5 <i class="fa fa-star checked"></i></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-12 col-form-label" for="reviewText">Review</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control input-default" id="reviewText" name="reviewText" value="">
                                        <div id="reviewText-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="Thumbnail">Thumbnail  <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" name="files[]" id="reviewIconFiles" multiple="multiple">
                                    <input type="hidden" name="catImg" id="catImg" value="">
                                    <div id="catthumb-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </div>
                                
                                <div class="col-lg-12 custom-row">
                                    <div class="form-group row">
                                       
                                        <input type="hidden" id="product" name="product" value="<?php echo $id; ?>">
                                        <input type="hidden" id="action" name="action" value="<?php echo $action; ?>"> 
                                        <button type="submit" id="saveReviewBtn" class="btn btn-primary" data-action="add" >Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>      
        </div>
    </div>
</div>

  
@endsection

@section('js')
<script>

$('body').on('click', '#saveReviewBtn', function () {
 
    save_review($(this),'save_new');
});

function save_review(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');

    var formData = new FormData($("#reviewForm")[0]);
    formData.append('action',action);

    $.ajax({
        type: 'POST',
        url: "{{ route('admin.review.save') }}",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            if(res.status == 'failed'){
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
               
                if (res.errors.reviewer) {
                    $('#reviewer-error').show().text(res.errors.reviewer);
                } else {
                    $('#reviewer-error').hide();
                }

                if (res.errors.ratingStar) {
                    $('#ratingStar-error').show().text(res.errors.ratingStar);
                } else {
                    $('#ratingStar-error').hide();
                }

                if (res.errors.catImg) {
                    $('#catthumb-error').show().text(res.errors.catImg);
                } else {
                    $('#catthumb-error').hide();
                }

               
            }

            if(res.status == 200){
                if(btn_type == 'save_close'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.banners.list')}}";
                    if(res.action == 'add'){
                        toastr.success("Review Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Review Updated",'Success',{timeOut: 5000});
                    }
                }
                if(btn_type == 'save_new'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    
                    if(res.action == 'add'){
                        toastr.success("Review Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Review Updated",'Success',{timeOut: 5000});
                    }
                    location.reload();
                }
            }

        },
        error: function (data) {
            $(btn).prop('disabled',false);
            $(btn).find('.loadericonfa').hide();
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
}
</script>

<!-- order view page JS end -->
@endsection
