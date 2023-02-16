<?php

namespace App\Http\Controllers;
use App\Models\Infopage;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function index(){
        $Infopage= Infopage::first();
        //dd($Infopage);
        return view('frontend.privacypolicy',compact('Infopage'))->with(['meta_title'=>$Infopage->privacy_policy_meta_title,'meta_description'=>$Infopage->privacy_policy_meta_description]);;
    }
}
