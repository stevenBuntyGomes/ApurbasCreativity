<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TestimonialImage as TestiImageResource;
use App\Classes\ImageObj;

class Testimonial extends JsonResource
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
                'type' => 'testimonial',
                'testimonial_id' => $this->id,
                'attributes' => [
                    'testi_name' => $this->testi_name,
                    'testi_position' => $this->testi_position,
                    'testi_description' => $this->testi_description,
                    'image_name' => new TestiImageResource(new ImageObj($this->image_name)),
                    'type' => $this->type,
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at,
                ],
            ],
            'links' => [
                'self' => url('/auth/image_category'),
            ]
        ];
    }
}
