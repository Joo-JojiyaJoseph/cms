<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WardAccessMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $wardId = $request->route('id'); // Get ward ID from route

        if (!$user || ($user->role !== $wardId && $user->role !== 'admin')) {
            abort(403, 'Unauthorized access.');
        }
        
        

        return $next($request);
    }
}
