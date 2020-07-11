<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountingTransaction extends Model
{
    protected $table = 'accountingtransactions';
    const DEBIT = 0;
    const CREDIT = 1;

}
