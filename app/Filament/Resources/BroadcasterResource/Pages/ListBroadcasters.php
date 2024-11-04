<?php

namespace App\Filament\Resources\BroadcasterResource\Pages;

use App\Filament\Resources\BroadcasterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBroadcasters extends ListRecords
{
    protected static string $resource = BroadcasterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
