<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\OrderIncludes;
use App\Models\OrderIncludesData;
use App\Models\ProjectPage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers;
use Illuminate\Support\Str;

class OrderIncludesController extends Controller
{
    private $page = "Order Includes";

    public function index(){
        $action = "list";
        $orderincludes = OrderIncludes::where('estatus',1)->get();
        return view('admin.order_includes.list',compact('action','orderincludes'))->with('page',$this->page);
    }

    public function create(){
        $action = "create";
        $orderincludes = OrderIncludes::with('orderincludesdata')->where('estatus',1)->first();
        return view('admin.order_includes.list',compact('action','orderincludes'))->with('page',$this->page);
    }

    public function save(Request $request){
        //dd($request->all());
        $messages = [
            'title.required' =>'Please provide a title',
            // 'catImg.required' =>'Please provide a Category Image',
        ];

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            // 'catImg' => 'required',
            
        ], $messages);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $neworderids = $request->orderdataid;

        $order = OrderIncludes::find($request->orderincludes_id);

        $orderdataidold = OrderIncludesData::where('order_id',1)->get()->pluck('id');

        if(!$order){
            return response()->json(['status' => '400']);
        }

        // if ($order->image != $request->catImg){
        //     if(isset($order->image)) {
        //         $image = public_path($order->image);
        //         if (file_exists($image)) {
        //             unlink($image);
        //         }
        //     }
        //     $order->image = $request->catImg;
        // }
        $order->title = $request->title;
        $order->description = $request->description;
        $order->save();
         
        if($order){
            if (isset($request->subtitle) && !empty($request->subtitle)){
                foreach($request->subtitle as $key => $subtitle){
                    if($subtitle != ""){
                        $orderdata = new OrderIncludesData();
                        $orderdata->order_id = $order->id;
                        $orderdata->title = $subtitle;
                        $orderdata->description = $request->$subdescription[$key];
                        $path = public_path("images/order_image/");
                        if(isset($request->image[$key]) && $request->image[$key] != ""){
                            $result = Helpers::UploadImage($request->image[$key], $path);
                            $orderdata->image = $result;
                        }
                        $orderdata->save();
                        
                        //array_push($neworderids,$orderdata->id);
                    } 
                    
                }
            }

            if (isset($request->subtitleold) && !empty($request->subtitleold)){
                foreach($request->subtitleold as $key => $subtitleold){
                    
                    if($subtitleold != ""){
                    $orderdataold = OrderIncludesData::find($request->orderdataid[$key]);
                    $orderdataold->title = $subtitleold;
                    $orderdataold->description = $request->subdescriptionold[$key];
                    $path = public_path("images/order_image/");
                    if(isset($request->imageold[$key]) && $request->imageold[$key] != ""){
                        //dd($request->imageold[$key]);
                         $result = Helpers::UploadImage($request->imageold[$key], $path);
                         $orderdataold->image = $result;
                    }
                    
                    $orderdataold->save();
                    }
                }
            }

            foreach($orderdataidold as $orderdataids){
                if(!in_array($orderdataids,$neworderids)){
                     OrderIncludesData::where('id',$orderdataids)->delete();  
                }
            }


        }

        return response()->json(['status' => '200']);
    }

    public function allorderinludeslist(Request $request){
        if ($request->ajax()) {
            $columns = array(
                0 =>'sr_no',
                1 =>'image',
                2 => 'title',
                3 => 'estatus',
                4 => 'created_at',
                5 => 'action',
            );
            $totalData = OrderIncludes::count();
            
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
                $shopbystyle = OrderIncludes::offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
            }
            else {
                $search = $request->input('search.value');
                $shopbystyle =  OrderIncludes::where('sr_no','LIKE',"%{$search}%")
                    ->orWhere('title', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
                    
                $totalFiltered = OrderIncludes::where('sr_no','LIKE',"%{$search}%")
                    ->orWhere('title', 'LIKE',"%{$search}%")
                    ->count();
            }

            $data = array();

            if(!empty($shopbystyle))
            {
                foreach ($shopbystyle as $shopby)
                {
                    $page_id = ProjectPage::where('route_url','admin.order_includes.list')->pluck('id')->first();

                    if( $order->estatus==1 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="ShopByStyleStatuscheck_'. $order->id .'" onchange="chageShopByStyleStatus('. $order->id .')" value="1" checked="checked"><span class="slider round"></span></label>';
                    }
                    elseif ($order->estatus==1){
                        $estatus = '<label class="switch"><input type="checkbox" id="ShopByStyleStatuscheck_'. $order->id .'" value="1" checked="checked"><span class="slider round"></span></label>';
                    }

                    if( $order->estatus==2 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="ShopByStyleStatuscheck_'. $order->id .'" onchange="chageShopByStyleStatus('. $order->id .')" value="2"><span class="slider round"></span></label>';
                    }
                    elseif ($order->estatus==2){
                        $estatus = '<label class="switch"><input type="checkbox" id="ShopByStyleStatuscheck_'. $order->id .'" value="2"><span class="slider round"></span></label>';
                    }

                    if(isset($order->image) && $order->image!=null){
                        $thumb_path = url($order->image);
                    }

                    $action='';
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
                        $action .= '<button id="editShopByStyleBtn" class="btn btn-gray text-blue btn-sm" data-id="' .$order->id. '"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                    }
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_delete($page_id)) ){
                        $action .= '<button id="deleteShopByStyleBtn" class="btn btn-gray text-danger btn-sm" data-toggle="modal" data-target="#DeleteShopByStyleModal" onclick="" data-id="' .$order->id. '"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }
                    $nestedData['image'] = '<img src="'. $thumb_path .'" width="50px" height="50px" alt="Thumbnail">';
                    $nestedData['title'] = $order->title;
                    $nestedData['estatus'] = $estatus;
                    $nestedData['created_at'] = date('d-m-Y h:i A', strtotime($order->created_at));
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
        $order = OrderIncludes::find($id);
        if ($order->estatus==1){
            $order->estatus = 2;
            $order->save();
            return response()->json(['status' => '200','action' =>'deactive']);
        }
        if ($order->estatus==2){
            $order->estatus = 1;
            $order->save();
            return response()->json(['status' => '200','action' =>'active']);
        }
    }

    public function deleteshopbystyle($id){
        $order = OrderIncludes::find($id);
        if ($shopby){
            $image = $order->image;
            $order->estatus = 3;
            $order->save();

            $order->delete();
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
        $order = OrderIncludes::find($id);
        $attributes = Attribute::where('estatus',1)->where('is_specification',0)->get()->toArray();
        $attributes_term = AttributeTerm::where('estatus',1)->where('attribute_id',$order->attributes)->get()->toArray();
        return view('admin.order_includes.list',compact('action','shopby','attributes','attributes_term'))->with('page',$this->page);
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
