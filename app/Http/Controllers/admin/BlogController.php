<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\ProjectPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    private $page = "Blog";

    public function index(){
        $action = "list";
        $blogs = Blog::where('estatus',1)->get();
        return view('admin.blogs.list',compact('action','blogs'))->with('page',$this->page);
    }

    public function create(){
        $action = "create";

        $blogs = Blog::where('estatus',1)->get()->toArray();
        $blogcategory = BlogCategory::where('estatus',1)->get()->toArray();
        
        return view('admin.blogs.list',compact('action','blogs','blogcategory'))->with('page',$this->page);
    }

    public function save(Request $request){
        $messages = [
            'title.required' =>'Please provide a Title',
            'catImg.required' =>'Please provide a Blog Image',
            'category_id.required' =>'Please Select Category',
            'description.required' =>'Please provide a Description',
        ];

        if(isset($request->action) && $request->action=="update"){
            $validator = Validator::make($request->all(), [
                'title' =>'required',
                'catImg' =>'required',
                'category_id' =>'required',
                'description' =>'required',
            ], $messages);
        }
        else{
            $validator = Validator::make($request->all(), [
                'title' =>'required',
                'catImg' =>'required',
                'category_id' =>'required',
                'description' =>'required',
            ], $messages);
        }
         
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        if (isset($request->action) && $request->action=="update"){
            $action = "update";
            $blog = Blog::find($request->blog_id);

            if(!$blog){
                return response()->json(['status' => '400']);
            }

            if ($blog->blog_thumb != $request->catImg){
                if(isset($blog->blog_thumb)) {
                    $image = public_path($blog->blog_thumb);
                    if (file_exists($image)) {
                        unlink($image);
                    }
                }
                $blog->blog_thumb = $request->catImg;
            }

            $blog->title = $request->title;
            $blog->description = $request->description;
            $blog->category_id = $request->category_id;
            $blog->meta_title = $request->meta_title;
            $blog->meta_description = $request->meta_description;
        }
        else{
            $action = "add";
            $blog = new Blog();
            $blog->title = $request->title;
            $blog->created_at = new \DateTime(null, new \DateTimeZone('Asia/Kolkata'));
            $blog->blog_thumb = $request->catImg;
            $blog->description = $request->description;
            $blog->category_id = $request->category_id;
            $blog->meta_title = $request->meta_title;
            $blog->meta_description = $request->meta_description;
        }
        $blog->save();
        return response()->json(['status' => '200', 'action' => $action]);
    }

    public function allbloglist(Request $request){
        if ($request->ajax()) {
            $columns = array(
                0 =>'sr_no',
                1 =>'blog_thumb',
                2 => 'title',
                3 => 'estatus',
                4 => 'created_at',
                5 => 'action',
            );
            $totalData = Blog::count();
            
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
                $blogs = Blog::offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
              
            }
            else {
                $search = $request->input('search.value');
                $blogs =  Blog::Where('title', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
                $totalFiltered = Blog::Where('title', 'LIKE',"%{$search}%")
                    ->count();
            }

            $data = array();

            if(!empty($blogs))
            {
                foreach ($blogs as $blog)
                {
                    $page_id = ProjectPage::where('route_url','admin.blogs.list')->pluck('id')->first();

                    if( $blog->estatus==1 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="BlogStatuscheck_'. $blog->id .'" onchange="chageBlogStatus('. $blog->id .')" value="1" checked="checked"><span class="slider round"></span></label>';
                    }
                    elseif ($blog->estatus==1){
                        $estatus = '<label class="switch"><input type="checkbox" id="BlogStatuscheck_'. $blog->id .'" value="1" checked="checked"><span class="slider round"></span></label>';
                    }

                    if( $blog->estatus==2 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="BlogStatuscheck_'. $blog->id .'" onchange="chageBlogStatus('. $blog->id .')" value="2"><span class="slider round"></span></label>';
                    }
                    elseif ($blog->estatus==2){
                        $estatus = '<label class="switch"><input type="checkbox" id="BlogStatuscheck_'. $blog->id .'" value="2"><span class="slider round"></span></label>';
                    }

                    if(isset($blog->blog_thumb) && $blog->blog_thumb!=null){
                        $thumb_path = url($blog->blog_thumb);
                    }

                    $action='';
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
                        $action .= '<button id="editBlogBtn" class="btn btn-gray text-blue btn-sm" data-id="' .$blog->id. '"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                    }
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_delete($page_id)) ){
                        $action .= '<button id="deleteBlogBtn" class="btn btn-gray text-danger btn-sm" data-toggle="modal" data-target="#DeleteBlogModal" onclick="" data-id="' .$blog->id. '"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }
                    $nestedData['blog_thumb'] = '<img src="'. $thumb_path .'" width="50px" height="50px" alt="Thumbnail">';
                    $nestedData['title'] = $blog->title;
                    $nestedData['estatus'] = $estatus;
                    $nestedData['created_at'] = date('d-m-Y h:i A', strtotime($blog->created_at));
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

    public function changeblogstatus($id){
        $blog = Blog::find($id);
        if ($blog->estatus==1){
            $blog->estatus = 2;
            $blog->save();
            return response()->json(['status' => '200','action' =>'deactive']);
        }
        if ($blog->estatus==2){
            $blog->estatus = 1;
            $blog->save();
            return response()->json(['status' => '200','action' =>'active']);
        }
    }

    public function deleteblog($id){
        $blog = Blog::find($id);
        if ($blog){
            $image = $blog->blog_thumb;
            $blog->estatus = 3;
            $blog->save();

            $blog->delete();
            $image = public_path($image);
            if (file_exists($image)) {
                unlink($image);
            }
            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '400']);
    }

    public function editblog($id){
        $action = "edit";
        //$blogs = Blog::where('estatus',1)->where('id',"!=",$id)->where('parent_category_id',"!=",$id)->get()->toArray();
        $blog = Blog::find($id);
        $blogcategory = BlogCategory::where('estatus',1)->get()->toArray();

        return view('admin.blogs.list',compact('action','blog','blogcategory'))->with('page',$this->page);
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
}
