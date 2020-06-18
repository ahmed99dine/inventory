<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Supplier;

class Order extends Model
{
    protected $fillable =[
       'supplier_id','order_date',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function items()
    {
      return $this->hasMany('App\OrderItem');
    }

    public function order_amount()
    {
      return $this->hasMany('App\OrderItem')
                  ->select(DB::raw('SUM(IFNULL((unit_cost * quantity), 0))'));
    }
}
