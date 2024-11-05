<?php

namespace App\Filament\Widgets;

use App\Models\Lead;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LeadsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Leads', Lead::count())
                ->description('Total number of leads')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),

            Stat::make('Today\'s Leads', Lead::whereDate('created_at', today())->count())
                ->description('Leads received today')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('primary'),

            Stat::make('This Month\'s Leads', Lead::whereMonth('created_at', now()->month)->count())
                ->description('Leads received this month')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('info'),
        ];
    }
}
