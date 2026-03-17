<?php

namespace App\Filament\Resources\ProjectTypes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProjectTypesTable
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
                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable(),
                TextColumn::make('projects_count')
                    ->label('Projects')
                    ->counts('projects'),
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
