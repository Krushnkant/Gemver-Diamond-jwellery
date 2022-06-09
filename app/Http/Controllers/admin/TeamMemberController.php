<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\ProjectPage;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TeamMemberController extends Controller
{
    private $page = "TeamMembers";

    public function index(){
        return view('admin.team_members.list')->with('page',$this->page);
    }

    public function allteamslist(Request $request){
     
        if ($request->ajax()) {
            $tab_type = $request->tab_type;
            if ($tab_type == "active_team_tab"){
                $estatus = 1;
            }
            elseif ($tab_type == "deactive_team_tab"){
                $estatus = 2;
            }

            $columns = array(
                0 =>'id',
                1 =>'image',
                2=> 'name',
                3=> 'position',
                4=> 'estatus',
                5=> 'action',
            );

            $totalData = TeamMember::count();
            if (isset($estatus)){
                $totalData = TeamMember::where('estatus',$estatus)->count();
                //dd($totalData);
                //$wordlist = TeamMember::where('estatus', '=', $estatus)->get();
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
                
                $teams = TeamMember::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir);
                //->get();
                 //dd($estatus);

                if (isset($estatus)){
                    $teams = $teams->where('estatus',$estatus);
                }
                $teams = $teams->get();
                //dd($teams);
            }
            else {
                $search = $request->input('search.value');
                $teams =  TeamMember::where(function($query) use($search){
                    $query->where('id','LIKE',"%{$search}%")
                          ->orWhere('name', 'LIKE',"%{$search}%")
                          ->orWhere('position', 'LIKE',"%{$search}%");
                    })
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
                if (isset($estatus)){
                    $teams = $teams->where('estatus',$estatus)->where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                              ->orWhere('name', 'LIKE',"%{$search}%")
                              ->orWhere('position', 'LIKE',"%{$search}%");
                        })
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get();
                }

                $totalFiltered = TeamMember::where(function($query) use($search){
                    $query->where('id','LIKE',"%{$search}%")
                         ->orWhere('name', 'LIKE',"%{$search}%")
                         ->orWhere('position', 'LIKE',"%{$search}%");
                    })->count();
                if (isset($estatus)){
                    $totalFiltered = $totalFiltered->where('estatus',$estatus)->where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                             ->orWhere('name', 'LIKE',"%{$search}%")
                             ->orWhere('position', 'LIKE',"%{$search}%");
                        })->count();
                }
               
            }
            $data = array();

            if(!empty($teams))
            {
                foreach ($teams as $team)
                {
                    $page_id = ProjectPage::where('route_url','admin.users.list')->pluck('id')->first();

                    if( $team->estatus==1 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="Teamstatuscheck_'. $team->id .'" onchange="changeTeamStatus('. $team->id .')" value="1" checked="checked"><span class="slider round"></span></label>';
                    }
                    elseif ($team->estatus==1){
                        $estatus = '<label class="switch"><input type="checkbox" id="Teamstatuscheck_'. $team->id .'" value="1" checked="checked"><span class="slider round"></span></label>';
                    }

                    if( $team->estatus==2 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="Teamstatuscheck_'. $team->id .'" onchange="changeTeamStatus('. $team->id .')" value="2"><span class="slider round"></span></label>';
                    }
                    elseif ($team->estatus==2){
                        $estatus = '<label class="switch"><input type="checkbox" id="Teamstatuscheck_'. $team->id .'" value="2"><span class="slider round"></span></label>';
                    }

                    if(isset($team->image) && $team->image!=null){
                        $image = asset('images/teams/'.$team->image);
                    }
                    else{
                        $image = asset('images/default_avatar.jpg');
                    }

                    $action='';
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
                        $action .= '<button id="editTeamBtn" class="btn btn-gray text-blue btn-sm" data-toggle="modal" data-target="#TeamModel" onclick="" data-id="' .$team->id. '"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                    }
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_delete($page_id)) ){
                        $action .= '<button id="deleteTeamBtn" class="btn btn-gray text-danger btn-sm" data-toggle="modal" data-target="#DeleteTeamModel" onclick="" data-id="' .$team->id. '"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }

                 
                    $nestedData['image'] = '<img src="'. $image .'" width="50px" height="50px" alt="Profile Pic">';
                    $nestedData['name'] = $team->name;
                    $nestedData['position'] = $team->position;
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

    public function addorupdateteam(Request $request){
        $messages = [
            'profile_pic.image' =>'Please provide a Valid Extension Image(e.g: .jpg .png)',
            'profile_pic.mimes' =>'Please provide a Valid Extension Image(e.g: .jpg .png)',
            'name.required' =>'Please provide a Name',
            'position.required' =>'Please provide a Position.',
        ];

        if (isset($request->action) && $request->action=="update"){
            $validator = Validator::make($request->all(), [
                'profile_pic' => 'image|mimes:jpeg,png,jpg',
                'name' => 'required',
                'position' => 'required',
            ], $messages);
        }
        else{
            $validator = Validator::make($request->all(), [
                'profile_pic' => 'image|mimes:jpeg,png,jpg',
                'name' => 'required',
                'position' => 'required',
            ], $messages);
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        if(isset($request->action) && $request->action=="update"){
            $action = "update";
            $team = TeamMember::find($request->team_id);

            if(!$team){
                return response()->json(['status' => '400']);
            }

            $old_image = $team->profile_pic;
            $image_name = $old_image;
            $team->name = $request->name;
            $team->position = $request->position;
           
        }
        else{
            $action = "add";
            $team = new TeamMember();
            $team->name = $request->name;
            $team->position = $request->position;
            $team->created_at = new \DateTime(null, new \DateTimeZone('Asia/Kolkata'));
            $image_name=null;
        }

        if ($request->hasFile('profile_pic')) {
            $image = $request->file('profile_pic');
            $image_name = 'teamMember_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/teams');
            $image->move($destinationPath, $image_name);
            if(isset($old_image)) {
                $old_image = public_path('images/teams/' . $old_image);
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
            }
            $team->image = $image_name;
        }

        $team->save();

        return response()->json(['status' => '200', 'action' => $action]);
    }

    public function editteam($id){
        $team = TeamMember::find($id);
        return response()->json($team);
    }

    public function deleteteam($id){
        $team = TeamMember::find($id);
        if ($team){
            $image = $team->image;
            $team->estatus = 3;
            $team->save();

            $team->delete();

            $image = public_path('images/teams/' . $image);
            if (file_exists($image)) {
                unlink($image);
            }
            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '400']);
    }


    public function changeteamstatus($id){
        $teams = TeamMember::find($id);
        if ($teams->estatus==1){
            $teams->estatus = 2;
            $teams->save();
            return response()->json(['status' => '200','action' =>'deactive']);
        }
        if ($teams->estatus==2){
            $teams->estatus = 1;
            $teams->save();
            return response()->json(['status' => '200','action' =>'active']);
        }
    }
}
