<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SizeChart;
use App\Models\ProjectPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SizeChartController extends Controller
{
    private $page = "Trusted By";

    public function index(){
        return view('admin.sizechart.list')->with('page',$this->page);
    }

    public function addorupdatesizechart(Request $request){
        //dd($request->all());
        $messages = [
            'title.required' =>'Please provide a title',
            'thumb.image' =>'Please provide a Valid Extension Image(e.g: .jpg .png)',
            'thumb.mimes' =>'Please provide a Valid Extension Image(e.g: .jpg .png)',
        ];

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'thumb' => 'image|mimes:jpeg,png,jpg',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }
       
        if(isset($request->action) && $request->action=="update"){
            $action = "update";
            $sizechart = SizeChart::find($request->sizechart_id);
            

            if(!$sizechart){
                return response()->json(['status' => '400']);
            }

            $old_image = $sizechart->thumb;
            $image_name = $old_image;
            $sizechart->title = $request->title;
            
        }
        else{
            $action = "add";
            $sizechart = new SizeChart();
            $sizechart->title = $request->title;
            $sizechart->created_at = new \DateTime(null, new \DateTimeZone('Asia/Kolkata'));
            $image_name=null;
        }

        if ($request->hasFile('thumb')) {
            $image = $request->file('thumb');
            $image_name = 'sizechart_thumb_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            // $destinationPath = public_path('images/thumb');
            // $image->move($destinationPath, $image_name);
            $destinationPath = public_path('images/sizechart_thumb/'.$image_name);
            $imageTemp = $_FILES["thumb"]["tmp_name"];

            if($_FILES["thumb"]["size"] > 500000){
                compressImage($imageTemp, $destinationPath, 90);
            }else{
                $destinationPath = public_path('images/sizechart_thumb');
                $image->move($destinationPath, $image_name);  
            }

            if(isset($old_image)) { 
                $old_image = public_path('images/sizechart_thumb/' . $old_image);
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
            }
            $sizechart->thumb = $image_name;
        }

        $sizechart->save();

        return response()->json(['status' => '200', 'action' => $action]);
    }

    public function allsizechartlist(Request $request){
        if ($request->ajax()) {
            $columns = array(
                0 =>'id',
                1=> 'title',
                2 =>'thumb',
                3=> 'estatus',
                4=> 'created_at',
                5=> 'action',
            );
            $totalData = SizeChart::count();
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
                $sizecharts = SizeChart::
                    offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
            }
            else {
                $search = $request->input('search.value');
                $sizecharts =  SizeChart::
                    where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                            ->orWhere('title', 'LIKE',"%{$search}%");
                    })
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
                $totalFiltered = SizeChart::
                    where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                            ->orWhere('title', 'LIKE',"%{$search}%");
                    })
                    ->count();
            }

            $data = array();

            if(!empty($sizecharts))
            {
              // $i=1;
                foreach ($sizecharts as $sizechart)
                {
                    $page_id = ProjectPage::where('route_url','admin.attributes.list')->pluck('id')->first();

                    if( $sizechart->estatus==1 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="sizecharttatuscheck_'. $sizechart->id .'" onchange="chagesizechartStatus('. $sizechart->id .')" value="1" checked="checked"><span class="slider round"></span></label>';
                    }
                    elseif ($sizechart->estatus==1){
                        $estatus = '<label class="switch"><input type="checkbox" id="sizecharttatuscheck_'. $sizechart->id .'" value="1" checked="checked"><span class="slider round"></span></label>';
                    }

                    if( $sizechart->estatus==2 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="sizecharttatuscheck_'. $sizechart->id .'" onchange="chagesizechartStatus('. $sizechart->id .')" value="2"><span class="slider round"></span></label>';
                    }
                    elseif ($sizechart->estatus==2){
                        $estatus = '<label class="switch"><input type="checkbox" id="sizecharttatuscheck_'. $sizechart->id .'" value="2"><span class="slider round"></span></label>';
                    }

                    if(isset($sizechart->thumb) && $sizechart->thumb!=null){
                        $thumb_path = url('images/sizechart_thumb/'.$sizechart->thumb);
                    }
                    else{
                        $thumb_path = url('images/placeholder_image.png');
                    }

                    $action='';
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
                        $action .= '<button id="editsizechartBtn" class="btn btn-gray text-blue btn-sm" data-toggle="modal" data-target="#sizechartModal" onclick="" data-id="' .$sizechart->id. '"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                    }
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_delete($page_id)) ){
                        $action .= '<button id="deletesizechartBtn" class="btn btn-gray text-danger btn-sm" data-toggle="modal" data-target="#DeletesizechartModal" onclick="" data-id="' .$sizechart->id. '"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }
                    //                    $nestedData['id'] = $i;
                    $nestedData['sizechartthumb'] = '<img src="'. $thumb_path .'" width="50px" height="50px" alt="Thumbnail">';
                    $nestedData['title'] = $sizechart->title;
                    $nestedData['estatus'] = $estatus;
                    $nestedData['created_at'] = date('d-m-Y h:i A', strtotime($sizechart->created_at));
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

    public function chagesizechartstatus($id){
        $sizechart = SizeChart::find($id);
        if ($sizechart->estatus==1){
            $sizechart->estatus = 2;
            $sizechart->save();
            return response()->json(['status' => '200','action' =>'deactive']);
        }
        if ($sizechart->estatus==2){
            $sizechart->estatus = 1;
            $sizechart->save();
            return response()->json(['status' => '200','action' =>'active']);
        }
    }

    public function editsizechart($id){
        $sizechart = SizeChart::find($id);
        return response()->json($sizechart);
    }

    public function deletesizechart($id){
        $sizechart = SizeChart::find($id);
        if ($sizechart){
            $sizechart->estatus = 3;
            $sizechart->save();

            $sizechart->delete();
            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '400']);
    }   //
}
