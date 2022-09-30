<?php

namespace App\Http\Controllers;
use App\Models\Infopage;
use App\Models\DiamondAnatomy;
use App\Models\Product;
use App\Models\SmilingDifference;
use Illuminate\Http\Request;

class OtherPageController extends Controller
{
    public function gemverdifference(){
        $Infopage= Infopage::first();
        return view('frontend.gemverdifference',compact('Infopage'));
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
       
        return view('frontend.engagement');
    }

    public function finejewellery(){
       
        return view('frontend.finejewellery');
    }

    public function labgrowndiamonds(){
        $products= Product::select('products.*','product_variants.images','product_variants.regular_price','product_variants.sale_price','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->leftJoin("product_variant_variants", "product_variant_variants.product_id", "=", "products.id")->where(['products.is_custom' => 0,'products.estatus' => 1,'product_variants.estatus' => 1])->groupBy('products.id')->orderBy('products.created_at', 'DESC')->limit(12)->get();
        $SmilingDifference = SmilingDifference::get();
        return view('frontend.labgrowndiamonds',compact('products','SmilingDifference'));
    }

    public function custommadejewellery(){
        $products= Product::select('products.*','product_variants.images','product_variants.regular_price','product_variants.sale_price','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->leftJoin("product_variant_variants", "product_variant_variants.product_id", "=", "products.id")->where(['products.is_custom' => 0,'products.estatus' => 1,'product_variants.estatus' => 1])->groupBy('products.id')->orderBy('products.created_at', 'DESC')->limit(12)->get();
        $SmilingDifference = SmilingDifference::get();

        return view('frontend.custommadejewellery',compact('products','SmilingDifference'));
    }

    public function weddingbands(){
        $products= Product::select('products.*','product_variants.images','product_variants.regular_price','product_variants.sale_price','product_variants.id as variant_id')->leftJoin("product_variants", "product_variants.product_id", "=", "products.id")->leftJoin("product_variant_variants", "product_variant_variants.product_id", "=", "products.id")->where(['products.is_custom' => 0,'products.estatus' => 1,'product_variants.estatus' => 1])->groupBy('products.id')->orderBy('products.created_at', 'DESC')->limit(12)->get();
        $SmilingDifference = SmilingDifference::get();
        return view('frontend.weddingbands',compact('products','SmilingDifference'));
    }

   

}
