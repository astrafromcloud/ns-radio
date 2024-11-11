<?php
//
//namespace App\Services;
//
//use Illuminate\Support\Facades\Http;
//use Illuminate\Http\Client\RequestException;
//
//class IPToLocationService
//{
//    private const API_ENDPOINT = 'https://ipinfo.io';
//
//    public function getLocation(string $ip): array
//    {
//        try {
//            $response = Http::get($this->buildUrl($ip), [
//                'token' => $this->getApiKey()
//            ]);
//
//            $response->throw();
//
//            return $response->json();
//        } catch (RequestException $e) {
//            throw new \RuntimeException("Failed to fetch location data: {$e->getMessage()}");
//        }
//    }
//
//    private function buildUrl(string $ip): string
//    {
//        return self::API_ENDPOINT . "/{$ip}/json";
//    }
//
//    private function getApiKey(): string
//    {
//        $apiKey = config('services.ip2location.api_key');
//
//        if (!$apiKey) {
//            throw new \RuntimeException('IP2Location API key is not configured');
//        }
//
//        return $apiKey;
//    }
//}
