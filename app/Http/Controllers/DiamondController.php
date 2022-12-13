<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Diamond;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\OrderIncludes;
use App\Models\ProductVariant;
use App\Models\ShopByStyle;
use App\Models\Settings;
use App\Models\StepPopup;
use App\Models\ProductVariantVariant;
use Illuminate\Http\Request;

class DiamondController extends Controller
{
    public function index($slug,$shopbyid = 0){
        $Category = Category::where(['estatus' => 1,'slug'=>$slug])->first();
        $id = $Category->id;
        $ip_address = \Request::ip();
        $cart = Cart::where(['ip_address'=>$ip_address,'category_id'=>$id])->first();
        $check_variant = 0;
        $check_variant_id = 0;
        $ProductVariantPrice = 0;
        if($cart){
            if($cart->variant_id != 0 &&  $cart->diamond_id != 0){
                return redirect('product_complete/'.$id); 
            }else{
                if($cart->variant_id != 0){
                    $check_variant = 1;
                    $check_variant_id = $cart->variant_id;
                    $ProductVariantPrices = ProductVariant::where(['estatus' => 1,'id' => $check_variant_id])->first();
                    if($ProductVariantPrices){
                        $ProductVariantPrice =  $ProductVariantPrices->sale_price;
                    }

                }
            }
        }else{
            $cart = Cart::where(['ip_address'=>$ip_address]);
            $cart->delete();
        }
        $CatId = $id;
        $ShopBy = ShopByStyle::where(['estatus' => 1,'id' => $shopbyid])->first();
        
        $Category = Category::where(['estatus' => 1,'id'=>$id])->first();
        $Attributes = Attribute::with('attributeterm')->where(['estatus' => 1,'is_filter' => 1])->get();
        $Maxprice = Diamond::max('Sale_Amt');
        $Maxprice = ceil($Maxprice / 100) * 100;
        $MaxCarat = Diamond::max('Weight');
        $MaxDepth = Diamond::max('Total_Depth_Per');
        $MaxDepth = ceil($MaxDepth / 10) * 10;
        $MaxRatio = Diamond::max('Ratio');
        $MaxTable = Diamond::max('Table_Diameter_Per');
        $MaxTable = ceil($MaxTable / 10) * 10;
        $diamondshape = Diamond::whereNotNull('Shape')->Where('Shape','<>','')->groupBy('Shape')->pluck('Shape');
        $diamondcolor = Diamond::whereNotNull('Color')->Where('Color','<>','')->groupBy('Color')->pluck('Color');
        $diamondclarity = Diamond::whereNotNull('Clarity')->Where('Clarity','<>','')->groupBy('Clarity')->pluck('Clarity');
        $diamondcut = Diamond::whereNotNull('Cut')->Where('Cut','<>','')->groupBy('Cut')->pluck('Cut');
        $diamondpolish = Diamond::whereNotNull('Polish')->Where('Polish','<>','')->groupBy('Polish')->pluck('Polish');
        $diamondsymm = Diamond::whereNotNull('Symm')->Where('Symm','<>','')->groupBy('Symm')->pluck('Symm');
        $diamondreport = Diamond::groupBy('Lab')->pluck('Lab');
        $StepPopup = StepPopup::where(['category_id'=>$id])->get();
        return view('frontend.diamond',compact('Category','Attributes','Maxprice','CatId','check_variant','check_variant_id','ShopBy','MaxCarat','diamondshape','diamondcolor','diamondclarity','diamondcut','diamondreport','MaxDepth','MaxRatio','MaxTable','diamondpolish','diamondsymm','ProductVariantPrice','StepPopup'));
    } 

    public function getDiamonds(Request $request)
    {
        $data = $request->all();
        \DB::enableQueryLog();
        $query = Diamond::where('estatus',1);

        
        if($data["minimum_price"] && $data["maximum_price"]){
            $query = $query->where('Sale_Amt','>=',$data["minimum_price"]);
            $query = $query->where('Sale_Amt','<=',$data["maximum_price"]);
        }

        if($data["minimum_price_input"] && $data["maximum_price_input"]){
            $query = $query->where('Sale_Amt','>=',$data["minimum_price_input"]);
            $query = $query->where('Sale_Amt','<=',$data["maximum_price_input"]);
        }elseif (!empty($data["minimum_price_input"])) {
            $query = $query->where('Sale_Amt', '>=', $data["minimum_price_input"]);
        }elseif (!empty($data["maximum_price_input"])) {
            $query = $query->where('Sale_Amt', '<=', $data["maximum_price_input"]);
        }

        if($data["minimum_carat"] && $data["maximum_carat"]){
            $query = $query->where('Weight','>=',$data["minimum_carat"]);
            $query = $query->where('Weight','<=',$data["maximum_carat"]);
        }

        if($data["minimum_carat_input"] && $data["maximum_carat_input"]){
            $query = $query->where('Weight','>=',$data["minimum_carat_input"]);
            $query = $query->where('Weight','<=',$data["maximum_carat_input"]);
        }elseif (!empty($data["minimum_carat_input"])) {
            $query = $query->where('Weight', '>=', $data["minimum_carat_input"]);
        }elseif (!empty($data["maximum_carat_input"])) {
            $query = $query->where('Weight', '<=', $data["maximum_carat_input"]);
        }

        if($data["minimum_depth"] && $data["maximum_depth"]){
            $query = $query->where('Total_Depth_Per','>=',$data["minimum_depth"]);
            $query = $query->where('Total_Depth_Per','<=',$data["maximum_depth"]);
        }

        if($data["minimum_depth_input"] && $data["maximum_depth_input"]){
            $query = $query->where('Total_Depth_Per','>=',$data["minimum_depth_input"]);
            $query = $query->where('Total_Depth_Per','<=',$data["maximum_depth_input"]);
        }elseif (!empty($data["minimum_depth_input"])) {
            $query = $query->where('Total_Depth_Per', '>=', $data["minimum_depth_input"]);
        }elseif (!empty($data["maximum_depth_input"])) {
            $query = $query->where('Total_Depth_Per', '<=', $data["maximum_depth_input"]);
        }

        // if($data["minimum_ratio"] && $data["maximum_ratio"]){
        //     $query = $query->where('Ratio','>=',$data["minimum_ratio"]);
        //     $query = $query->where('Ratio','<=',$data["maximum_ratio"]);
        // }

        // if($data["minimum_ratio_input"] && $data["maximum_ratio_input"]){
        //     $query = $query->where('Ratio','>=',$data["minimum_ratio_input"]);
        //     $query = $query->where('Ratio','<=',$data["maximum_ratio_input"]);
        // }elseif (!empty($data["minimum_ratio_input"])) {
        //     $query = $query->where('Ratio', '>=', $data["minimum_ratio_input"]);
        // }elseif (!empty($data["maximum_ratio_input"])) {
        //     $query = $query->where('Ratio', '<=', $data["maximum_ratio_input"]);
        // }

        if($data["minimum_table"] && $data["maximum_table"]){ 
            $query = $query->where('Table_Diameter_Per','>=',$data["minimum_table"]);
            $query = $query->where('Table_Diameter_Per','<=',$data["maximum_table"]);
        }

        // if($data["minimum_table_input"] && $data["maximum_table_input"]){ 
        //     $query = $query->where('Table_Diameter_Per','>=',$data["minimum_table_input"]);
        //     $query = $query->where('Table_Diameter_Per','<=',$data["maximum_table_input"]);
        // }elseif (!empty($data["minimum_table_input"])) {
        //     $query = $query->where('Table_Diameter_Per', '>=', $data["minimum_table_input"]);
        // }elseif (!empty($data["maximum_table_input"])) {
        //     $query = $query->where('Table_Diameter_Per', '<=', $data["maximum_table_input"]);
        // }

        if(isset($data["color"])){
            $colors = $data["color"];
            $query = $query->whereIn('Color',$colors);
        }

        if(isset($data["shape"])){
            $shapes = $data["shape"];
            $query = $query->whereIn('Shape',$shapes);
        }

        if(isset($data["clarity"])){
            $clarities = $data["clarity"];
            $query = $query->whereIn('Clarity',$clarities);
        }

        if(isset($data["cut"])){
            $cuts = $data["cut"];
            $query = $query->whereIn('Cut',$cuts);
        }

        if(isset($data["report"])){
            $reports = $data["report"];
            $query = $query->whereIn('Lab',$reports);
        }

        if(isset($data["polish"])){
            $polishs = $data["polish"];
            $query = $query->whereIn('Polish',$polishs);
        }

        if(isset($data["symm"])){
            $symms = $data["symm"];
            $query = $query->whereIn('Symm',$symms);
        }

        if(isset($data["fluor"])){
            $fluor = $data["fluor"];
            $query = $query->whereIn('fluor',$fluor);
        }

        if(isset($data["growth_type"])){
            $growth_type = $data["growth_type"];
            $query = $query->whereIn('growth_type',$growth_type);
        }

        if($data["sorting"] == "price")
        {
            $results = $query->orderBy('Sale_Amt','asc')->paginate(20); 
        }
        elseif($data["sorting"]=="price-desc"){
            $results = $query->orderBy('Sale_Amt','desc')->paginate(20); 
        }else{
            $results  = $query->paginate(20);
        }
        
        $artilces = '';
        if ($request->ajax()) {
            foreach ($results as $Diamond) {
                $Category = Category::where(['estatus' => 1,'id'=>$data['catid']])->first();
                $url =  URL('/diamond-details/'.$Category->slug.'/'.$Diamond->id);
                
                if($Diamond->Stone_Img_url != ""){
                    $Diamond_image = $Diamond->Stone_Img_url;
                }else{
                    if($Diamond->Shape == strtoupper('round')){
                        $Diamond_image = url('frontend/image/1.png');    
                    }elseif($Diamond->Shape == strtoupper('oval')){
                        $Diamond_image = url('frontend/image/2.png');
                    }elseif($Diamond->Shape == strtoupper('emerald')){
                        $Diamond_image = url('frontend/image/3.png');
                    }elseif($Diamond->Shape == strtoupper('princess')){
                        $Diamond_image = url('frontend/image/6.png');
                    }elseif($Diamond->Shape == strtoupper('cushion')){
                        $Diamond_image = url('frontend/image/7.png');
                    }elseif($Diamond->Shape == strtoupper('marquise')){
                        $Diamond_image = url('frontend/image/8.png');
                    }elseif($Diamond->Shape == strtoupper('pear')){
                        $Diamond_image = url('frontend/image/9.png');
                    }elseif($Diamond->Shape == strtoupper('HEART')){
                        $Diamond_image = url('frontend/image/10.png');
                    }elseif($Diamond->Shape == strtoupper('asscher')){
                        $Diamond_image = url('frontend/image/asscher.png');
                    }elseif($Diamond->Shape == strtoupper('radiant')){
                        $Diamond_image = url('frontend/image/radiant.png');
                    }else{
                        $Diamond_image = url('frontend/image/edit_box_2.png');
                    }
                }
                $artilces.='
                <div class="col-sm-6 col-md-6 col-lg-4 col-xxl-3 mb-4">
                        <div class="round_cut_lab_diamonds_box hover_on_mask">
                        
                            <a href="'.$url.'">
                                <div class="round_cut_lab_diamonds_img">
                                    <img src="'.$Diamond_image .'" alt="">
                                    <div class="round_cut_lab_diamonds_layer">
                                        <ul>
                                            
                                            <li>
                                                <span class="round_product_part_1">CARATE  :</span>
                                                <span class="round_product_part_2">'. $Diamond->Weight .' </span>
                                            </li>
                                            <li>
                                                <span class="round_product_part_1"> CLARITY :</span>
                                                <span class="round_product_part_2">'. $Diamond->Clarity .' </span>
                                            </li>
                                            <li>
                                                <span class="round_product_part_1">SHAPE :</span>
                                                <span class="round_product_part_2">'. $Diamond->Shape .' </span>
                                            </li>
                                        
                                            <li>
                                                <span class="round_product_part_1">COLOR  :</span>
                                                <span class="round_product_part_2">'. $Diamond->Color .' </span>
                                            </li>';
                                            if($Diamond->Cut != ""){
                                            $artilces.='<li>
                                                <span class="round_product_part_1"> CUT  :</span>
                                                <span class="round_product_part_2">'. $Diamond->Cut .' </span>
                                            </li>';
                                            }
                                            $artilces.='<li>
                                                <span class="round_product_part_1"> POLISH  :</span>
                                                <span class="round_product_part_2">'. $Diamond->Polish .' </span>
                                            </li>
                                            <li>
                                                <span class="round_product_part_1"> SYMMETRY  :</span>
                                                <span class="round_product_part_2">'. $Diamond->Symm .' </span>
                                            </li>
                                            
                                            <li>
                                                <span class="round_product_part_1"> MEASUREMENT  :</span>
                                                <span class="round_product_part_2">'. $Diamond->Measurement .' </span>
                                            </li>
                                            <li>
                                                <span class="round_product_part_1"> CERTIFIED :</span>
                                                <span class="round_product_part_2">'. $Diamond->Lab .' </span>
                                            </li>
                                            <li>
                                                <span class="round_product_part_1">LOT :</span>
                                                <span class="round_product_part_2">'. $Diamond->Stone_No .' </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </a>

                            <div class="mt-4 round_cut_lab_diamonds_layer_part pt-0">
                                <div class="round_cut_lab_diamonds_info_heading mb-2">
                                    <a href="'.$url.'">'.$Diamond->Shape.'</a>
                                    <input type="hidden" class="diamond_id" value="'. $Diamond->id .'">    
                                    <input type="hidden" class="item_type" value="1">    
                                    <span type="button" class="btn btn-default add-to-wishlist-btn-diamond add-to-wishlist-btn" data-toggle="tooltip" data-placement="right" title="Wishlist">';
                                
                                    if(is_wishlist($Diamond->id,1)){    
                                        $artilces .= '<i class="fas fa-heart text-danger"></i> ';
                                    }else{ 
                                        $artilces .= '<i class="far fa-heart"></i> ';
                                    }
                                    $artilces .= '</span>
                                </div>
                                <div class="round_cut_lab_diamonds_info_main_heading"><a href="'.$url.'">'. $Diamond->Shape .' '. round($Diamond->Weight,2) .' ct</a></div>
                                <div class="round_cut_lab_diamonds_info_clarity mb-2">
                                    <span>'. $Diamond->Clarity .' clarity |</span>
                                    <span>'. $Diamond->Color .' color |</span>
                                    <span>'. $Diamond->Lab .' certified</span>
                                </div>
                                <div class="round_cut_lab_diamonds_info_price d-flex justify-content-between">
                                    $'. $Diamond->Sale_Amt .' <span  class="comparesave d-inline-block" title="Compare" data-id="'.$Diamond->id.'">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                                            <path d="M20.875 3.6875H13.0625V2.125C13.0625 1.7106 12.8979 1.31317 12.6049 1.02015C12.3118 0.72712 11.9144 0.5625 11.5 0.5625H2.125C1.7106 0.5625 1.31317 0.72712 1.02015 1.02015C0.72712 1.31317 0.5625 1.7106 0.5625 2.125V17.75C0.5625 18.1644 0.72712 18.5618 1.02015 18.8549C1.31317 19.1479 1.7106 19.3125 2.125 19.3125H9.9375V20.875C9.9375 21.2894 10.1021 21.6868 10.3951 21.9799C10.6882 22.2729 11.0856 22.4375 11.5 22.4375H20.875C21.2894 22.4375 21.6868 22.2729 21.9799 21.9799C22.2729 21.6868 22.4375 21.2894 22.4375 20.875V5.25C22.4375 4.8356 22.2729 4.43817 21.9799 4.14515C21.6868 3.85212 21.2894 3.6875 20.875 3.6875V3.6875ZM2.125 10.7188H6.94531L4.92969 12.7422L6.03125 13.8438L9.9375 9.9375L6.03125 6.03125L4.92969 7.13281L6.94531 9.15625H2.125V2.125H11.5V17.75H2.125V10.7188ZM11.5 20.875V19.3125C11.9144 19.3125 12.3118 19.1479 12.6049 18.8549C12.8979 18.5618 13.0625 18.1644 13.0625 17.75V5.25H20.875V12.2812H16.0547L18.0703 10.2578L16.9688 9.15625L13.0625 13.0625L16.9688 16.9688L18.0703 15.8672L16.0547 13.8438H20.875V20.875H11.5Z" fill="#0B1727"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
        }

       $TotalDiamond = Diamond::get();
       
       // $data = ['artilces' => $artilces,'totaldata' => count($TotalDiamond) ,'showdata' => count($results) * $_GET['page']]; 
       $data = ['artilces' => $artilces,'totaldata' => count($TotalDiamond) ,'showdata' => 0];  
       return $data;
      
    }

    public function getDiamondDetails($slug,$id){
        $Category = Category::where(['estatus' => 1,'slug'=>$slug])->first();
        $catid = $Category->id;
        $CatId = $catid;
        $ip_address = \Request::ip();
        $cart = Cart::where(['ip_address'=>$ip_address,'category_id'=>$catid])->first();
       
        $check_variant = 0;
        $ProductVariantPrice = 0;
        if($cart){
            if($cart->variant_id != 0 &&  $cart->diamond_id != 0){
                return redirect('product_complete/'.$catid); 
            }else{
                if($cart->variant_id != 0){
                    $check_variant = 1;
                    $ProductVariantPrices = ProductVariant::where(['estatus' => 1,'id' => $cart->variant_id])->first();
                    if($ProductVariantPrices){
                        $ProductVariantPrice =  $ProductVariantPrices->sale_price;
                    }
                }
            }
        }else{
          
            $cart = Cart::where(['ip_address'=>$ip_address]);
            $cart->delete();
        }

        $Category = Category::where(['estatus' => 1,'id'=>$catid])->first();
        $Diamond = Diamond::where(['estatus' => 1,'id' => $id])->first();
        $OrderIncludes = OrderIncludes::with('OrderIncludesData')->where(['estatus' => 1])->first();
        $DiamondRelated = Diamond::where('id','<>',$id)->where('Shape',$Diamond->Shape)->limit(10)->get();
        $settings = Settings::first();
        $StepPopup = StepPopup::where(['category_id'=>$catid])->get();
        return view('frontend.diamond_details',compact('Diamond','Category','check_variant','CatId','ProductVariantPrice','OrderIncludes','DiamondRelated','settings','StepPopup'));
    }

    public function customproducts($slug,$shopbyid = 0){
        $Category = Category::where(['estatus' => 1,'slug'=>$slug])->first();
        $id = $Category->id;
        $ip_address = \Request::ip();
        $cart = Cart::where(['ip_address'=>$ip_address,'category_id'=>$id])->first();
        $check_diamond = 0;
        $DiamondPrice = 0;
        if($cart){
            if($cart->variant_id != 0 &&  $cart->diamond_id != 0){
                return redirect('product_complete/'.$id); 
            }else{
                if($cart->diamond_id != 0){
                    $check_diamond = 1;
                    $DiamondPrices = Diamond::where(['estatus' => 1,'id' => $cart->diamond_id])->first();
                    if($DiamondPrices){
                        $DiamondPrice =  $DiamondPrices->Sale_Amt;
                    }
                }
            }
        }else{
            $cart = Cart::where(['ip_address'=>$ip_address]);
            $cart->delete();
        }  
        $CatId = $id;
        $ShopBy = ShopByStyle::where(['estatus' => 1,'id' => $shopbyid])->first();
        
        $Attributes = Attribute::with('attributeterm')->where(['estatus' => 1,'is_filter' => 1])->get();
        $Maxprice = ProductVariant::max('sale_price');
        $Maxprice = ceil($Maxprice / 100) * 100;
        $StepPopup = StepPopup::where(['category_id'=>$id])->get();
        return view('frontend.custom_product',compact('Category','Attributes','Maxprice','CatId','check_diamond','ShopBy','DiamondPrice','StepPopup'));
    }


    public function getProducts(Request $request)
    {
        $data = $request->all();
        if(isset($data["action"]))
        {
           
            $query = Product::select('products.*','product_variants.images','product_variants.regular_price','product_variants.sale_price','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->leftJoin("product_variant_variants", "product_variant_variants.product_id", "=", "products.id")->leftJoin("product_variant_specifications", "product_variant_specifications.product_id", "=", "products.id")->where('products.is_custom',1)->where('products.primary_category_id',$data['catid'])->where('products.estatus',1);
            
            // if($request->keyword){
            //     // This will only execute if you received any keyword
            //     $query = $query->where('name','like','%'.$keyword.'%');
            // }
            
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
            
            if(isset($data["category"])){
                //$query = $query->where('primary_category_id',$data["category"]);
                $cat_id = $data["category"];
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
           //dd($result);
            $artilces = '';
            if ($request->ajax()) {
                foreach ($result as $product){
                    $images = explode(",",$product->images);
                    $image = URL($images['0']);
                    
                    $sale_price = $product->sale_price;
                    $supported_image = array(
                        'jpg',
                        'jpeg',
                        'png'
                    );
                    $url =  URL('/custom-product-details/'.$data['catid'].'/'.$product->id.'/'.$product->variant_id);

                    $alt_text = "";
                    if($product->alt_text != ""){
                        $alt_texts = explode(",",$product->alt_text);
                        $alt_text = $alt_texts['0'];
                    }

                    $artilces.='
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xxl-3 mb-4 wire_bangle_shop_radio">
                        <div class="wire_bangle_product_setting">
                            <div class="wire_bangle_img mb-3 position-relative">
                            <a href="'.$url.'"><img src="'.  $image  .'" alt="'. $alt_text .'" class="main-product-image-'.$product->id.'"></a>
                            </div><div class="text-center">';
                            $image_no = 1;
                            foreach($images as $key => $image){
                            $alt_text = "";    
                            if($product->alt_text != ""){
                                $alt_texts = explode(",",$product->alt_text);
                                $alt_text = $alt_texts['0'];
                            }   
                            if($image_no <= 3){ 
                                $artilces .= '<span class="form-check d-inline-block ">
                                    <a href="">';
                                    $ext = pathinfo($image, PATHINFO_EXTENSION); 
                                    if(in_array($ext, $supported_image)) {
                                        //$artilces .=  '<img src="'.  $image  .'" alt="" class="main-product-image-'.$product->id.'">';
                                       }else{
                                        $image2 = "";
                                       // $artilces .=  '<img src="'.  $image2  .'" alt="" class="main-product-image-'.$product->id.'">';
                                       }
                                    
                                       $artilces .= '<img src="'.URL($image) .'" style="width:40px; height: 40px;" alt="'.$alt_text.'" data-id="'.$product->id.'" class="wire_bangle_color_img pe-auto product-image ">';
                                       $artilces .= '</a>
                                    <div class="wire_bangle_color_input_label"></div>
                                </span>';
                            }
                            $image_no++;
                            }
                            $artilces.='</div><div class="wire_bangle_description p-3 pt-0">
                                <div class="wire_bangle_heading mb-2 mb-md-3">' .$product->primary_category->category_name. '
                                <input type="hidden" class="variant_id" value="'. $product->variant_id .'">    
                                <input type="hidden" class="item_type" value="0">    
                                <span type="button" class="btn btn-default add-to-wishlist-btn" data-toggle="tooltip" data-placement="right" title="Wishlist">';
                               
                                if(is_wishlist($product->variant_id,0)){    
                                    $artilces .= ' <i class="fas fa-heart text-danger"></i>';
                                 }else{ 
                                    $artilces .= ' <i class="far fa-heart"></i> ';
                                }
                                $artilces .= '</span>
                                </div>
                                <div class="wire_bangle_sub_heading" ><a style="" href="'.$url.'">'.$product->product_title .'</a></div>
                                <div class="d-flex justify-content-between pt-2 align-items-center">
                                <div>
                                    <span class="wire_bangle_price wire_bangle_price_part">
                                        $'.$sale_price .'</span>';
                                if($product->regular_price != ""){
                                   $artilces.='<span class="ms-2 wire_bangle_dublicate_price product_detail_regular_price">$<span class="regular_price">'. $product->regular_price .'</span></span>';
                                }
                                $artilces.='</div>';

                                $ProductVariantVariant = \App\Models\ProductVariantVariant::with('attribute','attribute_terms')->where('estatus',1)->where('product_id',$product->id)->groupBy('attribute_id')->get();
                                foreach($ProductVariantVariant as $productvariants){
                                if($productvariants->attribute_terms['0']->attrterm_thumb != ''){
                            
                                $artilces .= '<span class="wire_bangle_color mb-xxl-0 wire_bangle_color_img_part text-center wire_bangle_color_ring_part d-inline-block"><div class="wire_bangle_color_part">';
                                
                                    $product_attribute = \App\Models\ProductVariantVariant::with('attribute_terms')->where('estatus',1)->where('attribute_id',$productvariants->attribute_id)->where('product_id',$product->id)->groupBy('attribute_term_id')->get();
                                    $ia = 1;
                                    
                                    foreach($product_attribute as $attribute_term){
                                    $attributeurl =  URL('/custom-product-details/'.$data['catid'].'/'.$product->id.'/'.$attribute_term->product_variant_id); 
                                    $artilces .= '<span class="form-check d-inline-block">
                                            <a href="'.$attributeurl.'">
                                            <img src="'. url('images/attrTermThumb/'.$attribute_term->attribute_terms[0]->attrterm_thumb) .'" alt="'.$attribute_term->attribute_terms[0]->attrterm_name .'"  class="wire_bangle_color_img pe-auto">
                                            </a>
                                            <div class="wire_bangle_color_input_label"></div>
                                        </span>';
                                    $ia++;    
                                }
                                $artilces .= '</div>';
                                
                                    } 
                                } 

                                $artilces.=' </span>
                                </div>
                            </div>
                        </div>
                </div>';
                }
            }

        $TotalDiamond = Product::where('products.is_custom',1)->where('products.estatus',1)->get();
        $data = ['artilces' => $artilces,'totaldata' => count($TotalDiamond) ,'showdata' => count($result) * $_GET['page']];   
        return $data;

        }
    }

    public function getCustomProductDetails($catid,$id,$vid){
        $CatId = $catid;
        $ip_address = \Request::ip();
        $cart = Cart::where(['ip_address'=>$ip_address,'category_id'=>$catid])->first();
        $check_diamond = 0;
        $DiamondPrice = 0;
        if($cart){
            if($cart->variant_id != 0 &&  $cart->diamond_id != 0){
                return redirect('product_complete/'.$catid); 
            }else{
                if($cart->diamond_id != 0){
                    $check_diamond = 1;
                    $DiamondPrices = Diamond::where(['estatus' => 1,'id' => $cart->diamond_id])->first();
                    if($DiamondPrices){
                        $DiamondPrice =  $DiamondPrices->Sale_Amt;
                    }
                }
            }
        }else{
            $cart = Cart::where(['ip_address'=>$ip_address]);
            $cart->delete();
        } 
        $Category = Category::where(['estatus' => 1,'id'=>$catid])->first();
        $Product= Product::with('primary_category','product_variant','product_variant_variants')->where(['estatus' => 1,'id' => $id])->first();
        $attribute_term_ids = ProductVariantVariant::where('product_variant_id',$vid)->where('estatus',1)->get()->pluck('attribute_term_id')->toArray();
        $OrderIncludes= OrderIncludes::with('OrderIncludesData')->where(['estatus' => 1])->first();
        $settings = Settings::first();
        $StepPopup = StepPopup::where(['category_id'=>$catid])->get();
        $ProductRelated= Product::select('products.*','product_variants.images','product_variants.regular_price','product_variants.sale_price','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->where(['products.estatus' => 1,'product_variants.estatus' => 1,'primary_category_id' => $catid])->where('products.id','<>',$id)->groupBy('products.id')->take(10)->get();
        return view('frontend.custom_product_details',compact('Product','Category','check_diamond','CatId','DiamondPrice','attribute_term_ids','OrderIncludes','ProductRelated','settings','StepPopup'));
    }

    public function getProductComplete($catid){
        $CatId = $catid;
        $Category = Category::where(['estatus' => 1,'id'=>$catid])->first();
        $ip_address = \Request::ip();
        $cart = Cart::where(['ip_address'=>$ip_address,'category_id'=>$catid])->first();
        $Product = ProductVariant::with('product')->where(['estatus' => 1,'id' => $cart->variant_id])->first();
        $Diamond = Diamond::where(['id' => $cart->diamond_id])->first();
        $OrderIncludes= OrderIncludes::with('OrderIncludesData')->where(['estatus' => 1])->first();
       
        $ProductRelated= Product::select('products.*','product_variants.images','product_variants.regular_price','product_variants.sale_price','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->where(['products.estatus' => 1,'product_variants.estatus' => 1,'primary_category_id' => $catid])->where('products.id','<>',$Product->product_id)->groupBy('products.id')->take(10)->get();
        
        $settings = Settings::first();
        $StepPopup = StepPopup::where(['category_id'=>$catid])->get();
        return view('frontend.product_complete',compact('Category','Product','Diamond','CatId','cart','OrderIncludes','ProductRelated','settings','StepPopup'));
    }

    public function editproductsetting($catid){
        $ip_address = \Request::ip();
        $cart = Cart::where(['ip_address'=>$ip_address,'category_id'=>$catid])->first();
        $cart->variant_id = 0;
        $cart->save();

        return redirect('/product-setting/'.$catid);
    }

    public function editdiamondsetting($catid){

        $ip_address = \Request::ip();
        $cart = Cart::where(['ip_address'=>$ip_address,'category_id'=>$catid])->first();
        $cart->diamond_id = 0;
        $cart->save();

        return redirect('/diamond-setting/'.$catid);
    }

    public function laddiamond($shap = "")
    {
        $Maxprice = Diamond::max('Sale_Amt');
        $Maxprice = ceil($Maxprice / 100) * 100;
        $MaxCarat = Diamond::max('Weight');
        $MaxDepth = Diamond::max('Total_Depth_Per');
        $MaxDepth = ceil($MaxDepth / 10) * 10;
        $MaxRatio = Diamond::max('Ratio');
        $MaxTable = Diamond::max('Table_Diameter_Per');
        $MaxTable = ceil($MaxTable / 10) * 10;
        $diamondshape = Diamond::whereNotNull('Shape')->Where('Shape','<>','')->groupBy('Shape')->pluck('Shape');
        $diamondcolor = Diamond::whereNotNull('Color')->Where('Color','<>','')->groupBy('Color')->pluck('Color');
        $diamondclarity = Diamond::whereNotNull('Clarity')->Where('Clarity','<>','')->groupBy('Clarity')->pluck('Clarity');
        $diamondcut = Diamond::whereNotNull('Cut')->Where('Cut','<>','')->groupBy('Cut')->pluck('Cut');
        $diamondpolish = Diamond::whereNotNull('Polish')->Where('Polish','<>','')->groupBy('Polish')->pluck('Polish');
        $diamondsymm = Diamond::whereNotNull('Symm')->Where('Symm','<>','')->groupBy('Symm')->pluck('Symm');
        $diamondreport = Diamond::groupBy('Lab')->pluck('Lab');
        return view('frontend.laddiamond',compact('shap','Maxprice','MaxCarat','diamondshape','diamondcolor','diamondclarity','diamondcut','diamondreport','MaxDepth','MaxRatio','MaxTable','diamondpolish','diamondsymm'));
    }

    public function getLadDiamonds(Request $request)
    {
        
        $data = $request->all();
        \DB::enableQueryLog();
        $query = Diamond::where('estatus',1);
        if($data["minimum_price"] && $data["maximum_price"]){
            $query = $query->where('Sale_Amt','>=',$data["minimum_price"]);
            $query = $query->where('Sale_Amt','<=',$data["maximum_price"]);
        }

        if($data["minimum_price_input"] && $data["maximum_price_input"]){
            $query = $query->where('Sale_Amt','>=',$data["minimum_price_input"]);
            $query = $query->where('Sale_Amt','<=',$data["maximum_price_input"]);
        }elseif (!empty($data["minimum_price_input"])) {
            $query = $query->where('Sale_Amt', '>=', $data["minimum_price_input"]);
        }elseif (!empty($data["maximum_price_input"])) {
            $query = $query->where('Sale_Amt', '<=', $data["maximum_price_input"]);
        }

        if($data["minimum_carat"] && $data["maximum_carat"]){
            $query = $query->where('Weight','>=',$data["minimum_carat"]);
            $query = $query->where('Weight','<=',$data["maximum_carat"]);
        }

        if($data["minimum_carat_input"] && $data["maximum_carat_input"]){
            $query = $query->where('Weight','>=',$data["minimum_carat_input"]);
            $query = $query->where('Weight','<=',$data["maximum_carat_input"]);
        }elseif (!empty($data["minimum_carat_input"])) {
            $query = $query->where('Weight', '>=', $data["minimum_carat_input"]);
        }elseif (!empty($data["maximum_carat_input"])) {
            $query = $query->where('Weight', '<=', $data["maximum_carat_input"]);
        }

        if($data["minimum_depth"] && $data["maximum_depth"]){
            $query = $query->where('Total_Depth_Per','>=',$data["minimum_depth"]);
            $query = $query->where('Total_Depth_Per','<=',$data["maximum_depth"]);
        }

        if($data["minimum_depth_input"] && $data["maximum_depth_input"]){
            $query = $query->where('Total_Depth_Per','>=',$data["minimum_depth_input"]);
            $query = $query->where('Total_Depth_Per','<=',$data["maximum_depth_input"]);
        }elseif (!empty($data["minimum_depth_input"])) {
            $query = $query->where('Total_Depth_Per', '>=', $data["minimum_depth_input"]);
        }elseif (!empty($data["maximum_depth_input"])) {
            $query = $query->where('Total_Depth_Per', '<=', $data["maximum_depth_input"]);
        }

        // if($data["minimum_ratio"] && $data["maximum_ratio"]){
        //     $query = $query->where('Ratio','>=',$data["minimum_ratio"]);
        //     $query = $query->where('Ratio','<=',$data["maximum_ratio"]);
        // }

        // if($data["minimum_ratio_input"] && $data["maximum_ratio_input"]){
        //     $query = $query->where('Ratio','>=',$data["minimum_ratio_input"]);
        //     $query = $query->where('Ratio','<=',$data["maximum_ratio_input"]);
        // }elseif (!empty($data["minimum_ratio_input"])) {
        //     $query = $query->where('Ratio', '>=', $data["minimum_ratio_input"]);
        // }elseif (!empty($data["maximum_ratio_input"])) {
        //     $query = $query->where('Ratio', '<=', $data["maximum_ratio_input"]);
        // }

        if($data["minimum_table"] && $data["maximum_table"]){ 
            $query = $query->where('Table_Diameter_Per','>=',$data["minimum_table"]);
            $query = $query->where('Table_Diameter_Per','<=',$data["maximum_table"]);
        }

        if($data["minimum_table_input"] && $data["maximum_table_input"]){ 
            $query = $query->where('Table_Diameter_Per','>=',$data["minimum_table_input"]);
            $query = $query->where('Table_Diameter_Per','<=',$data["maximum_table_input"]);
        }elseif (!empty($data["minimum_table_input"])) {
            $query = $query->where('Table_Diameter_Per', '>=', $data["minimum_table_input"]);
        }elseif (!empty($data["maximum_table_input"])) {
            $query = $query->where('Table_Diameter_Per', '<=', $data["maximum_table_input"]);
        }

        if(isset($data["polish"])){
            $polishs = $data["polish"];
            $query = $query->whereIn('Polish',$polishs);
        }

        if(isset($data["symm"])){
            $symms = $data["symm"];
            $query = $query->whereIn('Symm',$symms);
        }

        if(isset($data["color"])){
            $colors = $data["color"];
            $query = $query->whereIn('Color',$colors);
        }

        if(isset($data["shape"])){
            $shapes = $data["shape"];
            $query = $query->whereIn('Shape',$shapes);
        }

        if(isset($data["clarity"])){
            $clarities = $data["clarity"];
            $query = $query->whereIn('Clarity',$clarities);
        }

        if(isset($data["cut"])){
            $cuts = $data["cut"];
            $query = $query->whereIn('Cut',$cuts);
        }
        if(isset($data["report"])){
            $reports = $data["report"];
            $query = $query->whereIn('Lab',$reports);
        }

        if(isset($data["fluor"])){
            $fluor = $data["fluor"];
            $query = $query->whereIn('fluor',$fluor);
        }

        if(isset($data["growth_type"])){
            $growth_type = $data["growth_type"];
            $query = $query->whereIn('growth_type',$growth_type);
        }
        
        if($data["sorting"] == "price")
        {
            $results = $query->orderBy('Sale_Amt','asc')->paginate(20); 
        }
        elseif($data["sorting"]=="price-desc"){
            $results = $query->orderBy('Sale_Amt','desc')->paginate(20); 
        }else{
            $results  = $query->paginate(20);
        }
        
        $artilces = '';
        if ($request->ajax()) {
            foreach ($results as $Diamond) {
                $url =  URL('/laddiamond-details/'.$Diamond->id);
                if($Diamond->Stone_Img_url != ""){
                    $Diamond_image = $Diamond->Stone_Img_url;
                }else{
                    if($Diamond->Shape == strtoupper('round')){
                        $Diamond_image = url('frontend/image/1.png');    
                    }elseif($Diamond->Shape == strtoupper('oval')){
                        $Diamond_image = url('frontend/image/2.png');
                    }elseif($Diamond->Shape == strtoupper('emerald')){
                        $Diamond_image = url('frontend/image/3.png');
                    }elseif($Diamond->Shape == strtoupper('princess')){
                        $Diamond_image = url('frontend/image/6.png');
                    }elseif($Diamond->Shape == strtoupper('cushion')){
                        $Diamond_image = url('frontend/image/7.png');
                    }elseif($Diamond->Shape == strtoupper('marquise')){
                        $Diamond_image = url('frontend/image/8.png');
                    }elseif($Diamond->Shape == strtoupper('pear')){
                        $Diamond_image = url('frontend/image/9.png');
                    }elseif($Diamond->Shape == strtoupper('HEART')){
                        $Diamond_image = url('frontend/image/10.png');
                    }elseif($Diamond->Shape == strtoupper('asscher')){
                        $Diamond_image = url('frontend/image/asscher.png');
                    }elseif($Diamond->Shape == strtoupper('radiant')){
                        $Diamond_image = url('frontend/image/radiant.png');
                    }else{
                        $Diamond_image = url('frontend/image/edit_box_2.png');
                    }
                }
                $artilces.='
                <div class="col-sm-6 col-md-6 col-lg-4 col-xxl-3 mb-4">
                        <div class="round_cut_lab_diamonds_box hover_on_mask">
                            <a href="'.$url.'">
                                <div class="round_cut_lab_diamonds_img">
                                    <img src="'.$Diamond_image .'" alt="">
                                    <div class="round_cut_lab_diamonds_layer">
                                        <ul>
                                            <li class="">
                                                <span class="round_product_part_1">CARATE  :</span>
                                                <span class="round_product_part_2">'. $Diamond->Weight .' </span>
                                            </li>
                                            <li class="">
                                                <span class="round_product_part_1"> CLARITY :</span>
                                                <span class="round_product_part_2">'. $Diamond->Clarity .' </span>
                                            </li>
                                            <li class="">
                                                <span class="round_product_part_1">SHAPE :</span>
                                                <span class="round_product_part_2">'. $Diamond->Shape .' </span>
                                            </li>
                                        
                                            <li class="">
                                                <span class="round_product_part_1">COLOR  :</span>
                                                <span class="round_product_part_2">'. $Diamond->Color .' </span>
                                            </li>';
                                            if($Diamond->Cut != ""){
                                            $artilces.='<li class="">
                                                <span class="round_product_part_1"> CUT  :</span>
                                                <span class="round_product_part_2">'. $Diamond->Cut .' </span>
                                            </li>';
                                            }
                                            $artilces.='<li class="">
                                                <span class="round_product_part_1"> POLISH  :</span>
                                                <span class="round_product_part_2">'. $Diamond->Polish .' </span>
                                            </li>
                                            <li class="">
                                                <span class="round_product_part_1"> SYMMETRY  :</span>
                                                <span class="round_product_part_2">'. $Diamond->Symm .' </span>
                                            </li>
                                            
                                            <li class="">
                                                <span class="round_product_part_1"> MEASUREMENT   :</span>
                                                <span class="round_product_part_2">'. $Diamond->Measurement .' </span>
                                            </li>
                                            <li class="">
                                                <span class="round_product_part_1"> CERTIFIED  :</span>
                                                <span class="round_product_part_2">'. $Diamond->Lab .' </span>
                                            </li>
                                            <li class="">
                                                <span class="round_product_part_1">LOT :</span>
                                                <span class="round_product_part_2">'. $Diamond->Stone_No .' </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </a>

                            <div class="mt-4 round_cut_lab_diamonds_layer_part pt-0">
                                <div class="round_cut_lab_diamonds_info_heading mb-1">
                                    '.$Diamond->Shape.'
                                    <input type="hidden" class="diamond_id" value="'. $Diamond->id .'">    
                                    <input type="hidden" class="item_type" value="1">    
                                    <span type="button" class="btn btn-default add-to-wishlist-btn-diamond add-to-wishlist-btn  " data-toggle="tooltip" data-placement="right" title="Wishlist">';
                                
                                    if(is_wishlist($Diamond->id,1)){    
                                        $artilces .= '<i class="fas fa-heart text-danger"></i> ';
                                    }else{ 
                                        $artilces .= '<i class="far fa-heart"></i> ';
                                    }
                                    $artilces .= '</span>
                                </div>
                                <div class="round_cut_lab_diamonds_info_main_heading"><a href="'.$url.'">'. $Diamond->Shape .' '. round($Diamond->Weight,2) .' ct</a></div>
                                <div class="round_cut_lab_diamonds_info_clarity mb-2">
                                    <span>'. $Diamond->Clarity .' clarity |</span>
                                    <span>'. $Diamond->Color .' color |</span>
                                    <span>'. $Diamond->Lab .' certified</span>
                                </div>
                                <div class="round_cut_lab_diamonds_info_price d-flex justify-content-between">
                                    $'. $Diamond->Sale_Amt .' <span  class="comparesave d-inline-block"  title="Compare"   data-id="'.$Diamond->id.'">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                                        <path d="M20.875 3.6875H13.0625V2.125C13.0625 1.7106 12.8979 1.31317 12.6049 1.02015C12.3118 0.72712 11.9144 0.5625 11.5 0.5625H2.125C1.7106 0.5625 1.31317 0.72712 1.02015 1.02015C0.72712 1.31317 0.5625 1.7106 0.5625 2.125V17.75C0.5625 18.1644 0.72712 18.5618 1.02015 18.8549C1.31317 19.1479 1.7106 19.3125 2.125 19.3125H9.9375V20.875C9.9375 21.2894 10.1021 21.6868 10.3951 21.9799C10.6882 22.2729 11.0856 22.4375 11.5 22.4375H20.875C21.2894 22.4375 21.6868 22.2729 21.9799 21.9799C22.2729 21.6868 22.4375 21.2894 22.4375 20.875V5.25C22.4375 4.8356 22.2729 4.43817 21.9799 4.14515C21.6868 3.85212 21.2894 3.6875 20.875 3.6875V3.6875ZM2.125 10.7188H6.94531L4.92969 12.7422L6.03125 13.8438L9.9375 9.9375L6.03125 6.03125L4.92969 7.13281L6.94531 9.15625H2.125V2.125H11.5V17.75H2.125V10.7188ZM11.5 20.875V19.3125C11.9144 19.3125 12.3118 19.1479 12.6049 18.8549C12.8979 18.5618 13.0625 18.1644 13.0625 17.75V5.25H20.875V12.2812H16.0547L18.0703 10.2578L16.9688 9.15625L13.0625 13.0625L16.9688 16.9688L18.0703 15.8672L16.0547 13.8438H20.875V20.875H11.5Z" fill="#0B1727"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
        }

        $TotalDiamond = Diamond::get();
        $data = ['artilces' => $artilces,'totaldata' => count($TotalDiamond) ,'showdata' => count($results) * $_GET['page']];   
        return $data;
      
    }

    public function getLadDiamondDetails($id){
        $Category = Category::where(['estatus' => 1,'is_custom'=>1])->get();
        $Diamond= Diamond::where(['estatus' => 1,'id' => $id])->first();
        $OrderIncludes = OrderIncludes::with('OrderIncludesData')->where(['estatus' => 1])->first();
        $DiamondRelated = Diamond::where('id','<>',$id)->where('Shape',$Diamond->Shape)->limit(10)->get();
        $settings = Settings::first();
        return view('frontend.laddiamond_details',compact('Diamond','Category','OrderIncludes','DiamondRelated','settings'));
    }

}
