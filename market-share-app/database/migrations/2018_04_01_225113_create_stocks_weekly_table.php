<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksWeeklyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks_weekly', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('created_at_utc');
            $table->date('last_refreshed');
            $table->string('asx_code');
            $table->string('date');
            $table->float('open', 10, 2);
            $table->float('high', 10, 2);
            $table->float('low', 10, 2);
            $table->float('close', 10, 2);
            $table->integer('volume');
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
