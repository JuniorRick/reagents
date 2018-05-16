<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reagent_id')->unsigned();
            $table->integer('person_id');
            $table->datetime('handed_date');
            $table->timestamps();

            $table->foreign('reagent_id')
              ->references('id')
              ->on('reagents')
              ->onDelete('cascade');

            $table->foreign('person_id')
              ->references('id')
              ->on('people')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
