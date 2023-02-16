<?php

namespace App\Http\Controllers;
use App\Models\Infopage;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index(){
        $Infopage= Infopage::first();
        return view('frontend.aboutus',compact('Infopage'))->with(['meta_title'=>$Infopage->about_meta_title,'meta_description'=>$Infopage->about_meta_description]);
    }
}
