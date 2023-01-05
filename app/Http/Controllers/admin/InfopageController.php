<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectPage;
use App\Models\Infopage;
use App\Models\DiamondAnatomy;
use App\Models\GenverDifference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InfopageController extends Controller
{
    private $page = "Infopage";

    public function page(){
        $canWrite = false;
        $page_id = ProjectPage::where('route_url','admin.infopage.list')->pluck('id')->first();
        if( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
            $canWrite = true;
        }
        return view('admin.infopage.page',compact('canWrite'))->with('page',$this->page);
    }

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
        return view('admin.infopage.Returns_days',compact('Infopages','canWrite'))->with('page',$this->page);
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

    public function customer_value(){
        $Infopages = Infopage::first();
        $canWrite = false;
        $page_id = ProjectPage::where('route_url','admin.customer_value.list')->pluck('id')->first();
        if( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
            $canWrite = true;
        }
        return view('admin.infopage.customer_value',compact('Infopages','canWrite'))->with('page',$this->page);
    }

    public function updateCustomerValue(Request $request){
        $messages = [
            'customer_value_contant.required' =>'Please provide a customer value contant',
        ];

        $validator = Validator::make($request->all(), [
            'customer_value_contant' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $Infopages = Infopage::find(1);
        if(!$Infopages){
            return response()->json(['status' => '400']);
        }
        $Infopages->customer_value = $request->customer_value_contant;

        $Infopages->save();
        return response()->json(['status' => '200','Infopages' => $Infopages]);
    }

    public function market_need(){
        $Infopages = Infopage::first();
        $canWrite = false;
        $page_id = ProjectPage::where('route_url','admin.market_need.list')->pluck('id')->first();
        if( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
            $canWrite = true;
        }
        return view('admin.infopage.market_need',compact('Infopages','canWrite'))->with('page',$this->page);
    }

    public function updateMarketNeed(Request $request){
        $messages = [
            'market_need_contant.required' =>'Please provide a customer value contant',
        ];

        $validator = Validator::make($request->all(), [
            'market_need_contant' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $Infopages = Infopage::find(1);
        if(!$Infopages){
            return response()->json(['status' => '400']);
        }
        $Infopages->market_need = $request->market_need_contant;

        $Infopages->save();
        return response()->json(['status' => '200','Infopages' => $Infopages]);
    }


    public function why_friendly(){
        $Infopages = Infopage::first();
        $canWrite = false;
        $page_id = ProjectPage::where('route_url','admin.why_friendly.list')->pluck('id')->first();
        if( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
            $canWrite = true;
        }
        return view('admin.infopage.why_friendly',compact('Infopages','canWrite'))->with('page',$this->page);
    }

    public function updateWhyFriendly(Request $request){
        $messages = [
            'why_friendly_contant.required' =>'Please provide a why friendly contant',
        ];

        $validator = Validator::make($request->all(), [
            'why_friendly_contant' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $Infopages = Infopage::find(1);
        if(!$Infopages){
            return response()->json(['status' => '400']);
        }
        $Infopages->why_friendly = $request->why_friendly_contant;

        $Infopages->save();
        return response()->json(['status' => '200','Infopages' => $Infopages]);
    }

    public function learn_about_lab_made_diamonds(){
        $Infopages = Infopage::first();
        $canWrite = false;
        $page_id = ProjectPage::where('route_url','admin.learn_about_lab_made_diamonds.list')->pluck('id')->first();
        if( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
            $canWrite = true;
        }
        return view('admin.infopage.learn_about_lab_made_diamonds',compact('Infopages','canWrite'))->with('page',$this->page);
    }

    public function updateLearnAboutLabMadeDiamonds(Request $request){
        $messages = [
            'learn_about_lab_made_diamonds_contant.required' =>'Please provide a learn about lab made diamonds contant',
        ];

        $validator = Validator::make($request->all(), [
            'learn_about_lab_made_diamonds_contant' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $Infopages = Infopage::find(1);
        if(!$Infopages){
            return response()->json(['status' => '400']);
        }
        $Infopages->learn_about_lab_made_diamonds = $request->learn_about_lab_made_diamonds_contant;

        $Infopages->save();
        return response()->json(['status' => '200','Infopages' => $Infopages]);
    }

    public function conflict_free_diamonds(){
        $Infopages = Infopage::first();
        $canWrite = false;
        $page_id = ProjectPage::where('route_url','admin.conflict_free_diamonds.list')->pluck('id')->first();
        if( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
            $canWrite = true;
        }
        return view('admin.infopage.conflict_free_diamonds',compact('Infopages','canWrite'))->with('page',$this->page);
    }

    public function updateConflictFreeDiamonds(Request $request){
        $messages = [
            'conflict_free_diamonds_contant.required' =>'Please provide a conflict free diamonds contant',
        ];

        $validator = Validator::make($request->all(), [
            'conflict_free_diamonds_contant' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $Infopages = Infopage::find(1);
        if(!$Infopages){
            return response()->json(['status' => '400']);
        }
        $Infopages->conflict_free_diamonds = $request->conflict_free_diamonds_contant;

        $Infopages->save();
        return response()->json(['status' => '200','Infopages' => $Infopages]);
    }

    public function diamond_anatomy(){
        $DiamondAnatomy = DiamondAnatomy::first();
        $canWrite = false;
        $page_id = ProjectPage::where('route_url','admin.diamond_anatomy.list')->pluck('id')->first();
        if( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
            $canWrite = true;
        }
        return view('admin.infopage.diamond_anatomy',compact('DiamondAnatomy','canWrite'))->with('page',$this->page);
    }

    public function updateDiamondAnatomy(Request $request){

        $messages = [
            'header_title.required' =>'Please provide a conflict header_title',
        ];

        $validator = Validator::make($request->all(), [
            'header_title' => 'required',
            'header_shotline' => 'required',
            //'header_image' => 'required',
            'section1_title' => 'required',
            'section1_description' => 'required',
            'section2_title' => 'required',
            'section2_description' => 'required',
           // 'section2_image' => 'required',
            'section3_title' => 'required',
            'section3_description' => 'required',
           // 'section3_image' => 'required',
            'section4_title' => 'required',
            'section4_description' => 'required',
           // 'section4_image' => 'required',
            //'section5_image' => 'required',
            'section6_title' => 'required',
            'section6_description' => 'required',
            //'section6_image' => 'required',
            'section7_title' => 'required',
            'section7_description' => 'required',
            //'section7_image' => 'required',
            //'section7_image2' => 'required',
            'section8_title' => 'required',
            'section8_description' => 'required',
            //'section8_image' => 'required',
            'section9_title' => 'required',
            'section9_description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $DiamondAnatomy = DiamondAnatomy::find(1);
        if(!$DiamondAnatomy){
            $DiamondAnatomy = New DiamondAnatomy;
        }
        $DiamondAnatomy->header_title = $request->header_title;
        $DiamondAnatomy->header_shotline = $request->header_shotline;
        $DiamondAnatomy->section1_title = $request->section1_title;
        $DiamondAnatomy->section1_description = $request->section1_description;
        $DiamondAnatomy->section2_title = $request->section2_title;
        $DiamondAnatomy->section2_description = $request->section2_description;
        $DiamondAnatomy->section3_title = $request->section3_title;
        $DiamondAnatomy->section3_description = $request->section3_description;
        $DiamondAnatomy->section4_title = $request->section4_title;
        $DiamondAnatomy->section4_description = $request->section4_description;
        $DiamondAnatomy->section6_title = $request->section6_title;
        $DiamondAnatomy->section6_description = $request->section6_description;
        $DiamondAnatomy->section7_title = $request->section7_title;
        $DiamondAnatomy->section7_description = $request->section7_description;
        $DiamondAnatomy->section8_title = $request->section8_title;
        $DiamondAnatomy->section8_description = $request->section8_description;
        $DiamondAnatomy->section9_title = $request->section9_title;
        $DiamondAnatomy->section9_description = $request->section9_description;

        $old_header_image = $DiamondAnatomy->header_image;
        if ($request->hasFile('header_image')) {
            $image = $request->file('header_image');
            $image_name = 'header_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_header_image)) {
                $old_header_image = public_path('images/aboutus/' . $old_header_image);
                if (file_exists($old_header_image)) {
                    unlink($old_header_image);
                }
            }
            $DiamondAnatomy->header_image = $image_name;
        }

        $old_section2_image = $DiamondAnatomy->section2_image;
        if ($request->hasFile('section2_image')) {
            $image = $request->file('section2_image');
            $image_name = 'section2_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_section2_image)) {
                $old_section2_image = public_path('images/aboutus/' . $old_section2_image);
                if (file_exists($old_section2_image)) {
                    unlink($old_section2_image);
                }
            }
            $DiamondAnatomy->section2_image = $image_name;
        }

        $old_section3_image = $DiamondAnatomy->section3_image;
        if ($request->hasFile('section3_image')) {
            $image = $request->file('section3_image');
            $image_name = 'section3_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_section3_image)) {
                $old_section3_image = public_path('images/aboutus/' . $old_section3_image);
                if (file_exists($old_section3_image)) {
                    unlink($old_section3_image);
                }
            }
            $DiamondAnatomy->section3_image = $image_name;
        }

        $old_section4_image = $DiamondAnatomy->section4_image;
        if ($request->hasFile('section4_image')) {
            $image = $request->file('section4_image');
            $image_name = 'section4_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_section4_image)) {
                $old_section4_image = public_path('images/aboutus/' . $old_section4_image);
                if (file_exists($old_section4_image)) {
                    unlink($old_section4_image);
                }
            }
            $DiamondAnatomy->section4_image = $image_name;
        }

        $old_section5_image = $DiamondAnatomy->section5_image;
        if ($request->hasFile('section5_image')) {
            $image = $request->file('section5_image');
            $image_name = 'section5_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_section5_image)) {
                $old_section5_image = public_path('images/aboutus/' . $old_section5_image);
                if (file_exists($old_section5_image)) {
                    unlink($old_section5_image);
                }
            }
            $DiamondAnatomy->section5_image = $image_name;
        }

        $old_section6_image = $DiamondAnatomy->section6_image;
        if ($request->hasFile('section6_image')) {
            $image = $request->file('section6_image');
            $image_name = 'section6_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_section6_image)) {
                $old_section6_image = public_path('images/aboutus/' . $old_section6_image);
                if (file_exists($old_section6_image)) {
                    unlink($old_section6_image);
                }
            }
            $DiamondAnatomy->section6_image = $image_name;
        }

        $old_section7_image = $DiamondAnatomy->section7_image;
        if ($request->hasFile('section7_image')) {
            $image = $request->file('section7_image');
            $image_name = 'section7_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_section7_image)) {
                $old_section7_image = public_path('images/aboutus/' . $old_section7_image);
                if (file_exists($old_section7_image)) {
                    unlink($old_section7_image);
                }
            }
            $DiamondAnatomy->section7_image = $image_name;
        }

        $old_section7_image2 = $DiamondAnatomy->section7_image2;
        if ($request->hasFile('section7_image2')) {
            $image = $request->file('section7_image2');
            $image_name = 'section7_image2_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_section7_image2)) {
                $old_section7_image2 = public_path('images/aboutus/' . $old_section7_image2);
                if (file_exists($old_section7_image2)) {
                    unlink($old_section7_image2);
                }
            }
            $DiamondAnatomy->section7_image2 = $image_name;
        }

        $old_section8_image = $DiamondAnatomy->section8_image;
        if ($request->hasFile('section8_image')) {
            $image = $request->file('section8_image');
            $image_name = 'section8_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_section8_image)) {
                $old_section8_image = public_path('images/aboutus/' . $old_section8_image);
                if (file_exists($old_section8_image)) {
                    unlink($old_section8_image);
                }
            }
            $DiamondAnatomy->section8_image = $image_name;
        }


        $DiamondAnatomy->save();
        return response()->json(['status' => '200','DiamondAnatomy' => $DiamondAnatomy]);
    }

    public function editDiamondAnatomy(){
        $DiamondAnatomy = DiamondAnatomy::find(1);
        return response()->json($DiamondAnatomy);
    }

    public function gemver_difference(){
        $GemverDifference = GenverDifference::first();
        $canWrite = false;
        $page_id = ProjectPage::where('route_url','admin.genver_difference.list')->pluck('id')->first();
        if( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
            $canWrite = true;
        }
        return view('admin.infopage.genver_difference',compact('GemverDifference','canWrite'))->with('page',$this->page);
    }

    public function updateGemverDifference(Request $request){


        $validator = Validator::make($request->all(), [

            'section1_title' => 'required',
            'section1_description' => 'required',
            'section2_title' => 'required',
            'section2_description' => 'required',
            'section3_title' => 'required',
            'section3_description' => 'required',
            'section4_title' => 'required',
            'section4_description' => 'required',
           
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $GemverDifference = GenverDifference::find(1);
        if(!$GemverDifference){
            $GemverDifference = New GenverDifference;
        }

        $GemverDifference->section1_title = $request->section1_title;
        $GemverDifference->section1_description = $request->section1_description;
        $GemverDifference->section2_title = $request->section2_title;
        $GemverDifference->section2_description = $request->section2_description;
        $GemverDifference->section3_title = $request->section3_title;
        $GemverDifference->section3_description = $request->section3_description;
        $GemverDifference->section4_title = $request->section4_title;
        $GemverDifference->section4_description = $request->section4_description;

        $old_section1_image = $GemverDifference->section1_image;
        if ($request->hasFile('section1_image')) {
            $image = $request->file('section1_image');
            $image_name = 'section1_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_section1_image)) {
                $old_section2_image = public_path('images/aboutus/' . $old_section1_image);
                if (file_exists($old_section1_image)) {
                    unlink($old_section1_image);
                }
            }
            $GemverDifference->section1_image = $image_name;
        }
        

        

        $old_section2_image = $GemverDifference->section2_image;
        if ($request->hasFile('section2_image')) {
            $image = $request->file('section2_image');
            $image_name = 'section2_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_section2_image)) {
                $old_section2_image = public_path('images/aboutus/' . $old_section2_image);
                if (file_exists($old_section2_image)) {
                    unlink($old_section2_image);
                }
            }
            $GemverDifference->section2_image = $image_name;
        }

        $old_section3_image = $GemverDifference->section3_image;
        if ($request->hasFile('section3_image')) {
            $image = $request->file('section3_image');
            $image_name = 'section3_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_section3_image)) {
                $old_section3_image = public_path('images/aboutus/' . $old_section3_image);
                if (file_exists($old_section3_image)) {
                    unlink($old_section3_image);
                }
            }
            $GemverDifference->section3_image = $image_name;
        }

        $old_section4_image = $GemverDifference->section4_image;
        if ($request->hasFile('section4_image')) {
            $image = $request->file('section4_image');
            $image_name = 'section4_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_section4_image)) {
                $old_section4_image = public_path('images/aboutus/' . $old_section4_image);
                if (file_exists($old_section4_image)) {
                    unlink($old_section4_image);
                }
            }
            $GemverDifference->section4_image = $image_name;
        }
        $GemverDifference->save();
        return response()->json(['status' => '200','GemverDifference' => $GemverDifference]);
    }

    public function editGemverDifference(){
        $GemverDifference = GenverDifference::find(1);
        return response()->json($GemverDifference);
    }

}
