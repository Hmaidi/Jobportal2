<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\jobs;
use App\categoryjob;


class categories extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'id', 'name'
    ];
    public function jobs()
    {
        return $this->belongsToMany('App\jobs')->using('App\categoryjob');
    }
}
