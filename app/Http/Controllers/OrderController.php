<?php

namespace App\Http\Controllers;

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

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    //
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Order  $order
  * @return \Illuminate\Http\Response
  */
  public function show(Order $order)
  {
    //
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
  public function destroy(Order $order)
  {
    //
  }
}
