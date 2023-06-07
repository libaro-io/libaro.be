<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveLegacyImageColumnsFromShowcases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('showcases', function (Blueprint $table) {
            $table->dropColumn([
                'image_card',
                'image_header',
                'image_extra',
                'image_logo',
            ]);
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
            $table->string('image_card')->after('info_2');
            $table->string('image_header')->after('image_card');
            $table->string('image_extra')->after('image_header');
            $table->string('image_logo')->after('image_extra');
        });
    }
}
