<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ItemCart;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalPaymentController extends Controller
{
    public function handlePayment(Request $request)
    {
        // dd($request->all());
        $data = $request->all();
        $product = [];
        $product['items'] = [];
 
        $product['invoice_id'] = 1;
        $product['invoice_description'] = "Order #{$product['invoice_id']} Bill";
        $product['return_url'] = route('success.payment',$data);
        $product['cancel_url'] = route('cancel.payment');
        $product['total'] = $data['payble_ordercost'];

        // $product = [];
        // $product['items'] = [
        //     [
        //         'name' => 'Nike Joyride 2',
        //         'price' => 112,
        //         'desc'  => 'Running shoes for Men',
        //         'qty' => 2
        //     ]
        // ];
  

  
        $paypalModule = new ExpressCheckout;
  
        $res = $paypalModule->setExpressCheckout($product);
        $res = $paypalModule->setExpressCheckout($product, true);
        //dd($res);
        return redirect($res['paypal_link']);
    }
   
    public function paymentCancel()
    {
        dd('Your payment has been declend. The payment cancelation page goes here!');
    }
  
    public function paymentSuccess(Request $request)
    {
        $paypalModule = new ExpressCheckout;
        $response = $paypalModule->getExpressCheckoutDetails($request->token);
        //dd($response);
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {

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
        $order->payment_type = isset($request->payment_type) ? $request->payment_type : 1;
        $order->payment_transaction_id = isset($request->payment_transaction_id) ? $request->payment_transaction_id : $response['CORRELATIONID'];
        $order->payment_currency = isset($request->payment_currency) ? $request->payment_currency : $response['CURRENCYCODE'];
        $order->gateway_name = isset($request->gateway_name) ? $request->gateway_name : 'PAYPAL';
        $order->payment_mode = isset($request->payment_mode) ? $request->payment_mode : 'PAYPAL';
        $order->payment_date = isset($request->payment_date) ? $request->payment_date : '';
        $order->payment_status = isset($request->payment_status) ? $request->payment_status : '2';
        //$order->delivery_address = isset($request->delivery_address) ? $request->delivery_address : json_encode($user);
        $order->order_note = '';
        $order->order_status = 1;
        $order->delivery_date = Carbon::now();
        $order->save();

        //dd($request->all());
        //Save Order Item Data
        $order_item = array();
        foreach ($request->item as $key => $item){
            $OrderItem = new OrderItem();
            $OrderItem->order_id = $order->id;
            $OrderItem->payment_status = 2;
            $OrderItem->order_status = 1;
            $OrderItem->updated_by = 0;
            $OrderItem->order_note = '';
            $product_item = ProductVariant::with('product','product_variant_variants.attribute_term','product_variant_variants.attribute')->where('id',$item)->first();
           
            $spe = array();
            foreach($product_item->product_variant_variants as $product_variant_variant){
                $spe[] = array(
                    'term' => $product_variant_variant->attribute->attribute_name,
                    'term_name' => $product_variant_variant->attribute_term->attrterm_name
                );    
            }

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
            $order_item['totalItemAmount'] = $request->qty[$key] * $product_item->sale_price;
            $order_item['itemPayableAmt'] = $request->qty[$key] * $product_item->sale_price;
            $order_item['ProductTitle'] = $product_item->product->product_title;
            $image = explode(',',$product_item->images);
            $order_item['ProductImage'] = $image[0];
            $order_item['spe'] = $spe;
           
            $OrderItem->item_details = json_encode($order_item);
            $OrderItem->payment_action_date = isset($request->payment_date) ? $request->payment_date.' 00:00:00' : '';
            $OrderItem->save();    
        }

        $carts = ItemCart::where('user_id',session('customer.id'))->get();
        foreach ($carts as $cart){
        $cart->delete();
        }

        session()->forget('coupon');
       // session()->flush();

        return redirect(url('/paymentsuccess'));
          //return view('frontend.paymentsuccess');
        }
  
        dd('Error occured!');
    }

    public function paymentsuccesspage()
    {
        return view('frontend.paymentsuccess');
    }    

}
