<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandingPageProjectTable extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('landing_page_project')) {
            return;
        }

        Schema::create('landing_page_project', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('landing_page_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('landing_page_project');
    }
}
