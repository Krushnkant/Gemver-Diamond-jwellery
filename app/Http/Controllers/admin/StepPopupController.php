<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\StepPopup;
use App\Models\Category;
use App\Models\ProjectPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class StepPopupController extends Controller
{
    private $page = "Step Popup";

    public function index($id){
        $action = "list";
        $steps = StepPopup::where('category_id',$id)->get();
        return view('admin.steppopup.list',compact('action','steps'))->with('page',$this->page);
    }

    public function editsteppopup($id){
        $stepPopup = StepPopup::find($id);
        return response()->json($stepPopup);
    }

    public function addorupdatestepPopup(Request $request){
        $messages = [
            'title.required' =>'Please provide a Title',
            'icon.image' =>'Please provide a Valid Extension Image(e.g: .jpg .png)',
            'icon.mimes' =>'Please provide a Valid Extension Image(e.g: .jpg .png)',
        ];
        if(isset($request->action) && $request->action=="update"){
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
            ], $messages);
        }else{
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'icon' => 'required|image|mimes:jpeg,png,jpg',
            ], $messages);

        }
        

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        if(isset($request->action) && $request->action=="update"){
            $action = "update";
            $StepPopup = StepPopup::find($request->step_id);

            if(!$StepPopup){
                return response()->json(['status' => '400']);
            }

            $old_image = $StepPopup->icon;
            $image_name = $old_image;
            $StepPopup->title = $request->title;
            $StepPopup->description = $request->description;
        }
        else{
            $action = "add";
            $StepPopup = new StepPopup();
            $StepPopup->attrterm_name = $request->title;
            $StepPopup->created_at = new \DateTime(null, new \DateTimeZone('Asia/Kolkata'));
            $image_name=null;
            $StepPopup->description = $request->description;
        }

        if ($request->hasFile('icon')) {
            $image = $request->file('icon');
            $image_name = 'icon_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/steppopup');
            $image->move($destinationPath, $image_name);
            if(isset($old_image)) { 
                $old_image = public_path('images/steppopup/' . $old_image);
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
            }
            $StepPopup->icon = $image_name;
        }

        $StepPopup->save();

        return response()->json(['status' => '200', 'action' => $action]);
    }
}
