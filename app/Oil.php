<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Oil extends Model
{
    protected $table = 'oil';


    protected $fillable = [
        'amount', 'user_id', 'vehicle_id', 'oil_type_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle',  'vehicle_id');
    }

    public function type()
    {
        return $this->belongsTo('App\OilType',  'oil_type_id');
    }
}
