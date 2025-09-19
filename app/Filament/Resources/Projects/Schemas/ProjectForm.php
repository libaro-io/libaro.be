<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->columnSpan(3)
                    ->maxLength(255),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->columnSpan(3)
                    ->maxLength(255),
                TextInput::make('type')
                    ->label('Type')
                    ->required()
                    ->columnSpan(3)
                    ->maxLength(255),
                TextInput::make('client_url')
                    ->label('Client URL')
                    ->url()
                    ->columnSpan(3)
                    ->maxLength(255),
                Select::make('client_id')
                    ->label('Client')
                    ->relationship('client', 'name')
                    ->searchable()
                    ->preload()
                    ->columnSpan(3)
                    ->required(),
                DatePicker::make('date')
                    ->columnSpan(3)
                    ->label('Date'),
                RichEditor::make('description')
                    ->columnSpanFull()
                    ->grow()
                    ->label('Description')
                    ->required(),
                TagsInput::make('tags')
                    ->separator(',')
                    ->columnSpanFull(),
                Toggle::make('visible')
                    ->label('Visible')
                    ->required()
                    ->columnSpan(2)
                    ->default(true),
                Toggle::make('is_product')
                    ->label('Is Product')
                    ->required()
                    ->columnSpan(2)
                    ->default(false),
                Toggle::make('pin_on_homepage')
                    ->label('Pin on Homepage')
                    ->required()
                    ->columnSpan(2)
                    ->default(false),
                Repeater::make('content')
                    ->relationship('content')
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
            ])->columns(6);
    }
}
