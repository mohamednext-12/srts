<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->id();
            $table->string('name_french')->nullable();
            $table->string('name_arab')->nullable();
            $table->string('num')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->unsignedBigInteger('line_id')->nullable();
            $table->foreign('line_id')->references('id')->on('lines');
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
        Schema::dropIfExists('stations');
    }
}
