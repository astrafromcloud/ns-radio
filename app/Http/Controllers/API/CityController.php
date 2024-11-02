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

    public function getWeather()
    {
        $cityName = $this->getCity();
        $apiKey = '082d24b2afae40eba43210130243110';
        $response = Http::get("http://api.weatherapi.com/v1/current.json?key={$apiKey}&q={$cityName}");

        if ($response->successful()) {
            return $response->json()['current']['temp_c'];
        }

        return $response->json();
    }

    public function getCity() : string
    {
        $response = Http::get("https://ipinfo.io/json?token=7c784a69a464b4");

        if ($response->successful()) {
            return $response->json()['city'] ?? 'Unknown City';
        }
        return 'Almaty - Default';
    }

}
