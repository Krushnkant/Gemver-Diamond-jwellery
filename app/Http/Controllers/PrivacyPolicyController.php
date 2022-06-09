<?php

namespace App\Http\Controllers;
use App\Models\Infopage;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function index(){
        $Infopage= Infopage::first();
        //dd($Infopage);
        return view('frontend.privacypolicy',compact('Infopage'));
    }
}
