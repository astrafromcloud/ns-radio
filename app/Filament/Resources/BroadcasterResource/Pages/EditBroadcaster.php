<?php

namespace App\Filament\Resources\BroadcasterResource\Pages;

use App\Filament\Resources\BroadcasterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBroadcaster extends EditRecord
{
    protected static string $resource = BroadcasterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
