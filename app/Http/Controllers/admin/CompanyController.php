<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectPage;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    private $page = "Company";

    public function index(){
        $Companyies = Company::get();
        $canWrite = false;
        $page_id = ProjectPage::where('route_url','admin.company.list')->pluck('id')->first();
        if( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
            $canWrite = true;
        }
        return view('admin.company.list',compact('Companyies','canWrite'))->with('page',$this->page);
    }

    public function editUserDiscountPercentage(){
        $Company = Company::find(1);
        return response()->json($Company);
    }

    public function editShippingCost(){
        $Company = Company::find(1);
        return response()->json($Company);
    }

    public function editPremiumUserMembershipFee(){
        $Company = Company::find(1);
        return response()->json($Company);
    }

    public function updateUserDiscountPercentage(Request $request){
        $messages = [
            'user_discount_percentage.required' =>'Please provide a user discount percentage',
        ];

        $validator = Validator::make($request->all(), [
            'user_discount_percentage' => 'required|numeric',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $Company = Company::find(1);
        if(!$Company){
            return response()->json(['status' => '400']);
        }
        $Company->user_discount_percentage = $request->user_discount_percentage;
        $Company->save();
        return response()->json(['status' => '200','user_discount_percentage' => $Company->user_discount_percentage]);
    }

    public function updateShippingCost(Request $request){
        $messages = [
            'shipping_cost.required' =>'Please provide a shipping cost',
        ];

        $validator = Validator::make($request->all(), [
            'shipping_cost' => 'required|numeric',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $Company = Company::find(1);
        if(!$Company){
            return response()->json(['status' => '400']);
        }
        $Company->shipping_cost = $request->shipping_cost;
        $Company->save();
        return response()->json(['status' => '200','shipping_cost' => $Company->shipping_cost]);
    }

    public function updatePremiumUserMembershipFee(Request $request){
        $messages = [
            'premium_user_membership_fee.required' =>'Please provide a premium user membership fee',
        ];

        $validator = Validator::make($request->all(), [
            'premium_user_membership_fee' => 'required|numeric',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $Company = Company::find(1);
        if(!$Company){
            return response()->json(['status' => '400']);
        }
        $Company->premium_user_membership_fee = $request->premium_user_membership_fee;
        $Company->save();
        return response()->json(['status' => '200','premium_user_membership_fee' => $Company->premium_user_membership_fee]);
    }

    public function editMinOrderAmount(){
        $Company = Company::find(1);
        return response()->json($Company);
    }

    public function updateMinOrderAmount(Request $request){
        $messages = [
            'min_order_amount.required' =>'Please provide a minimum order amount',
        ];

        $validator = Validator::make($request->all(), [
            'min_order_amount' => 'required|numeric',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $Company = Company::find(1);
        if(!$Company){
            return response()->json(['status' => '400']);
        }
        $Company->min_order_amount = $request->min_order_amount;
        $Company->save();
        return response()->json(['status' => '200','min_order_amount' => $Company->min_order_amount]);
    }
}
