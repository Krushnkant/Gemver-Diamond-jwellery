<?php

namespace App\Http\Controllers;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Cookie;
use App\Models\Cart;
use App\Models\ItemCart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Diamond;
use Illuminate\Http\Request;
use App\Models\Settings;
use Config;
use Illuminate\Support\Facades\Validator;
use App\Models\BlogBanner;

class CartController extends Controller
{
    public function save(Request $request){
        // $cart = new Cart();
        // $cart->ip_address = $request->ip_address;
        // $cart->category_id = $request->category_id;
        // $cart->diamond_id = isset($request->diamond_id) ? $request->diamond_id : 0;
        // $cart->variant_id = isset($request->variant_id) ? $request->variant_id : 0; 
        // $cart->specification_term_id = isset($request->specification) ? $request->specification : null;
        // $cart->save();

        // return response()->json(['status' => '200']);  

        // dd($request->all());
        $cart = Cart::where(['ip_address'=>$request->ip_address,'category_id'=>$request->category_id])->first();
        $cartcheck = Cart::where(['ip_address'=>$request->ip_address,'category_id'=>$request->category_id])->first();
       
        if ($cartcheck){
          
            $cart = Cart::where(['ip_address'=>$request->ip_address,'category_id'=>$request->category_id])->first();
            $cart->diamond_id = isset($request->diamond_id) ? $request->diamond_id : $cart->diamond_id;
            $cart->variant_id = isset($request->variant_id) ? $request->variant_id : $cart->variant_id; 
            $cart->specification_term_id = isset($request->specification) ? $request->specification : $cart->specification_term_id;
            $cart->save();
        }else{
            $cartdelete = Cart::where(['ip_address'=>$request->ip_address]);
            $cartdelete->delete();

            $cart = new Cart();
            $cart->ip_address = $request->ip_address;
            $cart->category_id = $request->category_id;
            $cart->diamond_id = isset($request->diamond_id) ? $request->diamond_id : 0;
            $cart->variant_id = isset($request->variant_id) ? $request->variant_id : 0; 
            $cart->specification_term_id = isset($request->specification) ? $request->specification : null;
            $cart->save();
        }

        if($request->btn_type == "add_to_cart"){
            $prod_id = (isset($request->variant_id) && $request->variant_id) ? $request->variant_id : $cart->variant_id;
            $diamond_id = (isset($request->diamond_id ) && $request->diamond_id) ? $request->diamond_id  : $cart->diamond_id;
            $action = "add";
            $quantity = 1;
            $item_type = 2;
            $arrspe = "";

            if(session()->has('customer')){
                $user_id = session('customer.id');
                $cart_data = ItemCart::where(['user_id' => session('customer.id'),'item_id' => $prod_id,'diamond_id' => $diamond_id,'item_type' => $item_type])->first();
                if($cart_data){
                    if($action == 'update_qty'){
                        ItemCart::where(['user_id' => session('customer.id'),'item_id' => $prod_id,'item_type' => $item_type])->update([
                            'item_quantity' =>  $quantity
                        ]);   
                    }else{
                        ItemCart::where(['user_id' => session('customer.id'),'item_id' => $prod_id,'item_type' => $item_type])->update([
                            'item_quantity' => $cart_data['item_quantity'] + $quantity
                        ]);
                    }
                    
                    return response()->json(['status'=>'200']);
                }else{
                    $cart = New ItemCart();
                    $cart->user_id = $user_id;
                    $cart->item_id = $prod_id;
                    $cart->diamond_id = $diamond_id;
                    $cart->item_quantity = $quantity;
                    $cart->item_type = $item_type;
                    $cart->specification = (isset($arrspe) && $arrspe != "")?json_encode($arrspe) :"";
                    $cart->save();
                    return response()->json(['status'=>'200']);
                }
            }else{
                    
                if(Cookie::get('shopping_cart'))
                {
                    $cookie_data = stripslashes(Cookie::get('shopping_cart'));
                    $cart_data = json_decode($cookie_data, true);
                }
                else
                {
                    $cart_data = array();
                }
                $item_id_list = array_column($cart_data, 'item_id');
                $diamond_id_list = array_column($cart_data, 'diamod_id');
                $prod_id_is_there = $prod_id;
                $diamond_id_is_there = $diamond_id;

                if(in_array($prod_id_is_there, $item_id_list) && in_array($diamond_id_is_there, $diamond_id_list))
                {
                    foreach($cart_data as $keys => $values)
                    {
                        if($cart_data[$keys]["item_id"] == $prod_id && $cart_data[$keys]["diamond_id"] == $diamond_id)
                        {
                            if($action == 'update_qty'){
                            $cart_data[$keys]["item_quantity"] = $request->input('quantity');
                            }else{
                                $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $request->input('quantity'); 
                            }
                            $item_data = json_encode($cart_data);
                            $minutes = Config::get('constants.cookie_time');
                            Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                            return response()->json(['status'=>'Added to Cart','status2'=>'2']);
                        }else{
                            if($action == 'update_qty'){
                                $cart_data[$keys]["item_quantity"] = $request->input('quantity');
                            }else{
                                $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $request->input('quantity'); 
                            }
                        
                            $item_data = json_encode($cart_data);
                            $minutes = Config::get('constants.cookie_time');
                            Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                            return response()->json(['status'=>'200']);
                        }
                    }
                

                }elseif(in_array($prod_id_is_there, $item_id_list)){
                    
                    foreach($cart_data as $keys => $values)
                    {
                        if($cart_data[$keys]["item_id"] == $prod_id)
                        {
                            if($action == 'update_qty'){
                                $cart_data[$keys]["item_quantity"] = $request->input('quantity');
                            }else{
                                $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $request->input('quantity'); 
                            }
                            $item_data = json_encode($cart_data);
                            $minutes = Config::get('constants.cookie_time');
                            Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                            return response()->json(['status'=>'200']);
                        }
                    }

                }
                else
                {
                    if($item_type == 0){
                        $products = ProductVariant::find($prod_id);
                    }elseif($item_type == 1){
                        $products = Diamond::find($prod_id);
                    }else{
                        $products = ProductVariant::find($prod_id);
                        $diamonds = Diamond::find($diamond_id); 
                    }
                    if($products)
                    {
                        $item_array = array(
                            'item_id' => $prod_id,
                            'diamond_id' => $diamond_id,
                            'item_quantity' => $quantity,
                            'item_type' => $item_type,
                            'specification' => $arrspe
                        );
                        $cart_data[] = $item_array;

                        $item_data = json_encode($cart_data);
                        $minutes = Config::get('constants.cookie_time');
                        Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                        return response()->json(['status'=>'200']);
                    }
                }
        }
        }

        return response()->json(['status' => '200']); 


    }

    public function index()
    {
        //dd(session('coupon.discount_type_id'));
        if(session()->has('customer')){
            $cart_data = ItemCart::where('user_id',session('customer.id'))->get()->toArray();
        }else{
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
        }
        $setting = Settings::first();
        $meta_title = "Cart";
        $meta_description = "Cart";
        $BlogBanners = BlogBanner::where(['estatus' => 1,'page' => 2])->get()->ToArray();
        return view('frontend.cart',compact('setting','BlogBanners'))->with('cart_data',$cart_data)->with(['meta_title'=>$meta_title,'meta_description'=>$meta_description]);
    }

    public function addtocart(Request $request)
    {
        
        $data = $request->all();
        $prod_id = (isset($data['variant_id']) && $data['variant_id']) ? $data['variant_id'] : 0;
        $diamond_id = (isset($data['diamond_id']) && $data['diamond_id']) ? $data['diamond_id'] : 0;
        $action = (isset($data['action']) && $data['action']) ? $data['action'] : "";
        $quantity = $request->input('quantity');
        $item_type = $request->input('item_type');
        $arrspe = $request->input('arrspe');

        if(session()->has('customer')){
            $user_id = session('customer.id');
            $cart_data = ItemCart::where(['user_id' => session('customer.id'),'item_id' => $prod_id,'diamond_id' => $diamond_id,'item_type' => $item_type])->first();
            if($cart_data){
                if($action == 'update_qty'){
                    ItemCart::where(['user_id' => session('customer.id'),'item_id' => $prod_id,'item_type' => $item_type])->update([
                        'item_quantity' =>  $quantity
                       ]);   
                }else{
                    ItemCart::where(['user_id' => session('customer.id'),'item_id' => $prod_id,'item_type' => $item_type])->update([
                        'item_quantity' => $cart_data['item_quantity'] + $quantity
                       ]);
                }
                
                return response()->json(['status'=>'Add to cart']);
            }else{
                $cart = New ItemCart();
                $cart->user_id = $user_id;
                $cart->item_id = $prod_id;
                $cart->diamond_id = $diamond_id;
                $cart->item_quantity = $quantity;
                $cart->item_type = $item_type;
                $cart->specification = (isset($arrspe) && $arrspe != "")?json_encode($arrspe) :"";
                $cart->save();
                return response()->json(['status'=>'Add to cart']);
            }
        }else{    
            if(Cookie::get('shopping_cart'))
            {
                $cookie_data = stripslashes(Cookie::get('shopping_cart'));
                $cart_data = json_decode($cookie_data, true);
            }
            else
            {
                $cart_data = array();
            }
            $item_id_list = array_column($cart_data, 'item_id');
            $diamond_id_list = array_column($cart_data, 'diamod_id');
            $prod_id_is_there = $prod_id;
            $diamond_id_is_there = $diamond_id;

            if(in_array($prod_id_is_there, $item_id_list) && in_array($diamond_id_is_there, $diamond_id_list))
            {
                foreach($cart_data as $keys => $values)
                {
                    if($cart_data[$keys]["item_id"] == $prod_id && $cart_data[$keys]["diamond_id"] == $diamond_id)
                    {
                        if($action == 'update_qty'){
                           $cart_data[$keys]["item_quantity"] = $request->input('quantity');
                        }else{
                            $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $request->input('quantity'); 
                        }
                        $item_data = json_encode($cart_data);
                        $minutes = Config::get('constants.cookie_time');
                        Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                        return response()->json(['status'=>'Added to Cart','status2'=>'2']);
                    }else{
                        if($action == 'update_qty'){
                            $cart_data[$keys]["item_quantity"] = $request->input('quantity');
                        }else{
                             $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $request->input('quantity'); 
                        }
                    
                        $item_data = json_encode($cart_data);
                        $minutes = Config::get('constants.cookie_time');
                        Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                        return response()->json(['status'=>'Added to Cart','status2'=>'2']);
                    }
                }
               

            }elseif(in_array($prod_id_is_there, $item_id_list)){
                
                foreach($cart_data as $keys => $values)
                {
                    if($cart_data[$keys]["item_id"] == $prod_id)
                    {
                        if($action == 'update_qty'){
                            $cart_data[$keys]["item_quantity"] = $request->input('quantity');
                        }else{
                             $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $request->input('quantity'); 
                        }
                        $item_data = json_encode($cart_data);
                        $minutes = Config::get('constants.cookie_time');
                        Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                        return response()->json(['status'=>'Added to Cart','status2'=>'2']);
                    }
                }

            }
            else
            {
                if($item_type == 0){
                    $products = ProductVariant::find($prod_id);
                }elseif($item_type == 1){
                    $products = Diamond::find($prod_id);
                }else{
                    $products = ProductVariant::find($prod_id);
                    $diamonds = Diamond::find($diamond_id); 
                }
                if($products)
                {
                    $item_array = array(
                        'item_id' => $prod_id,
                        'diamond_id' => $diamond_id,
                        'item_quantity' => $quantity,
                        'item_type' => $item_type,
                        'specification' => $arrspe
                    );
                    $cart_data[] = $item_array;

                    $item_data = json_encode($cart_data);
                    $minutes = Config::get('constants.cookie_time');
                    Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                    return response()->json(['status'=>' Added to Cart']);
                }
            }
        }
    }

    public function cartloadbyajax()
    {
        $totalcart = "0";
        if(session()->has('customer')){
            $cart_data = ItemCart::select(['id'])->where('user_id',session('customer.id'))->count();
            if($cart_data > 0){
                return json_encode(array('totalcart' => count($cart_data)));
            }else{
                return json_encode(array('totalcart' => $totalcart));
            }
        }else{
            if(Cookie::get('shopping_cart'))
            {
                $cookie_data = stripslashes(Cookie::get('shopping_cart'));
                $cart_data = json_decode($cookie_data, true);
                $totalcart = count($cart_data);
                return json_encode(array('totalcart' => $totalcart));
            }
            else
            {
                return json_encode(array('totalcart' => $totalcart));
                
            }
        }    
    }

    public function deletefromcart(Request $request)
    {
        $prod_id = $request->input('product_id');
        //$item_type = $request->input('item_type');
        
        if(session()->has('customer')){
            $cart_data = ItemCart::where(['user_id' => session('customer.id'),'item_id' => $prod_id])->first();
            if($cart_data){
              $cart_data->delete();
            }
            return response()->json(['status'=>'Item Removed from Wish List']);
          }else{
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);

            $item_id_list = array_column($cart_data, 'item_id');
            $prod_id_is_there = $prod_id;

            if(in_array($prod_id_is_there, $item_id_list))
            {
                foreach($cart_data as $keys => $values)
                {
                    if($cart_data[$keys]["item_id"] == $prod_id)
                    {
                        unset($cart_data[$keys]);
                        $item_data = json_encode($cart_data);
                        $minutes = Config::get('constants.cookie_time');
                        Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                        return response()->json(['status'=>'Item Removed from Cart']);
                    }
                }
            }
          }
        
    }

    public function clearcart()
    {
        Cookie::queue(Cookie::forget('shopping_cart'));
        return response()->json(['status'=>'Your Cart is Cleared']);
    }

    public function redeem_coupon(Request $request)
    {
        $messages = [
            'coupon_code.required' =>'Please provide a coupon code',
        ];

        $validator = Validator::make($request->all(), [
            'coupon_code' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $coupon = Coupon::where('coupon_code', $request->coupon_code)->first();
        if (!$coupon) {
            return response()->json(['status' => '400','message'=>' Invalid coupon code. Please try again.']);
        }
        $data = [
            'discount_type_id' => $coupon->discount_type_id,
            'coupon_amount' => $coupon->coupon_amount,
            'usage_per_user' => $coupon->usage_per_user
        ];
        $request->session()->put('coupon',  $data);

        return response()->json(['status' => '200','message'=>' Coupon has been applied!','data' => $data]);

        //return redirect()->back()->with('success_message', 'Coupon has been applied!');
    }

    public function cart_products(Request $request){
        $data = $request->all();
        
        
            $output = '';
          
            if(session()->has('customer')){
                $cart_data = ItemCart::where('user_id',session('customer.id'))->get()->toArray();
            }else{
                $cookie_data = stripslashes(Cookie::get('shopping_cart'));
                $cart_data = json_decode($cookie_data,true);
            }
            
     
                
                if(count($cart_data) > 0){
                    foreach($cart_data as $data){
            
                        $diamond_name = "";
                        $diamond_terms = "";
                        if(isset($data['item_type']) && $data['item_type'] == 2){
                            $item = \App\Models\ProductVariant::with('product','product_variant_variants.attribute_term.attribute')->where('estatus',1)->where('id',$data['item_id'])->first();
                            if(!$item){
                                if(session()->has('customer')){
                                    $cart_data = \App\Models\ItemCart::where(['user_id' => session('customer.id'),'item_id' => $data['item_id']])->first();
                                    if($cart_data){
                                    $cart_data->delete();
                                    }
                                    return response()->json(['status'=>'Item Removed from Wish List']);
                                }else{
                                    $cookie_data = stripslashes(Cookie::get('shopping_cart'));
                                    $cart_data = json_decode($cookie_data, true);

                                    $item_id_list = array_column($cart_data, 'item_id');
                                    $prod_id_is_there = $data['item_id'];

                                    if(in_array($prod_id_is_there, $item_id_list))
                                    {
                                        foreach($cart_data as $keys => $values)
                                        {
                                            if($cart_data[$keys]["item_id"] == $data['item_id'])
                                            {
                                                unset($cart_data[$keys]);
                                                $item_data = json_encode($cart_data);
                                                $minutes = Config::get('constants.cookie_time');
                                                Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                                                return response()->json(['status'=>'Item Removed from Cart']);
                                            }
                                        }
                                    }
                                }  
                            }
                            
                            $item_name = $item->product->product_title;
                            $sale_price = $item->sale_price;
                            $item_image = explode(',',$item->images); 
                            if(session()->has('customer')){
                                $specifications = json_decode($data['specification'],true);
                            }else{
                                $specifications = $data['specification'];
                            }
                            $diamond = \App\Models\Diamond::where('id',$data['diamond_id'])->first();
                            $diamond_name = $diamond->short_title;
                            $diamond_terms = $diamond->Clarity .' Clarity | '. $diamond->Color .' Color | '. $diamond->Lab .' Certified';
                            $sale_price_diamond = $diamond->Sale_Amt;
                            $item_image_diamond = explode(',',$diamond->Stone_Img_url); 
                            $url =  "";
                            $sale_price = $sale_price + $sale_price_diamond;
                        } elseif(isset($data['item_type']) && $data['item_type'] == 0){
                            $item = \App\Models\ProductVariant::with('product','product_variant_variants.attribute_term.attribute')->where('estatus',1)->where('id',$data['item_id'])->first();
                            if(!$item){
                                if(session()->has('customer')){
                                    $cart_data = \App\Models\ItemCart::where(['user_id' => session('customer.id'),'item_id' => $data['item_id']])->first();
                                    if($cart_data){
                                    $cart_data->delete();
                                    }
                                    return response()->json(['status'=>'Item Removed from Wish List']);
                                }else{
                                    $cookie_data = stripslashes(Cookie::get('shopping_cart'));
                                    $cart_data = json_decode($cookie_data, true);

                                    $item_id_list = array_column($cart_data, 'item_id');
                                    $prod_id_is_there = $data['item_id'];

                                    if(in_array($prod_id_is_there, $item_id_list))
                                    {
                                        foreach($cart_data as $keys => $values)
                                        {
                                            if($cart_data[$keys]["item_id"] == $data['item_id'])
                                            {
                                                unset($cart_data[$keys]);
                                                $item_data = json_encode($cart_data);
                                                $minutes = Config::get('constants.cookie_time');
                                                Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                                                return response()->json(['status'=>'Item Removed from Cart']);
                                            }
                                        }
                                    }
                                }  
                            }
                            $item_name = $item->product->product_title;
                            $sale_price = $item->sale_price;
                            $item_image = explode(',',$item->images); 
                            if(session()->has('customer')){
                                $specifications = json_decode($data['specification'],true);
                            }else{
                                $specifications = $data['specification'];
                            }
                            $url =  URL('product-details/'.$item['slug']); 
                        }else{
                            $item = \App\Models\Diamond::where('id',$data['item_id'])->first();
                            if(!$item){
                                if(session()->has('customer')){
                                    $cart_datas = \App\Models\ItemCart::where(['user_id' => session('customer.id'),'item_id' => $data['item_id']])->first();
                                    //dd($cart_data);
                                    if($cart_datas){
                                    $cart_datas->delete();
                                    }
                                
                                }else{
                                    $cookie_data = stripslashes(Cookie::get('shopping_cart'));
                                    $cart_datas = json_decode($cookie_data, true);

                                    $item_id_list = array_column($cart_datas, 'item_id');
                                    $prod_id_is_there = $data['item_id'];

                                    if(in_array($prod_id_is_there, $item_id_list))
                                    {
                                        foreach($cart_datas as $keys => $values)
                                        {
                                            if($cart_datas[$keys]["item_id"] == $data['item_id'])
                                            {
                                                unset($cart_datas[$keys]);
                                                $item_data = json_encode($cart_datas);
                                                $minutes = Config::get('constants.cookie_time');
                                                Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                                            
                                            }
                                        }
                                    }
                                }  
                            }else{
                                $item_name = $item->short_title;
                                $item_terms = $item->Clarity .' Clarity | '. $item->Color .' Color | '. $item->Lab .' Certified';
                                $sale_price = $item->Sale_Amt;
                                $item_image = explode(',',$item->Stone_Img_url); 
                                $url =  url('labdiamond-details/'.$item->slug);

                            }
                            
                            
                        }
                 
                    if($item){
                       
                        $output .= '

                        <li class="">
                            <a href="'.$url.'" class="header-mega-menu-part">
                            <div class="d-flex">
                                    <span>
                                        <img src="'.asset($item_image[0]).'" alt="">
                                    </span>
                                    <span class="ms-3">
                                        <div class="product_name"> 
                                            '.$item_name.'
                                        </div>
                                        <div class="product_price">
                                            $ '.$sale_price.'
                                        </div>
                                    </span>
                                </div>
                            </a>
                        </li>
                    
                    ';
                    }
                }
                
                }else{
                    $output .= '';  
                } 
          
            
            
         
            return $output;
        
    } 
    
}
