<?php

use App\Models\Project;
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
        Project::query()->each(function (Project $project) {
            $project->description = html_entity_decode(strip_tags($project->description));
            $project->save();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
