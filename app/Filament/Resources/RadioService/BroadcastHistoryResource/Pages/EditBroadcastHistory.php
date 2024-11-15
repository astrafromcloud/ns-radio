<?php

namespace App\Filament\Resources\RadioService\BroadcastHistoryResource\Pages;

use App\Filament\Resources\RadioService\BroadcastHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBroadcastHistory extends EditRecord
{
    protected static string $resource = BroadcastHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
