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


class ContactUsController extends Controller
{
    
    public function index(){
        $settings = Settings::first();
        $products= Product::select('products.*','product_variants.images','product_variants.regular_price','product_variants.sale_price','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->leftJoin("product_variant_variants", "product_variant_variants.product_id", "=", "products.id")->where(['products.is_custom' => 0,'products.estatus' => 1,'product_variants.estatus' => 1])->groupBy('products.id')->orderBy('products.created_at', 'DESC')->limit(12)->get();
        $SmilingDifference = SmilingDifference::get();
        return view('frontend.contactus',compact('settings','products','SmilingDifference'));
    }

    public function save(Request $request){
        $setting = Settings::first();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile_no' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }else{
            $data = $request->all();
            $contact = ContactUs::Create($data);
            if($contact != null){
               
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

                $message = '<!doctype html>'.
                '<html>'.
                
                '<head>'.
                    '<meta name="viewport" content="width=device-width, initial-scale=1">'.
                    '<title></title>'.
                '</head>'.
                '<body style="background-color: #f5f5f5;">'.
                    '<div style="margin: auto; align-items: center; justify-content: center;margin-top: 50px;min-height: 100vh;">'.
                        '<div style="font-family: "Roboto", sans-serif; margin-left:20px; ">'.
                            '<div style="text-align: center; margin-bottom: 20px;">'.
                                '<img src="'.url('frontend/image/logo-transparent.png') .'" alt=""  style="width: 150px;">'.
                            '</div>'.
                           '<div style="margin-left:100px;background-color: #fff; padding: 50px; min-width:650px;box-shadow: 0px 0px 4px 4px rgb(0 0 0 / 1%); ">'.
                                '<div style="margin-bottom: 25px; font-weight: 900;font-size: 18px;">Thank you for contact us</div>'.
                                '<div style="margin-bottom: 25px;font-size: 13px;">'.
                                     'Our Representative will contact you soon.'.
                                '</div>'.
                                '<div style="margin-bottom: 5px; font-size: 13px;">'.
                                    'Thank you!'.
                                    '<div style="margin-top:3px;">Gemver Affordable Luxury Team</div>'.
                                '</div>'.
                            '</div>'.
                            '<div style="text-align: center; margin-top: 50px;color: #b7b7b7;font-size: 13px;">'.
                                '© 2022 Gemver Affordable Luxury '.
                            '</div>'.
                        '</div>'.
                    '</div>'.
                '</body>'.
                '</html>';
                $headers  = "From: info@gmail.com" ;
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                mail($contact->email,$contact->subject,$message,$headers);
                //$mail_sending = Helpers::MailSending($templateName, $data2, $contact->email, $contact->subject);
                //$mail_sending1 = Helpers::MailSending($templateName, $data1, $setting->send_email, $contact->subject);
                return response()->json(['status' => '200']); 
            }
        }
    }

    public function inquiry_save(Request $request){
        $setting = Settings::first();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile_no' => 'required',
            'email' => 'required',
            'inquiry' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }else{
            $data = $request->all();
            $inquiry = Inquiry::Create($data);
            if(isset($data['stone_no'])){
                $ip_address = Request::ip();
                $cart = Cart::where(['ip_address'=>$ip_address]);
                $cart->delete();
            }
            if($inquiry != null){
                //dd($inquiry);
               // echo $inquiry->SKU.'demo'; die;
                if($inquiry->SKU != ''){
                    $product = ProductVariant::with('product')->where('SKU', 'like', '%' . $inquiry->SKU)->first();
                    if($product){
                    $product_info = '<span>'.$product->product->product_title.'</span><span> SKU: '.$product->SKU.'</span>';
                    $Productvariantvariants = ProductVariantVariant::leftJoin('attributes', function($join) {
                        $join->on('product_variant_variants.attribute_id', '=', 'attributes.id');
                      })->leftJoin('attribute_terms', function($join) {
                        $join->on('product_variant_variants.attribute_term_id', '=', 'attribute_terms.id');
                      })->where('product_variant_id',$product->id)->select('attributes.attribute_name','attribute_terms.attrterm_name')->get();
                       
                    foreach($Productvariantvariants as $Productvariantvariant){
                        $product_info .= '<span>'.$Productvariantvariant->attribute_name.' : '.$Productvariantvariant->attrterm_name.'</span>';
                    }
                    }else{
                        $product_info = '-';
                    }
                    }else{
                        $product_info = '-';
                    }

                    $diamond = Diamond::where('stone_no',$inquiry->stone_no)->first();
                    if($diamond){
                       $diamond_info = '<span>'.$diamond->Stone_No.'</span>
                                        <span> Weight: '.$diamond->Weight.'</span>
                                        <span> Color: '.$diamond->Color.'</span>
                                        <span> Clarity: '.$diamond->Clarity.'</span>
                                        <span> Cut: '.$diamond->Cut.'</span>';
                    }else{
                       $diamond_info = '-';
                    }

                    if($inquiry->stone_no == "" && $inquiry->SKU == ""){
                        $product_info = 'bulk order inquiry'; 
                    }

                    
                    $spe_info ='';

                    if($inquiry->specification_term_id != ""){
                        $term_ids = explode(',', $inquiry->specification_term_id);
                        foreach($term_ids as $term_id){
                            $Productterms = AttributeTerm::leftJoin('attributes', function($join) {
                                $join->on('attributes.id', '=', 'attribute_terms.attribute_id');
                            })->where('attribute_terms.id',$term_id)->select('attributes.attribute_name','attribute_terms.attrterm_name')->get();
                            if($Productterms){
                            foreach($Productterms as $Productterm){
                                $spe_info .= '<span>'.$Productterm->attribute_name.' : '.$Productterm->attrterm_name.'</span>';
                            }
                            }else{
                                $spe_info .= '-';
                            }
                        }
                    }else{
                       $spe_info ='-';   
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

    public function hint_save(Request $request){
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

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }else{
            $data = $request->all();
            
                if($request->SKU != ''){
                    $product = ProductVariant::with('product')->where('SKU', 'like', '%' . $request->SKU)->first();
                    if($product){
                    $product_info = '<span>'.$product->product->product_title.'</span><span> SKU: '.$product->SKU.'</span>';
                    $Productvariantvariants = ProductVariantVariant::leftJoin('attributes', function($join) {
                        $join->on('product_variant_variants.attribute_id', '=', 'attributes.id');
                      })->leftJoin('attribute_terms', function($join) {
                        $join->on('product_variant_variants.attribute_term_id', '=', 'attribute_terms.id');
                      })->where('product_variant_id',$product->id)->select('attributes.attribute_name','attribute_terms.attrterm_name')->get();
                       
                    foreach($Productvariantvariants as $Productvariantvariant){
                        $product_info .= '<span>'.$Productvariantvariant->attribute_name.' : '.$Productvariantvariant->attrterm_name.'</span>';
                    }
                    }else{
                        $product_info = '-';
                    }
                    }else{
                        $product_info = '-';
                    }

                    $diamond = Diamond::where('stone_no',$request->stone_no)->first();
                    if($diamond){
                       $diamond_info = '<span>'.$diamond->Stone_No.'</span>
                                        <span> Weight: '.$diamond->Weight.'</span>
                                        <span> Color: '.$diamond->Color.'</span>
                                        <span> Clarity: '.$diamond->Clarity.'</span>
                                        <span> Cut: '.$diamond->Cut.'</span>';
                    }else{
                       $diamond_info = '-';
                    }

                    if($request->stone_no == "" && $request->SKU == ""){
                        $product_info = 'bulk order inquiry'; 
                    }

                    
                    $spe_info ='';

                    if($request->specification_term_id != ""){
                        $term_ids = explode(',', $request->specification_term_id);
                        foreach($term_ids as $term_id){
                            $Productterms = AttributeTerm::leftJoin('attributes', function($join) {
                                $join->on('attributes.id', '=', 'attribute_terms.attribute_id');
                            })->where('attribute_terms.id',$term_id)->select('attributes.attribute_name','attribute_terms.attrterm_name')->get();
                            if($Productterms){
                            foreach($Productterms as $Productterm){
                                $spe_info .= '<span>'.$Productterm->attribute_name.' : '.$Productterm->attrterm_name.'</span>';
                            }
                            }else{
                                $spe_info .= '-';
                            }
                        }
                    }else{
                       $spe_info ='-';   
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
