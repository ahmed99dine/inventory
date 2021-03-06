<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Saleitem;

class Sale extends Model
{
    const CASH_SALE=0;
    const CREDIT_SALE=1;

    public function sale_amount()
    {
      return $this->hasMany('App\Saleitem')
        ->groupBy('sale_id')
      ->select(DB::raw('SUM(IFNULL((unit_cost * quantity), 0)) as sale_amount'))
      ->first()
      ->sale_amount();
    }
}
