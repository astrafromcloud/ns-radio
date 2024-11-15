<?php

namespace App\Filament\Resources\RadioService\AuthorResource\RelationManagers;

use App\Filament\Components\GoFileUpload;
use App\Utils\StrUtils;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

class TracksRelationManager extends RelationManager
{
    protected static string $relationship = 'tracks';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __("radio-content.authors.labels.tracks", ['author' => $ownerRecord->name]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make(__("radio-content.tracks.labels.details"))
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->live(false, 500)
                            ->afterStateUpdated(function (Set $set, Get $get) {
                                $set('sanitized_name', StrUtils::sanitize($get('name')));
                            })
                            ->label(__("radio-content.tracks.labels.name")),
                        Forms\Components\Select::make('author_tracks')
                            ->relationship('author', 'name')
                            ->native(false)
                            ->required()
                            ->default(function (RelationManager $livewire) {
                                return $livewire->getOwnerRecord()->id;
                            })
                            ->disabled()
                            ->label(__("radio-content.tracks.labels.author")),
                        Forms\Components\TextInput::make('sanitized_name')
                            ->label(__("radio-content.tracks.labels.sanitized"))
                            ->disabled(),
                        Forms\Components\TextInput::make('likes_count')
                            ->numeric()
                            ->default(0)
                            ->disabled()
                            ->label(__("radio-content.tracks.labels.likes")),
                    ]),
                Forms\Components\Fieldset::make(__("radio-content.tracks.labels.image"))
                    ->relationship("image")
                    ->schema([
                        GoFileUpload::make('name')
                            ->hiddenLabel()
                            ->image()
                            ->directory('songs')
                            ->columnSpanFull()
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__("radio-content.tracks.labels.id"))
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label(__("radio-content.tracks.labels.image"))
                    ->getStateUsing(function ($record) {
                        if (!$record?->image?->name)
                            return url()->to("/img/default-track.png");

                        return GoFileUpload::getImageUrl($record->image->name);
                    })
                    ->toggleable()
                    ->height("76px")
                    ->width("76px"),
                Tables\Columns\TextColumn::make('name')
                    ->label(__("radio-content.tracks.labels.name"))
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('author.name')
                    ->label(__("radio-content.tracks.labels.author"))
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('likes_count')
                    ->label(__("radio-content.tracks.labels.likes"))
                    ->sortable()
                    ->badge()
                    ->toggleable()
                    ->color("success"),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__("radio-content.tracks.labels.updated"))
                    ->dateTimeTooltip()
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__("radio-content.tracks.labels.created"))
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
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
            ])->groups([
                Tables\Grouping\Group::make('author.name')
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
            ->defaultSort('created_at', 'desc')
            ->poll("5s")
            ->defaultPaginationPageOption(25);
    }
}
