<?php

namespace App\Filament\Traits;

use App\Filament\FilamentBlockType;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;

trait HasFilamentBlocks
{
    public static function getBlocksRepeater(): Repeater
    {
        return Repeater::make('blocks')
            ->relationship('blocks')
            ->schema([
                Select::make('type')
                    ->label('Block Type')
                    ->options(FilamentBlockType::options())
                    ->required()
                    ->live()
                    ->columnSpan(5),
                \Filament\Forms\Components\TextInput::make('sort')
                    ->label('Sort')
                    ->numeric()
                    ->columnSpan(1),
                FileUpload::make('content.image')
                    ->label('Image')
                    ->image()
                    ->disk('public')
                    ->directory('blocks')
                    ->visibility('public')
                    ->columnSpanFull()
                    ->visible(fn($state, $get): bool => in_array($get('type'), [
                        FilamentBlockType::Image->value,
                        FilamentBlockType::ImageText->value,
                    ])),
                RichEditor::make('content.text')
                    ->label('Text')
                    ->columnSpanFull()
                    ->visible(fn($state, $get): bool => in_array($get('type'), [
                        FilamentBlockType::Text->value,
                        FilamentBlockType::ImageText->value,
                    ])),
            ])
            ->columnSpanFull()
            ->columns(6)
            ->addActionLabel('Add Block')
            ->collapsible()
            ->itemLabel(fn(array $state): ?string => $state['type'] ?? 'New Block');
    }
}
