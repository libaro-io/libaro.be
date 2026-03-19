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
            $table->text('tags')->nullable();
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->text('tags')->nullable();
        });

        $this->restoreTable('projects', 'App\\Models\\Project');
        $this->restoreTable('blogs', 'App\\Models\\Blog');
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

    private function restoreTable(string $table, string $morphType): void
    {
        $records = DB::table('taggables')
            ->where('taggable_type', '=', $morphType)
            ->join('tags', 'tags.id', '=', 'taggables.tag_id')
            ->select('taggable_id', 'tags.name')
            ->get();

        $grouped = $records->groupBy('taggable_id');

        foreach ($grouped as $id => $tags) {
            $tagString = $tags->map(function ($tag) {
                $name = json_decode($tag->name, true);

                return is_array($name) ? ($name['nl'] ?? $name['en'] ?? '') : $tag->name;
            })->filter()->unique()->implode(', ');

            DB::table($table)->where('id', '=', $id)->update(['tags' => $tagString]);
        }

        DB::table('taggables')->where('taggable_type', '=', $morphType)->delete();
    }
};
