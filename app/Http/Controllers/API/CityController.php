<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::all();
        return response()->json($cities);
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
        $weather = $this->getWeather($city->name); // Fetch weather for the city
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

    public function getWeather($cityName) : string
    {
        $apiKey = '082d24b2afae40eba43210130243110';
        $response = Http::get("http://api.weatherapi.com/v1/current.json?key={$apiKey}&q={$cityName}");

        if ($response->successful()) {
            return $response->json()['current']['temp_c'];
        }

        return $response->json();
    }

    public function getCity()
    {

        $cities = City::all();

        // Тест үшін
//        $address = "45.86.82.205";
//        $response = Http::get("https://ipinfo.io/{$address}/json?token=7c784a69a464b4");

        $response = Http::get("https://ipinfo.io/json?token=7c784a69a464b4");

        $currentCity = $response['city'];

        $weather = $this->getWeather($currentCity);

        $data = json_decode($cities->where('name', $currentCity), true);
        $frequency = reset($data)['frequency'] ?? '106.0 FM';

        $translateKazakhResponse = Http::get("https://trap.her.st/api/translate/", [
            "engine" => 'google',
            'from' => 'en',
            'to' => 'kk',
            'text' => $currentCity
        ]);

        $translateRussianResponse = Http::get("https://trap.her.st/api/translate/", [
            "engine" => 'google',
            'from' => 'en',
            'to' => 'ru',
            'text' => $currentCity
        ]);

        $russianCity = $this->decodeUnicode($translateKazakhResponse['translated-text']);
        $kazakhCity = $this->decodeUnicode($translateRussianResponse['translated-text']);

        return json_encode([
            'ru' => $russianCity,
            'kz' => $kazakhCity,
            'weather' => $weather,
            'frequency' => $frequency
        ], JSON_UNESCAPED_UNICODE);
    }

    function decodeUnicode($string) {
        return json_decode('"' . $string . '"');
    }

}
