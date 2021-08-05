<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoPlaylist extends JsonResource
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
                'type' => 'video_playlist',
                'playlist_id' => $this->id,
                'attributes' => [
                    'playlist_title' => $this->playlist_title,
                    'playlist_description' => $this->playlist_description,
                    'type' => $this->type,
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at,
                ],
            ],
            'links' => [
                'self' => url('/auth/image_category'),
            ]
        ];
    }
}
