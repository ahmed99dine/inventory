<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Inventory extends Model
{
    protected $table='inventory';

    public function product()
    {
    return $this-> belongsTo('App\Product');
    }
}
