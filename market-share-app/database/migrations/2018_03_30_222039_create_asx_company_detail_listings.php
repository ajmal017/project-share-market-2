<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsxCompanyDetailListings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asx_company_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name');
            $table->string('company_code')->unique();
            $table->string('gics_industry');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asx_company_details');
    }
}
