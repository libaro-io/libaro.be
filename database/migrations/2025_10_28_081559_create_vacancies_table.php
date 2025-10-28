<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacanciesTable extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('vacancies')) {
            return;
        }

        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->boolean('visible')->default(1);
            $table->string('title');
            $table->string('slug')->unique('vacancies_slug_unique');
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
}
