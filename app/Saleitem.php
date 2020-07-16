<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Inventorytransaction;

class Saleitem extends Model
{
    public function inventorytransactions()
    {
      return $this->hasOne('App\Inventorytransaction');
    }
}
