<?php

namespace App\Http\Controllers;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Cookie;
use App\Models\Cart;
use App\Models\ItemCart;
use App\Models\Coupon;
use App\Models\Diamond;
use Illuminate\Http\Request;
use Config;

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
        return view('frontend.cart')->with('cart_data',$cart_data);
    }

    public function addtocart(Request $request)
    {
        
        $data = $request->all();
        $prod_id = (isset($data['variant_id']) && $data['variant_id']) ? $data['variant_id'] : 0;
        $diamond_id = (isset($data['diamond_id']) && $data['diamond_id']) ? $data['diamond_id'] : 0;
        $quantity = $request->input('quantity');
        $item_type = $request->input('item_type');
        $arrspe = $request->input('arrspe');

        if(session()->has('customer')){
            $user_id = session('customer.id');
            $cart_data = ItemCart::where(['user_id' => session('customer.id'),'item_id' => $prod_id,'diamond_id' => $diamond_id,'item_type' => $item_type])->first();
            if($cart_data){
                ItemCart::where(['user_id' => session('customer.id'),'item_id' => $prod_id,'item_type' => $item_type])->update([
                                 'item_quantity' => $cart_data['item_quantity'] + $quantity
                                ]);
                return response()->json(['status'=>'Added to Cart']);
            }else{
                $cart = New ItemCart();
                $cart->user_id = $user_id;
                $cart->item_id = $prod_id;
                $cart->diamond_id = $diamond_id;
                $cart->item_quantity = $quantity;
                $cart->item_type = $item_type;
                $cart->specification = $arrspe;
                $cart->save();
                return response()->json(['status'=>'Added to Cart']);
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

            if(in_array($prod_id_is_there, $item_id_list) && in_array($diamond_id_is_there, $diamond_id_list)){

                foreach($cart_data as $keys => $values)
                {
                    if($cart_data[$keys]["item_id"] == $prod_id && $cart_data[$keys]["diamond_id"] == $diamond_id)
                    {
                        $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $request->input('quantity');
                        $item_data = json_encode($cart_data);
                        $minutes = Config::get('constants.cookie_time');
                        Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                        return response()->json(['status'=>'Added to Cart','status2'=>'2']);
                    }else{
                        $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $request->input('quantity');
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
                        $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $request->input('quantity');
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
        if(session()->has('customer')){
            $cart_data = ItemCart::where('user_id',session('customer.id'))->get()->toArray();
            if(count($cart_data) > 0){
            echo json_encode(array('totalcart' => count($cart_data))); die;
            return;
        }else{
            $totalcart = "0";
            echo json_encode(array('totalcart' => $totalcart)); die;
            return;  
        }
        }else{
            if(Cookie::get('shopping_cart'))
            {
                $cookie_data = stripslashes(Cookie::get('shopping_cart'));
                $cart_data = json_decode($cookie_data, true);
                $totalcart = count($cart_data);

                echo json_encode(array('totalcart' => $totalcart)); die;
                return;
            }
            else
            {
                $totalcart = "0";
                echo json_encode(array('totalcart' => $totalcart)); die;
                return;
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
    
}
