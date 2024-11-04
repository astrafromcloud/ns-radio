<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{

    public function getWeather($cityName): string
    {
        $apiKey = config('services.weather.api_key');
        $response = Http::get("http://api.weatherapi.com/v1/current.json?key={$apiKey}&q={$cityName}");

        if ($response->successful()) {
            return $response->json()['current']['temp_c'];
        }

        return $response->json();
    }

}
