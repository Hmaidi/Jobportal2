<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\categories;
class jobs extends Model
{
  
    public $table = 'job';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'salary',
        'company_id',
        'contract_id',
        'internal_reference',
        'expiry_date',
        'experience',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'location_id',
        'requirements',
        'description',
    ];

    public function company()
    {
        return $this->belongsTo(companies::class, 'company_id');
    }

    public function location()
    {
        return $this->belongsTo(locations::class, 'location_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\categories')->using('App\categoryjob')->withPivot([
        'job_id',
        'category_id',
    ]);
}
}
