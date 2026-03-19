<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Blogs\BlogResource;
use App\Models\Blog;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class LatestBlogs extends TableWidget
{
    protected static ?int $sort = 4;

    protected static ?string $heading = 'Latest Blogs';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Blog::query()
                    ->latest('publish_date')
                    ->limit(5),
            )
            ->columns([
                TextColumn::make('title')
                    ->limit(40)
                    ->url(fn (Blog $record) => BlogResource::getUrl('edit', ['record' => $record])),
                TextColumn::make('author'),
                TextColumn::make('publish_date')
                    ->label('Published')
                    ->date('d M Y'),
                IconColumn::make('visible')
                    ->boolean(),
                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->since(),
            ])
            ->paginated(false);
    }
}
