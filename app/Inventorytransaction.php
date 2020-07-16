<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Inventorytransaction extends Model
{
  public function product()
  {
    return $this-> belongsTo('App\Product');
  }

    const SELL = 0;
    const PURCHASE = 1;
    const DAMAGED  =2;
    const RETURNED_TO_SUPLIER=3;
    const LOST = 4;

}
