<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Saleitem;

class Sale extends Model
{
    const CASH_SALE=0;
    const CREDIT_SALE=1;

    public function sale_amount()
    {
    $total_amount = $this->hasMany('App\SaleItem')
                  ->groupBy('sale_id')
                  ->select(DB::raw('SUM(IFNULL((unit_price * quantity), 0)) as sale_amount'))
                  ->first();
                  // ->sale_amount;
                return $total_amount->sale_amount;
    }
}
