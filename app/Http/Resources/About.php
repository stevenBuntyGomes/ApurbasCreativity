<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AboutImage as AboutImageResource;
use App\Classes\ImageObj;

class About extends JsonResource
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
                'about_id' => $this->id,
                'attributes' => [
                    'about_header' => $this->about_header,
                    'about_title' => $this->about_title,
                    'about_title_two' => $this->about_title_two,
                    'about_description' => $this->about_description,
                    'about_image' => new AboutImageResource(new ImageObj($this->about_image)),
                    'about_button' => $this->about_button,
                ],
            ],
            'links' => [
                'self' => url('/auth/about'),
            ]
        ];
    }
}
