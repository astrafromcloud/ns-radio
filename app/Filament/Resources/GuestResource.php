<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuestResource\Pages;
use App\Models\Guest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
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

                        Forms\Components\Select::make('video_type')
                            ->label(self::getVideoTypeLabel())
                            ->options([
                                'vk' => 'VK',
                                'youtube' => 'YouTube',
                            ])
                            ->required()
                            ->live(),

                        Forms\Components\TextInput::make('video_url')
                            ->label(__('broadcaster.youtube_url_label'))
                            ->placeholder('https://www.youtube.com/')
                            ->prefixIcon('icon-youtube')
                            ->visible(fn(Forms\Get $get) => $get('video_type') === 'youtube')
                            ->suffixAction(
                                Forms\Components\Actions\Action::make('visit')
                                    ->icon('heroicon-m-arrow-top-right-on-square')
                                    ->url(fn($record) => $record?->youtube_url, true)
                            ),

                        Forms\Components\TextInput::make('video_url')
                            ->label(__('broadcaster.vk_url_label'))
                            ->placeholder('https://www.vk.com/')
                            ->prefixIcon('icon-vk')
                            ->visible(fn(Forms\Get $get) => $get('video_type') === 'vk')
                            ->suffixAction(
                                Forms\Components\Actions\Action::make('visit')
                                    ->icon('heroicon-m-arrow-top-right-on-square')
                                    ->url(fn($record) => $record?->youtube_url, true)
                            ),

                        Forms\Components\Select::make('program_id')
                            ->columnSpanFull()
                            ->label(__('broadcaster.programs_label'))
                            // ->multiple()
                            ->relationship('program', 'name')
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('from')
                                    ->numeric()
                                    ->nullable(),
                                Forms\Components\TextInput::make('to')
                                    ->numeric()
                                    ->nullable(),
                                Forms\Components\FileUpload::make('image')
                                    ->image()
                                    ->nullable(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label(self::getImageLabel())
                    ->alignCenter()
                    ->circular()
                    ->size(80),

                Tables\Columns\TextColumn::make('name')
                    ->label(self::getNameLabel())
                    ->alignCenter()
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('hashtag')
                    ->label(self::getHashtagLabel())
                    ->alignCenter()
                    ->searchable(),

                IconColumn::make('video_type')
                    ->label(self::getVideoTypeLabel())
                    ->alignCenter()
                    ->icon(fn(string $state): string => match ($state) {
                        'vk' => 'icon-vk',
                        'youtube' => 'icon-youtube',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([])
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

    public static function getModelLabel(): string
    {
        return __('guest.model_label');
    }

    public static function getNameLabel(): string
    {
        return __('guest.name_label');
    }

    public static function getImageLabel(): string
    {
        return __('guest.image_label');
    }

    public static function getHashtagLabel(): string
    {
        return __('guest.hashtag_label');
    }

    public static function getViewsLabel(): string
    {
        return __('guest.views_label');
    }

    public static function getVideoTypeLabel(): string
    {
        return __('guest.video_type_label');
    }

    public static function getVideoLabel(): string
    {
        return __('guest.video_label');
    }

    public static function getCreatedAtLabel(): string
    {
        return __('lead.created_at_label');
    }

    public static function getUpdatedAtLabel(): string
    {
        return __('lead.updated_at_label');
    }
}
