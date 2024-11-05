<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $modelLabel = 'Banner';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\FileUpload::make('image_url')
                            ->label(self::getImageLabel())
                            ->image()
                            ->imageEditor()
                            ->directory('banners')
                            ->visibility('public')
                            ->columnSpanFull()
                            ->required(fn ($get) => empty($get('video_url'))),

                        Forms\Components\TextInput::make('video_url')
                            ->label(self::getVideoLabel())
                            ->url()
                            ->columnSpanFull()
                            ->required(fn ($get) => empty($get('image_url')))
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label(self::getImageLabel())
                    ->square()
                    ->defaultImageUrl(url('/images/placeholder.png')),

                Tables\Columns\TextColumn::make('video_url')
                    ->label(self::getVideoLabel())
                    ->searchable()
                    ->toggleable(),

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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }

    public static function getPluralLabel() : string
    {
        return __('banner.plural_label');
    }

    public static function getModelLabel() : string
    {
        return __('banner.model_label');
    }

    public static function getImageLabel() : string
    {
        return __('banner.image_label');
    }

    public static function getVideoLabel() : string
    {
        return __('banner.video_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('banner.navigation_label');
    }

}
