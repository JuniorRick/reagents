<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReagentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reagents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('producer_id');
            $table->dateTime('receive_date');
            $table->string('code');
            $table->string('name');
            $table->string('lot')->nullable();
            $table->dateTime('expire');
            $table->boolean('is_handed');
            $table->timestamps();

            $table->foreign('producer_id')
              ->references('id')
              ->on('producers')
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
        Schema::dropIfExists('reagents');
    }
}
