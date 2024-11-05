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
            Stat::make($this->getDescriptionLabel(), Lead::count())
                ->description($this->getDescriptionStatLabel())
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),

            Stat::make($this->getDescriptionTodayLabel(), Lead::whereDate('created_at', today())->count())
                ->description($this->getDescriptionTodayStatLabel())
                ->descriptionIcon('heroicon-m-calendar')
                ->color('primary'),

            Stat::make($this->getDescriptionMonthLabel(), Lead::whereMonth('created_at', now()->month)->count())
                ->description($this->getDescriptionMonthStatLabel())
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('info'),
        ];
    }

    public function getDescriptionLabel()
    {
        return __('lead.description_label');
    }

    public function getDescriptionTodayLabel()
    {
        return __('lead.description_today_label');
    }

    public function getDescriptionMonthLabel()
    {
        return __('lead.description_month_label');
    }

    public function getDescriptionStatLabel()
    {
        return __('lead.description_stat_label');
    }

    public function getDescriptionTodayStatLabel()
    {
        return __('lead.description_today_stat_label');
    }

    public function getDescriptionMonthStatLabel()
    {
        return __('lead.description_month_stat_label');
    }

}
