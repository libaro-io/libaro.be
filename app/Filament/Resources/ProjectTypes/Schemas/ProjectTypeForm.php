<?php

namespace App\Filament\Resources\ProjectTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProjectTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name.nl')
                    ->label('Name (NL)')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(3),
                TextInput::make('name.en')
                    ->label('Name (EN)')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(3),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(3),
            ])->columns(6);
    }
}
