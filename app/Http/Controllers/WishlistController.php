<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Cookie;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index()
    {
        if(session()->has('customer')){
            $wishlist_data = Wishlist::where('user_id',session('customer.id'))->get()->toArray();
        }else{
            $cookie_data = stripslashes(Cookie::get('product_wishlist'));
            $wishlist_data = json_decode($cookie_data, true);
        }
        return view('frontend.wishlist')->with('wishlist_data',$wishlist_data);
    }

    public function addtowishlist(Request $request)
    {
        $variant_id = $request->input('variant_id');
        $item_type = $request->input('item_type');

        if(session()->has('customer')){
            
        $user_id = session('customer.id');
        $wishlist_data = Wishlist::where(['user_id' => session('customer.id'),'item_id' => $variant_id,'item_type' => $item_type])->first();
        if($wishlist_data){
            $wishlist_data->delete();
            return response()->json(['status'=>'Item Removed from Wish List','action' => 'remove']);
        }else{
            $wish = New Wishlist();
            $wish->user_id = $user_id;
            $wish->item_id = $variant_id;
            $wish->item_type = $item_type;
            $wish->save();
            return response()->json(['status'=>'Added to Wish List','action' => 'add']);
        }
        }else{
            if(Cookie::get('product_wishlist'))
            {
                $cookie_data = stripslashes(Cookie::get('product_wishlist'));
                $wishlist_data = json_decode($cookie_data, true);
            }
            else
            {
                $wishlist_data = array();
            }

            $item_id_list = array_column($wishlist_data, 'item_id');
            $variant_id_is_there = $variant_id;

            if(in_array($variant_id_is_there, $item_id_list))
            {
                foreach($wishlist_data as $keys => $values)
                {
                    if($wishlist_data[$keys]["item_id"] == $variant_id)
                    {
                        // $item_data = json_encode($wishlist_data);
                        // $minutes = 60;
                        // Cookie::queue(Cookie::make('product_wishlist', $item_data, $minutes));
                        // return response()->json(['status'=>'"'.$wishlist_data[$keys]["item_name"].'" Already Added to Wish List','status2'=>'2']);

                        unset($wishlist_data[$keys]);
                        $item_data = json_encode($wishlist_data);
                        $minutes = 60;
                        Cookie::queue(Cookie::make('product_wishlist', $item_data, $minutes));
                        return response()->json(['status'=>'Item Removed from Wish List','action' => 'remove']);
                    }
                }
            }
            else
            {
                $products = ProductVariant::with('product')->find($variant_id);
                $prod_name = $products->product->product_title;
                if($products)
                {
                    $item_array = array(
                        'item_id' => $variant_id,
                        'item_type' => $item_type
                    );
                    $wishlist_data[] = $item_array;

                    $item_data = json_encode($wishlist_data);
                    $minutes = 60;
                    Cookie::queue(Cookie::make('product_wishlist', $item_data, $minutes));
                    return response()->json(['status'=>'"'.$prod_name.'" Added to Wish List','action' => 'add']);
                }
            }
        }    
    }

    public function wishloadbyajax()
    {
        if(session()->has('customer')){
            $wishlist_data = Wishlist::where('user_id',session('customer.id'))->get()->toArray();
            if(count($wishlist_data) > 0){
            echo json_encode(array('totalwishlist' => count($wishlist_data))); die;
            return;
        }else{
            $totalwishlist = "0";
            echo json_encode(array('totalwishlist' => $totalwishlist)); die;
            return;  
        }
        }else{
            if(Cookie::get('product_wishlist'))
            {
                $cookie_data = stripslashes(Cookie::get('product_wishlist'));
                $wishlist_data = json_decode($cookie_data, true);
                $totalwishlist = count($wishlist_data);

                echo json_encode(array('totalwishlist' => $totalwishlist)); die;
                return;
            }
            else
            {
                $totalwishlist = "0";
                echo json_encode(array('totalwishlist' => $totalwishlist)); die;
                return;
            }
        }
    }

    public function deletefromwishlist(Request $request)
    {
        $variant_id = $request->input('variant_id');
        $item_type = $request->input('item_type');
        
        if(session()->has('customer')){
          $wishlist_data = Wishlist::where(['user_id' => session('customer.id'),'item_id' => $variant_id,'item_type' => $item_type])->first();
          if($wishlist_data){
            $wishlist_data->delete();
          }
          return response()->json(['status'=>'Item Removed from Wish List']);
        }else{
            $cookie_data = stripslashes(Cookie::get('product_wishlist'));
            $wishlist_data = json_decode($cookie_data, true);

            $item_id_list = array_column($wishlist_data, 'item_id');
            $variant_id_is_there = $variant_id;

            if(in_array($variant_id_is_there, $item_id_list))
            {
                foreach($wishlist_data as $keys => $values)
                {
                    if($wishlist_data[$keys]["item_id"] == $variant_id)
                    {
                        unset($wishlist_data[$keys]);
                        $item_data = json_encode($wishlist_data);
                        $minutes = 60;
                        Cookie::queue(Cookie::make('product_wishlist', $item_data, $minutes));
                        return response()->json(['status'=>'Item Removed from Wish List']);
                    }
                }
            }
        }    
    }

}
