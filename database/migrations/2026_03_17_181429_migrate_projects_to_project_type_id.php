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
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('project_type_id')->nullable()->after('slug')->constrained('project_types');
        });

        $types = DB::table('projects')
            ->select('type')
            ->whereNotNull('type')
            ->distinct()
            ->pluck('type');

        $translations = [
            'webapplicatie' => ['nl' => 'Webapplicatie', 'en' => 'Web Application'],
            'app' => ['nl' => 'App', 'en' => 'App'],
        ];

        foreach ($types as $type) {
            $slug = Str::slug($type);
            $name = $translations[$slug] ?? ['nl' => $type, 'en' => $type];

            DB::table('project_types')->updateOrInsert(
                ['slug' => $slug],
                [
                    'name' => json_encode($name, JSON_THROW_ON_ERROR),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );
        }

        $projects = DB::table('projects')->select('id', 'type')->get();

        foreach ($projects as $project) {
            $projectTypeId = DB::table('project_types')
                ->where('slug', Str::slug($project->type))
                ->value('id');

            DB::table('projects')
                ->where('id', $project->id)
                ->update(['project_type_id' => $projectTypeId]);
        }

        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('type')->nullable()->after('slug');
        });

        $projects = DB::table('projects')
            ->join('project_types', 'project_types.id', '=', 'projects.project_type_id')
            ->select('projects.id', 'project_types.slug')
            ->get();

        foreach ($projects as $project) {
            DB::table('projects')
                ->where('id', $project->id)
                ->update(['type' => $project->slug]);
        }

        Schema::table('projects', function (Blueprint $table) {
            $table->dropConstrainedForeignId('project_type_id');
        });
    }
};
