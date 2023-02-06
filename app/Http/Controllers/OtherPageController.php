<?php

namespace App\Http\Controllers;
use App\Models\Infopage;
use App\Models\DiamondAnatomy;
use App\Models\MenuPage;
use App\Models\Product;
use App\Models\Category;
use App\Models\GenverDifference;
use App\Models\SmilingDifference;
use App\Models\Faq;
use Illuminate\Http\Request;

class OtherPageController extends Controller
{
    public function gemverdifference(){
        $GenverDifference = GenverDifference::first();
        return view('frontend.gemverdifference',compact('GenverDifference'))->with(['meta_title'=>$GenverDifference->meta_title,'meta_description'=>$GenverDifference->meta_description]);
    }

    public function freeengraving(){
        $Infopage= Infopage::first();
        return view('frontend.freeengraving',compact('Infopage'))->with(['meta_title'=>$Infopage->free_engraving_meta_title,'meta_description'=>$Infopage->free_engraving_meta_description]);
    }

    public function freeresizing(){
        $Infopage= Infopage::first();
        return view('frontend.freeresizing',compact('Infopage'))->with(['meta_title'=>$Infopage->free_resizing_meta_title,'meta_description'=>$Infopage->free_resizing_meta_description]);
    }

    public function freeshipping(){
        $Infopage= Infopage::first();
        return view('frontend.freeshipping',compact('Infopage'))->with(['meta_title'=>$Infopage->free_shipping_meta_title,'meta_description'=>$Infopage->free_shipping_meta_description]);
    }

    public function lifetimeupgrade(){
        $Infopage= Infopage::first();
        return view('frontend.lifetimeupgrade',compact('Infopage'))->with(['meta_title'=>$Infopage->lifetime_upgrade_meta_title,'meta_description'=>$Infopage->lifetime_upgrade_meta_description]);
    }

    public function lifetimewarranty(){
        $Infopage= Infopage::first();
        return view('frontend.lifetimewarranty',compact('Infopage'))->with(['meta_title'=>$Infopage->lifetime_warranty_meta_title,'meta_description'=>$Infopage->lifetime_warranty_meta_description]);
    }

    public function paymentoptions(){
        $Infopage= Infopage::first();
        return view('frontend.paymentoptions',compact('Infopage'))->with(['meta_title'=>$Infopage->payment_options_meta_title,'meta_description'=>$Infopage->payment_options_meta_description]);
    }

    public function returndays(){
        $Infopage= Infopage::first();
        return view('frontend.returndays',compact('Infopage'))->with(['meta_title'=>$Infopage->return_days_meta_title,'meta_description'=>$Infopage->return_days_meta_description]);
    }

    public function customervalues(){
        $Infopage= Infopage::first();
        return view('frontend.customervalues',compact('Infopage'))->with(['meta_title'=>$Infopage->customer_value_meta_title,'meta_description'=>$Infopage->customer_value_meta_description]);
    }

    public function marketneed(){
        $Infopage= Infopage::first();
        return view('frontend.marketneed',compact('Infopage'))->with(['meta_title'=>$Infopage->market_need_meta_title,'meta_description'=>$Infopage->market_need_meta_description]);
    }

    public function ethicaledge(){
        $Infopage= Infopage::first();
        return view('frontend.ethicaledge',compact('Infopage'));
    }

    public function diamondanatomy(){
        $DiamondAnatomy= DiamondAnatomy::first();
        return view('frontend.diamondanatomy',compact('DiamondAnatomy'))->with(['meta_title'=>$DiamondAnatomy->meta_title,'meta_description'=>$DiamondAnatomy->meta_description]);
    }

    public function learnaboutlabmadediamonds(){
        $Infopage= Infopage::first();
        return view('frontend.learnaboutlabmadediamonds',compact('Infopage'))->with(['meta_title'=>$Infopage->learn_about_lab_made_diamonds_meta_title,'meta_description'=>$Infopage->learn_about_lab_made_diamonds_meta_description]);
    }

    public function conflictfreediamonds(){
        $Infopage= Infopage::first();
        return view('frontend.conflictfreediamonds',compact('Infopage'))->with(['meta_title'=>$Infopage->conflict_free_diamonds_meta_title,'meta_description'=>$Infopage->conflict_free_diamonds_meta_description]);
    }

    


    public function engagement(){
        $MenuPage = MenuPage::with('menupageshapestyle.category','category')->where('id',1)->first();
        $select_product = explode(',',$MenuPage->select_product);
        $faqs = Faq::whereRaw('FIND_IN_SET(1,menu_page_ids)')->get();
        $products= Product::select('products.*','product_variants.slug','product_variants.alt_text','product_variants.images','product_variants.regular_price','product_variants.sale_price','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->where(['products.is_custom' => 0,'products.estatus' => 1,'product_variants.estatus' => 1,'product_variants.term_item_id' => 2])->WhereIn('products.id', $select_product)->groupBy('products.id')->orderBy('products.created_at', 'DESC')->get();
        return view('frontend.engagement',compact('MenuPage','products','faqs'))->with(['meta_title'=>$MenuPage->meta_title,'meta_description'=>$MenuPage->meta_description]);
    }

    public function weddingbands(){
        $MenuPage = MenuPage::with('menupageshapestyle.category','category')->where('id',2)->first();
        $select_product = explode(',',$MenuPage->select_product);
        $faqs = Faq::whereRaw('FIND_IN_SET(2,menu_page_ids)')->get();
        $products= Product::select('products.*','product_variants.slug','product_variants.alt_text','product_variants.images','product_variants.regular_price','product_variants.sale_price','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->where(['products.is_custom' => 0,'products.estatus' => 1,'product_variants.estatus' => 1,'product_variants.term_item_id' => 2])->WhereIn('products.id', $select_product)->groupBy('products.id')->orderBy('products.created_at', 'DESC')->get();
        return view('frontend.weddingbands',compact('products','MenuPage','faqs'))->with(['meta_title'=>$MenuPage->meta_title,'meta_description'=>$MenuPage->meta_description]);
    }

    public function labgrowndiamonds(){
        $MenuPage = MenuPage::with('menupageshapestyle.category')->where('id',3)->first();
        $faqs = Faq::whereRaw('FIND_IN_SET(3,menu_page_ids)')->get();
        $SmilingDifference = SmilingDifference::get();
        return view('frontend.labgrowndiamonds',compact('MenuPage','SmilingDifference','faqs'))->with(['meta_title'=>$MenuPage->meta_title,'meta_description'=>$MenuPage->meta_description]);
    }

    public function finejewellery(){
        $MenuPage = MenuPage::with('menupageshapestyle.category','section31_category','section32_category','section33_category')->where('id',4)->first();
        $faqs = Faq::whereRaw('FIND_IN_SET(4,menu_page_ids)')->get();
        return view('frontend.finejewellery',compact('MenuPage','faqs'));
    }

    public function custommadejewellery(){
        $MenuPage = MenuPage::with('menupageshapestyle.category')->where('id',5)->first();
        $faqs = Faq::whereRaw('FIND_IN_SET(5,menu_page_ids)')->get();
        $custom_categories = Category::where(['estatus' => 1,'is_custom' =>1])->orderBy('created_at','DESC')->get();
        return view('frontend.custommadejewellery',compact('MenuPage','custom_categories','faqs'))->with(['meta_title'=>$MenuPage->meta_title,'meta_description'=>$MenuPage->meta_description]);
    }

    

   

}
