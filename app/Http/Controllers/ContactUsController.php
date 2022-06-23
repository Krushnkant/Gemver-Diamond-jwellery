<?php

namespace App\Http\Controllers;
use App\Models\Settings;
use App\Models\ContactUs;
use App\Models\Inquiry;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers;


class ContactUsController extends Controller
{
    
    public function index(){
        $settings = Settings::first();
        return view('frontend.contactus',compact('settings'));
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
                $mail_sending = Helpers::MailSending($templateName, $data2, $contact->email, $contact->subject);
                $mail_sending1 = Helpers::MailSending($templateName, $data1, $setting->send_email, $contact->subject);
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
                $ip_address = \Request::ip();
                $cart = Cart::where(['ip_address'=>$ip_address]);
                $cart->delete();
            }
            if($inquiry != null){
               
                $data1 = [
                    'SKU' => $data['SKU'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'mobile_no' => $data['mobile_no'],
                    'message1' => $inquiry->inquiry
                ];
                
                $data2 = [
                    'message1' => 'Thank You For Product Inquiry'
                ]; 
                $templateName = 'email.mailData';
                //$mail_sending = Helpers::MailSending($templateName, $data2, $inquiry->email, $inquiry->subject);
                //$mail_sending1 = Helpers::MailSending($templateName, $data1, $setting->send_email, $inquiry->subject);
                return response()->json(['status' => '200']); 
            }
        }
    }
}
