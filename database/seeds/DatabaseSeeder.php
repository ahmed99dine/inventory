<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         //$this->call(UserSeeder::class);
         $this->call(ProductTableSeeder::class);
         $this->call(SupplierTableSeeder::class);
         $this->call(CustomerTableSeeder::class);
         $this->call(OrderTableSeeder::class);
         // $this->call(InvoiceTableSeeder::class);
         $this->call(OrderItemTableSeeder::class);
    }

}
