<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ShopByStyle;
use App\Models\Attribute;
use App\Models\AttributeTerm;
use App\Models\ProjectPage;
use App\Models\Category;
use App\Models\Diamond;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopByStyleController extends Controller
{
    private $page = "Shop By Style";

    public function index(){
        $action = "list";
        $shopbystyle = ShopByStyle::where('estatus',1)->get();
        return view('admin.shopbystyle.list',compact('action','shopbystyle'))->with('page',$this->page);
    }

    public function create(){
        $action = "create";
        $shopbystyle = ShopByStyle::where('estatus',1)->get()->toArray();
        $attributes = Attribute::where('estatus',1)->where('is_specification',0)->get()->toArray();
        $categories = Category::where('estatus',1)->where('is_custom',1)->get()->toArray();
        $diamondshap = Diamond::groupBy('Shape')->pluck('Shape');
        return view('admin.shopbystyle.list',compact('action','shopbystyle','attributes','categories','diamondshap'))->with('page',$this->page);
    }

    public function save(Request $request){
        //dd($request->all());
        $messages = [
            'title.required' =>'Please provide a Category Name',
            'catImg.required' =>'Please provide a Category Image',
        ];

        if(isset($request->action) && $request->action=="update"){
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'catImg' => 'required',
                //'attribute_id_variation' => 'required',
                //'attribute_id_variation_term' => 'required',
            ], $messages);
        }
        else{
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'catImg' => 'required',
                //'attribute_id_variation' => 'required',
                //'attribute_id_variation_term' => 'required',
            ], $messages);
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        if (isset($request->action) && $request->action=="update"){
            $action = "update";
            $shopby = ShopByStyle::find($request->shopbystyle_id);

            if(!$shopby){
                return response()->json(['status' => '400']);
            }

            if ($shopby->image != $request->catImg){
                if(isset($shopby->image)) {
                    $image = public_path($shopby->image);
                    if (file_exists($image)) {
                        unlink($image);
                    }
                }
                $shopby->image = $request->catImg;
            }
            //$shopby->category_id = $request->category_id;
            $shopby->title = $request->title;
            $shopby->setting = $request->setting;
            // $shopby->setting = $request->setting;
            // if (isset($request->attribute_id_variation) && !empty($request->attribute_id_variation)){
            //     $shopby->attributes = $request->attribute_id_variation;
            // }else{
            //     $shopby->attributes = null;
            // }

            // if (isset($request->attribute_id_variation_term) && !empty($request->attribute_id_variation_term)){
            //     $shopby->attribute_terms = $request->attribute_id_variation_term;
            // }else{
            //     $shopby->attribute_terms = null;
            // }
    
        }
        else{
            $action = "add";
            $shopby = new ShopByStyle();
            //$shopby->category_id = $request->category_id;
            $shopby->title = $request->title;
            $shopby->setting = $request->setting;
            $shopby->created_at = new \DateTime(null, new \DateTimeZone('Asia/Kolkata'));
            $shopby->image = $request->catImg;
         
            // if (isset($request->attribute_id_variation) && !empty($request->attribute_id_variation)){
            //     $shopby->attributes = $request->attribute_id_variation;
            // }else{
            //     $shopby->attributes = null;
            // }

            // if (isset($request->attribute_id_variation_term) && !empty($request->attribute_id_variation_term)){
            //     $shopby->attribute_terms = $request->attribute_id_variation_term;
            // }else{
            //     $shopby->attribute_terms = null;
            // }
        }

        $shopby->save();

        return response()->json(['status' => '200', 'action' => $action]);
    }

    public function allshopbystylelist(Request $request){
        if ($request->ajax()) {
            $columns = array(
                0 =>'sr_no',
                1 =>'image',
                2 => 'title',
                3 => 'estatus',
                4 => 'created_at',
                5 => 'action',
            );
            $totalData = ShopByStyle::count();
            
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
                $shopbystyle = ShopByStyle::offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
            }
            else {
                $search = $request->input('search.value');
                $shopbystyle =  ShopByStyle::where('sr_no','LIKE',"%{$search}%")
                    ->orWhere('title', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
                    
                $totalFiltered = ShopByStyle::where('sr_no','LIKE',"%{$search}%")
                    ->orWhere('title', 'LIKE',"%{$search}%")
                    ->count();
            }

            $data = array();

            if(!empty($shopbystyle))
            {
                foreach ($shopbystyle as $shopby)
                {
                    $page_id = ProjectPage::where('route_url','admin.shopbystyle.list')->pluck('id')->first();

                    if( $shopby->estatus==1 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="ShopByStyleStatuscheck_'. $shopby->id .'" onchange="chageShopByStyleStatus('. $shopby->id .')" value="1" checked="checked"><span class="slider round"></span></label>';
                    }
                    elseif ($shopby->estatus==1){
                        $estatus = '<label class="switch"><input type="checkbox" id="ShopByStyleStatuscheck_'. $shopby->id .'" value="1" checked="checked"><span class="slider round"></span></label>';
                    }

                    if( $shopby->estatus==2 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="ShopByStyleStatuscheck_'. $shopby->id .'" onchange="chageShopByStyleStatus('. $shopby->id .')" value="2"><span class="slider round"></span></label>';
                    }
                    elseif ($shopby->estatus==2){
                        $estatus = '<label class="switch"><input type="checkbox" id="ShopByStyleStatuscheck_'. $shopby->id .'" value="2"><span class="slider round"></span></label>';
                    }

                    if(isset($shopby->image) && $shopby->image!=null){
                        $thumb_path = url($shopby->image);
                    }

                    $action='';
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
                        $action .= '<button id="editShopByStyleBtn" class="btn btn-gray text-blue btn-sm" data-id="' .$shopby->id. '"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                    }
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_delete($page_id)) ){
                        $action .= '<button id="deleteShopByStyleBtn" class="btn btn-gray text-danger btn-sm" data-toggle="modal" data-target="#DeleteShopByStyleModal" onclick="" data-id="' .$shopby->id. '"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }
                    $nestedData['image'] = '<img src="'. $thumb_path .'" width="50px" height="50px" alt="Thumbnail">';
                    $nestedData['title'] = $shopby->title;
                    $nestedData['estatus'] = $estatus;
                    $nestedData['created_at'] = date('d-m-Y h:i A', strtotime($shopby->created_at));
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

    public function changeshopbystylestatus($id){
        $shopby = ShopByStyle::find($id);
        if ($shopby->estatus==1){
            $shopby->estatus = 2;
            $shopby->save();
            return response()->json(['status' => '200','action' =>'deactive']);
        }
        if ($shopby->estatus==2){
            $shopby->estatus = 1;
            $shopby->save();
            return response()->json(['status' => '200','action' =>'active']);
        }
    }

    public function deleteshopbystyle($id){
        $shopby = ShopByStyle::find($id);
        if ($shopby){
            $image = $shopby->image;
            $shopby->estatus = 3;
            $shopby->save();

            $shopby->delete();
            $image = public_path($image);
            if (file_exists($image)) {
                unlink($image);
            }
            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '400']);
    }

    public function editshopbystyle($id){
        $action = "edit";
        $shopby = ShopByStyle::find($id);
        $attributes = Attribute::where('estatus',1)->where('is_specification',0)->get()->toArray();
        $attributes_term = AttributeTerm::where('estatus',1)->where('attribute_id',$shopby->attributes)->get()->toArray();
        $categories = Category::where('estatus',1)->where('is_custom',1)->get()->toArray();
        $diamondshap = Diamond::groupBy('Shape')->pluck('Shape');
        return view('admin.shopbystyle.list',compact('action','shopby','attributes','attributes_term','categories','diamondshap'))->with('page',$this->page);
    }

    public function uploadfile(Request $request){
        if(isset($request->action) && $request->action == 'uploadCatIcon'){
            if ($request->hasFile('files')) {
                $image = $request->file('files')[0];
                $image_name = 'ShopByStyleThumb_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('images/shopbystyleThumb');
                $image->move($destinationPath, $image_name);
                return response()->json(['data' => 'images/shopbystyleThumb/'.$image_name]);
            }
        }
    }

    public function removefile(Request $request){
        if(isset($request->action) && $request->action == 'removeCatIcon'){
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

    public function loadterm(Request $request,$id)
    {
        $parent_id = $id;
        $term = AttributeTerm::where('attribute_id',$parent_id)->where('estatus',1)->get();
        return response()->json([
            'term' => $term
        ]);
    }
}
