<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\ProductVariant;
use App\Models\ProductAttribute;
use App\Models\ProductVariantVariant;
use App\Models\OrderIncludes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Response;

class ProductController extends Controller
{
    public function index($id){
        $CatId = $id;
        $Products= Product::with('primary_categories','product_variant')->where(['estatus' => 1])->get();
        $Categories = Category::where(['estatus' => 1,'is_custom' => 0,'parent_category_id' => 0])->get();
        $Attributes = Attribute::with('attributeterm')->where(['estatus' => 1,'is_filter' => 1])->get();
        $Maxprice = ProductVariant::max('sale_price');
        return view('frontend.shop',compact('Products','Categories','Attributes','Maxprice','CatId'));
    }

    public function product_detail($id,$variantid){

        $attribute_term_ids = ProductVariantVariant::where('product_variant_id',$variantid)->where('estatus',1)->get()->pluck('attribute_term_id')->toArray();
        // $Product= Product::with('product','product_variant_variants')->where(['estatus' => 1,'id' => $id])->first();
        $Product = Product::select('products.*','product_variants.images','product_variants.sale_price','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->leftJoin("product_variant_variants", "product_variant_variants.product_id", "=", "products.id")->leftJoin("product_variant_specifications", "product_variant_specifications.product_id", "=", "products.id")->where(['product_variants.id' => $variantid,'products.estatus' => 1,'product_variants.estatus' => 1])->first();
        //$ProductRelated= Product::with('primary_category','product_variant')->where(['estatus' => 1,'primary_category_id' => $id])->get();
        $ProductRelated= Product::select('products.*','product_variants.images','product_variants.sale_price','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->leftJoin("product_variant_variants", "product_variant_variants.product_id", "=", "products.id")->leftJoin("product_variant_specifications", "product_variant_specifications.product_id", "=", "products.id")->where(['products.is_custom' => 0,'products.estatus' => 1,'product_variants.estatus' => 1,'primary_category_id' => $Product->primary_category_id])->where('products.id','<>',$Product->id)->groupBy('products.id')->get();
        
        $OrderIncludes= OrderIncludes::with('OrderIncludesData')->where(['estatus' => 1])->first();
        return view('frontend.product',compact('Product','variantid','attribute_term_ids','ProductRelated','OrderIncludes'));
    }

    public function fetchproduct(Request $request){
        $data = $request->all();
       
        if(isset($data["action"]))
        {
           
            $attr = (isset($data["category"]) && $data["category"]) ? $data["category"]  : null;
            $query = Product::select('products.*','product_variants.images','product_variants.sale_price','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->leftJoin("product_variant_variants", "product_variant_variants.product_id", "=", "products.id")->leftJoin("product_variant_specifications", "product_variant_specifications.product_id", "=", "products.id")->where(['products.is_custom' => 0,'products.estatus' => 1,'product_variants.estatus' => 1]);
            
            // if($request->keyword){
            //     // This will only execute if you received any keyword
            //     $query = $query->where('name','like','%'.$keyword.'%');
            // }
            
            if($data["minimum_price"] && $data["maximum_price"]){
                $query = $query->where('product_variants.sale_price','>=',$data["minimum_price"]);
                $query = $query->where('product_variants.sale_price','<=',$data["maximum_price"]);
            }
            //dd($data["category"][0]);
            if(isset($data["category"])){
                $cat_id = $data["category"][0];
                //$query = $query->where('primary_category_id',$data["category"][0]);
                $query = $query->WhereRaw("FIND_IN_SET($cat_id, primary_category_id)");
            }
            
            if(isset($data["attribute"])){
                $attribute=$data["attribute"];
                $query = $query->where('product_variant_variants.attribute_term_id',$data["attribute"]);
                $query = $query->where('product_variant_variants.estatus',1);
            }

            if(isset($data["specification"])){
                $specification=$data["specification"];
                $query = $query->where('product_variant_specifications.attribute_term_id',$specification);
                $query = $query->where('product_variant_specifications.estatus',1);
            }

             if(isset($data["sorting"])){ 
                if($data["sorting"]== "date")   
                {
                    $result = $query->orderBy('products.created_at','DESC')->groupBy('products.id')->paginate(12);  
                }
                else if($data["sorting"] == "price")
                {
                    $result = $query->orderBy('product_variants.sale_price','ASC')->groupBy('products.id')->paginate(12); 
                }
                else if($data["sorting"]=="price-desc")
                {
                    $result = $query->orderBy('product_variants.sale_price','DESC')->groupBy('products.id')->paginate(12); 
                }else{
                    $result = $query->orderBy('products.created_at','ASC')->groupBy('products.id')->paginate(12);  
                }
           }else{
               
            $result = $query->orderBy('products.created_at','ASC')->groupBy('products.id')->paginate(12);
           }
           
           //$result = $query->groupBy('products.id')->paginate(12);
            $output = '';
            if(count($result) > 0){
            foreach($result as $row)
            {
                $images = explode(",",$row->images);
                $image = URL($images['0']);
                $sale_price = $row->sale_price;
                $url =  URL('/product-details/'.$row->id.'/'.$row->variant_id);
                $output .= '
                <div class="col-sm-6 col-lg-4 col-xl-3 mt-3 mt-md-4 hover_effect_part wire_bangle_shop_radio">
                    <div class="wire_bangle_img_radio_button">
                        <div class="wire_bangle_img mb-3 position-relative">
                            <a class="wire_bangle_hover_a" href="'.$url.'"><img src="'.  $image  .'" alt="" class="main-product-image"></a>
                        </div><div class="text-center">';
                        
                        foreach($images as $image){
                        $output .= '<span class="form-check d-inline-block ">
                            <a href="">
                            
                            <img src="'.URL($image) .'" style="width:40px; height: 40px;" alt=""  class="wire_bangle_color_img pe-auto product-image ">
                            </a>
                            <div class="wire_bangle_color_input_label"></div>
                        </span>';
                        }
                        $output .= ' </div><div class="wire_bangle_description p-3">';
                        
                            $output .= '<div class="wire_bangle_heading mb-2">'.$row->primary_category->category_name .'</div>
                            <div class="wire_bangle_sub_heading wire_bangle_description"><a href="'.$url.'">'. $row->product_title .'</a></div>
                            <div class="d-flex justify-content-between pt-2 align-items-center">
                                <span class="wire_bangle_price wire_bangle_price_part">
                                    $'. $sale_price .'
                                </span>';

                                $ProductVariantVariant = \App\Models\ProductVariantVariant::with('attribute','attribute_terms')->where('estatus',1)->where('product_id',$row->id)->groupBy('attribute_id')->get();
                                foreach($ProductVariantVariant as $productvariants){
                                if($productvariants->attribute_terms['0']->attrterm_thumb != ''){
                            
                                $output .= '<span class="wire_bangle_color mb-xxl-0 wire_bangle_color_img_part text-center wire_bangle_color_ring_part d-inline-block"><div class="wire_bangle_color_part">';
                                
                                    $product_attribute = \App\Models\ProductVariantVariant::with('attribute_terms')->where('estatus',1)->where('attribute_id',$productvariants->attribute_id)->where('product_id',$row->id)->groupBy('attribute_term_id')->get();
                                    $ia = 1;
                                    
                                    foreach($product_attribute as $attribute_term){

                                        $attributeurl =  URL('/product-details/'.$row->id.'/'.$attribute_term->product_variant_id); 
                                    
                                         $output .= '<span class="form-check d-inline-block">
                                            <a href="'.$attributeurl.'">
                                            
                                            <img src="'. url('images/attrTermThumb/'.$attribute_term->attribute_terms[0]->attrterm_thumb) .'" alt="'.$attribute_term->attribute_terms[0]->attrterm_name .'"  class="wire_bangle_color_img pe-auto">
                                            </a>
                                            <div class="wire_bangle_color_input_label"></div>
                                        </span>';
                                    $ia++;    
                                }
                                $output .= '</div></span>';
                                
                                    } 
                                } 
                                
                                $output .= ' </div>
                        </div>
                    </div>
                </div>
                ';
            }
            }else{
                $output .= 'Data Not Found';  
            } 
            $data = ['output' => $output,'datacount' => count($result)];   
            return $data;
            }
    }


    // public function fetchproductdetails(Request $request){
    //     $data = $request->all();
    //     $variants=$data["variant"];
    //     dd($variants);
    //     $product_id=$data["product_id"];
    //     if(isset($data["action"]))
    //     {
    //         $product_variants = ProductVariant::where('product_id',$product_id)->where('estatus',1)->get();
    //         $vatid = 0;
    //         foreach($product_variants as $product_variant){
                
    //             $product_variant_variants = ProductVariantVariant::where('product_variant_id',$product_variant->id)->where('estatus',1)->get()->pluck('attribute_term_id')->toArray();
    //             if($product_variant_variants == $variants){
    //                 $vatid = $product_variant->id;
    //             }
    //         }
            
    //         $query = Product::select('products.*','product_variants.images','product_variants.sale_price','product_variants.regular_price','product_variants.SKU','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->where('products.estatus',1);
            
    //         if($vatid > 0){
    //             $query = $query->where('product_variants.id',$vatid);
    //         }
    //         $result = $query->orderBy('products.created_at','ASC')->first();

    //         $product_attributes_variant = \App\Models\ProductVariantVariant::leftJoin("attributes", "attributes.id", "=", "product_variant_variants.attribute_id")->where('product_variant_variants.estatus',1)->where('product_variant_id',$vatid)->groupBy('attributes.id')->get();
    //         $variantstr = '';
    //         foreach($product_attributes_variant as $product_attribute_variant){ 
    //             $product_attribute_terms = explode(',',$product_attribute_variant->attribute_term_id);
    //             $product_attributes_term_val = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id', $product_attribute_terms)->get()->pluck('attrterm_name')->toArray();
    //             $product_attribute_term_name = implode(' - ',$product_attributes_term_val); 
    //             $variantstr .='<div class="d-flex align-items-center mb-3 col-md-6 px-0">
    //                                 <span class="wire_bangle_color_heading  d-inline-block">'.$product_attribute_variant->attribute_name .' :</span>
    //                                 <span class="ms-2 d-inline-block wire_bangle_color_heading ">'. $product_attribute_term_name .'</span>
    //                             </div>';
    //         }

    //         $product_attributes_specification = \App\Models\ProductVariantSpecification::leftJoin("attributes", "attributes.id", "=", "product_variant_specifications.attribute_id")->where('product_variant_specifications.estatus',1)->where('is_dropdown',0)->where('product_variant_id',$vatid)->groupBy('attributes.id')->get();
    //         $str = '';
           
    //         foreach($product_attributes_specification as $product_attribute_specification){ 
    //             $product_attribute_terms = explode(',',$product_attribute_specification->attribute_term_id);
    //             $product_attributes_term_val = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id', $product_attribute_terms)->get()->pluck('attrterm_name')->toArray();
    //             $product_attribute_term_name = implode(' - ',$product_attributes_term_val); 
    //             //$product_attributes_specification = \App\Models\ProductVariantSpecification::leftJoin("attribute_term", "attribute_term.id", "=", "product_variant_specifications.attribute_term_id")->where('product_variant_specifications.estatus',1)->where('is_dropdown',0)->where('product_variant_id',$vatid)->groupBy('attributes.id')->get();
    //             $str .='<div class="col-md-6 px-0" >
    //                     <div class="mt-4 wire_bangle_share">
    //                     '.$product_attribute_specification->attribute_name .' &nbsp;:&nbsp;
    //                         <span class="wire_bangle_color_theme">'. $product_attribute_term_name .'</span>
    //                     </div>
    //                 </div>';

    //             $variantstr .='<div class="d-flex align-items-center mb-3 col-md-6 px-0">
    //                 <span class="wire_bangle_color_heading  d-inline-block">'.$product_attribute_specification->attribute_name .' :</span>
    //                 <span class="ms-2 d-inline-block wire_bangle_color_heading ">'. $product_attribute_term_name .'</span>
    //             </div>';  
                
    //         }

    //         $ProductVariantSpecification = \App\Models\ProductVariantSpecification::with('attribute_terms')->leftJoin("attributes", "attributes.id", "=", "product_variant_specifications.attribute_id")->where('product_variant_specifications.estatus',1)->where('product_variant_id',$vatid)->where('is_specification',1)->where('is_dropdown',1)->groupBy('product_variant_specifications.attribute_id')->get();
    //         $spe = '';
    //         foreach($ProductVariantSpecification as $productvariants)
    //         {

    //         $spe .='<span class="wire_bangle_select mb-3 me-3 d-inline-block">
    //                   <select name="AtributeSpecification'.$productvariants->attribute->id.'" id="AtributeSpecification'.$productvariants->id.'" class="specification">
    //                     <option value="">-- '.$productvariants->attribute->attribute_name .'--</option>';   
               
    //             $product_attribute = \App\Models\ProductVariantSpecification::where('estatus',1)->where('attribute_id',$productvariants->attribute_id)->where('product_variant_id',$vatid)->groupBy('attribute_term_id')->get();
                    
    //             foreach($product_attribute as $attribute_term){
    //                 $term_array = explode(',',$attribute_term->attribute_term_id);
    //                 $product_attributes = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id',$term_array)->get();
    //                 $v = 1;
    //                 foreach($product_attributes as $term){
    //                 $spe .='<option data-spe="'.$productvariants->attribute->attribute_name .'" data-term="'.$term->attrterm_name .'" value="'. $term->id .'">'.$term->attrterm_name .'</option>'; 
                    
    //                }
    //             }   
    //         $spe .='</select>
    //             <div id="AtributeSpecification'.$productvariants->attribute->id.'-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    //         </span> ';
    //         }

    //         $images = '';
    //         if($result->images !=""){
    //             $images = explode(',',$result->images);
    //         }
    //         $vimage = '';
    //         $vimage .='<div class="slider slider-single mb-5">'; 
    //                 foreach($images as $image){
    //                    $vimage .='<div class="product_slider_main_item">
    //                                   <img src="'.URL($image).'" alt="">
    //                               </div>';
    //                 }
    //         $vimage .='</div>
    //                 <div class="slider slider-nav">';
    //                 foreach($images as $image){
    //                     $vimage .='<div class="product_slider_item">
    //                         <h3><img src="'.URL($image).'" alt=""></h3>
    //                     </div>';     
    //                 }   
    //         $vimage .='</div>';

    //     $spe_desc ='';
    //     $product_attributes_specification = \App\Models\ProductVariantSpecification::leftJoin("attributes", "attributes.id", "=", "product_variant_specifications.attribute_id")->where('product_variant_specifications.estatus',1)->where('is_dropdown',0)->where('is_description',1)->where('product_variant_id',$vatid)->groupBy('attributes.id')->get();
    //     foreach($product_attributes_specification as $product_attribute_specification){  
    //         $product_attribute_terms = explode(',',$product_attribute_specification->attribute_term_id);
    //         $product_attributes_term_val = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id', $product_attribute_terms)->get()->pluck('attrterm_name')->toArray();
    //         $product_attributes_term_des = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id', $product_attribute_terms)->get()->pluck('description')->toArray();
    //         $product_attribute_term_name = implode(' - ',$product_attributes_term_val);
        
    //     $spe_desc .='<div class="px-0 mt-3">
    //             <div class="heading-h4 wire_diamond_heading pb-xxl-2">'.$product_attribute_specification->attribute_name .' '.$product_attribute_term_name .'</div>
    //         </div>
    //         <div class="row">';
    //         foreach($product_attributes_term_des as $attrterm_description){  
    //             $spe_desc .='<div class="col-md-6 mt-2 mt-md-0 px-0 position-relative">
    //                 <div>
    //                     <p class="wire_diamond_pargraph">'.$attrterm_description.'</p>
    //                 </div>
    //             </div>';
    //         }
    //         $spe_desc .='</div>';
    //         }
                    
    //         $data = ['result' => $result,'speci' => $str,'speci_multi' => $spe,'vimage' => $vimage,'spe_desc' => $spe_desc,'variantstr' => $variantstr ]; 
    //         return \Response()->json($data);

    //     }
    // }

    public function fetchproductdetails(Request $request){
        $data = $request->all();
        //dd($data);
        $variants=$data["variant"];
        $product_id=$data["product_id"];
        if(isset($data["action"]))
        {
            $product_variants = ProductVariant::where('product_id',$product_id)->where('estatus',1)->get();
            
            $vatid = 0;
            foreach($product_variants as $product_variant){
                //dd($product_variant);
                $product_variant_variants = ProductVariantVariant::where('product_variant_id',$product_variant->id)->where('estatus',1)->get()->pluck('attribute_term_id')->toArray();
                //dd($product_variant_variants);
                if(sort($product_variant_variants) == sort($variants)){
                    
                    $vatid = $product_variant->id;
                }
            }
          
            if($vatid != 0){
            $query = Product::select('products.*','product_variants.images','product_variants.sale_price','product_variants.regular_price','product_variants.SKU','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->where('products.estatus',1);
            
            if($vatid > 0){
                $query = $query->where('product_variants.id',$vatid);
            }
            $result = $query->orderBy('products.created_at','ASC')->first();

            $product_attributes_variant = \App\Models\ProductVariantVariant::leftJoin("attributes", "attributes.id", "=", "product_variant_variants.attribute_id")->where('product_variant_variants.estatus',1)->where('product_variant_id',$vatid)->groupBy('attributes.id')->get();
            $variantstr = '';
            foreach($product_attributes_variant as $product_attribute_variant){ 
                $product_attribute_terms = explode(',',$product_attribute_variant->attribute_term_id);
                $product_attributes_term_val = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id', $product_attribute_terms)->get()->pluck('attrterm_name')->toArray();
                $product_attribute_term_name = implode(' - ',$product_attributes_term_val); 
                $variantstr .='<div class="d-flex align-items-center mb-4 col-md-6">
                                    <span class="wire_bangle_color_heading  d-inline-block">'.$product_attribute_variant->attribute_name .' :</span>
                                    <span class="ms-2 d-inline-block wire_bangle_color_heading ">'. $product_attribute_term_name .'</span>
                                </div>';
            }

            $product_attributes_specification = \App\Models\ProductVariantSpecification::leftJoin("attributes", "attributes.id", "=", "product_variant_specifications.attribute_id")->where('product_variant_specifications.estatus',1)->where('is_dropdown',0)->where('product_variant_id',$vatid)->groupBy('attributes.id')->get();
            $str = '';
            $specificationstr = '';
            foreach($product_attributes_specification as $product_attribute_specification){ 
                $product_attribute_terms = explode(',',$product_attribute_specification->attribute_term_id);
                $product_attributes_term_val = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id', $product_attribute_terms)->get()->pluck('attrterm_name')->toArray();
                $product_attribute_term_name = implode(' - ',$product_attributes_term_val); 
                //$product_attributes_specification = \App\Models\ProductVariantSpecification::leftJoin("attribute_term", "attribute_term.id", "=", "product_variant_specifications.attribute_term_id")->where('product_variant_specifications.estatus',1)->where('is_dropdown',0)->where('product_variant_id',$vatid)->groupBy('attributes.id')->get();
                $str .='<div class="col-md-6 px-0">
                        <div class="wire_bangle_share wire_bangle_share_part row mt-2"> 
                            <span class="d-block col-6 col-sm-3 col-md-6 col-lg-3 ps-0">'.$product_attribute_specification->attribute_name .'</span>
                            <span class="wire_bangle_color_theme d-block col-6 col-sm-9 col-md-6 col-lg-9">'. strtolower($product_attribute_term_name) .'</span>
                        </div>
                    </div>'; 
                    
                $specificationstr .='<div class="mt-3 wire_bangle_share wire_bangle_share_part row ps-0"> 
                            <span class="d-block col-6 col-sm-3 col-md-6 col-lg-4 ps-0">'.$product_attribute_specification->attribute_name .'</span>
                            <span class="wire_bangle_color_theme d-block col-6 col-sm-9 col-md-6 col-lg-8">'. strtolower($product_attribute_term_name) .'</span>
                        </div>';    

                $variantstr .='<div class="d-flex align-items-center mb-4 col-md-6">
                    <span class="wire_bangle_color_heading  d-inline-block">'.$product_attribute_specification->attribute_name .' :</span>
                    <span class="ms-2 d-inline-block wire_bangle_color_heading ">'. $product_attribute_term_name .'</span>
                </div>';  
                
            }

            $ProductVariantSpecification = \App\Models\ProductVariantSpecification::with('attribute_terms')->leftJoin("attributes", "attributes.id", "=", "product_variant_specifications.attribute_id")->where('product_variant_specifications.estatus',1)->where('product_variant_id',$vatid)->where('is_specification',1)->where('is_dropdown',1)->groupBy('product_variant_specifications.attribute_id')->get();
                $spe = '';
                foreach($ProductVariantSpecification as $productvariants)
                {
                $spe .='<div class="me-4"> <div class="wire_bangle_color_heading mb-2">'.$productvariants->attribute->attribute_name.'</div><span class="wire_bangle_select mb-3 me-3 d-inline-block">
                            <select name="AtributeSpecification'.$productvariants->attribute->id.'" id="AtributeSpecification'.$productvariants->id.'" class="specification">
                            <option value="">-- Select '.$productvariants->attribute->attribute_name .' --</option>';   
                    
                    $product_attribute = \App\Models\ProductVariantSpecification::where('estatus',1)->where('attribute_id',$productvariants->attribute_id)->where('product_variant_id',$vatid)->groupBy('attribute_term_id')->get();
                        
                    foreach($product_attribute as $attribute_term){
                        $term_array = explode(',',$attribute_term->attribute_term_id);
                        $product_attributes = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id',$term_array)->get();
                        $v = 1;
                        foreach($product_attributes as $term){
                        $spe .='<option data-spe="'.$productvariants->attribute->attribute_name .'" data-term="'.$term->attrterm_name .'" value="'. $term->id .'">'.$term->attrterm_name .'</option>'; 
                        
                        }
                    }   
                $spe .='</select>
                    <div id="AtributeSpecification'.$productvariants->attribute->id.'-error" class="invalid-feedback animated fadeInDown mt-2" style="display: none;"></div>
                </span> </div>';
                }
    
                $images = '';
                if($result->images !=""){
                    $images = explode(',',$result->images);
                }
                $vimage = '';
                $vimage .='<div class="slider slider-single mb-5">'; 
                        foreach($images as $image){
                            $vimage .='<div class="product_slider_main_item">
                                            <img src="'.URL($image).'" alt="">
                                        </div>';
                        }
                $vimage .='</div>
                        <div class="slider slider-nav">';
                        foreach($images as $image){
                            $vimage .='<div class="product_slider_item">
                                <h3><img src="'.URL($image).'" alt=""></h3>
                            </div>';     
                        }   
                $vimage .='</div>';
    
            $spe_desc ='';
            $product_attributes_specification = \App\Models\ProductVariantSpecification::leftJoin("attributes", "attributes.id", "=", "product_variant_specifications.attribute_id")->where('product_variant_specifications.estatus',1)->where('is_dropdown',0)->where('is_description',1)->where('product_variant_id',$vatid)->groupBy('attributes.id')->get();
            foreach($product_attributes_specification as $product_attribute_specification){  
                $product_attribute_terms = explode(',',$product_attribute_specification->attribute_term_id);
                $product_attributes_term_val = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id', $product_attribute_terms)->get()->pluck('attrterm_name')->toArray();
                $product_attributes_term_des = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id', $product_attribute_terms)->get()->pluck('description')->toArray();
                $product_attribute_term_name = implode(' - ',$product_attributes_term_val);
            
            $spe_desc .='<div class="px-0 mt-4 pt-xl-2">
                    <div class="heading-h4 wire_diamond_heading pb-xxl-2">'.$product_attribute_specification->attribute_name .' '.$product_attribute_term_name .'</div>
                </div>
                <div class="row custom_product_detail">';
                foreach($product_attributes_term_des as $attrterm_description){  
                    $spe_desc .='<div class="col-md-6 mt-2 mt-md-0 px-0 position-relative custom_product_des">
                        <div class="">
                            <p class="wire_diamond_pargraph">'.$attrterm_description.'</p>
                        </div>
                    </div>';
                }
                $spe_desc .='</div>';
                }     
                $data = ['result' => $result,'speci' => $str,'specificationstr' => $specificationstr,'speci_multi' => $spe,'vimage' => $vimage,'spe_desc' => $spe_desc,'variantstr' => $variantstr ]; 
                return \Response()->json($data);
            
            }else{

                $data = ['result' => 'data not found']; 
                return \Response()->json($data);  

            }    

        }
    }


    public function fetchvariants(Request $request){
    $data = $request->all();
    $variants=$data["variant"];
    $terms_id=$data["terms_id"];
    
    $product_id=$data["product_id"];
        if(isset($data["action"]))
        {
            $product_attributes_variant_ids = \App\Models\ProductVariantVariant::where('attribute_term_id',$variants[0])->where('product_id',$product_id)->get()->pluck('product_variant_id');

            $variantmulti = '';
            $ProductVariantVariant = \App\Models\ProductVariantVariant::with('attribute','attribute_terms')->where('estatus',1)->whereIn('product_variant_id',$product_attributes_variant_ids)->groupBy('attribute_id')->get();
            foreach($ProductVariantVariant as $productvariants){
                if($productvariants->attribute_terms['0']->attrterm_thumb == ''){
           
         
            $variantmulti .='<div class="wire_bangle_color_heading mb-2">'.$productvariants->attribute->attribute_name .'</div>
            <div class="wire_bangle_carat">';
           
            $product_attribute = \App\Models\ProductVariantVariant::with('attribute_terms')->where('estatus',1)->where('attribute_id',$productvariants->attribute_id)->whereIn('product_variant_id',$product_attributes_variant_ids)->groupBy('attribute_term_id')->get();
            $iv = 1; 

            foreach($product_attribute as $attribute_term){
            $check = (in_array( $attribute_term->attribute_terms[0]->id , $terms_id)) ? "checked" : ""; 
            $variantmulti .='<span class="form-check d-inline-block position-relative me-2  ps-0 mb-3">
            <input class="form-check-input variant" '.$check.'  value="'. $attribute_term->attribute_terms[0]->id .'"  type="radio" name="AtributeVariant'. $productvariants->attribute->attribute_name .'" id="AtributeVariant'. $attribute_term->attribute_terms[0]->id .'">
            <label class="form-check-label wire_bangle_carat_label" for="AtributeVariant'.$attribute_term->attribute_terms[0]->id .'">
            '.$attribute_term->attribute_terms[0]->attrterm_name.'
                </label>
                </span>';
             $iv++;    
            }
            $variantmulti .='</div>';
            
            }
           }

        $variantmulti .='</div>';                        
        $data = ['variantmulti' => $variantmulti ]; 
        return \Response()->json($data);

        }
    }


      
    
}
