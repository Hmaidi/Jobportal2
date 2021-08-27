<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class extrafieldapplication extends Model
{
    public $table = 'extrafiledsapplications';
    protected $fillable = [
        'id', 'user_id' , 'file_id' , 'job_id' , 'formsjob_id' , 'application_id' ,'value'
    ];
}
