<?php

namespace App\Filament\Traits;

use App\Models\Tag;
use Filament\Forms\Components\Select;

trait HasTagsField
{
    public static function getTagsField(): Select
    {
        return Select::make('tags')
            ->label('Tags')
            ->relationship(
                name: 'tags',
                titleAttribute: 'name',
                modifyQueryUsing: fn ($query) => $query
                    ->withCount('projects')
                    ->orderByDesc('projects_count')
                    ->orderBy('name'),
            )
            ->getOptionLabelFromRecordUsing(fn (Tag $record) => $record->getTranslatedName())
            ->multiple()
            ->searchable()
            ->preload()
            ->maxItems(5)
            ->maxItemsMessage('You can select a maximum of 5 tags.')
            ->columnSpanFull();
    }
}
