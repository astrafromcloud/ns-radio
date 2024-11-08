<?php

namespace App\Filament\Resources\LiveTranslationResource\Pages;

use App\Filament\Resources\LiveTranslationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLiveTranslation extends EditRecord
{
    protected static string $resource = LiveTranslationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
