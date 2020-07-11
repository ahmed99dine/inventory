<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;

class InvoiceController extends Controller
{
    public function update(Request $request,$id)
    {
      $invoice = Invoice::findorfail($id);
      $invoice->invoice_date = $request->input('date');
      $invoice->inv_number = $request->input('inv_number');
      $invoice->save();
      return ($invoice);
    }
}
