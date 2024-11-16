<?php

namespace App\Filament\Resources\BroadcasterResource\Pages;

use App\Filament\Resources\BroadcasterResource;
use App\Models\BroadcasterViewType;
use Filament\Actions;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\Facades\Log;

class ListBroadcasters extends ListRecords
{
    protected static string $resource = BroadcasterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Change View')
                ->label(self::getBroadcasterViewtypeButtonLabel())
                ->form([
                    Radio::make('type')
                        ->label(self::getBroadcasterViewtypeLabel())
                        ->options([
                            self::getBroadcasterViewtypeLabelList(),
                            self::getBroadcasterViewtypeLabelSlider()
                        ])->default(BroadcasterViewType::first()->type)

                ])->action(
                    function (array $data): void {
                        $type = BroadcasterViewType::first();

                        if ($type) {
                            $type->update(['type' => $data['type']]);
                            $type->fresh();
                        }
                    }
                )
                ->modalWidth(MaxWidth::ExtraLarge),
            Actions\CreateAction::make(),
        ];
    }

    public static function getBroadcasterViewtypeLabel(): string
    {
        return __('broadcaster.type_label');
    }

    public static function getBroadcasterViewtypeButtonLabel(): string
    {
        return __('broadcaster.type_button_label');
    }

    public static function getBroadcasterViewtypeLabelSlider(): string
    {
        return __('broadcaster.type_label_slider');
    }

    public static function getBroadcasterViewtypeLabelList(): string
    {
        return __('broadcaster.type_label_list');
    }
}
