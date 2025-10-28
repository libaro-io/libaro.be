<?php

use App\Filament\FilamentBlockType;
use App\Models\VacancyBlock;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vacancy_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vacancy_id')->constrained('vacancies')->cascadeOnDelete();
            $table->string('type');
            $table->json('content');
            $table->integer('sort')->default(0);
            $table->timestamps();
        });

        DB::table('competences')->get()->each(function ($competence) {
            VacancyBlock::query()->create([
                'vacancy_id' => $competence->vacancy_id,
                'type' => FilamentBlockType::Text,
                'content' => [
                    'text' => $competence->body,
                ],
            ]);
        });

        Schema::dropIfExists('competences');
    }

    public function down(): void
    {
        Schema::dropIfExists('vacancy_blocks');
    }
};
