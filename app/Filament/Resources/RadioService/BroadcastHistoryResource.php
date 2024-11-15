<?php

namespace App\Filament\Resources\RadioService;

use App\Filament\Components\GoFileUpload;
use App\Filament\Resources\RadioService\BroadcastHistoryResource\Pages;
use App\Filament\Resources\RadioService\BroadcastHistoryResource\RelationManagers;
use App\Models\Golang\RadioService\Author;
use App\Models\Golang\RadioService\BroadcastHistoryTrack;
use App\Models\Golang\RadioService\Track;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

class BroadcastHistoryResource extends Resource
{
    protected static ?string $model = BroadcastHistoryTrack::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make(__("radio-content.history.labels.details"))
                    ->schema([
                        Forms\Components\Select::make('track_history')
                            ->relationship('track', 'name')
                            ->native(false)
                            ->searchable()
                            ->searchDebounce(500)
                            ->required()
                            ->preload()
                            ->columnSpanFull()
                            ->label(__("radio-content.history.labels.track")),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__("radio-content.history.labels.id"))
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\ImageColumn::make('track.image')
                    ->label(__("radio-content.tracks.labels.image"))
                    ->getStateUsing(function ($record) {
                        if (!$record?->track?->image?->name)
                            return url()->to("/img/default-track.png");

                        return GoFileUpload::getImageUrl($record->track->image->name);
                    })
                    ->toggleable()
                    ->height("76px")
                    ->width("76px")
                    ->url(fn($record) => TrackResource::getUrl("edit", ["record" => $record->track_history])),
                Tables\Columns\TextColumn::make('track.name')
                    ->label(__("radio-content.history.labels.name"))
                    ->sortable()
                    ->toggleable()
                    ->url(fn($record) => TrackResource::getUrl("edit", ["record" => $record->track_history])),
                Tables\Columns\TextColumn::make('track.author.name')
                    ->label(__("radio-content.tracks.labels.author"))
                    ->sortable()
                    ->toggleable()
                    ->searchable()
                    ->url(fn($record) => AuthorResource::getUrl("edit", ["record" => $record->track->author_tracks])),
                Tables\Columns\TextColumn::make('track.likes_count')
                    ->label(__("radio-content.tracks.labels.likes"))
                    ->sortable()
                    ->badge()
                    ->toggleable()
                    ->color("success"),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__("radio-content.history.labels.updated"))
                    ->dateTimeTooltip()
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__("radio-content.history.labels.created"))
                    ->dateTimeTooltip()
                    ->since()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('track.updated_at')
                    ->label(__("radio-content.history.labels.track_updated"))
                    ->dateTimeTooltip()
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('track.created_at')
                    ->label(__("radio-content.history.labels.track_created"))
                    ->dateTimeTooltip()
                    ->since()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\Filter::make("except_name")
                    ->form([
                        Forms\Components\Select::make('track_history')
                            ->relationship('track', 'name')
                            ->native(false)
                            ->searchable()
                            ->searchDebounce(500)
                            ->preload()
                            ->columnSpanFull()
                            ->multiple()
                            ->label(__("radio-content.history.labels.except_track_name")),

                        Forms\Components\Select::make('author_ids')
                            ->relationship('track.author', 'name')
                            ->native(false)
                            ->searchable()
                            ->searchDebounce(500)
                            ->preload()
                            ->columnSpanFull()
                            ->multiple()
                            ->label(__("radio-content.history.labels.except_author_name")),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        $query->when(
                            !empty($data['track_history'] ?? null),
                            fn(Builder $query): Builder => $query->whereNotIn('track_history', $data['track_history']),
                        )->when(
                            !empty($data['author_ids'] ?? null),
                            fn(Builder $query): Builder => $query->whereHas('track', function (Builder $query) use ($data): Builder {
                                return $query->whereNotIn('author_tracks', $data['author_ids']);
                            }),
                        );

                        return $query;
                    })->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if (!empty($data['track_history'] ?? null)) {
                            $indicators['track_history'] = __("radio-content.history.labels.except_track_name_indicator", ['tracks' => Track::whereIn('id', $data['track_history'])->pluck("name")->join(', ')]);
                        }

                        if (!empty($data['author_ids'] ?? null)) {
                            $indicators['author_ids'] = __("radio-content.history.labels.except_author_name_indicator", ['authors' => Author::whereIn('id', $data['author_ids'])->pluck("name")->join(', ')]);
                        }

                        return $indicators;
                    }),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->placeholder(fn(): string => now()->subYear()->addMonth()->translatedFormat('M j, Y'))
                            ->native(false)
                            ->label(__("radio-content.history.labels.created_from")),
                        Forms\Components\DatePicker::make('created_until')
                            ->placeholder(fn(): string => now()->translatedFormat('M j, Y'))
                            ->native(false)
                            ->label(__("radio-content.history.labels.created_until")),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'] ?? null,
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )

                            ->when(
                                $data['created_until'] ?? null,
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_from'] ?? null) {
                            $indicators['created_from'] = 'Order from ' . Carbon::parse($data['created_from'])->toFormattedDateString();
                        }

                        if ($data['created_until'] ?? null) {
                            $indicators['created_until'] = 'Order until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),
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
            ])
            ->groups([
                Tables\Grouping\Group::make('author.name')
                    ->label(__("radio-content.history.labels.author"))
                    ->collapsible(),
                Tables\Grouping\Group::make('updated_at')
                    ->label(__("radio-content.history.labels.updated"))
                    ->date()
                    ->collapsible(),
                Tables\Grouping\Group::make('created_at')
                    ->label(__("radio-content.history.labels.created"))
                    ->date()
                    ->collapsible(),
            ])
            ->defaultSort('created_at', 'desc')
            ->poll("45s")
            ->defaultPaginationPageOption(25);
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
            'index' => Pages\ListBroadcastHistories::route('/'),
            'create' => Pages\CreateBroadcastHistory::route('/create'),
            'edit' => Pages\EditBroadcastHistory::route('/{record}/edit'),
        ];
    }


    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string | array | null
    {
        return 'gray';
    }

    public static function getModelLabel(): string
    {
        return __('radio-content.history.model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('radio-content.history.navigation_label');
    }

    public static function getNavigationGroup(): string
    {
        return __('radio-content.navigation_group_label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('radio-content.history.plural_label');
    }
}
