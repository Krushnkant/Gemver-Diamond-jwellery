<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\Settings;
use App\Models\UserCoverPhotos;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        $cover_photos = UserCoverPhotos::where('user_id',$this->id)->get(['id','image']);

        $categories_arr = array();
        if (isset($this->category_ids)) {
            $category_ids = explode(",", $this->category_ids);
            foreach ($category_ids as $category_id) {
                $category = Category::find($category_id);
                array_push($categories_arr, $category->title);
            }
        }

        return [
            'user_id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'profile_pic' => isset($this->profile_pic) ? $this->profile_pic : asset('images/default_avatar.jpg'),
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'category_ids' => $categories_arr,
            'description' => $this->description,
            'cover_pictures' => $cover_photos
        ];
    }
}
