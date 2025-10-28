<?php

namespace App\Filament\Resources\Vacancies\Schemas;

use App\Filament\Traits\HasFilamentBlocks;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class VacancyForm
{
    use HasFilamentBlocks;

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('visible')
                    ->required(),
                FileUpload::make('image')
                    ->label('Image (1000px height and webp only)')
                    ->required()
                    ->acceptedFileTypes(['image/webp'])
                    ->disk('s3')
                    ->directory('jobs')
                    ->visibility('public')
                    ->preserveFilenames()
                    ->rules([
                        'dimensions:height=1000',
                    ])
                    ->columnSpanFull(),
                self::getBlocksRepeater(),
            ]);
    }
}
