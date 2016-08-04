<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Diesel extends Model
{
    protected $table = 'diesel';

    protected $fillable = [
        'amount', 'user_id'
    ];
}
