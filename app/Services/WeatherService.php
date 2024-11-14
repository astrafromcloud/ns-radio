<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Exceptions\Custom;
use Illuminate\Http\Client\ConnectionException;

class WeatherService
{
    private const API_ENDPOINT = "http://api.weatherapi.com/v1/current.json";

    public function getWeather(string $cityName): array
    {
        try {
            $response = Http::timeout(3)
                ->retry(2, 100)
                ->get(self::API_ENDPOINT, [
                    'key' => config('services.weather.api_key'),
                    'q' => $cityName,
                    'lang' => 'ru'
                ]);

            if ($response->successful()) {
                $data = $response->json();
                return [
                    $data['current']['temp_c'] ?? null,
                    $data['current']['condition'] ?? null
                ];
            }

            throw new Custom("Weather API error: " . $response->body());
        } catch (ConnectionException $e) {
            Log::error('Weather API connection error', ['error' => $e->getMessage()]);
            return [null, null];
        }
    }
}