<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\ProjectPage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class OfferController extends Controller
{
    private $page = "Offers";

    public function index(){
        return view('admin.offers.list')->with('page',$this->page);
    }

    public function addorupdateoffer(Request $request){

        $messages = [
            'title.required' =>'Please provide a Title',
            'expiry_date.required' =>'Please provide a Expiry Date',
        ];

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'expiry_date' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

    
        if(!isset($request->offer_id)){
            $offer = new Offer();
            $offer->title = $request->title;
            $offer->expiry_date = $request->expiry_date;
            $offer->save();
            return response()->json(['status' => '200', 'action' => 'add']);
        }
        else{
            $offer = Offer::find($request->offer_id);
            if ($offer) {
                $offer->title = $request->title;
                $offer->expiry_date = $request->expiry_date;
                $offer->save();
                return response()->json(['status' => '200', 'action' => 'update']);
            }
            return response()->json(['status' => '400']);
        }
    }

    public function allofferlist(Request $request){
        if ($request->ajax()) {
            
            $columns = array(
                0 =>'id',
                1 =>'title',
                2=> 'expiry_date',
                3=> 'created_at',
                4=> 'action',
            );

            $totalData = Offer::count();
            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            if($order == "id"){
                $order = "created_at";
                $dir = 'desc';
            }

            if(empty($request->input('search.value')))
            {
                $offers = Offer::offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
            }
            else {
                $search = $request->input('search.value');
                $offers =  Offer::where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                                ->orWhere('title', 'LIKE',"%{$search}%");
                        })
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();

                $totalFiltered = Offer::where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                        ->orWhere('title', 'LIKE',"%{$search}%");
                    })
                    ->count();
            }

            $data = array();

            if(!empty($offers))
            {
                foreach ($offers as $offer)
                {
                    $page_id = ProjectPage::where('route_url','admin.offers.list')->pluck('id')->first();

                    if($offer->estatus==1 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="Offerstatuscheck_'. $offer->id .'" onchange="chageOfferStatus('. $offer->id .')" value="1" checked="checked"><span class="slider round"></span></label>';
                    }
                    else if ($offer->estatus==1){
                        $estatus = '<label class="switch"><input type="checkbox" id="Offerstatuscheck_'. $offer->id .'" value="1" checked="checked"><span class="slider round"></span></label>';
                    }

                    if($offer->estatus==2 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="Offerstatuscheck_'. $offer->id .'" onchange="chageOfferStatus('. $offer->id .')" value="2"><span class="slider round"></span></label>';
                    }
                    else if ($offer->estatus==2){
                        $estatus = '<label class="switch"><input type="checkbox" id="Offerstatuscheck_'. $offer->id .'" value="2"><span class="slider round"></span></label>';
                    }

                    $action='';
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
                        $action .= '<button id="editOfferBtn" class="btn btn-gray text-blue btn-sm" data-toggle="modal" data-target="#OfferModal" onclick="" data-id="' .$offer->id. '"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                    }
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_delete($page_id)) ){
                        $action .= '<button id="deleteOfferBtn" class="btn btn-gray text-danger btn-sm" data-toggle="modal" data-target="#DeleteOfferModal" onclick="" data-id="' .$offer->id. '"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }

                    if($offer->is_filter==1){
                        $is_filter = 'True';
                    }else{
                        $is_filter = 'False';
                    }

                    $nestedData['title'] = $offer->title;
                    $nestedData['expiry_date'] = $offer->expiry_date;
                    $nestedData['estatus'] = $estatus;
                    $nestedData['created_at'] = date('d-m-Y h:i A', strtotime($offer->created_at));
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

    public function editoffer($id){
        $offer = Offer::find($id);
        return response()->json($offer);
    }

    public function deleteoffer($id){
        $offer = Offer::find($id);
        if ($offer){
            $offer->estatus = 3;
            $offer->save();

            $offer->delete();
            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '400']);
    }

    public function chageOfferStatus($id){
        $offer = Offer::find($id);
        if ($offer->estatus==1){
            $offer->estatus = 2;
            $offer->save();
            return response()->json(['status' => '200','action' =>'deactive']);
        }
        if ($offer->estatus==2){
            $offer->estatus = 1;
            $offer->save();
            return response()->json(['status' => '200','action' =>'active']);
        }
    } 
}
