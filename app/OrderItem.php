<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable =[
       'order_id','product_id','quantity','unit_cost'
    ];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function products()
    {
      return $this->belongsTo('App\OrderItem');
    }

}
