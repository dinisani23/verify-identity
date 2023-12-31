<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScrapedSPR extends Model
{
    public $table = 'scraped_data';
    
    protected $fillable = [
        'spr_name', 'spr_ICnum', 'spr_gender'
    ];
}
