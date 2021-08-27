<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applications extends Model
{
    protected $fillable = [
        'id', 'user_id' , 'file_id' , 'job_id'
    ];
}
