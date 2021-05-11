<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('line_id')->nullable();
            $table->foreign('line_id')->references('id')->on('lines');
//            $table->string('number')->nullable();
            $table->string('brand')->nullable();
            $table->string('number_place')->nullable();
            $table->string('date_circulation')->nullable();
//            $table->string('')->nullable();
            $table->string('comment')->nullable();
            $table->unsignedBigInteger('trip_id')->nullable();
            $table->foreign('trip_id')->references('id')->on('trips');
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
        Schema::dropIfExists('buses');
    }
}
