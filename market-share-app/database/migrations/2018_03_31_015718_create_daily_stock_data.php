<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyStockData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks_daily', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTimeTz('created_at');
            $table->dateTimeTz('last_refreshed');
            $table->string('asx_code');
            $table->string('date');
            $table->string('open');
            $table->string('high');
            $table->string('low');
            $table->string('close');
            $table->string('volume');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks_daily');
    }
}
