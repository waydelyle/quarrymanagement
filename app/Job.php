<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';

    protected $fillable = [
        'slug', 'job_type_id', 'label', 'description'
    ];
    public function type()
    {
        return $this->belongsTo('App\JobType',  'job_type_id');
    }
}
