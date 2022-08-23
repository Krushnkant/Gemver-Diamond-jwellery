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
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $categories = Category::where('estatus',1)->where('is_custom',0)->where('parent_category_id',0)->get();
        $testimonials = Testimonial::where('estatus',1)->take(10)->get();
        $banners = Banner::where('estatus',1)->get();
        $step = Step::where('estatus',1)->first();
        $homesetting = HomeSetting::first();
        $shopbystyle = ShopByStyle::where('estatus',1)->get();
        $diamondshape = Diamond::whereNotNull('Shape')->Where('Shape','<>','')->groupBy('Shape')->pluck('Shape');
        $products= Product::select('products.*','product_variants.images','product_variants.sale_price','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->leftJoin("product_variant_variants", "product_variant_variants.product_id", "=", "products.id")->where(['products.is_custom' => 0,'products.estatus' => 1,'product_variants.estatus' => 1])->groupBy('products.id')->orderBy('products.created_at', 'DESC')->limit(12)->get();
        return view('frontend.home',compact('categories','testimonials','banners','step','homesetting','shopbystyle','diamondshape','products'));
    }
}
