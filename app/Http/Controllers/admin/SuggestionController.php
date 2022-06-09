<?php

namespace App\Http\Controllers\admin;
use App\Models\Suggestion;
use App\Models\ProjectPage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    public function index(){
        $action = "list";
        return view('admin.suggestions.list',compact('action'));
    }

    public function allSuggestionslist(Request $request){
        if ($request->ajax()) {
            $columns = array(
                0 => 'id',
                1 => 'user',
                2 => 'suggestion',
                3 => 'action',
            );
            $totalData = Suggestion::count();
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
                $Suggestions = Suggestion::with('user')->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
            }
            else {
                $search = $request->input('search.value');
                $Suggestions =  Suggestion::with('user')->where('user_id','LIKE',"%{$search}%")
                    ->orWhere('suggestion', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();


                $totalFiltered = count($Suggestions->toArray());
            }
            //print_r($Suggestions); die;
            $data = array();

            if(!empty($Suggestions))
            {
                foreach ($Suggestions as $Suggestion)
                {
                    $page_id = ProjectPage::where('route_url','admin.suggestions.list')->pluck('id')->first();
                    $action='';
                    $action .= '<button id="deleteSuggestionBtn" class="btn btn-gray text-danger btn-sm" data-toggle="modal" data-target="#DeleteSuggestionModal" data-id="' .$Suggestion->id. '"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    
                    $nestedData['user'] = $Suggestion->User->username;
                    $nestedData['suggestion'] = $Suggestion->suggestion;
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

    public function deleteSuggestion($id){
        $Faqform = Suggestion::where('id',$id)->first();
        if ($Faqform){
            $Faqform->save();
            $Faqform->delete();
            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '400']);
    }
}
