<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ItemCart;
use App\Models\ProductVariant;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Helpers;
use Exception;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PayPalPaymentController extends Controller
{

     public function handlePayment(Request $request)
    {
        try {

            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();

            // $totalAmount = $request->payble_ordercost ?? '1.00'; // default fallback
            $totalAmount = '1.00'; // default fallback

            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('paypal.payment.success'),
                    "cancel_url" => route('success.paymentcancel'),
                ],
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => $totalAmount,
                        ]
                    ]
                ]
            ]);

            if (isset($response['id']) && $response['id']) {
                foreach ($response['links'] as $link) {
                    if ($link['rel'] === 'approve') {
                        // Save preliminary order data in session
                        session([
                            'order_request_data' => $request->all(),
                            'paypal_order_id' => $response['id'],
                        ]);
                        return redirect()->away($link['href']);
                    }
                }
            }

            return redirect()->route('success.paymentcancel')->with('error', 'Unable to process payment.');
        } catch (Exception $e) {
            dd($e);
            Log::error("PayPal Payment Error: " . $e->getMessage());
            return redirect()->route('success.paymentcancel')->with('error', 'Payment failed.');
        }
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function paymentSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
         if (is_array($response) && isset($response['status']) && $response['status'] === 'COMPLETED') {

                 $orderData = session('order_request_data', []);
                 $paypalOrderId = session('paypal_order_id');

                // Generate custom order ID
                    $last_order_id = Order::orderBy('id', 'desc')->pluck('id')->first();
                    $next_order_id = str_pad((int)$last_order_id + 1, 4, '0', STR_PAD_LEFT);
                    $custom_order_id = Carbon::now()->format('ymd') . $next_order_id;

                    // Fetch address info
                    $address_info = Address::find($orderData['address_id']);
                    $userDetails = [
                        'CustomerName' => $address_info->first_name . ' ' . $address_info->last_name,
                        'CustomerMobile' => $address_info->mobile_no,
                        'DelAddress1' => $address_info->address,
                        'DelAddress2' => $address_info->address2,
                        'City' => $address_info->city,
                        'State' => $address_info->state,
                        'Country' => $address_info->country,
                        'Pincode' => $address_info->pincode
                    ];

                    // Create Order
                    $order = new Order();
                    $order->user_id = $address_info->user_id;
                    $order->address_id = $orderData['address_id'];
                    $order->custom_orderid = $custom_order_id;
                    $order->sub_totalcost = $orderData['sub_totalcost'] ?? null;
                    $order->shipping_charge = $orderData['shipping_charge'] ?? 0;
                    $order->discount_amount = $orderData['coupan_discount'] ?? 0;
                    $order->coupan_code_id = $orderData['coupan_code_id'] ?? 0;
                    $order->total_ordercost = $orderData['payble_ordercost'] ?? null;
                    $order->payment_type = $orderData['payment_type'] ?? 1;
                    $order->payment_transaction_id = isset($response['id']) ? $response['id'] :"";
                    $order->payment_currency = isset($response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code']) ? $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'] :"USD";
                    $order->gateway_name = $orderData['gateway_name'] ?? 'PAYPAL';
                    $order->payment_mode = $orderData['payment_mode'] ?? 'PAYPAL';
                    $order->payment_date = Carbon::now()->format('Y-m-d H:i:s');
                    $order->payment_status = $orderData['payment_status'] ?? '2';
                    $order->delivery_address = $orderData['delivery_address'] ?? json_encode($userDetails);
                    $order->order_note = '';
                    $order->order_status = 1;
                    $order->save();

                    // Send confirmation email
                    if ($order) {
                        $user = User::find(session('customer.id'));
                        $emailData = [
                            'CustomerFullAddr' => implode(',', [
                                $address_info->address,
                                $address_info->city,
                                $address_info->state,
                                $address_info->pincode,
                                $address_info->country
                            ]),
                            'OrderId' => $order->custom_orderid,
                            'CustomerName' => $userDetails['CustomerName'],
                            'OrderStatus' => 'New Order',
                            'OrderMessage' => 'Thank you for shopping with Gemver Affordable Luxury Diamonds! We’re glad to inform you that we’ve received your order.'
                        ];

                        if (!empty($user->email)) {
                            Helpers::MailSending('email.mailDataorder', $emailData, $user->email, 'New Order');
                        }
                    }

                    // Process each item
                    foreach ($orderData['item'] as $key => $itemId) {
                        $OrderItem = new OrderItem();
                        $OrderItem->order_id = $order->id;
                        $OrderItem->payment_status = 2;
                        $OrderItem->order_status = 1;
                        $OrderItem->updated_by = 0;
                        $OrderItem->order_note = '';

                        $itemType = $orderData['item_type'][$key];
                        $quantity = $orderData['qty'][$key];
                        $diamondId = $orderData['diamond_id'][$key] ?? null;
                        $certificate_price = $orderData['certificate_price'][$key] ?? null;
                        

                        $itemDetails = [];
                        $spe = [];
                        $sped = [];
                        $diamond_name = '';
                        $diamond_image = [''];

                        if ($itemType == 0) {
                            $product = ProductVariant::with(['product', 'product_variant_variants.attribute_term', 'product_variant_variants.attribute'])->find($itemId);
                            foreach ($product->product_variant_variants as $variant) {
                                $spe[] = [
                                    'term' => $variant->attribute->attribute_name,
                                    'term_name' => $variant->attribute_term->attrterm_name
                                ];
                            }
                            $item_name = $product->product->product_title;
                            $item_image = explode(',', $product->images);
                            $sale_price = $product->sale_price;
                        } elseif ($itemType == 1) {
                            $diamond = \App\Models\Diamond::find($itemId);
                            $item_name = "{$diamond->Shape} " . round($diamond->Weight, 2) . " ct";
                            $item_image = explode(',', $diamond->Stone_Img_url);
                            $sale_price = $diamond->Sale_Amt;

                            $spe = [
                                ['term_name' => $diamond->Clarity, 'term' => 'Clarity'],
                                ['term_name' => $diamond->Color, 'term' => 'Color'],
                                ['term_name' => $diamond->Lab, 'term' => 'certified']
                            ];
                        } else {
                            $product = ProductVariant::with(['product', 'product_variant_variants.attribute_term', 'product_variant_variants.attribute'])->find($itemId);
                            $diamond = \App\Models\Diamond::find($diamondId);

                            foreach ($product->product_variant_variants as $variant) {
                                $spe[] = [
                                    'term' => $variant->attribute->attribute_name,
                                    'term_name' => $variant->attribute_term->attrterm_name
                                ];
                            }

                            $item_image = explode(',', $product->images);
                            $diamond_image = explode(',', $diamond->Stone_Img_url);
                            $diamond_name = $diamond->long_title ?? '';
                            $item_name = $product->product->product_title;
                            $sale_price = $product->sale_price + $diamond->Sale_Amt;

                            $sped = [
                                ['term_name' => $diamond->Clarity, 'term' => 'Clarity'],
                                ['term_name' => $diamond->Color, 'term' => 'Color'],
                                ['term_name' => $diamond->Lab, 'term' => 'certified']
                            ];
                        }

                        $itemDetails = [
                            'variantId' => $itemId,
                            'diamondId' => $diamondId ?? 0,
                            'itemQuantity' => $quantity,
                            'orderItemPrice' => $sale_price,
                            'totalItemAmount' => $quantity * $sale_price,
                            'itemPayableAmt' => $quantity * $sale_price,
                            'ProductTitle' => $item_name,
                            'DiamondTitle' => $diamond_name,
                            'ProductImage' => $item_image[0] ?? '',
                            'DiamondImage' => $diamond_image[0] ?? '',
                            'ItemType' => $itemType,
                            'spe' => $spe,
                            'sped' => $sped,
                            'certificate_price'=>$certificate_price,
                        ];

                        $OrderItem->item_details = json_encode($itemDetails);
                        $OrderItem->payment_action_date = Carbon::now()->format('Y-m-d H:i:s');
                        $OrderItem->save();
                    }

                // Clear cart
                ItemCart::where('user_id', session('customer.id'))->delete();

                session()->forget('coupon');

            return redirect()
                ->route('success.paymentsuccess')
                ->with('success', 'Transaction complete.');
        } else {
           return redirect(url('/paymentcancel'));
        }
    }

    public function paymentsuccesspage()
    {
        return view('frontend.paymentsuccess');
    }
    
    public function paymentcancelpage()
    {
        return view('frontend.paymentcancel');
    }


    // public function handlePayment(Request $request)
    // {
    //     $data = $request->all();
    //     $product = [];
    //     $product['items'] = [];
 
    //     $product['invoice_id'] = 1;
    //     $product['invoice_description'] = "Order #{$product['invoice_id']} Bill";
    //     $product['return_url'] = route('success.payment',$data);
    //     $product['cancel_url'] = route('cancel.payment');
    //     $product['total'] = $data['payble_ordercost'];

    //     // $product = [];
    //     // $product['items'] = [
    //     //     [
    //     //         'name' => 'Nike Joyride 2',
    //     //         'price' => 112,
    //     //         'desc'  => 'Running shoes for Men',
    //     //         'qty' => 2
    //     //     ]
    //     // ];
  
    //     // $paypalModule = new ExpressCheckout;
  
    //     // $res = $paypalModule->setExpressCheckout($product);
    //     // $res = $paypalModule->setExpressCheckout($product, true);
    //     // //dd($res);
    //     // return redirect($res['paypal_link']);
    // }
   
    // public function paymentCancel()
    // {
    //     //dd('Your payment has been declend. The payment cancelation page goes here!');
    //     return redirect(url('/paymentcancel'));

    // }
  
    // public function paymentSuccess(Request $request)
    // {
   
    //     $paypalModule = new ExpressCheckout;
    //     $response = $paypalModule->getExpressCheckoutDetails($request->token);
    //     //dd($response);
    //     if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {

    //     $last_order_id = Order::orderBy('id','desc')->pluck('id')->first();
    //     if(isset($last_order_id)) {
    //         $last_order_id = $last_order_id + 1;
    //         $len_last_order_id = strlen($last_order_id);
    //         if($len_last_order_id == 1){
    //             $last_order_id = "000".$last_order_id;
    //         }
    //         elseif($len_last_order_id == 2){
    //             $last_order_id = "00".$last_order_id;
    //         }
    //         elseif($len_last_order_id == 3){
    //             $last_order_id = "0".$last_order_id;
    //         }
    //     }
    //     else{
    //         $last_order_id = "0001";
    //     }

    //     $address_info = Address::where('id',$request->address_id)->first();
    //     $user['CustomerName'] = isset($address_info->first_name) ? $address_info->first_name .' '.$address_info->last_name: '';
    //    // $user['CustomerLastName'] = isset($address_info->last_name) ? $address_info->last_name: '';
    //     $user['CustomerMobile'] = isset($address_info->mobile_no) ? $address_info->mobile_no: '';
    //     $user['DelAddress1'] = isset($address_info->address) ? $address_info->address: '';
    //     $user['DelAddress2'] = isset($address_info->address2) ? $address_info->address2: '';
    //     //$user['Landmark'] = isset($address_info->landmark) ? $address_info->landmark: '';
    //     $user['City'] = isset($address_info->city) ? $address_info->city: '';
    //     $user['State'] = isset($address_info->state) ? $address_info->state: '';
    //     $user['Country'] = isset($address_info->country) ? $address_info->country: '';
    //     $user['Pincode'] = isset($address_info->pincode) ? $address_info->pincode: '';
    //     $user_id = isset($address_info->user_id) ? $address_info->user_id: 0;
        
    
    //     $order = new Order();
    //     $order->user_id = $user_id;
    //     $order->address_id = $request->address_id;
    //     $order->custom_orderid = Carbon::now()->format('ymd') . $last_order_id;
    //     $order->sub_totalcost = isset($request->sub_totalcost) ? $request->sub_totalcost: null;
    //     $order->shipping_charge = isset($request->shipping_charge) ? $request->shipping_charge : 0;
    //     $order->discount_amount = isset($request->coupan_discount) ? $request->coupan_discount : 0;
    //     $order->coupan_code_id = isset($request->coupan_code_id) ? $request->coupan_code_id : 0;
    //     $order->total_ordercost = isset($request->payble_ordercost) ? $request->payble_ordercost : null;
    //     //$order->payble_ordercost = isset($request->payble_ordercost) ? $request->payble_ordercost : null;
    //     $order->payment_type = isset($request->payment_type) ? $request->payment_type : 1;
    //     $order->payment_transaction_id = isset($request->payment_transaction_id) ? $request->payment_transaction_id : $response['CORRELATIONID'];
    //     $order->payment_currency = isset($request->payment_currency) ? $request->payment_currency : $response['CURRENCYCODE'];
    //     $order->gateway_name = isset($request->gateway_name) ? $request->gateway_name : 'PAYPAL';
    //     $order->payment_mode = isset($request->payment_mode) ? $request->payment_mode : 'PAYPAL';
    //     $order->payment_date = isset($request->payment_date) ? $request->payment_date : '';
    //     $order->payment_status = isset($request->payment_status) ? $request->payment_status : '2';
    //     $order->delivery_address = isset($request->delivery_address) ? $request->delivery_address : json_encode($user);
    //     $order->order_note = '';
    //     $order->order_status = 1;
    //     //$order->delivery_date = Carbon::now();
    //     $order->save();

    //     if($order){
           
    //         $user = User::where('id',session('customer.id'))->first();
    //         $data1 = [
    //             'CustomerFullAddr' => $address_info->address.','.$address_info->city.','.$address_info->state.','.$address_info->pincode.','.$address_info->country,
    //             'OrderId' => $order->custom_orderid,
    //             'CustomerName' => isset($address_info->first_name) ? $address_info->first_name .' '.$address_info->last_name: '',
    //             'OrderStatus' => 'New Order',
    //             'OrderMessage' => 'Thank you for shopping with Gemver Affordable Luxury Diamonds! Where glad to inform you that weve received your order.',
    //         ];
            
    //         if(isset($user->email) && $user->email != ""){
    //             $templateName = 'email.mailDataorder';
    //             $mail_sending = Helpers::MailSending($templateName, $data1, $user->email, 'New Order');
    //         }
    //         //dd($mail_sending);
    //     }

    //     //dd($request->all());
    //     //Save Order Item Data
    //     $order_item = array();
    //     $diamond_name = "";
    //     $spe = array();
    //     $sped = array();
    //     foreach($request->item as $key => $item){
    //         $OrderItem = new OrderItem();
    //         $OrderItem->order_id = $order->id;
    //         $OrderItem->payment_status = 2;
    //         $OrderItem->order_status = 1;
    //         $OrderItem->updated_by = 0;
    //         $OrderItem->order_note = '';

            
    //         if($request->item_type[$key] == 0){
    //             $product_item = ProductVariant::with('product','product_variant_variants.attribute_term','product_variant_variants.attribute')->where('id',$item)->first();
            
    //             foreach($product_item->product_variant_variants as $product_variant_variant){
    //                 $spe[] = array(
    //                     'term' => $product_variant_variant->attribute->attribute_name,
    //                     'term_name' => $product_variant_variant->attribute_term->attrterm_name
    //                 );    
    //             }

    //             $sale_price = $product_item->sale_price;
    //             $item_image = explode(',',$product_item->images); 
    //             $item_name = $product_item->product->product_title;

    //         }else if($request->item_type[$key] == 1){
    //             $product_item = \App\Models\Diamond::where('id',$item)->first();
    //             $item_name = $product_item->Shape.' '. round($product_item->Weight,2) .' ct ';
               
    //             $sale_price = $product_item->Sale_Amt;
    //             $item_image = explode(',',$product_item->Stone_Img_url);
                
    //             $spe[] = array(
    //                 'term_name' => $product_item->Clarity,
    //                 'term' => 'Clarity'
    //             );

    //             $spe[] = array(
    //                 'term_name' => $product_item->Color,
    //                 'term' => 'Color'
    //             );

    //             $spe[] = array(
    //                 'term_name' => $product_item->Lab,
    //                 'term' => 'certified'
    //             );

    //         }else{

    //             $diamond_id = $request->diamond_id[$key];
    //             $product_item = ProductVariant::with('product','product_variant_variants.attribute_term','product_variant_variants.attribute')->where('id',$item)->first();
    //             foreach($product_item->product_variant_variants as $product_variant_variant){
    //                 $spe[] = array(
    //                     'term' => $product_variant_variant->attribute->attribute_name,
    //                     'term_name' => $product_variant_variant->attribute_term->attrterm_name
    //                 );    
    //             }
    //             $item_image = explode(',',$product_item->images); 

    //             $diamond_item = \App\Models\Diamond::where('id',$diamond_id)->first(); 
    //             $item_name =  $product_item->product->product_title; 
    //             // $diamond_name = $diamond_item->Shape.' '. round($diamond_item->Weight,2) .' ct ';
    //             $diamond_name = isset($diamond_item->long_title) ? $diamond_item->long_title : "";
    //             $sale_price = $product_item->sale_price + $diamond_item->Sale_Amt; 
    //             $diamond_image = explode(',',$diamond_item->Stone_Img_url); 

    //             $sped[] = array(
    //                 'term_name' => $diamond_item->Clarity,
    //                 'term' => 'Clarity'
    //             );

    //             $sped[] = array(
    //                 'term_name' => $diamond_item->Color,
    //                 'term' => 'Color'
    //             );

    //             $sped[] = array(
    //                 'term_name' => $diamond_item->Lab,
    //                 'term' => 'certified'
    //             );
                
               

    //         }


    //         // if($product_item != null){
    //         //     $product_item->total_orders = $product_item->total_orders + 1;
    //         //     if ($product_item->stock > 0) {
    //         //         $product_item->stock = $product_item->stock - $request->qty[$key];
    //         //         $product_item->save();
    //         //     }
    //         // }
            
    //         $order_item['variantId'] = $product_item->id;
    //         $order_item['diamondId'] = (isset($diamond_id))?$diamond_id:0;
    //         //$order_item['attribute'] = $product_item->product->attribute->attribute_name;
    //         //$order_item['attributeTerm'] = $product_item->attribute_term->attrterm_name;
    //         $order_item['itemQuantity'] = $request->qty[$key];
    //         $order_item['orderItemPrice'] = $sale_price;
    //         $order_item['totalItemAmount'] = $request->qty[$key] * $sale_price;
    //         $order_item['itemPayableAmt'] = $request->qty[$key] * $sale_price;
    //         $order_item['ProductTitle'] = $item_name;
    //         $order_item['DiamondTitle'] = $diamond_name;
    //         //$image = explode(',',$product_item->images);
    //         $order_item['ProductImage'] = $item_image[0];
    //         $order_item['DiamondImage'] = (isset($diamond_image[0]))?$diamond_image[0]:"";
    //         $order_item['ItemType'] = $request->item_type[$key];
    //         $order_item['spe'] = $spe;
    //         $order_item['sped'] = $sped;
           
    //         $OrderItem->item_details = json_encode($order_item);
    //         $OrderItem->payment_action_date = isset($request->payment_date) ? $request->payment_date.' 00:00:00' : '';
    //         $OrderItem->save();    
    //     }

    //     $carts = ItemCart::where('user_id',session('customer.id'))->get();
    //     foreach ($carts as $cart){
    //     $cart->delete();
    //     }

    //     session()->forget('coupon');
    //    // session()->flush();

    //     return redirect(url('/paymentsuccess'));
    //       //return view('frontend.paymentsuccess');
    //     }
  
    //     dd('Error occured!');
    // }


}
