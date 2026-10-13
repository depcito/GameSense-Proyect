<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Allow the request only for authenticated users with the "admin" role.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user === null) {
            if (Route::has('login')) {
                return redirect()->guest(route('login'));
            }

            abort(401);
        }

        abort_unless($user->role === 'admin', 403);

        return $next($request);
    }
}
