<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Services\IPToLocationService;
use App\Services\TrapHerStTranslationService;
use App\Services\WeatherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CityController extends Controller
{
    public function __construct(
        private readonly WeatherService $weatherService,
        private readonly IPToLocationService $ipToLocationService,
        private  readonly  TrapHerStTranslationService $translationService,
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

        $weather = Cache::remember("city_weather_" . $city->name, now()->addDay(), function() use($city) {
            return $this->weatherService->getWeather($city->name);
        }); // Fetch weather for the city

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


    public function getCity()
    {
        $response = Cache::remember(request()->ip() . "_to_location", now()->addHour(), function () {
            return $this->ipToLocationService->getLocation(request()->ip());
        });

        $currentCity = $response['city'] ?? "Almaty";

        $weather = Cache::remember("city_weather_" . $currentCity, now()->addDay(), function() use($currentCity) {
            return $this->weatherService->getWeather($currentCity);
        });

        $city = City::where('name', 'like', $currentCity)->first();
        $frequency = $city?->frequency ?? '106.0 FM';

        $translateKazakhResponse = Cache::remember($currentCity . "_trans_kz", now()->addDay(), function() use($currentCity) {
            return $this->translationService->translate($currentCity);
        });

        $translateRussianResponse = Cache::remember($currentCity . "_trans_ru", now()->addDay(), function() use($currentCity) {
            return $this->translationService->translate($currentCity, to: 'ru');
        });

        $russianCity = $this->decodeUnicode($translateKazakhResponse['translated-text']);
        $kazakhCity = $this->decodeUnicode($translateRussianResponse['translated-text']);

        $locale = app()->getLocale();

        if ($locale == 'ru') {
            return response()->json([
                'name' => $russianCity,
                'weather' => $weather,
                'frequency' => $frequency
            ]);
        } else {
            return response()->json([
                'name' => $kazakhCity,
                'weather' => $weather,
                'frequency' => $frequency
            ]);
        }
    }

    function decodeUnicode($string)
    {
        return json_decode('"' . $string . '"');
    }

}
