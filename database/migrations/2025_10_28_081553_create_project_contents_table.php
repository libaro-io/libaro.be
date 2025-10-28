<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectContentsTable extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('project_contents')) {
            return;
        }

        Schema::create('project_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('showcase_id');
            $table->boolean('visible')->default(1);
            $table->unsignedInteger('number');
            $table->string('title');
            $table->text('body');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_contents');
    }
}
