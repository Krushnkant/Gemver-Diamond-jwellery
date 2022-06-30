<?php

namespace App\Http\Controllers;
use App\Models\Step;
use Illuminate\Http\Request;

class StepController extends Controller
{
    public function stepone($slug){
        $Step = Step::where(['estatus' => 1,'slug' => $slug])->first();
        return view('frontend.stepone',compact('Step'));
    }

    public function steptwo($slug){
        $Step = Step::where(['estatus' => 1,'slug' => $slug])->first();
        return view('frontend.steptwo',compact('Step'));
    }

    public function stepthree($slug){
        $Step = Step::where(['estatus' => 1,'slug' => $slug])->first();
        return view('frontend.stepthree',compact('Step'));
    }

    public function stepfour($slug){
        $Step = Step::where(['estatus' => 1,'slug' => $slug])->first();
        return view('frontend.stepfour',compact('Step'));
    }
}
