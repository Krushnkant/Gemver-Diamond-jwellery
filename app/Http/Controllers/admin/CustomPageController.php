<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CustomPage;
use App\Models\ProjectPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomPageController extends Controller
{
    private $page = "Custom Page";

    public function index(){
        $action = "list";
        $custompage = CustomPage::where('estatus',1)->get();
        return view('admin.custompage.list',compact('action','custompage'))->with('page',$this->page);
    }

    public function create(){
        $action = "create";
        $custompages = CustomPage::where('estatus',1)->get()->toArray();
        return view('admin.custompage.list',compact('action','custompages'))->with('page',$this->page);
    }

    public function addorupdatecustompage(Request $request){
        $messages = [
            'title.required' =>'Please provide a Title',
            'description.required' =>'Please provide a Description',
            'slug.required' =>'Please provide a Slug',
        ];
       

        if(isset($request->action) && $request->action=="update"){
            $validator = Validator::make($request->all(), [
                'title' =>'required',
                'description' =>'required',
                'slug' =>'required',
            ], $messages);
        }
        else{
            $validator = Validator::make($request->all(), [
                'title' =>'required',
                'description' =>'required',
                'slug' =>'required',
            ], $messages);
        }
            
       
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }
        if (isset($request->action) && $request->action=="update"){
            $action = "update";
            $custompage = CustomPage::find($request->custompage_id);

            if(!$custompage){
                return response()->json(['status' => '400']);
            }

            $custompage->title = $request->title;
            $custompage->slug = $request->slug;
            $custompage->content = $request->description;
            $custompage->meta_title = $request->meta_title;
            $custompage->meta_description = $request->meta_description;
            
        }
        else{
            $action = "add";
            $custompage = new CustomPage();
            $custompage->title = $request->title;
            $custompage->slug = $request->slug;
            $custompage->content = $request->description;
            $custompage->meta_title = $request->meta_title;
            $custompage->meta_description = $request->meta_description;
            
        }
        $custompage->save();
        return response()->json(['status' => '200', 'action' => $action]);
    }

    public function allcustompagelist(Request $request){
     
        if ($request->ajax()) {
            $columns = array(
                0 =>'sr_no',
                1 => 'title',
                2 => 'estatus',
                3 => 'created_at',
                4 => 'action',
            );
            $totalData = CustomPage::count();
            
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
                $custompages = CustomPage::offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
              
            }
            else {
                $search = $request->input('search.value');
                $custompages =  CustomPage::Where('title', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
                $totalFiltered = CustomPage::Where('title', 'LIKE',"%{$search}%")
                    ->count();
            }

            $data = array();
             
            if(!empty($custompages))
            {
                foreach ($custompages as $custompage)
                {
                    $page_id = ProjectPage::where('route_url','admin.custompages.list')->pluck('id')->first();

                    if( $custompage->estatus==1 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="custompageStatuscheck_'. $custompage->id .'" onchange="chagecustompageStatus('. $custompage->id .')" value="1" checked="checked"><span class="slider round"></span></label>';
                    }
                    elseif ($custompage->estatus==1){
                        $estatus = '<label class="switch"><input type="checkbox" id="custompageStatuscheck_'. $custompage->id .'" value="1" checked="checked"><span class="slider round"></span></label>';
                    }

                    if( $custompage->estatus==2 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="custompageStatuscheck_'. $custompage->id .'" onchange="chagecustompageStatus('. $custompage->id .')" value="2"><span class="slider round"></span></label>';
                    }
                    elseif ($custompage->estatus==2){
                        $estatus = '<label class="switch"><input type="checkbox" id="custompageStatuscheck_'. $custompage->id .'" value="2"><span class="slider round"></span></label>';
                    }

                    if($custompage->estatus==5){
                        $estatus = 'Draf';
                    }

                   

                    $action='';
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
                        $action .= '<button id="editcustompageBtn" class="btn btn-gray text-blue btn-sm" data-id="' .$custompage->id. '"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                    }
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_delete($page_id)) ){
                        $action .= '<button id="deletecustompageBtn" class="btn btn-gray text-danger btn-sm" data-toggle="modal" data-target="#DeletecustompageModal" onclick="" data-id="' .$custompage->id. '"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }
                    
                    $nestedData['title'] = $custompage->title;
                    $nestedData['estatus'] = $estatus;
                    $nestedData['created_at'] = date('d-m-Y h:i A', strtotime($custompage->created_at));
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

    public function chagecustompagestatus($id){
        $custompage = CustomPage::find($id);
        if ($custompage->estatus==1){
            $custompage->estatus = 2;
            $custompage->save();
            return response()->json(['status' => '200','action' =>'deactive']);
        }
        if ($custompage->estatus==2){
            $custompage->estatus = 1;
            $custompage->save();
            return response()->json(['status' => '200','action' =>'active']);
        }
    }

    public function deletecustompage($id){
        $custompage = CustomPage::find($id);
        if ($custompage){
            $image = $custompage->custompage_thumb;
            $custompage->estatus = 3;
            $custompage->save();

            $custompage->delete();
            // $image = public_path($image);
            // if (file_exists($image)) {
            //     unlink($image);
            // }
            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '400']);
    }

    public function editcustompage($id){
        $action = "edit";
        //$custompages = CustomPage::where('estatus',1)->where('id',"!=",$id)->where('parent_category_id',"!=",$id)->get()->toArray();
        $custompage = CustomPage::find($id);

        return view('admin.custompage.list',compact('action','custompage'))->with('page',$this->page);
    }

    public function uploadfile(Request $request){
        if(isset($request->action) && $request->action == 'uploadCatIcon'){
            if ($request->hasFile('files')) {
                $image = $request->file('files')[0];
                $image_name = 'custompageThumb_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
                // $destinationPath = public_path('images/custompageThumb');
                // $image->move($destinationPath, $image_name);
                $destinationPath = public_path('images/custompageThumb/'.$image_name);
                $imageTemp = $_FILES["files"]["tmp_name"];
                
                if($_FILES["files"]["size"] > 500000){
                    compressImage($imageTemp, $destinationPath, 90);
                }else{
                    $destinationPath = public_path('images/custompageThumb');
                    $image->move($destinationPath, $image_name);  
                }
                
                return response()->json(['data' => 'images/custompageThumb/'.$image_name]);
            }
        }
    }

    public function removefile(Request $request){
        if(isset($request->action) && $request->action == 'removecustompageIcon'){
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

    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('images'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/'.$fileName); 
            $msg = 'Image successfully uploaded'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }

    public function createSlug($title, $id = 0)
    {
        $slug = str_slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);
    }
    protected function getRelatedSlugs($slug, $id = 0)
    {
        return CustomPage::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }
}
