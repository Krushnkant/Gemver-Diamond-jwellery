<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeTerm;
use App\Models\ProjectPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttributeTermsController extends Controller
{
    private $page = "Attributes & Specifications";

    public function index($id){
        $attribute = Attribute::find($id);
        $attributeName = $attribute->display_attrname;
        $isDescription = $attribute->is_description;
        $sort_no = AttributeTerm::where(['attribute_id'=>$id])->orderBy('sorting','desc')->pluck('sorting')->first();
        return view('admin.attribute_terms.list',compact('attributeName','isDescription','sort_no'))->with('page',$this->page);
    }

    public function addorupdateattributeTerm(Request $request){
        //dd($request->all());
        $messages = [
            'attributetermname.required' =>'Please provide a Term Name',
            'attrtermthumb.image' =>'Please provide a Valid Extension Image(e.g: .jpg .png)',
            'attrtermthumb.mimes' =>'Please provide a Valid Extension Image(e.g: .jpg .png)',
        ];

        $validator = Validator::make($request->all(), [
            'attributetermname' => 'required',
            'attrtermthumb' => 'image|mimes:jpeg,png,jpg',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }
        $sort_no = AttributeTerm::where(['attribute_id'=>$request->attr_id])->orderBy('sorting','desc')->pluck('sorting')->first();
        if(isset($request->action) && $request->action=="update"){
            $action = "update";
            $attr_term = AttributeTerm::find($request->attributeterm_id);
            

            if(!$attr_term){
                return response()->json(['status' => '400']);
            }

            $old_image = $attr_term->attrterm_thumb;
            $image_name = $old_image;
            $attr_term->attrterm_name = $request->attributetermname;
            $attr_term->attribute_id = $request->attr_id;
            $attr_term->description = $request->description;
            $attr_term->sorting = ($request->sorting != "")? $request->sorting : $sort_no;
        }
        else{
            $action = "add";
            $attr_term = new AttributeTerm();
            $attr_term->attrterm_name = $request->attributetermname;
            $attr_term->attribute_id = $request->attr_id;
            $attr_term->created_at = new \DateTime(null, new \DateTimeZone('Asia/Kolkata'));
            $image_name=null;
            $attr_term->description = $request->description;
            $attr_term->sorting = ($request->sorting != "")? $request->sorting : $sort_no;
        }

        if ($request->hasFile('attrtermthumb')) {
            $image = $request->file('attrtermthumb');
            $image_name = 'attrTermThumb_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            // $destinationPath = public_path('images/attrTermThumb');
            // $image->move($destinationPath, $image_name);
            $destinationPath = public_path('images/attrTermThumb/'.$image_name);
            $imageTemp = $_FILES["attrtermthumb"]["tmp_name"];
            
            if($_FILES["attrtermthumb"]["size"] > 500000){
                compressImage($imageTemp, $destinationPath, 90);
            }else{
                $destinationPath = public_path('images/attrTermThumb');
                $image->move($destinationPath, $image_name);  
            }
            if(isset($old_image)) { 
                $old_image = public_path('images/attrTermThumb/' . $old_image);
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
            }
            $attr_term->attrterm_thumb = $image_name;
        }

        $attr_term->save();

        return response()->json(['status' => '200', 'action' => $action]);
    }

    public function allattributesTermlist(Request $request){
        if ($request->ajax()) {
            $columns = array(
                0 =>'id',
                1 =>'attrterm_thumb',
                2=> 'attrterm_name',
                3=> 'estatus',
                4=> 'created_at',
                5=> 'action',
            );
            $totalData = AttributeTerm::where('attribute_id',$request->attr_id)->count();
            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            if($order == "id"){
                $order = "sorting";
                $dir = 'asc';
            }

            if(empty($request->input('search.value')))
            {
                $attributeTerms = AttributeTerm::where('attribute_id',$request->attr_id)
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
            }
            else {
                $search = $request->input('search.value');
                $attributeTerms =  AttributeTerm::where('attribute_id',$request->attr_id)
                    ->where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                            ->orWhere('attrterm_name', 'LIKE',"%{$search}%");
                    })
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
                $totalFiltered = AttributeTerm::where('attribute_id',$request->attr_id)
                    ->where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                            ->orWhere('attrterm_name', 'LIKE',"%{$search}%");
                    })
                    ->count();
            }

            $data = array();

            if(!empty($attributeTerms))
            {
//                $i=1;
                foreach ($attributeTerms as $attributeTerm)
                {
                    $page_id = ProjectPage::where('route_url','admin.attributes.list')->pluck('id')->first();

                    if( $attributeTerm->estatus==1 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="AttributeTermtatuscheck_'. $attributeTerm->id .'" onchange="chageAttributeTermStatus('. $attributeTerm->id .')" value="1" checked="checked"><span class="slider round"></span></label>';
                    }
                    elseif ($attributeTerm->estatus==1){
                        $estatus = '<label class="switch"><input type="checkbox" id="AttributeTermtatuscheck_'. $attributeTerm->id .'" value="1" checked="checked"><span class="slider round"></span></label>';
                    }

                    if( $attributeTerm->estatus==2 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="AttributeTermtatuscheck_'. $attributeTerm->id .'" onchange="chageAttributeTermStatus('. $attributeTerm->id .')" value="2"><span class="slider round"></span></label>';
                    }
                    elseif ($attributeTerm->estatus==2){
                        $estatus = '<label class="switch"><input type="checkbox" id="AttributeTermtatuscheck_'. $attributeTerm->id .'" value="2"><span class="slider round"></span></label>';
                    }

                    if(isset($attributeTerm->attrterm_thumb) && $attributeTerm->attrterm_thumb!=null){
                        $thumb_path = url('images/attrTermThumb/'.$attributeTerm->attrterm_thumb);
                    }
                    else{
                        $thumb_path = url('images/placeholder_image.png');
                    }

                    $action='';
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
                        $action .= '<button id="editAttributeTermBtn" class="btn btn-gray text-blue btn-sm" data-toggle="modal" data-target="#AttributeTermModal" onclick="" data-id="' .$attributeTerm->id. '"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                    }
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_delete($page_id)) ){
                        $action .= '<button id="deleteAttributeTermBtn" class="btn btn-gray text-danger btn-sm" data-toggle="modal" data-target="#DeleteAttributeTermModal" onclick="" data-id="' .$attributeTerm->id. '"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }
//                    $nestedData['id'] = $i;
                    $nestedData['attrterm_thumb'] = '<img src="'. $thumb_path .'" width="50px" height="50px" alt="Thumbnail">';
                    $nestedData['attrterm_name'] = $attributeTerm->attrterm_name;
                    $nestedData['estatus'] = $estatus;
                    $nestedData['created_at'] = date('d-m-Y h:i A', strtotime($attributeTerm->created_at));
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

    public function chageattributeTermstatus($id){
        $attributeTerm = AttributeTerm::find($id);
        if ($attributeTerm->estatus==1){
            $attributeTerm->estatus = 2;
            $attributeTerm->save();
            return response()->json(['status' => '200','action' =>'deactive']);
        }
        if ($attributeTerm->estatus==2){
            $attributeTerm->estatus = 1;
            $attributeTerm->save();
            return response()->json(['status' => '200','action' =>'active']);
        }
    }

    public function editattributeTerm($id){
        $attributeTerm = AttributeTerm::find($id);
        return response()->json($attributeTerm);
    }

    public function deleteattributeTerm($id){
        $attributeTerm = AttributeTerm::find($id);
        if ($attributeTerm){
            $attributeTerm->estatus = 3;
            $attributeTerm->save();

            $attributeTerm->delete();
            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '400']);
    }
}
