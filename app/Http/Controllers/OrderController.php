<?php

namespace App\Http\Controllers;
use App\Models\Address;
use App\Models\ItemCart;
use App\Models\Order;
use App\Models\Settings;
use App\Models\Country;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function orders(){
        $orders = Order::where('user_id',session('customer.id'))->orderBy('id','desc')->get();
        $meta_title = "User Orders";
        $meta_description = "User Orders";
        return  view('frontend.myaccount_orders',compact('orders'))->with(['meta_title'=>$meta_title,'meta_description'=>$meta_description]);
    }

    public function orderdetails($order_id){
        $orderdetails = Order::with('order_item','address')->where(['user_id' => session('customer.id'),'id' => $order_id])->first();
        $meta_title = "User Order Details";
        $meta_description = "User Order Details";
        return  view('frontend.myaccount_orderdetail',compact('orderdetails'))->with(['meta_title'=>$meta_title,'meta_description'=>$meta_description]);
    }

    public function checkout(){
        $address = Address::where('user_id',session('customer.id'))->get();
        $carts = ItemCart::where('user_id',session('customer.id'))->get();
        $settings = Settings::find(1);
        $countries = Country::get(["name","id"]);

        $meta_title = "Checkout";
        $meta_description = "Checkout";
        return  view('frontend.Checkout',compact('address','carts','settings','countries'))->with(['meta_title'=>$meta_title,'meta_description'=>$meta_description]);
    }

    
}
