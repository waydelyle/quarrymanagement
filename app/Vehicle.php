<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    const NO_VEHICLE = 1;

    protected $table = 'vehicles';

    protected $fillable = [
        'registration'
    ];
}
