<?php

namespace App\Http\Controllers;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialsController extends Controller
{
    public function index(){
        $Testimonials = Testimonial::where(['estatus' => 1])->get();
        $meta_title = "Testimonial";
        $meta_description = "Testimonial";
        return view('frontend.testimonials',compact('Testimonials'))->with(['meta_title'=>$meta_title,'meta_description'=>$meta_description]);;
    }
}
