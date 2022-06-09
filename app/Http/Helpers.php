<?php 

namespace App\Http;

use Mail;
use Config;

class Helpers{
	
	public static function MailSending($template, $data, $to, $sub){
		$fromEmail = Config::get('constants.from_email');
		$fromName = Config::get('constants.from_name');
		\Mail::send($template, $data, function($message) use ($fromEmail, $fromName, $to, $sub) {
         $message->from($fromEmail,$fromName);
         $message->to($to);
         $message->subject($sub);
      });
		// dump('Mail Send Successfully');
	}

	public static function UploadImage($image, $path){
        $imageName = Str::random().'.'.$image->getClientOriginalExtension();
        // dump($imageName);
        // $path = Storage::disk('public')->putFileAs($path, $image,$imageName);
        $path = $image->move(public_path($path), $imageName);
        // dump($path);
        if($path == true){
            return $imageName;
        }else{
            return null;
        }
    }
}