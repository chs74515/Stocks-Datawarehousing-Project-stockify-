<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Stocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('stocks_id');
            $table->date('date');
            $table->string('name');
            $table->double('open');
            $table->double('close');
            $table->double('high');
            $table->double('low');
            $table->double('volume');
            $table->integer('dividend');
            $table->double('closeunadj');
            $table->date('lastupdated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
