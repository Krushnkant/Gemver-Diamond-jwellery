<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectPage;
use App\Models\Infopage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InfopageController extends Controller
{
    private $page = "Infopage";

    public function index(){
        $Infopages = Infopage::first();
        $canWrite = false;
        $page_id = ProjectPage::where('route_url','admin.infopage.list')->pluck('id')->first();
        if( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
            $canWrite = true;
        }
        return view('admin.infopage.list',compact('Infopages','canWrite'))->with('page',$this->page);
    }

    public function editAboutus(){
        $Infopages = Infopage::find(1);
        return response()->json($Infopages);
    }

    public function updateAboutus(Request $request){
        $messages = [
            'first_section_image.mimes' =>'Please provide a Valid Extension Image(e.g: .jpg .png)',
            'first_section_contant.required' =>'Please provide a first section',
            'first_section_title.required' =>'Please provide a first section',
            'second_section_image.mimes' =>'Please provide a Valid Extension Image(e.g: .jpg .png)',
            'second_section_contant.required' =>'Please provide a second section',
            'second_section_title.required' =>'Please provide a second section',
        ];

        $validator = Validator::make($request->all(), [
            'first_section_image' => 'image|mimes:jpeg,png,jpg',
            'first_section_contant' => 'required',
            'first_section_title' => 'required',
            'second_section_image' => 'image|mimes:jpeg,png,jpg',
            'second_section_contant' => 'required',
            'second_section_title' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $Infopages = Infopage::find(1);
        if(!$Infopages){
            $Infopages = New Infopage;
        }
        $Infopages->first_section_title = $request->first_section_title;
        $Infopages->second_section_title = $request->second_section_title;
        $Infopages->first_section_contant = $request->first_section_contant;
        $Infopages->second_section_contant = $request->second_section_contant;
        $Infopages->title1 = $request->title1;
        $Infopages->value1 = $request->value1;
        $Infopages->title2 = $request->title2;
        $Infopages->value2 = $request->value2;
        $Infopages->title3 = $request->title3;
        $Infopages->value3 = $request->value3;
        $Infopages->title4 = $request->title4;
        $Infopages->value4 = $request->value4;

        $old_first_section_image = $Infopages->first_section_image;
        if ($request->hasFile('first_section_image')) {
            $image = $request->file('first_section_image');
            $image_name = 'first_section_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_first_section_image)) {
                $old_first_section_image = public_path('images/aboutus/' . $old_first_section_image);
                if (file_exists($old_first_section_image)) {
                    unlink($old_first_section_image);
                }
            }
            $Infopages->first_section_image = $image_name;
        }

        $old_second_section_image = $Infopages->second_section_image;
        if ($request->hasFile('second_section_image')) {
            $image = $request->file('second_section_image');
            $image_name = 'second_section_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_second_section_image)) {
                $old_second_section_image = public_path('images/aboutus/' . $old_second_section_image);
                if (file_exists($old_second_section_image)) {
                    unlink($old_second_section_image);
                }
            }
            $Infopages->second_section_image = $image_name;
        }

        $Infopages->save();
        return response()->json(['status' => '200','Infopages' => $Infopages]);
    }


    public function privacy_policy(){
        $Infopages = Infopage::first();
        $canWrite = false;
        $page_id = ProjectPage::where('route_url','admin.privacy_policy.list')->pluck('id')->first();
        if( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
            $canWrite = true;
        }
        return view('admin.infopage.privacy_policy',compact('Infopages','canWrite'))->with('page',$this->page);
    }


    public function editPrivacyPolicy(){
        $Infopages = Infopage::find(1);
        return response()->json($Infopages);
    }

    public function updatePrivacyPolicy(Request $request){
        $messages = [
            'privacy_policy_contant.required' =>'Please provide a aboutus contant',
        ];

        $validator = Validator::make($request->all(), [
            'privacy_policy_contant' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $Infopages = Infopage::find(1);
        if(!$Infopages){
            return response()->json(['status' => '400']);
        }
        $Infopages->privacy_policy = $request->privacy_policy_contant;

        $Infopages->save();
        return response()->json(['status' => '200','Infopages' => $Infopages]);
    }

    public function terms_condition(){
        $Infopages = Infopage::first();
        $canWrite = false;
        $page_id = ProjectPage::where('route_url','admin.terms_condition.list')->pluck('id')->first();
        if( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
            $canWrite = true;
        }
        return view('admin.infopage.terms_condition',compact('Infopages','canWrite'))->with('page',$this->page);
    }


    public function editTermsCondition(){
        $Infopages = Infopage::find(1);
        return response()->json($Infopages);
    }

    public function updateTermsCondition(Request $request){
        $messages = [
            'terms_condition_contant.required' =>'Please provide a terms condition contant',
        ];

        $validator = Validator::make($request->all(), [
            'terms_condition_contant' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $Infopages = Infopage::find(1);
        if(!$Infopages){
            return response()->json(['status' => '400']);
        }
        $Infopages->terms_condition = $request->terms_condition_contant;
        
        $Infopages->save();
        return response()->json(['status' => '200','Infopages' => $Infopages]);
    }


    public function free_engraving(){
        $Infopages = Infopage::first();
        $canWrite = false;
        $page_id = ProjectPage::where('route_url','admin.free_engraving.list')->pluck('id')->first();
        if( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
            $canWrite = true;
        }
        return view('admin.infopage.free_engraving',compact('Infopages','canWrite'))->with('page',$this->page);
    }


    public function editFreeEngraving(){
        $Infopages = Infopage::find(1);
        return response()->json($Infopages);
    }

    public function updateFreeEngraving(Request $request){
        $messages = [
            'free_engraving_contant.required' =>'Please provide a free engraving contant',
        ];

        $validator = Validator::make($request->all(), [
            'free_engraving_contant' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $Infopages = Infopage::find(1);
        if(!$Infopages){
            return response()->json(['status' => '400']);
        }
        $Infopages->free_engraving = $request->free_engraving_contant;

        $Infopages->save();
        return response()->json(['status' => '200','Infopages' => $Infopages]);
    }

    public function free_resizing(){
        $Infopages = Infopage::first();
        $canWrite = false;
        $page_id = ProjectPage::where('route_url','admin.free_resizing.list')->pluck('id')->first();
        if( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
            $canWrite = true;
        }
        return view('admin.infopage.free_resizing',compact('Infopages','canWrite'))->with('page',$this->page);
    }

    public function editFreeResizing(){
        $Infopages = Infopage::find(1);
        return response()->json($Infopages);
    }

    public function updateFreeResizing(Request $request){
        $messages = [
            'free_resizing_contant.required' =>'Please provide a free resizing contant',
        ];

        $validator = Validator::make($request->all(), [
            'free_resizing_contant' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $Infopages = Infopage::find(1);
        if(!$Infopages){
            return response()->json(['status' => '400']);
        }
        $Infopages->free_resizing = $request->free_resizing_contant;

        $Infopages->save();
        return response()->json(['status' => '200','Infopages' => $Infopages]);
    }

    public function free_shipping(){
        $Infopages = Infopage::first();
        $canWrite = false;
        $page_id = ProjectPage::where('route_url','admin.free_shipping.list')->pluck('id')->first();
        if( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
            $canWrite = true;
        }
        return view('admin.infopage.free_shipping',compact('Infopages','canWrite'))->with('page',$this->page);
    }

    public function editFreeShipping(){
        $Infopages = Infopage::find(1);
        return response()->json($Infopages);
    }

    public function updateFreeShipping(Request $request){
        $messages = [
            'free_shipping_contant.required' =>'Please provide a free resizing contant',
        ];

        $validator = Validator::make($request->all(), [
            'free_shipping_contant' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $Infopages = Infopage::find(1);
        if(!$Infopages){
            return response()->json(['status' => '400']);
        }
        $Infopages->free_shipping = $request->free_shipping_contant;

        $Infopages->save();
        return response()->json(['status' => '200','Infopages' => $Infopages]);
    }


    public function lifetime_upgrade(){
        $Infopages = Infopage::first();
        $canWrite = false;
        $page_id = ProjectPage::where('route_url','admin.lifetime_upgrade.list')->pluck('id')->first();
        if( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
            $canWrite = true;
        }
        return view('admin.infopage.lifetime_upgrade',compact('Infopages','canWrite'))->with('page',$this->page);
    }

    public function editLifetimeUpgrade(){
        $Infopages = Infopage::find(1);
        return response()->json($Infopages);
    }

    public function updateLifetimeUpgrade(Request $request){
        $messages = [
            'lifetime_upgrade_contant.required' =>'Please provide a free resizing contant',
        ];

        $validator = Validator::make($request->all(), [
            'lifetime_upgrade_contant' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $Infopages = Infopage::find(1);
        if(!$Infopages){
            return response()->json(['status' => '400']);
        }
        $Infopages->lifetime_upgrade = $request->lifetime_upgrade_contant;

        $Infopages->save();
        return response()->json(['status' => '200','Infopages' => $Infopages]);
    }


    public function lifetime_warranty(){
        $Infopages = Infopage::first();
        $canWrite = false;
        $page_id = ProjectPage::where('route_url','admin.lifetime_warranty.list')->pluck('id')->first();
        if( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
            $canWrite = true;
        }
        return view('admin.infopage.lifetime_warranty',compact('Infopages','canWrite'))->with('page',$this->page);
    }

    public function editLifetimeWarranty(){
        $Infopages = Infopage::find(1);
        return response()->json($Infopages);
    }

    public function updateLifetimeWarranty(Request $request){
        $messages = [
            'lifetime_warranty_contant.required' =>'Please provide a lifetime warranty contant',
        ];

        $validator = Validator::make($request->all(), [
            'lifetime_warranty_contant' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $Infopages = Infopage::find(1);
        if(!$Infopages){
            return response()->json(['status' => '400']);
        }
        $Infopages->lifetime_warranty = $request->lifetime_warranty_contant;

        $Infopages->save();
        return response()->json(['status' => '200','Infopages' => $Infopages]);
    }




    public function payment_options(){
        $Infopages = Infopage::first();
        $canWrite = false;
        $page_id = ProjectPage::where('route_url','admin.payment_options.list')->pluck('id')->first();
        if( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
            $canWrite = true;
        }
        return view('admin.infopage.payment_options',compact('Infopages','canWrite'))->with('page',$this->page);
    }

    public function editPaymentOptions(){
        $Infopages = Infopage::find(1);
        return response()->json($Infopages);
    }

    public function updatePaymentOptions(Request $request){
        $messages = [
            'payment_options_contant.required' =>'Please provide a lifetime warranty contant',
        ];

        $validator = Validator::make($request->all(), [
            'payment_options_contant' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $Infopages = Infopage::find(1);
        if(!$Infopages){
            return response()->json(['status' => '400']);
        }
        $Infopages->payment_options = $request->payment_options_contant;

        $Infopages->save();
        return response()->json(['status' => '200','Infopages' => $Infopages]);
    }


    public function return_days(){
        $Infopages = Infopage::first();
        $canWrite = false;
        $page_id = ProjectPage::where('route_url','admin.returns_days.list')->pluck('id')->first();
        if( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
            $canWrite = true;
        }
        return view('admin.infopage.returns_days',compact('Infopages','canWrite'))->with('page',$this->page);
    }

    public function editReturnDays(){
        $Infopages = Infopage::find(1);
        return response()->json($Infopages);
    }
    
    public function updateReturnDays(Request $request){
        $messages = [
            'returns_days_contant.required' =>'Please provide a lifetime warranty contant',
        ];

        $validator = Validator::make($request->all(), [
            'returns_days_contant' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $Infopages = Infopage::find(1);
        if(!$Infopages){
            return response()->json(['status' => '400']);
        }
        $Infopages->return_days = $request->returns_days_contant;

        $Infopages->save();
        return response()->json(['status' => '200','Infopages' => $Infopages]);
    }

}
