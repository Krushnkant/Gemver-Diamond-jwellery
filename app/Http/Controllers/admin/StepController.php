<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Step;
use App\Models\Category;
use App\Models\ProjectPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StepController extends Controller
{
    private $page = "Step";

    public function index(){
        $action = "list";
        $steps = Step::where('estatus',1)->get();
        return view('admin.steps.list',compact('action','steps'))->with('page',$this->page);
    }

    public function allsteplist(Request $request){
        if ($request->ajax()) {
            $columns = array(
                0 =>'sr_no',
                1 =>'category',
                2 => 'title',
                3 => 'estatus',
                4 => 'created_at',
                5 => 'step',
                6 => 'action',
            );
            $totalData = Step::count();
            $totalFiltered = $totalData;
            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            if($order == "sr_no"){
                $order = "created_at";
                $dir = 'desc';
            }

            if(empty($request->input('search.value')))
            {
                $steps = Step::with('category')->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
              
            }
            else {
                $search = $request->input('search.value');
                $steps =  Step::with('category')->Where('main_title', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
                $totalFiltered = Step::Where('main_title', 'LIKE',"%{$search}%")
                    ->count();
            }

            $data = array();

            if(!empty($steps))
            {
                foreach ($steps as $step)
                {
                    $page_id = ProjectPage::where('route_url','admin.steps.list')->pluck('id')->first();

                    if( $step->estatus==1 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="StepStatuscheck_'. $step->id .'" onchange="chageStepStatus('. $step->id .')" value="1" checked="checked"><span class="slider round"></span></label>';
                    }
                    elseif ($step->estatus==1){
                        $estatus = '<label class="switch"><input type="checkbox" id="StepStatuscheck_'. $step->id .'" value="1" checked="checked"><span class="slider round"></span></label>';
                    }

                    if( $step->estatus==2 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="StepStatuscheck_'. $step->id .'" onchange="chageStepStatus('. $step->id .')" value="2"><span class="slider round"></span></label>';
                    }
                    elseif ($step->estatus==2){
                        $estatus = '<label class="switch"><input type="checkbox" id="StepStatuscheck_'. $step->id .'" value="2"><span class="slider round"></span></label>';
                    }

                    $action='';
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
                        $action .= '<button id="editStepBtn" class="btn btn-gray text-blue btn-sm" data-id="' .$step->id. '"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                    }
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_delete($page_id)) ){
                        $action .= '<button id="deleteStepBtn" class="btn btn-gray text-danger btn-sm" data-toggle="modal" data-target="#DeleteStepModal" onclick="" data-id="' .$step->id. '"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }

                    $step_action = '<button id="addStepOneBtn" class="btn btn-gray text-blue btn-sm" data-id="' .$step->id. '">Step 1</button>';
                    $step_action .= '<button id="addStepTwoBtn" class="btn btn-gray text-blue btn-sm" data-id="' .$step->id. '">Step 2</button>';
                    $step_action .= '<button id="addStepThreeBtn" class="btn btn-gray text-blue btn-sm" data-id="' .$step->id. '">Step 3</button>';
                    $step_action .= '<button id="addStepFourBtn" class="btn btn-gray text-blue btn-sm" data-id="' .$step->id. '">Step 4</button>';
                    $nestedData['category'] = $step->category->category_name;
                    $nestedData['title'] = $step->main_title;
                    $nestedData['estatus'] = $estatus;
                    $nestedData['created_at'] = date('d-m-Y h:i A', strtotime($step->created_at));
                    $nestedData['step'] = $step_action;
                    $nestedData['action'] = $action;
                    $data[] = $nestedData;
                }
            }

            $json_data = array(
                "draw"            => intval($request->input('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data,
            );
            echo json_encode($json_data);
        }
    }

    public function create(){
        $action = "create";

        $steps = Step::where('estatus',1)->get()->toArray();
        $category = Category::where('estatus',1)->get()->toArray();
        
        return view('admin.steps.list',compact('action','steps','category'))->with('page',$this->page);
    }

    public function save(Request $request){
        $messages = [
            'main_title.required' =>'Please provide a Title',
            'category_id.required' =>'Please Select Category',
            'main_shotline.required' =>'Please provide a shotline',
        ];

        if(isset($request->action) && $request->action=="update"){
            $validator = Validator::make($request->all(), [
                'main_title' =>'required',
                'category_id' =>'required',
                'main_shotline' =>'required',
            ], $messages);
        }
        else{
            $validator = Validator::make($request->all(), [
                'main_title' =>'required',
                'category_id' =>'required',
                'main_shotline' =>'required',
            ], $messages);
        }
         
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        if (isset($request->action) && $request->action=="update"){
            $action = "update";
            $step = Step::find($request->step_id);

            if(!$step){
                return response()->json(['status' => '400']);
            }

            $step->main_title = $request->main_title;
            $step->slug =  Str::slug($request->main_title);
            $step->main_shotline = $request->main_shotline;
            $step->category_id = $request->category_id;
        }
        else{
            $action = "add";
            $step = new Step();
            $step->main_title = $request->main_title;
            $step->slug =  Str::slug($request->main_title);
            $step->main_shotline = $request->main_shotline;
            $step->category_id = $request->category_id;
            $step->step1_title = $request->step1_title;
            $step->step1_shotline = $request->step1_shotline;
            $step->created_at = new \DateTime(null, new \DateTimeZone('Asia/Kolkata'));
        }
        $step->save();
        return response()->json(['status' => '200', 'action' => $action]);
    }


    public function savestepone(Request $request){
        
        $messages = [
            'step1_title.required' =>'Please provide a title',
            'step1_shotline.required' =>'Please provide a shot line',
            'step1_icon.required' =>'Please provide a icon',
            'step1_header_image.required' =>'Please provide a header image',
        ];

        if(isset($request->action) && $request->action=="update"){
            $validator = Validator::make($request->all(), [
                'step1_title' =>'required',
                'step1_shotline' =>'required',
            ], $messages);
        }else{
            $validator = Validator::make($request->all(), [
                'step1_title' =>'required',
                'step1_shotline' =>'required',
                //'step1_icon' =>'required',
                'step1_header_image' =>'required',
            ], $messages);

        }
         
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $action = "update";
        $step = Step::find($request->step_id);

        if(!$step){
            return response()->json(['status' => '400']);
        }

        $step->step1_title = $request->step1_title;
        $step->step1_shotline = $request->step1_shotline;

        // if ($request->hasFile('step1_icon')) {
        //     $image = $request->file('step1_icon');
        //     $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
        //     $destinationPath = public_path('images/steps/'.$image_name);
        //     $imageTemp = $_FILES["step1_icon"]["tmp_name"];
        //     $d = compressImage($imageTemp, $destinationPath, 70);
        //     $step->step1_icon = $image_name;
        // }else{
        //     $step->step1_icon = $step->step1_icon; 
        // }

        if ($request->hasFile('step1_header_image')) {
            $image = $request->file('step1_header_image');
            $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/steps/'.$image_name);
            $imageTemp = $_FILES["step1_header_image"]["tmp_name"];
            $d = compressImage($imageTemp, $destinationPath, 70);
            $step->step1_header_image = $image_name;
        }else{
            $step->step1_header_image = $step->step1_header_image;
        }

        $step->step1_section1_title = $request->step1_section1_title;
        $step->step1_section1_description = $request->step1_section1_description;
        if ($request->hasFile('step1_section1_image')) {
            $image = $request->file('step1_section1_image');
            $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/steps/'.$image_name);
            $imageTemp = $_FILES["step1_section1_image"]["tmp_name"];
            $d = compressImage($imageTemp, $destinationPath, 70);
            $step->step1_section1_image = $image_name;
        }else{
            $step->step1_section1_image = $step->step1_section1_image;
        }

        $step->step1_section2_title = $request->step1_section2_title;
        if ($request->hasFile('step1_section2_image1')) {
            $image = $request->file('step1_section2_image1');
            $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/steps/');
            // $imageTemp = $_FILES["step1_section2_image1"]["tmp_name"];
            // $d = compressImage($imageTemp, $destinationPath, 70);
            $image->move($destinationPath, $image_name);
            $step->step1_section2_image1 = $image_name;
        }else{
            $step->step1_section2_image1 = $step->step1_section2_image1;
        }

        $step->step1_section2_title1 = $request->step1_section2_title1;
        if ($request->hasFile('step1_section2_image2')) {
            $image = $request->file('step1_section2_image2');
            $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/steps/');
            $image->move($destinationPath, $image_name);
            // $imageTemp = $_FILES["step1_section2_image2"]["tmp_name"];
            // $d = compressImage($imageTemp, $destinationPath, 70);
            $step->step1_section2_image2 = $image_name;
        }else{
            $step->step1_section2_image2 = $step->step1_section2_image2;
        }
        $step->step1_section2_title2 = $request->step1_section2_title2;
        
        $step->save();
        return response()->json(['status' => '200', 'action' => $action]);
    }


    public function savesteptwo(Request $request){
        
        $messages = [
            'step2_title.required' =>'Please provide a title',
            'step2_shotline.required' =>'Please provide a shot line',
           // 'step2_icon.required' =>'Please provide a icon',
            'step2_header_image.required' =>'Please provide a header image',
        ];

        if(isset($request->action) && $request->action=="update"){
            $validator = Validator::make($request->all(), [
                'step2_title' =>'required',
                'step2_shotline' =>'required',
            ], $messages);
        }else{
            $validator = Validator::make($request->all(), [
                'step2_title' =>'required',
                'step2_shotline' =>'required',
                'step2_icon' =>'required',
                'step2_header_image' =>'required',
            ], $messages);

        }
         
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $action = "update";
        $step = Step::find($request->step_id);

        if(!$step){
            return response()->json(['status' => '400']);
        }

        $step->step2_title = $request->step2_title;
        $step->step2_shotline = $request->step2_shotline;
        // if ($request->hasFile('step2_icon')) {
        //     $image = $request->file('step2_icon');
        //     $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
        //     $destinationPath = public_path('images/steps/'.$image_name);
        //     $imageTemp = $_FILES["step2_icon"]["tmp_name"];
        //     $d = compressImage($imageTemp, $destinationPath, 70);
        //     $step->step2_icon = $image_name;
        // }else{
        //     $step->step2_icon = $step->step2_icon;
        // }

        if ($request->hasFile('step2_header_image')) {
            $image = $request->file('step2_header_image');
            $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/steps/'.$image_name);
            $imageTemp = $_FILES["step2_header_image"]["tmp_name"];
            $d = compressImage($imageTemp, $destinationPath, 70);
            $step->step2_header_image = $image_name;
        }else{
            $step->step2_header_image = $step->step2_header_image;
        }

        $step->step2_section1_title = $request->step2_section1_title;
        $step->step2_section1_description = $request->step2_section1_description;
        if ($request->hasFile('step2_section1_image')) {
            $image = $request->file('step2_section1_image');
            $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/steps/');
            $imageTemp = $_FILES["step2_section1_image"]["tmp_name"];
            $image->move($destinationPath, $image_name);
           // $d = compressImage($imageTemp, $destinationPath, 70);
            $step->step2_section1_image = $image_name;
        }else{
            $step->step2_section1_image = $step->step2_section1_image;
        }

        if ($request->hasFile('step2_section2_image')) {
            $image = $request->file('step2_section2_image');
            $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/steps/'.$image_name);
            $imageTemp = $_FILES["step2_section2_image"]["tmp_name"];
            $d = compressImage($imageTemp, $destinationPath, 90);
            $step->step2_section2_image = $image_name;
        }else{
            $step->step2_section2_image = $step->step2_section2_image;
        }
        
        $step->step2_section2_title1 = $request->step2_section2_title1;
        $step->step2_section2_description1 = $request->step2_section2_description1;
        $step->step2_section2_title2 = $request->step2_section2_title2;
        $step->step2_section2_description2 = $request->step2_section2_description2;
        $step->step2_section2_title3 = $request->step2_section2_title3;
        $step->step2_section2_description3 = $request->step2_section2_description3;
        $step->step2_section3_title = $request->step2_section3_title;
        $step->step2_section3_description = $request->step2_section3_description;
        if ($request->hasFile('step2_section3_image')) {
            $image = $request->file('step2_section3_image');
            $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/steps/'.$image_name);
            $imageTemp = $_FILES["step2_section3_image"]["tmp_name"];
            $d = compressImage($imageTemp, $destinationPath, 70);
            $step->step2_section3_image = $image_name;
        }else{
            $step->step2_section3_image = $step->step2_section3_image;
        }
        
        $step->step2_section4_title = $request->step2_section4_title;
        $step->step2_section4_description = $request->step2_section4_description;
        if ($request->hasFile('step2_section4_image')) {
            $image = $request->file('step2_section4_image');
            $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/steps/'.$image_name);
            $imageTemp = $_FILES["step2_section4_image"]["tmp_name"];
            $d = compressImage($imageTemp, $destinationPath, 70);
            $step->step2_section4_image = $image_name;
        }else{
            $step->step2_section4_image = $step->step2_section4_image;
        }

        $step->step2_section5_title = $request->step2_section5_title;
        $step->step2_section5_description = $request->step2_section5_description;
        if ($request->hasFile('step2_section5_image')) {
            $image = $request->file('step2_section5_image');
            $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/steps/'.$image_name);
            $imageTemp = $_FILES["step2_section5_image"]["tmp_name"];
            $d = compressImage($imageTemp, $destinationPath, 70);
            $step->step2_section5_image = $image_name;
        }else{
            $step->step2_section5_image = $step->step2_section5_image;
        }
        
        $step->save();
        return response()->json(['status' => '200', 'action' => $action]);
    }

    public function savestepthree(Request $request){
        
        $messages = [
            'step3_title.required' =>'Please provide a title',
            'step3_shotline.required' =>'Please provide a shot line',
            'step3_icon.required' =>'Please provide a icon',
            'step3_header_image.required' =>'Please provide a header image',
        ];

        if(isset($request->action) && $request->action=="update"){
            $validator = Validator::make($request->all(), [
                'step3_title' =>'required',
                'step3_shotline' =>'required',
            ], $messages);
        }else{
            $validator = Validator::make($request->all(), [
                'step3_title' =>'required',
                'step3_shotline' =>'required',
                //'step3_icon' =>'required',
                'step3_header_image' =>'required',
            ], $messages);

        }
         
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $action = "update";
        $step = Step::find($request->step_id);

        if(!$step){
            return response()->json(['status' => '400']);
        }

        $step->step3_title = $request->step3_title;
            $step->step3_shotline = $request->step3_shotline;
            // if ($request->hasFile('step3_icon')) {
            //     $image = $request->file('step3_icon');
            //     $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            //     $destinationPath = public_path('images/steps/'.$image_name);
            //     $imageTemp = $_FILES["step3_icon"]["tmp_name"];
            //     $d = compressImage($imageTemp, $destinationPath, 70);
            //     $step->step3_icon = $image_name;
            // }else{
            //     $step->step3_icon = $step->step3_icon;
            // }

            if ($request->hasFile('step3_header_image')) {
                $image = $request->file('step3_header_image');
                $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('images/steps/'.$image_name);
                $imageTemp = $_FILES["step3_header_image"]["tmp_name"];
                $d = compressImage($imageTemp, $destinationPath, 70);
                $step->step3_header_image = $image_name;
            }else{
                $step->step3_header_image = $step->step3_header_image;
            }

            $step->step3_section1_title = $request->step3_section1_title;
            $step->step3_section1_description = $request->step3_section1_description;
            $step->step3_section2_title = $request->step3_section2_title;
            $step->step3_section2_description = $request->step3_section2_description;
            if ($request->hasFile('step3_section2_image')) {
                $image = $request->file('step3_section2_image');
                $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('images/steps/'.$image_name);
                $imageTemp = $_FILES["step3_section2_image"]["tmp_name"];
                $d = compressImage($imageTemp, $destinationPath, 70);
                $step->step3_section2_image = $image_name;
            }else{
                $step->step3_section2_image = $step->step3_section2_image;
            }
           
            $step->step3_section3_title = $request->step3_section3_title;
            $step->step3_section3_description = $request->step3_section3_description;
            if ($request->hasFile('step3_section3_image')) {
                $image = $request->file('step3_section3_image');
                $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('images/steps/'.$image_name);
                $imageTemp = $_FILES["step3_section3_image"]["tmp_name"];
                $d = compressImage($imageTemp, $destinationPath, 70);
                $step->step3_section3_image = $image_name;
            }else{
                $step->step3_section3_image = $step->step3_section3_image;
            }

            $step->step3_section4_title = $request->step3_section4_title;
            $step->step3_section4_description = $request->step3_section4_description;
            if ($request->hasFile('step3_section4_image')) {
                $image = $request->file('step3_section4_image');
                $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('images/steps/'.$image_name);
                $imageTemp = $_FILES["step3_section4_image"]["tmp_name"];
                $d = compressImage($imageTemp, $destinationPath, 70);
                $step->step3_section4_image = $image_name;
            }else{
                $step->step3_section4_image = $step->step3_section4_image;
            }
            
            $step->step3_section5_title = $request->step3_section5_title;
            $step->step3_section5_description = $request->step3_section5_description;
            if ($request->hasFile('step3_section5_image')) {
                $image = $request->file('step3_section5_image');
                $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('images/steps/'.$image_name);
                $imageTemp = $_FILES["step3_section5_image"]["tmp_name"];
                $d = compressImage($imageTemp, $destinationPath, 70);
                $step->step3_section5_image = $image_name;
            }else{
                $step->step3_section5_image = $step->step3_section5_image;
            }
            
            $step->step3_section6_title = $request->step3_section6_title;
            $step->step3_section6_description = $request->step3_section6_description;
            $step->step3_section5_title = $request->step3_section5_title;
            $step->step3_section5_description = $request->step3_section5_description;
            if ($request->hasFile('step3_section6_image')) {
                $image = $request->file('step3_section6_image');
                $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('images/steps/'.$image_name);
                $imageTemp = $_FILES["step3_section6_image"]["tmp_name"];
                $d = compressImage($imageTemp, $destinationPath, 70);
                $step->step3_section6_image = $image_name;
            }else{
                $step->step3_section6_image = $step->step3_section6_image;
            }
            
            $step->step3_section7_title = $request->step3_section7_title;
            $step->step3_section7_description = $request->step3_section7_description;
            $step->step3_section8_title = $request->step3_section8_title;
            $step->step3_section8_description = $request->step3_section8_description;
            if ($request->hasFile('step3_section8_image')) {
                $image = $request->file('step3_section8_image');
                $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('images/steps/'.$image_name);
                $imageTemp = $_FILES["step3_section8_image"]["tmp_name"];
                $d = compressImage($imageTemp, $destinationPath, 70);
                $step->step3_section8_image = $image_name;
            }else{
                $step->step3_section8_image = $step->step3_section8_image;
            }

            $step->step3_section9_title = $request->step3_section9_title;
            $step->step3_section9_description = $request->step3_section9_description;
            if ($request->hasFile('step3_section9_image')) {
                $image = $request->file('step3_section9_image');
                $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('images/steps/'.$image_name);
                $imageTemp = $_FILES["step3_section9_image"]["tmp_name"];
                $d = compressImage($imageTemp, $destinationPath, 70);
                $step->step3_section9_image = $image_name;
            }else{
                $step->step3_section9_image = $step->step3_section9_image;
            }

            $step->step3_section10_title = $request->step3_section10_title;
            $step->step3_section10_description = $request->step3_section10_description;
            if ($request->hasFile('step3_section10_image')) {
                $image = $request->file('step3_section10_image');
                $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('images/steps/'.$image_name);
                $imageTemp = $_FILES["step3_section10_image"]["tmp_name"];
                $d = compressImage($imageTemp, $destinationPath, 70);
                $step->step3_section10_image = $image_name;
            }else{
                $step->step3_section10_image = $step->step3_section10_image;
            }

            $step->step3_section11_title = $request->step3_section11_title;
            $step->step3_section11_description = $request->step3_section11_description;
            if ($request->hasFile('step3_section11_image')) {
                $image = $request->file('step3_section11_image');
                $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('images/steps/'.$image_name);
                $imageTemp = $_FILES["step3_section11_image"]["tmp_name"];
                $d = compressImage($imageTemp, $destinationPath, 70);
                $step->step3_section11_image = $image_name;
            }else{
                $step->step3_section11_image = $step->step3_section11_image;
            }
        
        $step->save();
        return response()->json(['status' => '200', 'action' => $action]);
    }

    public function savestepfour(Request $request){
        
        $messages = [
            'step4_title.required' =>'Please provide a title',
            'step4_shotline.required' =>'Please provide a shot line',
            'step4_icon.required' =>'Please provide a icon',
            'step4_header_image.required' =>'Please provide a header image',
        ];

        if(isset($request->action) && $request->action=="update"){
            $validator = Validator::make($request->all(), [
                'step4_title' =>'required',
                'step4_shotline' =>'required',
            ], $messages);
        }else{
            $validator = Validator::make($request->all(), [
                'step4_title' =>'required',
                'step4_shotline' =>'required',
                //'step4_icon' =>'required',
                'step4_header_image' =>'required',
            ], $messages);

        }
         
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $action = "update";
        $step = Step::find($request->step_id);

        if(!$step){
            return response()->json(['status' => '400']);
        }

        $step->step4_title = $request->step4_title;
        $step->step4_shotline = $request->step4_shotline;
        // if ($request->hasFile('step4_icon')) {
        //     $image = $request->file('step4_icon');
        //     $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
        //     $destinationPath = public_path('images/steps/'.$image_name);
        //     $imageTemp = $_FILES["step4_icon"]["tmp_name"];
        //     $d = compressImage($imageTemp, $destinationPath, 70);
        //     $step->step4_icon = $image_name;
        // }else{
        //     $step->step4_icon = $step->step4_icon;
        // }

        if ($request->hasFile('step4_header_image')) {
            $image = $request->file('step4_header_image');
            $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/steps/'.$image_name);
            $imageTemp = $_FILES["step4_header_image"]["tmp_name"];
            $d = compressImage($imageTemp, $destinationPath, 70);
            $step->step4_header_image = $image_name;
        }else{
            $step->step4_header_image = $step->step4_header_image;
        }
        
        $step->step4_section1_title = $request->step4_section1_title;
        $step->step4_section1_description = $request->step4_section1_description;
        $step->step4_section2_title = $request->step4_section2_title;
        $step->step4_section2_description = $request->step4_section2_description;
        if ($request->hasFile('step4_section2_image')) {
            $image = $request->file('step4_section2_image');
            $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/steps/'.$image_name);
            $imageTemp = $_FILES["step4_section2_image"]["tmp_name"];
            $d = compressImage($imageTemp, $destinationPath, 70);
            $step->step4_section2_image = $image_name;
        }else{
            $step->step4_section2_image = $step->step4_section2_image;
        }
        
        $step->step4_section3_title = $request->step4_section3_title;
        $step->step4_section3_description = $request->step4_section3_description;
        if ($request->hasFile('step4_section3_image')) {
            $image = $request->file('step4_section3_image');
            $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/steps/'.$image_name);
            $imageTemp = $_FILES["step4_section3_image"]["tmp_name"];
            $d = compressImage($imageTemp, $destinationPath, 70);
            $step->step4_section3_image = $image_name;
        }else{
            $step->step4_section3_image = $step->step4_section3_image;
        }
        
        $step->step4_section4_title = $request->step4_section4_title;
        $step->step4_section4_description = $request->step4_section4_description;
        $step->step4_section5_title = $request->step4_section5_title;
        $step->step4_section5_description = $request->step4_section5_description;
        if ($request->hasFile('step4_section5_image')) {
            $image = $request->file('step4_section5_image');
            $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/steps/'.$image_name);
            $imageTemp = $_FILES["step4_section5_image"]["tmp_name"];
            $d = compressImage($imageTemp, $destinationPath, 70);
            $step->step4_section5_image = $image_name;
        }else{
            $step->step4_section5_image = $step->step4_section5_image;
        }

        $step->step4_section6_title = $request->step4_section6_title;
        $step->step4_section6_description = $request->step4_section6_description;
        $step->step4_section7_title = $request->step4_section7_title;
        $step->step4_section7_description = $request->step4_section7_description;
        $step->step4_section8_title = $request->step4_section8_title;
        $step->step4_section8_description = $request->step4_section8_description;
        $step->step4_section9_title = $request->step4_section9_title;
        $step->step4_section9_description = $request->step4_section9_description;
        if ($request->hasFile('step4_section9_image')) {
            $image = $request->file('step4_section9_image');
            $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/steps/'.$image_name);
            $imageTemp = $_FILES["step4_section9_image"]["tmp_name"];
            $d = compressImage($imageTemp, $destinationPath, 70);
            $step->step4_section9_image = $image_name;
        }else{
            $step->step4_section9_image = $step->step4_section9_image;
        }

        $step->step4_section10_title = $request->step4_section10_title;
        $step->step4_section10_description = $request->step4_section10_description;
        $step->step4_section11_title = $request->step4_section11_title;
        if ($request->hasFile('step4_section11_image1')) {
            $image = $request->file('step4_section11_image1');
            $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/steps/');
            // $imageTemp = $_FILES["step4_section11_image1"]["tmp_name"];
            // $d = compressImage($imageTemp, $destinationPath, 70);
            $image->move($destinationPath, $image_name);
            $step->step4_section11_image1 = $image_name;
        }else{
            $step->step4_section11_image1 = $step->step4_section11_image1;
        }
        
        $step->step4_section11_title1 = $request->step4_section11_title1;
        if ($request->hasFile('step4_section11_image2')) {
            $image = $request->file('step4_section11_image2');
            $image_name = 'Step_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/steps/');
            // $imageTemp = $_FILES["step4_section11_image2"]["tmp_name"];
            // $d = compressImage($imageTemp, $destinationPath, 70);
            $image->move($destinationPath, $image_name);
            $step->step4_section11_image2 = $image_name;
        }else{
            $step->step4_section11_image2 = $step->step4_section11_image2;
        }

        $step->step4_section11_title2 = $request->step4_section11_title2;
        
        $step->save();
        return response()->json(['status' => '200', 'action' => $action]);
    }

    public function changestepstatus($id){
        $step = Step::find($id);
        if ($step->estatus==1){
            $step->estatus = 2;
            $step->save();
            return response()->json(['status' => '200','action' =>'deactive']);
        }
        if ($step->estatus==2){
            $step->estatus = 1;
            $step->save();
            return response()->json(['status' => '200','action' =>'active']);
        }
    }

    public function deletestep($id){
        $step = Step::find($id);
        if ($step){
            $image = $step->main_image;
            $step->estatus = 3;
            $step->save();
            $step->delete();
            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '400']);
    }

    public function editstep($id){
        $action = "edit";
        //$steps = Step::where('estatus',1)->where('id',"!=",$id)->where('parent_category_id',"!=",$id)->get()->toArray();
        $step = Step::find($id);
        $category = Category::where('estatus',1)->get()->toArray();

        return view('admin.steps.list',compact('action','step','category'))->with('page',$this->page);
    }

    public function editstepone($id){
        $action = "stepone";
        $step = Step::find($id);
        return view('admin.steps.list',compact('action','step'))->with('page',$this->page);
    }

    public function editsteptwo($id){
        $action = "steptwo";
        $step = Step::find($id);
        return view('admin.steps.list',compact('action','step'))->with('page',$this->page);
    }

    public function editstepthree($id){
        $action = "stepthree";
        $step = Step::find($id);
        return view('admin.steps.list',compact('action','step'))->with('page',$this->page);
    }

    public function editstepfour($id){
        $action = "stepfour";
        $step = Step::find($id);
        return view('admin.steps.list',compact('action','step'))->with('page',$this->page);
    }

    public function uploadfile(Request $request){
        if(isset($request->action) && $request->action == 'uploadCatIcon'){
            if ($request->hasFile('files')) {
                $image = $request->file('files')[0];
                $image_name = 'blogThumb_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('images/blogThumb');
                $image->move($destinationPath, $image_name);
                return response()->json(['data' => 'images/blogThumb/'.$image_name]);
            }
        }
    }

    public function removefile(Request $request){
        if(isset($request->action) && $request->action == 'removeBlogIcon'){
            $image = $request->file;
            if(isset($image)) {
                $image = public_path($request->file);
                if (file_exists($image)) {
                    unlink($image);
                    return response()->json(['status' => '200']);
                }
            }
        }
    }
}
