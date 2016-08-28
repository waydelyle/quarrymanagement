<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stock_count';

    protected $fillable = [
        'user_id', 'stock_item_id', 'amount'
    ];


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
