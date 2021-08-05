<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserImage as UserImageResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'type' => 'users',
                'user_id' => $this->id,
                'attributes' => [
                    'name' => $this->name,
                    'email' => $this->email,
                    // 'cover_image' => new UserImageResource($this->coverImage),
                    'user_image' => new UserImageResource($this->profileImage),
                    // 'unread' => $this->unread, //last added
                ],
            ],
            'links' => [
                'self' => url('/auth'),
            ]
        ];
    }
}
