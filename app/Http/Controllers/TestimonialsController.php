<?php

namespace App\Http\Controllers;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialsController extends Controller
{
    public function index(){
        $Testimonials = Testimonial::where(['estatus' => 1])->get();
        return view('frontend.testimonials',compact('Testimonials'));
    }
}
