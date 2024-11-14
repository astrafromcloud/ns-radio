<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\{
    WeatherService,
    IPToLocationService,
    TrapHerStTranslationService,
    CityLocationService
};
use App\Http\Resources\CityResource;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\JsonResponse;

class CityController extends Controller
{
    public function __construct(
        private readonly WeatherService                 $weatherService,
        private readonly IPToLocationService            $ipToLocationService,
        private readonly TrapHerStTranslationService    $translationService,
        private readonly CityLocationService            $cityService,
    )
    {
    }

    public function index()
    {

        $cities = City::all();
        $locale = app()->getLocale();

        $data = $cities->map(function ($city) use ($locale) {
            return [
                'name' => $city->getTranslation('name', $locale),
                'frequency' => $city->frequency
            ];
        });

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'frequency' => 'required|string|max:255',
        ]);

        $city = City::create($validatedData);
        return response()->json($city, 201);
    }

    public function show($id)
    {
        $city = City::findOrFail($id);

//        $locale = app()->getLocale();
//
//        $data = $city->map(function ($city) use ($locale) {
//            return [
//                'name' => $city->getTranslation('name', $locale),
//                'frequency' => $city->frequency
//            ];
//        });

        $weather = Cache::remember("city_weather_" . $city->name, now()->addDay(), function () use ($city) {
            return $this->weatherService->getWeather($city->name);
        });

        return response()->json([
            'city' => $city,
            'weather' => $weather,
        ]);
    }

    public function update(Request $request, $id)
    {
        $city = City::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'frequency' => 'sometimes|required|string|max:255',
        ]);

        $city->update($validatedData);
        return response()->json($city);
    }

    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        return response()->json(null, 204);
    }


    public function getCity(): JsonResponse
    {

        Log::info('ROME!!!!');

        $clientIp = $this->getClientIp();
        $cityData = $this->getCityData($clientIp);

        Log::info($clientIp);
        Log::info(response()->json($this->decodeUnicode(json_encode($cityData['name'])), 200, [], JSON_PRETTY_PRINT));

        return response()->json(
            CityResource::make($cityData)->resolve()
        );
    }

    private function getClientIp(): string
    {
        $ip = request()->header('X-Forwarded-For') ?? request()->ip();
        return explode(',', $ip)[0];
    }

    private function getCityData(string $clientIp): array
    {
        $location = $this->getCachedLocation($clientIp);
        $currentCity = $location['city'] ?? "Almaty";

        return [
            'name' => $this->getTranslatedCityName($currentCity),
            'weather' => $this->getCachedWeather($currentCity),
            'frequency' => $this->getCityFrequency($currentCity),
        ];
    }

    private function getCachedLocation(string $ip): array
    {
        return Cache::remember(
            "location_{$ip}",
            now()->addHour(),
            fn() => $this->ipToLocationService->getLocation($ip)
        );
    }

    private function getCachedWeather(string $city): array
    {
        return Cache::remember(
            "weather_{$city}",
            now()->addMinutes(30),
            fn() => $this->weatherService->getWeather($city)
        );
    }

    private function getTranslatedCityName(string $city): string
    {
        $locale = app()->getLocale();
        $cacheKey = "city_translation_{$city}_{$locale}";

        return Cache::remember(
            $cacheKey,
            now()->addDay(),
            fn() => $this->translateCity($city, $locale)
        );
    }

    private function translateCity(string $city, string $locale): string
    {
        $translation = $this->translationService->translate(
            text: $city,
            from: 'en',
            to: $locale,
        );

        return $this->decodeUnicode($translation['translated-text'] ?? $city);
    }

    private function getCityFrequency(string $cityName): string
    {
        return $this->cityService->getCityFrequency($cityName);
    }

    private function decodeUnicode(string $string): string
    {
        return json_decode('"' . $string . '"') ?? $string;
    }
}
