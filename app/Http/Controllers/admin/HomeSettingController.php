<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSetting;
use App\Models\Category;

class HomeSettingController extends Controller
{
    private $page = "Home Setting";

    public function index()
    {
        $action = "add";
        $homesettings = HomeSetting::first();
        $categories = Category::where('estatus',1)->get()->toArray();
        return view('admin.homesetting.create',compact('action','homesettings','categories'))->with('page',$this->page);
    }

    public function editHomeSettings(Request $request){
        $Settings = HomeSetting::find(1);
        if(!$Settings){
            return response()->json(['status' => '400']);
        }
        $Settings->section_category_title = $request->section_category_title;
        $Settings->section_diamond_title = $request->section_diamond_title;
        $Settings->section_stories_title = $request->section_stories_title;
        $Settings->section_stories_description = $request->section_stories_description;
        $Settings->section_customise_title = $request->section_customise_title;
        $Settings->section_customise_description = $request->section_customise_description;
        $Settings->section_customise_link = $request->button_url;
        $Settings->section_customise_image = ($request->homeImg != "") ? $request->homeImg :$Settings->section_customise_image;
        $Settings->section_why_gemver_title = $request->section_why_gemver_title;
        $Settings->section_why_gemver_description = $request->section_why_gemver_description;
        $Settings->section_why_gemver_title1 = $request->section_why_gemver_title1;   
        $Settings->section_why_gemver_description1 = $request->section_why_gemver_description1;   
        $Settings->section_why_gemver_image1 = ($request->homeImg1 != "") ? $request->homeImg1 :$Settings->section_why_gemver_image1;  
        $Settings->section_why_gemver_title2 = $request->section_why_gemver_title2;   
        $Settings->section_why_gemver_description2 = $request->section_why_gemver_description2;   
        $Settings->section_why_gemver_image2 = ($request->homeImg2 != "") ? $request->homeImg2 :$Settings->section_why_gemver_image2;  
       
        $Settings->save();
        return response()->json(['status' => '200','Settings' => $Settings]);

    }
}
