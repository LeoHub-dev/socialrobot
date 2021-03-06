<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('trading_id')->unsigned();
            $table->float('amount', 16, 8);
            $table->string('buy_uuid')->nullable();
            $table->string('sell_uuid')->nullable();
            $table->string('stop_uuid')->nullable();
            $table->boolean('done')->default(false);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('trading_id')->references('id')->on('trading_histories');
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
        Schema::dropIfExists('action_histories');
    }
}
