<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('weight')
                    ->required()
                    ->numeric()
                    ->default(0),
                FileUpload::make('image')
                    ->label('Image (webp only)')
                    ->acceptedFileTypes(['image/webp'])
                    ->disk('s3')
                    ->directory('clients')
                    ->visibility('public')
                    ->preserveFilenames()
                    ->columnSpanFull(),
                Toggle::make('visible')
                    ->required(),
            ]);
    }
}
