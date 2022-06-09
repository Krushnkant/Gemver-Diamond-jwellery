<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\ProjectPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    private $page = "Banner";

    public function index(){
        $action = "list";
        $banners = Banner::where('estatus',1)->get();
        return view('admin.banners.list',compact('action','banners'))->with('page',$this->page);
    }

    public function create(){
        $action = "create";
        $banners = Banner::where('estatus',1)->get()->toArray();
        $categories = Category::where('estatus',1)->get()->toArray();
        return view('admin.banners.list',compact('action','banners','categories'))->with('page',$this->page);
    }

    public function save(Request $request){
        $messages = [
            'title.required' =>'Please provide a Title ',
            'catImg.required' =>'Please provide a banner Image',
            'description.required' =>'Please provide a Description',
        ];
        
        if(isset($request->action) && $request->action=="update"){
            $validator = Validator::make($request->all(), [
                'title' =>'required',
                'catImg' =>'required',
                'description' =>'required',
            ], $messages);
        }
        else{
       
            $validator = Validator::make($request->all(), [
                'title' =>'required',
                'catImg' =>'required',
                'description' =>'required',
            ], $messages);
        }


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        if (isset($request->action) && $request->action=="update"){
            $action = "update";
            $banner = Banner::find($request->banner_id);

            if(!$banner){
                return response()->json(['status' => '400']);
            }

            if ($banner->banner_thumb != $request->catImg){
                if(isset($banner->banner_thumb)) {
                    $image = public_path($banner->banner_thumb);
                    if (file_exists($image)) {
                        unlink($image);
                    }
                }
                $banner->banner_thumb = $request->catImg;
            }
            $banner->title = $request->title;
            $banner->description = $request->description;
            $banner->button_name = $request->button_name;
            $banner->button_url = $request->button_url;
           
        }
        else{
            $action = "add";
            $banner = new Banner();
            $banner->title = $request->title;
            $banner->created_at = new \DateTime(null, new \DateTimeZone('Asia/Kolkata'));
            $banner->banner_thumb = $request->catImg;
            $banner->description = $request->description;
            $banner->button_name = $request->button_name;
            $banner->button_url = $request->button_url;
        }
        $banner->save();
        return response()->json(['status' => '200', 'action' => $action]);
    }

    public function allbannerlist(Request $request){
        if ($request->ajax()) {
            $columns = array(
                0 =>'sr_no',
                1 =>'blog_thumb',
                2 => 'title',
                3 => 'description',
                4 => 'estatus',
                5 => 'created_at',
                6 => 'action',
            );
            $totalData = Banner::count();
            
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
                $banners = Banner::offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
              
            }
            else {
                $search = $request->input('search.value');
                $banners =  Banner::Where('title', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
                $totalFiltered = Banner::Where('title', 'LIKE',"%{$search}%")
                    ->count();
            }

            $data = array();

            if(!empty($banners))
            {
                foreach ($banners as $banner)
                {
                    $page_id = ProjectPage::where('route_url','admin.banners.list')->pluck('id')->first();

                    if( $banner->estatus==1 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="bannerstatuscheck_'. $banner->id .'" onchange="chagebannerstatus('. $banner->id .')" value="1" checked="checked"><span class="slider round"></span></label>';
                    }
                    elseif ($banner->estatus==1){
                        $estatus = '<label class="switch"><input type="checkbox" id="bannerstatuscheck_'. $banner->id .'" value="1" checked="checked"><span class="slider round"></span></label>';
                    }

                    if( $banner->estatus==2 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="bannerstatuscheck_'. $banner->id .'" onchange="chagebannerstatus('. $banner->id .')" value="2"><span class="slider round"></span></label>';
                    }
                    elseif ($banner->estatus==2){
                        $estatus = '<label class="switch"><input type="checkbox" id="bannerstatuscheck_'. $banner->id .'" value="2"><span class="slider round"></span></label>';
                    }

                    if(isset($banner->banner_thumb) && $banner->banner_thumb!=null){
                        $thumb_path = url($banner->banner_thumb);
                    }

                    $action='';
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
                        $action .= '<button id="editBannerBtn" class="btn btn-gray text-blue btn-sm" data-id="' .$banner->id. '"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                    }
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_delete($page_id)) ){
                        $action .= '<button id="deleteBannerBtn" class="btn btn-gray text-danger btn-sm" data-toggle="modal" data-target="#DeleteBannerModal" onclick="" data-id="' .$banner->id. '"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }
                    $nestedData['banner_thumb'] = '<img src="'. $thumb_path .'" width="50px" height="50px" alt="Thumbnail">';
                    $nestedData['title'] = $banner->title;
                    $nestedData['description'] = $banner->description;
                    $nestedData['estatus'] = $estatus;
                    $nestedData['created_at'] = date('d-m-Y h:i A', strtotime($banner->created_at));
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

    public function changebannerstatus($id){
        $banner = Banner::find($id);
        if ($banner->estatus==1){
            $banner->estatus = 2;
            $banner->save();
            return response()->json(['status' => '200','action' =>'deactive']);
        }
        if ($banner->estatus==2){
            $banner->estatus = 1;
            $banner->save();
            return response()->json(['status' => '200','action' =>'active']);
        }
    }

    public function deletebanner($id){
        $banner = Banner::find($id);
        if ($banner){
            $image = $banner->banner_thumb;
            $banner->estatus = 3;
            $banner->save();

            $banner->delete();
            $image = public_path($image);
            if (file_exists($image)) {
                unlink($image);
            }
            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '400']);
    }

    public function editbanner($id){
        $action = "edit";
        $banner = Banner::find($id);
        $categories = Category::where('estatus',1)->get()->toArray();
        return view('admin.banners.list',compact('action','banner','categories'))->with('page',$this->page);
    }

    public function uploadfile(Request $request){
        if(isset($request->action) && $request->action == 'uploadCatIcon'){
            if ($request->hasFile('files')) {
                $image = $request->file('files')[0];
                $image_name = 'bannerThumb_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('images/bannerThumb');
                $image->move($destinationPath, $image_name);
                return response()->json(['data' => 'images/bannerThumb/'.$image_name]);
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
