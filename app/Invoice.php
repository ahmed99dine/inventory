<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Invoice extends Model
{
    protected $fillable=[
      'inv_date','supplier_id','order_id'
    ];

    public function  order_items()
    {
      return $this->hasMany('App\OrderItem');
    }

    public function invoice_amount()
    {
      return $this->hasMany('App\OrderItem')
      ->select(DB::raw('SUM(IFNULL((inv_unitcost * quantity), 0)) as invoice_amount'));
    }
}
