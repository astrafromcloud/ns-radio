<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LiveTranslationResource\Pages;
use App\Models\LiveTranslation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LiveTranslationResource extends Resource
{
    protected static ?string $model = LiveTranslation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('video_url')
                    ->label(__('broadcaster.vk_url_label'))
                    ->placeholder('https://www.vk.com/')
                    ->prefixIcon('icon-vk')
                    ->columnSpanFull()
                    ->suffixAction(
                        Forms\Components\Actions\Action::make('visit')
                            ->icon('heroicon-m-arrow-top-right-on-square')
                            ->url(fn($record) => $record?->youtube_url, true)
                    ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('video_url')
                    ->label(__('broadcaster.vk_url_label'))
                    ->alignCenter()
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('banner.created_at_label'))
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('banner.updated_at_label'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLiveTranslations::route('/'),
            'create' => Pages\CreateLiveTranslation::route('/create'),
            'edit' => Pages\EditLiveTranslation::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('translation.model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('translation.navigation_label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('translation.plural_label');
    }
}
