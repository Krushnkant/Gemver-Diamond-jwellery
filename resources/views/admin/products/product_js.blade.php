<!-- product JS start -->
<script src="{{ asset('js/bootstrap-4-navbar.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
    $(document).ready(function () {
        $('body').on('click', '.check', function () {
            $('.check').not(this).prop('checked', false);
        });

    });
</script>
<script type="text/javascript">
    let catSelectValArray = [];
    let catSelectStrArray = [];
    let parentCatValArray = [];
    let TermSelCheckbox = [];
    let AttributeSelCheckbox = [];

    $('#sizechart').select2({
        width: '100%',
        placeholder: "Select...",
        allowClear: true,
        autoclose: false,
        closeOnSelect: false,
    });


    @if (Route:: current() -> getName() == 'admin.products.edit')

    var newval = $("#attr_term_ids").val();
    var match = newval.split(',');

    $.each(match, function (index, value) {
        TermSelCheckbox.push(value);
    });

    var newvalattr = $("#attr_ids").val();
    if (newvalattr != "") {
        var matchattr = newvalattr.split(',');

        $.each(matchattr, function (index, value) {
            AttributeSelCheckbox.push(value);
        });
    }

    //console.log(TermSelCheckbox);
    // match.push(match); 
    // console.log(match);
    //$("#attr_term_ids").val(attr_term_ids);

    @endif





    $('body').on('click', '#AddProductBtn', function () {
        location.href = "{{ route('admin.products.add') }}";
    });

    $('body').on('click', '#ShowDarfProductBtn', function () {
        location.href = "{{ route('admin.drafproducts.list') }}";
    });

    $('.dropdown-item').click(function () {
        var catSelectedVal = $(this).attr('data-val');
        var catSelectedStr = $(this).attr('data-title');
        var parentcatid = $(this).attr('parent-cat');
        //If the element was not found in array, -1 will be returned.
        if ($.inArray(catSelectedVal, catSelectValArray) === -1) {
            if ($.inArray(parentcatid, parentCatValArray) !== -1) {
                for (var i = 0; i < parentCatValArray.length; i++) {
                    if (parentcatid === parentCatValArray[i]) {
                        catSelectValArray.splice($.inArray(catSelectValArray[i], catSelectValArray), 1);
                        parentCatValArray.splice($.inArray(parentCatValArray[i], parentCatValArray), 1);
                        catSelectStrArray.splice($.inArray(catSelectStrArray[i], catSelectStrArray), 1);
                    }
                }
                catSelectValArray.push(catSelectedVal);
                catSelectStrArray.push(catSelectedStr);
                parentCatValArray.push(parentcatid);
            } else {
                catSelectStrArray.push(catSelectedStr);
                catSelectValArray.push(catSelectedVal);
                parentCatValArray.push(parentcatid);
            }
        }
    });

    $(".last-child").click(function () {
        var catid = $(this).attr("data-val");

        // $("#attr-cover-spin").fadeIn();
        $("#AttrVariationBox > .basic-dropdown").hide();
        $("#AttrVariationBtn").html('');
        $("#AttrTermDiv").html('');

        var catSelectedVal = $(this).attr('data-val');
        var catSelectedStr = $(this).attr('data-title');
        var parentcatid = $(this).attr('parent-cat');

        $("#category-error").html("");
        $("#category-error").hide();
        $("#variationAttrsVal-error").html("");
        $("#variationAttrsVal-error").hide();

        //If the element was not found in array, -1 will be returned.
        if ($.inArray(catSelectedVal, catSelectValArray) === -1) {
            catSelectValArray.push(catSelectedVal);
            catSelectStrArray.push(catSelectedStr);
            parentCatValArray.push(parentcatid);
        }

        var selectedStrCat = catSelectStrArray.join(" / ");
        var selectedCatid = catSelectValArray.join(",");
        $("#CategorySel").val(selectedStrCat);
        $("#categoryIds").val(selectedCatid);
        $("#childCategoryId").val(catid);
        catSelectStrArray = [];
        catSelectValArray = [];
        parentCatValArray = [];
        //$("#AddBox").show();
        // $( "#AddBox" ).trigger( "click" );

        // $.ajax({
        //     type: 'GET',
        //     url: "{{ url('admin/getAttrVariation') }}" +'/' + $(this).attr("data-val"),
        //     success: function (res) {
        //          console.log(res);
        //         if(res['terms']!='') {
        //             $("#AttrVariationBtn").html('Select ' + res['attr_name']);
        //             $("#attrid_for_variation").val(res['attr_id']);
        //             $("#AttrTermDiv").html(res['terms']);
        //             $("#AttrVariationBox > .basic-dropdown").show();
        //             $("#AddBox").show();
        //         }
        //     },
        //     complete: function(){
        //         $("#attr-cover-spin").fadeOut();
        //     },
        //     error: function (data) {
        //         $("#attr-cover-spin").fadeOut();
        //     }
        // });
    });

    // $(document).on('change', '.TermSelCheckbox', function() {
    //     $("#attr-cover-spin").fadeIn();
    //     TermSelCheckbox = [];
    //     var term_id = $(this).attr('data-boxid');
    //     var term_name = $(this).attr('data-name');

    //     if ($(this).is(':checked')) {
    //         var ischecked = 1;
    //         $(this).attr('checked', true);


    //         // var VariantCnt = $(".VariantCnt:last").html();
    //         var VariantCnt = "";
    //         // alert($("#variant-data").children('div').length);
    //         if($("#variant-data").children('div').length>0){
    //             VariantCnt = $("#variant-data").children('div').length;
    //         }
    //         $.ajax ({
    //             type:"GET",
    //             url: '{{ url('admin/addVariantbox') }}' + "/" + $("#childCategoryId").val(),
    //             data :  {VariantCnt: VariantCnt, term_id: term_id, term_name: term_name},
    //             success: function(res) {
    //                 // console.log(res);
    //                 $("#variant-data").append(res['data']);
    //                 $("#variantProductBox").show();
    //                 $('.CatDisabMenuLink').addClass('disableCategory');
    //                 $('.specReq').select2({
    //                     width: '100%',
    //                     placeholder: "Select...",
    //                     allowClear: true
    //                 });

    //                 $('.specOpt').select2({
    //                     width: '100%',
    //                     placeholder: "Select...",
    //                     allowClear: true
    //                 });

    //                 // variantImages(res['VariantCnt']);
    //             },
    //             complete: function(){
    //                 addPrimaryBox();
    //                 $("#attr-cover-spin").fadeOut();
    //             }
    //         });
    //     } else {
    //         var ischecked = 0;
    //         // $("#variant-data").children('div:last-child').remove();
    //         $("#variant-data").children('div').each(function() {
    //            if($(this).attr('data-term') == term_name){
    //                $(this).remove();
    //            }
    //         });
    //         $(this).attr('checked', false);
    //         if($('#variant-data').children('div').length==0){
    //             $("#variantProductBox").hide();
    //             $('.CatDisabMenuLink').removeClass('disableCategory');
    //         }
    //         addPrimaryBox();
    //         $("#attr-cover-spin").fadeOut();
    //     }

    //     $(".TermSelCheckbox").each(function() {
    //         var thi = $(this);
    //         if($(this).is(':checked')){
    //             TermSelCheckbox.push($(thi).attr('data-boxid'));
    //         }
    //     });

    //     var attr_term_ids = TermSelCheckbox.join(",");
    //     $("#attr_term_ids").val(attr_term_ids);
    // });


    // var TermSelCheckbox = [];
    $(document).on('click', '.AddBox', function () {

        $("#attr-cover-spin").fadeIn();
        var term_id = 1;
        var term_name = 'test';

        var term_no = $("#term_no").val();
        term_no++;
        $("#term_no").val(term_no);

        //if ($(this).is(':checked')) {
        // var ischecked = 1;
        //  $(this).attr('checked', true);


        // var VariantCnt = $(".VariantCnt:last").html();
        var VariantCnt = "";
        // alert($("#variant-data").children('div').length);
        if ($("#variant-data").children('div').length > 0) {
            VariantCnt = $("#variant-data").children('div').length;
        }
        $.ajax({
            type: "GET",
            url: '{{ url('admin/ addVariantbox') }}' + "/" + $("#product_u_id").val(),
            data : { VariantCnt: VariantCnt, term_id: term_no, term_name: term_name },
            success: function (res) {
                //console.log(res);
                $("#variant-data").append(res['data']);
                $("#variantProductBox").show();
                $('.CatDisabMenuLink').addClass('disableCategory');

                $('.Variation').select2({
                    width: '100%',
                    multiple: true,
                    placeholder: "Select...",
                    allowClear: true,
                    autoclose: false,
                    closeOnSelect: false,
                });
                $('.specReq').select2({
                    width: '100%',
                    multiple: true,
                    placeholder: "Select...",
                    allowClear: true,
                    autoclose: false,
                    closeOnSelect: false,
                });

                $('.specOpt').select2({
                    width: '100%',
                    multiple: true,
                    placeholder: "Select...",
                    allowClear: true,
                    autoclose: false,
                    closeOnSelect: false,
                });

                // variantImages(res['VariantCnt']);
            },
            complete: function () {
                addPrimaryBox();
                $("#attr-cover-spin").fadeOut();
            }
            });
    // } else {
    //     var ischecked = 0;
    //     // $("#variant-data").children('div:last-child').remove();
    //     $("#variant-data").children('div').each(function() {
    //        if($(this).attr('data-term') == term_name){
    //            $(this).remove();
    //        }
    //     });
    //     $(this).attr('checked', false);
    //     if($('#variant-data').children('div').length==0){
    //         $("#variantProductBox").hide();
    //         $('.CatDisabMenuLink').removeClass('disableCategory');
    //     }
    //     addPrimaryBox();
    //     $("#attr-cover-spin").fadeOut();
    // }



    // $(".TermSelCheckbox").each(function() {
    //    // var thi = $(this);
    //         TermSelCheckbox.push(term_no);
    // });

    // TermSelCheckbox.push(term_no);

    TermSelCheckbox.push(term_no);
    var attr_term_ids = TermSelCheckbox.join(",");
    $("#attr_term_ids").val(attr_term_ids);
    });

    $('#variant-data').on('click', '.RemoveBox', function () {
        var boxid = $(this).attr("data-id");

        //alert(boxid);
        TermSelCheckbox = jQuery.grep(TermSelCheckbox, function (value) {
            //alert(value);
            return value != boxid;
        });
        var attr_term_ids = TermSelCheckbox.join(",");
        // console.log(attr_term_ids);
        $("#attr_term_ids").val(attr_term_ids);
        $(this).parent().parent().remove();

    });



    function addPrimaryBox() {
        var varProductName = $("#variant-data").children('div:first-child').find('input[name="varProductName"]');
        var varRegularPrice = $("#variant-data").children('div:first-child').find('input[name="varRegularPrice"]');
        var varSalePrice = $("#variant-data").children('div:first-child').find('input[name="varSalePrice"]');
        var stock = $("#variant-data").children('div:first-child').find('input[name="stock"]');
        var specReq = $("#variant-data").children('div:first-child').find('.specReq');
        var specOpt = $("#variant-data").children('div:first-child').find('.specOpt');
        if (!varProductName.hasClass('primaryBox')) {
            varProductName.addClass('primaryBox');
        }
        if (!varRegularPrice.hasClass('primaryBox')) {
            varRegularPrice.addClass('primaryBox');
        }
        if (!varSalePrice.hasClass('primaryBox')) {
            varSalePrice.addClass('primaryBox');
        }
        if (!stock.hasClass('primaryBox')) {
            stock.addClass('primaryBox');
        }
        if (!specReq.hasClass('primaryBox')) {
            specReq.addClass('primaryBox');
        }
        if (!specOpt.hasClass('primaryBox')) {
            specOpt.addClass('primaryBox');
        }
    }

    function collapsePanel(thi) {
        if ($(thi).parents('.variation-selection-box:first').hasClass('active')) {
            $(thi).parents('.variation-selection-box:first').removeClass('active');
            $(thi).parents('.variation-selection-box:first').siblings('.variation-product-box').removeClass('show');
        }
        else {
            $(thi).parents('.variation-selection-box:first').addClass('active');
            $(thi).parents('.variation-selection-box:first').siblings('.variation-product-box').addClass('show');
        }
    }

    $(document).on('change', '.varSalePrice', function () {
        var isPrimary = $("#copyAppBtn").val();
        var salePrice = $(this).val();

        if ($(this).hasClass("primaryBox") && isPrimary != 0) {
            $(".varSalePrice").val(salePrice);
        }
    });

    $(document).on('change', '.stock', function () {
        var isPrimary = $("#copyAppBtn").val();
        var stock = $(this).val();

        if ($(this).hasClass("primaryBox") && isPrimary != 0) {
            $(".stock").val(stock);
        }
    });

    $(document).on('change', '.varProductName', function () {
        var isPrimary = $("#copyAppBtn").val();
        var productName = $(this).val();

        if ($(this).hasClass("primaryBox") && isPrimary != 0) {
            $(".varProductName").val(productName);
        }
    });

    $(document).on('change', '.varRegularPrice ', function () {
        var isPrimary = $("#copyAppBtn").val();
        var RegularPrice = $(this).val();

        if ($(this).hasClass("primaryBox") && isPrimary != 0) {
            $(".varRegularPrice ").val(RegularPrice);
        }
    });

    $(document).on('change', '.specReq', function () {
        var isPrimary = $("#copyAppBtn").val();
        var specReq = $(this).val();
        var this_name = $(this).attr('id-data');

        // alert(specReq);
        if ($(this).hasClass("primaryBox") && isPrimary != 0) {

            $("select[name=" + this_name + "]").each(function () {

                var this_select = $(this);
                if (!$(this_select).hasClass('primaryBox')) {
                    $(this_select).val(specReq);
                    $(this_select).select2().trigger('change');
                    if ($(this_select).val() == "") {
                        $(this_select).select2({
                            placeholder: "Select...",
                        });
                    }
                }
            });
        }
    });

    $(document).on('change', '.specOpt', function () {
        var isPrimary = $("#copyAppBtn").val();
        var specReq = $(this).val();
        var this_name = $(this).attr('name');

        // alert(specReq);
        if ($(this).hasClass("primaryBox") && isPrimary != 0) {
            $("select[name=" + this_name + "]").each(function () {
                var this_select = $(this);
                if (!$(this_select).hasClass('primaryBox')) {
                    $(this_select).val(specReq);
                    $(this_select).select2().trigger('change');
                    if ($(this_select).val() == "") {
                        $(this_select).select2({
                            placeholder: "Select...",
                        });
                    }
                }
            });
        }
    });

    $(document).on('change', '#copyAppBtn', function () {
        if ($(this).is(':checked')) {
            $(this).val(1);
            $(this).attr('checked', true);
        }
        else {
            $(this).val(0);
            $(this).attr('checked', false);
        }
    });

    $(document).on('change', '#is_custom', function () {
        if ($(this).is(':checked')) {
            $(this).val(1);
            $(this).attr('checked', true);
        }
        else {
            $(this).val(0);
            $(this).attr('checked', false);
        }
    });

    $('body').on('click', '#SubmitProductBtn', function () {

        $(this).prop('disabled', true);
        $(this).find('.submitloader').show();
        var btn = $(this);
        var is_custom = $('#is_custom').val();

        var valid_product = validateProductForm();
        var valid_variants = validateVariantsForm();

        if (valid_product == true && valid_variants == true) {
            var formData = new FormData($('#ProductForm')[0]);
            var meta_title = $('#meta_title').val();
            var meta_description = $('#meta_description').val();
            formData.append('meta_title', meta_title);
            formData.append('meta_description', meta_description);
            var cnt = 1;
            $('.variantForm').each(function () {
                var thi = $(this);
                var specOptArr = [];
                $(thi).find('.specOpt').each(function () {
                    if ($(this).val() != "") {
                        specOptArr.push($(this).attr('data-id'));
                    }
                });
                $(thi).find('input[name="varSpecOptional"]').val("");
                $(thi).find('input[name="varSpecOptional"]').val(specOptArr.join(","));

                var variantForm = $(this).serialize();
                formData.append("variantForm" + cnt, variantForm);
                cnt++;
            });



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('admin.products.save') }}",
                // data: {productFormData: productFormData, variantFormData: variantFormData},
                data: formData,
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                // contentType: 'json',
                success: function (res) {
                    //console.log(res);
                    if (res['status'] == 200) {
                        if (is_custom == 1) {
                            location.href = "{{ route('admin.customproducts.list') }}";
                        } else {
                            location.href = "{{ route('admin.products.list') }}";
                        }

                        toastr.success("Product Added", 'Success', { timeOut: 5000 });
                    }
                },
                error: function (data) {
                    $(btn).prop('disabled', false);
                    $(btn).find('.submitloader').hide();
                    toastr.error("Please try again", 'Error', { timeOut: 5000 });
                }
            });
        }
        else {
            $(btn).prop('disabled', false);
            $(btn).find('.submitloader').hide();
        }
    });

    $('body').on('click', '#saveDraftBtn', function () {

        $(this).prop('disabled', true);
        $(this).find('.draftloader').show();
        var btn = $(this);


        var valid_product = validateProductForm();
        var valid_variants_draf = validateVariantsFormDraf();

        if (valid_product == true && valid_variants_draf == true) {
            var formData = new FormData($('#ProductForm')[0]);
            var meta_title = $('#meta_title').val();
            var meta_description = $('#meta_description').val();
            formData.append('meta_title', meta_title);
            formData.append('meta_description', meta_description);
            var cnt = 1;
            $('.variantForm').each(function () {
                var thi = $(this);
                var specOptArr = [];
                $(thi).find('.specOpt').each(function () {
                    if ($(this).val() != "") {
                        specOptArr.push($(this).attr('data-id'));
                    }
                });
                $(thi).find('input[name="varSpecOptional"]').val("");
                $(thi).find('input[name="varSpecOptional"]').val(specOptArr.join(","));

                var variantForm = $(this).serialize();
                formData.append("variantForm" + cnt, variantForm);
                cnt++;
            });



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('admin.products.saveDraft') }}",
                // data: {productFormData: productFormData, variantFormData: variantFormData},
                data: formData,
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                // contentType: 'json',
                success: function (res) {
                    //console.log(res);
                    if (res['status'] == 200) {
                        if (is_custom == 1) {
                            location.href = "{{ route('admin.drafproducts.list') }}";
                        } else {
                            location.href = "{{ route('admin.drafproducts.list') }}";
                        }

                        toastr.success("Product Added", 'Success', { timeOut: 5000 });
                    }
                },
                error: function (data) {
                    $(btn).prop('disabled', false);
                    $(btn).find('.draftloader').hide();
                    toastr.error("Please try again", 'Error', { timeOut: 5000 });
                }
            });
        }
        else {
            $(btn).prop('disabled', false);
            $(btn).find('.draftloader').hide();
        }
    });

    function validateProductForm() {
        $("#category-error").html("");
        $("#variationAttrsVal-error").html("");
        $("#category-error").hide();
        $("#variationAttrsVal-error").hide();

        var valid = true;
        if ($("#category_id").val() == '' || $("#category_id").val() == '') {
            $("#category-error").html("Please select a Category");
            $("#category-error").show();
            valid = false;
        }

        if ($("#ProductName").val() == '') {
            $("#ProductName-error").html("Please Enter Product Name");
            $("#ProductName-error").show();
            valid = false;
        }

        if ($("#DesignNumber").val() == '') {
            $("#DesignNumber-error").html("Please Enter Product Design Number");
            $("#DesignNumber-error").show();
            valid = false;
        }

        // if($("#attr_term_ids").val()==""){
        //     $("#variationAttrsVal-error").html("Please Add Product Variant");
        //     $("#variationAttrsVal-error").show();
        //     valid = false;
        // }

        //alert(valid);
        return valid;
    }

    $(document).ready(function () {

        // $('.SKU').change(function(){
        $('body').on('change', '.SKU', function () {
            var skuvalue = this.value;
            var thi = $(this);
            var this_err = $(thi).attr('id-data') + "-error";
            $.ajax({
                type: "POST",
                async: false,
                url: "{{ url('admin/products/checksku') }}", // script to validate in server side
                data: { username: skuvalue, _token: '{{csrf_token()}}' },
                success: function (data) {

                    result = (data == "true") ? true : false;

                    if (result == false) {
                        $("#" + this_err).html("This sku code is already taken! Try another.");
                        $("#" + this_err).show();

                        // $("#SKU-error").html("This sku code is already taken! Try another.");
                        // $("#SKU-error").show();
                    } else {
                        $("#" + this_err).html("");
                        $("#" + this_err).hide();
                    }
                }
            });
        });

        $('body').on('change', '#ProductName', function () {
            var value = this.value;
            $.ajax({
                type: "get",
                async: false,
                url: "{{ url('admin/createSlugTitle/') }}" + "/" + value,
                success: function (data) {
                    $('#slug').val(data);
                }
            });
        });
    });




    function validateVariantsForm() {
        $(".variantForm").each(function () {

            $(this).validate({
                rules: {
                    varProductName: {
                        required: true,
                    },
                    varSalePrice: {
                        required: true,
                    },
                    stock: {
                        required: true,
                    },
                    SKU: {
                        required: true,
                    },



                    /*weight: {
                        required: {
                            depends: function(elem) {
                                return $("#age").val() > 50
                            }
                        },
                        number: true,
                        min: 0
                    }*/
                },

                messages: {
                    varProductName: {
                        required: "Please provide a Product Title"
                    },
                    varSalePrice: {
                        required: "Please provide a Sale Price",
                    },
                    stock: {
                        required: "Please provide a Stock",
                    },
                    SKU: {
                        required: "Please provide a SKU ",
                    },
                }
            });
        })

        var valid = true;
        var datavari = [];
        var datavari1 = [];
        SKUs = [];
        $('.variantForm').each(function () {
            var this_form = $(this);
            if (!$(this).valid()) {
                valid = false;
            }

            $(this).find('.varRegularPrice').each(function () {
                var thi = $(this);
                var this_err = $(thi).attr('name') + "-error";
                var RegularPrice = $(thi).val();
                var ret = $(thi).attr('name').replace('varRegularPrice', '');
                var stringdata = 'varSalePrice' + ret;
                var SellingPrice = $("input[name=" + stringdata + "]").val();
                if (Number(SellingPrice) > Number(RegularPrice)) {
                    $(this_form).find("#" + this_err).html("Selling Price from should be less than Regular Price to");
                    $(this_form).find("#" + this_err).show();
                    valid = false;
                }
            })


            // var valid_extensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

            // if(!valid_extensions.test($(this).find('input[name="varImage"]').val())){ 
            //     $(this).find("#varImage-error").html("Please provide a product images");
            //     $(this).find("#varImage-error").show();
            //     valid = false;
            // }    


            if ($(this).find('input[name="varImage"]').val() == "") {
                $(this).find("#varImage-error").html("Please provide a product images");
                $(this).find("#varImage-error").show();
                valid = false;

            }

            $(this).find('.Variation').each(function () {
                var thi = $(this);
                var this_err = $(thi).attr('id-data') + "-error";
                if ($(thi).val() == "" || $(thi).val() == null) {
                    $(this_form).find("#" + this_err).html("Please select any value");
                    $(this_form).find("#" + this_err).show();
                    valid = false;
                }
            })

            $(this).find('.specReq').each(function () {
                var thi = $(this);
                var this_err = $(thi).attr('id-data') + "-error";
                if ($(thi).val() == "" || $(thi).val() == null) {
                    $(this_form).find("#" + this_err).html("Please select any value");
                    $(this_form).find("#" + this_err).show();
                    valid = false;
                }
            })

            $(this).find('.SKU').each(function () {
                var thi = $(this);
                var this_err = $(thi).attr('id-data') + "-error";
                var check = SKUs.includes($(thi).val());
                SKUs.push($(thi).val());
                if (check) {
                    $("#" + this_err).html("This sku code is already taken! Try another.");
                    $("#" + this_err).show();
                    valid = false;
                }

            })

            $(this).find('.varSalePrice').each(function () {
                var thi = $(this);
                var this_err = $(thi).attr('name') + "-error";
                if ($(thi).val() == "" || $(thi).val() == null) {
                    $(this_form).find("#" + this_err).html("Please provide a value");
                    $(this_form).find("#" + this_err).show();
                    valid = false;
                }

            })

            $(this).find('.stock').each(function () {
                var thi = $(this);
                var this_err = $(thi).attr('name') + "-error";
                if ($(thi).val() == "" || $(thi).val() == null) {
                    $(this_form).find("#" + this_err).html("Please provide a value");
                    $(this_form).find("#" + this_err).show();
                    valid = false;
                }

            })

            $(this).find('.SKU').each(function () {
                var thi = $(this);
                var this_err = $(thi).attr('name') + "-error";
                if ($(thi).val() == "" || $(thi).val() == null) {
                    $(this_form).find("#" + this_err).html("Please provide a value");
                    $(this_form).find("#" + this_err).show();
                    valid = false;
                }
            })

            var str = '';
            $(this).find('.Variation').each(function () {
                var thi = $(this);
                var this_err = $(thi).attr('id-data') + "-error";
                var vel = $(thi).val();
                if (vel != '') {
                    str += ',' + vel;
                }
            })

            // if(str != ''){
            //     datavari1.push(str);
            //     if (hasDuplicates(datavari1)) {

            //         toastr.error("you have duplicates variation values !",'Error',{timeOut: 5000});
            //         valid = false;
            //     }
            // }
        });

        return valid;
    }

    function validateVariantsFormSub() {


        var valid = true;

        $('.variantForm').each(function () {
            var this_form = $(this);
            if (!$(this).valid()) {
                valid = false;
            }

            $(this).find('.Variation').each(function () {
                var thi = $(this);
                var this_err = $(thi).attr('id-data') + "-error";
                if ($(thi).val() == "" || $(thi).val() == null) {
                    $(this_form).find("#" + this_err).html("Please select any value");
                    $(this_form).find("#" + this_err).show();
                    valid = false;
                }
            })

        });

        return valid;
    }

    function validateVariantsFormDraf() {
        $(".variantForm").each(function () {

            $(this).validate({
                rules: {
                    varProductName: {
                        required: true,
                    },
                    varSalePrice: {
                        required: true,
                    },
                    stock: {
                        required: true,
                    },
                    SKU: {
                        required: true,
                    },



                    /*weight: {
                        required: {
                            depends: function(elem) {
                                return $("#age").val() > 50
                            }
                        },
                        number: true,
                        min: 0
                    }*/
                },

                messages: {
                    varProductName: {
                        required: "Please provide a Product Title"
                    },
                    varSalePrice: {
                        required: "Please provide a Sale Price",
                    },
                    stock: {
                        required: "Please provide a Stock",
                    },
                    SKU: {
                        required: "Please provide a SKU ",
                    },
                }
            });
        })

        var valid = true;
        var datavari = [];
        var datavari1 = [];
        SKUs = [];
        $('.variantForm').each(function () {
            var this_form = $(this);
            if (!$(this).valid()) {
                valid = false;
            }

            $(this).find('.varRegularPrice').each(function () {
                var thi = $(this);
                var this_err = $(thi).attr('name') + "-error";
                var RegularPrice = $(thi).val();
                var ret = $(thi).attr('name').replace('varRegularPrice', '');
                var stringdata = 'varSalePrice' + ret;
                var SellingPrice = $("input[name=" + stringdata + "]").val();
                if (RegularPrice > 0) {
                    if (Number(SellingPrice) > Number(RegularPrice)) {
                        $(this_form).find("#" + this_err).html("Selling Price from should be less than Regular Price to");
                        $(this_form).find("#" + this_err).show();
                        valid = false;
                    }
                }
            })


            // var valid_extensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

            // if(!valid_extensions.test($(this).find('input[name="varImage"]').val())){ 
            //     $(this).find("#varImage-error").html("Please provide a product images");
            //     $(this).find("#varImage-error").show();
            //     valid = false;
            // }    


            // if($(this).find('input[name="varImage"]').val()==""){
            //     $(this).find("#varImage-error").html("Please provide a product images");
            //     $(this).find("#varImage-error").show();
            //     valid = false;

            // }

            $(this).find('.Variation').each(function () {
                var thi = $(this);
                var this_err = $(thi).attr('id-data') + "-error";
                if ($(thi).val() == "" || $(thi).val() == null) {
                    $(this_form).find("#" + this_err).html("Please select any value");
                    $(this_form).find("#" + this_err).show();
                    valid = false;
                }
            })

            $(this).find('.specReq').each(function () {
                var thi = $(this);
                var this_err = $(thi).attr('id-data') + "-error";
                if ($(thi).val() == "" || $(thi).val() == null) {
                    $(this_form).find("#" + this_err).html("Please select any value");
                    $(this_form).find("#" + this_err).show();
                    valid = false;
                }
            })

            // $(this).find('.SKU').each(function() {
            //     var thi = $(this);
            //     var this_err = $(thi).attr('id-data') + "-error";

            //     if(SKUs.length !== 0) {
            //         var check = SKUs.includes($(thi).val());
            //         SKUs.push($(thi).val());
            //         if(check){
            //         $("#"+this_err).html("This sku code is already taken! Try another.");
            //         $("#"+this_err).show();
            //         valid = false;
            //         }
            //     }

            // })

            $(this).find('.varSalePrice').each(function () {
                var thi = $(this);
                var this_err = $(thi).attr('name') + "-error";
                if ($(thi).val() == "" || $(thi).val() == null) {
                    $(this_form).find("#" + this_err).html("Please provide a value");
                    $(this_form).find("#" + this_err).show();
                    valid = false;
                }

            })

            // $(this).find('.stock').each(function() {
            //     var thi = $(this);
            //     var this_err = $(thi).attr('name') + "-error";
            //     if($(thi).val()=="" || $(thi).val()==null) {
            //         $(this_form).find("#"+this_err).html("Please provide a value");
            //         $(this_form).find("#"+this_err).show();
            //         valid = false;
            //     }

            // })

            // $(this).find('.SKU').each(function() {
            //     var thi = $(this);
            //     var this_err = $(thi).attr('name') + "-error";
            //     if($(thi).val()=="" || $(thi).val()==null) {
            //         $(this_form).find("#"+this_err).html("Please provide a value");
            //         $(this_form).find("#"+this_err).show();
            //         valid = false;
            //     }
            // })

            var str = '';
            $(this).find('.Variation').each(function () {
                var thi = $(this);
                var this_err = $(thi).attr('id-data') + "-error";
                var vel = $(thi).val();
                if (vel != '') {
                    str += ',' + vel;
                }
            })

            // if(str != ''){
            //     datavari1.push(str);
            //     if (hasDuplicates(datavari1)) {

            //         toastr.error("you have duplicates variation values !",'Error',{timeOut: 5000});
            //         valid = false;
            //     }
            // }
        });

        return valid;
    }

    function validateAttributesForm() {



        var valid = true;
        var datavari = [];
        var datavari1 = [];
        SKUs = [];
        //alert($('input:checkbox.myClassA:checked').length);
        if (($('input:checkbox.myClassA:checked').length) > 4) {
            alert("You must check at least 4 variant");
            valid = false;
        }

        if (($('input:checkbox.check:checked').length) <= 0) {
            alert("You must check at least one use comman");
            valid = false;
        }

        $('.attributeForm').each(function () {
            var this_form = $(this);
            if (!$(this).valid()) {
                valid = false;
            }


            $(this).find('.Attribute').each(function () {
                var thi = $(this);
                var this_err = $(thi).attr('id-data') + "-error";
                if ($(thi).val() == "" || $(thi).val() == null) {
                    $(this_form).find("#" + this_err).html("Please select any value");
                    $(this_form).find("#" + this_err).show();
                    valid = false;
                }
            })


        });

        return valid;
    }

    function hasDuplicates(arr) {
        var counts = [];

        for (var i = 0; i <= arr.length; i++) {
            if (counts[arr[i]] === undefined) {
                counts[arr[i]] = 1;
            } else {
                return true;
            }
        }
        return false;
    }

    function product_table(is_clearState = false) {
        if (is_clearState) {
            $('#Product').DataTable().state.clear();
        }

        $('#Product').DataTable({
            "destroy": true,
            "processing": true,
            "serverSide": true,
            'stateSave': function () {
                if (is_clearState) {
                    return false;
                }
                else {
                    return true;
                }
            },
            "ajax": {
                "url": "{{ url('admin/allproductlist') }}",
                "dataType": "json",
                "type": "POST",
                "data": { _token: '{{ csrf_token() }}' },
                // "dataSrc": ""
            },
            'columnDefs': [
                { "width": "50px", "targets": 0 },
                { "width": "120px", "targets": 1 },
                { "width": "170px", "targets": 2 },
                { "width": "240px", "targets": 3 },
                { "width": "120px", "targets": 4 },
                { "width": "120px", "targets": 5 },
                { "width": "120px", "targets": 6 },
                { "width": "120px", "targets": 7 },
            ],
            "columns": [
                {
                    data: 'id', name: 'id', class: "text-center", orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: 'image', name: 'image', orderable: false, searchable: false, class: "text-center" },
                { data: 'product_title', name: 'product_title', class: "text-left multirow" },
                { data: 'categories', name: 'categories', class: "text-left", orderable: false },
                { data: 'price', name: 'price', class: "text-left", orderable: false },
                { data: 'estatus', name: 'estatus', orderable: false, searchable: false, class: "text-center" },
                { data: 'created_at', name: 'created_at', searchable: false, class: "text-left" },
                { data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center" },
            ]
        });
    }

    $(document).ready(function () {
        product_table(true);
        $('.catMulti').select2({
            width: '100%',
            multiple: true,
            placeholder: "Select...",
            allowClear: true,
            autoclose: false,
            closeOnSelect: false,
        });

        $('.attribute_id').select2({
            width: '100%',
            placeholder: "Select...",
            allowClear: true,
            autoclose: false,
            closeOnSelect: false,
        });

        $('.Attribute').select2({
            width: '100%',
            multiple: true,
            placeholder: "Select...",
            allowClear: true,
            autoclose: false,
            closeOnSelect: false,
        });

        $('.Variation').select2({
            width: '100%',
            multiple: true,
            placeholder: "Select...",
            allowClear: true,
            autoclose: false,
            closeOnSelect: false,
        });

        $('.specReq').select2({
            width: '100%',
            multiple: true,
            placeholder: "Select...",
            allowClear: true,
            autoclose: false,
            closeOnSelect: false,
        });

        $('.specOpt').select2({
            width: '100%',
            multiple: true,
            placeholder: "Select...",
            allowClear: true,
            autoclose: false,
            closeOnSelect: false,
        });


    });

    $('body').on('click', '#editProductBtn', function () {
        var product_id = $(this).attr('data-id');
        // {{--location.href = "{{ url('admin/products') }}" + "/" + product_id + "/edit";--}}
        var url = "{{ url('admin/products') }}" + "/" + product_id + "/edit";
        window.open(url, "_blank");
    });

    function removeuploadedimg(divId, inputId, imgName) {
        var ImageUrl = $("#web_url").val() + "/admin/";
        if (confirm("Are you sure you want to remove this file?")) {
            $("#" + divId).remove();
            var imgNameVal = $("#" + inputId).val();
            var imgValues = imgNameVal.split(',');
            for (var s = 0; s < imgValues.length; s++) {
                if (imgValues[s] == imgName) {
                    imgValues.splice(s, 1);
                    imgValues = imgValues.join(',');
                }
            }
            $("#" + inputId).val(imgValues);
            /*$.ajax({
                type: "POST",
                url: ImageUrl + 'variant/removefile?action=removeProductImages',
                data: {'_token': $('meta[name="csrf-token"]').attr('content'), file: imgName},
                success: function (data) {

                }
            });*/
        }
    }

    function chageProductStatus(variant_id) {
        $.ajax({
            type: 'GET',
            url: "{{ url('admin/changeproductstatus') }}" + '/' + variant_id,
            success: function (res) {
                if (res.status == 200 && res.action == 'deactive') {
                    $("#ProductStatuscheck_" + variant_id).val(2);
                    $("#ProductStatuscheck_" + variant_id).prop('checked', false);
                    toastr.success("Product Deactivated", 'Success', { timeOut: 5000 });
                }
                if (res.status == 200 && res.action == 'active') {
                    $("#ProductStatuscheck_" + variant_id).val(1);
                    $("#ProductStatuscheck_" + variant_id).prop('checked', true);
                    toastr.success("Product activated", 'Success', { timeOut: 5000 });
                }
            },
            error: function (data) {
                toastr.error("Please try again", 'Error', { timeOut: 5000 });
            }
        });
    }

    $('body').on('click', '#deleteProductBtn', function (e) {
        // e.preventDefault();
        var variant_id = $(this).attr('data-id');
        $("#DeleteProductModal").find('#RemoveProductSubmit').attr('data-id', variant_id);
    });

    $('body').on('click', '#RemoveProductSubmit', function (e) {
        $('#RemoveProductSubmit').prop('disabled', true);
        $(this).find('.removeloadericonfa').show();
        e.preventDefault();
        var variant_id = $(this).attr('data-id');
        $.ajax({
            type: 'GET',
            url: "{{ url('admin/products') }}" + '/' + variant_id + '/delete',
            success: function (res) {
                if (res.status == 200) {
                    $("#DeleteProductModal").modal('hide');
                    $('#RemoveProductSubmit').prop('disabled', false);
                    $("#RemoveProductSubmit").find('.removeloadericonfa').hide();
                    product_table();
                    toastr.success("Product Deleted", 'Success', { timeOut: 5000 });
                }

                if (res.status == 400) {
                    $("#DeleteProductModal").modal('hide');
                    $('#RemoveProductSubmit').prop('disabled', false);
                    $("#RemoveProductSubmit").find('.removeloadericonfa').hide();
                    product_table();
                    toastr.error("Please try again", 'Error', { timeOut: 5000 });
                }
            },
            error: function (data) {
                $("#DeleteProductModal").modal('hide');
                $('#RemoveProductSubmit').prop('disabled', false);
                $("#RemoveProductSubmit").find('.removeloadericonfa').hide();
                product_table();
                toastr.error("Please try again", 'Error', { timeOut: 5000 });
            }
        });
    });


    $('body').on('click', '#AddSub', function () {
        $(this).prop('disabled', true);
        var html = "";
        var term_id = 1;
        var term_name = 'test';
        var check_add = $(this).attr('data-id');

        var term_no = $("#attributes_no").val();
        term_no++;
        $("#attributes_no").val(term_no);

        var VariantCnt = "";

        // if($("#attribute-data").children('div').length>0){
        //     VariantCnt = $("#attribute-data").children('div').length;
        // }

        var selected = $('#attribute_id option:selected');
        var valuee = selected.attr('value');
        var title = selected.attr('data-title');

        if (valuee != "" && valuee != undefined) {

            $.ajax({
                type: "GET",
                url: '{{ url('admin/ addAttributebox') }}' + "/" + valuee,
                data : { VariantCnt: VariantCnt, term_id: term_no, term_name: term_name, check_add: check_add },
                success: function (res) {

                    $("#save_attributes").show();
                    $(".add-value-sub").append(res['data']);
                    $("#variantProductBox").show();
                    $('.CatDisabMenuLink').addClass('disableCategory');

                    $("#attribute_id>option[value='" + valuee + "']").attr('disabled', 'disabled');

                    $("#attribute_id").select2({
                        width: '100%',
                        placeholder: "Select...",
                        allowClear: true,
                        autoclose: false,
                        closeOnSelect: false,
                    }).val("").trigger("change");

                    $('.Attribute').select2({
                        width: '100%',
                        multiple: true,
                        placeholder: "Select...",
                        allowClear: true,
                        autoclose: false,
                        closeOnSelect: false,
                    });

                },
                complete: function () {
                    //addPrimaryBox();
                    $("#attr-cover-spin").fadeOut();
                }

                
            });

    AttributeSelCheckbox.push(term_no);
    var attr_ids = AttributeSelCheckbox.join(",");
    // alert(attr_ids);
    $("#attr_ids").val(attr_ids);
    $(this).prop('disabled', false);

        }else {
        $(this).prop('disabled', false);
    }
        // else{
        //     html += '<div class="row mt-sm-3 mx-0">'+

        //         '<div class="col-12 col-sm-5 my-3 my-sm-0">'+
        //             '<input type="text" placeholder="Field Name" class="form-control input-flat" name="sub_field_name[]" />'+
        //         '</div>'+
        //         '<div class="col-10 col-sm-5">'+
        //             '<input  type="text" value="" class="form-control input-flat pe-none" name="sub_field_type[]"  />'+
        //         '</div>'+
        //         '<div class="col-2 col-sm-2 text-center">'+
        //             '<button type="button"  class="minus_btn btn btn-dark px-0"><img src="{{asset('user/assets/icons/delete-red.png')}}"></button>'+
        //         '</div>'+
        //     '</div>';

        // } 



        //$(".add-value-sub").append(html);
    });

    $('body').on('click', '.minus_btn', function () {
        var tthis = $(this).parent().parent();
        var ddd = tthis.remove()
    });

    $('body').on('click', '#save_attributes', function () {
        $(this).prop('disabled', true);
        $(this).find('.submitloader').show();
        var btn = $(this);
        // var is_custom = $('#is_custom').val();

        var valid_attributes = validateAttributesForm();

        if (valid_attributes == true) {


            var formData = new FormData($('#ProductForm')[0]);
            var cnt = 1;
            $('.attributeForm').each(function () {
                //     var thi = $(this);
                //     var specOptArr = [];
                //     $(thi).find('.specOpt').each(function() {
                //        if($(this).val()!=""){
                //            specOptArr.push($(this).attr('data-id'));
                //        }
                //     });
                //    $(thi).find('input[name="varSpecOptional"]').val("");
                //    $(thi).find('input[name="varSpecOptional"]').val(specOptArr.join(","));

                var attributeFormForm = $(this).serialize();
                formData.append("attributeForm" + cnt, attributeFormForm);
                cnt++;
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('admin.productattribute.save') }}",
                // data: {productFormData: productFormData, variantFormData: variantFormData},
                data: formData,
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                // contentType: 'json',
                success: function (res) {
                    //console.log(res.array_comman);
                    if (res['status'] == 200) {

                        $('#VariantBox').show();
                        if (res.action == "add") {
                            $("#variant-data").html(res.array_comman);
                        } else {
                            location.reload();
                        }
                        // $.each(res.array_comman, function( index, value ) {
                        //     $("#AddBox").trigger("click");
                        // });


                        $('.Variation').select2({
                            width: '100%',
                            multiple: true,
                            placeholder: "Select...",
                            allowClear: true,
                            autoclose: false,
                            closeOnSelect: false,
                        });

                        toastr.success("Attribute Added", 'Success', { timeOut: 5000 });
                        $(btn).prop('disabled', false);

                        // $('.single-variation-box').each(function(i, obj) {
                        //     var img_src = $(this).next('.variation-product-box');
                        //         console.log(img_src);
                        // });

                        // $.ajax ({
                        //     type:"GET",
                        //     url: '{{ url('admin/addVariantAttributebox') }}' + "/" + $("#product_u_id").val(),
                        //     //data :  {VariantCnt: VariantCnt, term_id: term_no, term_name: term_name},
                        //     success: function(res) {
                        //         console.log(res);
                        //         $(".VariationSelect").replaceWith(res['data']);
                        //         //$("#variantProductBox").show();
                        //         //$('.CatDisabMenuLink').addClass('disableCategory');

                        //         $('.Variation').select2({
                        //             width: '100%',
                        //             placeholder: "Select...",
                        //             allowClear: true
                        //         });
                        //         $('.specReq').select2({
                        //             width: '100%',
                        //             multiple: true,
                        //             placeholder: "Select...",
                        //             allowClear: true,
                        //             autoclose: false,
                        //             closeOnSelect: false,
                        //         });

                        //         $('.specOpt').select2({
                        //             width: '100%',
                        //             multiple: true,
                        //             placeholder: "Select...",
                        //             allowClear: true,
                        //             autoclose: false,
                        //             closeOnSelect: false,
                        //         });

                        //         // variantImages(res['VariantCnt']);
                        //     },
                        //     complete: function(){
                        //         addPrimaryBox();
                        //         $("#attr-cover-spin").fadeOut();
                        //     }
                        // });

                        //$(".VariationSelect").append('<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><div class="form-group row"><label class="col-lg-12 col-form-label" for="VariationAttr"> <span class="text-danger">*</span></label><div class="col-lg-12"><select class="form-control Variation " id="" name="Variation1000"><option></option><option value="100"  >test</option></select></div></div><label id="Variation1000-error" class="error invalid-feedback animated fadeInDown" for=""></label></div>' );
                    }
                },
                error: function (data) {
                    $(btn).prop('disabled', false);
                    $(btn).find('.submitloader').hide();
                    toastr.error("Please try again", 'Error', { timeOut: 5000 });
                }
            });
        } else {
            $(btn).prop('disabled', false);
            $(btn).find('.submitloader').hide();
        }

    });

    $('#attribute-data').on('click', '.RemoveAttributeBox', function () {
        var boxid = $(this).attr("data-id");
        var attrid = $(this).attr("attr-id");
        //console.log(AttributeSelCheckbox);
        //alert(attrid);

        AttributeSelCheckbox = jQuery.grep(AttributeSelCheckbox, function (value) {
            //alert(value);
            return value != boxid;
        });
        var attr_ids = AttributeSelCheckbox.join(",");
        // console.log(attr_term_ids);
        $("#attr_ids").val(attr_ids);
        $(this).parent().parent().parent().remove();
        $("#attribute_id>option[value='" + attrid + "']").attr('disabled', false);
    });

    $(document).on('change', '#is_custom', function () {
        if ($(this).is(':checked')) {
            $(this).val(1);
            $(this).attr('checked', true);
        }
        else {
            $(this).val(0);
            $(this).attr('checked', false);
        }
    });


    $('body').on('click', '#AddSubSub', function () {
        $(this).prop('disabled', true);
        $(this).find('.submitloader').show();
        var btn = $(this);
        //console.log(btn.next().next());
        var formname = $(this).parent()[0];
        var formData = new FormData(formname);
        //console.log(formData);
        // var is_custom = $('#is_custom').val();

        //var valid_attributes = validateAttributesForm();
        //var valid_variants_sub = validateVariantsFormSub();
        valid = true;

        var this_form = $(this).parents("form");
        //console.log(this_form);
        this_form.find('.Variation').each(function () {
            var thi = $(this);
            var this_err = $(thi).attr('id-data') + "-error";
            //alert(this_err);
            if ($(thi).val() == "" || $(thi).val() == null) {
                $(this_form).find("#" + this_err).html("Please select any value");
                $(this_form).find("#" + this_err).show();
                valid = false;
            } else {
                $(this_form).find("#" + this_err).hide();
            }
        })

        if (valid == true) {
            //var formData = new FormData($('#attributeForm')[0]);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('admin.subproductattribute.save') }}",
                // data: {productFormData: productFormData, variantFormData: variantFormData},
                data: formData,
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                // contentType: 'json',
                success: function (res) {
                    // console.log(res.data);
                    if (res['status'] == 200) {

                        $('#VariantBox').show();
                        //console.log(btn.next().next());
                        $(btn.next().next()).html(res.data);
                        //$(btn.next().next()).append(res.data);
                        // $.each(res.array_comman, function( index, value ) {
                        //     $("#AddBox").trigger("click");
                        // });


                        $('.Variation').select2({
                            width: '100%',
                            multiple: true,
                            placeholder: "Select...",
                            allowClear: true,
                            autoclose: false,
                            closeOnSelect: false,
                        });

                        //toastr.success("Attribute Added",'Success',{timeOut: 5000});
                        $(btn).prop('disabled', false);


                    }
                },
                error: function (data) {
                    $(btn).prop('disabled', false);
                    $(btn).find('.submitloader').hide();
                    toastr.error("Please try again", 'Error', { timeOut: 5000 });
                }
            });
        } else {
            $(btn).prop('disabled', false);
            $(btn).find('.submitloader').hide();
        }

    });

    $('body').on('click', '#AddSubSubEdit', function () {
        $(this).prop('disabled', true);
        $(this).find('.submitloader').show();
        var btn = $(this);
        //console.log(btn.next().next());
        var demo = $(this).parent()[0];
        var formData = new FormData(demo);
        //console.log(formData);
        // var is_custom = $('#is_custom').val();

        //var valid_attributes = validateAttributesForm();
        //var valid_variants_sub = validateVariantsFormSub();
        valid = true;

        var this_form = $(this).parents("form");
        //console.log(this_form);
        this_form.find('.Variation').each(function () {
            var thi = $(this);
            var this_err = $(thi).attr('id-data') + "-error";
            //alert(this_err);
            if ($(thi).val() == "" || $(thi).val() == null) {
                $(this_form).find("#" + this_err).html("Please select any value");
                $(this_form).find("#" + this_err).show();
                valid = false;
            } else {
                $(this_form).find("#" + this_err).hide();
            }
        })

        if (valid == true) {
            //var formData = new FormData($('#attributeForm')[0]);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('admin.subproductattribute.edit') }}",
                // data: {productFormData: productFormData, variantFormData: variantFormData},
                data: formData,
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                // contentType: 'json',
                success: function (res) {
                    // console.log(res.data);
                    if (res['status'] == 200) {

                        $('#VariantBox').show();
                        //console.log(btn.next().next());
                        //$(btn.next().next()).html(res.data);
                        $(btn.next().next()).append(res.data);
                        // $.each(res.array_comman, function( index, value ) {
                        //     $("#AddBox").trigger("click");
                        // });


                        $('.Variation').select2({
                            width: '100%',
                            multiple: true,
                            placeholder: "Select...",
                            allowClear: true,
                            autoclose: false,
                            closeOnSelect: false,
                        });

                        //toastr.success("Attribute Added",'Success',{timeOut: 5000});
                        $(btn).prop('disabled', false);
                    }
                },
                error: function (data) {
                    $(btn).prop('disabled', false);
                    $(btn).find('.submitloader').hide();
                    toastr.error("Please try again", 'Error', { timeOut: 5000 });
                }
            });
        } else {
            $(btn).prop('disabled', false);
            $(btn).find('.submitloader').hide();
        }

    });

    //$(".allattribute").click(function(){
    $('body').on('click', '.allattribute', function () {
        if ($(".allattribute").is(':checked')) {
            $(this).parent().parent().parent().parent().find('.Attribute').select2('destroy').find('option').prop('selected', 'selected').end().select2({
                width: '100%',
                multiple: true,
                placeholder: "Select...",
                allowClear: true,
                autoclose: false,
                closeOnSelect: false,
            });
            //$(this).parent().parent().parent().parent().find('.Attribute').find("option").trigger("change");
        } else {
            $(this).parent().parent().parent().parent().find('.Attribute').select2('destroy').find('option').prop('selected', false).end().select2({
                width: '100%',
                multiple: true,
                placeholder: "Select...",
                allowClear: true,
                autoclose: false,
                closeOnSelect: false,
            });
            // $(this).parent().parent().parent().parent().find('.Attribute').find("option").trigger("change");
        }
    });

    $("document").ready(function () {
        $("#ProductName").trigger('change');
    });

    CKEDITOR.replace('desc', {
        toolbar: [
            { name: 'document', groups: ['mode', 'document', 'doctools'], items: ['Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates'] },
            { name: 'clipboard', groups: ['clipboard', 'undo'], items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
            { name: 'editing', groups: ['find', 'selection', 'spellchecker'], items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt'] },
            { name: 'forms', items: ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'] },

            { name: 'basicstyles', groups: ['basicstyles', 'cleanup'], items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'] },
            { name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi'], items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language'] },
            { name: 'links', items: ['Link', 'Unlink', 'Anchor'] },
            { name: 'insert', items: ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe'] },
            '/',
            { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
            { name: 'colors', items: ['TextColor', 'BGColor'] },
            { name: 'tools', items: ['Maximize', 'ShowBlocks'] },
            { name: 'others', items: ['-'] },
            { name: 'about', items: ['About'] }
        ],
        filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });

    CKEDITOR.config.height = '200';
</script>

<!-- product JS end -->