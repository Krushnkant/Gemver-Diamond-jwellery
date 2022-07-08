<?php

namespace App\Http\Controllers;
use App\Models\Infopage;
use App\Models\DiamondAnatomy;
use Illuminate\Http\Request;

class OtherPageController extends Controller
{
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

   

}
