<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class companies extends Model

{
    use SoftDeletes;
    
    protected $fillable = [
        'id', 'name'
    ];
    public function jobs()
    {
        return $this->hasMany(Job::class, 'company_id', 'id');
    }
}
