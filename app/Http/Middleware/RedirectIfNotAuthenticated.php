<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RedirectIfNotAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            // Log pour debugger
            Log::info('Redirection depuis middleware', [
                'guard' => $guard,
                'path' => $request->path()
            ]);

            // Redirection vers le login
            return redirect()->route('login');
        }

        return $next($request);
    }
}
?>