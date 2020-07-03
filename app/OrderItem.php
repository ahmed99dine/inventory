<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    CONST ORDERITEM_UNATTENDED = 0;
    CONST ORDERITEM_RECEIVED = 1;
    CONST ORDERITEM_NOTRECEIVED =2 ;
    use SoftDeletes;
}
