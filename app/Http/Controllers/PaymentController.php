<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\AccountingTransaction;
use App\Payment;

class PaymentController extends Controller
{
    public function supplier_payment(Request $request,$id)
    {
      $supplier=Supplier::findorfail($id);
      $payment = new Payment();
      $payment->payment_type= Payment::SUPPLIER_PAYMENT;
      $payment->supplier_id=$supplier->id;
      $payment->amount=$request->input('amount_paid');
      $payment->payment_date=$request->input('payment_date');

      $payment->save();

      $supplier->cleared_debt+=$payment->amount;
      $supplier->outstanding_debt -=$payment->amount;
      $supplier->save();

      $accountingtransaction = new AccountingTransaction();
      $accountingtransaction->transaction_type = AccountingTransaction::DEBIT;
      $accountingtransaction->amount = $payment->amount;
      $accountingtransaction->payment_id = $payment->id;

      $accountingtransaction->save();

      return $payment;

    }
}
