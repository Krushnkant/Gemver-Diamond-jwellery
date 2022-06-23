<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\ProductVariant;
use App\Models\ProductVariantVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Response;

class ProductController extends Controller
{
    public function index($id){
        $CatId = $id;
        $Products= Product::with('primary_category','product_variant')->where(['estatus' => 1])->get();
        $Categories = Category::where(['estatus' => 1])->get();
        $Attributes = Attribute::with('attributeterm')->where(['estatus' => 1,'is_filter' => 1])->get();
        $Maxprice = ProductVariant::max('sale_price');
        return view('frontend.shop',compact('Products','Categories','Attributes','Maxprice','CatId'));
    }

    public function product_detail($id){
        $Product= Product::with('primary_category','product_variant','product_variant_variants')->where(['estatus' => 1,'id' => $id])->first();
        return view('frontend.product',compact('Product'));
    }

    public function fetchproduct(Request $request){
        $data = $request->all();
       
        if(isset($data["action"]))
        {
           
            $attr = (isset($data["category"]) && $data["category"]) ? $data["category"]  : null;
            $query = Product::select('products.*','product_variants.images','product_variants.sale_price')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->leftJoin("product_variant_variants", "product_variant_variants.product_id", "=", "products.id")->leftJoin("product_variant_specifications", "product_variant_specifications.product_id", "=", "products.id")->where('products.estatus',1);
            
            // if($request->keyword){
            //     // This will only execute if you received any keyword
            //     $query = $query->where('name','like','%'.$keyword.'%');
            // }
            
            if($data["minimum_price"] && $data["maximum_price"]){
                $query = $query->where('product_variants.sale_price','>=',$data["minimum_price"]);
                $query = $query->where('product_variants.sale_price','<=',$data["maximum_price"]);
            }
            if(isset($data["category"])){
                $query = $query->where('primary_category_id',$data["category"]);
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
                $url =  URL('/product-details/'.$row->id);
                $output .= '
                <div class="col-sm-6 col-lg-4 col-xl-3 mt-3 mt-md-4">
                        <div class="wire_bangle_img mb-3 position-relative">
                            <img src="'.  $image  .'" alt="">

                        </div>
                        <div class="wire_bangle_description">

                            <div class="wire_bangle_heading mb-2 mb-md-3"><a href="'.$url.'">'.$row->primary_category->category_name .'</a></div>
                            <div class="wire_bangle_sub_heading mb-2 mb-md-3">'. $row->product_title .'</div>
                            <div class="wire_bangle_paragraph mb-2 mb-md-3">
                            '. $row->desc .'
                            </div>
                            <div class="wire_bangle_price">
                                $'. $sale_price .'
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


    public function fetchproductdetails(Request $request){
        $data = $request->all();
        $variants=$data["variant"];
        $product_id=$data["product_id"];
        if(isset($data["action"]))
        {
            $product_variants = ProductVariant::where('product_id',$product_id)->where('estatus',1)->get();
            $vatid = 0;
            foreach($product_variants as $product_variant){
                
                $product_variant_variants = ProductVariantVariant::where('product_variant_id',$product_variant->id)->where('estatus',1)->get()->pluck('attribute_term_id')->toArray();
                if($product_variant_variants == $variants){
                    $vatid = $product_variant->id;
                }
            }
            
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
                $variantstr .='<div class="d-flex align-items-center mb-4 col-md-4">
                                    <span class="wire_bangle_color_heading  d-inline-block">'.$product_attribute_variant->attribute_name .' :</span>
                                    <span class="ms-2 d-inline-block wire_bangle_color_heading ">'. $product_attribute_term_name .'</span>
                                </div>';
            }

            $product_attributes_specification = \App\Models\ProductVariantSpecification::leftJoin("attributes", "attributes.id", "=", "product_variant_specifications.attribute_id")->where('product_variant_specifications.estatus',1)->where('is_dropdown',0)->where('product_variant_id',$vatid)->groupBy('attributes.id')->get();
            $str = '';
           
            foreach($product_attributes_specification as $product_attribute_specification){ 
                $product_attribute_terms = explode(',',$product_attribute_specification->attribute_term_id);
                $product_attributes_term_val = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id', $product_attribute_terms)->get()->pluck('attrterm_name')->toArray();
                $product_attribute_term_name = implode(' - ',$product_attributes_term_val); 
                //$product_attributes_specification = \App\Models\ProductVariantSpecification::leftJoin("attribute_term", "attribute_term.id", "=", "product_variant_specifications.attribute_term_id")->where('product_variant_specifications.estatus',1)->where('is_dropdown',0)->where('product_variant_id',$vatid)->groupBy('attributes.id')->get();
                $str .='<div class="col-md-6 px-0" >
                        <div class="mt-4 wire_bangle_share">
                        '.$product_attribute_specification->attribute_name .' &nbsp;:&nbsp;
                            <span class="wire_bangle_color_theme">'. $product_attribute_term_name .'</span>
                        </div>
                    </div>';

                $variantstr .='<div class="d-flex align-items-center mb-4 col-md-4">
                    <span class="wire_bangle_color_heading  d-inline-block">'.$product_attribute_specification->attribute_name .' :</span>
                    <span class="ms-2 d-inline-block wire_bangle_color_heading ">'. $product_attribute_term_name .'</span>
                </div>';  
                
            }

            $ProductVariantSpecification = \App\Models\ProductVariantSpecification::with('attribute_terms')->leftJoin("attributes", "attributes.id", "=", "product_variant_specifications.attribute_id")->where('product_variant_specifications.estatus',1)->where('product_variant_id',$vatid)->where('is_specification',1)->where('is_dropdown',1)->groupBy('product_variant_specifications.attribute_id')->get();
            $spe = '';
            foreach($ProductVariantSpecification as $productvariants)
            {

            $spe .='<span class="wire_bangle_select mb-3 me-3">
                      <select name="AtributeSpecification'.$productvariants->attribute->id.'" id="AtributeSpecification'.$productvariants->id.'" class="specification">
                        <option value="">-- '.$productvariants->attribute->attribute_name .'--</option>';   
               
                $product_attribute = \App\Models\ProductVariantSpecification::where('estatus',1)->where('attribute_id',$productvariants->attribute_id)->where('product_variant_id',$vatid)->groupBy('attribute_term_id')->get();
                    
                foreach($product_attribute as $attribute_term){
                    $term_array = explode(',',$attribute_term->attribute_term_id);
                    $product_attributes = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id',$term_array)->get();
                    $v = 1;
                    foreach($product_attributes as $term){
                    $spe .='<option value="'. $term->id .'">'.$term->attrterm_name .'</option>'; 
                    
                   }
                }   
            $spe .='</select>
            </span>';
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
        
        $spe_desc .='<div class="px-3 mt-5">
                <h2 class="heading-h4">'.$product_attribute_specification->attribute_name .' '.$product_attribute_term_name .'</h2>
            </div>
            <div class="row">';
            foreach($product_attributes_term_des as $attrterm_description){  
                $spe_desc .='<div class="col-md-6 mt-4 mt-md-0 px-0 px-md-3 position-relative ">
                    <div>
                        <p>'.$attrterm_description.'</p>
                    </div>
                </div>';
            }
            $spe_desc .='</div>';
            }
       
            $data = ['result' => $result,'speci' => $str,'speci_multi' => $spe,'vimage' => $vimage,'spe_desc' => $spe_desc,'variantstr' => $variantstr ]; 
            return \Response()->json($data);

        }
    }


      
    
}
