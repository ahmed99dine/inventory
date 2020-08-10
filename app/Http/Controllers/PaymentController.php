<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\AccountingTransaction;
use App\Payment;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function supplier_payment(Request $request, $id)
    {
        DB::beginTransaction();

        $supplier = Supplier::findorfail($id);
        $payment = new Payment();
        $payment->payment_type = Payment::SUPPLIER_PAYMENT;
        $payment->supplier_id = $supplier->id;
        $payment->amount = $request->input('amount_paid');
        $payment->payment_date = $request->input('payment_date');

        if(!$payment->save()){
            DB::rollback();
            abort(Response::HTTP_BAD_REQUEST, "Error occured while saving payment");
        }

        $supplier->cleared_debt += $payment->amount;
        $supplier->outstanding_debt -= $payment->amount;
        if(!$supplier->save()){
            DB::rollback();
            abort(Response::HTTP_BAD_REQUEST, "Error occured while saving payment");
        }

        $accountingtransaction = new AccountingTransaction();
        $accountingtransaction->transaction_type = AccountingTransaction::DEBIT;
        $accountingtransaction->amount = $payment->amount;
        $accountingtransaction->payment_id = $payment->id;

        if(!$accountingtransaction->save()){
            DB::rollback();
            abort(Response::HTTP_BAD_REQUEST, "Error occured while saving payment");
        }

        DB::commit();

        return $payment;
    }
}
