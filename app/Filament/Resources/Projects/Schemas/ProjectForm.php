<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Filament\Traits\HasFilamentBlocks;
use App\Filament\Traits\HasTagsField;
use App\Models\ProjectType;
use App\Models\Tag;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectForm
{
    use HasFilamentBlocks;
    use HasTagsField;

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->columnSpan(3)
                    ->maxLength(40)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $state, Set $set) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->columnSpan(3)
                    ->maxLength(255),
                Select::make('project_type_id')
                    ->label('Type')
                    ->options(fn (): array => ProjectType::query()
                        ->get()
                        ->mapWithKeys(fn (ProjectType $type): array => [$type->id => $type->getTranslatedName()])
                        ->all())
                    ->searchable()
                    ->preload()
                    ->columnSpan(3)
                    ->required(),
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
                    ->label('Date')
                    ->native(false)
                    ->default(now()),
                Textarea::make('description')
                    ->columnSpanFull()
                    ->grow()
                    ->rows(10)
                    ->label('Description')
                    ->required(),
                FileUpload::make('preview_image')
                    ->label('Preview Image')
                    ->required()
                    ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/webp'])
                    ->disk('s3')
                    ->directory('projects/preview')
                    ->visibility('public')
                    ->columnSpanFull(),
                FileUpload::make('carousel_images')
                    ->label('Carousel Images')
                    ->multiple()
                    ->required()
                    ->minFiles(1)
                    ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/webp'])
                    ->disk('s3')
                    ->directory('projects/carousel')
                    ->visibility('public')
                    ->reorderable()
                    ->columnSpanFull(),
                self::getProjectTagsField(),
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
                self::getBlocksRepeater(),
            ])->columns(6);
    }

    private static function getProjectTagsField(): Select
    {
        return Select::make('tags')
            ->label('Tags')
            ->relationship(
                name: 'tags',
                titleAttribute: 'name',
                modifyQueryUsing: fn ($query) => $query
                    ->whereNotIn('id', self::getTypeTagIds())
                    ->withCount('projects')
                    ->orderByDesc('projects_count')
                    ->orderBy('name'),
            )
            ->getOptionLabelFromRecordUsing(fn (Tag $record) => $record->getTranslatedName())
            ->multiple()
            ->searchable()
            ->preload()
            ->maxItems(4)
            ->maxItemsMessage('You can select a maximum of 4 tags (the type tag is added automatically).')
            ->helperText('The project type is automatically added as a tag.')
            ->columnSpanFull();
    }

    /**
     * @return array<int>
     */
    private static function getTypeTagIds(): array
    {
        return ProjectType::pluck('slug')
            ->map(fn (string $slug) => Tag::where('slug->nl', '=', $slug)->value('id'))
            ->filter()
            ->values()
            ->all();
    }
}
