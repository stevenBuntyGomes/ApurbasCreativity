<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FooterImage extends JsonResource
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
                'type' => 'footer-social-image',
                // 'user_image_id' => $this->id,
                'attributes' => [
                    'image_name' => $this->image,
                    'path' => url('./storage/footer' . '/' . $this->image),
                ]
            ],

            'links' => [
                'self' => url('/auth/footer-image' . '/' . $this->image),
            ]
        ];
    }
}
