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
        $Products= Product::with('product_variant')->get();
        
        foreach($Products as $product){
            foreach($product->product_variant as $var){
                ProductVariant::where('id', $var->id)
                ->update([
                    'slug' => $this->createSlug($product->product_title)
                    ]);
            }
        }

        $Category= Category::get();
        foreach($Category as $Cat){
            Category::where('id', $Cat->id)
            ->update([
                'slug' => $this->createSlugC($Cat->category_name)
                ]);
        }

        $categories = Category::where('estatus',1)->where('is_custom',0)->where('parent_category_id',0)->get();
        $testimonials = Testimonial::where('estatus',1)->take(10)->get();
        $banners = Banner::where('estatus',1)->get();
        $step = Step::where('estatus',1)->first();
        $homesetting = HomeSetting::first();
        $shopbystyle = ShopByStyle::where('estatus',1)->get();
        //$diamondshape = Diamond::whereNotNull('Shape')->Where('Shape','<>','')->groupBy('Shape')->pluck('Shape');
        $products= Product::select('products.id','products.primary_category_id','product_variants.slug','product_variants.alt_text','product_variants.images','product_variants.regular_price','product_variants.sale_price','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->where(['products.is_custom' => 0,'products.estatus' => 1,'product_variants.estatus' => 1])->groupBy('products.id')->orderBy('products.created_at', 'DESC')->limit(12)->get();
        $BlogBanners = BlogBanner::where(['estatus' => 1,'page' => 1])->get()->ToArray();
        $SmilingDifference = SmilingDifference::get();
        return view('frontend.home',compact('categories','testimonials','banners','step','homesetting','shopbystyle','products','BlogBanners','SmilingDifference'));
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
        return ProductVariant::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }

    public function createSlugC($title, $id = 0)
    {
        $slug = str_slug($title);
        $allSlugs = $this->getRelatedSlugsC($slug, $id);
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
    protected function getRelatedSlugsC($slug, $id = 0)
    {
        return Category::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }
}
