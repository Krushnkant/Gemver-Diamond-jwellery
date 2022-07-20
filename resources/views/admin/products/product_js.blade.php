<!-- product JS start -->
<script src="{{ asset('js/bootstrap-4-navbar.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script type="text/javascript">
    let catSelectValArray = [];
    let catSelectStrArray = [];
    let parentCatValArray = [];
    let TermSelCheckbox =[];



    @if(Route::current()->getName() == 'admin.products.edit')

    var newval = $("#attr_term_ids").val();
    var match = newval.split(',');

    $.each(match, function( index, value ) {
        TermSelCheckbox.push(value);
    });

    //console.log(TermSelCheckbox);
    // match.push(match); 
    // console.log(match);
    //$("#attr_term_ids").val(attr_term_ids);
   
   @endif
    

    $('body').on('click', '#AddProductBtn', function () {
        location.href = "{{ route('admin.products.add') }}";
    });

    $('.dropdown-item').click( function() {
        var catSelectedVal = $(this).attr('data-val');
        var catSelectedStr = $(this).attr('data-title');
        var parentcatid = $(this).attr('parent-cat');
        //If the element was not found in array, -1 will be returned.
        if($.inArray(catSelectedVal, catSelectValArray) === -1){
            if($.inArray(parentcatid, parentCatValArray) !== -1){
                for(var i=0; i<parentCatValArray.length; i++) {
                    if(parentcatid === parentCatValArray[i]){
                        catSelectValArray.splice($.inArray(catSelectValArray[i], catSelectValArray),1);
                        parentCatValArray.splice($.inArray(parentCatValArray[i], parentCatValArray),1);
                        catSelectStrArray.splice($.inArray(catSelectStrArray[i], catSelectStrArray),1);
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

    $(".last-child").click(function() {
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
        if($.inArray(catSelectedVal, catSelectValArray) === -1){
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
        $("#AddBox").show();
        $( "#AddBox" ).trigger( "click" );

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
    $(document).on('click', '.AddBox', function() {
       
        $("#attr-cover-spin").fadeIn();
        var term_id = 1;
        var term_name = 'test';

        var term_no = $("#term_no").val();
         term_no ++;
        $("#term_no").val(term_no);

        //if ($(this).is(':checked')) {
           // var ischecked = 1;
          //  $(this).attr('checked', true);


            // var VariantCnt = $(".VariantCnt:last").html();
            var VariantCnt = "";
            // alert($("#variant-data").children('div').length);
            if($("#variant-data").children('div').length>0){
                VariantCnt = $("#variant-data").children('div').length;
            }
            $.ajax ({
                type:"GET",
                url: '{{ url('admin/addVariantbox') }}' + "/" + $("#childCategoryId").val(),
                data :  {VariantCnt: VariantCnt, term_id: term_no, term_name: term_name},
                success: function(res) {
                     //console.log(res);
                    $("#variant-data").append(res['data']);
                    $("#variantProductBox").show();
                    $('.CatDisabMenuLink').addClass('disableCategory');

                    $('.Variation').select2({
                        width: '100%',
                        placeholder: "Select...",
                        allowClear: true
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
                complete: function(){
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

    $('#variant-data').on('click', '.RemoveBox', function() {
        var boxid = $(this).attr("data-id");
       // console.log(TermSelCheckbox);
        //alert(boxid);
         TermSelCheckbox = jQuery.grep(TermSelCheckbox, function(value) {
             //alert(value);
           return value != boxid;
         });
         var attr_term_ids = TermSelCheckbox.join(",");
        // console.log(attr_term_ids);
        $("#attr_term_ids").val(attr_term_ids);
        $(this).parent().parent().parent().remove();
        
    });

    function addPrimaryBox() {
        var varProductName = $("#variant-data").children('div:first-child').find('input[name="varProductName"]');
        var varRegularPrice = $("#variant-data").children('div:first-child').find('input[name="varRegularPrice"]');
        var varSalePrice = $("#variant-data").children('div:first-child').find('input[name="varSalePrice"]');
        var stock = $("#variant-data").children('div:first-child').find('input[name="stock"]');
        var specReq = $("#variant-data").children('div:first-child').find('.specReq');
        var specOpt = $("#variant-data").children('div:first-child').find('.specOpt');
        if(!varProductName.hasClass('primaryBox')){
            varProductName.addClass('primaryBox');
        }
        if(!varRegularPrice.hasClass('primaryBox')){
            varRegularPrice.addClass('primaryBox');
        }
        if(!varSalePrice.hasClass('primaryBox')){
            varSalePrice.addClass('primaryBox');
        }
        if(!stock.hasClass('primaryBox')){
            stock.addClass('primaryBox');
        }
        if(!specReq.hasClass('primaryBox')){
            specReq.addClass('primaryBox');
        }
        if(!specOpt.hasClass('primaryBox')){
            specOpt.addClass('primaryBox');
        }
    }

    function collapsePanel(thi) {
        if($(thi).parents('.variation-selection-box:first').hasClass('active')){
            $(thi).parents('.variation-selection-box:first').removeClass('active');
            $(thi).parents('.variation-selection-box:first').siblings('.variation-product-box').removeClass('show');
        }
        else{
            $(thi).parents('.variation-selection-box:first').addClass('active');
            $(thi).parents('.variation-selection-box:first').siblings('.variation-product-box').addClass('show');
        }
    }

    $(document).on('change', '.varSalePrice', function() {
        var isPrimary = $("#copyAppBtn").val();
        var salePrice = $(this).val();

        if($(this).hasClass("primaryBox") && isPrimary != 0){
            $(".varSalePrice").val(salePrice);
        }
    });

    $(document).on('change', '.stock', function() {
        var isPrimary = $("#copyAppBtn").val();
        var stock = $(this).val();

        if($(this).hasClass("primaryBox") && isPrimary != 0){
            $(".stock").val(stock);
        }
    });

    $(document).on('change', '.varProductName', function() {
        var isPrimary = $("#copyAppBtn").val();
        var productName = $(this).val();

        if($(this).hasClass("primaryBox") && isPrimary != 0){
            $(".varProductName").val(productName);
        }
    });

    $(document).on('change', '.varRegularPrice ', function() {
        var isPrimary = $("#copyAppBtn").val();
        var RegularPrice = $(this).val();

        if($(this).hasClass("primaryBox") && isPrimary != 0){
            $(".varRegularPrice ").val(RegularPrice);
        }
    });

    $(document).on('change', '.specReq', function() {
        var isPrimary = $("#copyAppBtn").val();
        var specReq = $(this).val();
        var this_name = $(this).attr('id-data');

        // alert(specReq);
        if($(this).hasClass("primaryBox") && isPrimary != 0) {
            
            $("select[name=" + this_name + "]").each(function () {
                
                var this_select = $(this);
                if (!$(this_select).hasClass('primaryBox')) {
                    $(this_select).val(specReq);
                    $(this_select).select2().trigger('change');
                    if($(this_select).val()==""){
                        $(this_select).select2({
                            placeholder: "Select...",
                        });
                    }
                }
            });
        }
    });

    $(document).on('change', '.specOpt', function() {
        var isPrimary = $("#copyAppBtn").val();
        var specReq = $(this).val();
        var this_name = $(this).attr('name');

        // alert(specReq);
        if($(this).hasClass("primaryBox") && isPrimary != 0) {
            $("select[name=" + this_name + "]").each(function () {
                var this_select = $(this);
                if (!$(this_select).hasClass('primaryBox')) {
                    $(this_select).val(specReq);
                    $(this_select).select2().trigger('change');
                    if($(this_select).val()==""){
                        $(this_select).select2({
                            placeholder: "Select...",
                        });
                    }
                }
            });
        }
    });

    $(document).on('change', '#copyAppBtn', function() {
        if ($(this).is(':checked')) {
            $(this).val(1);
            $(this).attr('checked', true);
        }
        else {
            $(this).val(0);
            $(this).attr('checked', false);
        }
    });

    $(document).on('change', '#is_custom', function() {
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
        $(this).prop('disabled',true);
        $(this).find('.submitloader').show();
        var btn = $(this);
        var is_custom = $('#check_id').val();

        var valid_product = validateProductForm();
        var valid_variants = validateVariantsForm();

        if(valid_product==true && valid_variants==true){
            var formData = new FormData($('#ProductForm')[0]);
            var cnt = 1;
            $('.variantForm').each(function () {
                var thi = $(this);
                var specOptArr = [];
                $(thi).find('.specOpt').each(function() {
                   if($(this).val()!=""){
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
                   // console.log(res);
                    if(res['status']==200){
                        if(is_custom == 1){
                            location.href = "{{ route('admin.customproducts.list') }}";
                        }else{
                            location.href = "{{ route('admin.products.list') }}";
                        }
                        
                        toastr.success("Product Added",'Success',{timeOut: 5000});
                    }
                },
                error: function (data) {
                    $(btn).prop('disabled',false);
                    $(btn).find('.submitloader').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            });
        }
        else{
            $(btn).prop('disabled',false);
            $(btn).find('.submitloader').hide();
        }
    });

    function validateProductForm() {
        $("#category-error").html("");
        $("#variationAttrsVal-error").html("");
        $("#category-error").hide();
        $("#variationAttrsVal-error").hide();

        var valid = true;
        if($("#categoryIds").val()=='' || $("#childCategoryId").val()==''){
            $("#category-error").html("Please select a Category");
            $("#category-error").show();
            valid = false;
        }

        if($("#ProductName").val()==''){
            $("#ProductName-error").html("Please Enter Product Name");
            $("#ProductName-error").show();
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

    $(document).ready(function() {
       
       // $('.SKU').change(function(){
    $('body').on('change', '.SKU', function () {
            var skuvalue = this.value;
            var thi = $(this);
            var this_err = $(thi).attr('id-data') + "-error";
            $.ajax({
                type:"POST",
                async: false,
                url: "{{ url('admin/products/checksku') }}", // script to validate in server side
                data: {username: skuvalue,_token: '{{csrf_token()}}'},
                success: function(data) {
                    
                    result = (data == "true") ? true : false;

                    if(result == false){
                        $("#"+this_err).html("This sku code is already taken! Try another.");
                        $("#"+this_err).show();

                        // $("#SKU-error").html("This sku code is already taken! Try another.");
                        // $("#SKU-error").show();
                    }else{
                        $("#"+this_err).html("");
                        $("#"+this_err).hide(); 
                    }
                }
            });
        });
    });

    function validateVariantsForm() {
        $(".variantForm").each(function() {

            $(this).validate({
                rules: {
                    varProductName : {
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

                messages : {
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

            if($(this).find('input[name="varImage"]').val()==""){
                $(this).find("#varImage-error").html("Please provide a product images");
                $(this).find("#varImage-error").show();
                valid = false;
            }

            $(this).find('.specReq').each(function() {
                var thi = $(this);
                var this_err = $(thi).attr('id-data') + "-error";
                if($(thi).val()=="" || $(thi).val()==null) {
                    $(this_form).find("#"+this_err).html("Please select any value");
                    $(this_form).find("#"+this_err).show();
                    valid = false;
                }
            })
           
            $(this).find('.SKU').each(function() {
                var thi = $(this);
                var this_err = $(thi).attr('id-data') + "-error";
                var check = SKUs.includes($(thi).val());
                SKUs.push($(thi).val());
                if(check){
                $("#"+this_err).html("This sku code is already taken! Try another.");
                $("#"+this_err).show();
                valid = false;
                }
              
            })

          

            $(this).find('.Variation').each(function() {
                var thi = $(this);
                var this_err = $(thi).attr('name') + "-error";
                if($(thi).val()=="" || $(thi).val()==null) {
                    $(this_form).find("#"+this_err).html("Please select any value");
                    $(this_form).find("#"+this_err).show();
                    valid = false;
                }
            })

            var str = '';
            $(this).find('.Variation').each(function() {
                var thi = $(this);
                var this_err = $(thi).attr('name') + "-error";
                var vel =$(thi).val();
                if(vel != ''){
                 str += ','+vel;
                }   
            })
            
            if(str != ''){
                datavari1.push(str);
                if (hasDuplicates(datavari1)) {
                    
                    toastr.error("you have duplicates variation values !",'Error',{timeOut: 5000});
                    valid = false;
                }
            }
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

    function product_table(is_clearState=false){
        if(is_clearState){
            $('#Product').DataTable().state.clear();
        }

        $('#Product').DataTable({
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
                "url": "{{ url('admin/allproductlist') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: '{{ csrf_token() }}'},
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
                {data: 'id', name: 'id', class: "text-center", orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data: 'image', name: 'image', orderable: false, searchable: false, class: "text-center"},
                {data: 'product_title', name: 'product_title', class: "text-left multirow"},
                {data: 'categories', name: 'categories', class: "text-left", orderable: false},
                {data: 'price', name: 'price', class: "text-left", orderable: false},
                {data: 'estatus', name: 'estatus', orderable: false, searchable: false, class: "text-center"},
                {data: 'created_at', name: 'created_at', searchable: false, class: "text-left"},
                {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
            ]
        });
    }

    $(document).ready(function() {
        product_table(true);
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
        {{--location.href = "{{ url('admin/products') }}" + "/" + product_id + "/edit";--}}
        var url = "{{ url('admin/products') }}" + "/" + product_id + "/edit";
        window.open(url,"_blank");
    });

    function removeuploadedimg(divId, inputId, imgName){
        var ImageUrl = $("#web_url").val() + "/admin/";
        if(confirm("Are you sure you want to remove this file?")) {
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
            url: "{{ url('admin/changeproductstatus') }}" +'/' + variant_id,
            success: function (res) {
                if(res.status == 200 && res.action=='deactive'){
                    $("#ProductStatuscheck_"+variant_id).val(2);
                    $("#ProductStatuscheck_"+variant_id).prop('checked',false);
                    toastr.success("Product Deactivated",'Success',{timeOut: 5000});
                }
                if(res.status == 200 && res.action=='active'){
                    $("#ProductStatuscheck_"+variant_id).val(1);
                    $("#ProductStatuscheck_"+variant_id).prop('checked',true);
                    toastr.success("Product activated",'Success',{timeOut: 5000});
                }
            },
            error: function (data) {
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    }

    $('body').on('click', '#deleteProductBtn', function (e) {
        // e.preventDefault();
        var variant_id = $(this).attr('data-id');
        $("#DeleteProductModal").find('#RemoveProductSubmit').attr('data-id',variant_id);
    });

    $('body').on('click', '#RemoveProductSubmit', function (e) {
        $('#RemoveProductSubmit').prop('disabled',true);
        $(this).find('.removeloadericonfa').show();
        e.preventDefault();
        var variant_id = $(this).attr('data-id');
        $.ajax({
            type: 'GET',
            url: "{{ url('admin/products') }}" +'/' + variant_id +'/delete',
            success: function (res) {
                if(res.status == 200){
                    $("#DeleteProductModal").modal('hide');
                    $('#RemoveProductSubmit').prop('disabled',false);
                    $("#RemoveProductSubmit").find('.removeloadericonfa').hide();
                    product_table();
                    toastr.success("Product Deleted",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $("#DeleteProductModal").modal('hide');
                    $('#RemoveProductSubmit').prop('disabled',false);
                    $("#RemoveProductSubmit").find('.removeloadericonfa').hide();
                    product_table();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#DeleteProductModal").modal('hide');
                $('#RemoveProductSubmit').prop('disabled',false);
                $("#RemoveProductSubmit").find('.removeloadericonfa').hide();
                product_table();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });
    
    

</script>

<!-- product JS end -->
