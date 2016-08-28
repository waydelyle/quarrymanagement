<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stock';

    protected $fillable = [
        'employee_id', 'stock_type_id', 'stock_item_id', 'job_id', 'amount', 'description'
    ];

    public function employee()
    {
        return $this->belongsTo('App\Employee',  'employee_id');
    }

    public function job()
    {
        return $this->belongsTo('App\Job',  'job_id');
    }

    public function item()
    {
        return $this->belongsTo('App\StockItem',  'stock_item_id');
    }
}
