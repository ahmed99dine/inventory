<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountingTransaction extends Model
{
    protected $table = 'accountingtransactions';
    const DEBIT = 0;
    const CREDIT = 1;
    const CREDIT_SALE=2;
    const CASH_SALE=3;
}
