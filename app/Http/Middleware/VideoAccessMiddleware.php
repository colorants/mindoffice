<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VideoAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // app/Http/Middleware/VideoAccessMiddleware.php

    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Check if the user is an admin or the video is active
        if ($user && ($user->isAdmin() || $request->route('video')->active)) {
            return $next($request);
        }

        // Redirect guests or show an error message
        abort(403, 'Unauthorized access.');

        // Alternatively, you can redirect guests to a login page:
        // return redirect()->route('login');

        // Or show a custom error view:
        // return response()->view('errors.custom', [], 403);
    }

}
