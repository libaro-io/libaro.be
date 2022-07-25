<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowcasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('showcases', function (Blueprint $table) {
            $table->id();
            $table->boolean('visible')->default(true);
            $table->string('name');
            $table->string('what');
            $table->text('description');
            $table->string('info_1');
            $table->string('info_2');
            $table->string('image_card');
            $table->string('image_header');
            $table->string('image_extra');
            $table->string('image_logo');
            $table->string('client_url');
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
        Schema::dropIfExists('showcases');
    }
}
