<?php

namespace App\Filament\Resources\Tags\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TagForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name.nl')
                    ->label('Name (NL)')
                    ->required()
                    ->maxLength(100)
                    ->columnSpan(3),
                TextInput::make('name.en')
                    ->label('Name (EN)')
                    ->required()
                    ->maxLength(100)
                    ->columnSpan(3),
            ])->columns(6);
    }
}
