<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryTradingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_tradings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trader_id')->unsigned();
            $table->string('coins');
            $table->float('amount', 8, 2);
            $table->integer('result')->default('0');
            $table->foreign('trader_id')->references('id')->on('users');
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
        Schema::dropIfExists('history_tradings');
    }
}
