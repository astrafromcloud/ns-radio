<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class IPToLocationService
{
    public function getLocation(string $ip) {
        $apiKey = config('services.ip2location.api_key');
        $response = Http::get("https://ipinfo.io/{$ip}/json?token={$apiKey}");

        return $response->json();
    }
}
