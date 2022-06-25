<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantSpecification;
use App\Models\ProductVariantVariant;
use App\Models\ProjectPage;
use App\Models\Settings;
use App\Models\Diamond;
use App\Models\DiamondVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private $page = "Product";

    public function index(){
        return view('admin.products.list')->with('page',$this->page);
    }

    public function customproducts(){
        return view('admin.products.customproductlist')->with('page',$this->page);
    }

    public function create(){
        $categories = Category::where('estatus',1)->get()->toArray();
        $catArray = array();
        foreach ($categories as $category){
            
            array_push($catArray,$category);
        }
       
        return view('admin.products.create',compact('catArray'))->with('page',$this->page);
    }

    public function getAttrVariation($id){
        $variation = Category::with('attributes','attribute_terms')->where('id',$id)->first()->toArray();
        //dd($variation);
        $html = '';
        if ( $variation['attribute_id_variation']!=null && isset($variation['attribute_terms']) && !empty($variation['attribute_terms']) ) {
            foreach ($variation['attribute_terms'] as $term) {
                $html .= '<div class="form-check mb-2"><label class="form-check-label CatVariSel"><input type="checkbox" id="termCheckbox' . $term['id'] . '" class="form-check-input TermSelCheckbox" name="TermSelCheckbox[]" data-boxid = "' . $term['id'] . '" data-category="' . $id . '" data-name="'.$term['attrterm_name'].'">' . $term['attrterm_name'] . '</label></div>';
            }
        }

        $attr_name = '';
        $attr_id = '';
        if ($variation['attribute_id_variation']!=null && $variation['attributes']!=null){
            $attr_name = $variation['attributes']['attribute_name'];
            $attr_id = $variation['attribute_id_variation'];
        }
        return ["attr_name" => $attr_name, "terms" => $html, "attr_id" => $attr_id];
    }

    public function addVariantbox($id,Request $request){
        if (isset($request->VariantCnt) && $request->VariantCnt!=''){
//            $VariantCnt = $request->VariantCnt + 1;
            $primaryclass='';
        }
        else{
//            $VariantCnt = 1;
            $primaryclass = 'primaryBox';
        }

        $term_id = $request->term_id;
        $term_name = $request->term_name;

        $category = Category::where('id',$id)->first()->toArray();

        $required_variations = array();
        $required_variation_ids = array();
        if ($category['attribute_id_variation']!=null) {
            $req_variation = explode(",", $category['attribute_id_variation']);
            foreach ($req_variation as $req) {
                $spec = Attribute::with('attributeterm')->where('id', $req)->where('is_specification', 0)->first()->toArray();
                if (isset($spec['attributeterm']) && !empty($spec['attributeterm'])) {
                    array_push($required_variations, $spec);
                    array_push($required_variation_ids, $spec['id']);
                }
            }
        }

        $html_required_variation = '';
        if (isset($required_variations) && !empty($required_variations)){
            $html_required_variation .= '<div class="row">';
            $html_required_variation .= '<input type="hidden" name="varVariation" value="'.implode(",",$required_variation_ids).'">';
            $html_required_variation .= '<label class="col-lg-12 text-muted mt-3 mb-0">Variation (Required)</label>';
            foreach ($required_variations as $required_variation){
                $html_required_variation.= '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group row">
                                                        <label class="col-lg-12 col-form-label" for="VariationAttr">';
                $html_required_variation .= $required_variation['attribute_name'];
                $html_required_variation .= ' <span class="text-danger">*</span></label>';
                $html_required_variation .= '<div class="col-lg-12">';
                $html_required_variation .= '<select class="form-control Variation" id="" name="Variation'.$required_variation['id'].'">';
                $html_required_variation .= '<option></option>';
                foreach ($required_variation['attributeterm'] as $term){
                    $html_required_variation .= '<option value="';
                    $html_required_variation .= $term['id'];
                    $html_required_variation .= '">';
                    $html_required_variation .= $term['attrterm_name'];
                    $html_required_variation .= '</option>';
                }
                $html_required_variation .= '</select>';
                $html_required_variation .= '</div>';
                $html_required_variation .= '</div>';
                $html_required_variation .= '<label id="Variation'.$required_variation['id'].'-error" class="error invalid-feedback animated fadeInDown" for=""></label>';
                $html_required_variation .= '</div>';
            }
            $html_required_variation .= '</div>';
        }

        $required_specifications = array();
        $required_specification_ids = array();
        if ($category['attribute_id_req_spec']!=null) {
            $req_spec = explode(",", $category['attribute_id_req_spec']);
            foreach ($req_spec as $req) {
                $spec = Attribute::with('attributeterm')->where('id', $req)->where('is_specification', 1)->first()->toArray();
                if (isset($spec['attributeterm']) && !empty($spec['attributeterm'])) {
                    array_push($required_specifications, $spec);
                    array_push($required_specification_ids, $spec['id']);
                }
            }
        }

        $html_required_specification = '';
        if (isset($required_specifications) && !empty($required_specifications)){
            $html_required_specification .= '<div class="row">';
            $html_required_specification .= '<input type="hidden" name="varSpecRequired" value="'.implode(",",$required_specification_ids).'">';
            $html_required_specification .= '<label class="col-lg-12 text-muted mt-3 mb-0">Specification (Required)</label>';
            foreach ($required_specifications as $required_specification){
                $html_required_specification.= '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group row">
                                                        <label class="col-lg-12 col-form-label" for="specReqAttr">';
                $html_required_specification .= $required_specification['attribute_name'];
                $html_required_specification .= ' <span class="text-danger">*</span></label>';
                $html_required_specification .= '<div class="col-lg-12">';

                if($required_specification['is_dropdown'] == 1){

                    $html_required_specification .= '<select class="form-control specReq" id="" name="specReq'.$required_specification['id'].'[]" multiple >';
                    //$html_required_specification .= '<option></option>';
                    foreach ($required_specification['attributeterm'] as $term){
                        $html_required_specification .= '<option value="';
                        $html_required_specification .= $term['id'];
                        $html_required_specification .= '">';
                        $html_required_specification .= $term['attrterm_name'];
                        $html_required_specification .= '</option>';
                    }
                    $html_required_specification .= '</select>';

                }else{

                    $html_required_specification .= '<select class="form-control specReq" id="" name="specReq'.$required_specification['id'].'[]" multiple >';
                    $html_required_specification .= '<option></option>';
                    foreach ($required_specification['attributeterm'] as $term){
                        $html_required_specification .= '<option value="';
                        $html_required_specification .= $term['id'];
                        $html_required_specification .= '">';
                        $html_required_specification .= $term['attrterm_name'];
                        $html_required_specification .= '</option>';
                    }
                    $html_required_specification .= '</select>';

                }
        
                

                $html_required_specification .= '</div>';
                $html_required_specification .= '</div>';
                $html_required_specification .= '<label id="specReq'.$required_specification['id'].'-error" class="error invalid-feedback animated fadeInDown" for=""></label>';
                $html_required_specification .= '</div>';
            }
            $html_required_specification .= '</div>';
        }

        $optional_specifications = array();
        if ($category['attribute_id_opt_spec']!=null) {
            $opt_spec = explode(",", $category['attribute_id_opt_spec']);
            foreach ($opt_spec as $opt) {
                $spec = Attribute::with('attributeterm')->where('id', $opt)->where('is_specification', 1)->first()->toArray();
                if (isset($spec['attributeterm']) && !empty($spec['attributeterm'])) {
                    array_push($optional_specifications, $spec);
                }
            }
        }

        $html_optional_specification = '';
        if (isset($optional_specifications) && !empty($optional_specifications)){
            $html_optional_specification .= '<div class="row">';
            $html_optional_specification .= '<input type="hidden" name="varSpecOptional">';
            $html_optional_specification .= '<label class="col-lg-12 text-muted mt-3 mb-0">Specification (Optional)</label>';
            foreach ($optional_specifications as $optional_specification){
                $html_optional_specification.= '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group row">
                                                        <label class="col-lg-12 col-form-label" for="specOptAttr">';
                $html_optional_specification .= $optional_specification['attribute_name'];
                $html_optional_specification .= '</label>';
                $html_optional_specification .= '<div class="col-lg-12">';
                $html_optional_specification .= '<select class="form-control specOpt" data-id="'.$optional_specification['id'].'" name="specOpt'.$optional_specification['id'].'[]" multiple>';
               // $html_optional_specification .= '<option></option>';
                foreach ($optional_specification['attributeterm'] as $term){
                    $html_optional_specification .= '<option value="';
                    $html_optional_specification .= $term['id'];
                    $html_optional_specification .= '">';
                    $html_optional_specification .= $term['attrterm_name'];
                    $html_optional_specification .= '</option>';
                }
                $html_optional_specification .= '</select>';
                $html_optional_specification .= '</div>';
                $html_optional_specification .= '</div>';
                $html_optional_specification .= '<label id="specOpt'.$optional_specification['id'].'-error" class="error invalid-feedback animated fadeInDown" for=""></label>';
                $html_optional_specification .= '</div>';
            }
            $html_optional_specification .= '</div>';
        }

        $html = '';
        $html .= '<div id ="" class="single-variation-box col-lg-6 col-md-6 col-sm-12 col-xs-12 panel panel-default" data-term="'.$term_name.'">';
        $html .= '<div class="variation-selection-box row panel-heading active hfsufdss o">';
        $html .= '<div class="col-lg-10 col-sm-8">';
        $html .= '<label class="col-form-label">';
        $html .= '<b><span class="VariantCnt">';
        //$html .= $term_name;
        $html .= '</span></b>';
        $html .= '</label>';
        $html .= '</div>';
        $html .= '<div class="col-lg-2 col-sm-2 actionbox ml-auto text-right d-flex align-items-center justify-content-end"><a role="button" class="collapse-arrow variantbox-collapse d-inline-block pr-4" data-toggle="collapse" href="#" aria-expanded="true" onclick="collapsePanel(this)"></a>';
        if($term_id != 1){
           $html .='<span data-id="'.$term_id.'" class="close-icon RemoveBox"><i class="fa fa-window-close" aria-hidden="true"></i></span>';
        }
        $html .='<div id=""></div></div>';
        $html .= '</div>';
        $html .= '';
        $html .= '<div id="" role="tabpanel" class="panel-collapse collapse show variation-product-box">';
        $html .= '<form method="post" enctype="multipart/form-data" class="variantForm" id="variantForm">';
        $html .= csrf_field();
        $html .= '<input type="hidden" name="term_id" value="'.$term_id.'">';
        $html .= $html_required_variation;
        // $html .= '<div class="row">
        //                     <div class="col-lg-12">
        //                         <div class="form-group row">
        //                             <label class="col-lg-12 col-form-label" for="varProductName">Variant Product Title <span class="text-danger">*</span></label>
        //                             <div class="col-lg-12">
        //                                 <input type="text" class="form-control input-default varProductName priProductNames" id="" name="varProductName" value="" >
        //                                 <label id="varProductName-error" class="error invalid-feedback animated fadeInDown" for="varProductName"></label>
        //                             </div>
        //                         </div>
        //                     </div>
        //                 </div>';
        $html .= '<div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <label>Variant Product Image <span class="text-danger">*</span></label>
                                <input type="file" name="files[]" id="varImgFiles-'.$term_id.'" multiple="multiple">
                                <input type="hidden" name="varImage" id="varImage-'.$term_id.'" class="varImg" value="">
                                <label id="varImage-error" class="error invalid-feedback animated fadeInDown" for="varImage" style="display: none;"></label>
                                <script type="text/javascript">
                                    var ImageUrl = $("#web_url").val() + "/admin/";
                                    jQuery(document).ready(function() {
                                        jQuery("#varImgFiles-'.$term_id.'").filer({
                                            limit: 8,
                                            maxSize: null,
                                            fileMaxSize: 5,
                                            extensions: ["jpg", "jpeg", "png"],
                                            changeInput: \'<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Drag&Drop files here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue">Browse Files</a></div></div>\',
                                            showThumbs: true,
                                            theme: "dragdropbox",
                                            templates: {
                                                box: \'<ul class="jFiler-items-list jFiler-items-grid"></ul>\',
                                                item:  \'<li class="jFiler-item">\
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
                                            appendTo: "#varUploadedImgBox-'.$term_id.'",
                                            uploadFile: {
                                                url: ImageUrl + "variant/uploadfile?action=uploadProductImages",
                                                data: {\'_token\': jQuery(\'meta[name="csrf-token"]\').attr(\'content\')},
                                                type: \'POST\',
                                                enctype: \'multipart/form-data\',
                                                synchron: true,
                                                beforeSend: function () {
                                                },
                                                success: function (res, itemEl, listEl, boxEl, newInputEl, inputEl, id) {
                                                    var parent = itemEl.find(".jFiler-jProgressBar").parent(),
                                                        new_file_name = res.data,
                                                        filerKit = inputEl.prop("jFiler");
                                                    var varImgName = jQuery("#varImage-'.$term_id.'").val();
                                                    if (varImgName == "") {
                                                        jQuery("#varImage-'.$term_id.'").val(new_file_name);
                                                    } else {
                                                        jQuery("#varImage-'.$term_id.'").val(varImgName + "," + new_file_name);
                                                    }
                                                    filerKit.files_list[id].name = new_file_name;
                                
                                                    itemEl.find(".jFiler-jProgressBar").fadeOut("slow", function(){
                                                        jQuery("<div class=\"jFiler-item-others text-success\"><i class=\"icon-jfi-check-circle\"></i> Success</div>").hide().appendTo(parent).fadeIn("slow");
                                                    });
                                                    jQuery("#varImage'.$term_id.'-error").html("");
                                                    jQuery("#varImage'.$term_id.'-error").hide();
                                                },
                                                error: function (el) {
                                                    var parent = el.find(".jFiler-jProgressBar").parent();
                                                    el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
                                                        jQuery("<div class=\"jFiler-item-others text-error\"><i class=\"icon-jfi-minus-circle\"></i> Error</div>").hide().appendTo(parent).fadeIn("slow");
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
                                                    var varImgName = jQuery("#varImage-'.$term_id.'").val();
                                                    var varImgValues = varImgName.split(",");
                                                    var newVarImgvalues="";
                                                    for(var i = 0 ; i < varImgValues.length ; i++) {
                                                        if(varImgValues[i] == file_name) {
                                                          varImgValues.splice(i, 1);
                                                          newVarImgvalues = varImgValues.join(",");
                                                        }
                                                    }
                                                    jQuery("#varImage-'.$term_id.'").val(newVarImgvalues);
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
                                </script>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                                <label for="varUploadedImgBox">Thumbnail Display</label>
                                <div id="varUploadedImgBox-'.$term_id.'" class="varUploadedImgBox"></div>
                            </div>
                    </div>';
                    $html .= '<div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group row">
                                    <label class="col-lg-12 col-form-label" for="varRegularPrice">Regular Price</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control input-default varRegularPrice priRegPrice" id="" name="varRegularPrice" value="">
                                        <label id="varRegularPrice-error" class="error invalid-feedback animated fadeInDown" for="varRegularPrice"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group row">
                                    <label class="col-lg-12 col-form-label" for="varSalePrice">Sale Price <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control input-default varSalePrice priSalePrice" id="" name="varSalePrice" value="">
                                        <label id="varSalePrice-error" class="error invalid-feedback animated fadeInDown" for="varSalePrice"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group row">
                                    <label class="col-lg-12 col-form-label" for="stock">Stock <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="number" class="form-control input-default stock" id="" name="stock" value="">
                                        <label id="stock-error" class="error invalid-feedback animated fadeInDown" for="stock"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group row">
                                    <label class="col-lg-12 col-form-label" for="SKU">SKU <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control input-default SKU" id="" name="SKU" value="">
                                        <label id="SKU-error" class="error invalid-feedback animated fadeInDown" for="SKU"></label>
                                    </div>
                                </div>
                            </div>
                        </div>';
        $html .= $html_required_specification;
        $html .= $html_optional_specification;
        $html .= '</form>';
        $html .= '</div>';
        $html .= '</div>';

        return ['data' => $html, 'term_id' => $term_id];
    }

    public function uploadfile(Request $request){
        if(isset($request->action) && $request->action == 'uploadProductImages'){
            if ($request->hasFile('files')) {
                $images = $request->file('files');

                foreach ($images as $image) {
                    $image_name = 'ProductImg_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('images/ProductImg');
                    $image->move($destinationPath, $image_name);
                    return response()->json(['data' => 'images/ProductImg/'.$image_name]);
                }

            }
        }
    }

    public function save(Request $request){
      
        $category_ids = explode(",",$request['categoryIds']);
        $attr_term_ids = explode(",",$request['attr_term_ids']);

        $product = new Product();

        $product_variant_old_images = array();
        $variants_status = array();
        if($request->action=="editProduct"){
            $product = Product::find($request->product_id);

            $product_variants = ProductVariant::where('product_id',$request->product_id)->get();
            foreach ($product_variants as $product_variant)
            {
                $temp_images = explode(",",$product_variant->images);
                foreach ($temp_images as $temp_img) {
                    array_push($product_variant_old_images, $temp_img);
                }
                $variants_status[$product_variant->term_item_id] = $product_variant->estatus;
                $product_variant->estatus = 3;
                $product_variant->save();
                $product_variant->delete();
            }

            $product_variant_specifications = ProductVariantSpecification::where('product_id',$request->product_id)->get();
            foreach ($product_variant_specifications as $product_variant_specification)
            {
                $product_variant_specification->estatus = 3;
                $product_variant_specification->save();
                $product_variant_specification->delete();
            }

            $product_variant_variants = ProductVariantVariant::where('product_id',$request->product_id)->get();
            foreach ($product_variant_variants as $product_variant_variant)
            {
                $product_variant_variant->estatus = 3;
                $product_variant_variant->save();
                $product_variant_variant->delete();
            }
        }

        if($request->action=="addProduct") {
            $product->user_id = Auth::user()->id;
        }
        $product->primary_category_id = $category_ids[0];
        $product->product_title = isset($request->ProductName) ? $request->ProductName : null;
        //$product->child_category_id = $category_ids[1];
        //$product->subchild_category_id = isset($category_ids[2]) ? $category_ids[2] : null;
        //$product->hsn_code = isset($request->hsnCode) ? $request->hsnCode : null;
        $product->desc = isset($request->desc) ? $request->desc : null;
        $product->attrid_for_variation = $request->attrid_for_variation;
        $product->attr_term_ids = $request->attr_term_ids;
        $product->note = isset($request->notes) ? $request->notes : null;
        $product->is_custom = isset($request->is_custom) ? $request->is_custom : 0;
        $product->save();

        $not_removable_images = array();
        for ($i=1;$i<=count($attr_term_ids);$i++) {
            $myValue = array();
            $str ="variantForm".$i;
            parse_str($request[$str],$myValue);
            
            $product_variant = new ProductVariant();
            $product_variant->product_id = $product->id;
            $product_variant->SKU = $myValue['SKU'];
            $product_variant->regular_price = (isset($myValue['varRegularPrice']) && $myValue['varRegularPrice']!="") ? $myValue['varRegularPrice'] : null;
            $product_variant->sale_price = $myValue['varSalePrice'];
            $product_variant->stock = $myValue['stock'];
            if (isset($myValue['varRegularPrice']) && $myValue['varRegularPrice']!="") {
                $product_variant->auto_discount_rs = $myValue['varRegularPrice'] - $myValue['varSalePrice'];
                $product_variant->auto_discount_percent = (($myValue['varRegularPrice'] - $myValue['varSalePrice']) * 100) / $myValue['varRegularPrice'];
            }
            //$user_discount_percentage = Settings::where('estatus',1)->pluck('user_discount_percentage')->first();
            //$product_variant->sale_price_for_premium_member = $myValue['varSalePrice'] - $user_discount_percentage;
            $product_variant->term_item_id = $myValue['term_id'];
            $product_variant->images = $myValue['varImage'];
            $product_variant->estatus = isset($variants_status[$myValue['term_id']]) ? $variants_status[$myValue['term_id']] : 1;

            $temp_new_images = explode(",",$myValue['varImage']);
            foreach ($temp_new_images as $temp_new_image){
                if(in_array($temp_new_image,$product_variant_old_images)){
                    array_push($not_removable_images,$temp_new_image);
                }
            }
            $product_variant->save();

            // if(isset($request->is_custom) && $request->is_custom == 1) {
            //    $diamonds = Diamond::all();
            //     foreach ($diamonds as $diamond) {
            //         $diamond_variant = new DiamondVariant();
            //         $diamond_variant->product_variant_id = $product_variant->id;
            //         $diamond_variant->product_id = $product->id;
            //         $diamond_variant->diamond_id = $diamond->id;
            //         $diamond_variant->save();
            //     }  
            // }
            

            if(isset($myValue['varVariation'])) {
                $Variation = explode(",", $myValue['varVariation']);
               // print_r($Variation); die;
                foreach ($Variation as $vari) {
                    $product_variant_variant = new ProductVariantVariant();
                    $product_variant_variant->product_variant_id = $product_variant->id;
                    $product_variant_variant->product_id = $product->id;
                    $product_variant_variant->attribute_id = $vari;
                    $product_variant_variant->attribute_term_id = $myValue['Variation' . $vari];
                    $product_variant_variant->save();
                }
            }
 
            if(isset($myValue['varSpecRequired'])) {
                $varSpecRequired = explode(",", $myValue['varSpecRequired']);
                
                foreach ($varSpecRequired as $specReq) {
                    $attribute_term_string = implode(',',$myValue['specReq' . $specReq]);
                    $product_variant_specification = new ProductVariantSpecification();
                    $product_variant_specification->product_variant_id = $product_variant->id;
                    $product_variant_specification->product_id = $product->id;
                    $product_variant_specification->attribute_id = $specReq;
                    $product_variant_specification->attribute_term_id = $attribute_term_string;
                    $product_variant_specification->type = 1;
                    $product_variant_specification->save();
                }
            }

            if (isset($myValue['varSpecOptional']) && $myValue['varSpecOptional']!="") {
                $varSpecOptional = explode(",", $myValue['varSpecOptional']);
                foreach ($varSpecOptional as $specOpt) {
                    $attribute_term_string_opt = implode(',',$myValue['specOpt' . $specOpt]);
                    $product_variant_specification = new ProductVariantSpecification();
                    $product_variant_specification->product_variant_id = $product_variant->id;
                    $product_variant_specification->product_id = $product->id;
                    $product_variant_specification->attribute_id = $specOpt;
                    $product_variant_specification->attribute_term_id = $attribute_term_string_opt;
                    $product_variant_specification->type = 0;
                    $product_variant_specification->save();
                }
            }

        }

        foreach ($product_variant_old_images as $product_variant_old_image){
            if (!in_array($product_variant_old_image,$not_removable_images) && $request->action=="editProduct"){
                $image = public_path($product_variant_old_image);
                if (file_exists($image)) {
                    unlink($image);
                }
            }
        }

//        dd($product_variant_old_images,$not_removable_images);
        if($request->action=="addProduct") {
            $cat_id = isset($category_ids[0]) ? $category_ids[0] : $category_ids[0];
            $cnt_products = Product::where('primary_category_id',$cat_id)->where('estatus',1)->count();
            $category = Category::find($cat_id);
            $category->total_products = $cnt_products;
            $category->save();

            // if (isset($category->parent_category_id) && $category->parent_category_id!=0){
            //     $category = Category::find($category->parent_category_id);
            //     $category->total_products = $category->total_products + 1;
            //     $category->save();
            //     if (isset($category->parent_category_id) && $category->parent_category_id!=0){
            //         $category = Category::find($category->parent_category_id);
            //         $category->total_products = $category->total_products + 1;
            //         $category->save();
            //     }
            // }
        }

        return ['status' => 200];
    }

    public function removefile(Request $request){
        if(isset($request->action) && $request->action == 'removeProductImages'){
            $image = $request->file;

            if(isset($image)) {
                $image = public_path($request->file);
                if (file_exists($image)) {
                    unlink($image);
                    return response()->json(['status' => '200']);
                }
            }
        }
    }

    public function allproductlist(Request $request){

        if ($request->ajax()) {
            $columns = array(
                0 =>'id',
                1 =>'image',
                2 => 'product_title',
                3 => 'categories',
                4 => 'price',
                5 => 'estatus',
                6 => 'created_at',
                7 => 'action',
            );
            $totalData = ProductVariant::with('product')
            ->whereHas('product', function($q){
                $q->where('is_custom', '=', '0');
            })->count();
            $totalFiltered = $totalData;
            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            if($order == "id"){
                $order = "created_at";
                $dir = 'desc';
            }

            if(empty($request->input('search.value')))
            {
                $products = ProductVariant::with('product.primary_category','product.attribute','attribute_term')
                    ->whereHas('product', function($q){
                        $q->where('is_custom', '=', '0');
                    })
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();    
            }
            else {
                $search = $request->input('search.value');
                $products =  ProductVariant::with('product.primary_category','product.attribute','attribute_term')
                    ->where('product_title','LIKE',"%{$search}%")
                    ->orWhere('sale_price','LIKE',"%{$search}%")
                    ->whereHas('product', function($q){
                        $q->where('is_custom', '=', '0');
                    })
                    ->orWhereHas('product.primary_category',function ($mainQuery) use($search) {
                        $mainQuery->where('category_name', 'Like', '%' . $search . '%');
                    })
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();

                $totalFiltered = ProductVariant::where('product_title','LIKE',"%{$search}%")
                    ->orWhere('sale_price','LIKE',"%{$search}%")
                    ->whereHas('product', function($q){
                        $q->where('is_custom', '=', '0');
                    })
                    ->orWhereHas('product.primary_category',function ($mainQuery) use($search) {
                        $mainQuery->where('category_name', 'Like', '%' . $search . '%');
                    })
                    ->count();
            }

            $data = array();

            if(!empty($products))
            {
                foreach ($products as $product)
                {
                    $page_id = ProjectPage::where('route_url','admin.products.list')->pluck('id')->first();

                    if( $product->estatus==1 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="ProductStatuscheck_'. $product->id .'" onchange="chageProductStatus('. $product->id .')" value="1" checked="checked"><span class="slider round"></span></label>';
                    }
                    elseif ($product->estatus==1){
                        $estatus = '<label class="switch"><input type="checkbox" id="ProductStatuscheck_'. $product->id .'" value="1" checked="checked"><span class="slider round"></span></label>';
                    }

                    if( $product->estatus==2 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="ProductStatuscheck_'. $product->id .'" onchange="chageProductStatus('. $product->id .')" value="2"><span class="slider round"></span></label>';
                    }
                    elseif ($product->estatus==2){
                        $estatus = '<label class="switch"><input type="checkbox" id="ProductStatuscheck_'. $product->id .'" value="2"><span class="slider round"></span></label>';
                    }


                    $action='';
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
                        $action .= '<button id="editProductBtn" class="btn btn-gray text-blue btn-sm" data-id="' .$product->product_id. '"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                    }
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_delete($page_id)) ){
                        $action .= '<button id="deleteProductBtn" class="btn btn-gray text-danger btn-sm" data-toggle="modal" data-target="#DeleteProductModal" onclick="" data-id="' .$product->id. '"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }

                    $images = explode(",",$product->images);

                    $categories = $product->product->primary_category->category_name;
                    
                    $product_info = '<span>'.$product->product->product_title.'</span><span> SKU: '.$product->SKU.'</span>';
                    
                     $Productvariantvariants = ProductVariantVariant::leftJoin('attributes', function($join) {
                        $join->on('product_variant_variants.attribute_id', '=', 'attributes.id');
                      })->leftJoin('attribute_terms', function($join) {
                        $join->on('product_variant_variants.attribute_term_id', '=', 'attribute_terms.id');
                      })->where('product_variant_id',$product->id)->select('attributes.attribute_name','attribute_terms.attrterm_name')->get();

                    foreach($Productvariantvariants as $Productvariantvariant){
                        $product_info .= '<span>'.$Productvariantvariant->attribute_name.' : '.$Productvariantvariant->attrterm_name.'</span>';
                    }
                    
                    $price = '<ul>';
                    if(isset($product->regular_price)){
                        $price .= '<li class="regularprice"><i class="fa fa-inr" aria-hidden="true"></i> '.$product->regular_price.'</li>';
                    }
                    if (isset($product->sale_price)){
                        $price .= '<li><i class="fa fa-inr" aria-hidden="true"></i> '.$product->sale_price.'</li></ul>';
                    }

                    $nestedData['image'] = '<img src="'.url($images[0]).'" width="50px" height="50px"/>';
                    $nestedData['product_title'] = $product_info;
                    $nestedData['product_code'] = isset($product->product->hsn_code) ? $product->product->hsn_code : "-";
                    $nestedData['categories'] = $categories;
                    $nestedData['price'] = $price;
                    $nestedData['estatus'] = $estatus;
                    $nestedData['created_at'] = date('d-m-Y h:i A', strtotime($product->created_at));
                    $nestedData['action'] = $action;
                    $data[] = $nestedData;
                }
            }

            $json_data = array(
                "draw"            => intval($request->input('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data,
            );


            echo json_encode($json_data);
        }
    }

    public function allcustomproductlist(Request $request){

        if ($request->ajax()) {
            $columns = array(
                0 =>'id',
                1 =>'image',
                2 => 'product_title',
                3 => 'categories',
                4 => 'price',
                5 => 'estatus',
                6 => 'created_at',
                7 => 'action',
            );
            $totalData = ProductVariant::with('product')
            ->whereHas('product', function($q){
                $q->where('is_custom', '=', '1');
            })->count();
            $totalFiltered = $totalData;
            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            if($order == "id"){
                $order = "created_at";
                $dir = 'desc';
            }

            if(empty($request->input('search.value')))
            {
                $products = ProductVariant::with('product.primary_category','product.attribute','attribute_term')
                    ->whereHas('product', function($q){
                        $q->where('is_custom', '=', '1');
                    })
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();    
            }
            else {
                $search = $request->input('search.value');
                $products =  ProductVariant::with('product.primary_category','product.attribute','attribute_term')
                    ->where('product_title','LIKE',"%{$search}%")
                    ->orWhere('sale_price','LIKE',"%{$search}%")
                    ->whereHas('product', function($q){
                        $q->where('is_custom', '=', '1');
                    })
                    ->orWhereHas('product.primary_category',function ($mainQuery) use($search) {
                        $mainQuery->where('category_name', 'Like', '%' . $search . '%');
                    })
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();

                $totalFiltered = ProductVariant::where('product_title','LIKE',"%{$search}%")
                    ->orWhere('sale_price','LIKE',"%{$search}%")
                    ->whereHas('product', function($q){
                        $q->where('is_custom', '=', '1');
                    })
                    ->orWhereHas('product.primary_category',function ($mainQuery) use($search) {
                        $mainQuery->where('category_name', 'Like', '%' . $search . '%');
                    })
                    ->count();
            }

            $data = array();

            if(!empty($products))
            {
                foreach ($products as $product)
                {
                    $page_id = ProjectPage::where('route_url','admin.products.list')->pluck('id')->first();

                    if( $product->estatus==1 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="ProductStatuscheck_'. $product->id .'" onchange="chageProductStatus('. $product->id .')" value="1" checked="checked"><span class="slider round"></span></label>';
                    }
                    elseif ($product->estatus==1){
                        $estatus = '<label class="switch"><input type="checkbox" id="ProductStatuscheck_'. $product->id .'" value="1" checked="checked"><span class="slider round"></span></label>';
                    }

                    if( $product->estatus==2 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="ProductStatuscheck_'. $product->id .'" onchange="chageProductStatus('. $product->id .')" value="2"><span class="slider round"></span></label>';
                    }
                    elseif ($product->estatus==2){
                        $estatus = '<label class="switch"><input type="checkbox" id="ProductStatuscheck_'. $product->id .'" value="2"><span class="slider round"></span></label>';
                    }


                    $action='';
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
                        $action .= '<button id="editProductBtn" class="btn btn-gray text-blue btn-sm" data-id="' .$product->product_id. '"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                    }
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_delete($page_id)) ){
                        $action .= '<button id="deleteProductBtn" class="btn btn-gray text-danger btn-sm" data-toggle="modal" data-target="#DeleteProductModal" onclick="" data-id="' .$product->id. '"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }

                    $images = explode(",",$product->images);

                    $categories = $product->product->primary_category->category_name;
                    
                    $product_info = '<span>'.$product->product->product_title.'</span><span> SKU: '.$product->SKU.'</span>';
                    
                     $Productvariantvariants = ProductVariantVariant::leftJoin('attributes', function($join) {
                        $join->on('product_variant_variants.attribute_id', '=', 'attributes.id');
                      })->leftJoin('attribute_terms', function($join) {
                        $join->on('product_variant_variants.attribute_term_id', '=', 'attribute_terms.id');
                      })->where('product_variant_id',$product->id)->select('attributes.attribute_name','attribute_terms.attrterm_name')->get();

                    foreach($Productvariantvariants as $Productvariantvariant){
                        $product_info .= '<span>'.$Productvariantvariant->attribute_name.' : '.$Productvariantvariant->attrterm_name.'</span>';
                    }
                    
                    $price = '<ul>';
                    if(isset($product->regular_price)){
                        $price .= '<li class="regularprice"><i class="fa fa-inr" aria-hidden="true"></i> '.$product->regular_price.'</li>';
                    }
                    if (isset($product->sale_price)){
                        $price .= '<li><i class="fa fa-inr" aria-hidden="true"></i> '.$product->sale_price.'</li></ul>';
                    }

                    $nestedData['image'] = '<img src="'.url($images[0]).'" width="50px" height="50px"/>';
                    $nestedData['product_title'] = $product_info;
                    $nestedData['product_code'] = isset($product->product->hsn_code) ? $product->product->hsn_code : "-";
                    $nestedData['categories'] = $categories;
                    $nestedData['price'] = $price;
                    $nestedData['estatus'] = $estatus;
                    $nestedData['created_at'] = date('d-m-Y h:i A', strtotime($product->created_at));
                    $nestedData['action'] = $action;
                    $data[] = $nestedData;
                }
            }

            $json_data = array(
                "draw"            => intval($request->input('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data,
            );


            echo json_encode($json_data);
        }
    }

    public function editproduct($id){
        $categories = Category::where('estatus',1)->get()->toArray();
        $catArray = array();
        foreach ($categories as $category){
            
            array_push($catArray,$category);
        }

       

        $product = Product::with('primary_category','attribute.attributeterm','product_variant.product_variant_specification')->where('id',$id)->first();

        $attr_term_ids = explode(",",$product->attr_term_ids);
//        dd($product->toArray());
        $CategorySel = isset($product->primary_category_id) ? ($product->primary_category->category_name) : ($product->primary_category->category_name);
        return view('admin.products.edit',compact('catArray','product','CategorySel','attr_term_ids'))->with('page',$this->page);
    }

    public function changeproductstatus($id){
        $product_variant = ProductVariant::find($id);
        if ($product_variant->estatus==1){
            $product_variant->estatus = 2;
            $product_variant->save();
            return response()->json(['status' => '200','action' =>'deactive']);
        }
        if ($product_variant->estatus==2){
            $product_variant->estatus = 1;
            $product_variant->save();
            return response()->json(['status' => '200','action' =>'active']);
        }
    }

    public function deleteproduct($id){
        $product_variant = ProductVariant::find($id);
        if ($product_variant){
            $images = explode(",",$product_variant->images);

            $product_id = $product_variant->product_id;

            $product_variant->estatus = 3;
            $product_variant->save();
            $product_variant->delete();

            foreach ($images as $image){
                if (file_exists(url('public/'.$image))) {
                    unlink($image);
                }
            }

            $product_variant_variants = ProductVariantVariant::where('product_variant_id',$id)->get();
            foreach ($product_variant_variants as $product_variant_variant)
            {
                $product_variant_variant->estatus = 3;
                $product_variant_variant->save();
                $product_variant_variant->delete();
            }

            $product_variant_specifications = ProductVariantSpecification::where('product_variant_id',$id)->get();
            foreach ($product_variant_specifications as $product_variant_specification){
                $product_variant_specification->estatus = 3;
                $product_variant_specification->save();
                $product_variant_specification->delete();
            }

            $cnt_product_variants = ProductVariant::where('product_id',$product_id)->count();
            if ($cnt_product_variants == 0){
                $product = Product::find($product_id);
                $cat_id = isset($product->subchild_category_id) ? $product->subchild_category_id : $product->child_category_id;
                $product->estatus = 3;
                $product->save();
                $product->delete();

                $cnt_products1 = Product::where('child_category_id',$cat_id)->where('subchild_category_id',null)->where('estatus',1)->count();
                $cnt_products2 = Product::where('subchild_category_id',$cat_id)->where('estatus',1)->count();
                $category = Category::find($cat_id);
                $category->total_products = $cnt_products1 + $cnt_products2;
                $category->save();

                if (isset($category->parent_category_id) && $category->parent_category_id!=0){
                    $category = Category::find($category->parent_category_id);
                    $category->total_products = $category->total_products - 1;
                    $category->save();
                    if (isset($category->parent_category_id) && $category->parent_category_id!=0){
                        $category = Category::find($category->parent_category_id);
                        $category->total_products = $category->total_products -1;
                        $category->save();
                    }
                }
            }

            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '400']);
    }


    public function sku_check(Request $request)
    {
        // your validation logic ..

        $skuFound = ProductVariant::where('SKU',$request->input('username'))->first();
      
        if($skuFound != null) {
            return "false";
        }
        return "true";
    }

   
    
}
