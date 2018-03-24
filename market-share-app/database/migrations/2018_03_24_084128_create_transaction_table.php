<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('postion_Id');
            $table->unsignedInteger('user_id');
            $table->boolean('is_short_selling');
            $table->string('asx_code',10);
            $table->dateTime('date_opened');
            $table->dateTime('date_closed');
            $table->decimal('purchase_price',13,4);
            $table->decimal('sold_price',13,4);
            $table->integer('quantity');
            $table->double('buying_comission');
            $table->double('selling_comission');           
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('transactions');
    }
}
