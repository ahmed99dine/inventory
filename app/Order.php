<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Supplier;

class Order extends Model
{
  protected $fillable =[
    'supplier_id','order_date',
  ];

  public function supplier()
  {
    return $this->belongsTo(Supplier::class);
  }

  public function items()
  {
    return $this->hasMany('App\OrderItem');
  }

  public function order_amount()
  {
    return $this->hasMany('App\OrderItem')
    ->select(DB::raw('SUM(IFNULL((unit_cost * quantity), 0))'));
  }

  CONST ORDER_STATUS_DRAFT = 0;
  CONST ORDER_STATUS_UNATTENDED = 1;
  CONST ORDER_STATUS_PARTIALRECEIVED = 2;
  CONST ORDER_STATUS_FULLYRECEIVED = 3;
  CONST ORDER_STATUS_FULFILLED = 4;
  CONST ORDER_STATUS_NOTRECEIVED = 5;

  public function update_order_status(){
    $receivedCount = $this->hasMany('App\OrderItem')
    ->where('status', OrderItem::ORDERITEM_RECEIVED)
    ->count();

    $notReceivedCount = $this->hasMany('App\OrderItem')
    ->where('status', OrderItem::ORDERITEM_NOTRECEIVED)
    ->count();

    $unattendedCount = $this->hasMany('App\OrderItem')
    ->where('status', OrderItem::ORDERITEM_UNATTENDED)
    ->count();

    $totalCount = $this->items->count();

    if( $receivedCount == $totalCount ){
      $this->status = Order::ORDER_STATUS_FULLYRECEIVED;
    }else if( $receivedCount > 0 &&  $unattendedCount > 0 ){
      $this->status = Order::ORDER_STATUS_PARTIALRECEIVED;
    }else if ( $notReceivedCount == $totalCount ) {
       $this->status = Order::ORDER_STATUS_NOTRECEIVED;
    }else if( $notReceivedCount > 0 &&  $unattendedCount == 0 && $receivedCount > 0){
      $this->status = Order::ORDER_STATUS_FULFILLED;
    }else if( $receivedCount == 0 &&  $unattendedCount > 0 &&  $notReceivedCount > 0 ){
      $this->status = Order::ORDER_STATUS_UNATTENDED;
    }
  }
}
