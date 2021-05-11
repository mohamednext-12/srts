<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('line_subscription', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('line_id')->nullable();
            $table->foreign('line_id')->references('id')->on('lines');
            $table->unsignedBigInteger('subscription_id')->nullable();
            $table->foreign('subscription_id')->references('id')->on('subscriptions');
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
        Schema::dropIfExists('line_subscription');
    }
}
