<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Skill extends JsonResource
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
                'type' => 'Skill',
                'service_id' => $this->id,
                'attributes' => [
                    'skill_header' => $this->skill_header,
                    'language_header' => $this->language_header,
                    'first_skill' => $this->first_skill,
                    'first_skill_percent' => $this->first_skill_percent,
                    'second_skill' => $this->second_skill,
                    'second_skill_percent' => $this->second_skill_percent,
                    'third_skill' => $this->third_skill,
                    'third_skill_percent' => $this->third_skill_percent,
                    'first_language' => $this->first_language,
                    'first_language_percent' => $this->first_language_percent,
                    'second_language' => $this->second_language,
                    'second_language_percent' => $this->second_language_percent,
                    'third_language' => $this->third_language,
                    'third_language_percent' => $this->third_language_percent,
                ],
            ],
            'links' => [
                'self' => url('/auth/skills'),
            ]
        ];;
    }
}
