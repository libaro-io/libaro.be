<?php

namespace Database\Seeders;

use App\Models\ProjectType;
use Illuminate\Database\Seeder;

class ProjectTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'name' => ['nl' => 'Webapplicatie', 'en' => 'Web Application'],
                'slug' => 'webapplicatie',
            ],
            [
                'name' => ['nl' => 'App', 'en' => 'App'],
                'slug' => 'app',
            ],
        ];

        foreach ($types as $type) {
            ProjectType::firstOrCreate(
                ['slug' => $type['slug']],
                ['name' => $type['name']],
            );
        }
    }
}
