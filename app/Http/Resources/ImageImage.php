<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageImage extends JsonResource
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
                'type' => 'image-images',
                // 'user_image_id' => $this->id,
                'attributes' => [
                    'image_name' => $this->image,
                    'path' => url('./storage/portfolio' . '/' . $this->image),
                ]
            ],

            'links' => [
                'self' => url('/auth/image-image' . '/' . $this->image),
            ]
        ];
    }
}
