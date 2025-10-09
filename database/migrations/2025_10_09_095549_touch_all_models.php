<?php

use App\Models\Blog;
use App\Models\LandingPage;
use App\Models\Project;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Blog::query()->each(fn (Blog $blog) => $blog->touch());
        LandingPage::query()->each(fn (LandingPage $landingPage) => $landingPage->touch());
        Project::query()->each(fn (Project $project) => $project->touch());
    }

    public function down(): void
    {
        //
    }
};
