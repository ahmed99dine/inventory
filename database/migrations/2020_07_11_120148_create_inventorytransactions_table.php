<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventorytransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventorytransactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inventory_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('orderitem_id')->unsigned()->nullable();
            $table->integer('saleitem_id')->unsigned()->nullable();
            $table->integer('transaction_type')->default(0);
            $table->integer('quantity');
            $table->integer('initial_quantity');
            $table->foreign('inventory_id')->references('id')->on('inventory');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('orderitem_id')->references('id')->on('order_items');
            $table->foreign('saleitem_id')->references('id')->on('saleitems');
            // $table->foreign('saleitem_id')->references('id')->on('saleitems');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventorytransactions');
    }
}
