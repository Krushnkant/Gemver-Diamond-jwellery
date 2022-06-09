<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectPage;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    private $page = "Testimonials";

    public function index(){
        return view('admin.testimonials.list')->with('page',$this->page);
    }

    public function alltestimonialslist(Request $request){
     
        if ($request->ajax()) {
            $tab_type = $request->tab_type;
            if ($tab_type == "active_testimonial_tab"){
                $estatus = 1;
            }
            elseif ($tab_type == "deactive_testimonial_tab"){
                $estatus = 2;
            }

            $columns = array(
                0 =>'id',
                1 =>'image',
                2=> 'name',
                3=> 'country',
                4=> 'estatus',
                5=> 'action',
            );

            $totalData = Testimonial::count();
            if (isset($estatus)){
                $totalData = Testimonial::where('estatus',$estatus)->count();
                //dd($totalData);
                //$wordlist = Testimonial::where('estatus', '=', $estatus)->get();
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
                
                $testimonials = Testimonial::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir);
                //->get();
                 //dd($estatus);

                if (isset($estatus)){
                    $testimonials = $testimonials->where('estatus',$estatus);
                }
                $testimonials = $testimonials->get();
                //dd($testimonials);
            }
            else {
                $search = $request->input('search.value');
                $testimonials =  Testimonial::where(function($query) use($search){
                    $query->where('id','LIKE',"%{$search}%")
                          ->orWhere('name', 'LIKE',"%{$search}%")
                          ->orWhere('country', 'LIKE',"%{$search}%");
                    })
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
                if (isset($estatus)){
                    $testimonials = $testimonials->where('estatus',$estatus)->where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                              ->orWhere('name', 'LIKE',"%{$search}%")
                              ->orWhere('country', 'LIKE',"%{$search}%");
                        })
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get();
                }

                $totalFiltered = Testimonial::where(function($query) use($search){
                    $query->where('id','LIKE',"%{$search}%")
                         ->orWhere('name', 'LIKE',"%{$search}%")
                         ->orWhere('country', 'LIKE',"%{$search}%");
                    })->count();
                if (isset($estatus)){
                    $totalFiltered = $totalFiltered->where('estatus',$estatus)->where(function($query) use($search){
                        $query->where('id','LIKE',"%{$search}%")
                             ->orWhere('name', 'LIKE',"%{$search}%")
                             ->orWhere('country', 'LIKE',"%{$search}%");
                        })->count();
                }
               
            }
            $data = array();

            if(!empty($testimonials))
            {
                foreach ($testimonials as $testimonial)
                {
                    $page_id = ProjectPage::where('route_url','admin.users.list')->pluck('id')->first();

                    if( $testimonial->estatus==1 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="testimonialstatuscheck_'. $testimonial->id .'" onchange="changetestimonialStatus('. $testimonial->id .')" value="1" checked="checked"><span class="slider round"></span></label>';
                    }
                    elseif ($testimonial->estatus==1){
                        $estatus = '<label class="switch"><input type="checkbox" id="testimonialstatuscheck_'. $testimonial->id .'" value="1" checked="checked"><span class="slider round"></span></label>';
                    }

                    if( $testimonial->estatus==2 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                        $estatus = '<label class="switch"><input type="checkbox" id="testimonialstatuscheck_'. $testimonial->id .'" onchange="changetestimonialStatus('. $testimonial->id .')" value="2"><span class="slider round"></span></label>';
                    }
                    elseif ($testimonial->estatus==2){
                        $estatus = '<label class="switch"><input type="checkbox" id="testimonialstatuscheck_'. $testimonial->id .'" value="2"><span class="slider round"></span></label>';
                    }

                    if(isset($testimonial->image) && $testimonial->image!=null){
                        $image = asset('images/testimonials/'.$testimonial->image);
                    }
                    else{
                        $image = asset('images/default_avatar.jpg');
                    }

                    $action='';
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
                        $action .= '<button id="editTestimonialBtn" class="btn btn-gray text-blue btn-sm" data-toggle="modal" data-target="#TestimonialModel" onclick="" data-id="' .$testimonial->id. '"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                    }
                    if ( getUSerRole()==1 || (getUSerRole()!=1 && is_delete($page_id)) ){
                        $action .= '<button id="deleteTestimonialBtn" class="btn btn-gray text-danger btn-sm" data-toggle="modal" data-target="#DeleteTestimonialModel" onclick="" data-id="' .$testimonial->id. '"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    }

                 
                    $nestedData['image'] = '<img src="'. $image .'" width="50px" height="50px" alt="Profile Pic">';
                    $nestedData['name'] = $testimonial->name;
                    $nestedData['country'] = $testimonial->country;
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

    public function addorupdatetestimonial(Request $request){
        $messages = [
            'profile_pic.image' =>'Please provide a Valid Extension Image(e.g: .jpg .png)',
            'profile_pic.mimes' =>'Please provide a Valid Extension Image(e.g: .jpg .png)',
            'name.required' =>'Please provide a Name',
            'country.required' =>'Please provide a Country.',
            'description.required' =>'Please provide a Description.',
        ];

        if (isset($request->action) && $request->action=="update"){
            $validator = Validator::make($request->all(), [
                'profile_pic' => 'image|mimes:jpeg,png,jpg',
                'name' => 'required',
                'country' => 'required',
                'description' => 'required',
            ], $messages);
        }
        else{
            $validator = Validator::make($request->all(), [
                'profile_pic' => 'image|mimes:jpeg,png,jpg',
                'name' => 'required',
                'country' => 'required',
                'description' => 'required',
            ], $messages);
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        if(isset($request->action) && $request->action=="update"){
            $action = "update";
            $testimonial = Testimonial::find($request->testimonial_id);

            if(!$testimonial){
                return response()->json(['status' => '400']);
            }

            $old_image = $testimonial->profile_pic;
            $image_name = $old_image;
            $testimonial->name = $request->name;
            $testimonial->country = $request->country;
            $testimonial->description = $request->description;
           
        }
        else{
            $action = "add";
            $testimonial = new Testimonial();
            $testimonial->name = $request->name;
            $testimonial->country = $request->country;
            $testimonial->description = $request->description;
            $testimonial->created_at = new \DateTime(null, new \DateTimeZone('Asia/Kolkata'));
            $image_name=null;
        }

        if ($request->hasFile('profile_pic')) {
            $image = $request->file('profile_pic');
            $image_name = 'Testimonial_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/testimonials');
            $image->move($destinationPath, $image_name);
            if(isset($old_image)) {
                $old_image = public_path('images/testimonials/' . $old_image);
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
            }
            $testimonial->image = $image_name;
        }

        $testimonial->save();

        return response()->json(['status' => '200', 'action' => $action]);
    }

    public function edittestimonial($id){
        $testimonial = Testimonial::find($id);
        return response()->json($testimonial);
    }

    public function deletetestimonial($id){
        $testimonial = Testimonial::find($id);
        if ($testimonial){
            $image = $testimonial->image;
            $testimonial->estatus = 3;
            $testimonial->save();

            $testimonial->delete();

            $image = public_path('images/testimonials/' . $image);
            if (file_exists($image)) {
                unlink($image);
            }
            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '400']);
    }


    public function changetestimonialstatus($id){
        $testimonials = Testimonial::find($id);
        if ($testimonials->estatus==1){
            $testimonials->estatus = 2;
            $testimonials->save();
            return response()->json(['status' => '200','action' =>'deactive']);
        }
        if ($testimonials->estatus==2){
            $testimonials->estatus = 1;
            $testimonials->save();
            return response()->json(['status' => '200','action' =>'active']);
        }
    }
}
