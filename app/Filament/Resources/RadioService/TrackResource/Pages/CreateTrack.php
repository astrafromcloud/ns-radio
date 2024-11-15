<?php

namespace App\Filament\Resources\RadioService\TrackResource\Pages;

use App\Filament\Resources\RadioService\TrackResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTrack extends CreateRecord
{
    protected static string $resource = TrackResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
