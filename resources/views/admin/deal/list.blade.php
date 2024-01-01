@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Deal</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            Deal
                        </h4>
                        @include('admin.deal.edit')
                    </div>
                </div>
            </div>
        </div>
    </div>

  
@endsection

@section('js')
<!-- deal JS start -->
<script type="text/javascript">
$(document).ready(function() {

    
    
    $('#BannerInfo').select2({
        width: '100%',
        placeholder: "Select...",
        allowClear: true,
        autoclose: false,
        closeOnSelect: false,
    });

    $('#value').select2({
        width: '100%',
        placeholder: "Select Category",
        allowClear: false
    });
    $('#product').select2({
        width: '100%',
        placeholder: "Select Product",
        allowClear: true
    });

    if("{{ !isset($deal->application_dropdown_id) || $deal->application_dropdown_id  == null }}"){
       $('#BannerInfo').select2();
       $('#BannerInfo').val('4').trigger('change');
    }



});

$('#BannerInfo').change(function() {
    var bannerInfo = $(this).val();
    if(bannerInfo == 2 || bannerInfo == 3 || bannerInfo == 4 ){
        $('#attr-cover-spin').show();
        $.ajax ({
            type:"POST",
            url: "{{ route('admin.banners.getBannerInfoVal') }}",
            data : {bannerInfo: bannerInfo, "_token": "{{csrf_token()}}"},
            success: function(data) {
                // console.log(data.categories);
                $('#infoBox').html(data.html);
                $("#productDropdownBox").html("");
                if(bannerInfo == 2 || bannerInfo == 3){
                    category_dropdown(data.categories);
                    $('#value').select2({
                        width: '100%',
                        placeholder: "Select Category",
                        allowClear: false
                    });
                }
            },
            complete: function(){
                $('#attr-cover-spin').hide();
            }
        });
    } else {
        $('#infoBox').html('');
        $("#productDropdownBox").html("");
    }
});

function category_dropdown(categories) {
    var list = $("#value");
    $.each(categories, function(index, item) {
        list.append(new Option(item.category_name, item.id));
    });
}

$('body').on("change",".category_dropdown_catalog",function(){
    $("#attr-cover-spin").fadeIn();
    var category_id = $(this).val();

    $.get("{{ url('admin/banners/getproducts') }}" + '/' + category_id, function (data) {
        if (data) {
            var html =`<div class="form-group" id="">
                    <label class="col-form-label" for="product">Select Product</label>
                    <select id="product" name="product" class="">
                        <option></option>
                    </select>
                    <div id="product-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>`;

            $("#productDropdownBox").html(html);
            $.each(data, function(index, item) {
                $("#product").append(new Option(item.product_title, item.id));
            });
            $('#product').select2({
                width: '100%',
                placeholder: "Select Product",
                allowClear: true
            });
            $("#attr-cover-spin").fadeOut();
        } else {
            $("#productDropdownBox").html("");
            $("#attr-cover-spin").fadeOut();
        }
    });
});
$('body').on('click', '#AdddealBtn', function () {
    location.href = "{{ route('admin.deals.add') }}";
});

$('body').on('click', '#save_closedealBtn', function () {
    save_deal($(this),'save_close');
});

$('body').on('click', '#save_newdealBtn', function () {
    save_deal($(this),'save_new');
});

function save_deal(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');

    var formData = new FormData($("#dealForm")[0]);
    formData.append('action',action);

    $.ajax({
        type: 'POST',
        url: "{{ route('admin.deals.save') }}",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            if(res.status == 'failed'){
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();

                if (res.errors.title) {
                    $('#title-error').show().text(res.errors.title);
                } else {
                    $('#title-error').hide();
                }

                if (res.errors.start_date) {
                    $('#start_date-error').show().text(res.errors.start_date);
                } else {
                    $('#start_date-error').hide();
                }

                if (res.errors.date_title) {
                    $('#date_title-error').show().text(res.errors.date_title);
                } else {
                    $('#date_title-error').hide();
                }

                if (res.errors.product) {
                    $('#product-error').show().text(res.errors.product);
                } else {
                    $('#product-error').hide();
                }

                if (res.errors.value) {
                    $('#value-error').show().text(res.errors.value);
                } else {
                    $('#value-error').hide();
                }

              
            }

            if(res.status == 200){
               
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.deals.list')}}";
                    toastr.success("Deal Updated",'Success',{timeOut: 5000});
                
            }

        },
        error: function (data) {
            $(btn).prop('disabled',false);
            $(btn).find('.loadericonfa').hide();
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
}

$('body').on('click', '#editdealBtn', function () {
    var deal_id = $(this).attr('data-id');
    var url = "{{ url('admin/deals') }}" + "/" + deal_id + "/edit";
    window.open(url,"_blank");
});

</script>
<!-- deal JS end -->
@endsection

