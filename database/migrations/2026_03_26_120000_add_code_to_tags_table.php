<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        $usedCodes = [];

        Schema::table('tags', function (Blueprint $table) {
            $table->string('code')->nullable()->after('slug');
        });

        DB::table('tags')
            ->select(['id', 'name', 'slug'])
            ->orderBy('id')
            ->get()
            ->each(function (object $tag) use (&$usedCodes): void {
                $name = json_decode($tag->name, true);
                $slug = json_decode($tag->slug, true);

                $code = $slug['nl']
                    ?? $slug['en']
                    ?? Str::slug($name['nl'] ?? $name['en'] ?? "tag-{$tag->id}");

                if (isset($usedCodes[$code])) {
                    $code = "{$code}-{$tag->id}";
                }

                $usedCodes[$code] = true;

                DB::table('tags')
                    ->where('id', '=', $tag->id)
                    ->update(['code' => $code]);
            });

        Schema::table('tags', function (Blueprint $table) {
            $table->unique('code');
        });
    }

    public function down(): void
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->dropUnique(['code']);
            $table->dropColumn('code');
        });
    }
};
