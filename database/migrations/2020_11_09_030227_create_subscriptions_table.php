<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('agency_id')->nullable();
            $table->foreign('agency_id')->references('id')->on('agencies');

            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('clients');

            $table->unsignedBigInteger('period_id')->nullable();
            $table->foreign('period_id')->references('id')->on('subscription_periods');

            $table->unsignedBigInteger('phase_id')->nullable();
            $table->foreign('phase_id')->references('id')->on('phases');

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('subscription_categories');

            $table->unsignedBigInteger('education_id')->nullable();
            $table->foreign('education_id')->references('id')->on('educations');

            $table->unsignedBigInteger('payment_id')->nullable();
            $table->foreign('payment_id')->references('id')->on('payments');

            $table->unsignedBigInteger('chain_id')->nullable();
            $table->foreign('chain_id')->references('id')->on('chains');

            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->string('year')->nullable();

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
        Schema::dropIfExists('subscriptions');
    }
}
