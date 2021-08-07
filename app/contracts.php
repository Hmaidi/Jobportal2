<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contracts extends Model
{
    protected $fillable = [
        'id', 'name'
    ];
    public function jobs()
    {
        return $this->hasMany(Job::class, 'contract_id', 'id');
    }
}
