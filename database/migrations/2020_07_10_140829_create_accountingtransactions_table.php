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
          $table->integer('account_type');
          $table->double('amount',10,2);
          $table->integer('invoice_id')->nullable();
          $table->integer('sell_id')->nullable();
          $table->string('cheque_no')->nullable();
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
