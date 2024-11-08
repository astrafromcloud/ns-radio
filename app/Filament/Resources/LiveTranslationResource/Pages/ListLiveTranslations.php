<?php

namespace App\Filament\Resources\LiveTranslationResource\Pages;

use App\Filament\Resources\LiveTranslationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLiveTranslations extends ListRecords
{
    protected static string $resource = LiveTranslationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
