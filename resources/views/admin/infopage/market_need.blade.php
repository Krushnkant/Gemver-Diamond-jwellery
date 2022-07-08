@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Market Need</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {{--<h4 class="card-title">
                            Market Need
                        </h4>--}}
                        <div class="col-lg-12">

                        <form class="form-valide" action="" id="MarketNeedForm" method="post">
                            <div id="cover-spin" class="cover-spin"></div>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-form-label" for="market_need_contant">Market Need Contant <span class="text-danger">*</span>
                                </label>
                                <textarea class="summernote" id="market_need_contant" name="market_need_contant"></textarea>
                                <div id="market_need_contant-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>

                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 justify-content-center mt-4">
                               <!-- <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button> -->
                               <button type="button" class="btn btn-primary" id="saveMarketNeedBtn">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
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
<!-- settings JS start -->
<script type="text/javascript">
    $( document ).ready(function() {
        $.get("{{ url('admin/infopage/aboutus/edit') }}", function (data) {
           $('#market_need_contant').summernote('code', data.market_need);
        })
    });

    $('body').on('click', '#saveMarketNeedBtn', function () {
        $('#saveMarketNeedBtn').prop('disabled',true);
        $('#saveMarketNeedBtn').find('.loadericonfa').show();
        var formData = new FormData($("#MarketNeedForm")[0]);
        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updateMarketNeed') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#saveMarketNeedBtn').prop('disabled',false);
                    $('#saveMarketNeedBtn').find('.loadericonfa').hide();
                    if (res.errors.market_need_contant) {
                        $('#market_need_contant-error').show().text(res.errors.market_need_contant);
                    } else {
                        $('#market_need_contant-error').hide();
                    }
                }

                if(res.status == 200){
                    $('#saveMarketNeedBtn').prop('disabled',false);
                    $('#saveMarketNeedBtn').find('.loadericonfa').hide();
                    $("#UserDiscountPerVal").html(res.market_need_contant + " %");
                    toastr.success("Market Need Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $('#saveMarketNeedBtn').prop('disabled',false);
                    $('#saveMarketNeedBtn').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $('#saveMarketNeedBtn').prop('disabled',false);
                $('#saveMarketNeedBtn').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });
 
</script>

@endsection
