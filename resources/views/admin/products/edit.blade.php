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
                <div class="col-lg-9 col-md-12">
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
                            <input type="hidden" id="attr_ids" name="attr_ids" value="{{ $product->attr_ids }}">
                            
                            <input type="hidden" id="product_u_id" name="product_u_id" value="{{ $product->product_u_id }}">
                            <?php  
                             $term_no_array = explode(',',$product->attr_term_ids);
                             $term_no=end($term_no_array);

                             $attributes_no_array = explode(',',$product->attr_ids);
                             $attributes_no=end($attributes_no_array);
                            ?>
                            <input type="hidden" id="term_no" name="term_no" value="{{ $term_no }}">
                            <input type="hidden" id="attributes_no" name="attributes_no" value="{{ $attributes_no }}">
                            <div class="product-section">
                                <div class="col-sm-12">
                                    <!-- <div class="form-group row">
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
                                    </div> -->
                                    
                                    
                                    @if(isset($catArray) && !empty($catArray))
                                    <div class="form-group category" >
                                        <label class="col-form-label" for="category_id"> Category <span class="text-danger">*</span>
                                        </label>
                                        <select id='category_id'   name="category_id[]"  class="form-control catMulti" id=""  multiple>
                                            <option></option>
                                            @php 
                                              $categories =  explode(',',$product->primary_category_id); 
                                            @endphp
                                            
                                            @foreach($catArray as $cat)
                                                <option value="<?php echo $cat['id']; ?>" @if(in_array($cat['id'],$categories)) selected @endif><?php echo $cat['category_name']; ?></option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif

                                    <div class="form-group row">
                                    <label class="col-lg-12 col-form-label" for="DesignNumber">Design Number <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control input-default DesignNumber" id="DesignNumber" name="DesignNumber" value="{{ isset($product->design_number)?$product->design_number:'' }}" >
                                        <label id="DesignNumber-error" class="error invalid-feedback animated fadeInDown" for="DesignNumber"></label>
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

                                    <div class="row" style="display:none;">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-check">
                                                        <label class="form-check-label">
                                                        <input type="checkbox" name="is_custom" id="is_custom" @if(isset($product) && ($product->is_custom == 1) ) checked @endif class="form-check-input primaryBox" value="{{ isset($product)?($product->is_custom):0 }}">Do you want to add custom product?</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    </form>

                            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Note</h4>
                            <textarea class="form-control input-default" name="notes" id="notes" rows="16">{{ isset($product->note)?$product->note:'' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            
                                    <div class="row" >
                                        <div class="col-md-12">
                                            <div class="form-group attribute" >
                                                <label class="col-form-label d-block" for="attribute_id"> Select Attribute <span class="text-danger">*</span>
                                                </label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <select id='attribute_id' name="attribute_id"  class="form-control attribute_id" id="" >
                                                                <option></option>
                                                                @foreach($product->product_attributes as $product_attribute)
                                                                <?php
                                                                   $attribute_check[] = $product_attribute['attribute_id'];

                                                                ?>
                                                                @endforeach
                                                                
                                                                @foreach($attributes as $attr)
                                                                    <option data-title="<?php echo $attr['attribute_name']; ?>" value="{{ $attr['id'] }}" @if(isset($product->product_attributes) && in_array($attr['id'],$attribute_check)) disabled @endif>{{ $attr['attribute_name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="button" class="AddSub btn  d-inline-block mb-3" data-id="1" style="background-color: #e7e7e7; color: black;" id="AddSub" style="display: none"> Add </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-group col-md-12">
                                        <div class="row add-value-sub" id="attribute-data">

                                        <?php  $VariantCnt=1; ?>
                                            @foreach($product->product_attributes as $product_attribute)
                                                <?php 
                                                if ($VariantCnt==1){
                                                    $primaryclass = 'primaryBox';
                                                }else{
                                                    $primaryclass = '';
                                                } 
                                                ////dd($product);
                                                $attr_array = explode(',',$product->attr_ids);
                                                //print_r($attr_array); die;
                                                $attribute = \App\Models\Attribute::find($product_attribute['attribute_id']);
                                            
                                                ?>
                                              
                                                <div id ="" class="single-variation-box col-lg-6 col-md-12  col-xs-12 panel panel-default active" data-term="{{ $attribute->attr_name }}">
                                                <div class="variation-selection-box row panel-heading active">
                                                    <div class="col-lg-10 col-sm-8">
                                                        <label class="col-form-label"><b><span class="VariantCnt">{{ $attribute['attribute_name'] }} </span></b></label>
                                                    </div>
                                                    <div class="col-lg-2 col-sm-2 actionbox ml-auto text-right"><a role="button" class="collapse-arrow variantbox-collapse d-inline-block pr-4" data-toggle="collapse" href="#" aria-expanded="true" onclick="collapsePanel(this)"></a>
                                                   
                                                    
                                                    <?php if ($VariantCnt!=1){
                                                       // echo '<span data-id="'.$attr_array[$VariantCnt - 1].'" class="close-icon RemoveBox"><i class="fa fa-window-close" aria-hidden="true"></i></span>';
                                                    }
                                                    ?>
                                                    <div id=""></div></div>
                                                </div>
                                                <div id="" role="tabpanel" class="panel-collapse collapse show attribute-product-box">
                                                    <form method="post" enctype="multipart/form-data"  class="attributeForm" id="attributeForm">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="attribute_id" value="{{ $attribute['id'] }}">
                                                            
                                        
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="form-group row">
                                                                    <label class="col-lg-12 col-form-label" for="">{{ $attribute['attribute_name'] }} <span class="text-danger">*</span></label>
                                                                    <div class="col-lg-12">
                                                                        <select class="form-control Attribute" id="" id-data="Attribute'.$required_variation['id'].'" name="Attribute{{ $attribute['id'] }}[]" multiple>
                                                                         
                                                
                                                                            @php
                                                                               $terms = \App\Models\AttributeTerm::where('attribute_id',$attribute['id'])->orderBy('sorting','asc')->get()->toArray(); 
                                                                               $selectterms =  explode(',',$product_attribute['terms_id']); 
                                                                            @endphp
                                                                            @foreach($terms as $term)
                                                                                <option value="{{ $term['id'] }}" @if(in_array($term['id'],$selectterms)) selected @endif >{{ $term['attrterm_name'] }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <label id="Attribute{{ $attribute['id'] }}-error" class="error invalid-feedback animated fadeInDown" for=""></label>
                                                            </div>
                                                          
                                                            <div class="form-group row ">
                                                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="form-check">
                                                                    <input type="checkbox" id="" class="allattribute" > 
                                                                    <label class="form-check-label">
                                                                        Select All</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="form-check">
                                                                    <input type="checkbox" class="avoid-clicks" style="pointer-events: none;" name="attribute_variation{{ $attribute['id'] }}" @if(isset($product_attribute) && ($product_attribute->use_variation == 1) ) checked @endif "> 
                                                                    <label class="form-check-label">
                                                                    Use for Variations ?</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="check avoid-clicks" style="pointer-events: none;" name="use_comman{{ $attribute['id'] }}" @if(isset($product_attribute) && ($product_attribute->use_comman == 1) ) checked @endif> 
                                                                        <label class="form-check-label"> Use for Common Variation ?</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                
                                                            
                                                    </form>
                                                </div>
                                            </div>
                                            <?php $VariantCnt++; ?>
                                            @endforeach
                                        </div>
                                    </div>
                                    <button type="button" class="save_attributes btn mt-3"  style="background-color: #e7e7e7; color: black;" id="save_attributes" >Save attributes</button>


                                </div>
                            </div>
                        </div>
                    </div>
               
        
        <!-- <button class="AddBox btn btn-primary" id="AddBox" > Add Box</button> -->
        <div class="row">
            <div class="col-md-12">
                <div class="card variantCard" id="variantProductBox">
                    <div class="card-body">
                        <!-- <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" id="copyAppBtn" class="form-check-input primaryBox" value="0">Do you want to copy all values from First Variation Box to All Other Variation Box?</label>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <div class="panel-group col-md-12">
                            <div class="row variation-box" id="variant-data">

                                <?php  $VariantCnt=1; 
                                 $ProductAttribute = \App\Models\ProductAttribute::where('product_u_id',$product->product_u_id)->where('use_comman',1)->first();
                                 
                                 $attr_term_ids = explode(',',$ProductAttribute->terms_id);
                                 $term_item_id = 1;
                                ?>
                                @foreach($attr_term_ids as $product_variant)
                                  
                                    <?php if ($VariantCnt==1){
                                        $primaryclass = 'primaryBox';
                                    }else{
                                        $primaryclass = '';
                                    } 
                                    
                                    $attr_array = explode(',',$product->attr_term_ids);
                                    
                                   
                                    ?>
                                    <?php $term = \App\Models\AttributeTerm::find($product_variant); ?>
                                    <div id ="" class="single-variation-box col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12 panel panel-default" data-term="{{ $term->attrterm_name }}">
                                    <div class="variation-selection-box row panel-heading active">
                                        <div class="col-lg-10 col-sm-8">
                                            <label class="col-form-label"><b><span class="VariantCnt">{{ $term->attrterm_name }}</span></b></label>
                                        </div>
                                        <div class="col-lg-2 col-sm-2 actionbox ml-auto text-right"><a role="button" class="collapse-arrow variantbox-collapse d-inline-block pr-4" data-toggle="collapse" href="#" aria-expanded="true" onclick="collapsePanel(this)"></a>
                                        <?php if ($VariantCnt!=1){
                                       // echo '<span data-id="'.$attr_array[$VariantCnt - 1].'" class="close-icon RemoveBox"><i class="fa fa-window-close" aria-hidden="true"></i></span>';
                                        }
                                        ?>
                                       
                                        <div id=""></div></div>
                                    </div>
                                    <div id="" role="tabpanel" class="panel-collapse collapse show variation-product-box">
                                        <form method="post" enctype="multipart/form-data" class="variantForm" id="variantForm">
                                            {{ csrf_field() }}
                                            <input type="text" name="term_id" value="{{ $term_item_id }}">
                                            

                                            <?php $required_vari_data = get_required_variations_attribute(isset($product->product_u_id) ? $product->product_u_id : ''); ?>
                                            @if(isset($required_vari_data['required_variations']) && !empty($required_vari_data['required_variations']))
                                            <div class="row VariationSelect">
                                                 <input type="hidden" name="comman_id" value="{{ $product_variant }}">
                                                <input type="hidden" name="varVariation" value="{{ implode(",",$required_vari_data['required_variation_ids']) }}">
                                                <label class="col-lg-12 text-muted mt-3 mb-0">Variation (Required)</label>
                                                @foreach($required_vari_data['required_variations'] as $required_variation)
                                                <div class="col-lg-4 col-md-12 col-sm-6 col-xs-12">
                                                    <div class="form-group row">
                                                        <label class="col-lg-12 col-form-label" for="VariationAttr">{{ $required_variation['attribute_name'] }} <span class="text-danger">*</span></label>
                                                        <div class="col-lg-12">
                                                            <select class="form-control Variation {{ $primaryclass }}" id="" id-data="Variation{{ $required_variation['id'] }}" name="Variation{{ $required_variation['id'] }}[]" multiple>
                                                                <option></option>
                                                                @foreach($required_variation['attributeterm'] as $term)
                                                                    <?php 
                                                                       $variant_terms = \App\Models\ProductVariantVariant::where('product_id',$product->id)->where('attribute_term_id',$product_variant)->get()->pluck('product_variant_id');
                                                                      
                                                                       $variant_term = \App\Models\ProductVariantVariant::WhereIn('product_variant_id',$variant_terms)->get()->pluck('attribute_term_id')->toArray(); 
                                                                    ?>
                                                                    <option value="{{ $term['id'] }}" @if(isset($variant_term) && in_array($term['id'], $variant_term) ) selected @endif >{{ $term['attrterm_name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <label id="Variation{{ $required_variation['id'] }}-error" class="error invalid-feedback animated fadeInDown" for=""></label>
                                                </div>
                                                @endforeach
                                                
                                            </div>
                                            <button type="button" class="AddSubSub btn  d-inline-block mb-3" style="background-color: #e7e7e7; color: black;" id="AddSubSubEdit" style="display: none"> Add </button>
                                            @endif
                                            <?php 
                                                  $variant_term_id = \App\Models\ProductVariantVariant::where('product_id',$product->id)->where('attribute_term_id',$product_variant)->get()->pluck('product_variant_id'); 
                                                  //dd($variant_term_id[0]); 
                                                 if(isset($variant_term_id[0])){ 
                                                  $variant_image = \App\Models\ProductVariant::Where('id',$variant_term_id[0])->first()->toArray();
                                                 }else{
                                                    $variant_image = []; 
                                                 }
                                                ?>   
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                                        <label>Variant Product Image <span class="text-danger">*</span></label>
                                                        <input type="file" name="files[]" id="varImgFiles-{{ $term_item_id }}" multiple="multiple">
                                                        <input type="hidden" name="varImage" id="varImage-{{ $term_item_id }}" class="varImg" value="{{ isset($variant_image['images']) ? $variant_image['images'] : '' }}">
                                                        <label id="varImage-error" class="error invalid-feedback animated fadeInDown" for="varImage" style="display: none;"></label>

                                                        <?php
                                                        $script_html = '<script type="text/javascript">
                                                            var ImageUrl = $("#web_url").val() + "/admin/";
                                                            jQuery(document).ready(function() {
                                                                jQuery("#varImgFiles-'.$term_item_id.'").filer({
                                                                    limit: 8,
                                                                    maxSize: null,
                                                                    fileMaxSize: 50,
                                                                    extensions: ["jpg", "jpeg", "png" , "mp4" , "mov" , "gif" , "3gp"],
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
                                                                                            <input type="text" name="alt_text[]" class="mt-1" style="width: 108px;font-size: 12px;">\
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
                                                                                    <input type="text" name="alt_text[]" class="mt-1" style="width: 108px;font-size: 12px;">\
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
                                                                    appendTo: "#newUploadedDiv-'.$term_item_id.'",
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
                                                                                var varImgName = jQuery("#varImage-'.$term_item_id.'").val();
                                                                                if (varImgName == "") {
                                                                                jQuery("#varImage-'.$term_item_id.'").val(new_file_name);
                                                                                } else {
                                                                                jQuery("#varImage-'.$term_item_id.'").val(varImgName + "," + new_file_name);
                                                                                }
                                                                                filerKit.files_list[id].name = new_file_name;

                                                                                itemEl.find(".jFiler-jProgressBar").fadeOut("slow", function(){
                                                                                    jQuery("<div class=\'jFiler-item-others text-success\'><i class=\'icon-jfi-check-circle\'></i> Success</div>").hide().appendTo(parent).fadeIn("slow");
                                                                                });
                                                                                jQuery("#varImage'.$term_item_id.'-error").html("");
                                                                                jQuery("#varImage'.$term_item_id.'-error").hide();
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
                                                                        var varImgName = jQuery("#varImage-'.$term_item_id.'").val();
                                                                        var varImgValues = varImgName.split(",");
                                                                        var newVarImgvalues="";
                                                                        for(var i = 0 ; i < varImgValues.length ; i++) {
                                                                            if(varImgValues[i] == file_name) {
                                                                                varImgValues.splice(i, 1);
                                                                                newVarImgvalues = varImgValues.join(",");
                                                                            }
                                                                        }
                                                                        jQuery("#varImage-'.$term_item_id.'").val(newVarImgvalues);
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
                                                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                                                        <label for="varUploadedImgBox">Thumbnail Display</label>
                                                        <div id="varUploadedImgBox-{{ $term_item_id }}" class="varUploadedImgBox">
                                                            <div class="jFiler-items jFiler-row oldImgDisplayBox">
                                                                <ul class="jFiler-items-list jFiler-items-grid">
                                                                    <?php 
                                                                    if(isset($variant_image['images'])){
                                                                    $variant_images = explode(",",$variant_image['images']); $vcnt = 0; ?>
                                                                    @foreach($variant_images as $key => $v_img)
                                                                            <?php $textarray =   explode(',',$variant_image['alt_text']); ?>
                                                                            <li id="oldVarImgBox{{ $term_item_id }}-{{ $vcnt }}" class="jFiler-item" data-jfiler-index="1" style="">
                                                                                <div class="jFiler-item-container">
                                                                                    <div class="jFiler-item-inner">
                                                                                        <div class="jFiler-item-thumb">
                                                                                            <div class="jFiler-item-status"></div>
                                                                                            <div class="jFiler-item-thumb-image">
                                                                                            <?php 
                                                                                            $supported_image = array(
                                                                                                'jpg',
                                                                                                'jpeg',
                                                                                                'png'
                                                                                            );     
                                                                                            $ext = pathinfo($v_img, PATHINFO_EXTENSION); 
                                                                                            if(in_array($ext, $supported_image)) { 
                                                                                            ?>    
                                                                                                <img src="{{ url($v_img) }}" draggable="false">
                                                                                            <?php }else{ ?>
                                                                                                <span class="jFiler-icon-file f-video"><i class="icon-jfi-file-video"></i></span>
                                                                                            <?php } ?>    

                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                        <input type="text" class="mt-2 form-control input-default" placeholder="Alter Text" name="alt_text[]" style="width: 85px;font-size: 12px; height:28px;" value="{{ isset($textarray[$key])?$textarray[$key]:"" }}" >
                                                                                        </div>
                                                                                        <div class="jFiler-item-assets jFiler-row">
                                                                                            <ul class="list-inline pull-right">
                                                                                                <li><a class="icon-jfi-trash jFiler-item-trash-action" onclick="removeuploadedimg('oldVarImgBox{{ $term_item_id }}-{{ $vcnt }}', 'varImage-{{ $term_item_id }}','{{ $v_img }}');"></a></li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                    <?php $vcnt++; ?>
                                                                    @endforeach
                                                                    <?php } ?>
                                                                </ul>
                                                            </div>
                                                            <div id="newUploadedDiv-{{ $term_item_id }}"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                             
                                            <div class="row mt-3">
                                            <?php
                                                $name_main = '';
                                               
                                                foreach($variant_term as $key => $tt){
                                                    $ProductAttribute = \App\Models\ProductAttribute::whereRaw("FIND_IN_SET($tt, terms_id)")->where('product_id',$product->id)->where('use_comman',1)->first();
                                                    if(isset($ProductAttribute->id)){
                                                        $AttributeTerm = \App\Models\AttributeTerm::where('estatus',1)->where('id',$tt)->first();
                                                        if(isset($AttributeTerm->attrterm_name)){
                                                            $name_main = $AttributeTerm->attrterm_name;
                                                        }
                                                    }
                                                }    
                                            ?>
                                                      
                                            

                                            

                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3  .d-xl-block">
                                                    <div class="form-group row font-weight-bold">
                                                        <label class="col-lg-12 col-form-label" for="">{{ $name_main }}  Variation</label>
                                    
                                                    </div>
                                                </div>

                                                

                                                
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                    <div class="form-group row">
                                                        <label class="col-lg-12 col-form-label" for="varRegularPrice">Regular Price</label>
                                    
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                    <div class="form-group row">
                                                        <label class="col-lg-12 col-form-label" for="varSalePrice">Sale Price <span class="text-danger">*</span></label>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                    <div class="form-group row">
                                                        <label class="col-lg-12 col-form-label" for="stock">Stock <span class="text-danger">*</span></label>
                                                       
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                    <div class="form-group row">
                                                        <label class="col-lg-12 col-form-label" for="SKU">SKU <span class="text-danger">*</span></label>
            
                                                    </div>
                                                </div>   
                                            <?php
                                               
                                                $variant_terms = \App\Models\ProductVariantVariant::where('product_id',$product->id)->where('attribute_term_id',$product_variant)->get()->pluck('product_variant_id');
                                                ?>
                                                <input type="hidden" name="matrix_no{{ $term_item_id }}"  value="{{ count($variant_terms) }}">
                                               <?php 
                                                 $t = 1;
                                                foreach($variant_terms as $variant_ter){
                                                   
                                                $variant_term = \App\Models\ProductVariantVariant::Where('product_variant_id',$variant_ter)->get()->pluck('attribute_term_id');
                                                
                                                $name = '';
                                                $required_variation_ids ="";
                                                foreach($variant_term as $key => $tt){
                                                    $ProductAttribute = \App\Models\ProductAttribute::whereRaw("FIND_IN_SET($tt, terms_id)")->where('product_id',$product->id)->where('use_comman',0)->first();
                                                    if(isset($ProductAttribute->id)){
                                                        $AttributeTerm = \App\Models\AttributeTerm::where('estatus',1)->where('id',$tt)->first();
                                                        if(isset($AttributeTerm->attrterm_name)){
                                                            if($name != "" ){
                                                            $name = $name.' | '.$AttributeTerm->attrterm_name;
                                                            }else{
                                                            $name = $AttributeTerm->attrterm_name;  
                                                            }
                                                        }
                                                    }
                                                ?>
                                                    <input type="hidden" name="Variation{{$term_item_id}}-{{$t}}-{{$tt}}'"  value="{{ $tt }}">
                                                 <?php  
                                                     if($required_variation_ids != "" ){
                                                        $required_variation_ids = $required_variation_ids.','.$tt;
                                                      }else{
                                                         $required_variation_ids = $tt;  
                                                      } 
                                                } 
                                                $variant = \App\Models\ProductVariant::Where('id',$variant_ter)->first()->toArray();
                                    
                                            ?>

                                            <input type="hidden" name="varVariation{{$term_item_id}}-{{$t}}" value="{{ $required_variation_ids }}">
                                            <input type="hidden" name="tmpdata[]" value="{{ $required_variation_ids }}">

                                                
                            
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                    <div class=" row">
                                                        <div class="col-lg-12 font-weight-bold">
                                                            {{ $name }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                    <div class="form-group row">
                                                        
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control input-default varRegularPrice priRegPrice " id="" placeholder="Regular Price" name="varRegularPrice-{{$term_item_id}}-{{$t}}" value="{{ isset($variant['regular_price']) ? $variant['regular_price'] : '' }}">
                                                            <label id="varRegularPrice-{{$term_item_id}}-{{$t}}-error" class="error invalid-feedback animated fadeInDown" for="varRegularPrice"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                    <div class="form-group row">
                                                        
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control input-default varSalePrice priSalePrice " placeholder="Sale Price" id="" name="varSalePrice-{{$term_item_id}}-{{$t}}" value="{{ $variant['sale_price'] }}">
                                                            <label id="varSalePrice-{{$term_item_id}}-{{$t}}-error" class="error invalid-feedback animated fadeInDown" for="varSalePrice"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                    <div class="form-group row">
                                                        
                                                        <div class="col-lg-12">
                                                            <input type="number" class="form-control input-default stock" id="stock" placeholder="Stock" name="stock-{{$term_item_id}}-{{$t}}" value="{{ $variant['stock'] }}">
                                                            <label id="stock-{{$term_item_id}}-{{$t}}-error" class="error invalid-feedback animated fadeInDown" for="stock"></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                    <div class="form-group row">
                                                       
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control input-default SKU " readonly id="SKU" placeholder="SKU" name="SKU-{{$term_item_id}}-{{$t}}" value="{{ $variant['SKU'] }}">
                                                            <label id="SKU-{{$term_item_id}}-{{$t}}-error" class="error invalid-feedback animated fadeInDown" for="SKU"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            

                                          <?php $t++; } ?>
                                          </div>
                                            
                                            

                                        </form>
                                    </div>
                                </div>
                                <?php $VariantCnt++; $term_item_id++; ?>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="product-section">
                            <div class="col-sm-12">
                                <div class="row" >
                                    <div class="col-md-6">
                                         <label class="col-form-label" for="meta_title">Meta Title </label>
                                        <input type="text" class="form-control input-default ProductName" id="meta_title" name="meta_title" value="{{ isset($product->meta_title)?$product->meta_title:'' }}" >
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label" for="Desc">Meta Description </label>
                                        <textarea type="meta_description" class="form-control input-default" id="meta_description" name="meta_description">{{ isset($product->meta_description)?$product->meta_description:'' }}</textarea>
                                    </div>
                                </div>
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
                            <button type="button" id="SubmitProductBtn" name="SubmitProductBtn" class="btn btn-primary mr-2 ">Submit Product <i class="fa fa-circle-o-notch fa-spin submitloader" style="display:none;"></i></button>
{{--                            <button type="button" id="saveDraftBtn" name="saveDraftBtn" class="btn btn-outline-primary mt-4">Save As Draft <i class="fa fa-circle-o-notch fa-spin draftloader" style="display:none;"></i></button>--}}
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

<script>       


</script> 
@endsection

