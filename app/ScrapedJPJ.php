<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScrapedJPJ extends Model
{
    public $table = 'scraped_dl';
    
    protected $fillable = [
        'jpj_name', 'jpj_ICnum', 'jpj_category'
    ];
}
