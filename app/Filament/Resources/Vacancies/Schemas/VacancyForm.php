<?php

namespace App\Filament\Resources\Vacancies\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;

class VacancyForm
{
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
                Repeater::make('competencies')
                    ->relationship('competencies')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->columnSpan(1)
                            ->maxLength(255),
                        TextInput::make('number')
                            ->numeric()
                            ->label('Number')
                            ->columnSpan(1)
                            ->required(),
                        RichEditor::make('body')
                            ->maxLength(1000)
                            ->columnSpanFull(),
                        Toggle::make('visible')
                            ->label('Visible')
                            ->required(),
                    ])
                    ->columnSpanFull()
                    ->columns(2)
                    ->addActionLabel('Add Competence')
                    ->collapsible()
                    ->itemLabel(fn(array $state): ?string => $state['title'] ?? null),
            ]);
    }
}
