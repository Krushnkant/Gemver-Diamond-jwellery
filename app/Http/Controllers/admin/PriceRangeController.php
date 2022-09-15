<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectPage;
use App\Models\PriceRange;
use App\Models\UserPermission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PriceRangeController extends Controller
{
    public function index(){
        return view('admin.pricerange.list');
    }

    public function addorupdatepricerange(Request $request){
        $messages = [

            'start_price.required' =>'Please provide a Start Price',
            'end_price.required' =>'Please provide a End Price.',
            'percentage.required' =>'Please provide a Percentage/Amount.',
            
        ];

        if (isset($request->action) && $request->action=="update"){
            $validator = Validator::make($request->all(), [
                'start_price' => 'required|numeric',
                'end_price' => 'required|numeric',
                'percentage' => 'required|numeric',
                
            ], $messages);
        }
        else{
            $validator = Validator::make($request->all(), [
                'start_price' => 'required|numeric',
                'end_price' => 'required|numeric',
                'percentage' => 'required|numeric',
                
            ], $messages);
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }
        
            if(isset($request->action) && $request->action=="update"){
                $start_price = (int)$request->start_price;
                $PriceRangeCheck = PriceRange::whereRaw("? BETWEEN start_price AND end_price", [$start_price])->where('id','<>',$request->pricerange_id)->first();
                
                if($PriceRangeCheck == null && $PriceRangeCheck == ""){
                    $action = "update";
                    $pricerange = PriceRange::find($request->pricerange_id);

                    if(!$pricerange){
                        return response()->json(['status' => '400']);
                    }

                    $pricerange->start_price = $request->start_price;
                    $pricerange->end_price = $request->end_price;
                    $pricerange->type = $request->type;
                    $pricerange->percentage = $request->percentage;
                }else{
                    return response()->json(['status' => '400' ,'message' => 'This price range allready added']);  
                }
            }else{
                $start_price = (int)$request->start_price;
                $PriceRangeCheck = PriceRange::whereRaw("? BETWEEN start_price AND end_price", [$start_price])->first();
                if($PriceRangeCheck == null && $PriceRangeCheck == ""){
                    $action = "add";
                    $pricerange = new PriceRange();
                    $pricerange->start_price = $request->start_price;
                    $pricerange->end_price = $request->end_price;
                    $pricerange->type = $request->type;
                    $pricerange->percentage = $request->percentage;
                    $pricerange->created_at = new \DateTime(null, new \DateTimeZone('Asia/Kolkata'));
                }else{
                    return response()->json(['status' => '400' ,'message' => 'This price range allready added']);  
                }
            }
        
            $pricerange->save();
            return response()->json(['status' => '200', 'action' => $action]);
    }

    public function allpricerangeslist(Request $request){
        if ($request->ajax()) {
            $tab_type = $request->tab_type;
            if ($tab_type == "active_user_tab"){
                $estatus = 1;
            }
            elseif ($tab_type == "deactive_user_tab"){
                $estatus = 2;
            }

            $columns = array(
                0 =>'id',
                1 =>'profile_pic',
                2=> 'contact_info',
                3=> 'login_info',
                4=> 'estatus',
                5=> 'created_at',
                6=> 'action',
            );

            $totalData = PriceRange::count();

            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');
//            dd($columns[$request->input('order.0.column')]);
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            if($order == "id"){
                $order == "created_at";
                $dir = 'desc';
            }

            if(empty($request->input('search.value')))
            {
                $priceranges = PriceRange::offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
            }
            else {
                $search = $request->input('search.value');
                $priceranges =  PriceRange::where(function($query) use($search){
                      $query->where('id','LIKE',"%{$search}%")
                            ->orWhere('created_at', 'LIKE',"%{$search}%");
                      })
                      ->offset($start)
                      ->limit($limit)
                      ->orderBy($order,$dir)
                      ->get();

                $totalFiltered = PriceRange::count();
            }

            $data = array();

            if(!empty($priceranges))
            {
                foreach ($priceranges as $pricerange)
                {
                    $page_id = ProjectPage::where('route_url','admin.pricerange.list')->pluck('id')->first();

                    if( $pricerange->estatus==1 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="Pricerangestatuscheck_'. $pricerange->id .'" onchange="changePricerangeStatus('. $pricerange->id .')" value="1" checked="checked"><span class="slider round"></span></label>';
                    }
                    elseif ($pricerange->estatus==1){
                        $estatus = '<label class="switch"><input type="checkbox" id="Pricerangestatuscheck_'. $pricerange->id .'" value="1" checked="checked"><span class="slider round"></span></label>';
                    }

                    if( $pricerange->estatus==2 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="Pricerangestatuscheck_'. $pricerange->id .'" onchange="changePricerangeStatus('. $pricerange->id .')" value="2"><span class="slider round"></span></label>';
                    }
                    elseif ($pricerange->estatus==2){
                        $estatus = '<label class="switch"><input type="checkbox" id="Pricerangestatuscheck_'. $pricerange->id .'" value="2"><span class="slider round"></span></label>';
                    }

                    $start_price = '<span><i class="fa fa-dollar" aria-hidden="true"></i> ' .$pricerange->start_price .'</span>';
                    
                    $end_price = '<span><i class="fa fa-dollar" aria-hidden="true"></i> ' .$pricerange->end_price .'</span>';
                     
                    if($pricerange->type == 1){
                        $percentage = '<span>' .$pricerange->percentage .' %</span>';
                    }else{
                        $percentage = '<span><i class="fa fa-dollar" aria-hidden="true"></i> ' .$pricerange->percentage .'</span>';
                    }
                    
                   
                    $action='';
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
                        $action .= '<button id="editPriceRangeBtn" class="btn btn-gray text-blue btn-sm" data-toggle="modal" data-target="#PriceRangeModel" onclick="" data-id="' .$pricerange->id. '"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                    }
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_delete($page_id)) ){
                        $action .= '<button id="deletePriceRangeBtn" class="btn btn-gray text-danger btn-sm" data-toggle="modal" data-target="#DeletePriceRangeModel" onclick="" data-id="' .$pricerange->id. '"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }

                    $nestedData['profile_pic'] = $start_price;
                    $nestedData['contact_info'] = $end_price;
                    $nestedData['percentage'] = $percentage;
                    $nestedData['estatus'] = $estatus;
                    $nestedData['created_at'] = date('Y-m-d H:i:s', strtotime($pricerange->created_at));
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

    public function changePricerangeStatus($id){
        $pricerange = PriceRange::find($id);
        if ($pricerange->estatus==1){
            $pricerange->estatus = 2;
            $pricerange->save();
            return response()->json(['status' => '200','action' =>'deactive']);
        }
        if ($pricerange->estatus==2){
            $pricerange->estatus = 1;
            $pricerange->save();
            return response()->json(['status' => '200','action' =>'active']);
        }
    }

    public function editpricerange($id){
        $pricerange = PriceRange::find($id);
        return response()->json($pricerange);
    }

    public function deletepricerange($id){
        $pricerange = PriceRange::find($id);
        if ($pricerange){
            $pricerange->estatus = 3;
            $pricerange->save();
            $pricerange->delete();
            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '400']);
    }
}
