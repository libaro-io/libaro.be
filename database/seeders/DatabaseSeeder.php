<?php

namespace Database\Seeders;

use App\Models\Key;
use App\Models\Quote;
use App\Models\Showcase;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $showcases = Showcase::factory(10)->create();

        foreach ($showcases as $showcase) {
            Key::factory(rand(0, 8))->create(['showcase_id' => $showcase->id]);
            Quote::factory(rand(0, 3))->create(['showcase_id' => $showcase->id]);
        }
    }
}
