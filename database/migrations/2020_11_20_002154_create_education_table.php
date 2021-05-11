<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->id();

            $table->string('client_id')->nullable();
            $table->foreign('client_id') ->references('id') ->on('clients');

            $table->string('institution_id')->nullable();
            $table->foreign('institution_id') ->references('id') ->on('institutions');

            $table->string('classroom_id')->nullable();
            $table->foreign('classroom_id') ->references('id') ->on('classrooms');

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
        Schema::dropIfExists('education');
    }
}
