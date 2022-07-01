<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Testimonial;
use App\Models\Step;
use App\Models\HomeSetting;
use App\Models\ShopByStyle;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $categories = Category::where('estatus',1)->take(4)->get();
        $testimonials = Testimonial::where('estatus',1)->take(10)->get();
        $banners = Banner::where('estatus',1)->get();
        $step = Step::where('estatus',1)->first();
        $homesetting = HomeSetting::first();
        $shopbystyle = ShopByStyle::where('estatus',1)->get();
        return view('frontend.home',compact('categories','testimonials','banners','step','homesetting','shopbystyle'));
    }
}
