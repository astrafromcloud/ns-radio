<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SongResource\Pages;
use App\Models\Song;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SongResource extends Resource
{
    protected static ?string $model = Song::class;

    protected static ?string $navigationIcon = 'heroicon-o-musical-note';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('artist')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image_url')
                    ->label('Image')
                    ->image(),
                Forms\Components\TextInput::make('likes')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label(self::getImageLabel())
                    ->default('/storage/logo/logo_circle.png')
                    ->circular()
                    ->size(80)
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('name')
                    ->label(self::getTitleLabel())
                    ->alignCenter()
                    ->searchable(),
                Tables\Columns\TextColumn::make('author_name')
                    ->label(self::getArtistLabel())
                    ->alignCenter()
                    ->searchable(),
                Tables\Columns\TextColumn::make('likes')
                    ->label(self::getLikesLabel())
                    ->alignCenter()
                    ->numeric(),
            ])
            ->paginated(false)
            ->searchable(false)
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('delete')
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->action(function ($record) {
                        try {
                            $response = Http::delete('http://service.ns-radio.init.kz/bc/top-chart/' . $record->id);

                            if ($response->successful()) {
                                Log::info("Song deleted successfully", ['song_id' => $record->id]);

                                // Force refresh the model
                                $record->refresh();

                                // Clear the Sushi cache
                                Song::clearBootedModels();

                                // Show success notification
                                Notification::make()
                                    ->title('Song deleted successfully')
                                    ->success()
                                    ->send();
                            } else {
                                Notification::make()
                                    ->title('Error deleting song')
                                    ->danger()
                                    ->send();
                            }
                        } catch (\Exception $e) {
                            Log::error("Error deleting song", [
                                'song_id' => $record->id,
                                'error' => $e->getMessage()
                            ]);

                            Notification::make()
                                ->title('Error deleting song')
                                ->danger()
                                ->send();
                        }
                        return false;
                    }
                    ),
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
            'index' => Pages\ListSongs::route('/'),
            'create' => Pages\CreateSong::route('/create'),
            'edit' => Pages\EditSong::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('song.model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('song.navigation_label');
    }

    public static function getNavigationGroup(): string
    {
        return __('song.navigation_group_label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('song.plural_label');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function getImageLabel(): ?string
    {
        return __('song.image_label');
    }

    public static function getTitleLabel(): ?string
    {
        return __('song.title_label');
    }

    public static function getLikesLabel(): ?string
    {
        return __('song.likes_label');
    }

    public static function getArtistLabel(): ?string
    {
        return __('song.artist_label');
    }

    public static function getCreatedAtLabel(): ?string
    {
        return __('song.created_at_label');
    }

    public static function getUpdatedAtLabel(): ?string
    {
        return __('song.updated_at_label');
    }
}
