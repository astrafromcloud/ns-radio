<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class IPToLocationService
{
    private const API_ENDPOINT = "https://ipinfo.io";

    public function getLocation(string $ip): array
    {
        try {
            $response = Http::timeout(3)
                ->retry(2, 100)
                ->get(self::API_ENDPOINT . "/{$ip}/json", [
                    'token' => config('services.ip2location.api_key')
                ]);

            return $response->json();
        } catch (ConnectionException $e) {
            Log::error('IP Location API error', ['error' => $e->getMessage()]);
            return ['city' => 'Almaty'];
        }
    }
}
