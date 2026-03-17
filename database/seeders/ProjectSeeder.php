<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
                'project_type_slug' => 'webapplicatie',
                'tag_names' => ['Robaws', 'Webapplicatie', 'Tijdsregistratie'],
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
                'project_type_slug' => 'webapplicatie',
                'tag_names' => ['Webapplicatie'],
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
                'project_type_slug' => 'webapplicatie',
                'tag_names' => ['Robaws', 'Webapplicatie', 'Tijdsregistratie'],
                'visible' => true,
                'is_product' => false,
                'pin_on_homepage' => true,
                'date' => '2024-03-01',
                'client_name' => 'Libaro',
            ],
        ];

        foreach ($projects as $data) {
            $clientName = $data['client_name'];
            $projectTypeSlug = $data['project_type_slug'];
            $tagNames = $data['tag_names'];
            unset($data['client_name'], $data['project_type_slug'], $data['tag_names']);

            $client = Client::where('name', $clientName)->first();
            $projectType = ProjectType::where('slug', $projectTypeSlug)->first();
            $data['client_id'] = $client?->id;
            $data['project_type_id'] = $projectType?->id;

            $project = Project::firstOrCreate(
                ['slug' => $data['slug']],
                $data
            );

            $tagIds = collect($tagNames)->map(
                fn (string $name) => Tag::where('slug->nl', Str::slug($name))->first()?->id
            )->filter()->all();

            $project->tags()->syncWithoutDetaching($tagIds);
        }
    }
}
