<?php

namespace App\Filament\Resources\RadioService\TopChartResource\Pages;

use App\Filament\Resources\RadioService\TopChartResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTopCharts extends ListRecords
{
    protected static string $resource = TopChartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
