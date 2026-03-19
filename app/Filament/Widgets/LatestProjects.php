<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Projects\ProjectResource;
use App\Models\Project;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class LatestProjects extends TableWidget
{
    protected static ?int $sort = 3;

    protected static ?string $heading = 'Latest Projects';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Project::query()
                    ->with('client', 'projectType')
                    ->latest('updated_at')
                    ->limit(5),
            )
            ->columns([
                TextColumn::make('name')
                    ->limit(30)
                    ->url(fn (Project $record) => ProjectResource::getUrl('edit', ['record' => $record])),
                TextColumn::make('client.name')
                    ->label('Client'),
                TextColumn::make('projectType.slug')
                    ->label('Type')
                    ->badge(),
                IconColumn::make('visible')
                    ->boolean(),
                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->since(),
            ])
            ->paginated(false);
    }
}
