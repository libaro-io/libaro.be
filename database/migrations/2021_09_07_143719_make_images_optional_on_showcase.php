<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeImagesOptionalOnShowcase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('showcases', function (Blueprint $table) {
            $table->string('image_header')->nullable()->change();
            $table->string('image_extra')->nullable()->change();
            $table->string('image_logo')->nullable()->change();
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
            $table->string('image_header')->change();
            $table->string('image_extra')->change();
            $table->string('image_logo')->change();
        });
    }
}
