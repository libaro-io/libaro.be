<?php

namespace App\Filament\Resources\Blogs\Schemas;

use App\Filament\Traits\HasFilamentBlocks;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BlogForm
{
    use HasFilamentBlocks;

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
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('author')
                    ->columnSpan(2),
                DatePicker::make('publish_date')
                    ->columnSpan(2),
                TextInput::make('link')
                    ->columnSpan(2),
                FileUpload::make('image')
                    ->label('Image (1000px height and webp only)')
                    ->required()
                    ->acceptedFileTypes(['image/webp'])
                    ->disk('s3')
                    ->directory('blogs')
                    ->visibility('public')
                    ->preserveFilenames()
                    ->rules([
                        'dimensions:height=1000',
                    ])
                    ->columnSpanFull(),
                TagsInput::make('tags')
                    ->separator(',')
                    ->columnSpanFull(),
                Toggle::make('visible')
                    ->required(),
                Toggle::make('pin_on_homepage')
                    ->required(),
                self::getBlocksRepeater(),
            ])->columns(6);
    }
}
