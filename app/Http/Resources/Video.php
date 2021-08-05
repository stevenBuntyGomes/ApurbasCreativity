<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\VideoImage as VideoImageResource;
use App\Http\Resources\VideoPlaylist as VideoPlaylist;
use App\Classes\ImageObj;

class Video extends JsonResource
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
                'type' => 'video',
                'video_id' => $this->id,
                'attributes' => [
                    'video_playlist' => new VideoPlaylist($this->onePlaylist),
                    'video_name' => $this->video_name,
                    'video_link' => $this->video_link,
                    'image_name' => new VideoImageResource(new ImageObj($this->image_name)),
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
