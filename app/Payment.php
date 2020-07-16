<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    const  SUPPLIER_PAYMENT=0;
    const  CUSTOMER_PAYMENT=1;
}
