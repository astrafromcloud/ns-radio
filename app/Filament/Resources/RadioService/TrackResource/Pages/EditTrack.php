<?php

namespace App\Filament\Resources\RadioService\TrackResource\Pages;

use App\Filament\Resources\RadioService\TrackResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTrack extends EditRecord
{
    protected static string $resource = TrackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
