<?php

namespace App\Filament\Widgets;

use App\Models\Tag;
use Filament\Widgets\ChartWidget;

class TagUsageChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected ?string $heading = 'Tag Usage';

    protected ?string $maxHeight = '300px';

    protected int|string|array $columnSpan = 'full';

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        $tags = Tag::query()
            ->withCount('projects', 'blogs')
            ->orderByDesc('projects_count')
            ->limit(10)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Projects',
                    'data' => $tags->pluck('projects_count')->all(),
                    'backgroundColor' => 'rgba(56, 189, 248, 0.6)',
                    'borderColor' => 'rgb(56, 189, 248)',
                    'borderWidth' => 1,
                ],
                [
                    'label' => 'Blogs',
                    'data' => $tags->pluck('blogs_count')->all(),
                    'backgroundColor' => 'rgba(125, 211, 252, 0.4)',
                    'borderColor' => 'rgb(125, 211, 252)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $tags->map(fn (Tag $tag) => $tag->getTranslatedName())->all(),
        ];
    }
}
