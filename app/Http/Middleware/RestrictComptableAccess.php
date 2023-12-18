<?php

namespace App\Http\Middleware;

use Closure;

class RestrictComptableAccess
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
        // Check if the user is authenticated and has the 'comptable' role
        if (auth()->check() && auth()->user()->hasRole('comptable')) {
            // Deny access for comptable user
            abort(403, 'Unauthorized');
        }

        // Allow access for other users
        return $next($request);
    }
}
