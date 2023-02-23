<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SocialFeed;
use App\Models\ProjectPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SocialFeedController extends Controller
{
    private $page = "Social Feed";

    public function index(){
        $action = "list";
        $socialfeeds = SocialFeed::where('estatus',1)->get();
        return view('admin.socialfeeds.list',compact('action','socialfeeds'))->with('page',$this->page);
    }

    public function create(){
        $action = "create";

        $socialfeeds = SocialFeed::where('estatus',1)->get()->toArray();
        
        return view('admin.socialfeeds.list',compact('action','socialfeeds'))->with('page',$this->page);
    }

    public function save(Request $request){
        $messages = [
            'title.required' =>'Please provide a Title',
            'catImg.required' =>'Please provide a socialfeed Image',
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
            $socialfeed = SocialFeed::find($request->socialfeed_id);

            if(!$socialfeed){
                return response()->json(['status' => '400']);
            }

            if ($socialfeed->blog_thumb != $request->catImg){
                if(isset($socialfeed->blog_thumb)) {
                    $image = public_path($socialfeed->blog_thumb);
                    if (file_exists($image)) {
                        unlink($image);
                    }
                }
                $socialfeed->blog_thumb = $request->catImg;
            }

            $socialfeed->title = $request->title;
            $socialfeed->sub_title = $request->sub_title;
            $socialfeed->slug = $request->slug;
            $socialfeed->description = $request->description;
            $socialfeed->meta_title = $request->meta_title;
            $socialfeed->meta_description = $request->meta_description;
          
        }
        else{
            $action = "add";
            $socialfeed = new SocialFeed();
            $socialfeed->title = $request->title;
            
            $socialfeed->sub_title = $request->sub_title;
            $socialfeed->slug = $request->slug;
            $socialfeed->blog_thumb = $request->catImg;
            $socialfeed->description = $request->description;
            $socialfeed->meta_title = $request->meta_title;
            $socialfeed->meta_description = $request->meta_description;
           
        }
        $socialfeed->save();
        return response()->json(['status' => '200', 'action' => $action]);
    }

    public function allsocialfeedlist(Request $request){
        if ($request->ajax()) {
            $columns = array(
                0 =>'sr_no',
                1 =>'blog_thumb',
                2 => 'title',
                3 => 'estatus',
                4 => 'created_at',
                5 => 'action',
            );
            $totalData = SocialFeed::count();
            
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
                $socialfeeds = SocialFeed::offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
              
            }
            else {
                $search = $request->input('search.value');
                $socialfeeds =  SocialFeed::Where('title', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
                $totalFiltered = SocialFeed::Where('title', 'LIKE',"%{$search}%")
                    ->count();
            }

            $data = array();

            if(!empty($socialfeeds))
            {
                foreach ($socialfeeds as $socialfeed)
                {
                    $page_id = ProjectPage::where('route_url','admin.socialfeeds.list')->pluck('id')->first();

                    if( $socialfeed->estatus==1 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="socialfeedStatuscheck_'. $socialfeed->id .'" onchange="chagesocialfeedStatus('. $socialfeed->id .')" value="1" checked="checked"><span class="slider round"></span></label>';
                    }
                    elseif ($socialfeed->estatus==1){
                        $estatus = '<label class="switch"><input type="checkbox" id="socialfeedStatuscheck_'. $socialfeed->id .'" value="1" checked="checked"><span class="slider round"></span></label>';
                    }

                    if( $socialfeed->estatus==2 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="socialfeedStatuscheck_'. $socialfeed->id .'" onchange="chagesocialfeedStatus('. $socialfeed->id .')" value="2"><span class="slider round"></span></label>';
                    }
                    elseif ($socialfeed->estatus==2){
                        $estatus = '<label class="switch"><input type="checkbox" id="socialfeedStatuscheck_'. $socialfeed->id .'" value="2"><span class="slider round"></span></label>';
                    }

                    if($socialfeed->estatus==5){
                        $estatus = 'Draf';
                    }

                    if(isset($socialfeed->blog_thumb) && $socialfeed->blog_thumb!=null){
                        $thumb_path = url($socialfeed->blog_thumb);
                    }else{
                        $thumb_path = url('images/placeholder_image.png'); 
                    }

                    $action='';
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
                        $action .= '<button id="editsocialfeedBtn" class="btn btn-gray text-blue btn-sm" data-id="' .$socialfeed->id. '"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                    }
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_delete($page_id)) ){
                        $action .= '<button id="deletesocialfeedBtn" class="btn btn-gray text-danger btn-sm" data-toggle="modal" data-target="#DeletesocialfeedModal" onclick="" data-id="' .$socialfeed->id. '"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }
                    
                    $nestedData['blog_thumb'] = '<img src="'. $thumb_path .'" width="50px" height="50px" alt="Thumbnail">';
                    $nestedData['title'] = $socialfeed->title;
                    $nestedData['estatus'] = $estatus;
                    $nestedData['created_at'] = date('d-m-Y h:i A', strtotime($socialfeed->created_at));
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

    public function changesocialfeedstatus($id){
        $socialfeed = SocialFeed::find($id);
        if ($socialfeed->estatus==1){
            $socialfeed->estatus = 2;
            $socialfeed->save();
            return response()->json(['status' => '200','action' =>'deactive']);
        }
        if ($socialfeed->estatus==2){
            $socialfeed->estatus = 1;
            $socialfeed->save();
            return response()->json(['status' => '200','action' =>'active']);
        }
    }

    public function deletesocialfeed($id){
        $socialfeed = SocialFeed::find($id);
        if ($socialfeed){
            $image = $socialfeed->blog_thumb;
            $socialfeed->estatus = 3;
            $socialfeed->save();

            $socialfeed->delete();
            $image = public_path($image);
            if (file_exists($image)) {
                unlink($image);
            }
            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '400']);
    }

    public function editsocialfeed($id){
        $action = "edit";
        //$socialfeeds = SocialFeed::where('estatus',1)->where('id',"!=",$id)->where('parent_category_id',"!=",$id)->get()->toArray();
        $socialfeed = SocialFeed::find($id);

        return view('admin.socialfeeds.list',compact('action','socialfeed'))->with('page',$this->page);
    }

    public function uploadfile(Request $request){
        if(isset($request->action) && $request->action == 'uploadCatIcon'){
            if ($request->hasFile('files')) {
                $image = $request->file('files')[0];
                $image_name = 'socialfeedThumb_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
                // $destinationPath = public_path('images/socialfeedThumb');
                // $image->move($destinationPath, $image_name);
                $destinationPath = public_path('images/socialfeedThumb/'.$image_name);
                $imageTemp = $_FILES["files"]["tmp_name"];
                
                if($_FILES["files"]["size"] > 500000){
                    compressImage($imageTemp, $destinationPath, 90);
                }else{
                    $destinationPath = public_path('images/socialfeedThumb');
                    $image->move($destinationPath, $image_name);  
                }
                
                return response()->json(['data' => 'images/socialfeedThumb/'.$image_name]);
            }
        }
    }

    public function removefile(Request $request){
        if(isset($request->action) && $request->action == 'removesocialfeedIcon'){
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
        return SocialFeed::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }
}
