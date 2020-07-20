<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Sale;
use App\Inventorytransaction;
use App\AccountingTransaction;
use App\Payment;
use App\Product;
use App\Customer;
use App\Saleitem;
use App\Inventory;

class SaleController extends Controller
{
  public function  sell(Request $request){
    $sale_type= $request->input('sale_type');
    $sale=new Sale();
    if($sale_type == 'CREDIT'){
      $sale->sale_type = Sale::CREDIT_SALE;
    }else{
      $sale->sale_type=Sale::CASH_SALE;
    }

    $sale->customer_id=$request->input('customer_id');
    $sale->sale_date=$request->input('sale_date');
    if($sale->save()){
      $saleitems= $request->input('sale_items');

      foreach ($saleitems as $saleitem) {
        $productId = $saleitem['product_id'];
        $quantity = $saleitem['quantity'];
        $unitPrice = $saleitem['unit_price'];

        $product = Product::findorFail($productId);
        $inventories = $product->inventory;//calling inventory relation
        $inventorysum = $product->inventory_sum();
        if($inventorysum < $quantity ) {
          abort(Response::HTTP_BAD_REQUEST, " not enough available to serve this product");
        }
        $remaining_quantity = $quantity;
        foreach ($inventories as $inventory) {
          if($remaining_quantity == 0){
            break;
          }

          if($inventory->quantity > 0){
            if($inventory->quantity >= $remaining_quantity){//fully served or complete the remaining_quantity required
              $inventory->quantity -= $remaining_quantity;
              // $remaining_quantity = 0;

              $saledetail = new Saleitem();
              $saledetail->sale_id  = $sale->id;
              $saledetail->product_id  = $productId;
              $saledetail->unit_cost  = $inventory->unit_cost;
              $saledetail->unit_price  = $unitPrice;
              $saledetail->quantity  = $remaining_quantity;
              $saledetail->save();


              $inventoryTransaction = new Inventorytransaction();
              $inventoryTransaction->inventory_id = $inventory->id;
              $inventoryTransaction->product_id = $inventory->product_id;
              $inventoryTransaction->saleitem_id = $saledetail->id;
              $inventoryTransaction->transaction_type = Inventorytransaction::SALE;
              $inventoryTransaction->quantity = $saledetail->quantity;
              $inventoryTransaction->initial_quantity = $inventory->quantity + $remaining_quantity;
              $inventoryTransaction->save();



            }else{// serving partially
              $available_quantity = $inventory->quantity;
              $remaining_quantity -= $available_quantity;
              $inventory->quantity = 0;

              $saledetail = new Saleitem();
              $saledetail->sale_id  = $sale->id;
              $saledetail->product_id  = $productId;
              $saledetail->unit_cost  = $inventory->unit_cost;
              $saledetail->unit_price  = $unitPrice;
              $saledetail->quantity  = $available_quantity;
              $saledetail->save();

              $inventoryTransaction = new Inventorytransaction();
              $inventoryTransaction->inventory_id = $inventory->id;
              $inventoryTransaction->product_id = $inventory->product_id;
              $inventoryTransaction->saleitem_id = $saledetail->id;
              $inventoryTransaction->transaction_type = Inventorytransaction::SALE;
              $inventoryTransaction->quantity = $saledetail->quantity;
              $inventoryTransaction->initial_quantity = $inventory->quantity + $available_quantity;
              $inventoryTransaction->save();

            }
            $inventory->save();
          }

        }
      }
      $accountingtransaction = new AccountingTransaction();
      $sale_total=$sale->sale_amount();
      dd($sale_total);
      if($sale_type == 'CREDIT'){
        $accountingtransaction->transaction_type = AccountingTransaction::CREDIT_SALE;
        $customer=Customer::findorFail($sale->customer_id);
        $customer->outstanding_debt +=$sale_total;
        $customer->save();
      }else{
        $accountingtransaction->transaction_type=AccountingTransaction::CASH_SALE;
        $payment=new Payment();
        $payment->payment_type=Payment::CUSTOMER_PAYMENT;
        $payment->customer_id=$sale->customer_id;
        $payment->amount=$sale_total;
        dd($payment->amount);
        $payment->save();
      }
      $accountingtransaction->amount = $sale_total;
      $accountingtransaction->sale_id = $sale->id;
      $accountingtransaction->save();
    }
    return $sale_total;
  }
}
