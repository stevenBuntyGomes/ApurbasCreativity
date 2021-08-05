<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Contact extends JsonResource
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
                'type' => 'Contact',
                'contact_id' => $this->id,
                'attributes' => [
                    'contact_name' => $this->contact_name,
                    'contact_email' => $this->contact_email,
                    'contact_description' => $this->contact_description,
                ],
            ],
            'links' => [
                'self' => url('/auth/banner'),
            ]
        ];
    }
}
