<?php

namespace App\Filament\Widgets;

use App\Models\Blog;
use App\Models\Client;
use App\Models\Project;
use App\Models\Tag;
use App\Models\User;
use App\Models\Vacancy;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalProjects = Project::count();
        $visibleProjects = Project::where('visible', true)->count();
        $totalBlogs = Blog::count();
        $publishedBlogs = Blog::where('visible', true)->count();

        return [
            Stat::make('Projects', $totalProjects)
                ->description($visibleProjects . ' visible')
                ->icon(Heroicon::OutlinedBriefcase)
                ->color('info'),
            Stat::make('Blogs', $totalBlogs)
                ->description($publishedBlogs . ' published')
                ->icon(Heroicon::OutlinedNewspaper)
                ->color('info'),
            Stat::make('Clients', Client::where('visible', true)->count())
                ->description('active clients')
                ->icon(Heroicon::OutlinedBuildingOffice)
                ->color('info'),
            Stat::make('Vacancies', Vacancy::where('visible', true)->count())
                ->description('open positions')
                ->icon(Heroicon::OutlinedMegaphone)
                ->color('info'),
            Stat::make('Tags', Tag::count())
                ->description('in use across content')
                ->icon(Heroicon::OutlinedTag)
                ->color('info'),
            Stat::make('Admins', User::where('is_admin', true)->count())
                ->description('with panel access')
                ->icon(Heroicon::OutlinedUserGroup)
                ->color('info'),
        ];
    }
}
