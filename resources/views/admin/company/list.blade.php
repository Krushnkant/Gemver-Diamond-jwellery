@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Company</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        {{--<h4 class="card-title">
                            Company List
                        </h4>--}}
                        <div class="col-lg-12">

                        <div class="table-responsive">
                            <table id="" class="table table-striped table-bordered customNewtable" style="width:100%">
                                <thead>
                                <tr>
                                    <th colspan="3"><h4 class="text-white mb-0">Company</h4></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($Companyies as $company)    
                                <tr>
                                    <th style="width: 50%">{{ $company->company_name }}</th>
                                    <td><span id="CompanyPerVal">{{ $company->company_percentage." %" }}</span></td>
                                    <td class="text-right">
                                        @if($canWrite == true)
                                            <button id="editCompanyPerBtn" data-id="{{ $company->id }}" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#CompanyPerModal">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                              
                                </tbody>
                            </table>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="CompanyPerModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-valide" action="" id="UserDiscountPerForm" method="post">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title">Update Comapny Percentage</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <div id="attr-cover-spin" class="cover-spin"></div>
                    <div class="form-group">
                        <label class="col-form-label" for="company_percentage">Comapny Percentage <span class="text-danger">*</span>
                        </label>
                        <input type="hidden" class="form-control input-flat" id="company_id" name="company_id" placeholder="">
                        <input type="number" class="form-control input-flat" id="company_percentage" name="company_percentage" placeholder="">
                        <div id="company_percentage-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveCompanyPerBtn">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@section('js')
<!-- settings JS start -->
<script type="text/javascript">

    $('body').on('click', '#editCompanyPerBtn', function () {
        var company_id = $(this).attr('data-id');
        $.get("{{ url('admin/company') }}" +'/' + company_id +'/edit', function (data) {
           
            $('#company_id').val(data.id);
            $('#company_percentage').val(data.company_percentage);
        })
    });
    
    
    $('body').on('click', '#saveCompanyPerBtn', function () {
        $('#saveCompanyPerBtn').prop('disabled',true);
        $('#saveCompanyPerBtn').find('.loadericonfa').show();
        var formData = new FormData($("#UserDiscountPerForm")[0]);

        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updateCompanyPercentage') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#saveCompanyPerBtn').prop('disabled',false);
                    $('#saveCompanyPerBtn').find('.loadericonfa').hide();
                    if (res.errors.company_percentage) {
                        $('#company_percentage-error').show().text(res.errors.company_percentage);
                    } else {
                        $('#company_percentage-error').hide();
                    }
                }

                if(res.status == 200){
                    $("#CompanyPerModal").modal('hide');
                    $('#saveCompanyPerBtn').prop('disabled',false);
                    $('#saveCompanyPerBtn').find('.loadericonfa').hide();
                   // $("#CompanyPerVal").html(res.company_percentage + " %");
                    location.reload();
                    toastr.success("Comapny Percentage Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $("#CompanyPerModal").modal('hide');
                    $('#saveCompanyPerBtn').prop('disabled',false);
                    $('#saveCompanyPerBtn').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#CompanyPerModal").modal('hide');
                $('#saveCompanyPerBtn').prop('disabled',false);
                $('#saveCompanyPerBtn').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });

    
    $('#CompanyPerModal').on('shown.bs.modal', function (e) {
        $("#company_percentage").focus();
    });

</script>
<!-- settings JS end -->
@endsection
