<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ServiceImage as ServiceImageResource;
use App\Classes\ImageObj;

class Service extends JsonResource
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
                'type' => 'service',
                'service_id' => $this->id,
                'attributes' => [
                    'service_title' => $this->service_title,
                    'service_description' => $this->service_description,
                    'service_image' => new ServiceImageResource(new ImageObj($this->service_image)),
                ],
            ],
            'links' => [
                'self' => url('/auth/service'),
            ]
        ];
    }
}
