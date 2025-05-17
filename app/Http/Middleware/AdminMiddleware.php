<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check if user is authenticated and is admin
        if (!Session::has('user_id') || !Session::get('is_admin')) {
            // Different response for API vs web
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Admin access required'], 403);
            }
            return redirect()->route('login.form')->with('error', 'Admin privileges required');
        }

        return $next($request);
    }
}