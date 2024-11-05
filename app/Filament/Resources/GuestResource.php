<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuestResource\Pages;
use App\Models\Guest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GuestResource extends Resource
{
    protected static ?string $model = Guest::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(self::getNameLabel())
                            ->required()
                            ->maxLength(255),

                        Forms\Components\FileUpload::make('image_url')
                            ->label(self::getImageLabel())
                            ->image()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080')
                            ->directory('guests')
                            ->required(),

                        Forms\Components\TextInput::make('hashtag')
                            ->label(self::getHashtagLabel())
                            ->prefix('#')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('video_url')
                            ->label(self::getVideoLabel())
                            ->required()
                            ->maxLength(255)
                            ->prefix('https://')
                            ->placeholder('youtube.com/watch?v=...'),

                        Forms\Components\TextInput::make('views')
                            ->label(self::getViewsLabel())
                            ->numeric()
                            ->default(0)
                            ->disabled()
                            ->dehydrated(false)
                            ->hint('Views are automatically tracked'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label(self::getImageLabel())
                    ->square()
                    ->size(80),

                Tables\Columns\TextColumn::make('name')
                    ->label(self::getNameLabel())
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('hashtag')
                    ->label(self::getHashtagLabel())
                    ->searchable(),

                Tables\Columns\TextColumn::make('views')
                    ->label(self::getViewsLabel())
                    ->numeric()
                    ->sortable()
                    ->alignRight(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                // Add filters if needed
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('')->color('grey'),
                Tables\Actions\DeleteAction::make()->label(''),
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
            'index' => Pages\ListGuests::route('/'),
            'create' => Pages\CreateGuest::route('/create'),
            'edit' => Pages\EditGuest::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('guest.navigation_label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('guest.plural_label');
    }

    public static function getModelLabel() : string
    {
        return __('guest.model_label');
    }

    public static function getNameLabel() : string
    {
        return __('guest.name_label');
    }
    public static function getImageLabel() : string
    {
        return __('guest.image_label');
    }
    public static function getHashtagLabel() : string
    {
        return __('guest.hashtag_label');
    }
    public static function getViewsLabel() : string
    {
        return __('guest.views_label');
    }

    public static function getVideoLabel() : string
    {
        return __('guest.video_label');
    }
}
