<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
       <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1">

       <title>Orders</title>

   </head>
   <body>

    @foreach($orders as $order)
        
        <h3>{{ $order->order_date }}</h3>
        <p>{{$order->supplier->name}}</p>
    @endforeach

   </body>
</html>
