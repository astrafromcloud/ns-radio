<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if the 'locale' header is present
        if ($request->hasHeader('locale')) {
            $locale = $request->header('locale');

            // Check if the locale is supported
            if (in_array($locale, ['ru', 'kk'])) {
                App::setLocale($locale); // Set the locale
            } else {
                App::setLocale('ru'); // Default to Russian if unsupported
            }
        }

        return $next($request);
    }
}
