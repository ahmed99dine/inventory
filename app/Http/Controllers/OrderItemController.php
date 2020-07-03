<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Order_Item  $order_Item
     * @return \Illuminate\Http\Response
     */
    public function show(OrderItem $order_Item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order_Item  $order_Item
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderItem $order_Item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order_Item  $order_Item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $order_item = OrderItem::findorfail($id);
        $order_item->quantity = $request->input('quantity');
        $order_item->unit_cost = $request->input('unit_cost');
        $order_item->status = $request->input('status');
        $order_item->save();
        return response($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order_Item  $order_Item
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderItem $order_Item,$id)
    {
        $order_item=OrderItem::findorfail($id);
        return($order_item->delete());
    }
}
