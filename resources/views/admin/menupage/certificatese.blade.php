@extends('admin.layout')

@section('content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Certificate Settings</li>
        </ol>
    </div>
</div>

<div class="container-fluid">
    <form id="certificateSettingsForm">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <!-- Heading -->
                        <div class="row mb-3">
                            <div class="col">
                                <h4 class="card-title">Certificate Settings</h4>
                            </div>
                        </div>

                        <!-- Carat Size -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="carat_size">Carat Size <span class="text-danger">*</span></label>
                                    <input type="text"
                                           class="form-control numeric-only"
                                           id="carat_size"
                                           name="carat_size"
                                           value="{{ $certificateseSettings->carat_size ?? '' }}"
                                           placeholder="Enter Carat Size">
                                    <div class="invalid-feedback" id="carat_size_error"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Certificate Price -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="certificate_price">Certificate Price <span class="text-danger">*</span></label>
                                    <input type="text"
                                           class="form-control numeric-only"
                                           id="certificate_price"
                                           name="certificate_price"
                                           value="{{ $certificateseSettings->certificate_price ?? '' }}"
                                           placeholder="Enter Certificate Price">
                                    <div class="invalid-feedback" id="certificate_price_error"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                    <i class="fa fa-circle-o-notch fa-spin loadericonfa mt-2" style="display: none;"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('js')
<script>
    // Only allow numeric input with one decimal point
    $(document).on('input', '.numeric-only', function () {
        let value = $(this).val().replace(/[^0-9.]/g, '');
        if ((value.match(/\./g) || []).length > 1) {
            value = value.substring(0, value.length - 1);
        }
        $(this).val(value);
    });

    $('.numeric-only').on('paste', function (e) {
        let pastedData = e.originalEvent.clipboardData.getData('Text');
        if (!/^\d*\.?\d*$/.test(pastedData)) {
            e.preventDefault();
        }
    });

    $('#certificateSettingsForm').on('submit', function (e) {
        e.preventDefault();
        $('.loadericonfa').show();

        // Clear errors
        $('#carat_size_error').text('');
        $('#certificate_price_error').text('');
        $('#carat_size').removeClass('is-invalid');
        $('#certificate_price').removeClass('is-invalid');

        let caratSize = $('#carat_size').val().trim();
        let certificatePrice = $('#certificate_price').val().trim();
        let isValid = true;

        // Validate Carat Size
        if (caratSize === '') {
            $('#carat_size').addClass('is-invalid');
            $('#carat_size_error').text('Please enter carat size.');
            isValid = false;
        } else if (isNaN(caratSize) || Number(caratSize) < 0) {
            $('#carat_size').addClass('is-invalid');
            $('#carat_size_error').text('Enter a valid positive number.');
            isValid = false;
        }

        // Validate Certificate Price
        if (certificatePrice === '') {
            $('#certificate_price').addClass('is-invalid');
            $('#certificate_price_error').text('Please enter certificate price.');
            isValid = false;
        } else if (isNaN(certificatePrice) || Number(certificatePrice) < 0) {
            $('#certificate_price').addClass('is-invalid');
            $('#certificate_price_error').text('Enter a valid positive number.');
            isValid = false;
        }

        if (!isValid) {
            $('.loadericonfa').hide();
            return;
        }

        // Submit via AJAX
        let formData = $(this).serialize();
        $.ajax({
            url: "{{ route('admin.menupage.updatecertificatesettings') }}",
            method: "POST",
            data: formData,
            success: function (response) {
                $('.loadericonfa').hide();
                if (response.status == 200) {
                    toastr.success("Certificate settings updated successfully.", 'Success', { timeOut: 5000 });
                } else {
                    toastr.error("Something went wrong. Please try again.", 'Error', { timeOut: 5000 });
                }
            },
            error: function (xhr) {
                $('.loadericonfa').hide();
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    if (errors.carat_size) {
                        $('#carat_size').addClass('is-invalid');
                        $('#carat_size_error').text(errors.carat_size[0]);
                    }
                    if (errors.certificate_price) {
                        $('#certificate_price').addClass('is-invalid');
                        $('#certificate_price_error').text(errors.certificate_price[0]);
                    }
                } else {
                    toastr.error("Unexpected error occurred.", 'Error', { timeOut: 5000 });
                }
            }
        });
    });
</script>
@endsection
