<?php

namespace App\Http\Controllers\admin;

use App\Exports\RedirectExport;
use App\Http\Controllers\Controller;
use App\Imports\ImportRedirect;
use App\Models\ProjectPage;
use App\Models\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class RedirectController extends Controller
{
    private $page = "Redirect";

    public function index(){
        $action = "list";
        return view('admin.redirect.list',compact('action'))->with('page',$this->page);
    }

    public function create(){
        $action = "create";
        return view('admin.redirect.list',compact('action'))->with('page',$this->page);
    }

    public function save(Request $request){
        $messages = [
            'from_url.required' =>'Please provide from url',
            'to_url.required' =>'Please provide a to url',
        ];

        $validator = Validator::make($request->all(), [
            'from_url' => 'required',
            'to_url' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        if (isset($request->action) && $request->action=="update"){
            $action = "update";
            $redirect = Redirect::find($request->redirect_id);

            if(!$redirect){
                return response()->json(['status' => '400']);
            }
        }
        else{
            $action = "add";
            $redirect = new Redirect();
        }

        $redirect->from_url = $request->from_url;
        $redirect->to_url = $request->to_url;
        $redirect->save();

        return response()->json(['status' => '200', 'action' => $action]);
    }

    function allredirectlist(Request $request){
        if ($request->ajax()) {
            $columns = array(
                0 => 'no',
                1 => 'from_url',
                2 => 'to_url',
                3 => 'action',
            );
            $totalData = Redirect::count();
            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            $order = "created_at";
            $dir = 'desc';


            if(empty($request->input('search.value')))
            {
                $redirect = Redirect::offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
            }
            else {
                $search = $request->input('search.value');
                $redirect =  Redirect::where('from_url','LIKE',"%{$search}%")
                    ->orWhere('to_url','LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();

                $totalFiltered = count($redirect->toArray());
            }

            $data = array();

            if(!empty($redirect))
            {
                foreach ($redirect as $redirect)
                {
                    $page_id = ProjectPage::where('route_url','admin.redirect.list')->pluck('id')->first();

                    $action='';
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
                        $action .= '<button id="editredirectBtn" class="btn btn-gray text-blue btn-sm" data-id="' .$redirect->id. '"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                    }
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_delete($page_id)) ){
                        $action .= '<button id="deleteredirectBtn" class="btn btn-gray text-danger btn-sm" data-toggle="modal" data-target="#DeleteredirectModal" onclick="" data-id="' .$redirect->id. '"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }

                   

                    $nestedData['from_url'] = $redirect->from_url;
                    $nestedData['to_url'] = $redirect->to_url;
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

    public function editredirect($id){
        $action = "edit";
        $redirect = Redirect::find($id);
      

        return view('admin.redirect.list',compact('action','redirect'))->with('page',$this->page);
    }

    public function deleteredirect($id){
        $redirect = Redirect::find($id);
        if ($redirect){
            $redirect->estatus = 3;
            $redirect->save();
            $redirect->delete();

            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '400']);
    }


    public function importView(Request $request){
        $action = "import";
        return view('admin.redirect.list',compact('action'))->with('page',$this->page);
    }

    public function import(Request $request){
        $messages = [
            'file.required' =>'Please provide a file',
        ];

        $validator = Validator::make($request->all(), [
            'file' =>'required',
        ], $messages);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }
        Excel::import(new ImportRedirect, $request->file('file')->store('files'));
        $action = "add";
        return response()->json(['status' => '200', 'action' => $action]);
    }

    public function export()
    {
        return Excel::download(new RedirectExport, 'url_redirection.xlsx');
    }
}
