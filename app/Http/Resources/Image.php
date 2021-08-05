<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ImageCategory as ImageCategoryResource;
use App\Http\Resources\ImageImage as ImageImageResource;
use App\Classes\ImageObj;

class Image extends JsonResource
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
                'type' => 'image',
                'image_id' => $this->id,
                'attributes' => [
                    'image_category' => new ImageCategoryResource($this->oneCategory),
                    'image_name' => new ImageImageResource(new ImageObj($this->image_name)),
                    // 'service_image' => new ServiceImageResource(new ImageObj($this->service_image)),
                ],
            ],
            'links' => [
                'self' => url('/auth/images'),
            ]
        ];
    }
}
