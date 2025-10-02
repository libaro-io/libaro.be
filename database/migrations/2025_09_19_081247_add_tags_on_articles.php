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
        Schema::table('articles', function (Blueprint $table) {
            $table->text('tags')->after('link');
        });

        DB::table('taggables')
            ->where('taggable_type', 'App\\Models\\Article')
            ->get()
            ->groupBy('taggable_id')
            ->each(function ($tagRelations, $articleId) {
                $commaSeperatedTags = DB::table('tags')
                    ->whereIn('id', $tagRelations->pluck('tag_id'))
                    ->pluck('name')
                    ->map(fn($name) => array_values(json_decode($name, true))[0])
                    ->implode(',');

                DB::table('articles')
                    ->where('id', $articleId)
                    ->update(['tags' => $commaSeperatedTags]);
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('tags');
        });
    }
};
