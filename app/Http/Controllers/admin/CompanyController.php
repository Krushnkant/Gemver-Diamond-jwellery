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

    public function editcompany($id){
        $partner = Company::find($id);
        return response()->json($partner);
    }

    public function updateCompanyPercentage(Request $request){
        $messages = [
            'company_percentage.required' =>'Please provide a company percentage',
        ];

        $validator = Validator::make($request->all(), [
            'company_percentage' => 'required|numeric',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $Company = Company::find($request->company_id);
        if(!$Company){
            return response()->json(['status' => '400']);
        }
        $Company->company_percentage = $request->company_percentage;
        $Company->save();
        return response()->json(['status' => '200','company_percentage' => $Company->company_percentage]);
    }

    
}
