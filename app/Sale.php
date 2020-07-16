<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    const CASH_SALE=0;
    const CREDIT_SALE=1;
}
