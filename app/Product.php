<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $fillable =[
       'model_no','make','description','year'
     ];

     protected $hidden =[
       'id'
     ];

}
