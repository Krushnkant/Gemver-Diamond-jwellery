@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Shop By Style</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{--<h4 class="card-title">
                            @if(isset($action) && $action=='create')
                            Add Shop By Style
                            @elseif(isset($action) && $action=='edit')
                            Edit Shop By Style
                            @else
                            Shop By Style List
                            @endif
                        </h4>--}}

                        <div class="action-section">
                            <div class="d-flex">
                            <?php $page_id = \App\Models\ProjectPage::where('route_url','admin.shopbystyle.list')->pluck('id')->first(); ?>
                            @if(getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) )
                                <button type="button" class="btn btn-primary" id="AddShopByStyleBtn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            @endif
                            {{-- <button class="btn btn-danger" onclick="deleteMultipleAttributes()"><i class="fa fa-trash" aria-hidden="true"></i></button>--}}

                           
                            </div>
                        </div>

                        @if(isset($action) && $action=='list')
                            <div class="table-responsive">
                                <table id="ShopByStyle" class="table zero-configuration customNewtable" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @endif

                        @if(isset($action) && $action=='create')
                            @include('admin.shopbystyle.create')
                        @endif

                        @if(isset($action) && $action=='edit')
                            @include('admin.shopbystyle.edit')
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeleteShopByStyleModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Shop By Style</h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this Shop By Style?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="RemoveShopByStyleSubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<!-- category JS start -->
<script type="text/javascript">


// $('#attribute_id_variation').select2({
//     width: '100%',
//     placeholder: "Select Attribute for Variation",
//     allowClear: true
// });

// $('#attribute_id_variation_term').select2({
//     width: '100%',
//     placeholder: "Select Attribute for Variation Term",
//     allowClear: true
// });

// $('#attribute_id_diamond').select2({
//     width: '100%',
//     placeholder: "Select Attribute for Variation",
//     allowClear: true
// });

// $('#attribute_id_diamond_term').select2({
//     width: '100%',
//     placeholder: "Select Attribute for Variation Term",
//     allowClear: true
// });

// $('#category_id').select2({
//     width: '100%',
//     placeholder: "Select Category",
//     allowClear: true
// });

// $('#setting').select2({
//     width: '100%',
//     placeholder: "Select Setting",
//     allowClear: true
// });

$(document).ready(function() {
 
    shopbystyle_table(true);
});

$('body').on('click', '#AddShopByStyleBtn', function () {
    location.href = "{{ route('admin.shopbystyle.add') }}";
});

$('body').on('click', '#save_closeShopByStyleBtn', function () {
    save_shopbystyle($(this),'save_close');
});

$('body').on('click', '#save_newShopByStyleBtn', function () {
    save_shopbystyle($(this),'save_new');
});

function save_shopbystyle(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');

    var formData = new FormData($("#ShopByStyleCreateForm")[0]);
    formData.append('action',action);

    $.ajax({
        type: 'POST',
        url: "{{ route('admin.shopbystyle.save') }}",
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

                if (res.errors.catImg) {
                    $('#categorythumb-error').show().text(res.errors.catImg);
                } else {
                    $('#categorythumb-error').hide();
                }

                // if (res.errors.attribute_id_variation) {
                //     $('#attribute_id_variation-error').show().text(res.errors.attribute_id_variation);
                // } else {
                //     $('#attribute_id_variation-error').hide();
                // }

                if (res.errors.attribute_id_variation_term) {
                    $('#attribute_id_variation_term-error').show().text(res.errors.attribute_id_variation_term);
                } else {
                    $('#attribute_id_variation_term-error').hide();
                }

            }

            if(res.status == 200){
                if(btn_type == 'save_close'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.shopbystyle.list')}}";
                    if(res.action == 'add'){
                        toastr.success("Shop By Style Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Shop By Styl Updated",'Success',{timeOut: 5000});
                    }
                }
                if(btn_type == 'save_new'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.shopbystyle.add')}}";
                    if(res.action == 'add'){
                        toastr.success("Shop By Styl Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Shop By Styl Updated",'Success',{timeOut: 5000});
                    }
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

function shopbystyle_table(is_clearState=false){
    if(is_clearState){
        $('#ShopByStyle').DataTable().state.clear();
    }

    $('#ShopByStyle').DataTable({
        "destroy": true,
        "processing": true,
        "serverSide": true,
        'stateSave': function(){
            if(is_clearState){
                return false;
            }
            else{
                return true;
            }
        },
        "ajax":{
            "url": "{{ url('admin/allshopbystylelist') }}",
            "dataType": "json",
            "type": "POST",
            "data":{ _token: '{{ csrf_token() }}' },
            // "dataSrc": ""
        },
        'columnDefs': [
            { "width": "50px", "targets": 0 },
            { "width": "120px", "targets": 1 },
            { "width": "170px", "targets": 2 },
            { "width": "70px", "targets": 3 },
            { "width": "120px", "targets": 4 },
            { "width": "120px", "targets": 5 },
        ],
        "columns": [
            {data: 'sr_no', name: 'sr_no', class: "text-center", orderable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'image', name: 'image', orderable: false, searchable: false, class: "text-center"},
            {data: 'title', name: 'title', class: "text-left"},
            {data: 'estatus', name: 'estatus', orderable: false, searchable: false, class: "text-center"},
            {data: 'created_at', name: 'created_at', searchable: false, class: "text-left"},
            {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
        ]
    });
}

function chageShopByStyleStatus(shopbystyle_id) {
    $.ajax({
        type: 'GET',
        url: "{{ url('admin/changeshopbystylestatus') }}" +'/' + shopbystyle_id,
        success: function (res) {
            if(res.status == 200 && res.action=='deactive'){
                $("#ShopByStyleStatuscheck_"+shopbystyle_id).val(2);
                $("#ShopByStyleStatuscheck_"+shopbystyle_id).prop('checked',false);
                toastr.success("Shop By Style Deactivated",'Success',{timeOut: 5000});
            }
            if(res.status == 200 && res.action=='active'){
                $("#ShopByStyleStatuscheck_"+shopbystyle_id).val(1);
                $("#ShopByStyleStatuscheck_"+shopbystyle_id).prop('checked',true);
                toastr.success("Shop By Style activated",'Success',{timeOut: 5000});
            }
        },
        error: function (data) {
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
}

$('body').on('click', '#deleteShopByStyleBtn', function (e) {
    // e.preventDefault();
    var shopbystyle_id = $(this).attr('data-id');
    $("#DeleteShopByStyleModal").find('#RemoveShopByStyleSubmit').attr('data-id',shopbystyle_id);
});

$('body').on('click', '#RemoveShopByStyleSubmit', function (e) {
    $('#RemoveShopByStyleSubmit').prop('disabled',true);
    $(this).find('.removeloadericonfa').show();
    e.preventDefault();
    var shopbystyle_id = $(this).attr('data-id');
    $.ajax({
        type: 'GET',
        url: "{{ url('admin/shopbystyle') }}" +'/' + shopbystyle_id +'/delete',
        success: function (res) {
            if(res.status == 200){
                $("#DeleteShopByStyleModal").modal('hide');
                $('#RemoveShopByStyleSubmit').prop('disabled',false);
                $("#RemoveShopByStyleSubmit").find('.removeloadericonfa').hide();
                shopbystyle_table();
                toastr.success("Shop By Style Deleted",'Success',{timeOut: 5000});
            }
            if(res.status == 400){
                $("#DeleteShopByStyleModal").modal('hide');
                $('#RemoveShopByStyleSubmit').prop('disabled',false);
                $("#RemoveShopByStyleSubmit").find('.removeloadericonfa').hide();
                shopbystyle_table();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        },
        error: function (data) {
            $("#DeleteShopByStyleModal").modal('hide');
            $('#RemoveShopByStyleSubmit').prop('disabled',false);
            $("#RemoveShopByStyleSubmit").find('.removeloadericonfa').hide();
            shopbystyle_table();
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
});

$('#DeleteShopByStyleModal').on('hidden.bs.modal', function () {
    $(this).find("#RemoveShopByStyleSubmit").removeAttr('data-id');
});

$('body').on('click', '#editShopByStyleBtn', function () {
    var shopbystyle_id = $(this).attr('data-id');
    var url = "{{ url('admin/shopbystyle') }}" + "/" + shopbystyle_id + "/edit";
    window.open(url,"_blank");
});

function removeuploadedimg(divId ,inputId, imgName){
    if(confirm("Are you sure you want to remove this file?")){
        $("#"+divId).remove();
        $("#"+inputId).removeAttr('value');
        var filerKit = $("#catIconFiles").prop("jFiler");
        filerKit.reset();
    }
}

$( document ).ready(function() {
    
    @if(isset($action) && $action=='create')
    $("#attribute_id_variation > option").removeAttr("selected");
    $("#attribute_id_variation").val('');
    $("#attribute_id_variation").select2({
        width: '100%',
        placeholder: "Select Attribute for Variation",
        allowClear: true
    });

    $("#attribute_id_variation_term > option").removeAttr("selected");
    $("#attribute_id_variation_term").val('');
    $("#attribute_id_variation_term").select2({
        width: '100%',
        placeholder: "Select Variation First",
        allowClear: true
    });

    $("#setting").select2({
        width: '100%',
        placeholder: "Select Setting",
        allowClear: true
    });

  @endif
    $('select[name="attribute_id_variation"]').on('change', function () {
        var variationId = $(this).val();
        if (variationId) {
            $.ajax({
                url: '/admin/shopbystyle/getterm/' + variationId,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="attribute_id_variation_term"]').empty();
                    $.each(data.term,function(index,value){
                         $('#attribute_id_variation_term').append('<option value="'+value.id+'">'+value.attrterm_name+'</option>');
                    })
                }
            })
        } else {
            $('select[name="attribute_id_variation_term"]').empty();
        }
    });
});


// $('body').on("change","#setting",function(){
//     $("#attr-cover-spin").fadeIn();

//     var setting = this.value;
//     if(setting==''){
//         $("#attribute_variation").hide();
//         $("#attribute_variation_term").hide();
//         $("#attribute_diamond").hide();
//         $("#attribute_diamond_term").hide();
//         $("#attr-cover-spin").fadeOut();
//     } else {
//         if (setting == 'product-setting') {
//             $('#attribute_id_diamond_term').empty();
//             $('#attribute_id_diamond').empty();
//             $("#attribute_diamond").hide();
//             $("#attribute_diamond_term").hide();
//             $("#attr-cover-spin").fadeOut();
//         } else {
//             $('#attribute_id_variation_term').empty();
//             //$('#attribute_id_variation').empty();
//             $("#attribute_variation").hide();
//             $("#attribute_variation_term").hide();
//             $("#attribute_diamond").show();
//             $("#attribute_diamond_term").show();
//             $("#attr-cover-spin").fadeOut();
//         }
//     }
// });

</script>
<!-- category JS end -->
@endsection

