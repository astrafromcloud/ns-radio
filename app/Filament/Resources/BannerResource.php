<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label(self::getIsActiveLabel()),

                        Forms\Components\Select::make('content_type')
                            ->label(self::getContentTypeLabel())
                            ->options([
                                'image' => self::getImageLabel(),
                                'video' => self::getVideoLabel(),
                            ])
                            ->required()
                            ->live(),

                        Forms\Components\FileUpload::make('content')
                            ->label(self::getImageLabel())
                            ->image()
                            ->imageEditor()
                            ->maxSize(5000)
                            ->directory('banners')
                            ->visibility('public')
                            ->columnSpanFull()
                            ->required(fn (Forms\Get $get) => $get('content_type') === 'image')
                            ->visible(fn (Forms\Get $get) => $get('content_type') === 'image'),

                        Forms\Components\FileUpload::make('content')
                            ->label(self::getVideoLabel())
                            ->maxSize(10000)
                            ->acceptedFileTypes(['video/mp4', 'video/ogg'])
                            ->directory('banners')
                            ->visibility('public')
                            ->columnSpanFull()
                            ->visible(fn (Forms\Get $get) => $get('content_type') === 'video')
                            ->required(fn (Forms\Get $get) => $get('content_type') === 'video')

                    ])
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->label(self::getOrderLabel())
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\ViewColumn::make('content')
                    ->alignCenter()
                    ->label(self::getContentLabel())
                    ->view('components.media-column'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(self::getIsActiveLabel())
                    ->alignCenter()
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(self::getCreatedAtLabel())
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(self::getUpdatedAtLabel())
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order')
            ->reorderable('order')
            ->filters([
                //
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }

    public static function getPluralLabel(): string
    {
        return __('banner.plural_label');
    }

    public static function getModelLabel(): string
    {
        return __('banner.model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('banner.navigation_label');
    }

    public static function getImageLabel(): string
    {
        return __('banner.image_label');
    }

    public static function getVideoLabel(): string
    {
        return __('banner.video_label');
    }

    public static function getNavigationGroup(): string
    {
        return __('banner.navigation_group_label');
    }

    public static function getCreatedAtLabel(): string
    {
        return __('lead.created_at_label');
    }

    public static function getUpdatedAtLabel(): string
    {
        return __('lead.updated_at_label');
    }

    public static function getContentLabel(): string
    {
        return __('banner.content_label');
    }

    public static function getIsActiveLabel(): string
    {
        return __('banner.is_active_label');
    }

    public static function getContentTypeLabel(): string
    {
        return __('banner.content_type_label');
    }

    public static function getOrderLabel(): string
    {
        return __('banner.order_label');
    }


}
