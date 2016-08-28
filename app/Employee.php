<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'name', 'surname', 'photo', 'email', 'id_number', 'salary'
    ];
}
