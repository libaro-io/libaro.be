<?php

use App\Models\ProjectBlock;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $projectContents = DB::table('project_contents')
            ->orderBy('number')
            ->get();

        $projectContents->each(function ($projectContent) {
            ProjectBlock::query()->create([
                'project_id' => $projectContent->showcase_id,
                'type' => 'number_text',
                'content' => [
                    'text' => str_replace("<p>&nbsp;</p>\r\n", '', $projectContent->body),
                    'title' => $projectContent->title,
                    'number' => $projectContent->number,
                ],
                'sort' => $projectContent->number,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }

    public function down(): void {}
};
