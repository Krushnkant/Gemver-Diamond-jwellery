@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Product</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">

        <div id="attr-cover-spin" class="cover-spin"></div>
        <form method="post" id="ProductForm" action="">
            {{ csrf_field() }}
            <input type="hidden" id="action" name="action" value="editProduct">
            <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <h4 class="card-title">Edit Product</h4>
                                </div>
                            </div>

                            <input type="hidden" id="categoryIds" name="categoryIds" value="{{ isset($product->primary_category_id) ? ($product->primary_category_id) : ($product->primary_category_id) }}">
                            <input type="hidden" id="childCategoryId" name="childCategoryId" value="{{ isset($product->primary_category_id) ? $product->primary_category_id: '' }}">
                            <input type="hidden" id="attrid_for_variation" name="attrid_for_variation" value="{{ $product->attrid_for_variation }}">
                            <input type="hidden" id="attr_term_ids" name="attr_term_ids" value="{{ $product->attr_term_ids }}">
                            <?php  
                             $term_no_array = explode(',',$product->attr_term_ids);
                             $term_no=end($term_no_array);
                            ?>
                            <input type="hidden" id="term_no" name="term_no" value="{{ $term_no }}">
                            <div class="product-section">
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-lg-12 col-form-label" for="carame">Category <span class="text-danger">*</span></label>
                                        <div class="col-lg-12">
                                            <nav class="navbar navbar-expand-md categorydrops">
                                                <div class="collapse navbar-collapse categoryDropDown" id="navbarNavDropdown">
                                                    <ul class="navbar-nav categoryTitleBox bg-light">
                                                        <li class="nav-item dropdown CatDisabMenuLink disableCategory">

                                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Categories
                                                            </a>

                                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="position: absolute;">
                                                                <?php
                                                                foreach($catArray as $cat){
                                                                ?>
                                                                <li>
                                                                 
                                                                <a class="dropdown-item last-child" href="javascript:void(0)" data-val="<?php echo $cat['id']; ?>" data-title="<?php echo $cat['category_name']; ?>" parent-cat="<?php echo $cat['id']; ?>" ><?php echo $cat['category_name']; ?></a>
                                                              
                                                                </li>
                                                                <?php
                                                                }
                                                                ?>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <input type="text" class="form-control input-default" name="CategorySel" readonly="" id="CategorySel" value="{{ $CategorySel }}">
                                            </nav>
                                            <div id="category-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-12 col-form-label" for="ProductName">Product Title <span class="text-danger">*</span></label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control input-default ProductName" id="ProductName" name="ProductName" value="{{ isset($product->product_title)?$product->product_title:'' }}" >
                                            <label id="ProductName-error" class="error invalid-feedback animated fadeInDown" for="ProductName"></label>
                                        </div>
                                    </div>

                                    <!-- <div class="row form-group">
                                        <label class="col-lg-12 col-form-label" for="hsnCode">HSN Code</label>
                                        <div class="col-lg-12 ml-3">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                    <input type="text" class="form-control input-default" id="hsnCode" name="hsnCode" value="{{ isset($product->hsn_code)?$product->hsn_code:'' }}">
                                                    <div id="hsnCode-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                                </div>

                                             
                                            </div>
                                        </div>
                                    </div> -->

                                  

                                    <div class="row form-group">
                                        <label class="col-lg-12 col-form-label" for="Desc">Description</label>
                                        <div class="col-lg-12">
                                            <textarea type="text" class="form-control input-default" id="desc" name="desc">{{ $product->desc }}</textarea>
                                            <div id="desc-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Note</h4>
                            <textarea class="form-control input-default" name="notes" id="notes" rows="7">{{ isset($product->note)?$product->note:'' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <button class="AddBox btn btn-primary" id="AddBox" > Add Box</button>
        <div class="row">
            <div class="col-md-12">
                <div class="card variantCard" id="variantProductBox">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" id="copyAppBtn" class="form-check-input primaryBox" value="0">Do you want to copy all values from First Variation Box to All Other Variation Box?</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-group col-md-12">
                            <div class="row variation-box" id="variant-data">

                                <?php  $VariantCnt=1; ?>
                                @foreach($product->product_variant as $product_variant)
                                    <?php if ($VariantCnt==1){
                                        $primaryclass = 'primaryBox';
                                    }else{
                                        $primaryclass = '';
                                    } 
                                    
                                    $attr_array = explode(',',$product->attr_term_ids);
                                    
                                    
                                    ?>
                                    <?php $term = \App\Models\AttributeTerm::find($product_variant['term_item_id']); ?>
                                <div id ="" class="single-variation-box col-lg-6 col-md-6 col-sm-12 col-xs-12 panel panel-default" data-term="{{ $term->attrterm_name }}">
                                    <div class="variation-selection-box row panel-heading active">
                                        <div class="col-lg-10 col-sm-8">
                                            <label class="col-form-label"><b><span class="VariantCnt"></span></b></label>
                                        </div>
                                        <div class="col-lg-2 col-sm-2 actionbox ml-auto text-right"><a role="button" class="collapse-arrow variantbox-collapse d-inline-block pr-4" data-toggle="collapse" href="#" aria-expanded="true" onclick="collapsePanel(this)"></a>
                                        <?php if ($VariantCnt!=1){
                                        echo '<span data-id="'.$attr_array[$VariantCnt - 1].'" class="close-icon RemoveBox"><i class="fa fa-window-close" aria-hidden="true"></i></span>';
                                        }
                                        ?>
                                       
                                        <div id=""></div></div>
                                    </div>
                                    <div id="" role="tabpanel" class="panel-collapse collapse show variation-product-box">
                                        <form method="post" enctype="multipart/form-data" class="variantForm" id="variantForm">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="term_id" value="{{ $product_variant['term_item_id'] }}">
                                            <!-- <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <label class="col-lg-12 col-form-label" for="varProductName">Variant Product Title <span class="text-danger">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control input-default varProductName priProductNames {{ $primaryclass }}" id="" name="varProductName" value="{{ $product_variant['product_title'] }}" >
                                                            <label id="varProductName-error" class="error invalid-feedback animated fadeInDown" for="varProductName"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->

                                            <?php $required_vari_data = get_required_variations(isset($product->primary_category_id) ? $product->primary_category_id : ''); ?>
                                            @if(isset($required_vari_data['required_variations']) && !empty($required_vari_data['required_variations']))
                                            <div class="row">
                                                <input type="hidden" name="varVariation" value="{{ implode(",",$required_vari_data['required_variation_ids']) }}">
                                                <label class="col-lg-12 text-muted mt-3 mb-0">Variation (Required)</label>
                                                @foreach($required_vari_data['required_variations'] as $required_variation)
                                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group row">
                                                        <label class="col-lg-12 col-form-label" for="VariationAttr">{{ $required_variation['attribute_name'] }} <span class="text-danger">*</span></label>
                                                        <div class="col-lg-12">
                                                            <select class="form-control Variation {{ $primaryclass }}" id="" name="Variation{{ $required_variation['id'] }}">
                                                                <option></option>
                                                                @foreach($required_variation['attributeterm'] as $term)
                                                                    <?php $variant_term = \App\Models\ProductVariantVariant::where('product_variant_id',$product_variant['id'])->where('attribute_term_id',$term['id'])->first(); ?>
                                                                    <option value="{{ $term['id'] }}" @if(isset($variant_term) && !empty($variant_term)) selected @endif >{{ $term['attrterm_name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <label id="Variation{{ $required_variation['id'] }}-error" class="error invalid-feedback animated fadeInDown" for=""></label>
                                                </div>
                                                @endforeach
                                            </div>
                                            @endif

                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <label>Variant Product Image <span class="text-danger">*</span></label>
                                                    <input type="file" name="files[]" id="varImgFiles-{{ $product_variant['term_item_id'] }}" multiple="multiple">
                                                    <input type="hidden" name="varImage" id="varImage-{{ $product_variant['term_item_id'] }}" class="varImg" value="{{ $product_variant['images'] }}">
                                                    <label id="varImage-error" class="error invalid-feedback animated fadeInDown" for="varImage" style="display: none;"></label>

                                                    <?php
                                                    $script_html = '<script type="text/javascript">
                                                        var ImageUrl = $("#web_url").val() + "/admin/";
                                                        jQuery(document).ready(function() {
                                                            jQuery("#varImgFiles-'.$product_variant['term_item_id'].'").filer({
                                                                limit: 8,
                                                                maxSize: null,
                                                                fileMaxSize: 5,
                                                                extensions: ["jpg", "jpeg", "png"],
                                                                changeInput: \'<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Drag&Drop files here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue">Browse Files</a></div></div>\',
                                                                showThumbs: true,
                                                                theme: "dragdropbox",
                                                                templates: {
                                                                    box: \'<ul class="jFiler-items-list jFiler-items-grid"></ul>\',
                                                                    item: \'<li class="jFiler-item">\
                                                                                <div class="jFiler-item-container">\
                                                                                    <div class="jFiler-item-inner">\
                                                                                        <div class="jFiler-item-thumb">\
                                                                                            <div class="jFiler-item-status"></div>\
                                                                                            {{fi-image}}\
                                                                                        </div>\
                                                                                    <div class="jFiler-item-assets jFiler-row">\
                                                                                        <ul class="list-inline pull-left">\
                                                                                            <li>{{fi-progressBar}}</li>\
                                                                                        </ul>\
                                                                                        <ul class="list-inline pull-right">\
                                                                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                                                                        </ul>\
                                                                                    </div>\
                                                                                </div>\
                                                                        </div>\
                                                                        </li>\',
                                                                    itemAppend: \'<li class="jFiler-item">\
                                                                        <div class="jFiler-item-container">\
                                                                            <div class="jFiler-item-inner">\
                                                                                <div class="jFiler-item-thumb">\
                                                                                    <div class="jFiler-item-status"></div>\
                                                                                    {{fi-image}}\
                                                                                </div>\
                                                                                <div class="jFiler-item-assets jFiler-row">\
                                                                                    <ul class="list-inline pull-left">\
                                                                                        <li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
                                                                                    </ul>\
                                                                                    <ul class="list-inline pull-right">\
                                                                                        <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                                                                    </ul>\
                                                                                </div>\
                                                                            </div>\
                                                                        </div>\
                                                                    </li>\',
                                                                    progressBar: \'<div class="bar"></div>\',
                                                                    itemAppendToEnd: true,
                                                                    canvasImage: true,
                                                                    removeConfirmation: true,
                                                                    _selectors: {
                                                                        list: \'.jFiler-items-list\',
                                                                        item: \'.jFiler-item\',
                                                                        progressBar: \'.bar\',
                                                                        remove: \'.jFiler-item-trash-action\'
                                                                    }
                                                                },
                                                                dragDrop: {
                                                                    dragEnter: null,
                                                                    dragLeave: null,
                                                                    drop: null,
                                                                    dragContainer: null,
                                                                },
                                                                appendTo: "#newUploadedDiv-'.$product_variant['term_item_id'].'",
                                                                uploadFile: {
                                                                    url: ImageUrl + "variant/uploadfile?action=uploadProductImages",
                                                                    data: { \'_token\': jQuery(\'meta[name="csrf-token"]\').attr(\'content\') },
                                                                    type: \'POST\',
                                                                    enctype: \'multipart/form-data\',
                                                                    synchron: true,
                                                                    beforeSend: function () {
                                                                    },
                                                                    success: function (res, itemEl, listEl, boxEl, newInputEl, inputEl, id) {
                                                                            var parent = itemEl.find(".jFiler-jProgressBar").parent(),
                                                                            new_file_name = res.data,
                                                                            filerKit = inputEl.prop("jFiler");
                                                                            var varImgName = jQuery("#varImage-'.$product_variant['term_item_id'].'").val();
                                                                            if (varImgName == "") {
                                                                            jQuery("#varImage-'.$product_variant['term_item_id'].'").val(new_file_name);
                                                                            } else {
                                                                            jQuery("#varImage-'.$product_variant['term_item_id'].'").val(varImgName + "," + new_file_name);
                                                                            }
                                                                            filerKit.files_list[id].name = new_file_name;

                                                                            itemEl.find(".jFiler-jProgressBar").fadeOut("slow", function(){
                                                                                jQuery("<div class=\'jFiler-item-others text-success\'><i class=\'icon-jfi-check-circle\'></i> Success</div>").hide().appendTo(parent).fadeIn("slow");
                                                                            });
                                                                            jQuery("#varImage'.$product_variant['term_item_id'].'-error").html("");
                                                                            jQuery("#varImage'.$product_variant['term_item_id'].'-error").hide();
                                                                    },
                                                                    error: function (el) {
                                                                        var parent = el.find(".jFiler-jProgressBar").parent();
                                                                        el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
                                                                            jQuery("<div class=\'jFiler-item-others text-error\'><i class=\'icon-jfi-minus-circle\'></i> Error</div>").hide().appendTo(parent).fadeIn("slow");
                                                                        });
                                                                    },
                                                                    statusCode: null,
                                                                    onProgress: null,
                                                                    onComplete: null
                                                                },
                                                                files: null,
                                                                addMore: false,
                                                                allowDuplicates: true,
                                                                clipBoardPaste: true,
                                                                excludeName: null,
                                                                beforeRender: null,
                                                                afterRender: null,
                                                                beforeShow: null,
                                                                beforeSelect: null,
                                                                onSelect: null,
                                                                afterShow: null,
                                                                onRemove: function (itemEl, file, id, listEl, boxEl, newInputEl, inputEl) {
                                                                    var filerKit = inputEl.prop("jFiler"),
                                                                    file_name = filerKit.files_list[id].name;

                                                                    jQuery.post(ImageUrl+\'variant/removefile?action=removeProductImages\', {\'_token\': $(\'meta[name="csrf-token"]\').attr(\'content\'),file: file_name});
                                                                    var varImgName = jQuery("#varImage-'.$product_variant['term_item_id'].'").val();
                                                                    var varImgValues = varImgName.split(",");
                                                                    var newVarImgvalues="";
                                                                    for(var i = 0 ; i < varImgValues.length ; i++) {
                                                                        if(varImgValues[i] == file_name) {
                                                                            varImgValues.splice(i, 1);
                                                                            newVarImgvalues = varImgValues.join(",");
                                                                        }
                                                                    }
                                                                    jQuery("#varImage-'.$product_variant['term_item_id'].'").val(newVarImgvalues);
                                                                },
                                                            onEmpty: null,
                                                            options: null,
                                                            dialogs: {
                                                                alert: function (text) {
                                                                    return alert(text);
                                                                },
                                                                confirm: function (text, callback) {
                                                                    confirm(text) ? callback() : null;
                                                                }
                                                            },
                                                            captions: {
                                                                button: "Choose Files",
                                                                feedback: "Choose files To Upload",
                                                                feedback2: "files were chosen",
                                                                drop: "Drop file here to Upload",
                                                                removeConfirmation: "Are you sure you want to remove this file?",
                                                                errors: {
                                                                    filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
                                                                    filesType: "Only Images are allowed to be uploaded.",
                                                                    filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-fileMaxSize}} MB.",
                                                                    filesSizeAll: "Files you\'ve choosed are too large! Please upload files up to {{fi-maxSize}} MB."
                                                                }
                                                            }
                                                        });
                                                        });
                                                        </script>';
                                                    ?>
                                                    {!! $script_html !!}
                                                </div>
                                                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                                                    <label for="varUploadedImgBox">Thumbnail Display</label>
                                                    <div id="varUploadedImgBox-{{ $product_variant['term_item_id'] }}" class="varUploadedImgBox">
                                                        <div class="jFiler-items jFiler-row oldImgDisplayBox">
                                                            <ul class="jFiler-items-list jFiler-items-grid">
                                                                <?php $variant_images = explode(",",$product_variant['images']); $vcnt = 0; ?>
                                                                @foreach($variant_images as $v_img)
                                                                        <li id="oldVarImgBox{{ $product_variant['term_item_id'] }}-{{ $vcnt }}" class="jFiler-item" data-jfiler-index="1" style="">
                                                                            <div class="jFiler-item-container">
                                                                                <div class="jFiler-item-inner">
                                                                                    <div class="jFiler-item-thumb">
                                                                                        <div class="jFiler-item-status"></div>
                                                                                        <div class="jFiler-item-thumb-image"><img src="{{ url($v_img) }}" draggable="false"></div>
                                                                                    </div>
                                                                                    <div class="jFiler-item-assets jFiler-row">
                                                                                        <ul class="list-inline pull-right">
                                                                                            <li><a class="icon-jfi-trash jFiler-item-trash-action" onclick="removeuploadedimg('oldVarImgBox{{ $product_variant['term_item_id'] }}-{{ $vcnt }}', 'varImage-{{ $product_variant['term_item_id'] }}','{{ $v_img }}');"></a></li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                <?php $vcnt++; ?>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        <div id="newUploadedDiv-{{ $product_variant['term_item_id'] }}"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                    <div class="form-group row">
                                                        <label class="col-lg-12 col-form-label" for="varRegularPrice">Regular Price</label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control input-default varRegularPrice priRegPrice {{ $primaryclass }}" id="" name="varRegularPrice" value="{{ isset($product_variant['regular_price']) ? $product_variant['regular_price'] : '' }}">
                                                            <label id="varRegularPrice-error" class="error invalid-feedback animated fadeInDown" for="varRegularPrice"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                    <div class="form-group row">
                                                        <label class="col-lg-12 col-form-label" for="varSalePrice">Sale Price <span class="text-danger">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control input-default varSalePrice priSalePrice {{ $primaryclass }}" id="" name="varSalePrice" value="{{ $product_variant['sale_price'] }}">
                                                            <label id="varSalePrice-error" class="error invalid-feedback animated fadeInDown" for="varSalePrice"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                    <div class="form-group row">
                                                        <label class="col-lg-12 col-form-label" for="stock">Stock <span class="text-danger">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="number" class="form-control input-default stock" id="stock" name="stock" value="{{ $product_variant['stock'] }}">
                                                            <label id="stock-error" class="error invalid-feedback animated fadeInDown" for="stock"></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                    <div class="form-group row">
                                                        <label class="col-lg-12 col-form-label" for="SKU">SKU <span class="text-danger">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control input-default SKU " readonly id="SKU" name="SKU" value="{{ $product_variant['SKU'] }}">
                                                            <label id="SKU-error" class="error invalid-feedback animated fadeInDown" for="SKU"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <?php $required_spec_data = get_required_specifications(isset($product->primary_category_id) ? $product->primary_category_id : ''); ?>
                                            @if(isset($required_spec_data['required_specifications']) && !empty($required_spec_data['required_specifications']))
                                            <div class="row">
                                                <input type="hidden" name="varSpecRequired" value="{{ implode(",",$required_spec_data['required_specification_ids']) }}">
                                                <label class="col-lg-12 text-muted mt-3 mb-0">Specification (Required)</label>
                                                @foreach($required_spec_data['required_specifications'] as $required_specification)
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group row">
                                                        <label class="col-lg-12 col-form-label" for="specReqAttr">{{ $required_specification['attribute_name'] }} <span class="text-danger">*</span></label>
                                                        <div class="col-lg-12">
                                                            <select class="form-control specReq {{ $primaryclass }}" id="" name="specReq{{ $required_specification['id'] }}[]" multiple="multiple">
                                                               
                                                                @foreach($required_specification['attributeterm'] as $term)
                                                                    <?php $variant_term = \App\Models\ProductVariantSpecification::where('product_variant_id',$product_variant['id'])->whereRaw('FIND_IN_SET("'.$term['id'].'",attribute_term_id)')->where('type',1)->first(); ?>
                                                                    <option value="{{ $term['id'] }}" @if(isset($variant_term) && !empty($variant_term)) selected @endif >{{ $term['attrterm_name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <label id="specReq{{ $required_specification['id'] }}-error" class="error invalid-feedback animated fadeInDown" for=""></label>
                                                </div>
                                                @endforeach
                                            </div>
                                            @endif

                                            <?php $optional_spec_data = get_optional_specifications(isset($product->primary_category_id) ? $product->primary_category_id : ''); ?>
                                            @if(isset($optional_spec_data) && !empty($optional_spec_data))
                                            <div class="row">
                                                <?php $optional_spec_ids = array();
                                                foreach($product_variant['product_variant_specification'] as $v_spec){
                                                    if ($v_spec['type']==0){
                                                        array_push($optional_spec_ids,$v_spec['attribute_id']);
                                                    }
                                                } ?>
                                                <input type="hidden" name="varSpecOptional" value="{{ implode(",",$optional_spec_ids) }}">
                                                <label class="col-lg-12 text-muted mt-3 mb-0">Specification (Optional)</label>
                                                @foreach($optional_spec_data as $optional_specification)
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group row">
                                                        <label class="col-lg-12 col-form-label" for="specOptAttr">{{ $optional_specification['attribute_name'] }}</label>
                                                        <div class="col-lg-12">
                                                            <select class="form-control specOpt {{ $primaryclass }}" data-id="{{ $optional_specification['id'] }}" name="specOpt{{ $optional_specification['id'] }}[]"  multiple="multiple">
                                                                
                                                                @foreach($optional_specification['attributeterm'] as $term)
                                                                    <?php $variant_term = \App\Models\ProductVariantSpecification::where('product_variant_id',$product_variant['id'])->whereRaw('FIND_IN_SET("'.$term['id'].'",attribute_term_id)')->where('type',0)->first(); ?>
                                                                    <option value="{{ $term['id'] }}" @if(isset($variant_term) && !empty($variant_term)) selected @endif >{{ $term['attrterm_name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <label id="specOpt{{ $optional_specification['id'] }}-error" class="error invalid-feedback animated fadeInDown" for=""></label>
                                                </div>
                                                @endforeach
                                            </div>
                                            @endif

                                        </form>
                                    </div>
                                </div>
                                <?php $VariantCnt++; ?>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="saveBtn-box">
            <div class="col-md-12">
                <div class="card" id="">
                    <div class="card-body newcard-body row">
                        <div class="col-lg-6 col-sm-6">
                            <button type="button" id="SubmitProductBtn" name="SubmitProductBtn" class="btn btn-primary mr-2">Submit Product <i class="fa fa-circle-o-notch fa-spin submitloader" style="display:none;"></i></button>
{{--                            <button type="button" id="saveDraftBtn" name="saveDraftBtn" class="btn btn-outline-primary">Save As Draft <i class="fa fa-circle-o-notch fa-spin draftloader" style="display:none;"></i></button>--}}
                        </div>
                        <div class="col-lg-6 col-sm-6 text-right">
{{--                            <button type="button" id="discardBtn" name="discardBtn" class="btn btn-outline-primary" onclick="discardCatalog()">Discard <i class="fa fa-circle-o-notch fa-spin discardLoader" style="display:none;"></i></button>--}}
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div id="form-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')
    @include('admin.products.product_js')
@endsection

