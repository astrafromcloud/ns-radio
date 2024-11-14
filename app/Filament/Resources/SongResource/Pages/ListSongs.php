<?php

namespace App\Filament\Resources\SongResource\Pages;

use App\Filament\Resources\SongResource;
use App\Models\Song;
use App\Services\SpotifyService;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ListSongs extends ListRecords
{
    protected static string $resource = SongResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            $this->getModel()::count() < 10 ? Action::make('addSong')
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
                        ->getOptionLabelUsing(fn($value): ?string => $value)
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

                    try {
                        $existingTracks = Http::get('http://service.ns-radio.init.kz/bc/tracks');

                        if ($existingTracks->successful()) {
                            $tracks = $existingTracks->json();

                            $existingSong = collect($tracks)->first(function ($track) use ($songDetails) {

                                Log::info('EXISTING SONG: ' . json_encode($songDetails['artists'][0]['name'], JSON_PRETTY_PRINT) . '  EXISTING TRACK: ' . json_encode($track['author'], JSON_PRETTY_PRINT));

                                return strtolower($track['name']) === strtolower($songDetails['name']) &&
                                    strtolower($track['author']) === strtolower($songDetails['artists'][0]['name']);
                            });

                            if ($existingSong) {
                                // If song exists, add it directly to top chart
                                $addToChartTracks = Http::patch('http://service.ns-radio.init.kz/bc/top-chart', [
                                    'id' => $existingSong['id'],
                                ]);


                                if ($addToChartTracks->successful()) {
                                    Notification::make()
                                        ->title('Song added to chart successfully')
                                        ->success()
                                        ->send();
                                    return;
                                } else {
                                    dd('Something went wrong 2');
                                }
                            } else {
                                // If song doesn't exist, create new one
                                $addToTracks = Http::attach(
                                    'image',
                                    file_get_contents($songDetails['album']['images'][0]['url'] ?? ''),
                                    'logo_circle.png'
                                )
                                    ->post('http://service.ns-radio.init.kz/bc/tracks', [
                                        'name' => $songDetails['name'],
                                        'author_name' => $songDetails['artists'][0]['name'],
                                        'has_in_chart' => true
                                    ]);

                                if ($addToTracks->successful()) {
                                    $trackId = $addToTracks->json()['id'];

                                    $addToChartTracks = Http::post('http://service.ns-radio.init.kz/bc/top-chart', [
                                        'id' => $trackId,
                                    ]);

                                    if ($addToChartTracks->successful()) {
                                        Notification::make()
                                            ->title('New song added successfully')
                                            ->success()
                                            ->send();
                                    }
                                }
                            }
                        }

                    } catch (\Exception $e) {
                        Log::error('Error adding song: ' . $e->getMessage());
                        Notification::make()
                            ->title('Error adding song')
                            ->danger()
                            ->send();
                    }
                }) : Action::make('Hidden')->hidden()
        ];
    }
}
