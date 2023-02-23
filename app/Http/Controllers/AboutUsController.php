<?php

namespace App\Http\Controllers;
use App\Models\Infopage;
use App\Models\Settings;
use App\Models\SocialFeed;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index(){
        $Infopage= Infopage::first();
        $settings= Settings::first();
        $socialfeed = SocialFeed::where('slug',$Infopage->social_feed)->first();

        return view('frontend.aboutus',compact('Infopage','settings','socialfeed'))->with(['meta_title'=>$Infopage->about_meta_title,'meta_description'=>$Infopage->about_meta_description]);
    }
}
