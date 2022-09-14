<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeTerm;
use App\Models\ProjectPage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class AttributeController extends Controller
{
    private $page = "Attributes & Specifications";

    public function index(){
        return view('admin.attributes.list')->with('page',$this->page);
    }

    public function addorupdateattribute(Request $request){
//        $now = new \DateTime(null, new \DateTimeZone('Asia/Kolkata'));
//        dd($now);
//        dd(Carbon::now()->format('Y-m-d h:i:s'));
        $messages = [
            'attributename.required' =>'Please provide a Attribute Name',
        ];

        $validator = Validator::make($request->all(), [
            'attributename' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        $tab_type = $request->tab_type;

        if(!isset($request->attribute_id)){
            $attribute = new Attribute();
            $attribute->attribute_name = $request->attributename;
            $attribute->display_attrname = $request->display_attrname;
            $attribute->is_filter  = isset($request->is_filter)?$request->is_filter:0;
            $attribute->is_dropdown  = isset($request->is_dropdown)?$request->is_dropdown:0;
            $attribute->is_description  = isset($request->is_description)?$request->is_description:0;
            $attribute->is_specification = $tab_type=="attribute_tab" ? 0 : 1;
            $attribute->created_at = new \DateTime(null, new \DateTimeZone('Asia/Kolkata'));
            $attribute->save();
            return response()->json(['status' => '200', 'action' => 'add']);
        }
        else{
            $attribute = Attribute::find($request->attribute_id);
            if ($attribute) {
                $attribute->attribute_name = $request->attributename;
                $attribute->display_attrname = $request->display_attrname;
                $attribute->is_filter  = isset($request->is_filter)?$request->is_filter:0;
                $attribute->is_dropdown  = isset($request->is_dropdown)?$request->is_dropdown:0;
                $attribute->is_description  = isset($request->is_description)?$request->is_description:0;
                $attribute->save();
                return response()->json(['status' => '200', 'action' => 'update']);
            }
            return response()->json(['status' => '400']);
        }
    }

    public function allattributeslist(Request $request){
        if ($request->ajax()) {
            $tab_type = $request->tab_type;
            $columns = array(
                0 =>'id',
                1 =>'attribute_name',
                2=> 'display_attrname',
                3=> 'terms',
                4=> 'terms',
                5=> 'estatus',
                6=> 'created_at',
                7=> 'action',
            );

            if (isset($request->tab_type)){
                $is_specification = $request->tab_type=='attribute_tab' ? 0 : 1;
            }
            else{
                $is_specification = 0;
            }

           // $totalData = Attribute::where('is_specification',$is_specification)->count();
           $totalData = Attribute::count();
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
               // $attributes = Attribute::where('is_specification',$is_specification)
                 $attributes = Attribute::
                    offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
            }
            else {
                $search = $request->input('search.value');
               // $attributes =  Attribute::where('is_specification',$is_specification)
               $attributes =  Attribute::where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                                ->orWhere('attribute_name', 'LIKE',"%{$search}%")
                                ->orWhere('display_attrname', 'LIKE',"%{$search}%")
                                ->orWhereHas('attributeterm',function ($mainQuery) use($search) {
                                    $mainQuery->where('attrterm_name', 'Like', '%' . $search . '%');
                                });
                        })
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();

                //$totalFiltered = Attribute::where('is_specification',$is_specification)
                $totalFiltered = Attribute::
                    where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                            ->orWhere('attribute_name', 'LIKE',"%{$search}%")
                            ->orWhere('display_attrname', 'LIKE',"%{$search}%")
                            ->orWhereHas('attributeterm',function ($mainQuery) use($search) {
                                $mainQuery->where('attrterm_name', 'Like', '%' . $search . '%');
                            });
                    })
                    ->count();
            }

            $data = array();

            if(!empty($attributes))
            {
                foreach ($attributes as $attribute)
                {
                    $term =  route('admin.attributeTerms.list',$attribute->id);

                    $terms = AttributeTerm::where('attribute_id',$attribute->id)->where('estatus',1)->orderBy('sorting','asc')->pluck('attrterm_name')->toArray();
                    if(isset($terms) && !empty($terms)){
                        $terms = implode(', ', $terms);
                        $terms .= '<br><br><a class="configure text-center" href="'. $term .'" target="_blank">Configure Terms</a>';
                    }
                    else{
                        $terms = '<a class="configure text-center" href="'. $term .'" target="_blank">Configure Terms</a>';
                    }

                    $page_id = ProjectPage::where('route_url','admin.attributes.list')->pluck('id')->first();

                    if($attribute->estatus==1 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="Attributestatuscheck_'. $attribute->id .'" onchange="chageAttributeStatus('. $attribute->id .')" value="1" checked="checked"><span class="slider round"></span></label>';
                    }
                    else if ($attribute->estatus==1){
                        $estatus = '<label class="switch"><input type="checkbox" id="Attributestatuscheck_'. $attribute->id .'" value="1" checked="checked"><span class="slider round"></span></label>';
                    }

                    if($attribute->estatus==2 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="Attributestatuscheck_'. $attribute->id .'" onchange="chageAttributeStatus('. $attribute->id .')" value="2"><span class="slider round"></span></label>';
                    }
                    else if ($attribute->estatus==2){
                        $estatus = '<label class="switch"><input type="checkbox" id="Attributestatuscheck_'. $attribute->id .'" value="2"><span class="slider round"></span></label>';
                    }

                    $action='';
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
                        $action .= '<button id="editAttributeBtn" class="btn btn-gray text-blue btn-sm" data-toggle="modal" data-target="#AttributeModal" onclick="" data-id="' .$attribute->id. '"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                    }
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_delete($page_id)) ){
                        $action .= '<button id="deleteAttributeBtn" class="btn btn-gray text-danger btn-sm" data-toggle="modal" data-target="#DeleteAttributeModal" onclick="" data-id="' .$attribute->id. '"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }

                    if($attribute->is_filter==1){
                        $is_filter = 'True';
                    }else{
                        $is_filter = 'False';
                    }

                    $nestedData['attribute_name'] = $attribute->attribute_name;
                    $nestedData['display_attrname'] = $attribute->display_attrname;
                    $nestedData['terms'] = $terms;
                    $nestedData['is_filter'] = $is_filter;
                    $nestedData['estatus'] = $estatus;
                    $nestedData['created_at'] = date('d-m-Y h:i A', strtotime($attribute->created_at));
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

    public function editattribute($id){
        $attribute = Attribute::find($id);
        return response()->json($attribute);
    }

    public function deleteattribute($id){
        $attribute = Attribute::find($id);
        if ($attribute){
            $attribute->estatus = 3;
            $attribute->save();

            $attribute->delete();
            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '400']);
    }

    public function chageattributestatus($id){
        $attribute = Attribute::find($id);
        if ($attribute->estatus==1){
            $attribute->estatus = 2;
            $attribute->save();
            return response()->json(['status' => '200','action' =>'deactive']);
        }
        if ($attribute->estatus==2){
            $attribute->estatus = 1;
            $attribute->save();
            return response()->json(['status' => '200','action' =>'active']);
        }
    }
}
