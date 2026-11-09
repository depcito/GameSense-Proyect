<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Use the language the visitor picked (stored in the session) when it is one of the available ones.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->session()->get('locale');

        if (is_string($locale) && array_key_exists($locale, config('app.available_locales'))) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
