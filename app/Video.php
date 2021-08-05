<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $guarded = [];


    public function onePlaylist(){
        return $this->hasOne(VideoPlayList::class, 'id', 'playlist_id');
    }
}
