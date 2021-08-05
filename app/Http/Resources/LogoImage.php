<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LogoImage extends JsonResource
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
                'type' => 'logo-images',
                // 'user_image_id' => $this->id,
                'attributes' => [
                    'image_name' => $this->image,
                    'path' => url('./storage/logo' . '/' . $this->image),
                ]
            ],

            'links' => [
                'self' => url('/auth/logo-image' . '/' . $this->image),
            ]
        ];
    }
}
