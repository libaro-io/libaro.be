<?php

use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        $tagCache = [];

        $this->migrateTable('projects', 'App\\Models\\Project', $tagCache);
        $this->migrateTable('blogs', 'App\\Models\\Blog', $tagCache);

        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('tags');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('tags');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->text('tags')->default('');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->text('tags')->default('');
        });
    }

    /**
     * @param  array<string, int>  $tagCache
     */
    private function migrateTable(string $table, string $morphType, array &$tagCache): void
    {
        $records = DB::table($table)->whereNotNull('tags')->where('tags', '!=', '')->get(['id', 'tags']);

        foreach ($records as $record) {
            $tagNames = array_map('trim', explode(',', $record->tags));

            foreach ($tagNames as $tagName) {
                if ($tagName === '') {
                    continue;
                }

                if (! isset($tagCache[$tagName])) {
                    $slug = Str::slug($tagName);

                    $tag = Tag::firstOrCreate(
                        ['slug->nl' => $slug],
                        [
                            'name' => ['nl' => $tagName, 'en' => $tagName],
                            'slug' => ['nl' => $slug, 'en' => $slug],
                            'type' => null,
                            'order_column' => null,
                        ]
                    );

                    $tagCache[$tagName] = $tag->id;
                }

                DB::table('taggables')->insertOrIgnore([
                    'tag_id' => $tagCache[$tagName],
                    'taggable_type' => $morphType,
                    'taggable_id' => $record->id,
                ]);
            }
        }
    }
};
