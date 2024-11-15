<?php

namespace App\Filament\Resources\RadioService\BroadcastHistoryResource\Pages;

use App\Filament\Resources\RadioService\BroadcastHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBroadcastHistory extends CreateRecord
{
    protected static string $resource = BroadcastHistoryResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
