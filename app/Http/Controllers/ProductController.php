<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Diamond;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\ProductVariant;
use App\Models\ProductAttribute;
use App\Models\ProductVariantVariant;
use App\Models\OrderIncludes;
use App\Models\Settings;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Response;

class ProductController extends Controller
{
    public function index($id=0)
    {
        $CatId = getSlugId('Category',$id);
        $Category = Category::where(['id' => $CatId])->first();
        
        $Products= Product::where(['estatus' => 1,'is_custom' => 0])->get();
        if($id != ""){
            if($Category->parent_category_id == 0){
          
                $Categories = Category::where(['estatus' => 1,'is_custom' => 0])->where('parent_category_id',$Category->id)->orwhere('id',$Category->id)->get();
            }else{
                $Categories = Category::where(['estatus' => 1,'is_custom' => 0,'parent_category_id' => $Category->parent_category_id])->get();
            }
        }else{
            $Categories = Category::where(['estatus' => 1,'is_custom' => 0])->get();
        }
      
        $Attributes = Attribute::with('attributeterm')->where(['estatus' => 1,'is_filter' => 1])->get();
        $Maxprice = ProductVariant::max('sale_price');
        $Maxprice = ceil($Maxprice / 100) * 100;
        
        $meta_title = isset($Category->meta_title)?$Category->meta_title:"";
        $meta_description = isset($Category->meta_description)?$Category->meta_description:"";
        return view('frontend.shop',compact('Products','Categories','Attributes','Maxprice','CatId','Category'))->with(['meta_title'=>$meta_title,'meta_description'=>$meta_description]);
    }

    public function product_detail($variantslug)
    {
        $variantid = getSlugId('ProductVariant',$variantslug);
        $attribute_term_ids = ProductVariantVariant::where('product_variant_id',$variantid)->where('estatus',1)->get()->pluck('attribute_term_id')->toArray();
        $Product = Product::select('products.id','products.meta_title','products.meta_description','products.product_title','products.primary_category_id','product_variants.slug','product_variants.alt_text','product_variants.images','product_variants.regular_price','product_variants.sale_price','product_variants.id as variant_id','size_charts.thumb as sizechart_image')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->leftJoin("size_charts", "size_charts.id", "=", "products.sizechart_id")->where(['product_variants.id' => $variantid,'products.estatus' => 1,'product_variants.estatus' => 1])->first();
        $primary_category_idss = array();
        $primary_category_ids = explode(',',$Product->primary_category_id);
        foreach($primary_category_ids as $primary_category_id){
            $primary_category_idss[] = (int)$primary_category_id;
        }
        //$primary_category_ids = implode(',',$primary_category_idss);
        //$ProductRelated= Product::select('products.id','products.product_title','products.primary_category_id','product_variants.slug','product_variants.alt_text','product_variants.images','product_variants.regular_price','product_variants.sale_price','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->where(['products.is_custom' => 0,'products.estatus' => 1,'product_variants.estatus' => 1,'product_variants.term_item_id' => 2])->WhereIn('primary_category_id',$primary_category_idss)->where('products.id','<>',$Product->id)->groupBy('products.id')->limit(8)->get();
        //$OrderIncludes= OrderIncludes::with('OrderIncludesData')->where(['estatus' => 1])->first();
        $settings = Settings::first();
        $meta_title = isset($Product->meta_title)?$Product->meta_title:"";
        $meta_description = isset($Product->meta_description)?$Product->meta_description:"";
        return view('frontend.product',compact('Product','variantid','attribute_term_ids','settings','primary_category_idss'))->with(['meta_title'=>$meta_title,'meta_description'=>$meta_description,'title'=>$Product->product_title]);
    }

    public function fetchproduct(Request $request){
        $data = $request->all();
        if(isset($data["action"]))
        {
           
            //$attr = (isset($data["category"]) && $data["category"]) ? $data["category"]  : null;
            //\DB::enableQueryLog(); 
            $query = Product::select('products.id','products.product_title','products.primary_category_id','product_variants.slug','product_variants.alt_text','product_variants.images','product_variants.regular_price','product_variants.sale_price','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->leftJoin("product_attributes", "product_attributes.product_id", "=", "products.id")->where(['products.is_custom' => 0,'products.estatus' => 1,'product_variants.estatus' => 1,'product_variants.term_item_id' => 2]);
            
            if(isset($request->keyword) && $request->keyword != ""){
                // This will only execute if you received any keyword
                $query = $query->where('products.product_title','LIKE','%'.$request->keyword.'%');
                $query = $query->where('products.desc','LIKE','%'.$request->keyword.'%');
            }
            
            if($data["minimum_price"] && $data["maximum_price"]){
                $query = $query->where('product_variants.sale_price','>=',$data["minimum_price"]);
                $query = $query->where('product_variants.sale_price','<=',$data["maximum_price"]);
            }

            if($data["minimum_price_input"] && $data["maximum_price_input"]){
                $query = $query->where('product_variants.sale_price','>=',$data["minimum_price_input"]);
                $query = $query->where('product_variants.sale_price','<=',$data["maximum_price_input"]);
            }elseif (!empty($data["minimum_price_input"])) {
                $query = $query->where('product_variants.sale_price', '>=', $data["minimum_price_input"]);
            }elseif (!empty($data["maximum_price_input"])) {
                $query = $query->where('product_variants.sale_price', '<=', $data["maximum_price_input"]);
            }
            //dd($data["category"][0]);
            if(isset($data["category"])){
                $cat_id = $data["category"];
                //$query = $query->where('primary_category_id',$data["category"][0]);
                //$query = $query->WhereRaw("FIND_IN_SET($cat_id, primary_category_id)");
                $query = $query->where(function($q) use($cat_id){
                    foreach($cat_id as $key=>$c){
                        if ($key == 0) {
                            $q = $q->whereRaw('FIND_IN_SET(' . $c . ',primary_category_id)');
                        } else {
                            $q = $q->orWhere(function ($query1) use ($c){
                                $query1->whereRaw('FIND_IN_SET(' . $c . ',primary_category_id)');
                            });
                        }
                    }
                });
            }
            
            if(isset($data["attribute"])){
                $attribute=$data["attribute"];
               $query = $query->where(function($q) use($attribute){
                foreach($attribute as $key=>$c){
                    if ($key == 0) {
                        $q = $q->whereRaw('FIND_IN_SET(' . $c . ',product_attributes.terms_id)');
                    } else {
                        $q = $q->orWhere(function ($query1) use ($c){
                            $query1->whereRaw('FIND_IN_SET(' . $c . ',product_attributes.terms_id)');
                        });
                    }
                }
               });
            }

            if(isset($data["selectattribute"])){
                $selectattribute=$data["selectattribute"];
               $query = $query->where(function($q) use($selectattribute){
                foreach($selectattribute as $key=>$c){
                    if ($key == 0) {
                        $q = $q->whereRaw('FIND_IN_SET(' . $c . ',product_attributes.terms_id)');
                    } else {
                        $q = $q->orWhere(function ($query1) use ($c){
                            $query1->whereRaw('FIND_IN_SET(' . $c . ',product_attributes.terms_id)');
                        });
                    }
                }
               });
            }

            if(isset($data["specification"])){
                $specification=$data["specification"];
                $query = $query->where('product_variant_specifications.attribute_term_id',$specification);
                $query = $query->where('product_variant_specifications.estatus',1);
            }
            $result_total = $query->groupBy('products.id')->get();
           
             if(isset($data["sorting"])){ 
                if($data["sorting"]== "date")   
                {
                    $query = $query->orderBy('products.created_at','DESC')->groupBy('products.id')->paginate(8);  
                }
                else if($data["sorting"] == "price")
                {
                    $query = $query->orderBy('product_variants.sale_price','ASC')->groupBy('products.id')->paginate(8); 
                }
                else if($data["sorting"]=="price-desc")
                {
                    $query = $query->orderBy('product_variants.sale_price','DESC')->groupBy('products.id')->paginate(8); 
                }else{
                    $query = $query->orderBy('products.created_at','ASC')->groupBy('products.id')->paginate(8);  
                }
           }else{
               
            $query = $query->orderBy('products.created_at','ASC')->groupBy('products.id')->paginate(8);
           }
          // dd(\DB::getQueryLog());
           //$result = $query->groupBy('products.id')->paginate(12);
            $output = '';
            if(count($query) > 0){
            foreach($query as $row)
            {
                $supported_image = array('jpg','jpeg','png');
                $images = explode(",",$row->images);
                $image = URL($images['0']);

                $alt_text = "";
              
                if($row->alt_text != ""){
                    $alt_texts = explode(",",$row->alt_text);
                    $alt_text = $alt_texts['0'];
                }
                
                $ext = pathinfo($image, PATHINFO_EXTENSION); 
                $sale_price = $row->sale_price;
                $url =  URL('/product-details/'.$row->slug);
                $output .= '
                <div class="col-sm-6 col-lg-4 col-xl-3 mt-3 mt-md-4 hover_effect_part wire_bangle_shop_radio">
                    <div class="wire_bangle_img_radio_button">
                        <div class="wire_bangle_img mb-3 position-relative">
                            <a class="wire_bangle_hover_a" href="'.$url.'">
                            
                               '; 
                               if(in_array($ext, $supported_image)) {
                                $output .=  '<img src="'.  $image  .'" alt="'.$alt_text.'" class="main-product-image-'.$row->id.'">';
                               }else{
                                $image2 = URL($images['1']);
                                $output .=  '<img src="'.  $image2  .'" alt="'.$alt_text.'" class="main-product-image-'.$row->id.'">';
                               }
                            $output .=  '</a>
                        </div><div class="text-center">';
                        $image_no = 1;
                        foreach($images as $key => $image){
                            $alt_text = "";
                            if($row->alt_text != ""){
                                $alt_texts = explode(",",$row->alt_text);
                                $alt_text = $alt_texts[$key];
                            }
                            
                        if($image_no <= 3){ 
                        $ext = pathinfo($image, PATHINFO_EXTENSION); 
                        if(in_array($ext, $supported_image)) {     
                        $output .= '<span class="form-check d-inline-block ">
                            <a href="">
                            
                            <img src="'.URL($image) .'" style="width:40px; height: 40px;" alt="'.$alt_text.'" data-id="'.$row->id.'" class="wire_bangle_color_img pe-auto product-image ">
                            </a>
                            <div class="wire_bangle_color_input_label"></div>
                        </span>';
                        }
                        }
                        $image_no++;
                        }
                        $output .= ' </div><div class="wire_bangle_description p-3">';
                        
                            $output .= '<div class="wire_bangle_heading mb-2">'.$row->primary_category->category_name .'
                            <input type="hidden" class="variant_id" value="'. $row->variant_id .'">    
                            <input type="hidden" class="item_type" value="0">    
                            <span type="button" class="btn btn-default add-to-wishlist-btn" data-toggle="tooltip" data-placement="right" title="Wishlist">';
                           
                            if(is_wishlist($row->variant_id,0)){    
                                $output .= ' <i class="fas fa-heart heart-icon-part"></i>';
                             }else{ 
                                $output .= ' <i class="far fa-heart"></i> ';
                            }
                            $output .= '</span>
                            
                            </div>
                            <div class="wire_bangle_sub_heading wire_bangle_description"><a href="'.$url.'">'. $row->product_title .'</a></div>
                            <div class="d-flex justify-content-between pt-2 align-items-center">
                                <div class="d-flex align-items-center">
                                <span class="wire_bangle_price wire_bangle_price_part">
                                $'.$sale_price .'</span>';
                                if($row->regular_price != ""){
                                $output.='<span class="ms-2 wire_bangle_dublicate_price product_detail_regular_price">$<span class="regular_price">'. $row->regular_price .'</span></span>';
                                }
                                $output.='</div>';

                                $ProductVariantVariant = \App\Models\ProductVariantVariant::with('attribute','attribute_terms')->where('estatus',1)->where('product_id',$row->id)->groupBy('attribute_id')->get();
                                foreach($ProductVariantVariant as $productvariants){
                                if($productvariants->attribute_terms['0']->attrterm_thumb != ''){
                            
                                $output .= '<span class="wire_bangle_color mb-xxl-0 wire_bangle_color_img_part text-center wire_bangle_color_ring_part d-inline-block"><div class="wire_bangle_color_part">';
                                
                                    $product_attribute = \App\Models\ProductVariantVariant::with('attribute_terms','product_variant')->where('estatus',1)->where('attribute_id',$productvariants->attribute_id)->where('product_id',$row->id)->groupBy('attribute_term_id')->get();
                                    $ia = 1;
                                    
                                    foreach($product_attribute as $attribute_term){
 
                                        $attributeurl =  URL('product-details/'.$attribute_term->product_variant->slug); 
                                    
                                         $output .= '<span class="form-check d-inline-block">
                                            <a href="'.$attributeurl.'">
                                            
                                            <img src="'. url('images/attrTermThumb/'.$attribute_term->attribute_terms[0]->attrterm_thumb) .'" alt="'.$attribute_term->attribute_terms[0]->display_attrname .'"  class="wire_bangle_color_img pe-auto">
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
                $output .= '';  
            } 
            $data = ['output' => $output,'datacount' => count($result_total)];   
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
      
        $variants=$data["variant"];
        $product_id=$data["product_id"];
        $supported_image = array(
            'jpg',
            'jpeg',
            'png'
        ); 
        if(isset($data["action"]))
        {
            $product_variants = ProductVariant::where('product_id',$product_id)->where('estatus',1)->get();
            
            $vatid = 0;
            foreach($product_variants as $product_variant){
                asort($variants);
                $product_variant_variants = ProductVariantVariant::where('product_variant_id',$product_variant->id)->where('estatus',1)->get()->pluck('attribute_term_id')->toArray();
                asort($product_variant_variants); 
                $result = array_diff($product_variant_variants,$variants);
               
                //if($product_variant_variants == sort($variants)){
                if(count($result) <= 0){    
                    $vatid = $product_variant->id;  
                }
            }
            //echo $vatid; die;
            if($vatid != 0){
               
            $query = Product::select('products.*','product_variants.slug','product_variants.alt_text','product_variants.images','product_variants.regular_price','product_variants.sale_price','product_variants.auto_discount_percent','product_variants.regular_price','product_variants.SKU','product_variants.id as variant_id','product_variants.product_rating')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->where('products.estatus',1);
            
            if($vatid > 0){
                $query = $query->where('product_variants.id',$vatid);
            }
            $result = $query->orderBy('products.created_at','ASC')->first();

            $product_attributes_variant = \App\Models\ProductVariantVariant::leftJoin("attributes", "attributes.id", "=", "product_variant_variants.attribute_id")->where('product_variant_variants.estatus',1)->where('product_variant_id',$vatid)->groupBy('attributes.id')->get();
            $variantstr = '';
            $specificationstr123 = '';
            foreach($product_attributes_variant as $product_attribute_variant){ 
                $product_attribute_terms = explode(',',$product_attribute_variant->attribute_term_id);
                $product_attributes_term_val = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id', $product_attribute_terms)->get()->pluck('attrterm_name')->toArray();
                $product_attribute_term_name = implode(' - ',$product_attributes_term_val); 
                $variantstr .='<div class="d-flex align-items-center mb-1 mb-md-2 col-md-6 px-0">
                                    <span class="wire_bangle_color_heading  d-inline-block">'.$product_attribute_variant->display_attrname .' :</span>
                                    <span class="ms-2 d-inline-block wire_bangle_color_heading ">'. $product_attribute_term_name .'</span>
                                </div>';

                $specificationstr123 .='<div class="col-xl-6 px-0" >
                <div class="mt-4 wire_bangle_share row">
                    <span class="col-5 col-sm-3 col-xl-3 ps-0 wire_bangle_heading_part_1">'.$product_attribute_variant->display_attrname .' </span>
                    <span class="wire_bangle_color_theme col-7 col-sm-9 col-xl-9">'. $product_attribute_term_name .'</span>
                </div>
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
                            <span class="d-block col-6 col-sm-3 col-md-6 col-lg-3 ps-0">'.$product_attribute_specification->display_attrname .'</span>
                            <span class="wire_bangle_color_theme d-block col-6 col-sm-9 col-md-6 col-lg-9">'. strtolower($product_attribute_term_name) .'</span>
                        </div>
                    </div>'; 
                    
                $specificationstr .='<div class="mt-3 wire_bangle_share wire_bangle_share_part row ps-0"> 
                            <span class="d-block col-6 col-sm-3 col-md-4 ps-0 wire_bangle_heading_part_1">'.$product_attribute_specification->display_attrname .'</span>
                            <span class="wire_bangle_color_theme d-block col-6 col-sm-9 col-md-8">'. strtolower($product_attribute_term_name) .'</span>
                        </div>';    

                $variantstr .='<div class="d-flex align-items-center mb-4 col-md-6">
                    <span class="wire_bangle_color_heading  d-inline-block">'.$product_attribute_specification->display_attrname .' :</span>
                    <span class="ms-2 d-inline-block wire_bangle_color_heading ">'. $product_attribute_term_name .'</span>
                </div>';  
                
            }

            $ProductVariantSpecification = \App\Models\ProductVariantSpecification::with('attribute_terms')->leftJoin("attributes", "attributes.id", "=", "product_variant_specifications.attribute_id")->where('product_variant_specifications.estatus',1)->where('product_variant_id',$vatid)->where('is_specification',1)->where('is_dropdown',1)->groupBy('product_variant_specifications.attribute_id')->get();
                $spe = '';
                foreach($ProductVariantSpecification as $productvariants)
                {
                $spe .='<div class="me-4"> <div class="wire_bangle_color_heading mb-2">'.$productvariants->attribute->display_attrname.'</div><span class="wire_bangle_select mb-3 me-3 d-inline-block">
                            <select name="AtributeSpecification'.$productvariants->attribute->id.'" id="AtributeSpecification'.$productvariants->id.'" class="specification">
                            <option value="">-- Select '.$productvariants->attribute->display_attrname .' --</option>';   
                    
                    $product_attribute = \App\Models\ProductVariantSpecification::where('estatus',1)->where('attribute_id',$productvariants->attribute_id)->where('product_variant_id',$vatid)->groupBy('attribute_term_id')->get();
                        
                    foreach($product_attribute as $attribute_term){
                        $term_array = explode(',',$attribute_term->attribute_term_id);
                        $product_attributes = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id',$term_array)->get();
                        $v = 1;
                        foreach($product_attributes as $term){
                        $spe .='<option data-spe="'.$productvariants->attribute->display_attrname .'" data-term="'.$term->attrterm_name .'" value="'. $term->id .'">'.$term->attrterm_name .'</option>'; 
                        
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
                        foreach($images as $key => $image){
                            $alt_text = "";
                            if($result->alt_text != ""){
                                $alt_texts = explode(",",$result->alt_text);
                                $alt_text = $alt_texts[$key];
                            }
                            $ext = pathinfo($image, PATHINFO_EXTENSION); 
                            if(in_array($ext, $supported_image)) {
                                $vimage .='<div class="product_slider_main_item">
                                                <img src="'.URL($image).'" alt="'.$alt_text.'">
                                            </div>';
                            }else{
                                $vimage .='<div class="product_slider_main_item">
                                                <video cloop="true" autoplay="autoplay" style="width:100%; height:500px;" name="media"><source src="'. URL($image) .'" type="video/mp4" alt="'.$alt_text.'></video>
                                            </div>';

                            }            
                        }
                $vimage .='</div>
                        <div class="slider slider-nav">';
                        foreach($images as $key => $image){
                            $alt_text = "";
                            if($result->alt_text != ""){
                                $alt_texts = explode(",",$result->alt_text);
                                $alt_text = $alt_texts[$key];
                            }
                            $ext = pathinfo($image, PATHINFO_EXTENSION);
                            if(in_array($ext, $supported_image)) {
                            $vimage .='<div class="product_slider_item">
                                        <h3><img src="'.URL($image).'" alt="'.$alt_text.'"></h3>
                                    </div>';  
                            }else{
                            $vimage .='<div class="product_slider_item">
                                 <img src="'.URL('frontend/image/video-play.png').'" alt="'.$alt_text.'">
                            </div>';    
                            }   
                        }   
                $vimage .='</div>';
    
            $spe_desc ='';
            $product_attributes_specification = \App\Models\ProductAttribute::leftJoin("attributes", "attributes.id", "=", "product_attributes.attribute_id")->where('is_dropdown',0)->where('is_description',1)->where('product_id',$product_id)->groupBy('attributes.id')->get();
            foreach($product_attributes_specification as $product_attribute_specification){ 
                //dd($product_attribute_specification->terms_id); 
                $product_attribute_terms = explode(',',$product_attribute_specification->terms_id);
                $product_attributes_term_val = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id', $product_attribute_terms)->get()->pluck('attrterm_name')->toArray();
                $product_attributes_term_des = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id', $product_attribute_terms)->get()->pluck('description')->toArray();
                $product_attribute_term_name = implode(' - ',$product_attributes_term_val);
                
                $spe_desc .='<div class="px-0 mt-4 pt-xl-2">
                    <div class="heading-h4 wire_diamond_heading pb-xxl-2">'.$product_attribute_specification->display_attrname .' '.$product_attribute_term_name .'</div>
                </div>
                <div class="row custom_product_detail">';
                foreach($product_attributes_term_des as $attrterm_description){  
                    $spe_desc .='<div class="col-md-6 mt-3 px-0 position-relative custom_product_des">
                        <div class="">
                            <p class="wire_diamond_pargraph">'.$attrterm_description.'</p>
                        </div>
                    </div>';
                }
                $spe_desc .='</div>';
                }
                
                $product_reviews = Review::where('status',1)->where('type',0)->where('item_id',$vatid)->orderBy('id', 'DESC')->limit(6)->get();
                //dd($product_reviews);
                $review = '';
                if(count($product_reviews) > 0){
             
                    foreach($product_reviews as $product_review){
                            
                    $review .=  '<div class="col-md-6 mb-4 ps-0 pe-0 pe-md-3">
                                    <div class="review_box">
                                        <div class="row">
                                            <div class="col-6 ps-0 review_heading">
                                                '.$product_review->reviewer.'
                                            </div>
                                            <div class="col-6 text-end review_star pe-0">';
                                            for($x = 1; $x <= 5; $x++){
                                                if($x <= $product_review->rating){
                                                    $review .= '<i class="fa-solid fa-star"></i>';
                                                }else{
                                                    $review .= '<i class="fa-regular fa-star"></i>';
                                                }
                                            } 
                                            
                                            $review .= '</div>
                                        </div>
                                        <div class="review_description_paragraph">
                                           '.$product_review->description.'
                                        </div>
                                        <div class="review_thumb_part mt-3">';
                                        $review_images = explode(',',$product_review->review_imgs);
                                        foreach($review_images as $review_image){
                                                
                                            $review .=  '<img src='. url($review_image) .' id="inquiry_image" alt="" class="review_thumb_part_img">'; 
                                               
                                        } 

                            $review .=  '</div>
                                    </div>
                                </div>';
                               $last_id   =$product_review->id;
                            
                    }
                $review .=  '
                <div class="text-end">
                    <button type="button" class="btn show_more_btn" data-id="'.$last_id.'" id="load_more_button">Show more</button>
                </div>';
                }

                $data = ['result' => $result,'speci' => $str,'specificationstr' => $specificationstr,'speci_multi' => $spe,'vimage' => $vimage,'spe_desc' => $spe_desc,'variantstr' => $variantstr,'specificationstr123' => $specificationstr123,'review_list' => $review ]; 
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
           
         
            $variantmulti .='<div class="wire_bangle_color_heading mb-2">' .$productvariants->attribute->display_attrname .'</div>
            <div class="wire_bangle_carat">';
           
            $product_attribute = \App\Models\ProductVariantVariant::with('attribute_terms')->where('estatus',1)->where('attribute_id',$productvariants->attribute_id)->whereIn('product_variant_id',$product_attributes_variant_ids)->groupBy('attribute_term_id')->get();
            $iv = 1; 

            foreach($product_attribute as $attribute_term){
            $check = (in_array( $attribute_term->attribute_terms[0]->id , $terms_id)) ? "checked" : ""; 
            $variantmulti .='<span class="form-check d-inline-block position-relative me-2  ps-0 mb-3">
            <input class="form-check-input variant" '.$check.'  value="'. $attribute_term->attribute_terms[0]->id .'"  type="radio" name="AtributeVariant'. $productvariants->attribute->display_attrname .'" id="AtributeVariant'. $attribute_term->attribute_terms[0]->id .'">
            <label class="form-check-label wire_bangle_carat_label" for="AtributeVariant'.$attribute_term->attribute_terms[0]->id .'">
            '.$attribute_term->attribute_terms[0]->display_attrname.'
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


    public function search_products(Request $request){
        $data = $request->all();
        
        if(isset($data["action"]))
        {
            $output = '';
            if(isset($data["keyword"]) && $data["keyword"]){
                $query = Product::select('products.*','product_variants.slug','product_variants.images','product_variants.regular_price','product_variants.sale_price','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->where(['products.is_custom' => 0,'products.estatus' => 1,'product_variants.estatus' => 1]);
                
                // if($request->keyword){
                //     // This will only execute if you received any keyword
                //     $query = $query->where('name','like','%'.$keyword.'%');
                // }
                
                $query = $query->where('products.product_title','LIKE','%'.$request->keyword.'%');
                $query = $query->orwhere('products.desc','LIKE','%'.$request->keyword.'%');
                

                $result_total = $query->orderBy('products.created_at','DESC')->groupBy('products.id')->get();
                $result = $query->orderBy('products.created_at','ASC')->groupBy('products.id')->paginate(15);;
            
                
                if(count($result) > 0){
                    foreach($result as $row)
                    {
                        $supported_image = array(
                            'jpg',
                            'jpeg',
                            'png'
                        );

                        $images = explode(",",$row->images);
                        $image = URL($images['0']);
                        
                        $ext = pathinfo($image, PATHINFO_EXTENSION);
                        $url =  URL('/product-details/'.$row->slug);
                        $output .= '

                        <li class="">
                            <a href="'.$url.'" class="header-mega-menu-part">
                            <div class="d-flex">
                                    <span>
                                        <img src="'.$image.'" alt="">
                                    </span>
                                    <span class="ms-3">
                                        <div class="product_name"> 
                                            '.$row->product_title.'
                                        </div>
                                        <div class="product_price">
                                            $ '.$row->sale_price.'
                                        </div>
                                    </span>
                                </div>
                            </a>
                        </li>
                    
                    ';
                    }
                
                }else{
                    $output .= '';  
                } 
            }else{
                $output .= '';
            } 
            
            
            if(isset($data["keyword"]) && $data["keyword"]){
                $query = Diamond::where('short_title','LIKE','%'.$request->keyword.'%');
                $query = $query->orwhere('long_title','LIKE','%'.$request->keyword.'%');
                $query = $query->orwhere('Stone_No','LIKE','%'.$request->keyword.'%');
                $result = $query->orderBy('created_at','ASC')->paginate(15);
            
                
                if(count($result) > 0){
                    foreach($result as $row)
                    {
                        if($row->Stone_Img_url != ""){
                            $image = $row->Stone_Img_url;
                        }else{
                            $image = url('images/placeholder_image.png');  
                        }

                        $url =  URL('labdiamond-details/'.$row->slug);
                        $output .= '

                        <li class="">
                            <a href="'.$url.'" class="header-mega-menu-part">
                            <div class="d-flex">
                                    <span>
                                        <img src="'.$image.'" alt="">
                                    </span>
                                    <span class="ms-3">
                                        <div class="product_name"> 
                                            '.$row->short_title.'
                                        </div>
                                        <div class="product_price">
                                            $ '.$row->Sale_Amt.'
                                        </div>
                                    </span>
                                </div>
                            </a>
                        </li>
                    
                    ';
                    }
                
                }else{
                    $output .= '';  
                } 
            }else{
                $output .= '';
            } 
            return $output;
        }
    }    
    
}
