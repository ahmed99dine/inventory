<?php

use Illuminate\Database\Seeder;
use App\Order_Item;

class OrderItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\OrderItem::class , 10)->create();
    }
}
