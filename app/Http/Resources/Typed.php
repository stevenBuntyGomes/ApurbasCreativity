<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Typed extends JsonResource
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
                'type' => 'typed',
                'typed_id' => $this->id,
                'attributes' => [
                    'typed_name' => $this->typed_name,
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
