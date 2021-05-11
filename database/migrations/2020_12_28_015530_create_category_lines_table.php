<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_lines', function (Blueprint $table) {
            $table->id();
            $table->string('line_id');
            $table->foreign('line_id') ->references('id') ->on('lines');
            $table->string('category_id');
            $table->foreign('category_id')->references('id')->on('subscription_categories');
            $table->double('price')->nullable();
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
        Schema::dropIfExists('category_lines');
    }
}
