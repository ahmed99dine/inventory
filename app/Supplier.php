<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Order;

class Supplier extends Model
{
    protected $fillable =[
      'name','phone','email','location'
    ];

    protected $hidden=[
      'id'
    ];

    public function orders()
    {
      return $this->hasMany(Order::class);
    }
    use SoftDeletes;
}
