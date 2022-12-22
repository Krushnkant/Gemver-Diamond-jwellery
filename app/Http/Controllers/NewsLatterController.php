<?php

namespace App\Http\Controllers;

use App\Models\NewsLatter;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers;

class NewsLatterController extends Controller
{
    
    public function save(Request $request)
    {
        $messages = [
            'newslatteremail.required' =>'Please provide a email'
        ];
        $validator = Validator::make($request->all(), [
            'newslatteremail' => 'required|email'
        ], $messages);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }else{
            $action = "add";
            $newslatter = new NewsLatter();
            $newslatter->email = $request->newslatteremail;
            $newslatter->created_at = new \DateTime(null, new \DateTimeZone('Asia/Kolkata'));
            $newslatter->save();

            $setting = Settings::first();

            $data2 = [
                'message1' => isset($setting->welcome_mail_message)?$setting->welcome_mail_message:"Thank You For Subscribe"
            ]; 
            $templateName = 'email.mailDataSubscribe';

            Helpers::MailSending($templateName, $data2, $newslatter->email, 'Thank You For Subscribe');

            return response()->json(['status' => '200']); 
            
        }
    }

}
