<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SpotifyService
{
    private $clientId;
    private $clientSecret;

    public function __construct()
    {
        $this->clientId = config('services.spotify.client_id');
        $this->clientSecret = config('services.spotify.client_secret');
    }

    public function getAccessToken()
    {
        $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
            'grant_type' => 'client_credentials',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ]);

        return $response->json()['access_token'] ?? null;
    }

    public function searchSong($query)
    {
        $accessToken = $this->getAccessToken();
        $response = Http::withToken($accessToken)->get('https://api.spotify.com/v1/search', [
            'q' => $query,
            'type' => 'track',
            'limit' => 5
        ]);

        return $response->json();
    }

    public function getSongDetails($spotifyId)
    {
        $accessToken = $this->getAccessToken();
        $response = Http::withToken($accessToken)->get("https://api.spotify.com/v1/tracks/{$spotifyId}");

        return $response->json();
    }
}
