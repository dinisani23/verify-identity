<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtractDL extends Model
{
    public $table = 'extracted_dl';
    
    protected $fillable = [
        'elm_one','elm_two','elm_three','elm_four','elm_five','elm_six','dl_name','dl_nationality','dl_ID','dl_class','dl_validity','dl_address'
    ];
}
