<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\DiscountType;
use App\Models\ProjectPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    private $page = "Coupon";

    public function index(){
        $action = "list";
        return view('admin.coupons.list',compact('action'))->with('page',$this->page);
    }

    public function create(){
        $action = "create";
        $DiscountTypes = DiscountType::get();
        return view('admin.coupons.list',compact('action','DiscountTypes'))->with('page',$this->page);
    }

    public function save(Request $request){
        $messages = [
            'coupon_code.required' =>'Please provide coupon code',
            'coupon_amount.required' =>'Please provide a coupon amount',
            'usage_per_user.required' =>'Please provide a usage per user',
            'expiry_date.required' =>'Please provide a coupon expiry date',
        ];

        $validator = Validator::make($request->all(), [
            'coupon_code' => 'required',
            'coupon_amount' => 'required',
            'usage_per_user' => 'required',
            'expiry_date' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        if (isset($request->action) && $request->action=="update"){
            $action = "update";
            $Coupon = Coupon::find($request->coupon_id);

            if(!$Coupon){
                return response()->json(['status' => '400']);
            }
        }
        else{
            $action = "add";
            $Coupon = new Coupon();
        }

        $Coupon->coupon_code = $request->coupon_code;
        $Coupon->discount_type_id = $request->discount_type_id;
        $Coupon->coupon_amount = $request->coupon_amount;
        $Coupon->allow_cod = isset($request->allow_cod) ? $request->allow_cod : 0;
        $Coupon->usage_per_user = $request->usage_per_user;
        $Coupon->expiry_date = $request->expiry_date;
        $Coupon->save();

        return response()->json(['status' => '200', 'action' => $action]);
    }

    function allcouponlist(Request $request){
        if ($request->ajax()) {
            $columns = array(
                0 => 'no',
                1 => 'coupon_code',
                2 => 'discount_type_id',
                3 => 'limitations',
                4 => 'expiry_date',
                5 => 'action',
            );
            $totalData = Coupon::count();
            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            $order = "created_at";
            $dir = 'desc';


            if(empty($request->input('search.value')))
            {
                $Coupons = Coupon::with('discount_type')
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
            }
            else {
                $search = $request->input('search.value');
                $Coupons =  Coupon::with('discount_type')
                    ->where('coupon_code','LIKE',"%{$search}%")
                    ->orWhere('coupon_amount','LIKE',"%{$search}%")
                    ->orWhere('usage_per_user','LIKE',"%{$search}%")
                    ->orWhere('expiry_date','LIKE',"%{$search}%")
                    ->orWhereHas('discount_type',function ($mainQuery) use($search) {
                        $mainQuery->where('title', 'Like', '%' . $search . '%');
                    })
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();

                $totalFiltered = count($Coupons->toArray());
            }

            $data = array();

            if(!empty($Coupons))
            {
                foreach ($Coupons as $Coupon)
                {
                    $page_id = ProjectPage::where('route_url','admin.coupons.list')->pluck('id')->first();

                    $action='';
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
                        $action .= '<button id="editCouponBtn" class="btn btn-gray text-blue btn-sm" data-id="' .$Coupon->id. '"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                    }
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_delete($page_id)) ){
                        $action .= '<button id="deleteCouponBtn" class="btn btn-gray text-danger btn-sm" data-toggle="modal" data-target="#DeleteCouponModal" onclick="" data-id="' .$Coupon->id. '"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }

                    $discount_type = '';
                    if($Coupon->discount_type_id == 1){
                        $discount_type = $Coupon->coupon_amount.' <i class="fa fa-percent" aria-hidden="true"></i> Off';
                    }
                    elseif($Coupon->discount_type_id == 2){
                        $discount_type = $Coupon->coupon_amount.' $ Off';
                    }

                    if (isset($Coupon->allow_cod) && $Coupon->allow_cod!=0){
                        $limitations = $Coupon->usage_per_user.' time per User COD Allow.';
                    }else{
                        $limitations = $Coupon->usage_per_user.' time per user COD not Allow.';
                    }

                    $nestedData['coupon_code'] = $Coupon->coupon_code;
                    $nestedData['discount_type_id'] = $discount_type;
                    $nestedData['limitations'] = $limitations;
                    $nestedData['expiry_date'] = $Coupon->expiry_date;
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

    public function editcoupon($id){
        $action = "edit";
        $Coupon = Coupon::find($id);
        $DiscountTypes = DiscountType::get();

        return view('admin.coupons.list',compact('action','Coupon','DiscountTypes'))->with('page',$this->page);
    }

    public function deletecoupon($id){
        $Coupon = Coupon::find($id);
        if ($Coupon){
            $Coupon->estatus = 3;
            $Coupon->save();
            $Coupon->delete();

            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '400']);
    }
}
