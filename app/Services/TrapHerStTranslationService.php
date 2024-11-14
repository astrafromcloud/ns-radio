<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TrapHerStTranslationService
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
