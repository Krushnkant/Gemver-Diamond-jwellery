<?php

namespace App\Http\Controllers;
use App\Models\Address;
use App\Models\ItemCart;
use App\Models\Order;
use App\Models\Diamond;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function orders(){
        $orders = Order::where('user_id',session('customer.id'))->orderBy('id','desc')->get();
        return  view('frontend.myaccount_orders',compact('orders'));
    }

    public function orderdetails($order_id){
        $orderdetails = Order::with('order_item','address')->where(['user_id' => session('customer.id'),'id' => $order_id])->first();
        return  view('frontend.myaccount_orderdetail',compact('orderdetails'));
    }

    public function checkout(){
        $address = Address::where('user_id',session('customer.id'))->get();
        $carts = ItemCart::where('user_id',session('customer.id'))->get();
        return  view('frontend.Checkout',compact('address','carts'));
    }

    
}
