<?php

namespace App\Http\Controllers;
use App\Models\Address;
use App\Models\ItemCart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function orders(){
        $orders = Order::where('user_id',session('customer.id'))->get();
        return  view('frontend.myaccount_orders',compact('orders'));
    }

    public function checkout(){
        $address = Address::where('user_id',session('customer.id'))->get();
        $carts = ItemCart::where('user_id',session('customer.id'))->get();
        return  view('frontend.Checkout',compact('address','carts'));
    }

    public function saveorder(Request $request){
     
        $validator = Validator::make($request->all(), [
            'address_id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        //dd($request->item_id);
        $last_order_id = Order::orderBy('id','desc')->pluck('id')->first();
        if(isset($last_order_id)) {
            $last_order_id = $last_order_id + 1;
            $len_last_order_id = strlen($last_order_id);
            if($len_last_order_id == 1){
                $last_order_id = "000".$last_order_id;
            }
            elseif($len_last_order_id == 2){
                $last_order_id = "00".$last_order_id;
            }
            elseif($len_last_order_id == 3){
                $last_order_id = "0".$last_order_id;
            }
        }
        else{
            $last_order_id = "0001";
        }

    

        $order = new Order();
        $order->user_id = session('customer.id');
        $order->address_id = $request->address_id;
        $order->custom_orderid = Carbon::now()->format('ymd') . $last_order_id;
        $order->sub_totalcost = isset($request->sub_totalcost) ? $request->sub_totalcost: null;
        $order->shipping_charge = isset($request->shipping_charge) ? $request->shipping_charge : 0;
        $order->discount_amount = isset($request->coupan_discount) ? $request->coupan_discount : 0;
        $order->coupan_code_id = isset($request->coupan_code_id) ? $request->coupan_code_id : 0;
        $order->total_ordercost = isset($request->payble_ordercost) ? $request->payble_ordercost : null;
        //$order->payble_ordercost = isset($request->payble_ordercost) ? $request->payble_ordercost : null;
        $order->payment_type = isset($request->payment_type) ? $request->payment_type : 2;
        $order->payment_transaction_id = isset($request->payment_transaction_id) ? $request->payment_transaction_id : '';
        $order->payment_currency = isset($request->payment_currency) ? $request->payment_currency : 'USB';
        $order->gateway_name = isset($request->gateway_name) ? $request->gateway_name : 'PAYPAL';
        $order->payment_mode = isset($request->payment_mode) ? $request->payment_mode : 'PAYPAL';
        $order->payment_date = isset($request->payment_date) ? $request->payment_date : '';
        $order->payment_status = isset($request->payment_status) ? $request->payment_status : '2';
        //$order->delivery_address = isset($request->delivery_address) ? $request->delivery_address : json_encode($user);
        $order->order_note = '';
        $order->order_status = 3;
        $order->delivery_date = Carbon::now();
        $order->save();

    
        //Save Order Item Data
        $order_item = array();
        foreach ($request->item_id as $key => $item){
            $OrderItem = new OrderItem();
            $OrderItem->order_id = $order->id;
            $OrderItem->payment_status = 2;
            $OrderItem->order_status = 3;
            $OrderItem->updated_by = 0;
            $OrderItem->order_note = '';
            $product_item = ProductVariant::with('product.attribute','attribute_term')->where('id',$item)->first();

            // if($product_item != null){
            //     $product_item->total_orders = $product_item->total_orders + 1;
            //     if ($product_item->stock > 0) {
            //         $product_item->stock = $product_item->stock - $request->qty[$key];
            //         $product_item->save();
            //     }
            // }
            
            $order_item['variantId'] = $product_item->id;
            //$order_item['attribute'] = $product_item->product->attribute->attribute_name;
            //$order_item['attributeTerm'] = $product_item->attribute_term->attrterm_name;
            $order_item['itemQuantity'] = $request->qty[$key];
            $order_item['orderItemPrice'] = $product_item->sale_price;
            $order_item['SubDiscount'] = 0;
            $order_item['totalItemAmount'] = $request->qty[$key] * $product_item->sale_price;
            $order_item['itemPayableAmt'] = $request->qty[$key] * $product_item->sale_price;
            $order_item['ProductTitle'] = $product_item->product_title;
           
            $OrderItem->item_details = json_encode($order_item);
            $OrderItem->payment_action_date = isset($request->payment_date) ? $request->payment_date.' 00:00:00' : '';
            $OrderItem->save();  
        }

    
        //return $this->sendResponseSuccess("Order Submitted Successfully");
        return ['status' => 200 ];
    }
}
