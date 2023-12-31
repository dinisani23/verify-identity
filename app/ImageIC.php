<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageIC extends Model
{
    public $table = 'images';
    
    protected $fillable = [
        'image',
    ];
}
