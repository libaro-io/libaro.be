<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectBlocksTable extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('project_blocks')) {
            return;
        }

        Schema::create('project_blocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('type');
            $table->json('content');
            $table->integer('sort')->default(0);
            $table->timestamps();

            $table->foreign('project_id', 'project_blocks_project_id_foreign')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_blocks');
    }
}
