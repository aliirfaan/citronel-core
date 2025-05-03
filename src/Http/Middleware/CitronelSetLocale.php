<?php

namespace aliirfaan\CitronelCore\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CitronelSetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $requested = $request->header('Accept-Language')
            ?? $request->query('lang')
            ?? config('app.locale');

        // Normalize: convert en-US → en
        $locale = strtolower(substr($requested, 0, 2));

        // Optional: only allow known locales
        $supportedLocales = config('citronel.supported_locales', []);
        if (!in_array($locale, $supportedLocales)) {
            $locale = config('app.locale'); // fallback
        }

        App::setLocale($locale);

        return $next($request);
    }
}
