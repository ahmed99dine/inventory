<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Payment;
use App\Sale;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    public function payment ()
    {
      return $this-> hasMany('App\Payment');
    }

    public function sales()
    {
      return $this->hasMany('App\Sale');
    }
    use SoftDeletes;
}
