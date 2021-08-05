<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageCategory extends JsonResource
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
                'type' => 'image_category',
                'image_category_id' => $this->id,
                'attributes' => [
                    'category_name' => $this->category_name,
                ],
            ],
            'links' => [
                'self' => url('/auth/image_category'),
            ]
        ];
    }
}
