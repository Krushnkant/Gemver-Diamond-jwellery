<?php

namespace App\Http\Controllers;
use App\Models\Infopage;
use Illuminate\Http\Request;

class TermConditionController extends Controller
{
    public function index(){
        $Infopage= Infopage::first();
        //dd($Infopage);
        return view('frontend.termcondition',compact('Infopage'))->with(['meta_title'=>$Infopage->terms_condition_meta_title,'meta_description'=>$Infopage->terms_condition_meta_description]);
    }
}
