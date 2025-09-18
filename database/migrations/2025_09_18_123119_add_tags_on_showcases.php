<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('showcases', function (Blueprint $table) {
            $table->text('tags');
        });

        DB::table('taggables')
            ->where('taggable_type', 'App\\Models\\Showcase')
            ->get()
            ->groupBy('taggable_id')
            ->each(function ($tagRelations, $showcaseId) {
                $commaSeperatedTags = DB::table('tags')
                    ->whereIn('id', $tagRelations->pluck('tag_id'))
                    ->get()
                    ->pluck('name')
                    ->map(fn($name) => array_values(json_decode($name, true))[0])
                    ->implode(',');

                DB::table('showcases')
                    ->where('id', $showcaseId)
                    ->update(['tags' => $commaSeperatedTags]);
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('showcases', function (Blueprint $table) {
            $table->dropColumn('tags');
        });
    }
};
