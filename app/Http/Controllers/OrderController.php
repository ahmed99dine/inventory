<?php

namespace App\Http\Controllers;

use App\OrderItem;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hashids\Hashids;
use App\Product;

class OrderController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */

  public function index()
  {
    $orders = Order::all();
    return response($orders);
  }

  public function items(Request $request,$id)
  {
    //$id = Order::all('id');
    $order_details = DB::table('orders')
    ->select('orders.order_date as date' ,'products.model_no as model','products.make as make',
    'order_items.quantity as quantity')
    ->join('order_items','orders.id', '=' ,'order_items.order_id')
    ->join('products','products.id','=','order_items.product_id')
    ->where('orders.id','=', $id)
    ->get();
    return response($order_details);
  }
  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    //
  }

  public function receiveOrder(Request $request, $id){
    $orderitems = $request->input('order_items');
    foreach ($orderitems as $orderitems) {

      $receiving_quantity = $request->input('receiving_quantity');
      $orderitem_id = $request->input('order_item_id');
      $existing_orderitem = OrderItem::findorfail($orderitem_id);
      if( $existing_orderitem->quantity == $receiving_quantity ){
        $existing_orderitem->status = OrderItem::ORDERITEM_RECEIVED;
        $existing_orderitem->save();
      }else{
        // Means receiving partial
        $remaining_quantity = $existing_orderitem->quantity - $receiving_quantity;

        $new_orderitem = new OrderItem();
        $new_orderitem->order_id = $existing_orderitem->order_id;
        $new_orderitem->product_id = $existing_orderitem->product_id;
        $new_orderitem->quantity = $receiving_quantity;
        $new_orderitem->unit_cost = $existing_orderitem->unit_cost;
        $new_orderitem->status = OrderItem::ORDERITEM_RECEIVED;
        $new_orderitem->save();

        $existing_orderitem->quantity = $remaining_quantity;
        $existing_orderitem->save();
      }
    }

      $order = Order::findorfail($id);
      $order->update_order_status();
      $order->save();

      return $existing_orderitem;
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
      // $request->validate([
      //   'supplier_id' => 'required',
      //   'order_date' => 'required',
      //   ''
      // ]);
      // return (Order::create($request->all()));
      $neworder = new Order();
      $neworder->supplier_id = $request->input('supplier_id');
      $neworder->order_date = $request->input('order_date');
      $neworder->status = $request->input('status');
      if($neworder->save()){
        $orderitems = $request->input('orde_items');
        foreach ($orderitems as $orderitem) {
          $neworderitem = new OrderItem();
          $neworderitem->order_id = $neworder->id;
          $neworderitem->product_id = $orderitem['product_id'];
          $neworderitem->quantity = $orderitem['quantity'];
          $neworderitem->unit_cost = $orderitem['unit_cost'];
          $neworderitem->status = $orderitem['status'];
          $neworderitem->save();
        }
      }
      return ($neworder);
    }



    /**
    * Display the specified resource.
    *
    * @param  \App\Order  $order
    * @return \Illuminate\Http\Response
    */
    public function show(Order $order,$id)
    {
      $order = Order::find($id);
      return response($order);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Order  $order
    * @return \Illuminate\Http\Response
    */
    public function edit(Order $order)
    {
      //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Order  $order
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Order $order)
    {
      //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Order  $order
    * @return \Illuminate\Http\Response
    */
    public function destroy(Request $request,$id)
    {
      $order= Order::findorfail($id);
      return response($order->softDeletes());
    }
  }
