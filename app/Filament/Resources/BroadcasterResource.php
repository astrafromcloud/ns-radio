<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BroadcasterResource\Pages;
use App\Models\Broadcaster;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class BroadcasterResource extends Resource
{
    protected static ?string $model = Broadcaster::class;
    protected static ?string $navigationIcon = 'heroicon-o-radio';
    protected static ?string $navigationLabel = 'Broadcasters';
    protected static ?string $modelLabel = 'Broadcaster';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter broadcaster name')
                            ->autofocus(),

                        Forms\Components\TextInput::make('description')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter short description'),

                        Forms\Components\FileUpload::make('image_path')
                            ->required()
                            ->image()
                            ->maxSize(5120) // 5MB
                            ->directory('broadcasters')
                            ->visibility('public')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080'),

                        Forms\Components\RichEditor::make('bio')
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
                            ->columnSpanFull(),

                        Forms\Components\Section::make('Social Media Links')
                            ->schema([
                                Forms\Components\TextInput::make('instagram_url')
                                    ->url()
                                    ->prefix('https://')
                                    ->placeholder('instagram.com/username'),

                                Forms\Components\TextInput::make('youtube_url')
                                    ->url()
                                    ->prefix('https://')
                                    ->placeholder('youtube.com/channel'),

                                Forms\Components\TextInput::make('whatsapp_url')
                                    ->url()
                                    ->prefix('https://')
                                    ->placeholder('wa.me/number'),

                                Forms\Components\TextInput::make('telegram_url')
                                    ->url()
                                    ->prefix('https://')
                                    ->placeholder('t.me/username'),
                            ])
                            ->columns(2)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->square()
                    ->size(50),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->sortable()
                    ->limit(30),

                Tables\Columns\IconColumn::make('instagram_url')
                    ->boolean()
                    ->label('Instagram')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),

                Tables\Columns\IconColumn::make('youtube_url')
                    ->boolean()
                    ->label('YouTube')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('has_social_media')
                    ->options([
                        'instagram' => 'Has Instagram',
                        'youtube' => 'Has YouTube',
                        'whatsapp' => 'Has WhatsApp',
                        'telegram' => 'Has Telegram',
                    ])
                    ->query(function (Builder $query, array $data) {
                        return match ($data['value']) {
                            'instagram' => $query->whereNotNull('instagram_url'),
                            'youtube' => $query->whereNotNull('youtube_url'),
                            'whatsapp' => $query->whereNotNull('whatsapp_url'),
                            'telegram' => $query->whereNotNull('telegram_url'),
                            default => $query
                        };
                    })
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function (Broadcaster $record) {
                        // Delete the image when deleting the record
                        if ($record->image_path) {
                            Storage::delete($record->image_path);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            // Delete images for bulk deleted records
                            foreach ($records as $record) {
                                if ($record->image_path) {
                                    Storage::delete($record->image_path);
                                }
                            }
                        }),
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
}
