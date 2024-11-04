<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TrapHerStTranslationService
{
    public function translate(string $text, string $from = "en", string $to = "kk", string $engine = "google") {
        return Http::get("https://trap.her.st/api/translate/", [
            "engine" => $engine,
            'from' => $from,
            'to' => $to,
            'text' => $text
        ])->json();
    }
}
