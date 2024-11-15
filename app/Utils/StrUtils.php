<?php

namespace App\Utils;

use Illuminate\Support\Str;

class StrUtils
{
    public static function sanitize(mixed $str)
    {
        if (!is_string($str))
            return "";

        $str = Str::lower($str); // Convert to lowercase
        $str = Str::trim($str); // Trim whitespace from the start and end
        return Str::replaceMatches('/\s+/', ' ', $str); // Replace multiple spaces with a single space
    }
}
