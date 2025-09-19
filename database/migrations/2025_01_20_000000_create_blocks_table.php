<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('showcases')->onDelete('cascade');
            $table->string('type'); // 'image_with_text' or 'image_full_width'
            $table->json('content'); // Store block-specific content as JSON
            $table->integer('sort')->default(0); // For ordering blocks
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_blocks');
    }
};
