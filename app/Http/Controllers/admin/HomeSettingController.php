<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSetting;
use App\Models\SmilingDifference;
use App\Models\Category;
use App\Models\Product;

class HomeSettingController extends Controller
{
    private $page = "Home Page";

    public function index()
    {
        $action = "add";
        $homesettings = HomeSetting::first();
        //$categories = Category::where('estatus',1)->get()->toArray();
        $categories = Category::where('estatus',1)->where('is_custom',0)->get()->toArray();
        $products = Product::where('estatus',1)->where('is_custom',0)->get()->toArray();
        $smilingdifference = SmilingDifference::get();
        return view('admin.homesetting.create',compact('action','homesettings','categories','products','smilingdifference'))->with('page',$this->page);
    }

    public function editHomeSettings(Request $request){
        $Settings = HomeSetting::find(1);
        if(!$Settings){
            return response()->json(['status' => '400']);
        }
        $Settings->section_category_title = $request->section_category_title;
        $Settings->section_category_shotline = $request->section_category_shotline;
        $Settings->section_product_title = $request->section_product_title;
        $Settings->section_product_shotline = $request->section_product_shotline;
        $Settings->section_diamond_title = $request->section_diamond_title;
        $Settings->section_diamond_shotline = $request->section_diamond_shotline;
        $Settings->section_smiling_difference_title = $request->section_smiling_difference_title;
        $Settings->section_stories_title = $request->section_stories_title;
        $Settings->section_stories_description = $request->section_stories_description;
        $Settings->section_customise_title = $request->section_customise_title;
        $Settings->section_customise_description = $request->section_customise_description;
        $Settings->section_customise_label = $request->section_customise_label;
        $Settings->section_customise_link = $request->button_url;
        $Settings->section_customise_image = ($request->homeImg != "") ? $request->homeImg :$Settings->section_customise_image;
        $Settings->section_shop_by_style_title = $request->section_shop_by_style_title;
        $Settings->section_shop_by_style_shotline = $request->section_shop_by_style_shotline;
        $Settings->section_why_gemver_title = $request->section_why_gemver_title;
        $Settings->section_why_gemver_description = $request->section_why_gemver_description;
        $Settings->section_why_gemver_title1 = $request->section_why_gemver_title1;   
        $Settings->section_why_gemver_description1 = $request->section_why_gemver_description1;   
        $Settings->section_why_gemver_image1 = ($request->homeImg1 != "") ? $request->homeImg1 :$Settings->section_why_gemver_image1;  
        $Settings->section_why_gemver_title2 = $request->section_why_gemver_title2;   
        $Settings->section_why_gemver_description2 = $request->section_why_gemver_description2;   
        $Settings->section_why_gemver_image2 = ($request->homeImg2 != "") ? $request->homeImg2 :$Settings->section_why_gemver_image2; 
        //$Settings->most_viewed_product_id =  implode(',',$request->most_viewed_product_id);  
       
        $Settings->save();


        $section_smiling_difference_titles=$request->section_smiling_difference_titles;
        $section_smiling_difference_shotlines=$request->section_smiling_difference_shotlines;
        

        SmilingDifference::where('id',1)->update(array(
            'title'=>$section_smiling_difference_titles[0],
            'shotline'=>$section_smiling_difference_shotlines[0]
        ));

        SmilingDifference::where('id',2)->update(array(
            'title'=>$section_smiling_difference_titles[1],
            'shotline'=>$section_smiling_difference_shotlines[1]
        ));

        SmilingDifference::where('id',3)->update(array(
            'title'=>$section_smiling_difference_titles[2],
            'shotline'=>$section_smiling_difference_shotlines[2]
        ));

        SmilingDifference::where('id',4)->update(array(
            'title'=>$section_smiling_difference_titles[3],
            'shotline'=>$section_smiling_difference_shotlines[3]
        ));

        return response()->json(['status' => '200','Settings' => $Settings]);

    }
}
