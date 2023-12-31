<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageDL extends Model
{
    public $table = 'images_dl';
    
    protected $fillable = [
        'imageDL',
    ];
}
