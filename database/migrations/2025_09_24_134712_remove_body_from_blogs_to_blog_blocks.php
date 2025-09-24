<?php

use App\Filament\FilamentBlockType;
use App\Models\Blog;
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
        Blog::query()
            ->each(function (Blog $blog) {
                $blog->blocks()->create([
                    'type' => FilamentBlockType::Text,
                    'content' => ['text' => $blog->body],
                    'sort' => 0,
                ]);
            });

        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('body');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
