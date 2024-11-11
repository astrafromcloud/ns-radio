<?php

namespace App\Filament\Resources\SongResource\Pages;

use App\Filament\Resources\SongResource;
use App\Services\SpotifyService;
use App\Models\Song;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms\Get;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class ListSongs extends ListRecords
{
    protected static string $resource = SongResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('addSong')
                ->label('Add Song')
                ->form([
                    Select::make('song_id')
                        ->label('Select a song')
                        ->searchable()
                        ->getSearchResultsUsing(function (string $search) {
                            if (empty($search)) {
                                return [];
                            }

                            $spotifyService = app(SpotifyService::class);
                            $results = $spotifyService->searchSong($search);

                            return collect($results['tracks']['items'] ?? [])
                                ->map(function ($track) {
                                    // Store full track data in the options array
                                    return [
                                        'id' => $track['id'],
                                        'label' => "{$track['name']} - {$track['artists'][0]['name']}",
                                        'title' => $track['name'],
                                        'artist' => $track['artists'][0]['name'],
                                        'image_url' => $track['album']['images'][0]['url'] ?? null,
                                    ];
                                })
                                ->pluck('label', 'id')
                                ->toArray();
                        })
                        ->getOptionLabelUsing(fn ($value): ?string => $value)
                        ->required()
                ])
                ->action(function (array $data) {
                    $spotifyService = app(SpotifyService::class);
                    $songDetails = $spotifyService->getSongDetails($data['song_id']);

                    if (!$songDetails) {
                        Notification::make()
                            ->title('Error fetching song details')
                            ->danger()
                            ->send();
                        return;
                    }

                    // Check if song already exists
                    $existingSong = Song::where('title', $songDetails['name'])
                        ->where('artist', $songDetails['artists'][0]['name'])
                        ->first();

                    if ($existingSong) {
                        Notification::make()
                            ->title('Song already exists in the database')
                            ->warning()
                            ->send();
                        return;
                    }

                    // Create new song
                    Song::create([
                        'title' => $songDetails['name'],
                        'artist' => $songDetails['artists'][0]['name'],
                        'image_url' => $songDetails['album']['images'][0]['url'] ?? null,
                    ]);

                    Notification::make()
                        ->title('Song added successfully')
                        ->success()
                        ->send();
                })
        ];
    }
}
