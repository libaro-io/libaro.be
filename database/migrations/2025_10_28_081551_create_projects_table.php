<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('projects')) {
            return;
        }

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->boolean('visible')->default(1);
            $table->boolean('is_product')->default(0);
            $table->string('name');
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('client_url')->nullable();
            $table->timestamps();
            $table->string('slug')->unique('showcases_slug_unique');
            $table->string('type');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->date('date')->nullable();
            $table->boolean('pin_on_homepage')->default(0);
            $table->text('tags');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
}
