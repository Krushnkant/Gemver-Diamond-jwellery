<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Diamond;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\ProductVariant;
use App\Models\ProductVariantVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Response;

class DiamondController extends Controller
{
    public function index($id){
        $ip_address = \Request::ip();
        $cart = Cart::where(['ip_address'=>$ip_address,'category_id'=>$id])->first();
        $check_variant = 0;
        $check_variant_id = 0;
        if($cart){
            if($cart->variant_id != 0 &&  $cart->diamond_id != 0){
                return redirect('product_complete/'.$id); 
            }else{
                if($cart->variant_id != 0){
                    $check_variant = 1;
                    $check_variant_id = $cart->variant_id;
                }
            }
        }else{
            $cart = Cart::where(['ip_address'=>$ip_address]);
            $cart->delete();
        }
        $CatId = $id;
        $Category = Category::where(['estatus' => 1,'id'=>$id])->first();
        $Attributes = Attribute::with('attributeterm')->where(['estatus' => 1,'is_filter' => 1])->get();
        $Maxprice = Diamond::max('Sale_Amt');
        return view('frontend.diamond',compact('Category','Attributes','Maxprice','CatId','check_variant','check_variant_id'));
    } 

    public function getDiamonds(Request $request)
    {
        $data = $request->all();
        $query = Diamond::where('estatus',1);
        if($data["minimum_price"] && $data["maximum_price"]){
            $query = $query->where('Sale_Amt','>=',$data["minimum_price"]);
            $query = $query->where('Sale_Amt','<=',$data["maximum_price"]);
        }

        if($data["minimum_carat"] && $data["maximum_carat"]){
            $query = $query->where('Weight','>=',$data["minimum_carat"]);
            $query = $query->where('Weight','<=',$data["maximum_carat"]);
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

        
        if($data["sorting"] == "price")
        {
            $results = $query->orderBy('Sale_Amt','asc')->paginate(18); 
        }
        elseif($data["sorting"]=="price-desc"){
            $results = $query->orderBy('Sale_Amt','desc')->paginate(18); 
        }else{
            $results  = $query->paginate(18);
        }

        $artilces = '';
        if ($request->ajax()) {
            foreach ($results as $Diamond) {
                $url =  URL('/diamond-details/'.$data['catid'].'/'.$Diamond->id);
                
                if($Diamond->Stone_Img_url != ""){
                    $Diamond_image = $Diamond->Stone_Img_url;
                }else{
                    $Diamond_image = url('frontend/image/edit_box_2.png');
                }
                $artilces.='
                <div class="col-md-6 col-lg-4 mb-4">
                        <div class="round_cut_lab_diamonds_box hover_on_mask">
                            <div class="round_cut_lab_diamonds_img">
                                <img src="'.$Diamond_image .'" alt="">
                                <a href="'.$url.'">
                                <div class="round_cut_lab_diamonds_layer">
                                    <ul>
                                        <li>
                                            <span>LOT :</span>
                                            <span>'. $Diamond->Stone_No .' </span>
                                        </li>
                                        <li>
                                            <span>CARATE  :</span>
                                            <span>'. $Diamond->Weight .' </span>
                                        </li>
                                        <li>
                                            <span>SHAPE :</span>
                                            <span>'. $Diamond->Shape .' </span>
                                        </li>
                                       
                                        <li>
                                            <span>COLOR  :</span>
                                            <span>'. $Diamond->Color .' </span>
                                        </li>
                                        <li>
                                            <span> CLARITY :</span>
                                            <span>'. $Diamond->Clarity .' </span>
                                        </li>
                                        <li>
                                            <span> CUT  :</span>
                                            <span>'. $Diamond->Cut .' </span>
                                        </li>
                                        <li>
                                            <span> POLISH  :</span>
                                            <span>'. $Diamond->Polish .' </span>
                                        </li>
                                        <li>
                                            <span> SYMMETRY  :</span>
                                            <span>'. $Diamond->Symm .' </span>
                                        </li>
                                        
                                        <li>
                                            <span> MEASUREMENT   :</span>
                                            <span>'. $Diamond->Measurement .' </span>
                                        </li>
                                        <li>
                                            <span> LAB   :</span>
                                            <span>'. $Diamond->Lab .' </span>
                                        </li>
                                    </ul>
                                </div>
                                </a>
                            </div>

                            <div class="mt-4 round_cut_lab_diamonds_layer_part">
                                
                                    <div class="round_cut_lab_diamonds_info_heading mb-2">'.$Diamond->Shape.'</div>
                             
                                <div class="round_cut_lab_diamonds_info_main_heading mb-2">'. $Diamond->Shape .' '. $Diamond->Weight .' ct</div>
                                <div class="round_cut_lab_diamonds_info_clarity mb-2">
                                    <span>'. $Diamond->Clarity .' |</span>
                                    <span>'. $Diamond->Color .'</span>
                                </div>
                                <div class="round_cut_lab_diamonds_info_price">
                                    $'. $Diamond->Sale_Amt .'
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

    public function getDiamondDetails($catid,$id){
        $CatId = $catid;
        $ip_address = \Request::ip();
        $cart = Cart::where(['ip_address'=>$ip_address,'category_id'=>$catid])->first();
       
        $check_variant = 0;
        if($cart){
            if($cart->variant_id != 0 &&  $cart->diamond_id != 0){
                return redirect('product_complete/'.$catid); 
            }else{
                if($cart->variant_id != 0){
                    $check_variant = 1;
                }
            }
        }else{
          
            $cart = Cart::where(['ip_address'=>$ip_address]);
            $cart->delete();
        }

        $Category = Category::where(['estatus' => 1,'id'=>$catid])->first();
        $Diamond= Diamond::where(['estatus' => 1,'id' => $id])->first();
        return view('frontend.diamond_details',compact('Diamond','Category','check_variant','CatId'));
    }

    public function customproducts($id){
        $ip_address = \Request::ip();
        $cart = Cart::where(['ip_address'=>$ip_address,'category_id'=>$id])->first();
        $check_diamond = 0;
        if($cart){
            if($cart->variant_id != 0 &&  $cart->diamond_id != 0){
                return redirect('product_complete/'.$id); 
            }else{
                if($cart->diamond_id != 0){
                    $check_diamond = 1;
                }
            }
        }else{
            $cart = Cart::where(['ip_address'=>$ip_address]);
            $cart->delete();
        }  
        $CatId = $id;
        $Category = Category::where(['estatus' => 1,'id'=>$id])->first();
        $Attributes = Attribute::with('attributeterm')->where(['estatus' => 1,'is_filter' => 1])->get();
        $Maxprice = ProductVariant::max('sale_price');
        return view('frontend.custom_product',compact('Category','Attributes','Maxprice','CatId','check_diamond'));
    }


    public function getProducts(Request $request)
    {
        $data = $request->all();
        if(isset($data["action"]))
        {
           
            $query = Product::select('products.*','product_variants.images','product_variants.sale_price')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->leftJoin("product_variant_variants", "product_variant_variants.product_id", "=", "products.id")->leftJoin("product_variant_specifications", "product_variant_specifications.product_id", "=", "products.id")->where('products.is_custom',1)->where('products.primary_category_id',$data['catid'])->where('products.estatus',1);
            
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
           
            $artilces = '';
            if ($request->ajax()) {
                foreach ($result as $product){
                    $images = explode(",",$product->images);
                    $image = URL($images['0']);
                    $sale_price = $product->sale_price;
                    $url =  URL('/custom-product-details/'.$data['catid'].'/'.$product->id);
                    $artilces.='
                    <div class="col-sm-6 col-lg-4 col-xl-4 mt-3 mt-md-4">
                    <div class="wire_bangle_img mb-3 position-relative">
                        <img src="'.  $image  .'" alt="'. $product->product_title .'">
                    </div>
                    <div class="wire_bangle_description">
                        <div class="wire_bangle_heading mb-2 mb-md-3">' .$product->primary_category->category_name. '</div>
                        <div class="wire_bangle_sub_heading mb-2 mb-md-3" ><a style="color:#BB9761;" href="'.$url.'">'.$product->product_title .'</a></div>
                        <div class="wire_bangle_paragraph mb-2 mb-md-3">
                            '.$product->desc.'
                        </div>
                        <div class="wire_bangle_price">
                        $'.$sale_price .'
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

    public function getCustomProductDetails($catid,$id){
        $CatId = $catid;
        $ip_address = \Request::ip();
        $cart = Cart::where(['ip_address'=>$ip_address,'category_id'=>$catid])->first();
        $check_diamond = 0;
        if($cart){
            if($cart->variant_id != 0 &&  $cart->diamond_id != 0){
                return redirect('product_complete/'.$catid); 
            }else{
                if($cart->diamond_id != 0){
                    $check_diamond = 1;
                }
            }
        }else{
            $cart = Cart::where(['ip_address'=>$ip_address]);
            $cart->delete();
        } 
        $Category = Category::where(['estatus' => 1,'id'=>$catid])->first();
        //$Product= ProductVariant::with('product','product_variant_variants')->where(['estatus' => 1,'id' => $id])->first();
        $Product= Product::with('primary_category','product_variant','product_variant_variants')->where(['estatus' => 1,'id' => $id])->first();
        return view('frontend.custom_product_details',compact('Product','Category','check_diamond','CatId'));
    }

    public function getProductComplete($catid){
        $CatId = $catid;
        $Category = Category::where(['estatus' => 1,'id'=>$catid])->first();
        $ip_address = \Request::ip();
        $cart = Cart::where(['ip_address'=>$ip_address,'category_id'=>$catid])->first();


        $Product= ProductVariant::with('product')->where(['estatus' => 1,'id' => $cart->variant_id])->first();
        $Diamond = Diamond::where(['id' => $cart->diamond_id])->first();
        return view('frontend.product_complete',compact('Category','Product','Diamond','CatId'));
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


     



}
