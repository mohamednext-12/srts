<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chains', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('code');
            $table->bigInteger('confirmed')->default(0);
            $table->bigInteger('used')->default(0);
            $table->unsignedBigInteger('declaration_id')->nullable();
            $table->foreign('declaration_id')->references('id')->on('declarations');
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->foreign('agency_id')->references('id')->on('agencies');
            $table->date('date_arrive')->nullable();
            $table->date('date_declared')->nullable();
            $table->string('pack')->nullable();
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
        Schema::dropIfExists('chains');
    }
}
