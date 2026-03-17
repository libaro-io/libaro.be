<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            ['nl' => 'Robaws', 'en' => 'Robaws'],
            ['nl' => 'Odoo', 'en' => 'Odoo'],
            ['nl' => 'Webapplicatie', 'en' => 'Web Application'],
            ['nl' => 'App', 'en' => 'App'],
            ['nl' => 'EMS', 'en' => 'EMS'],
            ['nl' => 'ERP', 'en' => 'ERP'],
            ['nl' => 'IOT', 'en' => 'IOT'],
            ['nl' => 'Tijdsregistratie', 'en' => 'Time Registration'],
        ];

        foreach ($tags as $name) {
            Tag::firstOrCreate(
                ['slug->nl' => Str::slug($name['nl'])],
                [
                    'name' => $name,
                    'slug' => [
                        'nl' => Str::slug($name['nl']),
                        'en' => Str::slug($name['en']),
                    ],
                ],
            );
        }
    }
}
