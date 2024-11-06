<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Models\City;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;

class CityLocationService
{
    private const DEFAULT_CITY = 'Almaty';
    private const CACHE_DURATION_LOCATION = 3600; // 1 hour
    private const CACHE_DURATION_TRANSLATION = 86400; // 1 day

    public function __construct(
        private readonly IPToLocationService $ipToLocationService,
        private readonly WeatherService $weatherService,
        private readonly TrapHerStTranslationService $translationService
    ) {}

    public function getCityDetails(): JsonResponse
    {
        try {
            $clientIp = $this->getClientIp();
            $currentCity = $this->getCurrentCity($clientIp);
            $weather = $this->weatherService->getWeather($currentCity);
            $frequency = $this->getCityFrequency($currentCity);
            $translatedNames = $this->getTranslatedCityNames($currentCity);

            return $this->formatResponse($translatedNames, $weather, $frequency);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch city details',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function getClientIp(): string
    {
        $ip = request()->header('X-Forwarded-For');
        if (!$ip) {
            $ip = request()->ip();
        }

        return $ip;
    }

    private function getCurrentCity(string $ip): string
    {
        $cacheKey = "{$ip}_to_location";

        $locationData = Cache::remember(
            $cacheKey,
            now()->addSeconds(self::CACHE_DURATION_LOCATION),
            fn () => $this->ipToLocationService->getLocation($ip)
        );

        return $locationData['city'] ?? self::DEFAULT_CITY;
    }

    private function getCityFrequency(string $cityName): string
    {
        $city = City::where('name', 'like', $cityName)->first();
        return $city?->frequency ?? '106.0 FM';
    }

    private function getTranslatedCityNames(string $cityName): array
    {
        $russianName = Cache::remember(
            "{$cityName}_trans_ru",
            now()->addSeconds(self::CACHE_DURATION_TRANSLATION),
            fn () => $this->decodeUnicode(
                $this->translationService->translate($cityName, to: 'ru')['translated-text']
            )
        );

        $kazakhName = Cache::remember(
            "{$cityName}_trans_kz",
            now()->addSeconds(self::CACHE_DURATION_TRANSLATION),
            fn () => $this->decodeUnicode(
                $this->translationService->translate($cityName)['translated-text']
            )
        );

        return [
            'ru' => $russianName,
            'kz' => $kazakhName
        ];
    }

    private function formatResponse(array $translatedNames, array $weather, string $frequency): JsonResponse
    {
        $locale = app()->getLocale();

        return response()->json([
            'name' => $translatedNames[$locale] ?? $translatedNames['ru'],
            'weather' => $weather['temperature'],
            'conditions' => $weather['conditions'],
            'frequency' => $frequency
        ]);
    }

    private function decodeUnicode(string $string): string
    {
        return json_decode('"' . $string . '"') ?? $string;
    }
}
