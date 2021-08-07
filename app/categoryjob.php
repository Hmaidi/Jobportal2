<?php

namespace App;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;

class categoryjob extends Model
{
    public $table = 'category_job';
    protected $fillable = [
        'id','job_id' , 'category_id'
      ];
}
