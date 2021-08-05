<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Image;

class ImageCategory extends Model
{
    protected $guarded = [];


    public function hasManyImages(){
        return $this->hasMany(Image::class);
    }
}
