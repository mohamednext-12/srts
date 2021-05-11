<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHologramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holograms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->foreign('agency_id')->references('id')->on('agencies');
            $table->unsignedBigInteger('stock_id')->nullable();
            $table->foreign('stock_id')->references('id')->on('stocks');
            $table->unsignedBigInteger('hologram_categories_id')->nullable();
            $table->foreign('hologram_categories_id')->references('id')->on('hologram_categories');
            $table->boolean('confirmed')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('used')->nullable();
            $table->integer('declared')->nullable();
            $table->boolean('closed')->nullable()->default('0');
            $table->date('date_arrive')->nullable();
            $table->date('date_confirmed')->nullable();
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
        Schema::dropIfExists('holograms');
    }
}
