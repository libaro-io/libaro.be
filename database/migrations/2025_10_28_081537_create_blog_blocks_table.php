<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogBlocksTable extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('blog_blocks')) {
            return;
        }

        Schema::create('blog_blocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_id');
            $table->string('type');
            $table->json('content');
            $table->integer('sort')->default(0);
            $table->timestamps();

            $table->foreign('blog_id', 'blog_blocks_blog_id_foreign')->references('id')->on('blogs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_blocks');
    }
}
