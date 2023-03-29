<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Testimonial;
use App\Models\Step;
use App\Models\Diamond;
use App\Models\Product;
use App\Models\HomeSetting;
use App\Models\ShopByStyle;
use App\Models\BlogBanner;
use App\Models\Settings;
use App\Models\SmilingDifference;

class HomeController extends Controller
{
    public function index()
    {
        $setting = Settings::first(['instagram_token']);
        $fields = "id,caption,media_type,media_url,permalink,thumbnail_url,timestamp,username";
        //$token = env('INSTAGRAM_TOKEN', '');
        $token = $setting->instagram_token;
        $limit = 10;
        $json_feed_url="https://graph.instagram.com/me/media?fields={$fields}&access_token={$token}&limit={$limit}";
        $json_feed = @file_get_contents($json_feed_url);
        $contents = json_decode($json_feed, true, 512, JSON_BIGINT_AS_STRING);
 
        $categories = Category::select(['slug','category_thumb','category_name'])->where(['estatus'=>1,'is_custom'=>0,'parent_category_id'=>0])->get();
        $testimonials = Testimonial::select(['description','name','country','image'])->where('estatus',1)->take(10)->get();
        $banners = Banner::select(['title','banner_thumb','mobile_banner_thumb','description','button_name','button_url','application_dropdown_id','value','product_variant_id'])->where('estatus',1)->get();
        $step = Step::select(['main_image','main_title','main_shotline','slug','step1_title','step1_shotline','step2_title','step2_shotline','step3_title','step3_shotline','step4_title','step4_shotline'])->where('estatus',1)->first();
       // $homesetting = HomeSetting::with('category')->first();
        $homesetting = HomeSetting::select(['home_settings.*','categories.slug'])->leftJoin('categories', 'home_settings.section_customise_link', '=', 'categories.id')->first();
        $shopbystyle = ShopByStyle::select(['setting','image','title'])->where('estatus',1)->get();
        $products= Product::select('products.id','products.product_title','products.primary_category_id','product_variants.slug','product_variants.alt_text','product_variants.images','product_variants.regular_price','product_variants.sale_price','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->where(['products.is_custom' => 0,'products.estatus' => 1,'product_variants.estatus' => 1,'product_variants.term_item_id' => 2])->groupBy('products.id')->orderBy('products.created_at', 'asc')->limit(12)->get();
        $BlogBanners = BlogBanner::select(['dropdown_id','value','banner_thumb'])->where(['estatus' => 1,'page' => 1])->get()->ToArray();
        $SmilingDifference = SmilingDifference::select(['title','shotline'])->get();
        $diamonds = Diamond::select(['id'])->where('StockStatus','<>',0)->count();
        return view('frontend.home',compact('categories','testimonials','banners','step','homesetting','shopbystyle','products','BlogBanners','SmilingDifference','diamonds','contents'));
    }

    public function index1(){
       
    //     ini_set('max_execution_time', 0);
    //     ini_set('memory_limit', '1024M');
    //     //Initial settings, Just specify Source and Destination Image folder.
    //     $ImagesDirectory    = public_path('images/categoryThumb/'); //Source Image Directory End with Slash
    //     $DestImagesDirectory    = public_path('images/categoryThumb1/'); //Destination Image Directory End with Slash
    //     $NewImageWidth      = 850; //New Width of Image
    //     $NewImageHeight     = 850; // New Height of Image
    //     $Quality        = 80; //Image Quality
    //    // dd($ImagesDirectory);
    //     //Open Source Image directory, loop through each Image and resize it.
    //     if($dir = opendir($ImagesDirectory)){
    //         while(($file = readdir($dir))!== false){
    //             $f = $file;
    //             if(is_dir($file)){
    //                 $subdir = opendir($ImagesDirectory.$file);
    //                 while(($file1 = readdir($subdir))!== false){
    //                     echo $imagePath = $ImagesDirectory.$file1;
    //                     echo"<br>";
    //                     echo $destPath = $DestImagesDirectory.$file1;
    //                     echo"<br>";
    //                     $checkValidImage = @getimagesize($imagePath);
    //                     //	mkdir($destPath,2);
    //                     if(file_exists($imagePath) && $checkValidImage) //Continue only if 2 given parameters are true
    //                     {
    //                         //Image looks valid, resize.
    //                         if($this->resizeImage($imagePath,$destPath,$NewImageWidth,$NewImageHeight,$Quality))
    //                         {
    //                             echo $file.' resize Success!<br />'; 
    //                             /*
    //                             Now Image is resized, may be save information in database?
    //                             */

    //                         }else{
    //                             echo $file.' resize Failed!<br />'; 
    //                         }
    //                     }
    //                 }
    //             }else{
    //                 $imagePath = $ImagesDirectory.$file;
    //                 $destPath = $DestImagesDirectory.$file;
    //                 $checkValidImage = @getimagesize($imagePath);

    //                 if(file_exists($imagePath) && $checkValidImage) //Continue only if 2 given parameters are true
    //                 {
    //                     //Image looks valid, resize.
    //                     if($this->resizeImage($imagePath,$destPath,$NewImageWidth,$NewImageHeight,$Quality))
    //                     {
    //                         echo $file.' resize Success!<br />'; 
    //                         /*
    //                         Now Image is resized, may be save information in database?
    //                         */

    //                     }else{
    //                         echo $file.' resize Failed!<br />';
    //                     }
    //                 }
    //             }
    //         }
    //         closedir($dir);
    //     }


      

        
        // query the user media
        $fields = "id,caption,media_type,media_url,permalink,thumbnail_url,timestamp,username";
        $token = env('INSTAGRAM_TOKEN', '');
        $limit = 10;
        $json_feed_url="https://graph.instagram.com/me/media?fields={$fields}&access_token={$token}&limit={$limit}";
        $json_feed = @file_get_contents($json_feed_url);
        $contents = json_decode($json_feed, true, 512, JSON_BIGINT_AS_STRING);
 
        // $Products= Product::with('product_variant')->get();

        // foreach($Products as $product){
        //     foreach($product->product_variant as $var){
                
        //             $variant_term = \App\Models\ProductVariantVariant::Where('product_variant_id',$var->id)->get()->pluck('attribute_term_id');
                                               
        //                 $name = '';
        //                 $slug_name = '';
        //                 $required_variation_ids ="";
        //                 foreach($variant_term as $key => $tt){
        //                     $AttributeTerm = \App\Models\AttributeTerm::where('estatus',1)->where('id',$tt)->first();
        //                     if(isset($AttributeTerm->attrterm_name)){
        //                         if($name != "" ){
        //                         $name = $name.' | '.$AttributeTerm->attrterm_name;
        //                         $slug_name = str_replace(' ', '', $slug_name.'-'.$AttributeTerm->attrterm_name);
        //                         }else{
        //                         $name = $AttributeTerm->attrterm_name;  
        //                         $slug_name = str_replace(' ', '', $slug_name.'-'.$AttributeTerm->attrterm_name);  
        //                         }
        //                     }     
        //                 } 
                
                 
        //         ProductVariant::where('id', $var->id)
        //         ->update([
        //             'slug' => $this->createSlug($product->product_title.str_replace('.', 'p', $slug_name))
        //             ]);
        //     }
        // }

        // $Diamonds= Diamond::whereNull('slug')->get();
        // foreach($Diamonds as $Diamond){
        //     if($Diamond->short_title == "N/A"){
        //         $short_title = $Diamond->Shape . " " . $Diamond->Weight . "ct " .$Diamond->Color. " " .$Diamond->Clarity;
        //     Diamond::where('id', $Diamond->id)
        //         ->update([
        //             'slug' => $this->createSlug($Diamond->short_title,$Diamond->id),
        //             'short_title' => $short_title,
        //             'long_title' => $short_title,
        //             ]);
        //     }else{
        //         Diamond::where('id', $Diamond->id)
        //         ->update([
        //             'slug' => $this->createSlug($Diamond->short_title,$Diamond->id)
        //             ]);
        //     }        
        // }

    
        $categories = Category::where('estatus',1)->where('is_custom',0)->where('parent_category_id',0)->get();
        $testimonials = Testimonial::where('estatus',1)->take(10)->get();
        $banners = Banner::where('estatus',1)->get();
        $step = Step::where('estatus',1)->first();
        $homesetting = HomeSetting::with('category')->first();
        $shopbystyle = ShopByStyle::with('category')->where('estatus',1)->get();
        $products= Product::select('products.id','products.product_title','products.primary_category_id','product_variants.slug','product_variants.alt_text','product_variants.images','product_variants.regular_price','product_variants.sale_price','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->where(['products.is_custom' => 0,'products.estatus' => 1,'product_variants.estatus' => 1,'product_variants.term_item_id' => 2])->groupBy('products.id')->orderBy('products.created_at', 'asc')->limit(12)->get();
        $BlogBanners = BlogBanner::where(['estatus' => 1,'page' => 1])->get()->ToArray();
        $SmilingDifference = SmilingDifference::get();
        $diamonds = Diamond::get();
        return view('frontend.home1',compact('categories','testimonials','banners','step','homesetting','shopbystyle','products','BlogBanners','SmilingDifference','diamonds','contents'));
    }

    public function index2(){
        

        
        // query the user media
        $fields = "id,caption,media_type,media_url,permalink,thumbnail_url,timestamp,username";
        $token = env('INSTAGRAM_TOKEN', '');
        $limit = 10;
        $json_feed_url="https://graph.instagram.com/me/media?fields={$fields}&access_token={$token}&limit={$limit}";
        $json_feed = @file_get_contents($json_feed_url);
        $contents = json_decode($json_feed, true, 512, JSON_BIGINT_AS_STRING);
 
        // $Products= Product::with('product_variant')->get();

        // foreach($Products as $product){
        //     foreach($product->product_variant as $var){
                
        //             $variant_term = \App\Models\ProductVariantVariant::Where('product_variant_id',$var->id)->get()->pluck('attribute_term_id');
                                               
        //                 $name = '';
        //                 $slug_name = '';
        //                 $required_variation_ids ="";
        //                 foreach($variant_term as $key => $tt){
        //                     $AttributeTerm = \App\Models\AttributeTerm::where('estatus',1)->where('id',$tt)->first();
        //                     if(isset($AttributeTerm->attrterm_name)){
        //                         if($name != "" ){
        //                         $name = $name.' | '.$AttributeTerm->attrterm_name;
        //                         $slug_name = str_replace(' ', '', $slug_name.'-'.$AttributeTerm->attrterm_name);
        //                         }else{
        //                         $name = $AttributeTerm->attrterm_name;  
        //                         $slug_name = str_replace(' ', '', $slug_name.'-'.$AttributeTerm->attrterm_name);  
        //                         }
        //                     }     
        //                 } 
                
                 
        //         ProductVariant::where('id', $var->id)
        //         ->update([
        //             'slug' => $this->createSlug($product->product_title.str_replace('.', 'p', $slug_name))
        //             ]);
        //     }
        // }

        // $Diamonds= Diamond::whereNull('slug')->get();
        // foreach($Diamonds as $Diamond){
        //     if($Diamond->short_title == "N/A"){
        //         $short_title = $Diamond->Shape . " " . $Diamond->Weight . "ct " .$Diamond->Color. " " .$Diamond->Clarity;
        //     Diamond::where('id', $Diamond->id)
        //         ->update([
        //             'slug' => $this->createSlug($Diamond->short_title,$Diamond->id),
        //             'short_title' => $short_title,
        //             'long_title' => $short_title,
        //             ]);
        //     }else{
        //         Diamond::where('id', $Diamond->id)
        //         ->update([
        //             'slug' => $this->createSlug($Diamond->short_title,$Diamond->id)
        //             ]);
        //     }        
        // }

    
        $categories = Category::where('estatus',1)->where('is_custom',0)->where('parent_category_id',0)->get();
        $testimonials = Testimonial::where('estatus',1)->take(10)->get();
        $banners = Banner::where('estatus',1)->get();
        $step = Step::where('estatus',1)->first();
        $homesetting = HomeSetting::with('category')->first();
        $shopbystyle = ShopByStyle::with('category')->where('estatus',1)->get();
        $products= Product::select('products.id','products.product_title','products.primary_category_id','product_variants.slug','product_variants.alt_text','product_variants.images','product_variants.regular_price','product_variants.sale_price','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->where(['products.is_custom' => 0,'products.estatus' => 1,'product_variants.estatus' => 1,'product_variants.term_item_id' => 2])->groupBy('products.id')->orderBy('products.created_at', 'asc')->limit(12)->get();
        $BlogBanners = BlogBanner::where(['estatus' => 1,'page' => 1])->get()->ToArray();
        $SmilingDifference = SmilingDifference::get();
        $diamonds = Diamond::get();
        return view('frontend.home2',compact('categories','testimonials','banners','step','homesetting','shopbystyle','products','BlogBanners','SmilingDifference','diamonds','contents'));
    }

    public function createSlug($title, $id = 0)
    {
        $slug = str_slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);
    }
    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Diamond::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }

    public function sitemap(){
        return  response()->view('frontend.sitemap')->header('Content-Type', 'text/xml');
    }

    //Function that resizes image.
public function resizeImage($SrcImage,$DestImage, $MaxWidth,$MaxHeight,$Quality)
{
    list($iWidth,$iHeight,$type)    = getimagesize($SrcImage);
    $ImageScale             = min($MaxWidth/$iWidth, $MaxHeight/$iHeight);
    $NewWidth               = ceil($ImageScale*$iWidth);
    $NewHeight              = ceil($ImageScale*$iHeight);
    $NewCanves              = imagecreatetruecolor($NewWidth, $NewHeight);

    switch(strtolower(image_type_to_mime_type($type)))
    {
        case 'image/jpeg':
            $NewImage = imagecreatefromjpeg($SrcImage);
            break;
        case 'image/png':
            $NewImage = imagecreatefrompng($SrcImage);
            break;
        case 'image/gif':
            $NewImage = imagecreatefromgif($SrcImage);
            break;
        default:
            return false;
    }

    // Resize Image
    if(imagecopyresampled($NewCanves, $NewImage,0, 0, 0, 0, $NewWidth, $NewHeight, $iWidth, $iHeight))
    {
        // copy file
        if(imagejpeg($NewCanves,$DestImage,$Quality))
        {
            imagedestroy($NewCanves);
            return true;
        }
    }
}
    
    
}



