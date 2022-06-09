<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectPage;
use App\Models\Partners as Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PartnerController extends Controller
{
    private $page = "Partner";

    public function index(){
        return view('admin.partner.list')->with('page',$this->page);
    }

    public function allpartnerslist(Request $request){
     
        if ($request->ajax()) {
            $tab_type = $request->tab_type;
            if ($tab_type == "active_partner_tab"){
                $estatus = 1;
            }
            elseif ($tab_type == "deactive_partner_tab"){
                $estatus = 2;
            }

            $columns = array(
                0 =>'id',
                1 =>'image',
                2=> 'title',
                3=> 'estatus',
                4=> 'action',
            );

            $totalData = Partner::count();
            if (isset($estatus)){
                $totalData = Partner::where('estatus',$estatus)->count();
                //dd($totalData);
                //$wordlist = Partner::where('estatus', '=', $estatus)->get();
                //$totalData = $wordlist->count();
            }
           

            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');
//            dd($columns[$request->input('order.0.column')]);
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            if($order == "id"){
                $order = "created_at";
                $dir = 'desc';
            }

            if(empty($request->input('search.value')))
            {
                
                $partners = Partner::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir);
                //->get();
                 //dd($estatus);

                if (isset($estatus)){
                    $partners = $partners->where('estatus',$estatus);
                }
                $partners = $partners->get();
                //dd($partners);
            }
            else {
                $search = $request->input('search.value');
                $partners =  Partner::where(function($query) use($search){
                    $query->where('id','LIKE',"%{$search}%")
                          ->orWhere('title', 'LIKE',"%{$search}%");
                    })
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
                if (isset($estatus)){
                    $partners = $partners->where('estatus',$estatus)->where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                              ->orWhere('title', 'LIKE',"%{$search}%");
                        })
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get();
                }

                $totalFiltered = Partner::where(function($query) use($search){
                    $query->where('id','LIKE',"%{$search}%")
                         ->orWhere('title', 'LIKE',"%{$search}%");
                    })->count();
                if (isset($estatus)){
                    $totalFiltered = $totalFiltered->where('estatus',$estatus)->where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                             ->orWhere('title', 'LIKE',"%{$search}%");
                        })->count();
                }
               
            }
            $data = array();

            if(!empty($partners))
            {
                foreach ($partners as $partner)
                {
                    $page_id = ProjectPage::where('route_url','admin.users.list')->pluck('id')->first();

                    if( $partner->estatus==1 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="partnerstatuscheck_'. $partner->id .'" onchange="changepartnerStatus('. $partner->id .')" value="1" checked="checked"><span class="slider round"></span></label>';
                    }
                    elseif ($partner->estatus==1){
                        $estatus = '<label class="switch"><input type="checkbox" id="partnerstatuscheck_'. $partner->id .'" value="1" checked="checked"><span class="slider round"></span></label>';
                    }

                    if( $partner->estatus==2 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="partnerstatuscheck_'. $partner->id .'" onchange="changepartnerStatus('. $partner->id .')" value="2"><span class="slider round"></span></label>';
                    }
                    elseif ($partner->estatus==2){
                        $estatus = '<label class="switch"><input type="checkbox" id="partnerstatuscheck_'. $partner->id .'" value="2"><span class="slider round"></span></label>';
                    }

                    if(isset($partner->logo) && $partner->logo!=null){
                        $image = asset('images/partners/'.$partner->logo);
                    }
                    else{
                        $image = asset('images/default_avatar.jpg');
                    }

                    $action='';
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
                        $action .= '<button id="editPartnerBtn" class="btn btn-gray text-blue btn-sm" data-toggle="modal" data-target="#PartnerModel" onclick="" data-id="' .$partner->id. '"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                    }
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_delete($page_id)) ){
                        $action .= '<button id="deletePartnerBtn" class="btn btn-gray text-danger btn-sm" data-toggle="modal" data-target="#DeletePartnerModel" onclick="" data-id="' .$partner->id. '"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }

                 
                    $nestedData['image'] = '<img src="'. $image .'" width="50px" height="50px" alt="Profile Pic">';
                    $nestedData['title'] = $partner->title;
                    $nestedData['estatus'] = $estatus;
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

//            return json_encode($json_data);
            echo json_encode($json_data);
        }
    }

    public function addorupdatepartner(Request $request){
        $messages = [
            'profile_pic.image' =>'Please provide a Valid Extension Image(e.g: .jpg .png)',
            'profile_pic.mimes' =>'Please provide a Valid Extension Image(e.g: .jpg .png)',
            'title.required' =>'Please provide a Title',
        ];

        if (isset($request->action) && $request->action=="update"){
            $validator = Validator::make($request->all(), [
                'profile_pic' => 'image|mimes:jpeg,png,jpg',
                'title' => 'required',
            ], $messages);
        }
        else{
            $validator = Validator::make($request->all(), [
                'profile_pic' => 'image|mimes:jpeg,png,jpg',
                'title' => 'required',
            ], $messages);
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        if(isset($request->action) && $request->action=="update"){
            $action = "update";
            $partner = Partner::find($request->partner_id);

            if(!$partner){
                return response()->json(['status' => '400']);
            }

            $old_image = $partner->profile_pic;
            $image_name = $old_image;
            $partner->title = $request->title;
           
        }
        else{
            $action = "add";
            $partner = new Partner();
            $partner->title = $request->title;
            $partner->created_at = new \DateTime(null, new \DateTimeZone('Asia/Kolkata'));
            $image_name=null;
        }

        if ($request->hasFile('profile_pic')) {
            $image = $request->file('profile_pic');
             $image_name = 'Partner_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            // $destinationPath = public_path('images/partners/'.$image_name);
            // $resizedImage = \Image::make($image)->resize(400, 300);
            // $resizedImage->save($destinationPath,80);
            // if(isset($old_image)) {
            //     $old_image = public_path('images/partners/' . $old_image);
            //     if (file_exists($old_image)) {
            //         unlink($old_image);
            //     }
            // }
             
            

            $destinationPath = public_path('images/partners/'.$image_name);
            $imageTemp = $_FILES["profile_pic"]["tmp_name"];
            $d = compressImage($imageTemp, $destinationPath, 90);
            //$compressedImageSize = filesize($d);
            $partner->logo = $image_name;
        }

        $partner->save();

        return response()->json(['status' => '200', 'action' => $action]);
    }

    

    public function editpartner($id){
        $partner = Partner::find($id);
        return response()->json($partner);
    }

    public function deletepartner($id){
        $partner = Partner::find($id);
        if ($partner){
            $image = $partner->logo;
            $partner->estatus = 3;
            $partner->save();

            $partner->delete();

            $image = public_path('images/partners/' . $image);
            if (file_exists($image)) {
                unlink($image);
            }
            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '400']);
    }


    public function changepartnerstatus($id){
        $partners = Partner::find($id);
        if ($partners->estatus==1){
            $partners->estatus = 2;
            $partners->save();
            return response()->json(['status' => '200','action' =>'deactive']);
        }
        if ($partners->estatus==2){
            $partners->estatus = 1;
            $partners->save();
            return response()->json(['status' => '200','action' =>'active']);
        }
    }
}
