<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class StockType extends Model
{
    protected $table = 'stock_types';

    protected $fillable = [
        'slug', 'label', 'description', 'description'
    ];
}
