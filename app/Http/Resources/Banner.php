<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BannerImage as BannerImageResource;
use App\Classes\ImageObj;

class Banner extends JsonResource
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
                'type' => 'banner',
                'banner_id' => $this->id,
                'attributes' => [
                    'banner_info_one' => $this->banner_info_one,
                    'banner_info_two' => $this->banner_info_two,
                    'banner_info_three' => $this->banner_info_three,
                    'banner_image' => new BannerImageResource(new ImageObj($this->banner_image)),
                ],
            ],
            'links' => [
                'self' => url('/auth/banner'),
            ]
        ];
    }
}
