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
use App\Models\ProductVariant;
use App\Models\SmilingDifference;


class HomeController extends Controller
{
    public function index(){
        

        
        // query the user media
        // $fields = "id,caption,media_type,media_url,permalink,thumbnail_url,timestamp,username";
        // $token = env('INSTAGRAM_TOKEN', '');
        // $limit = 10;
        // $json_feed_url="https://graph.instagram.com/me/media?fields={$fields}&access_token={$token}&limit={$limit}";
        // $json_feed = @file_get_contents($json_feed_url);
        $contents = [];
 
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
        // $banners = Banner::where('estatus',1)->get();
        $banners = [];
        $step = Step::where('estatus',1)->first();
        $homesetting = HomeSetting::with('category')->first();
        $shopbystyle = [];
        //$shopbystyle = ShopByStyle::with('category')->where('estatus',1)->get();
       // $products= Product::select('products.id','products.product_title','products.primary_category_id','product_variants.slug','product_variants.alt_text','product_variants.images','product_variants.regular_price','product_variants.sale_price','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->where(['products.is_custom' => 0,'products.estatus' => 1,'product_variants.estatus' => 1,'product_variants.term_item_id' => 2])->groupBy('products.id')->orderBy('products.created_at', 'asc')->limit(12)->get();
       $BlogBanners = [];
        //$BlogBanners = BlogBanner::where(['estatus' => 1,'page' => 1])->get()->ToArray();
        $SmilingDifference = [];
        $diamonds = Diamond::get()->count();
        return view('frontend.home',compact('categories','testimonials','banners','step','homesetting','shopbystyle','BlogBanners','SmilingDifference','diamonds','contents'));
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
    
    
}
