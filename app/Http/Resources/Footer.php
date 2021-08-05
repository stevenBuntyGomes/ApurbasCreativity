<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Footer extends JsonResource
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
                'footer_id' => $this->id,
                'attributes' => [
                    'site_name' => $this->site_name,
                    'site_note' => $this->site_note,
                    'site_address' => $this->site_address,
                    'site_city' => $this->site_city,
                    'site_email' => $this->site_email,
                    'site_contact' => $this->site_contact,
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
