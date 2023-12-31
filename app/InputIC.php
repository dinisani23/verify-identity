<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InputIC extends Model
{
    public $table = 'input_data';
    
    protected $fillable = [
        'input_ID', 'input_name', 'input_address', 'input_citizenship', 'input_religion', 'input_gender','input_result'
    ];
}
