@extends('admin.layout')

@section('content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Shipping Settings</li>
        </ol>
    </div>
</div>

<div class="container-fluid">
    <form id="shippingSettingsForm">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <!-- Heading -->
                        <div class="row mb-3">
                            <div class="col">
                                <h4 class="card-title">Shipping Settings</h4>
                            </div>
                        </div>

                        <!-- Form Fields -->
                        <div class="row">
                            <!-- Min Order Amount Field -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="min_order_amount_for_free_shipping">
                                        Min Order Amount for Free Shipping <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           class="form-control numeric-only"
                                           id="min_order_amount_for_free_shipping"
                                           name="min_order_amount_for_free_shipping"
                                           value="{{ $shippingSettings->min_order_amount_for_free_shipping ?? '' }}"
                                           placeholder="Enter minimum order amount for free shipping">
                                    <div class="invalid-feedback" id="min_order_amount_error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <!-- Default Shipping Amount Field -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="default_shipping_amount">
                                        Default Shipping Amount <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           class="form-control numeric-only"
                                           id="default_shipping_amount"
                                           name="default_shipping_amount"
                                           value="{{ $shippingSettings->default_shipping_amount ?? '' }}"
                                           placeholder="Enter default shipping amount">
                                    <div class="invalid-feedback" id="default_shipping_amount_error"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                    <i class="fa fa-circle-o-notch fa-spin loadericonfa mt-2" style="display: none;"></i>
                                </button>
                            </div>
                        </div>

                    </div> <!-- /.card-body -->
                </div> <!-- /.card -->
            </div> <!-- /.col-md-12 -->
        </div> <!-- /.row -->
    </form>
</div> <!-- /.container-fluid -->
@endsection

@section('js')
<script>
    // Restrict input to only positive numbers and a single decimal
    $(document).on('input', '.numeric-only', function () {
        let value = $(this).val();
        value = value.replace(/[^0-9.]/g, ''); // Remove non-numeric/non-dot
        if ((value.match(/\./g) || []).length > 1) {
            value = value.substring(0, value.length - 1); // Prevent more than one dot
        }
        $(this).val(value);
    });

    // Prevent pasting invalid characters
    $('.numeric-only').on('paste', function (e) {
        let pastedData = e.originalEvent.clipboardData.getData('Text');
        if (!/^\d*\.?\d*$/.test(pastedData)) {
            e.preventDefault();
        }
    });

    $('#shippingSettingsForm').on('submit', function (e) {
        e.preventDefault();
        $('.loadericonfa').show();

        // Clear previous errors
        $('#min_order_amount_error').text('');
        $('#default_shipping_amount_error').text('');
        $('#min_order_amount_for_free_shipping').removeClass('is-invalid');
        $('#default_shipping_amount').removeClass('is-invalid');

        let minAmount = $('#min_order_amount_for_free_shipping').val().trim();
        let shippingAmount = $('#default_shipping_amount').val().trim();
        let isValid = true;

        // Validate Minimum Order Amount
        if (minAmount === '') {
            $('#min_order_amount_for_free_shipping').addClass('is-invalid');
            $('#min_order_amount_error').text('Please enter minimum order amount for free shipping.');
            isValid = false;
        } else if (isNaN(minAmount) || Number(minAmount) < 0) {
            $('#min_order_amount_for_free_shipping').addClass('is-invalid');
            $('#min_order_amount_error').text('Enter a valid positive number.');
            isValid = false;
        }

        // Validate Default Shipping Amount
        if (shippingAmount === '') {
            $('#default_shipping_amount').addClass('is-invalid');
            $('#default_shipping_amount_error').text('Please enter default shipping amount.');
            isValid = false;
        } else if (isNaN(shippingAmount) || Number(shippingAmount) < 0) {
            $('#default_shipping_amount').addClass('is-invalid');
            $('#default_shipping_amount_error').text('Enter a valid positive number.');
            isValid = false;
        }

        if (!isValid) {
            $('.loadericonfa').hide();
            return;
        }

        // Submit Form via AJAX
        let formData = $(this).serialize();
        $.ajax({
            url: "{{ route('admin.menupage.updateshippingsettings') }}",
            method: "POST",
            data: formData,
            success: function (response) {
                $('.loadericonfa').hide();
                if (response.status == 200) {
                    toastr.success("Shipping settings updated successfully.", 'Success', { timeOut: 5000 });
                } else {
                    toastr.error("Something went wrong. Please try again.", 'Error', { timeOut: 5000 });
                }
            },
            error: function (xhr) {
                $('.loadericonfa').hide();
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    if (errors.min_order_amount_for_free_shipping) {
                        $('#min_order_amount_for_free_shipping').addClass('is-invalid');
                        $('#min_order_amount_error').text(errors.min_order_amount_for_free_shipping[0]);
                    }
                    if (errors.default_shipping_amount) {
                        $('#default_shipping_amount').addClass('is-invalid');
                        $('#default_shipping_amount_error').text(errors.default_shipping_amount[0]);
                    }
                } else {
                    toastr.error("Unexpected error occurred.", 'Error', { timeOut: 5000 });
                }
            }
        });
    });
</script>
@endsection
