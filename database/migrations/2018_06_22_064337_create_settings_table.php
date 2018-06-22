<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reagent_expire_date_marker')->default(30);
            $table->string('reagent_expired_color')->default('#ffc6c6');
            $table->string('reagent_expiring_color')->default('#fffde9');
            $table->integer('reagent_sort_by')->default(7);
            $table->string('empty_state_color')->default('#ffc6c6');
            $table->string('used_state_color')->default('#fffde9');
            $table->timestamps();
        });

        DB::table('settings')->insert(
          array(
            'reagent_expire_date_marker' => 30,
            'reagent_expired_color' => '#ffc6c6',
            'reagent_expiring_color' => '#fffde9',
            'reagent_sort_by' => 7,
            'empty_state_color' => '#ffc6c6',
            'used_state_color' => '#fffde9',
          )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
