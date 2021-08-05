<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ImageCategory;

class Image extends Model
{
    protected $guarded = [];


    public function oneCategory(){
        return $this->hasOne(ImageCategory::class, 'id', 'image_category_id');
    }
}
