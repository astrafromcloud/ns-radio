<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\RadioService\TrackResource\Pages\ListTracks;
use App\Models\Golang\RadioService\Track;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TracksHeaderWidget extends BaseWidget
{
    use InteractsWithPageTable;

    protected static ?string $pollingInterval = '45s';

    protected function getTablePage(): string
    {
        return ListTracks::class;
    }

    protected function getStats(): array
    {
        return [
            Stat::make(__("radio-content.tracks.labels.stats.total"), cache()->remember(
                "total_tracks_count",
                now()->addMinute(),
                fn() => Track::count()
            ))
                ->color('primary')
                ->icon('heroicon-o-musical-note'),

            Stat::make(__("radio-content.tracks.labels.stats.no_likes"), cache()->remember(
                "total_track_likes_count",
                now()->addMinute(),
                fn() => Track::where('likes_count', 0)->count()
            ))
                ->color('danger')
                ->icon('heroicon-o-heart'),

            Stat::make(__("radio-content.tracks.labels.stats.avg_likes"), cache()->remember(
                "total_track_likes_avg_count",
                now()->addMinute(),
                fn() => number_format(Track::avg('likes_count'), 2)
            ))
                ->color('danger')
                ->icon('heroicon-m-heart'),

            Stat::make(__("radio-content.tracks.labels.stats.today"), cache()->remember(
                "total_track_created_today_count",
                now()->addMinute(),
                fn() => Track::whereDate('created_at', \Carbon\Carbon::today())->count()
            ))
                ->color('info')
                ->icon('heroicon-o-calendar'),
        ];
    }
}
