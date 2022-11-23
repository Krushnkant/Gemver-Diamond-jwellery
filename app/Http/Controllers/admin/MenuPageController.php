<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\MenuPage;
use App\Models\Category;
use App\Models\MenuPageShapeStyle;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers;

class MenuPageController extends Controller
{
    
    private $page = "Menu Page";

    public function engagementpage()
    {
        $menupages = Menupage::with('menupageshapestyle')->where('id',1)->first();
        $categories = Category::where(['estatus' => 1,'is_custom' =>0])->orderBy('created_at','DESC')->get();
        $custom_categories = Category::where(['estatus' => 1,'is_custom' =>1])->orderBy('created_at','DESC')->get();
        $products = Product::where('estatus',1)->where('is_custom',0)->get()->toArray();
        return view('admin.menupage.engagementpage',compact('menupages','categories','custom_categories','products'))->with('page',$this->page);
    }

    public function updateEngagementPage(Request $request){
        //dd($request->all());
        $messages = [
            'banner_image.mimes' =>'Please provide a Valid Extension Image(e.g: .jpg .png)',
            'main_shotline.required' =>'Please provide a main shotline',
            'main_title.required' =>'Please provide a main title',
        ];

        $validator = Validator::make($request->all(), [
            'banner_image' => 'image|mimes:jpeg,png,jpg',
            'main_shotline' => 'required',
            'main_title' => 'required',
         
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $menupages = MenuPage::find(1);
        if(!$menupages){
            $menupages = New MenuPage;
        }
        $menupages->category_id = $request->cat_id;
        $menupages->main_title = $request->main_title;
        $menupages->main_shotline = $request->main_shotline;
        $menupages->main_first_button_name = $request->main_first_button_name;
        $menupages->main_second_button_name = $request->main_second_button_name;
        $menupages->section1_title = $request->section1_title;
        $menupages->section1_description = $request->section1_description;
        $menupages->section3_title = $request->section3_title;
        $menupages->section31_title = $request->section31_title;
        $menupages->section31_description = $request->section31_description;
        $menupages->section32_title = $request->section32_title;
        $menupages->section32_description = $request->section32_description;
        $menupages->section33_title = $request->section33_title;
        $menupages->section33_description = $request->section33_description;
        $menupages->section4_title = $request->section4_title;
        $menupages->section4_description = $request->section4_description;
        $menupages->select_product = implode(',',$request->select_product_id);

        $old_banner_image = $menupages->banner_image;
        $old_banner_image = $menupages->banner_image;
        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $image_name = 'banner_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_banner_image)) {
                $old_banner_image = public_path('images/aboutus/' . $old_banner_image);
                if (file_exists($old_banner_image)) {
                    unlink($old_banner_image);
                }
            }
            $menupages->banner_image = $image_name;
        }

        $old_banner_mobile_image = $menupages->banner_mobile_image;
        if ($request->hasFile('banner_mobile_image')) {
            $image = $request->file('banner_mobile_image');
            $image_name = 'banner_mobile_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_banner_mobile_image)) {
                $old_banner_mobile_image = public_path('images/aboutus/' . $old_banner_mobile_image);
                if (file_exists($old_banner_mobile_image)) {
                    unlink($old_banner_mobile_image);
                }
            }
            $menupages->banner_mobile_image = $image_name;
        }

        $old_section1_image = $menupages->section1_image;
        if ($request->hasFile('section1_image')) {
            $image = $request->file('section1_image');
            $image_name = 'section1_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_section1_image)) {
                $old_section1_image = public_path('images/aboutus/' . $old_section1_image);
                if (file_exists($old_section1_image)) {
                    unlink($old_section1_image);
                }
            }
            $menupages->section1_image = $image_name;
        }

        $old_section31_image = $menupages->section31_image;
        if ($request->hasFile('section31_image')) {
            $image = $request->file('section31_image');
            $image_name = 'section31_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_section31_image)) {
                $old_section31_image = public_path('images/aboutus/' . $old_section31_image);
                if (file_exists($old_section31_image)) {
                    unlink($old_section31_image);
                }
            }
            $menupages->section31_image = $image_name;
        }

        $old_section32_image = $menupages->section32_image;
        if ($request->hasFile('section32_image')) {
            $image = $request->file('section32_image');
            $image_name = 'section32_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_section32_image)) {
                $old_section32_image = public_path('images/aboutus/' . $old_section32_image);
                if (file_exists($old_section32_image)) {
                    unlink($old_section32_image);
                }
            }
            $menupages->section32_image = $image_name;
        }

        $old_section33_image = $menupages->section33_image;
        if ($request->hasFile('section33_image')) {
            $image = $request->file('section33_image');
            $image_name = 'section33_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_section33_image)) {
                $old_section33_image = public_path('images/aboutus/' . $old_section33_image);
                if (file_exists($old_section33_image)) {
                    unlink($old_section33_image);
                }
            }
            $menupages->section33_image = $image_name;
        }

        $old_section4_image = $menupages->section4_image;
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
            $menupages->section4_image = $image_name;
        }

        $menupages->save();

        $neworderids = ($request->orderdataid != "")?$request->orderdataid:0;
        
        $shapdataidold = MenuPageShapeStyle::where('page_id',1)->get()->pluck('id');
        
        if($menupages){
            if (isset($request->subtitle) && !empty($request->subtitle)){
                foreach($request->subtitle as $key => $subtitle){
                    if($subtitle != ""){
                        $shapdata = new MenuPageShapeStyle();
                        $shapdata->page_id = $menupages->id;
                        $shapdata->title = $subtitle;
                        $shapdata->category_id = $request->category_id[$key];
                        $path = public_path("images/shopstyle_image/");
                        if(isset($request->image[$key]) && $request->image[$key] != ""){
                            $result = Helpers::UploadImage($request->image[$key], $path);
                            $shapdata->image = $result;
                        }
                        $shapdata->save();
                    } 
                    
                }
            }

            if (isset($request->subtitleold) && !empty($request->subtitleold)){
                foreach($request->subtitleold as $key => $subtitleold){
                    if($subtitleold != ""){
                        $shapdataold = MenuPageShapeStyle::find($request->orderdataid[$key]);
                        $shapdataold->title = $subtitleold;
                        $shapdataold->category_id = (isset($request->category_id_old[$key])  && $request->category_id_old[$key] != "" ? $request->category_id_old[$key] : 0);
                        $path = public_path("images/shopstyle_image/");
                        if(isset($request->imageold[$key]) && $request->imageold[$key] != ""){
                            //dd($request->imageold[$key]);
                            $result = Helpers::UploadImage($request->imageold[$key], $path);
                            $shapdataold->image = $result;
                        }
                        $shapdataold->save();
                    }
                }
            }
            if($shapdataidold != ""){
            foreach($shapdataidold as $shapdataids){
                if(!in_array($shapdataids,$neworderids)){
                    MenuPageShapeStyle::where('id',$shapdataids)->delete();  
                }
            }
            }
        }

        
        return response()->json(['status' => '200','Menupages' => $menupages]);
    }


    public function weddingpage()
    {
        $menupages = Menupage::with('menupageshapestyle')->where('id',2)->first();
        $categories = Category::where(['estatus' => 1,'is_custom' =>0])->orderBy('created_at','DESC')->get();
        $products = Product::where('estatus',1)->where('is_custom',0)->get()->toArray();
        return view('admin.menupage.weddingpage',compact('menupages','categories','products'))->with('page',$this->page);
    }

    public function updateWeddingPage(Request $request){
        //dd($request->all());
        $messages = [
            'banner_image.mimes' =>'Please provide a Valid Extension Image(e.g: .jpg .png)',
            'main_shotline.required' =>'Please provide a main shotline',
            'main_title.required' =>'Please provide a main title',
        ];

        $validator = Validator::make($request->all(), [
            'banner_image' => 'image|mimes:jpeg,png,jpg',
            'main_shotline' => 'required',
            'main_title' => 'required',
         
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $menupages = MenuPage::find(2);
        if(!$menupages){
            $menupages = New MenuPage;
        }
        $menupages->main_title = $request->main_title;
        $menupages->main_shotline = $request->main_shotline;
        $menupages->section1_title = $request->section1_title;
        $menupages->section1_description = $request->section1_description;
        $menupages->section3_title = $request->section3_title;
        // $menupages->section31_title = $request->section31_title;
        // $menupages->section31_description = $request->section31_description;
        // $menupages->section32_title = $request->section32_title;
        // $menupages->section32_description = $request->section32_description;
        // $menupages->section33_title = $request->section33_title;
        // $menupages->section33_description = $request->section33_description;
        $menupages->section4_title = $request->section4_title;
        $menupages->section4_description = $request->section4_description;
        $menupages->select_product = implode(',',$request->select_product_id);

        $old_banner_image = $menupages->banner_image;
        $old_banner_image = $menupages->banner_image;
        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $image_name = 'banner_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_banner_image)) {
                $old_banner_image = public_path('images/aboutus/' . $old_banner_image);
                if (file_exists($old_banner_image)) {
                    unlink($old_banner_image);
                }
            }
            $menupages->banner_image = $image_name;
        }

        $old_banner_mobile_image = $menupages->banner_mobile_image;
        if ($request->hasFile('banner_mobile_image')) {
            $image = $request->file('banner_mobile_image');
            $image_name = 'banner_mobile_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_banner_mobile_image)) {
                $old_banner_mobile_image = public_path('images/aboutus/' . $old_banner_mobile_image);
                if (file_exists($old_banner_mobile_image)) {
                    unlink($old_banner_mobile_image);
                }
            }
            $menupages->banner_mobile_image = $image_name;
        }

        $old_section1_image = $menupages->section1_image;
        if ($request->hasFile('section1_image')) {
            $image = $request->file('section1_image');
            $image_name = 'section1_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_section1_image)) {
                $old_section1_image = public_path('images/aboutus/' . $old_section1_image);
                if (file_exists($old_section1_image)) {
                    unlink($old_section1_image);
                }
            }
            $menupages->section1_image = $image_name;
        }

        // $old_section31_image = $menupages->section31_image;
        // if ($request->hasFile('section31_image')) {
        //     $image = $request->file('section31_image');
        //     $image_name = 'section31_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
        //     $destinationPath = public_path('images/aboutus');
        //     $image->move($destinationPath, $image_name);
        //     if(isset($old_section31_image)) {
        //         $old_section31_image = public_path('images/aboutus/' . $old_section31_image);
        //         if (file_exists($old_section31_image)) {
        //             unlink($old_section31_image);
        //         }
        //     }
        //     $menupages->section31_image = $image_name;
        // }

        // $old_section32_image = $menupages->section32_image;
        // if ($request->hasFile('section32_image')) {
        //     $image = $request->file('section32_image');
        //     $image_name = 'section32_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
        //     $destinationPath = public_path('images/aboutus');
        //     $image->move($destinationPath, $image_name);
        //     if(isset($old_section32_image)) {
        //         $old_section32_image = public_path('images/aboutus/' . $old_section32_image);
        //         if (file_exists($old_section32_image)) {
        //             unlink($old_section32_image);
        //         }
        //     }
        //     $menupages->section32_image = $image_name;
        // }

        // $old_section33_image = $menupages->section33_image;
        // if ($request->hasFile('section33_image')) {
        //     $image = $request->file('section33_image');
        //     $image_name = 'section33_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
        //     $destinationPath = public_path('images/aboutus');
        //     $image->move($destinationPath, $image_name);
        //     if(isset($old_section33_image)) {
        //         $old_section33_image = public_path('images/aboutus/' . $old_section33_image);
        //         if (file_exists($old_section33_image)) {
        //             unlink($old_section33_image);
        //         }
        //     }
        //     $menupages->section33_image = $image_name;
        // }

        $old_section4_image = $menupages->section4_image;
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
            $menupages->section4_image = $image_name;
        }

        $menupages->save();

        $neworderids = $request->orderdataid;

        $shapdataidold = MenuPageShapeStyle::where('page_id',2)->get()->pluck('id');

        if($menupages){
            if (isset($request->subtitle) && !empty($request->subtitle)){
                foreach($request->subtitle as $key => $subtitle){
                    if($subtitle != ""){
                        $shapdata = new MenuPageShapeStyle();
                        $shapdata->page_id = $menupages->id;
                        $shapdata->title = $subtitle;
                        $shapdata->category_id = $request->category_id[$key];
                        $path = public_path("images/shopstyle_image/");
                        if(isset($request->image[$key]) && $request->image[$key] != ""){
                            $result = Helpers::UploadImage($request->image[$key], $path);
                            $shapdata->image = $result;
                        }
                        $shapdata->save();
                    } 
                    
                }
            }

            if (isset($request->subtitleold) && !empty($request->subtitleold)){
                foreach($request->subtitleold as $key => $subtitleold){
                    if($subtitleold != ""){
                        $shapdataold = MenuPageShapeStyle::find($request->orderdataid[$key]);
                        $shapdataold->title = $subtitleold;
                        $shapdataold->category_id = (isset($request->category_id_old[$key])  && $request->category_id_old[$key] != "" ? $request->category_id_old[$key] : 0);
                        $path = public_path("images/shopstyle_image/");
                        if(isset($request->imageold[$key]) && $request->imageold[$key] != ""){
                            //dd($request->imageold[$key]);
                            $result = Helpers::UploadImage($request->imageold[$key], $path);
                            $shapdataold->image = $result;
                        }
                        $shapdataold->save();
                    }
                }
            }
            if($shapdataidold){
                foreach($shapdataidold as $shapdataids){
                    if(!in_array($shapdataids,$neworderids)){
                        MenuPageShapeStyle::where('id',$shapdataids)->delete();  
                    }
                }
            }
        }

        
        return response()->json(['status' => '200','Menupages' => $menupages]);
    }

    public function growndiamondpage()
    {
        $menupages = Menupage::with('menupageshapestyle')->where('id',3)->first();
        $categories = Category::where(['estatus' => 1,'is_custom' =>0])->orderBy('created_at','DESC')->get();
        $custom_categories = Category::where(['estatus' => 1,'is_custom' =>1])->orderBy('created_at','DESC')->get();
        return view('admin.menupage.growndiamondpage',compact('menupages','categories','custom_categories'))->with('page',$this->page);
    }

    public function updateGrownDiamondPage(Request $request){
        //dd($request->all());
        $messages = [
            'banner_image.mimes' =>'Please provide a Valid Extension Image(e.g: .jpg .png)',
            'main_shotline.required' =>'Please provide a main shotline',
            'main_title.required' =>'Please provide a main title',
        ];

        $validator = Validator::make($request->all(), [
            'banner_image' => 'image|mimes:jpeg,png,jpg',
            'main_shotline' => 'required',
            'main_title' => 'required',
         
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $menupages = MenuPage::find(3);
        if(!$menupages){
            $menupages = New MenuPage;
        }
        $menupages->category_id = $request->cat_id;
        $menupages->main_title = $request->main_title;
        $menupages->main_shotline = $request->main_shotline;
        $menupages->main_first_button_name = $request->main_first_button_name;
        $menupages->section1_title = $request->section1_title;
        $menupages->section1_description = $request->section1_description;
        $menupages->section3_title = $request->section3_title;
        // $menupages->section31_title = $request->section31_title;
        // $menupages->section31_description = $request->section31_description;
        // $menupages->section32_title = $request->section32_title;
        // $menupages->section32_description = $request->section32_description;
        // $menupages->section33_title = $request->section33_title;
        // $menupages->section33_description = $request->section33_description;
        $menupages->section4_title = $request->section4_title;
        $menupages->section4_description = $request->section4_description;

        $old_banner_image = $menupages->banner_image;
        $old_banner_image = $menupages->banner_image;
        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $image_name = 'banner_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_banner_image)) {
                $old_banner_image = public_path('images/aboutus/' . $old_banner_image);
                if (file_exists($old_banner_image)) {
                    unlink($old_banner_image);
                }
            }
            $menupages->banner_image = $image_name;
        }

        $old_banner_mobile_image = $menupages->banner_mobile_image;
        if ($request->hasFile('banner_mobile_image')) {
            $image = $request->file('banner_mobile_image');
            $image_name = 'banner_mobile_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_banner_mobile_image)) {
                $old_banner_mobile_image = public_path('images/aboutus/' . $old_banner_mobile_image);
                if (file_exists($old_banner_mobile_image)) {
                    unlink($old_banner_mobile_image);
                }
            }
            $menupages->banner_mobile_image = $image_name;
        }

        $old_section1_image = $menupages->section1_image;
        if ($request->hasFile('section1_image')) {
            $image = $request->file('section1_image');
            $image_name = 'section1_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_section1_image)) {
                $old_section1_image = public_path('images/aboutus/' . $old_section1_image);
                if (file_exists($old_section1_image)) {
                    unlink($old_section1_image);
                }
            }
            $menupages->section1_image = $image_name;
        }

        

        $old_section4_image = $menupages->section4_image;
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
            $menupages->section4_image = $image_name;
        }

        $menupages->save();

        $neworderids = $request->orderdataid;

        $shapdataidold = MenuPageShapeStyle::where('page_id',3)->get()->pluck('id');

        if($menupages){
            if (isset($request->subtitle) && !empty($request->subtitle)){
                foreach($request->subtitle as $key => $subtitle){
                    if($subtitle != ""){
                        $shapdata = new MenuPageShapeStyle();
                        $shapdata->page_id = $menupages->id;
                        $shapdata->title = $subtitle;
                        $shapdata->category_id = $request->category_id[$key];
                        $path = public_path("images/shopstyle_image/");
                        if(isset($request->image[$key]) && $request->image[$key] != ""){
                            $result = Helpers::UploadImage($request->image[$key], $path);
                            $shapdata->image = $result;
                        }
                        $shapdata->save();
                    } 
                    
                }
            }

            if (isset($request->subtitleold) && !empty($request->subtitleold)){
                foreach($request->subtitleold as $key => $subtitleold){
                    if($subtitleold != ""){
                        $shapdataold = MenuPageShapeStyle::find($request->orderdataid[$key]);
                        $shapdataold->title = $subtitleold;
                        $shapdataold->category_id = (isset($request->category_id_old[$key])  && $request->category_id_old[$key] != "" ? $request->category_id_old[$key] : 0);
                        $path = public_path("images/shopstyle_image/");
                        if(isset($request->imageold[$key]) && $request->imageold[$key] != ""){
                            //dd($request->imageold[$key]);
                            $result = Helpers::UploadImage($request->imageold[$key], $path);
                            $shapdataold->image = $result;
                        }
                        $shapdataold->save();
                    }
                }
            }

            // foreach($shapdataidold as $shapdataids){
            //     if(!in_array($shapdataids,$neworderids)){
            //         MenuPageShapeStyle::where('id',$shapdataids)->delete();  
            //     }
            // }
        }

        
        return response()->json(['status' => '200','Menupages' => $menupages]);
    }

    public function finejewellerypage()
    {
        $menupages = Menupage::with('menupageshapestyle')->where('id',4)->first();
        $categories = Category::where(['estatus' => 1,'is_custom' =>0])->orderBy('created_at','DESC')->get();
        return view('admin.menupage.finejewellerypage',compact('menupages','categories'))->with('page',$this->page);
    }

    public function updateFineJewelleryPage(Request $request){
        
        $messages = [
            'banner_image.mimes' =>'Please provide a Valid Extension Image(e.g: .jpg .png)',
            'main_shotline.required' =>'Please provide a main shotline',
            'main_title.required' =>'Please provide a main title',
        ];

        $validator = Validator::make($request->all(), [
            'banner_image' => 'image|mimes:jpeg,png,jpg',
            'main_shotline' => 'required',
            'main_title' => 'required',
         
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $menupages = MenuPage::find(4);
        if(!$menupages){
            $menupages = New MenuPage;
        }
        $menupages->main_title = $request->main_title;
        $menupages->main_shotline = $request->main_shotline;
        $menupages->section1_title = $request->section1_title;
        $menupages->section1_description = $request->section1_description;
        $menupages->section3_title = $request->section3_title;
        $menupages->section3_description = $request->section3_description;
        $menupages->section31_category_id = $request->section31_category_id;
        $menupages->section32_category_id = $request->section32_category_id;
        $menupages->section33_category_id = $request->section33_category_id;
        $menupages->section4_title = $request->section4_title;
        $menupages->section4_description = $request->section4_description;

        $old_banner_image = $menupages->banner_image;
        $old_banner_image = $menupages->banner_image;
        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $image_name = 'banner_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_banner_image)) {
                $old_banner_image = public_path('images/aboutus/' . $old_banner_image);
                if (file_exists($old_banner_image)) {
                    unlink($old_banner_image);
                }
            }
            $menupages->banner_image = $image_name;
        }

        $old_banner_mobile_image = $menupages->banner_mobile_image;
        if ($request->hasFile('banner_mobile_image')) {
            $image = $request->file('banner_mobile_image');
            $image_name = 'banner_mobile_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_banner_mobile_image)) {
                $old_banner_mobile_image = public_path('images/aboutus/' . $old_banner_mobile_image);
                if (file_exists($old_banner_mobile_image)) {
                    unlink($old_banner_mobile_image);
                }
            }
            $menupages->banner_mobile_image = $image_name;
        }

        $old_section1_image = $menupages->section1_image;
        if ($request->hasFile('section1_image')) {
            $image = $request->file('section1_image');
            $image_name = 'section1_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_section1_image)) {
                $old_section1_image = public_path('images/aboutus/' . $old_section1_image);
                if (file_exists($old_section1_image)) {
                    unlink($old_section1_image);
                }
            }
            $menupages->section1_image = $image_name;
        }

        $old_section31_image = $menupages->section31_image;
        if ($request->hasFile('section31_image')) {
            $image = $request->file('section31_image');
            $image_name = 'section31_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_section31_image)) {
                $old_section31_image = public_path('images/aboutus/' . $old_section31_image);
                if (file_exists($old_section31_image)) {
                    unlink($old_section31_image);
                }
            }
            $menupages->section31_image = $image_name;
        }

        $old_section32_image = $menupages->section32_image;
        if ($request->hasFile('section32_image')) {
            $image = $request->file('section32_image');
            $image_name = 'section32_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_section32_image)) {
                $old_section32_image = public_path('images/aboutus/' . $old_section32_image);
                if (file_exists($old_section32_image)) {
                    unlink($old_section32_image);
                }
            }
            $menupages->section32_image = $image_name;
        }

        $old_section33_image = $menupages->section33_image;
        if ($request->hasFile('section33_image')) {
            $image = $request->file('section33_image');
            $image_name = 'section33_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_section33_image)) {
                $old_section33_image = public_path('images/aboutus/' . $old_section33_image);
                if (file_exists($old_section33_image)) {
                    unlink($old_section33_image);
                }
            }
            $menupages->section33_image = $image_name;
        }

        $old_section4_image = $menupages->section4_image;
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
            $menupages->section4_image = $image_name;
        }

        $menupages->save();

        $neworderids = $request->orderdataid;

        $shapdataidold = MenuPageShapeStyle::where('page_id',4)->get()->pluck('id');

        if($menupages){
            if (isset($request->subtitle) && !empty($request->subtitle)){
                foreach($request->subtitle as $key => $subtitle){
                    if($subtitle != ""){
                        $shapdata = new MenuPageShapeStyle();
                        $shapdata->page_id = $menupages->id;
                        $shapdata->title = $subtitle;
                        $shapdata->subdiscription = $request->subdiscription[$key];
                        $shapdata->category_id = $request->category_id[$key];
                        $path = public_path("images/shopstyle_image/");
                        if(isset($request->image[$key]) && $request->image[$key] != ""){
                            $result = Helpers::UploadImage($request->image[$key], $path);
                            $shapdata->image = $result;
                        }
                        $shapdata->save();
                    } 
                    
                }
            }

            if (isset($request->subtitleold) && !empty($request->subtitleold)){
                foreach($request->subtitleold as $key => $subtitleold){
                    if($subtitleold != ""){
                        $shapdataold = MenuPageShapeStyle::find($request->orderdataid[$key]);
                        $shapdataold->title = $subtitleold;
                        $shapdataold->subdiscription = $request->subdiscriptionold[$key];
                        $shapdataold->category_id = (isset($request->category_id_old[$key])  && $request->category_id_old[$key] != "" ? $request->category_id_old[$key] : 0);
                        $path = public_path("images/shopstyle_image/");
                        if(isset($request->imageold[$key]) && $request->imageold[$key] != ""){
                            //dd($request->imageold[$key]);
                            $result = Helpers::UploadImage($request->imageold[$key], $path);
                            $shapdataold->image = $result;
                        }
                        $shapdataold->save();
                    }
                }
            }

            foreach($shapdataidold as $shapdataids){
                if(!in_array($shapdataids,$neworderids)){
                    MenuPageShapeStyle::where('id',$shapdataids)->delete();  
                }
            }
        }

        
        return response()->json(['status' => '200','Menupages' => $menupages]);
    }

    public function customjewellerypage()
    {
        $menupages = Menupage::with('menupageshapestyle')->where('id',5)->first();
        $categories = Category::where(['estatus' => 1,'is_custom' =>1])->orderBy('created_at','DESC')->get();
        return view('admin.menupage.customjewellerypage',compact('menupages','categories'))->with('page',$this->page);
    }

    public function updateCustomJewelleryPage(Request $request){
        //dd($request->all());
        $messages = [
            'banner_image.mimes' =>'Please provide a Valid Extension Image(e.g: .jpg .png)',
            'banner_mobile_image.mimes' =>'Please provide a Valid Extension Image(e.g: .jpg .png)',
            //'main_shotline.required' =>'Please provide a main shotline',
           // 'main_title.required' =>'Please provide a main title',
        ];

        $validator = Validator::make($request->all(), [
            'banner_image' => 'image|mimes:jpeg,png,jpg',
            'banner_mobile_image' => 'image|mimes:jpeg,png,jpg',
            //'main_shotline' => 'required',
           // 'main_title' => 'required',
         
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $menupages = MenuPage::find(5);
        if(!$menupages){
            $menupages = New MenuPage;
        }
        $menupages->main_title = $request->main_title;
        $menupages->main_shotline = $request->main_shotline;
        $menupages->section1_title = $request->section1_title;
        $menupages->section1_description = $request->section1_description;
        $menupages->section3_title = $request->section3_title;
        $menupages->section4_title = $request->section4_title;
        $menupages->section4_description = $request->section4_description;

        $old_banner_image = $menupages->banner_image;
        $old_banner_image = $menupages->banner_image;
        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $image_name = 'banner_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_banner_image)) {
                $old_banner_image = public_path('images/aboutus/' . $old_banner_image);
                if (file_exists($old_banner_image)) {
                    unlink($old_banner_image);
                }
            }
            $menupages->banner_image = $image_name;
        }

        $old_banner_mobile_image = $menupages->banner_mobile_image;
        if ($request->hasFile('banner_mobile_image')) {
            $image = $request->file('banner_mobile_image');
            $image_name = 'banner_mobile_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_banner_mobile_image)) {
                $old_banner_mobile_image = public_path('images/aboutus/' . $old_banner_mobile_image);
                if (file_exists($old_banner_mobile_image)) {
                    unlink($old_banner_mobile_image);
                }
            }
            $menupages->banner_mobile_image = $image_name;
        }

        $old_banner_mobile_image = $menupages->banner_mobile_image;
        if ($request->hasFile('banner_mobile_image')) {
            $image = $request->file('banner_mobile_image');
            $image_name = 'banner_mobile_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_banner_mobile_image)) {
                $old_banner_mobile_image = public_path('images/aboutus/' . $old_banner_mobile_image);
                if (file_exists($old_banner_mobile_image)) {
                    unlink($old_banner_mobile_image);
                }
            }
            $menupages->banner_mobile_image = $image_name;
        }

        $old_section1_image = $menupages->section1_image;
        if ($request->hasFile('section1_image')) {
            $image = $request->file('section1_image');
            $image_name = 'section1_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/aboutus');
            $image->move($destinationPath, $image_name);
            if(isset($old_section1_image)) {
                $old_section1_image = public_path('images/aboutus/' . $old_section1_image);
                if (file_exists($old_section1_image)) {
                    unlink($old_section1_image);
                }
            }
            $menupages->section1_image = $image_name;
        }

        // $old_section31_image = $menupages->section31_image;
        // if ($request->hasFile('section31_image')) {
        //     $image = $request->file('section31_image');
        //     $image_name = 'section31_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
        //     $destinationPath = public_path('images/aboutus');
        //     $image->move($destinationPath, $image_name);
        //     if(isset($old_section31_image)) {
        //         $old_section31_image = public_path('images/aboutus/' . $old_section31_image);
        //         if (file_exists($old_section31_image)) {
        //             unlink($old_section31_image);
        //         }
        //     }
        //     $menupages->section31_image = $image_name;
        // }

        // $old_section32_image = $menupages->section32_image;
        // if ($request->hasFile('section32_image')) {
        //     $image = $request->file('section32_image');
        //     $image_name = 'section32_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
        //     $destinationPath = public_path('images/aboutus');
        //     $image->move($destinationPath, $image_name);
        //     if(isset($old_section32_image)) {
        //         $old_section32_image = public_path('images/aboutus/' . $old_section32_image);
        //         if (file_exists($old_section32_image)) {
        //             unlink($old_section32_image);
        //         }
        //     }
        //     $menupages->section32_image = $image_name;
        // }

        // $old_section33_image = $menupages->section33_image;
        // if ($request->hasFile('section33_image')) {
        //     $image = $request->file('section33_image');
        //     $image_name = 'section33_image_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
        //     $destinationPath = public_path('images/aboutus');
        //     $image->move($destinationPath, $image_name);
        //     if(isset($old_section33_image)) {
        //         $old_section33_image = public_path('images/aboutus/' . $old_section33_image);
        //         if (file_exists($old_section33_image)) {
        //             unlink($old_section33_image);
        //         }
        //     }
        //     $menupages->section33_image = $image_name;
        // }

        $old_section4_image = $menupages->section4_image;
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
            $menupages->section4_image = $image_name;
        }

        $menupages->save();

        $neworderids = $request->orderdataid;

        $shapdataidold = MenuPageShapeStyle::where('page_id',5)->get()->pluck('id');

        if($menupages){
            if (isset($request->subtitle) && !empty($request->subtitle)){
                foreach($request->subtitle as $key => $subtitle){
                    if($subtitle != ""){
                        $shapdata = new MenuPageShapeStyle();
                        $shapdata->page_id = $menupages->id;
                        $shapdata->title = $subtitle;
                        $shapdata->subdiscription = $request->subdiscription[$key];
                        $shapdata->category_id = $request->category_id[$key];
                        $path = public_path("images/shopstyle_image/");
                        if(isset($request->image[$key]) && $request->image[$key] != ""){
                            $result = Helpers::UploadImage($request->image[$key], $path);
                            $shapdata->image = $result;
                        }
                        $shapdata->save();
                    } 
                    
                }
            }

            if (isset($request->subtitleold) && !empty($request->subtitleold)){
                foreach($request->subtitleold as $key => $subtitleold){
                    if($subtitleold != ""){
                        $shapdataold = MenuPageShapeStyle::find($request->orderdataid[$key]);
                        $shapdataold->title = $subtitleold;
                        $shapdata->subdiscription = $request->subdiscriptionold[$key];
                        $shapdataold->category_id = (isset($request->category_id_old[$key])  && $request->category_id_old[$key] != "" ? $request->category_id_old[$key] : 0);
                        $path = public_path("images/shopstyle_image/");
                        if(isset($request->imageold[$key]) && $request->imageold[$key] != ""){
                            //dd($request->imageold[$key]);
                            $result = Helpers::UploadImage($request->imageold[$key], $path);
                            $shapdataold->image = $result;
                        }
                        $shapdataold->save();
                    }
                }
            }

            foreach($shapdataidold as $shapdataids){
                if(!in_array($shapdataids,$neworderids)){
                    MenuPageShapeStyle::where('id',$shapdataids)->delete();  
                }
            }
        }

        
        return response()->json(['status' => '200','Menupages' => $menupages]);
    }

    public function editmenupage($id){
        $Menupage = Menupage::find($id);
        return response()->json($Menupage);
    }
}
