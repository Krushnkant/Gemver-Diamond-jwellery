<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\ProjectPage;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function AddReview(Request $request){
        // $messages = [
        //     'reviewer.required' =>'Please provide a Reviewer ',
        //     'ratingStar.required' =>'Please provide a rating Star',
        // ];
        
        
        // $validator = Validator::make($request->all(), [
        //     'reviewer' =>'required',
        //     'ratingStar' =>'required',
        // ], $messages);
       

     
        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors(),'status'=>'failed']);
        // }

        
        $action = "add";
        $review = new Review();
        $review->user_id = session('customer.id');
        //$review->reviewer = $request->reviewer;
        $review->description = $request->reviewText;
        $review->rating = $request->rating;
        $review->item_id = $request->item_id;
        $review->order_item_id = $request->order_item_id;
        $review->type = $request->type;
      
        // if ($request->hasFile('review_pic')) {
        //     $image = $request->file('profile_pic');
        //     $image_name = 'profilePic_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
        //     $destinationPath = public_path('images/profile_pic');
        //     $image->move($destinationPath, $image_name);
        //     if(isset($old_image)) {
        //         $old_image = public_path('images/profile_pic/' . $old_image);
        //         if (file_exists($old_image)) {
        //             unlink($old_image);
        //         }
        //     }
        //     $review->review_imgs = 'images/profile_pic/'.$image_name;
        // }

        if ($request->hasFile('review_pic')) {
            $images = $request->file('review_pic');
            $rimages = [];
            foreach ($images as $image) {
                $image_name = 'ReviewImg_' . rand(111111, 999999) . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('images/categoryThumb');
                $image->move($destinationPath, $image_name);
                $rimages[]  = 'images/categoryThumb/'.$image_name;
            }
            $review->review_imgs =  implode(',',$rimages); 
        }
        $review->save();

        $OrderItem = OrderItem::find($review->order_item_id);
        if($OrderItem){
            $OrderItem->is_review = 1;
            $OrderItem->save();
        }

        return response()->json(['status' => '200', 'action' => $action]);
    }

    function load_data(Request $request)
    {
     if($request->ajax())
     {
      $vatid = $request->variant_id;
      if($request->id > 0)
      {
       $data = Review::where('id', '<', $request->id)->where('status',1)->where('type',0)->where('item_id',$vatid)
          ->orderBy('id', 'DESC')
          ->limit(6)
          ->get();
      }
      else
      {
       $data = Review::where('status',1)->where('type',0)->where('item_id',$vatid)->orderBy('id', 'DESC')
          ->limit(6)
          ->get();
      }
      $output = '';
      $last_id = '';
      
      if(!$data->isEmpty())
      {
       foreach($data as $product_review)
       {
        $output .= '<div class="col-md-6 mb-4 ps-0 pe-0 pe-md-3">
        <div class="review_box">
            <div class="row">
                <div class="col-6 ps-0 review_heading">
                    '.$product_review->reviewer.'
                </div>
                <div class="col-6 text-end review_star pe-0">';
                for($x = 1; $x <= 5; $x++){
                    if($x <= $product_review->rating){
                        $output .= '<i class="fa-solid fa-star"></i>';
                    }else{
                        $output .= '<i class="fa-regular fa-star"></i>';
                    }
                } 
                
                $output .= '</div>
            </div>
            <div class="review_description_paragraph">
               '.$product_review->description.'
            </div>
            <div class="review_thumb_part mt-3">';
            $review_images = explode(',',$product_review->review_imgs);
            foreach($review_images as $review_image){
                    
                $output .=  '<img src='. url($review_image) .' id="inquiry_image" alt="" class="review_thumb_part_img">'; 
                   
            } 

           $output .=  '</div>
        </div>
    </div>';
        $last_id = $product_review->id;
       }
       $output .= '
      
       <div class="text-end">
            <button type="button" class="btn show_more_btn" data-id="'.$last_id.'" id="load_more_button">Show more</button>
        </div>
       ';
      }
      echo $output;
     }
    }


}
