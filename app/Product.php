<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Inventory;
use App\Inventorytransaction;
use App\Saleitem;

class Product extends Model
{
     protected $fillable =[
       'model_no','make','description','year'
     ];

     protected $hidden =[
       'id'
     ];

     public function inventory ()
     {
      return $this-> hasMany('App\Inventory')->where('quantity','>',0)
      ->orderBy('updated_at');
     }

     public function inventory_transaction ()
     {
      return $this-> hasMany('App\Inventorytransaction');
     }
     public function sale_item()
     {
      return $this-> hasMany('App\Saleitem');
     }
     public function inventory_sum ()
     {
       $inventory_sum =  $this->hasMany('App\Inventory')
                 ->groupBy('product_id')
                 ->select(DB::RAW('SUM(IFNULL(quantity,0)) as quantity'))
                 ->first();

        if(is_null($inventory_sum)){
          return 0;
        }
      return $inventory_sum->quantity;
     }

     public function fifo()
     {
       return $this-> hasMany('App\Inventory')
                   ->select('product_id')
                   ->groupBy('updated_at');
     }
}
