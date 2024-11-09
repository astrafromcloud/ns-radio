<?php

namespace App\Services;

use App\Models\City;
use Illuminate\Support\Facades\Cache;
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

class TranslationService
{
    private const API_ENDPOINT = "https://trap.her.st/api/translate/";

    public function translate(
        string $text,
        string $from = "en",
        string $to = "kk",
        string $engine = "google"
    ): array
    {
        try {
            $response = Http::timeout(3)
                ->retry(2, 100)
                ->get(self::API_ENDPOINT, [
                    'engine' => $engine,
                    'from' => $from,
                    'to' => $to,
                    'text' => $text
                ]);

            return $response->json();
        } catch (ConnectionException $e) {
            Log::error('Translation API error', ['error' => $e->getMessage()]);
            return ['translated-text' => $text];
        }
    }
}

class CityService
{
    public function getFrequency(string $cityName): string
    {
//        return Cache::remember(
//            "city_frequency_{$cityName}",
//            now()->addWeek(),
//            function () use ($cityName) {
                return City::where('name->en', $cityName)->value('frequency');
//            }
//        );
    }
}
