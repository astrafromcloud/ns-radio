<?php

namespace App\Filament\Resources\RadioService;

use App\Filament\Components\GoFileUpload;
use App\Filament\Resources\RadioService\TrackResource\Pages;
use App\Filament\Resources\RadioService\TrackResource\RelationManagers;
use App\Models\Golang\RadioService\Track;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TrackResource extends Resource
{
    protected static ?string $model = Track::class;

    protected static ?string $navigationIcon = 'heroicon-o-musical-note';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Track Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->label('Track Name'),
                        Forms\Components\TextInput::make('sanitized_name')
                            ->label('Sanitized Name'),
                        Forms\Components\Select::make('author_tracks')
                            ->relationship('author', 'name')
                            ->required()
                            ->label('Author'),
                        Forms\Components\TextInput::make('likes_count')
                            ->numeric()
                            ->disabled()
                            ->label('Likes Count'),
                    ]),
                Forms\Components\Fieldset::make('Track Image')
                    ->relationship("image")
                    ->schema([
                        GoFileUpload::make('name')
                            ->label('Track Image')
                            ->image()
                            ->directory('songs')
                            ->columnSpanFull()
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->getStateUsing(function ($record) {
                        return GoFileUpload::getImageUrl($record->image->name);
                    }),
                Tables\Columns\TextColumn::make('name')
                    ->label('Track Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('author.name')
                    ->label('Author')
                    ->searchable(),
                Tables\Columns\TextColumn::make('likes_count')
                    ->label('Likes'),
            ])
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTracks::route('/'),
            'create' => Pages\CreateTrack::route('/create'),
            'edit' => Pages\EditTrack::route('/{record}/edit'),
        ];
    }


    public static function getModelLabel(): string
    {
        return __('radio-content.model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('radio-content.navigation_label');
    }

    public static function getNavigationGroup(): string
    {
        return __('radio-content.navigation_group_label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('radio-content.plural_label');
    }
}
