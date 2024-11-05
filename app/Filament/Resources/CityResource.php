<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CityResource\Pages;
use App\Models\City;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CityResource extends Resource
{
    protected static ?string $model = City::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $modelLabel = 'City';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        TextInput::make('name.ru')
                            ->label(self::getEnterCityRussianLabel())
                            ->required()
                            ->autofocus()
                            ->default(fn ($record) => $record ? $record->getTranslation('name', 'ru') : ''),
                        TextInput::make('name.kk')
                            ->label(self::getEnterCityKazakhLabel())
                            ->required()
                            ->default(fn ($record) => $record ? $record->getTranslation('name', 'kk') : ''),
                        Forms\Components\TextInput::make(self::getFrequencyLabel())
                            ->required()
                            ->maxLength(255)
                            ->placeholder(self::getEnterRadioFrequencyLabel()),
                    ])
                    ->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('frequency')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListCities::route('/'),
            'create' => Pages\CreateCity::route('/create'),
            'edit' => Pages\EditCity::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('city.navigation_label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('city.plural_label');
    }

    public static function getEnterRadioFrequencyLabel(): ?string {
        return __('city.enter_radio_frequency');
    }

    public static function getEnterCityKazakhLabel(): ?string
    {
        return __('city.city_name_kazakh');
    }

    public static function getEnterCityRussianLabel(): ?string
    {
        return __('city.city_name_russian');
    }

    public static function getFrequencyLabel(): ?string
    {
        return __('city.frequency');
    }

}
