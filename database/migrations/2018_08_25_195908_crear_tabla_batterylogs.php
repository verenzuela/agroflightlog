<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaBatterylogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batterylogs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_flight');
            $table->date('date');
            $table->string('pack', 30);
            $table->string('volt_takeoff', 10)->nullable();
            $table->string('volt_landing', 10)->nullable();
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
        Schema::dropIfExists('batterylogs');
    }
}
