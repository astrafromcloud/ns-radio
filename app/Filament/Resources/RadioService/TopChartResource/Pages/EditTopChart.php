<?php

namespace App\Filament\Resources\RadioService\TopChartResource\Pages;

use App\Filament\Resources\RadioService\TopChartResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTopChart extends EditRecord
{
    protected static string $resource = TopChartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
