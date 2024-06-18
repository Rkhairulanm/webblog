<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class BlogWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $userCount = User::count();
        $postCount = Post::count();
        $categoryCount = Category::count();
        return [
            Stat::make('New Users', User::count())
                ->description('Newly Registered User')
                ->icon('heroicon-o-users')
                ->chart(range(1, $userCount))
                ->color('success'),
            Stat::make('New Categories', User::count())
                ->description('Categories Created')
                ->icon('heroicon-o-tag')
                ->chart(range(1, $postCount))
                ->color('success'),
            Stat::make('New Posts', User::count())
                ->description('Posts Created')
                ->icon('heroicon-o-document-duplicate')
                ->chart(range(1, $categoryCount))
                ->color('success')
        ];
    }
}
