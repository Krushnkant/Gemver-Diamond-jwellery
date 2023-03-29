<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\StepPopup;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProjectPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;

class CategoryController extends Controller
{
    private $page = "Category";

    public function index(){
        $action = "list";
        $categories = Category::where('estatus',1)->get();
        return view('admin.categories.list',compact('action','categories'))->with('page',$this->page);
    }

    public function create(){
        $action = "create";

        $categories = Category::where('estatus',1)->where('is_custom',0)->get()->toArray();
        $sr_no = Category::where('estatus',1)->orderBy('sr_no','desc')->pluck('sr_no')->first();
        $attributes = Attribute::where('estatus',1)->where('is_specification',0)->get()->toArray();
        $specifications = Attribute::where('estatus',1)->where('is_specification',1)->get()->toArray();
        return view('admin.categories.list',compact('action','categories','sr_no','attributes','specifications'))->with('page',$this->page);
    }

    public function save(Request $request){
        $messages = [
            'sr_no.required' =>'Please provide valid Serial Number',
            'sr_no.numeric' =>'Please provide valid Serial Number',
            'category_name.required' =>'Please provide a Category Name',
            'catImg.required' =>'Please provide a Category Image',
        ];

        if(isset($request->action) && $request->action=="update"){
            $validator = Validator::make($request->all(), [
                'sr_no' => 'required|numeric',
                'category_name' => 'required',
                'catImg' => 'required',
            ], $messages);
        }
        else{
            $validator = Validator::make($request->all(), [
                'sr_no' => 'required|numeric',
                'category_name' => 'required',
                'catImg' => 'required',
            ], $messages);
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }
         
        if(isset($request->action) && $request->action=="update"){
            $action = "update";
            $category = Category::find($request->category_id);

            if(!$category){
                return response()->json(['status' => '400']);
            }

            if ($category->category_thumb != $request->catImg){
                if(isset($category->category_thumb)) {
                    $image = public_path($category->category_thumb);
                    if (file_exists($image)) {
                        unlink($image);
                    }
                }
                $category->category_thumb = $request->catImg;

            }
            $category->slug = $request->slug;
            $category->sr_no = $request->sr_no;
            $category->category_name = $request->category_name;
            $category->parent_category_id = isset($request->parent_category_id)?$request->parent_category_id:0;
            $category->is_custom = isset($request->is_custom)?$request->is_custom:0;
            $category->meta_title = $request->meta_title;
            $category->meta_description = $request->meta_description;
            

            // if (isset($request->attribute_id_variation) && !empty($request->attribute_id_variation)){
            //     $attribute_id_variation = implode(",",$request->attribute_id_variation);
            //     $category->attribute_id_variation = $attribute_id_variation;
            // }
            // else{
            //     $category->attribute_id_variation = null;
            // }

            // if (isset($request->attribute_id_req_spec) && !empty($request->attribute_id_req_spec)){
            //     $attribute_id_req_spec = implode(",",$request->attribute_id_req_spec);
            //     $category->attribute_id_req_spec = $attribute_id_req_spec;
            // }
            // else{
            //     $category->attribute_id_req_spec = null;
            // }

            // if (isset($request->attribute_id_opt_spec) && !empty($request->attribute_id_opt_spec)){
            //     $attribute_id_opt_spec = implode(",",$request->attribute_id_opt_spec);
            //     $category->attribute_id_opt_spec = $attribute_id_opt_spec;
            // }
            // else{
            //     $category->attribute_id_opt_spec = null;
            // }
        }
        else{
            $action = "add";
            $category = new Category();
            $category->sr_no = $request->sr_no;
            $category->slug = $request->slug;
            $category->category_name = $request->category_name;
            $category->parent_category_id = isset($request->parent_category_id)?$request->parent_category_id:0;
            $category->is_custom = isset($request->is_custom)?$request->is_custom:0;
            $category->created_at = new \DateTime(null, new \DateTimeZone('Asia/Kolkata'));
            $category->category_thumb = $request->catImg;
            $category->meta_title = $request->meta_title;
            $category->meta_description = $request->meta_description;
         
            // if (isset($request->attribute_id_variation) && !empty($request->attribute_id_variation)){
            //     $attribute_id_variation = implode(",",$request->attribute_id_variation);
            //     $category->attribute_id_variation = $attribute_id_variation;
            // }

            // if (isset($request->attribute_id_req_spec) && !empty($request->attribute_id_req_spec)){
            //     $attribute_id_req_spec = implode(",",$request->attribute_id_req_spec);
            //     $category->attribute_id_req_spec = $attribute_id_req_spec;
            // }

            // if (isset($request->attribute_id_opt_spec) && !empty($request->attribute_id_opt_spec)){
            //     $attribute_id_opt_spec = implode(",",$request->attribute_id_opt_spec);
            //     $category->attribute_id_opt_spec = $attribute_id_opt_spec;
            // }
        }

        $category->save();

        $mainparentid = $this->getMainCategory($category->id);
         
         
        if (isset($request->action) && $request->action!="update"){
            $category =Category::find($category->id);
            $category->mainparentid = $mainparentid;
            $category->save();

            for($i = 1; $i < 4; $i++){
                $StepPopup = new StepPopup();
                $StepPopup->category_id = $category->id;
                $StepPopup->save();
           }
        }    


        return response()->json(['status' => '200', 'action' => $action]);
    }

    public function allcategorylist(Request $request){
        if ($request->ajax()) {
            $columns = array(
                0 =>'sr_no',
                1 =>'category_thumb',
                2 => 'category_name',
                3 => 'total_products',
                4 => 'estatus',
                5 => 'created_at',
                6 => 'action',
            );
            $totalData = Category::count();
            
            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            if($order == "sr_no"){
                $order = "created_at";
                $dir = 'desc';
            }

            if(empty($request->input('search.value')))
            {
                $categories = Category::offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
              
            }
            else {
                $search = $request->input('search.value');
                $categories =  Category::where('sr_no','LIKE',"%{$search}%")
                    ->orWhere('category_name', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();


                $totalFiltered = Category::where('sr_no','LIKE',"%{$search}%")
                    ->orWhere('category_name', 'LIKE',"%{$search}%")
                    ->count();
          
            }

            $data = array();

            if(!empty($categories))
            {
                foreach ($categories as $category)
                {
                    $page_id = ProjectPage::where('route_url','admin.categories.list')->pluck('id')->first();

                    if( $category->estatus==1 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="CategoryStatuscheck_'. $category->id .'" onchange="chageCategoryStatus('. $category->id .')" value="1" checked="checked"><span class="slider round"></span></label>';
                    }
                    elseif ($category->estatus==1){
                        $estatus = '<label class="switch"><input type="checkbox" id="CategoryStatuscheck_'. $category->id .'" value="1" checked="checked"><span class="slider round"></span></label>';
                    }

                    if( $category->estatus==2 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="CategoryStatuscheck_'. $category->id .'" onchange="chageCategoryStatus('. $category->id .')" value="2"><span class="slider round"></span></label>';
                    }
                    elseif ($category->estatus==2){
                        $estatus = '<label class="switch"><input type="checkbox" id="CategoryStatuscheck_'. $category->id .'" value="2"><span class="slider round"></span></label>';
                    }

                    if(isset($category->category_thumb) && $category->category_thumb!=null){
                        $thumb_path = url($category->category_thumb);
                    }

                    $action='';
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
                        $action .= '<button id="editCategoryBtn" class="btn btn-gray text-blue btn-sm" data-id="' .$category->id. '"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                    }
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_delete($page_id)) ){
                        $action .= '<button id="deleteCategoryBtn" class="btn btn-gray text-danger btn-sm" data-toggle="modal" data-target="#DeleteCategoryModal" onclick="" data-id="' .$category->id. '"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
                        if($category->is_custom == 1){
                            $action .= '<button id="viewpopCategoryBtn" class="btn btn-gray text-blue btn-sm" data-id="' .$category->id. '">step popup</button>';
                        }
                    }
                    $nestedData['category_thumb'] = '<img src="'. $thumb_path .'" width="50px" height="50px" alt="Thumbnail">';
                    $nestedData['category_name'] = $category->category_name;
                    $nestedData['total_products'] = $category->total_products;
                    $nestedData['estatus'] = $estatus;
                    $nestedData['created_at'] = date('d-m-Y h:i A', strtotime($category->created_at));
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

    public function changecategorystatus($id){
        $category = Category::find($id);
        if ($category->estatus==1){
            $category->estatus = 2;
            $category->save();
            return response()->json(['status' => '200','action' =>'deactive']);
        }
        if ($category->estatus==2){
            $category->estatus = 1;
            $category->save();
            return response()->json(['status' => '200','action' =>'active']);
        }
    }

    public function deletecategory($id){
        $subcategory = Category::where('parent_category_id',$id)->first();
            if(!$subcategory){
            $products = Product::whereRaw('FIND_IN_SET('.$id.',primary_category_id)')->get();
            foreach($products as $product){
            $catarray = explode(",",$product->primary_category_id);
            $pos = array_search($id, $catarray);
                if($pos !== false) {
                    unset($catarray[$pos]);
                }
                if(count($catarray) > 0 ){
                    $catstring = implode(",",$catarray);
                    Product::where('id', $product->id)->update(array('primary_category_id' => $catstring));
                }else{
                    $product = Product::find($product->id);
                    $product->estatus = 3;
                    $product->save();
                    $product->delete();
                    
                    $productvariants =ProductVariant::where('product_id',$product->id)->get(['id']);
                    foreach($productvariants as $variant){
                        $productvariant = ProductVariant::find($variant->id);
                        $productvariant->estatus = 3;
                        $productvariant->save();
                        $productvariant->delete();
                    }
                }
            }
            $category = Category::find($id);
            if ($category){
                $image = $category->category_thumb;
                $category->estatus = 3;
                $category->save();

                $category->delete();
                $image = public_path($image);
                if (file_exists($image)) {
                    unlink($image);
                }
                return response()->json(['status' => '200']);
            }
            return response()->json(['status' => '400']);
       }else{
        return response()->json(['status' => '300']);
       }
    }

    public function editcategory($id){
        $action = "edit";
        $categories = Category::where('estatus',1)->where('id',"!=",$id)->where('parent_category_id',"!=",$id)->get()->toArray();
        $category = Category::find($id);
        $attributes = Attribute::where('estatus',1)->where('is_specification',0)->get()->toArray();
        $specifications = Attribute::where('estatus',1)->where('is_specification',1)->get()->toArray();

        // $parent_category_data = Category::where('id',$category->parent_category_id)->pluck('parent_category_id')->first();
        // $is_sub_child = false;
        // if ($parent_category_data != 0){
        //     $is_sub_child = true;
        // }
        return view('admin.categories.list',compact('action','category','attributes','specifications','categories'))->with('page',$this->page);
    }

    public function uploadfile(Request $request){
        if(isset($request->action) && $request->action == 'uploadCatIcon'){
            if ($request->hasFile('files')) {
                $image = $request->file('files')[0];
                $image_name = 'categoryThumb_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
                
                //$destinationPath = public_path('images/categoryThumb');
                    // $image->move($destinationPath, $image_name);

                // $img = Image::make($image->getRealPath());
                // $img->resize(800, 800, function ($constraint) {
                //     $constraint->aspectRatio();
                // })->save($destinationPath.'/'.$image_name);
        
                // $destinationPath = public_path('/images');

                $destinationPath = public_path('images/categoryThumb/'.$image_name);
                $imageTemp = $_FILES["files"]["tmp_name"][0];
              
                if($_FILES["files"]["size"][0] > 500000){
                    compressImage($imageTemp, $destinationPath, 90);
                }else{
                    $destinationPath = public_path('images/categoryThumb');
                    $image->move($destinationPath, $image_name);  
                }
                //$image->move($destinationPath, $image_name);
                
                
                return response()->json(['data' => 'images/categoryThumb/'.$image_name]);
            }
        }
    }

    public function removefile(Request $request){
        if(isset($request->action) && $request->action == 'removeCatIcon'){
            $image = $request->file;
            if(isset($image)) {
                $image = public_path($request->file);
                if (file_exists($image)) {
                    unlink($image);
                    return response()->json(['status' => '200']);
                }
            }
        }
    }

    public function createSlug($title, $id = 0)
    {
        $slug = str_slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);
    }
    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Category::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }

    public $catid = 0;
    function getMainCategory($id){
        $category = \App\Models\Category::where('estatus',1)->where('id',$id)->first();
        if($category->parent_category_id != 0){
            $this->getMainCategory($category->parent_category_id);
        }else{
            $this->catid = $category->id; 
        }
        return  $this->catid;
    }


}
