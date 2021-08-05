<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\FooterImage as FooterImageResource;
use App\Classes\ImageObj;

class FooterSocial extends JsonResource
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
                'type' => 'footer',
                'social_id' => $this->id,
                'attributes' => [
                    'social_name' => $this->social_name,
                    'social_link' => $this->social_link,
                    'image_name' => new FooterImageResource(new ImageObj($this->image_name)),
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at,
                ],
            ],
            'links' => [
                'self' => url('/auth/footer'),
            ]
        ];
    }
}
