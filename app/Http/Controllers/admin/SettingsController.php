<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectPage;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    private $page = "Settings";

    public function index(){
        $Settings = Settings::first();
        $canWrite = false;
        $page_id = ProjectPage::where('route_url','admin.settings.list')->pluck('id')->first();
        if( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
            $canWrite = true;
        }
        return view('admin.settings.list',compact('Settings','canWrite'))->with('page',$this->page);
    }

    public function editSettings(){
        $Settings = Settings::find(1);
        return response()->json($Settings);
    }

    public function updateInvoiceSetting(Request $request){
        $messages = [
            
            'company_name.required' =>'Please provide a Company Name',
            'company_logo.image' =>'Please provide a Valid Extension Logo(e.g: .jpg .png)',
            'company_logo.mimes' =>'Please provide a Valid Extension Logo(e.g: .jpg .png)',
            'company_favicon.image' =>'Please provide a Valid Extension favicon(e.g: .jpg .png)',
            'company_favicon.mimes' =>'Please provide a Valid Extension favicon(e.g: .jpg .png)',
            'company_address.required' =>'Please provide a Company Address',
            //'youtub_url.required' =>'Please provide a Youtube URL',
            'company_mobile_no.required' =>'Please provide a Company Mobile Number',
            'company_email.required' =>'Please provide a Company Email',
            'company_send_email.required' =>'Please provide a Company Send Email',
            // 'instagram_url.required' =>'Please provide a Instragram URL',
            // 'twiter_url.required' =>'Please provide a Twiter URL',
            // 'tiktok_url.required' =>'Please provide a Tiktok URL',
            // 'facebook_url.required' =>'Please provide a Facebook URL',
        ];

        $validator = Validator::make($request->all(), [
            'company_name' => 'required',
            'company_logo' => 'image|mimes:jpeg,png,jpg',
            'company_favicon' => 'image|mimes:jpeg,png,jpg',
            'company_address' => 'required',
            'company_mobile_no' => 'required|numeric|digits:10',
            'company_email' => 'required|email',
            'company_send_email' => 'required|email',
            //'youtub_url' => 'required',
            // 'instagram_url' => 'required',
            // 'twiter_url' => 'required',
            // 'tiktok_url' => 'required',
            // 'facebook_url' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $Settings = Settings::find(1);
        if(!$Settings){
            return response()->json(['status' => '400']);
        }
        $Settings->company_name = $request->company_name;
        $Settings->company_address = $request->company_address;
        $Settings->company_mobile_no = $request->company_mobile_no;
        $Settings->company_email = $request->company_email;
        $Settings->send_email = $request->company_send_email;
        $Settings->youtub_url = $request->youtub_url;
        $Settings->instagram_url = $request->instagram_url;
        $Settings->twiter_url = $request->twiter_url;
        $Settings->tiktok_url = $request->tiktok_url;
        $Settings->facebook_url = $request->facebook_url;
        $Settings->company_address_map = $request->company_address_map;   
        $old_image = $Settings->company_logo;
        if ($request->hasFile('company_logo')) {
            $image = $request->file('company_logo');
            $image_name = 'company_logo_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/company');
            $image->move($destinationPath, $image_name);
            if(isset($old_image)) {
                $old_image = public_path('images/company/' . $old_image);
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
            }
            $Settings->company_logo = $image_name;
        }

        $old_image_favicon = $Settings->company_favicon;
        if ($request->hasFile('company_favicon')) {
            $image = $request->file('company_favicon');
            $image_name = 'company_favicon_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/company');
            $image->move($destinationPath, $image_name);
            if(isset($old_image_favicon)) {
                $old_image_favicon = public_path('images/company/' . $old_image_favicon);
                if (file_exists($old_image_favicon)) {
                    unlink($old_image_favicon);
                }
            }
            $Settings->company_favicon = $image_name;
        }

        $Settings->save();
        return response()->json(['status' => '200','Settings' => $Settings]);
    }

}
