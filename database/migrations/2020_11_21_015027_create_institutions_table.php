<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name_arab')->nullable();
            $table->string('name_french')->nullable();
            $table->foreign('level_id') ->references('id') ->on('levels');
            $table->string('level_id');
            $table->foreign('municipality_id') ->references('id') ->on('municipalities');
            $table->string('municipality_id');
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
        Schema::dropIfExists('institutions');
    }
}
