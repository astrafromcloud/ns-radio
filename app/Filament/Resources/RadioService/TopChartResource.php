<?php

namespace App\Filament\Resources\RadioService;

use App\Filament\Components\GoFileUpload;
use App\Filament\Resources\RadioService\TopChartResource\Pages;
use App\Models\Golang\RadioService\ChartTrack;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class TopChartResource extends Resource
{
    protected static ?string $model = ChartTrack::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make(__("radio-content.top-charts.labels.details"))
                    ->schema([
                        Forms\Components\Select::make('track_chart_track')
                            ->relationship('track', 'name')
                            ->native(false)
                            ->searchable()
                            ->searchDebounce(500)
                            ->required()
                            ->preload()
                            ->columnSpanFull()
                            ->label(__("radio-content.top-charts.labels.track")),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__("radio-content.top-charts.labels.id"))
                    ->sortable()
                    ->width("76px")
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
                    ->url(fn($record) => TrackResource::getUrl("edit", ["record" => $record->track_chart_track])),
                Tables\Columns\TextColumn::make('track.name')
                    ->label(__("radio-content.top-charts.labels.name"))
                    ->sortable()
                    ->toggleable()
                    ->url(fn($record) => TrackResource::getUrl("edit", ["record" => $record->track_chart_track])),
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
                    ->label(__("radio-content.top-charts.labels.updated"))
                    ->dateTimeTooltip()
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__("radio-content.top-charts.labels.created"))
                    ->dateTimeTooltip()
                    ->since()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('track.updated_at')
                    ->label(__("radio-content.top-charts.labels.track_updated"))
                    ->dateTimeTooltip()
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('track.created_at')
                    ->label(__("radio-content.top-charts.labels.track_created"))
                    ->dateTimeTooltip()
                    ->since()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->placeholder(fn(): string => now()->subYear()->addMonth()->translatedFormat('M j, Y'))
                            ->native(false)
                            ->label(__("radio-content.tracks.labels.created_from")),
                        Forms\Components\DatePicker::make('created_until')
                            ->placeholder(fn(): string => now()->translatedFormat('M j, Y'))
                            ->native(false)
                            ->label(__("radio-content.tracks.labels.created_until")),
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
                Tables\Grouping\Group::make('track.author.name')
                    ->label(__("radio-content.tracks.labels.author"))
                    ->collapsible(),
                Tables\Grouping\Group::make('updated_at')
                    ->label(__("radio-content.tracks.labels.updated"))
                    ->date()
                    ->collapsible(),
                Tables\Grouping\Group::make('created_at')
                    ->label(__("radio-content.tracks.labels.created"))
                    ->date()
                    ->collapsible(),
            ])
            ->poll("60s");
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTopCharts::route('/'),
            'create' => Pages\CreateTopChart::route('/create'),
            'edit' => Pages\EditTopChart::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return cache()->remember(
            "top_chart_resource_badge",
            now()->addMinute(),
            fn() => static::getModel()::count()
        );
    }

    public static function getNavigationBadgeColor(): string | array | null
    {
        return 'warning';
    }

    public static function getModelLabel(): string
    {
        return __('radio-content.top-charts.model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('radio-content.top-charts.navigation_label');
    }

    public static function getNavigationGroup(): string
    {
        return __('radio-content.navigation_group_label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('radio-content.top-charts.plural_label');
    }
}
