<?php

namespace App\Http\Controllers;
use App\Models\Infopage;
use App\Models\DiamondAnatomy;
use App\Models\MenuPage;
use App\Models\Product;
use App\Models\Category;
use App\Models\GenverDifference;
use App\Models\SmilingDifference;
use Illuminate\Http\Request;

class OtherPageController extends Controller
{
    public function gemverdifference(){
        $GenverDifference = GenverDifference::first();
        return view('frontend.gemverdifference',compact('GenverDifference'));
    }

    public function freeengraving(){
        $Infopage= Infopage::first();
        return view('frontend.freeengraving',compact('Infopage'));
    }

    public function freeresizing(){
        $Infopage= Infopage::first();
        return view('frontend.freeresizing',compact('Infopage'));
    }

    public function freeshipping(){
        $Infopage= Infopage::first();
        return view('frontend.freeshipping',compact('Infopage'));
    }

    public function lifetimeupgrade(){
        $Infopage= Infopage::first();
        return view('frontend.lifetimeupgrade',compact('Infopage'));
    }

    public function lifetimewarranty(){
        $Infopage= Infopage::first();
        return view('frontend.lifetimewarranty',compact('Infopage'));
    }

    public function paymentoptions(){
        $Infopage= Infopage::first();
        return view('frontend.paymentoptions',compact('Infopage'));
    }

    public function returndays(){
        $Infopage= Infopage::first();
        return view('frontend.returndays',compact('Infopage'));
    }

    public function customervalues(){
        $Infopage= Infopage::first();
        return view('frontend.customervalues',compact('Infopage'));
    }

    public function marketneed(){
        $Infopage= Infopage::first();
        return view('frontend.marketneed',compact('Infopage'));
    }

    public function ethicaledge(){
        $Infopage= Infopage::first();
        return view('frontend.ethicaledge',compact('Infopage'));
    }

    public function diamondanatomy(){
        $DiamondAnatomy= DiamondAnatomy::first();
        return view('frontend.diamondanatomy',compact('DiamondAnatomy'));
    }

    public function learnaboutlabmadediamonds(){
        $Infopage= Infopage::first();
        return view('frontend.learnaboutlabmadediamonds',compact('Infopage'));
    }

    public function conflictfreediamonds(){
        $Infopage= Infopage::first();
        return view('frontend.conflictfreediamonds',compact('Infopage'));
    }

    


    public function engagement(){
        $MenuPage = MenuPage::with('menupageshapestyle')->where('id',1)->first();
        $select_product = explode(',',$MenuPage->select_product);
        $products= Product::select('products.*','product_variants.images','product_variants.regular_price','product_variants.sale_price','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->where(['products.is_custom' => 0,'products.estatus' => 1,'product_variants.estatus' => 1])->WhereIn('products.id', $select_product)->groupBy('products.id')->orderBy('products.created_at', 'DESC')->get();
        return view('frontend.engagement',compact('MenuPage','products'));
    }

    public function weddingbands(){
        $MenuPage = MenuPage::with('menupageshapestyle')->where('id',2)->first();
        $select_product = explode(',',$MenuPage->select_product);
        //$products= Product::select('products.*','product_variants.images','product_variants.regular_price','product_variants.sale_price','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->leftJoin("product_variant_variants", "product_variant_variants.product_id", "=", "products.id")->where(['products.is_custom' => 0,'products.estatus' => 1,'product_variants.estatus' => 1])->groupBy('products.id')->orderBy('products.created_at', 'DESC')->limit(12)->get();
        $products= Product::select('products.*','product_variants.images','product_variants.regular_price','product_variants.sale_price','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->where(['products.is_custom' => 0,'products.estatus' => 1,'product_variants.estatus' => 1])->WhereIn('products.id', $select_product)->groupBy('products.id')->orderBy('products.created_at', 'DESC')->get();
        return view('frontend.weddingbands',compact('products','MenuPage'));
    }

    public function labgrowndiamonds(){
        $MenuPage = MenuPage::with('menupageshapestyle')->where('id',3)->first();
        $SmilingDifference = SmilingDifference::get();
        return view('frontend.labgrowndiamonds',compact('MenuPage','SmilingDifference'));
    }

    public function finejewellery(){
        $MenuPage = MenuPage::with('menupageshapestyle')->where('id',4)->first();
        return view('frontend.finejewellery',compact('MenuPage'));
    }

    public function custommadejewellery(){
        $MenuPage = MenuPage::with('menupageshapestyle')->where('id',5)->first();
        $custom_categories = Category::where(['estatus' => 1,'is_custom' =>1])->orderBy('created_at','DESC')->get();
        return view('frontend.custommadejewellery',compact('MenuPage','custom_categories'));
    }

    

   

}
