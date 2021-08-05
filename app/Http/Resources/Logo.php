<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\LogoImage as LogoImageResource;
use App\Classes\ImageObj;

class Logo extends JsonResource
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
                'type' => 'Logo',
                'logo_id' => $this->id,
                'attributes' => [
                    'logo_name' => $this->logo_name,
                    'logo_image' => new LogoImageResource(new ImageObj($this->logo_image)),
                ],
            ],
            'links' => [
                'self' => url('/auth/banner'),
            ]
        ];
    }
}
