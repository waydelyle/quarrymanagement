<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Diesel extends Model
{
    protected $table = 'diesel';

    protected $fillable = [
        'amount', 'user_id', 'vehicle_id', 'meter'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle',  'vehicle_id');
    }
}
