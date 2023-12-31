<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InputDL extends Model
{
    public $table = 'input_dl';
    
    protected $fillable = [
        'input_dlName', 'input_dlNationality', 'input_dlID', 'input_dlClass', 'input_dlValidity', 'input_dlAddress', 'input_dlResult'
    ];
}
