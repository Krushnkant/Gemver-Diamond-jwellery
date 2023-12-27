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

