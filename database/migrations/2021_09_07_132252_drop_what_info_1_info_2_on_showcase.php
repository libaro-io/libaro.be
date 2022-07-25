<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropWhatInfo1Info2OnShowcase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('showcases', function (Blueprint $table) {
            $table->dropColumn('what');
            $table->dropColumn('info_1');
            $table->dropColumn('info_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('showcases', function (Blueprint $table) {
            $table->string('what')->nullable();
            $table->string('info_1')->nullable();
            $table->string('info_2')->nullable();
        });
    }
}
