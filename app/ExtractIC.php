<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtractIC extends Model
{
    public $table = 'extracted_data';
    
    protected $fillable = [
        'el_one','el_two','el_three','el_four','el_five','el_six','IDnum','name','address','citizenship','religion','gender'
    ];
}
