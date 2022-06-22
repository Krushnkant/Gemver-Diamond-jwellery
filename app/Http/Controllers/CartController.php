<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use Illuminate\Http\Request;

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
    
}
