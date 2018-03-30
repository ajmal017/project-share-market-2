<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClosedTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('closed_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('open_transactions_id');
            $table->dateTime('date_closed');
            $table->decimal('sold_price',13,4);
            $table->integer('quantity');
            $table->double('selling_commission');           
            $table->foreign('open_transactions_id')->references('id')->on('open_transactions');
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
        Schema::dropIfExists('closed_transactions');
    }
}
