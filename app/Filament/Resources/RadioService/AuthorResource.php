<?php

namespace App\Filament\Resources\RadioService;

use App\Filament\Resources\RadioService\AuthorResource\Pages;
use App\Filament\Resources\RadioService\AuthorResource\RelationManagers;
use App\Filament\Resources\RadioService\AuthorResource\RelationManagers\TracksRelationManager;
use App\Models\Golang\RadioService\Author;
use App\Utils\StrUtils;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AuthorResource extends Resource
{
    protected static ?string $model = Author::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make(__("radio-content.authors.labels.details"))
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->live(false, 500)
                            ->afterStateUpdated(function (Set $set, Get $get) {
                                $set('sanitized_name', StrUtils::sanitize($get('name')));
                            })
                            ->label(__("radio-content.authors.labels.name")),
                        Forms\Components\TextInput::make('sanitized_name')
                            ->label(__("radio-content.authors.labels.sanitized"))
                            ->disabled(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__("radio-content.authors.labels.id"))
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__("radio-content.authors.labels.name"))
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('sanitized_name')
                    ->label(__("radio-content.authors.labels.sanitized"))
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tracks_count')
                    ->label(__("radio-content.authors.labels.track_count"))
                    ->counts('tracks')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
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
            TracksRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAuthors::route('/'),
            'create' => Pages\CreateAuthor::route('/create'),
            'edit' => Pages\EditAuthor::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string | array | null
    {
        return 'info';
    }


    public static function getModelLabel(): string
    {
        return __('radio-content.authors.model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('radio-content.authors.navigation_label');
    }

    public static function getNavigationGroup(): string
    {
        return __('radio-content.navigation_group_label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('radio-content.authors.plural_label');
    }
}
