<?php

namespace App\Filament\Resources\Blogs\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BlogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->columnSpan(3),
                TextInput::make('slug')
                    ->required()
                    ->columnSpan(3),
                RichEditor::make('body')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('author')
                    ->columnSpan(2),
                DatePicker::make('publish_date')
                    ->columnSpan(2),
                TextInput::make('link')
                    ->columnSpan(2) ,
                TagsInput::make('tags')
                    ->separator(',')
                    ->columnSpanFull(),
                Toggle::make('visible')
                    ->required(),
            ])->columns(6);
    }
}
