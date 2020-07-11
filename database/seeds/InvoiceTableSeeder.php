<?php

use Illuminate\Database\Seeder;
use App\Invoice;
class InvoiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Invoice::class ,10)->create();
    }
}
