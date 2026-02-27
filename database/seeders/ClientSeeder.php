<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $clients = [
            [
                'name' => 'Defraeye Bob & Careye Betonwerken',
                'image' => null,
                'visible' => true,
                'weight' => 100,
            ],
            [
                'name' => 'Royal Antwerp FC',
                'image' => null,
                'visible' => true,
                'weight' => 90,
            ],
            [
                'name' => 'Libaro',
                'image' => null,
                'visible' => true,
                'weight' => 80,
            ],
            [
                'name' => 'Carro-Bel Group',
                'image' => null,
                'visible' => true,
                'weight' => 70,
            ],
        ];

        foreach ($clients as $data) {
            Client::firstOrCreate(
                ['name' => $data['name']],
                $data
            );
        }
    }
}
