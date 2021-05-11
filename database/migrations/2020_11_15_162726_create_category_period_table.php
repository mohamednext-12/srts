<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryPeriodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_period', function (Blueprint $table) {
            $table->id();
            $table->string('category_id')->nullable();
            $table->foreign('category_id') ->references('id') ->on('subscription_categories');
            $table->string('period_id')->nullable();
            $table->foreign('period_id') ->references('id') ->on('subscription_periods');
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
        Schema::dropIfExists('category_period');
    }
}
