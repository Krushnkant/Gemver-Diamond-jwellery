<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SuggestionResource extends JsonResource
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

        return [
            'user_id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'profile_pic' => isset($this->profile_pic) ? 'public/images/profile_pic/'.$this->profile_pic : 'public/images/default_avatar.jpg',
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'cover_pictures' => $cover_photos
        ];
    }
}
