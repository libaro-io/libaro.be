<?php

namespace App\Filament\Resources\Tags\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TagsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name.nl')
                    ->label('Name (NL)')
                    ->searchable(),
                TextColumn::make('name.en')
                    ->label('Name (EN)')
                    ->searchable(),
                TextColumn::make('projects_count')
                    ->label('Projects')
                    ->counts('projects'),
                TextColumn::make('blogs_count')
                    ->label('Blogs')
                    ->counts('blogs'),
            ])
            ->filters([])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
