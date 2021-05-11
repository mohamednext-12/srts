<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStockToAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agencies', function (Blueprint $table) {
            $table->integer('max')->nullable();
            $table->integer('min')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agencies', function (Blueprint $table) {
            $table->dropColumn('min');
            $table->dropColumn('max');
        });
    }
}
