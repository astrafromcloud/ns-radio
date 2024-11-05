<?php

namespace App\Filament\Resources;

namespace App\Filament\Resources;

use App\Filament\Resources\BroadcasterResource\Pages;
use App\Models\Broadcaster;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BroadcasterResource extends Resource
{
    protected static ?string $model = Broadcaster::class;
    protected static ?string $navigationIcon = 'heroicon-o-radio';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('broadcaster.name_label'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image_path')
                    ->label(__('broadcaster.image_path_label'))
                    ->image()
                    ->required(),
                Forms\Components\RichEditor::make('bio.ru')
                    ->label(__('broadcaster.bio_label'))
                    ->required()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'link',
                        'bulletList',
                        'orderedList',
                        'redo',
                        'undo',
                    ])
                    ->default(fn($record) => $record ? $record->getTranslation('name', 'ru') : '')
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('bio.kk')
                    ->label(__('broadcaster.bio_label'))
                    ->required()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'link',
                        'bulletList',
                        'orderedList',
                        'redo',
                        'undo',
                    ])
                    ->columnSpanFull()
                    ->default(fn($record) => $record ? $record->getTranslation('name', 'kk') : ''),
                Forms\Components\TextInput::make('whatsapp_url')
                    ->label(__('broadcaster.whatsapp_url_label'))
                    ->url()
                    ->maxLength(255),
                Forms\Components\TextInput::make('youtube_url')
                    ->label(__('broadcaster.youtube_url_label'))
                    ->url()
                    ->maxLength(255),
                Forms\Components\TextInput::make('instagram_url')
                    ->label(__('broadcaster.instagram_url_label'))
                    ->url()
                    ->maxLength(255),
                Forms\Components\TextInput::make('telegram_url')
                    ->label(__('broadcaster.telegram_url_label'))
                    ->url()
                    ->maxLength(255),
                Forms\Components\Select::make('programs')
                    ->label(__('broadcaster.programs_label'))
                    ->multiple()
                    ->relationship('programs', 'name')
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label(__('broadcaster.image_path_label'))
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('broadcaster.name_label'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('programs.name')
                    ->label(__('broadcaster.programs_label'))
                    ->badge()
                    ->separator(','),
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
            'index' => Pages\ListBroadcasters::route('/'),
            'create' => Pages\CreateBroadcaster::route('/create'),
            'edit' => Pages\EditBroadcaster::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return trans('broadcaster.navigation_label');
    }

    public static function getPluralLabel(): ?string
    {
        return trans('broadcaster.plural_label');
    }

    public static function getNameLabel(): ?string
    {
        return trans('broadcaster.name_label');
    }

    public static function getBioLabelRussian(): ?string
    {
        return trans('broadcaster.bio_label_russian');
    }

    public static function getBioLabelKazakh(): ?string
    {
        return trans('broadcaster.bio_label_russian');
    }

    public static function getImagePathLabel(): ?string
    {
        return trans('broadcaster.image_path_label');
    }

    public static function getInstagramUrlLabel(): ?string
    {
        return trans('broadcaster.instagram_url_label');
    }

    public static function getYoutubeUrlLabel(): ?string
    {
        return trans('broadcaster.youtube_url_label');
    }

    public static function getWhatsappUrlLabel(): ?string
    {
        return trans('broadcaster.whatsapp_url_label');
    }

    public static function getTelegramUrlLabel(): ?string
    {
        return trans('broadcaster.telegram_url_label');
    }

    public static function getProgramsLabel(): ?string
    {
        return trans('broadcaster.programs_label');
    }

    public static function getModelLabel(): string
    {
        return __('broadcaster.model_label');
    }

}
