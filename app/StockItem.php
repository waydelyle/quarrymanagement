<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    protected $table = 'stock_items';

    protected $fillable = [
        'slug', 'label', 'count', 'description', 'stock_type_id'
    ];

    public function type()
    {
        return $this->belongsTo('App\StockType',  'stock_type_id');
    }

}
