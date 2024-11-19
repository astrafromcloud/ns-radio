<?php

namespace App\Filament\Resources\RadioService\BroadcastHistoryResource\Pages;

use App\Filament\Resources\RadioService\BroadcastHistoryResource;
use App\Models\Golang\RadioService\BroadcastHistoryTrack;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Carbon;

class ListBroadcastHistories extends ListRecords
{
    protected static string $resource = BroadcastHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {


        return [
            null => Tab::make(__("radio-content.tracks.labels.tabs.all"))->badge(fn() => cache()->remember(
                "broadcast_history_resource_tab_all",
                now()->addMinute(),
                fn() => BroadcastHistoryTrack::count()
            )),

            'today' => Tab::make(__("radio-content.tracks.labels.tabs.today"))
                ->query(fn($query) => $query->whereDate('created_at', Carbon::today()))
                ->badge(fn() => cache()->remember(
                    "broadcast_history_resource_tab_today",
                    now()->addMinute(),
                    fn() => BroadcastHistoryTrack::whereDate('created_at', Carbon::today())->count()
                )),

            'yesterday' => Tab::make(__("radio-content.tracks.labels.tabs.yesterday"))
                ->query(fn($query) => $query->whereDate('created_at', Carbon::yesterday()))
                ->badge(fn() => cache()->remember(
                    "broadcast_history_resource_tab_yesterday",
                    now()->addMinute(),
                    fn() => BroadcastHistoryTrack::whereDate('created_at', Carbon::yesterday())->count()
                )),

            'this_week' => Tab::make(__("radio-content.tracks.labels.tabs.this_week"))
                ->query(fn($query) => $query->whereBetween('created_at', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ]))
                ->badge(fn() => cache()->remember(
                    "broadcast_history_resource_tab_last_week",
                    now()->addMinute(),
                    fn() => BroadcastHistoryTrack::whereBetween('created_at', [
                        Carbon::now()->startOfWeek(),
                        Carbon::now()->endOfWeek()
                    ])->count()
                )),

            'this_month' => Tab::make(__("radio-content.tracks.labels.tabs.this_month"))
                ->query(fn($query) => $query->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year))
                ->badge(fn() => cache()->remember(
                    "broadcast_history_resource_tab_last_month",
                    now()->addMinute(),
                    fn() => BroadcastHistoryTrack::whereMonth('created_at', Carbon::now()->month)
                        ->whereYear('created_at', Carbon::now()->year)
                        ->count()
                )),

            'this_year' => Tab::make(__("radio-content.tracks.labels.tabs.this_year"))
                ->query(fn($query) => $query->whereYear('created_at', Carbon::now()->year))
                ->badge(fn() => cache()->remember(
                    "broadcast_history_resource_tab_last_year",
                    now()->addMinute(),
                    fn() => BroadcastHistoryTrack::whereYear('created_at', Carbon::now()->year)->count()
                )),
        ];
    }
}
