<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountingtransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accountingtransactions', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('transaction_type');
          $table->double('amount',10,2);
          $table->integer('invoice_id')->nullable()->unsigned();
          $table->integer('sale_id')->nullable()->unsigned();
          $table->integer('payment_id')->nullable()->unsigned();
          $table->string('cheque_no')->nullable();
          $table->foreign('payment_id')->references('id')->on('payments');
          $table->foreign('invoice_id')->references('id')->on('invoices');
          $table->foreign('sale_id')->references('id')->on('sales');
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
        Schema::dropIfExists('accountingtransactions');
    }
}
