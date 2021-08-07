<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
class formsjob extends Model
{
    public $table = 'formsjob';
    protected $fillable = [
        'id','job_id' , 'field','type','position'
      ];
      public function job()
      {
          return $this->belongsTo(jobs::class, 'job_id');
      }
}
