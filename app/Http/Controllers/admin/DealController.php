<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ApplicationDropdown;
use App\Models\Category;
use App\Models\Deal;
use App\Models\ProjectPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DealController extends Controller
{
    private $page = "Deal";

    public function index(){
        $action = "edit";
        $deal = Deal::first();
        $application_dropdowns = ApplicationDropdown::get();
        $categories = Category::where('estatus',1)->orderBy('created_at','DESC')->get();
        $products = "";
        if(isset($deal->application_dropdown_id) && $deal->application_dropdown_id == 2) {
            $products = getproducts($deal->value);
        }
        return view('admin.deal.list',compact('action','deal','application_dropdowns','categories','products'))->with('page',$this->page);
    }

    public function save(Request $request){
        $messages = [
            'title.required' =>'Please provide tile',
            'start_date.required' =>'Please provide a start date',
            'date_title.required' =>'Please provide a date title',
        ];

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'start_date' => 'required',
            'date_title' => 'required',
            'BannerInfo' => 'required',
            'value' => 'required',
            'product' => $request->BannerInfo == 2 ? 'required|exists:products,id' : 'nullable|exists:products,id'
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        if ($request->deal_id != ""){
            $deal = Deal::find($request->deal_id);
            if(!$deal){
                return response()->json(['status' => '400']);
            }
        }else{
            $deal = new Deal();
        }
        $deal->title = $request->title;
        $deal->start_date = $request->start_date;
        $deal->date_title = $request->date_title;
        $deal->background_color = $request->background_color;
        $deal->text_color = $request->text_color;
        $deal->button_color = $request->button_color;
        $deal->text_button = $request->text_button;
        $deal->url_button = $request->url_button;
        $deal->application_dropdown_id = $request->BannerInfo;
        $deal->value = $request->value;
        $deal->product_variant_id = isset($request->product) ? $request->product : null;
        $deal->save();

        return response()->json(['status' => '200']);
    }

    

  
}
