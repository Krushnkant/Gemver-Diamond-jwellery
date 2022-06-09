<?php

namespace App\Http\Controllers;
use App\Models\Infopage;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index(){
        $Infopage= Infopage::first();
        //dd($Infopage);
        return view('frontend.aboutus',compact('Infopage'));
    }
}
