<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToDemands extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demands', function (Blueprint $table) {
            $table->boolean('type')->nullable();
            $table->string('genre')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('demands', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('genre');
        });
    }
}
