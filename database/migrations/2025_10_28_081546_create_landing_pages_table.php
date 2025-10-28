<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandingPagesTable extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('landing_pages')) {
            return;
        }

        Schema::create('landing_pages', function (Blueprint $table) {
            $table->id();
            $table->string('skill');
            $table->string('target');
            $table->string('location');
            $table->unsignedInteger('image_index')->nullable();
            $table->string('title')->nullable();
            $table->text('text1')->nullable();
            $table->text('text2')->nullable();
            $table->text('text3')->nullable();
            $table->string('slug');
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('landing_pages');
    }
}
