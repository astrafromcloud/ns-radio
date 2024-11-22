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
        if ($request->hasHeader('locale')) {
            $locale = $request->header('locale');

            if (in_array($locale, ['ru', 'kk'])) {
                App::setLocale($locale);
            } else {
                App::setLocale('ru');
            }
        } else {
            App::setLocale('ru');
        }

        return $next($request);
    }
}
