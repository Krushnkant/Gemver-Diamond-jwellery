<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\ProjectPage;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    private $page = "Review";

    public function index(){
        $action = "list";
        return view('admin.review.list',compact('action'))->with('page',$this->page);
    }

    public function create($id){
        $action = "create";
        return view('admin.review.create',compact('action','id'))->with('page',$this->page);
    }

    public function save(Request $request){
        $messages = [
            'reviewer.required' =>'Please provide a Reviewer ',
            'ratingStar.required' =>'Please provide a rating Star',
        ];
        
        
        $validator = Validator::make($request->all(), [
            'reviewer' =>'required',
            'ratingStar' =>'required',
        ], $messages);
       

     
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        }

        if (isset($request->action) && $request->action=="update"){
            $action = "update";
            $review = Review::find($request->review_id);

            if(!$review){
                return response()->json(['status' => '400']);
            }

            if ($review->banner_thumb != $request->catImg){
                if(isset($review->banner_thumb)) {
                    $image = public_path($review->banner_thumb);
                    if (file_exists($image)) {
                        unlink($image);
                    }
                }
                $review->review_imgs = $request->catImg;
            }
            $review->reviewer = $request->reviewer;
            $review->description = $request->reviewText;
            $review->rating = $request->ratingStar;
           
        }
        else{
            $action = "add";
            $review = new Review();
            $review->user_id = 1;
            $review->reviewer = $request->reviewer;
            $review->description = $request->reviewText;
            $review->rating = $request->ratingStar;
            $review->item_id = $request->product;
            $review->review_imgs = $request->catImg;
           
        }
        $review->save();
        return response()->json(['status' => '200', 'action' => $action]);
    }

    public function allReviewlist(Request $request){
        if ($request->ajax()) {
            $columns = array(
                0 =>'sr_no',
                1 =>'image',
                2 => 'product',
                3 => 'user',
                4 => 'review_image',
                5 => 'review_text',
                6 => 'review_rating',
              //  7 => 'estatus',
                7 => 'created_at',
                8 => 'action',
            );

            $tab_type = $request->tab_type;
            if ($tab_type == "fake_review_tab"){
                $order_status = 1;
            }
            elseif ($tab_type == "real_review_tab"){
                $order_status = 2;
            }

            $totalData = Review::count();
            if (isset($order_status) && $order_status == 1){
                $totalData = Review::where('user_id',1)->count();
            }else if(isset($order_status) && $order_status == 2){
                $totalData = Review::where('user_id','<>',1)->count();
            }


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
                $reviews = Review::where('estatus',1);
                if (isset($order_status) && $order_status == 1){
                    $reviews = $reviews->where('user_id',1);
                }else if(isset($order_status) && $order_status == 2){
                    $reviews = $reviews->where('user_id','<>',1);
                }
                $reviews = $reviews->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
              
            }
            else {
                $search = $request->input('search.value');
                $reviews =  Review::where('estatus',1);
                if (isset($order_status) && $order_status == 1){
                    $reviews = $reviews->where('user_id',1);
                }else if(isset($order_status) && $order_status == 2){
                    $reviews = $reviews->where('user_id','<>',1);
                }
                $reviews = $reviews->Where('reviewer', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
                $totalFiltered = Review::Where('reviewer', 'LIKE',"%{$search}%")
                    ->count();
            }
            //dd($reviews);
            $data = array();

            if(!empty($reviews))
            {
                foreach ($reviews as $review)
                {
                    $page_id = ProjectPage::where('route_url','admin.banners.list')->pluck('id')->first();
                    
                    $product = ProductVariant::with('product')->where('id',$review->item_id)->first();
                    
                    // if( $review->estatus==1 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                    //     $estatus = '<label class="switch"><input type="checkbox" id="bannerstatuscheck_'. $review->id .'" onchange="chagebannerstatus('. $review->id .')" value="1" checked="checked"><span class="slider round"></span></label>';
                    // }
                    // elseif ($review->estatus==1){
                    //     $estatus = '<label class="switch"><input type="checkbox" id="bannerstatuscheck_'. $review->id .'" value="1" checked="checked"><span class="slider round"></span></label>';
                    // }

                    // if( $review->estatus==2 && (getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id))) ){
                    //     $estatus = '<label class="switch"><input type="checkbox" id="bannerstatuscheck_'. $review->id .'" onchange="chagebannerstatus('. $review->id .')" value="2"><span class="slider round"></span></label>';
                    // }
                    // elseif ($review->estatus==2){
                    //     $estatus = '<label class="switch"><input type="checkbox" id="bannerstatuscheck_'. $review->id .'" value="2"><span class="slider round"></span></label>';
                    // }

                    if(isset($product->images) && $product->images!=null){
                        $images = explode(',',$product->images);
                    }

                    if(isset($review->review_imgs) && $review->review_imgs!=null){
                        $thumb_path = url($review->review_imgs);
                    }

                    $action='';
                    if($review->status == 0){
                        $action .= '<button id="AcceptBtn" onclick="acceptstatus('. $review->id .')" class="btn btn-gray text-blue btn-sm" data-id="' .$review->id. '">Accept</button>';
                        $action .= '<button id="Reject" onclick="rejectstatus('. $review->id .')" class="btn btn-gray text-blue btn-sm" data-id="' .$review->id. '">Reject</button>';
                    }else if($review->status == 1){
                        $action .= 'Accept';
                    }else{
                        $action .= 'Reject';
                    }
                    // if ( getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) ){
                    //     $action .= '<button id="editBannerBtn" class="btn btn-gray text-blue btn-sm" data-id="' .$review->id. '"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                    // }
                    // if ( getUSerRole()==1 || (getUSerRole()!=1 && is_delete($page_id)) ){
                    //     $action .= '<button id="deleteBannerBtn" class="btn btn-gray text-danger btn-sm" data-toggle="modal" data-target="#DeleteBannerModal" onclick="" data-id="' .$review->id. '"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                    // }
                    $nestedData['image'] = '<img src="'. url($images[0]) .'" width="50px" height="50px" alt="Thumbnail">';
                    $nestedData['product'] = $product->product->product_title;
                    $nestedData['user'] = $review->reviewer ;
                    $nestedData['review_image'] = '<img src="'. $thumb_path .'" width="50px" height="50px" alt="Thumbnail">';
                    $nestedData['review_text'] = $review->description;
                    $nestedData['review_rating'] = $review->rating .' <i class="fa fa-star checked"></i>';
                   // $nestedData['estatus'] = $estatus;
                    $nestedData['created_at'] = date('d-m-Y h:i A', strtotime($review->created_at));
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

    public function rejectstatus($id){
        $review = Review::find($id);
        $review->status = 2;
        $review->save();
        return response()->json(['status' => '200']);
       
    }

    public function acceptstatus($id){
        $review = Review::find($id);
        $review->status = 1;
        $review->save();

       // dd($review->item_id);

        $productvariant = ProductVariant::find($review->item_id);

        if($productvariant){
            $product_rating = (($productvariant->total_rate_value + $review->rating)/($productvariant->total_review + 1));
            $productvariant->total_review = $productvariant->total_review + 1;
            $productvariant->total_rate_value = $productvariant->total_rate_value + $review->rating;
            $productvariant->product_rating = $product_rating;
            $productvariant->save();
        }



        return response()->json(['status' => '200']);
       
    }
}
