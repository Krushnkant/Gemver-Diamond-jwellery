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
}
