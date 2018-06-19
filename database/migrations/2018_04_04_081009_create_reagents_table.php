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
            $table->integer('producer_id')->unsigned();
            $table->dateTime('receive_date');
            $table->string('code')->unique();
            $table->string('name');
            $table->string('lot')->nullable();
            $table->string('ref')->nullable();
            $table->integer('quantity')->default(0);
            $table->dateTime('expire');
            $table->boolean('is_handed')->default(0);
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
