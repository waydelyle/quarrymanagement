<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Oil extends Model
{
    protected $table = 'oil';

    protected $fillable = array('vehicle_id', 'amount');
}
