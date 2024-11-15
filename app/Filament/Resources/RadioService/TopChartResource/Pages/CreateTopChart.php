<?php

namespace App\Filament\Resources\RadioService\TopChartResource\Pages;

use App\Filament\Resources\RadioService\TopChartResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTopChart extends CreateRecord
{
    protected static string $resource = TopChartResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
