<?php

namespace App\Http\Controllers\admin;
use App\Models\NewsLatter;
use App\Http\Controllers\Controller;
use App\Models\ProjectPage;
use Illuminate\Http\Request;

class NewsLatterController extends Controller
{
    public function index()
    {
        $action = "list";
        return view('admin.newslatter.list',compact('action'));
    }

    public function allnewslatterslist(Request $request){
     
        if ($request->ajax()) {
            $tab_type = $request->tab_type;
            if ($tab_type == "active_newslatter_tab"){
                $estatus = 1;
            }
            elseif ($tab_type == "deactive_newslatter_tab"){
                $estatus = 2;
            }
             
            $columns = array(
                0 =>'id',
                2=> 'email',
                3=> 'created_at',
            );

            $totalData = NewsLatter::count();
            if (isset($estatus)){
                $totalData = NewsLatter::where('estatus',$estatus)->count();
            }
           
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
                
                $newslatters = NewsLatter::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir);

                if (isset($estatus)){
                    $newslatters = $newslatters->where('estatus',$estatus);
                }
                $newslatters = $newslatters->get();
            }
            else {
                $search = $request->input('search.value');
                $newslatters =  NewsLatter::where(function($query) use($search){
                    $query->where('id','LIKE',"%{$search}%")
                          ->orWhere('email', 'LIKE',"%{$search}%");
                    })
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
                if (isset($estatus)){
                    $newslatters = $newslatters->where('estatus',$estatus)->where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                              ->orWhere('email', 'LIKE',"%{$search}%");
                        })
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get();
                }

                $totalFiltered = NewsLatter::where(function($query) use($search){
                    $query->where('id','LIKE',"%{$search}%")
                         ->orWhere('email', 'LIKE',"%{$search}%");
                    })->count();
                if (isset($estatus)){
                    $totalFiltered = $totalFiltered->where('estatus',$estatus)->where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                             ->orWhere('email', 'LIKE',"%{$search}%");
                        })->count();
                }
            }
            $data = array();

            if(!empty($newslatters))
            {
                foreach ($newslatters as $contact)
                {
                    $page_id = ProjectPage::where('route_url','admin.users.list')->pluck('id')->first();
                    $newDate = date("d-m-Y", strtotime($contact->created_at));
                    $nestedData['email'] =$contact->email;
                    $nestedData['created_at'] = $newDate;
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
}
