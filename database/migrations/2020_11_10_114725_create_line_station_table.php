<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineStationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('line_station', function (Blueprint $table) {
            $table->id();
            $table->string('line_id');
            $table->foreign('line_id') ->references('id') ->on('lines');
            $table->string('station_id');
            $table->foreign('station_id')->references('id')->on('stations');
            $table->integer('order')->nullable();
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
        Schema::dropIfExists('line_station');
    }
}
