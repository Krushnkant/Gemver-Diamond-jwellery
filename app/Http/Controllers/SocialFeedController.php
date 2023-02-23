<?php

namespace App\Http\Controllers;

use App\Models\SocialFeed;


class SocialFeedController extends Controller
{
    public function index(){
    
        $socialfeeds = SocialFeed::where(['estatus' => 1])->orderBy('id', 'DESC')->get();
        $meta_title = "Social Feed";
        $meta_description = "Social Feed";
        return view('frontend.socialfeeds',compact('socialfeeds'))->with(['meta_title'=>$meta_title,'meta_description'=>$meta_description]);
    }
}
