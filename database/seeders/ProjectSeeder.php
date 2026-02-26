<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(ClientSeeder::class);

        $projects = [
            [
                'name' => 'DECA Time - Slim werfbeheer',
                'slug' => 'deca-time-digitaal-slim-werfbeheer-robaws',
                'description' => 'DECA Time is een digitale oplossing ontwikkeld door Libaro, in samenwerking met Defraeye Bob en Careye Betonwerken. De app vereenvoudigt het volledige proces van planning, uitvoering, tijdsregistratie, controle en facturatie tussen aannemers en onderaannemers. Met een rechtstreekse integratie met het ERP-systeem Robaws biedt DECA Time één gestroomlijnde workflow, van werfplanning tot betaalde factuur.',
                'type' => 'webapplicatie',
                'tags' => 'Laravel, Robaws, time management, werf management, bouwsector, project leiding, webapplicatie, mobiele applicatie',
                'visible' => true,
                'is_product' => false,
                'pin_on_homepage' => true,
                'date' => '2024-01-15',
                'client_name' => 'Defraeye Bob & Careye Betonwerken',
            ],
            [
                'name' => 'Ticketing platform',
                'slug' => 'royal_antwerp_ticketing',
                'description' => 'Een revolutie in het Belgische voetbal. Voor het eerst durft een club het aan om een eigen ticketing platform te bouwen. In enkele maanden tijd werd een volledig ticketing platform van de grond af gebouwd door Libaro. Web applicatie met stadionplan, abonnementen, online verkoop, ticket corner en full integration.',
                'type' => 'webapplicatie',
                'tags' => 'Laravel, ticketing, abonnementen, online verkoop, ticket corner, full integration, webapplicatie',
                'visible' => true,
                'is_product' => false,
                'pin_on_homepage' => true,
                'date' => '2023-06-01',
                'client_name' => 'Royal Antwerp FC',
            ],
            [
                'name' => 'Timecard',
                'slug' => 'timecard',
                'description' => 'De Timecard App vereenvoudigt de dagelijkse prestatieregistratie door teamleiders in de bouwsector. De naadloze integratie met Robaws zorgt ervoor dat alle prestaties moeiteloos verwerkt worden in werkbonnen, voortgangsstaten en facturatie. Inclusief Stripe voor abonnementsfacturatie.',
                'type' => 'webapplicatie',
                'tags' => 'Laravel, Stripe, SaaS, abonnementen, Robaws, tijdsregistratie, bouwsector, webapplicatie',
                'visible' => true,
                'is_product' => false,
                'pin_on_homepage' => true,
                'date' => '2024-03-01',
                'client_name' => 'Libaro',
            ],
            [
                'name' => 'Werf management system',
                'slug' => 'werf-management-carro-bel',
                'description' => 'Maatwerk werfbeheer en projectopvolging voor de bouwsector. Integratie met bestaande ERP en planningstools.',
                'type' => 'webapplicatie',
                'tags' => 'Laravel, werfbeheer, bouwsector, project management, webapplicatie',
                'visible' => true,
                'is_product' => false,
                'pin_on_homepage' => false,
                'date' => '2023-09-01',
                'client_name' => 'Carro-Bel Group',
            ],
            [
                'name' => 'Sendwich - Teamlunch made easy',
                'slug' => 'sendwich-teamlunch',
                'description' => 'Platform voor eenvoudige bestelling en levering van teamlunches. Laravel backend met moderne frontend.',
                'type' => 'webapplicatie',
                'tags' => 'Laravel, e-commerce, platform, webapplicatie',
                'visible' => true,
                'is_product' => false,
                'pin_on_homepage' => false,
                'date' => '2023-04-01',
                'client_name' => 'Libaro',
            ],
        ];

        foreach ($projects as $data) {
            $clientName = $data['client_name'];
            unset($data['client_name']);

            $client = Client::where('name', $clientName)->first();
            $data['client_id'] = $client?->id;

            Project::firstOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
