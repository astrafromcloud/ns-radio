<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramResource\Pages;
use App\Models\Program;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;

    protected static ?string $navigationLabel = 'Programs';

    protected static ?string $navigationIcon = 'heroicon-o-play';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(self::getNameLabel())
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('from')
                    ->label(self::getFromLabel())
                    ->nullable(),
                Forms\Components\TextInput::make('to')
                    ->label(self::getToLabel())
                    ->nullable(),
                Forms\Components\FileUpload::make('image')
                    ->label(self::getImageLabel())
                    ->image()
                    ->nullable(),
                Forms\Components\Select::make('broadcasters')
                    ->label(self::getBroadcastersLabel())
                    ->multiple()
                    ->relationship('broadcasters', 'name', function (Builder $query) {
                        return $query->select('broadcasters.id', 'broadcasters.name')->distinct();
                    })->distinct()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('description')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('image_path')
                            ->image()
                            ->required(),
                        Forms\Components\Textarea::make('bio')
                            ->required(),
                        Forms\Components\TextInput::make('instagram_url')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('youtube_url')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('whatsapp_url')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('telegram_url')
                            ->url()
                            ->maxLength(255),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label(self::getImageLabel())
                    ->alignCenter()
                    ->circular()
                    ->size(80),
                Tables\Columns\TextColumn::make('name')
                    ->label(self::getNameLabel())
                    ->alignCenter()
                    ->searchable(),
                Tables\Columns\TextColumn::make('from')
                    ->label(self::getFromLabel())
                    ->alignCenter()
                    ->numeric(),
//                    ->sortable(),
                Tables\Columns\TextColumn::make('to')
                    ->label(self::getToLabel())
                    ->alignCenter()
                    ->numeric(),
//                    ->sortable(),
                Tables\Columns\TextColumn::make('broadcasters.name')
                    ->label(self::getBroadcastersLabel())
                    ->alignCenter()
                    ->badge()
                    ->separator(','),
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
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            'edit' => Pages\EditProgram::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('program.model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('program.navigation_label');
    }

    public static function getPluralLabel() : ?string
    {
        return __('program.plural_model');
    }

    public static function getNameLabel(): ?string
    {
        return trans('program.name_label');
    }

    public static function getImageLabel(): ?string
    {
        return trans('program.image_label');
    }

    public static function getFromLabel(): ?string
    {
        return trans('program.from_label');
    }

    public static function getToLabel(): ?string
    {
        return trans('program.to_label');
    }
    public static function getBroadcastersLabel(): ?string
    {
        return trans('program.broadcasters_label');
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
