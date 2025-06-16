<?php

namespace App\Filament\Widgets;

use App\Models\Menu;
use App\Models\Event;
use App\Models\PageVisit;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static bool $isLazy = false;
    protected static ?string $pollingInterval = null;

    protected function getCards(): array
    {
        $totalMenus = Menu::count();
        $totalEvents = Event::count();
        $totalVisitors = PageVisit::count();

        return [
            Stat::make('Total Menu', $totalMenus)
                ->description('Jumlah semua menu')
                ->icon('heroicon-o-clipboard-document-list')
                ->color('success'),

            Stat::make('Total Event', $totalEvents)
                ->description('Jumlah semua event')
                ->icon('heroicon-o-calendar-days')
                ->color('primary'),

            Stat::make('Total Visitor', $totalVisitors)
                ->description('Total pengunjung website')
                ->icon('heroicon-o-eye')
                ->color('info'),
        ];
    }
}