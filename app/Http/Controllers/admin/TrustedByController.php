<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TrustedBy;
use App\Models\ProjectPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrustedByController extends Controller
{
    private $page = "Trusted By";

    public function index(){
        return view('admin.trustedby.list')->with('page',$this->page);
    }

    public function addorupdatetrustedby(Request $request){
        //dd($request->all());
        $messages = [
            'redirect_url.required' =>'Please provide a redirect url',
            'trustedbythumb.image' =>'Please provide a Valid Extension Image(e.g: .jpg .png)',
            'trustedbythumb.mimes' =>'Please provide a Valid Extension Image(e.g: .jpg .png)',
        ];

        $validator = Validator::make($request->all(), [
            'trustedbythumb' => 'image|mimes:jpeg,png,jpg',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }
       
        if(isset($request->action) && $request->action=="update"){
            $action = "update";
            $trustedby = TrustedBy::find($request->trustedby_id);
            

            if(!$trustedby){
                return response()->json(['status' => '400']);
            }

            $old_image = $trustedby->trustedbythumb;
            $image_name = $old_image;
            $trustedby->redirect_url = $request->redirect_url;
            
        }
        else{
            $action = "add";
            $trustedby = new TrustedBy();
            $trustedby->redirect_url = $request->redirect_url;
            $trustedby->created_at = new \DateTime(null, new \DateTimeZone('Asia/Kolkata'));
            $image_name=null;
        }

        if ($request->hasFile('trustedbythumb')) {
            $image = $request->file('trustedbythumb');
            $image_name = 'trustedbyThumb_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/trustedbyThumb');
            $image->move($destinationPath, $image_name);
            if(isset($old_image)) { 
                $old_image = public_path('images/trustedbyThumb/' . $old_image);
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
            }
            $trustedby->trustedbythumb = $image_name;
        }

        $trustedby->save();

        return response()->json(['status' => '200', 'action' => $action]);
    }

    public function alltrustedbylist(Request $request){
        if ($request->ajax()) {
            $columns = array(
                0 =>'id',
                1 =>'trustedbythumb',
                2=> 'redirect_url',
                3=> 'estatus',
                4=> 'created_at',
                5=> 'action',
            );
            $totalData = TrustedBy::count();
            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            if($order == "id"){
                $order = "created_at";
                $dir = 'asc';
            }

            if(empty($request->input('search.value')))
            {
                $trustedbys = TrustedBy::
                    offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
            }
            else {
                $search = $request->input('search.value');
                $trustedbys =  TrustedBy::
                    where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                            ->orWhere('redirect_url', 'LIKE',"%{$search}%");
                    })
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
                $totalFiltered = TrustedBy::
                    where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                            ->orWhere('redirect_url', 'LIKE',"%{$search}%");
                    })
                    ->count();
            }

            $data = array();

            if(!empty($trustedbys))
            {
              // $i=1;
                foreach ($trustedbys as $trustedby)
                {
                    $page_id = ProjectPage::where('route_url','admin.attributes.list')->pluck('id')->first();

                    if( $trustedby->estatus==1 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="trustedbytatuscheck_'. $trustedby->id .'" onchange="chagetrustedbyStatus('. $trustedby->id .')" value="1" checked="checked"><span class="slider round"></span></label>';
                    }
                    elseif ($trustedby->estatus==1){
                        $estatus = '<label class="switch"><input type="checkbox" id="trustedbytatuscheck_'. $trustedby->id .'" value="1" checked="checked"><span class="slider round"></span></label>';
                    }

                    if( $trustedby->estatus==2 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="trustedbytatuscheck_'. $trustedby->id .'" onchange="chagetrustedbyStatus('. $trustedby->id .')" value="2"><span class="slider round"></span></label>';
                    }
                    elseif ($trustedby->estatus==2){
                        $estatus = '<label class="switch"><input type="checkbox" id="trustedbytatuscheck_'. $trustedby->id .'" value="2"><span class="slider round"></span></label>';
                    }

                    if(isset($trustedby->trustedbythumb) && $trustedby->trustedbythumb!=null){
                        $thumb_path = url('images/trustedbyThumb/'.$trustedby->trustedbythumb);
                    }
                    else{
                        $thumb_path = url('images/placeholder_image.png');
                    }

                    $action='';
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
                        $action .= '<button id="edittrustedbyBtn" class="btn btn-gray text-blue btn-sm" data-toggle="modal" data-target="#trustedbyModal" onclick="" data-id="' .$trustedby->id. '"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                    }
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_delete($page_id)) ){
                        $action .= '<button id="deletetrustedbyBtn" class="btn btn-gray text-danger btn-sm" data-toggle="modal" data-target="#DeletetrustedbyModal" onclick="" data-id="' .$trustedby->id. '"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }
                    //                    $nestedData['id'] = $i;
                    $nestedData['trustedbythumb'] = '<img src="'. $thumb_path .'" width="50px" height="50px" alt="Thumbnail">';
                    $nestedData['redirect_url'] = $trustedby->redirect_url;
                    $nestedData['estatus'] = $estatus;
                    $nestedData['created_at'] = date('d-m-Y h:i A', strtotime($trustedby->created_at));
                    $nestedData['action'] = $action;
                    $data[] = $nestedData;
                 //                    $i=$i+1;
                }
            }

            $json_data = array(
                "draw"            => intval($request->input('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data,
            );

//            return json_encode($json_data);
            echo json_encode($json_data);
        }
    }

    public function chagetrustedbystatus($id){
        $trustedby = TrustedBy::find($id);
        if ($trustedby->estatus==1){
            $trustedby->estatus = 2;
            $trustedby->save();
            return response()->json(['status' => '200','action' =>'deactive']);
        }
        if ($trustedby->estatus==2){
            $trustedby->estatus = 1;
            $trustedby->save();
            return response()->json(['status' => '200','action' =>'active']);
        }
    }

    public function edittrustedby($id){
        $trustedby = TrustedBy::find($id);
        return response()->json($trustedby);
    }

    public function deletetrustedby($id){
        $trustedby = TrustedBy::find($id);
        if ($trustedby){
            $trustedby->estatus = 3;
            $trustedby->save();

            $trustedby->delete();
            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '400']);
    }   //
}
