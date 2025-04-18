<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Models\ContactUs;
use App\Models\Inquiry;
use App\Models\Cart;
use App\Models\Diamond;
use App\Models\Product;
use App\Models\SmilingDifference;
use App\Models\ProductVariant;
use App\Models\ProductVariantVariant;
use App\Models\AttributeTerm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers;
use Illuminate\Support\Facades\Cookie;
use App\Models\ItemCart;


class ContactUsController extends Controller
{

    public function index()
    {
        $settings = Settings::first();
        $products = Product::select('products.*', 'product_variants.slug', 'product_variants.alt_text', 'product_variants.images', 'product_variants.regular_price', 'product_variants.sale_price', 'product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->where(['products.is_custom' => 0, 'products.estatus' => 1, 'product_variants.estatus' => 1])->groupBy('products.id')->orderBy('products.created_at', 'DESC')->limit(12)->get();
        $SmilingDifference = SmilingDifference::get();
        $meta_title = "Contact Us";
        $meta_description = "Contact Us";
        return view('frontend.contactus', compact('settings', 'products', 'SmilingDifference'))->with(['meta_title' => $meta_title, 'meta_description' => $meta_description]);
        ;
    }

    public function save(Request $request)
    {
        $setting = Settings::first();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile_no' => 'required|regex:/^[6-9][0-9]{9}$/|digits:10',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => 'failed']);
        } else {
            $data = $request->all();
            $contact = ContactUs::Create($data);
            if ($contact != null) {

                $data1 = [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'mobile_no' => $data['mobile_no'],
                    'message1' => $contact->message
                ];

                $data2 = [
                    'message1' => 'Thank You For Contact Inquiry'
                ];
                $templateName = 'email.mailData';

                $mail_sending = Helpers::MailSending($templateName, $data2, $contact->email, $contact->subject);
                //$mail_sending1 = Helpers::MailSending($templateName, $data1, $setting->send_email, $contact->subject);
                return response()->json(['status' => '200']);
            }
        }
    }

    public function inquiry_save(Request $request)
    {
        $setting = Settings::first();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile_no' => 'required|regex:/^[6-9][0-9]{9}$/|digits:10',
            'email' => 'required',
            'inquiry' => 'required'
        ]);

        if ($request->whatsapp_number != "") {
            $validator = Validator::make($request->all(), [
                'whatsapp_number' => 'regex:/^[6-9][0-9]{9}$/|digits:10',
            ]);
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => 'failed']);
        } else {
            $data = $request->all();
            $inquiry = Inquiry::Create($data);
            if (isset($data['stone_no'])) {
                $ip_address = $request->ip();
                $cart = Cart::where(['ip_address' => $ip_address]);
                $cart->delete();
            }
            if ($inquiry != null) {
                $product_info = "";
                $diamond_info = "";
                //dd($inquiry);
                // echo $inquiry->SKU.'demo'; die;
                $product_info = "";
                $order_item = array();
                if ($inquiry->SKU != '') {
                    $product = ProductVariant::with('product')->where('SKU', 'like', '%' . $inquiry->SKU)->first();
                    if ($product) {
                        $product_info = '<span>' . $product->product->product_title . '</span><br><span> SKU: ' . $product->SKU . '</span><br>';
                        $Productvariantvariants = ProductVariantVariant::leftJoin('attributes', function ($join) {
                            $join->on('product_variant_variants.attribute_id', '=', 'attributes.id');
                        })->leftJoin('attribute_terms', function ($join) {
                            $join->on('product_variant_variants.attribute_term_id', '=', 'attribute_terms.id');
                        })->where('product_variant_id', $product->id)->select('attributes.attribute_name', 'attribute_terms.attrterm_name')->get();

                        foreach ($Productvariantvariants as $Productvariantvariant) {
                            $product_info .= '<span>' . $Productvariantvariant->attribute_name . ' : ' . $Productvariantvariant->attrterm_name . '</span><br>';
                        }

                        foreach ($Productvariantvariants as $Productvariantvariant) {
                            $spe[] = array(
                                'term' => $Productvariantvariant->attribute_name,
                                'term_name' => $Productvariantvariant->attrterm_name
                            );
                        }

                        $sale_price = $product->sale_price;
                        $item_image = explode(',', $product->images);
                        $item_name = $product->product->product_title;

                        $order_item['variantId'] = $product->id;
                        $order_item['orderItemPrice'] = $sale_price;
                        $order_item['ProductTitle'] = $item_name;
                        $order_item['ProductImage'] = $item_image[0];
                        $order_item['spe'] = $spe;


                    } else {
                        //$product_info = '-';
                    }
                } else {
                    //$product_info = '-';
                }
                $diamond_info = "";
                $diamond = Diamond::where('stone_no', $inquiry->stone_no)->first();
                if ($diamond) {
                    $diamond_info = '<span>' . $diamond->Stone_No . '</span><br>
                                        <span> Weight: ' . $diamond->Weight . '</span><br>
                                        <span> Color: ' . $diamond->Color . '</span><br>
                                        <span> Clarity: ' . $diamond->Clarity . '</span><br>
                                        <span> Cut: ' . $diamond->Cut . '</span><br>';

                    $item_name = $diamond->Shape . ' ' . round($diamond->Weight, 2) . ' ct ';

                    $sale_price = $diamond->Sale_Amt;
                    $item_image = explode(',', $diamond->Stone_Img_url);

                    $spe[] = array(
                        'term_name' => $diamond->Clarity,
                        'term' => 'Clarity'
                    );

                    $spe[] = array(
                        'term_name' => $diamond->Color,
                        'term' => 'Color'
                    );

                    $spe[] = array(
                        'term_name' => $diamond->Lab,
                        'term' => 'certified'
                    );


                    $order_item['diamondId'] = (isset($diamond->id)) ? $diamond->id : 0;
                    $order_item['orderItemPrice'] = $sale_price;
                    $order_item['DiamondTitle'] = $item_name;
                    $order_item['DiamondImage'] = (isset($item_image[0])) ? $item_image[0] : "";
                    $order_item['spe'] = $spe;

                } else {
                    //$diamond_info = '-';
                }

                if ($inquiry->stone_no == "" && $inquiry->SKU == "") {
                    $product_info = 'bulk order inquiry';
                }

                $item_details = json_encode($order_item);
                Inquiry::where('id', $inquiry->id)
                    ->update([
                        'item_details' => $item_details
                    ]);


                $spe_info = '';

                if ($inquiry->specification_term_id != "") {
                    $term_ids = explode(',', $inquiry->specification_term_id);
                    foreach ($term_ids as $term_id) {
                        $Productterms = AttributeTerm::leftJoin('attributes', function ($join) {
                            $join->on('attributes.id', '=', 'attribute_terms.attribute_id');
                        })->where('attribute_terms.id', $term_id)->select('attributes.attribute_name', 'attribute_terms.attrterm_name')->get();
                        if ($Productterms) {
                            foreach ($Productterms as $Productterm) {
                                $spe_info .= '<span>' . $Productterm->attribute_name . ' : ' . $Productterm->attrterm_name . '</span><br>';
                            }
                        } else {
                            // $spe_info .= '-';
                        }
                    }
                } else {
                    //$spe_info ='-';   
                }

                $data1 = [
                    'product_info' => $product_info,
                    'diamond_info' => $diamond_info,
                    'spe_info' => $spe_info
                ];

                // dd($data1);

                // $data2 = [
                //     'message1' => 'Thank You For Product Inquiry'
                // ]; 
                $templateName = 'email.mailDatainquiry';
                $mail_sending = Helpers::MailSending($templateName, $data1, $inquiry->email, 'Inquiry');
                //$mail_sending1 = Helpers::MailSending($templateName, $data1, $setting->send_email, $inquiry->subject);
                return response()->json(['status' => '200']);
            }
        }
    }

    public function inquiry_save_cart(Request $request)
    {
        $setting = Settings::first();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile_no' => 'required|regex:/^[6-9][0-9]{9}$/|digits:10',
            'email' => 'required',
            'inquiry' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => 'failed']);
        } else {


            if (session()->has('customer')) {
                $cart_data = ItemCart::where('user_id', session('customer.id'))->get()->toArray();
            } else {
                $cookie_data = stripslashes(Cookie::get('shopping_cart'));
                $cart_data = json_decode($cookie_data, true);
            }

            foreach ($cart_data as $cart) {
                if ($cart['item_type'] == 0) {
                    $product = ProductVariant::with('product')->where('id', $cart['item_id'])->first();
                    $request->request->add(['SKU' => $product->SKU]);
                    $request->request->add(['stone_no' => null]);
                } elseif ($cart['item_type'] == 1) {

                    $diamond = Diamond::where('id', $cart['item_id'])->first();
                    $request->request->add(['stone_no' => $diamond->Stone_No]);
                    $request->request->add(['SKU' => null]);
                } else {
                    $product = ProductVariant::with('product')->where('id', $cart['item_id'])->first();
                    $request->request->add(['SKU' => $product->SKU]);
                    $diamond = Diamond::where('id', $cart['diamond_id'])->first();
                    $request->request->add(['stone_no' => $diamond->stone_no]);
                }

                $data = $request->all();
                //dd($data);
                $inquiry = Inquiry::Create($data);

                if ($inquiry != null) {
                    //dd($inquiry);
                    // echo $inquiry->SKU.'demo'; die;

                    $product_info = "";
                    if ($inquiry->SKU != '') {
                        $product = ProductVariant::with('product')->where('SKU', 'like', '%' . $inquiry->SKU)->first();
                        if ($product) {
                            $product_info = '<span>' . $product->product->product_title . '</span><br><span> SKU: ' . $product->SKU . '</span><br>';
                            $Productvariantvariants = ProductVariantVariant::leftJoin('attributes', function ($join) {
                                $join->on('product_variant_variants.attribute_id', '=', 'attributes.id');
                            })->leftJoin('attribute_terms', function ($join) {
                                $join->on('product_variant_variants.attribute_term_id', '=', 'attribute_terms.id');
                            })->where('product_variant_id', $product->id)->select('attributes.attribute_name', 'attribute_terms.attrterm_name')->get();

                            foreach ($Productvariantvariants as $Productvariantvariant) {
                                $product_info .= '<span>' . $Productvariantvariant->attribute_name . ' : ' . $Productvariantvariant->attrterm_name . '</span><br>';
                            }
                        } else {
                            //$product_info = '-';
                        }
                    } else {
                        //$product_info = '-';
                    }
                    $diamond_info = "";
                    $diamond = Diamond::where('stone_no', $inquiry->stone_no)->first();
                    if ($diamond) {
                        $diamond_info = '<span>' . $diamond->Stone_No . '</span><br>
                                            <span> Weight: ' . $diamond->Weight . '</span><br>
                                            <span> Color: ' . $diamond->Color . '</span><br>
                                            <span> Clarity: ' . $diamond->Clarity . '</span><br>
                                            <span> Cut: ' . $diamond->Cut . '</span><br>';
                    } else {
                        //$diamond_info = '-';
                    }

                    if ($inquiry->stone_no == "" && $inquiry->SKU == "") {
                        $product_info = 'bulk order inquiry';
                    }


                    $spe_info = '';

                    if ($inquiry->specification_term_id != "") {
                        $term_ids = explode(',', $inquiry->specification_term_id);
                        foreach ($term_ids as $term_id) {
                            $Productterms = AttributeTerm::leftJoin('attributes', function ($join) {
                                $join->on('attributes.id', '=', 'attribute_terms.attribute_id');
                            })->where('attribute_terms.id', $term_id)->select('attributes.attribute_name', 'attribute_terms.attrterm_name')->get();
                            if ($Productterms) {
                                foreach ($Productterms as $Productterm) {
                                    $spe_info .= '<span>' . $Productterm->attribute_name . ' : ' . $Productterm->attrterm_name . '</span><br>';
                                }
                            } else {
                                // $spe_info .= '-';
                            }
                        }
                    } else {
                        //$spe_info ='-';   
                    }

                    $data1 = [
                        'product_info' => $product_info,
                        'diamond_info' => $diamond_info,
                        'spe_info' => $spe_info
                    ];

                    // dd($data1);

                    // $data2 = [
                    //     'message1' => 'Thank You For Product Inquiry'
                    // ]; 
                    $templateName = 'email.mailDatainquiry';
                    $mail_sending = Helpers::MailSending($templateName, $data1, $inquiry->email, 'Inquiry');
                    //$mail_sending1 = Helpers::MailSending($templateName, $data1, $setting->send_email, $inquiry->subject);

                }
            }
            return response()->json(['status' => '200']);
        }
    }

    public function hint_save(Request $request)
    {
        //dd($request);
        $setting = Settings::first();
        $validator = Validator::make($request->all(), [
            'hintname' => 'required',
            'friendname' => 'required',
            //'mobile_no' => 'required',
            'hintemail' => 'required',
            'friendemail' => 'required',
            // 'inquiry' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => 'failed']);
        } else {
            $data = $request->all();

            if ($request->SKU != '') {
                $product = ProductVariant::with('product')->where('SKU', 'like', '%' . $request->SKU)->first();
                if ($product) {
                    $product_info = '<span>' . $product->product->product_title . '</span><br><span> SKU: ' . $product->SKU . '</span><br>';
                    $Productvariantvariants = ProductVariantVariant::leftJoin('attributes', function ($join) {
                        $join->on('product_variant_variants.attribute_id', '=', 'attributes.id');
                    })->leftJoin('attribute_terms', function ($join) {
                        $join->on('product_variant_variants.attribute_term_id', '=', 'attribute_terms.id');
                    })->where('product_variant_id', $product->id)->select('attributes.attribute_name', 'attribute_terms.attrterm_name')->get();

                    foreach ($Productvariantvariants as $Productvariantvariant) {
                        $product_info .= '<span>' . $Productvariantvariant->attribute_name . ' : ' . $Productvariantvariant->attrterm_name . '</span><br>';
                    }
                } else {
                    // $product_info = '-';
                }
            } else {
                // $product_info = '-';
            }
            $diamond_info = "";
            $diamond = Diamond::where('stone_no', $request->stone_no)->first();
            if ($diamond) {
                $diamond_info = '<span>' . $diamond->Stone_No . '</span><br>
                                        <span> Weight: ' . $diamond->Weight . '</span><br>
                                        <span> Color: ' . $diamond->Color . '</span><br>
                                        <span> Clarity: ' . $diamond->Clarity . '</span><br>
                                        <span> Cut: ' . $diamond->Cut . '</span><br>';
            } else {
                //$diamond_info = '-';
            }

            if ($request->stone_no == "" && $request->SKU == "") {
                $product_info = 'bulk order inquiry';
            }


            $spe_info = '';

            if ($request->specification_term_id != "") {
                $term_ids = explode(',', $request->specification_term_id);
                foreach ($term_ids as $term_id) {
                    $Productterms = AttributeTerm::leftJoin('attributes', function ($join) {
                        $join->on('attributes.id', '=', 'attribute_terms.attribute_id');
                    })->where('attribute_terms.id', $term_id)->select('attributes.attribute_name', 'attribute_terms.attrterm_name')->get();
                    if ($Productterms) {
                        foreach ($Productterms as $Productterm) {
                            $spe_info .= '<span>' . $Productterm->attribute_name . ' : ' . $Productterm->attrterm_name . '</span><br>';
                        }
                    } else {
                        //$spe_info .= '-';
                    }
                }
            } else {
                // $spe_info ='-';   
            }

            $data1 = [
                'product_info' => $product_info,
                'diamond_info' => $diamond_info,
                'spe_info' => $spe_info
            ];
            $templateName = 'email.mailDatahint';
            $mail_sending = Helpers::MailSending($templateName, $data1, $request->friendemail, 'Hint');
            //$mail_sending1 = Helpers::MailSending($templateName, $data1, $setting->send_email, $inquiry->subject);
            return response()->json(['status' => '200']);

        }
    }
}
