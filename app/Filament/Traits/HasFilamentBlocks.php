<?php

namespace App\Filament\Traits;

use App\Filament\FilamentBlockType;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

trait HasFilamentBlocks
{
    public static function getBlocksRepeater(string $s3Directory = 'blocks'): Repeater
    {
        return Repeater::make('blocks')
            ->relationship('blocks')
            ->orderColumn('sort')
            ->schema([
                Select::make('type')
                    ->label('Block Type')
                    ->options(FilamentBlockType::options())
                    ->required()
                    ->live()
                    ->columnSpanFull(),
                FileUpload::make('content.image')
                    ->label('Image (webp only)')
                    ->acceptedFileTypes(['image/webp'])
                    ->disk('s3')
                    ->directory($s3Directory)
                    ->visibility('public')
                    ->preserveFilenames()
                    ->columnSpanFull()
                    ->visible(fn ($state, $get): bool => in_array($get('type'), [
                        FilamentBlockType::Image->value,
                        FilamentBlockType::ImageText->value,
                        FilamentBlockType::LogoText->value,
                    ])),
                TextInput::make('content.number')
                    ->numeric()
                    ->label('Number')
                    ->columnSpanFull()
                    ->visible(fn ($state, $get): bool => in_array($get('type'), [
                        FilamentBlockType::NumberText->value,
                    ])),
                TextInput::make('content.title')
                    ->label('Title')
                    ->columnSpanFull()
                    ->visible(fn ($state, $get): bool => in_array($get('type'), [
                        FilamentBlockType::NumberText->value,
                    ])),
                RichEditor::make('content.text')
                    ->label('Text')
                    ->columnSpanFull()
                    ->visible(fn ($state, $get): bool => in_array($get('type'), [
                        FilamentBlockType::Text->value,
                        FilamentBlockType::ImageText->value,
                        FilamentBlockType::NumberText->value,
                        FilamentBlockType::LogoText->value,
                    ])),
                Select::make('content.layout')
                    ->label('Layout')
                    ->options([
                        'image_text' => 'Image - Text',
                        'text_image' => 'Text - Image',
                    ])
                    ->required()
                    ->columnSpanFull()
                    ->visible(fn ($state, $get): bool => $get('type') === FilamentBlockType::ImageText->value),
                Repeater::make('content.cards')
                    ->label('Cards')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Icon')
                            ->acceptedFileTypes(['image/webp', 'image/png', 'image/svg+xml'])
                            ->disk('s3')
                            ->directory($s3Directory)
                            ->visibility('public')
                            ->preserveFilenames()
                            ->columnSpanFull(),
                        TextInput::make('title')
                            ->label('Title')
                            ->columnSpanFull(),
                        RichEditor::make('text')
                            ->label('Text')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull()
                    ->addActionLabel('Add Card')
                    ->reorderable()
                    ->collapsible()
                    ->visible(fn ($state, $get): bool => $get('type') === FilamentBlockType::Cards->value),
            ])
            ->columnSpanFull()
            ->columns(6)
            ->addActionLabel('Add Block')
            ->reorderable()
            ->collapsible()
            ->itemLabel(fn (array $state): ?string => $state['type']);
    }
}
