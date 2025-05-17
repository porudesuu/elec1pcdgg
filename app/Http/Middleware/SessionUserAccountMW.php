<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SessionUserAccountMW
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated
        if (!Session::has('user_id')) {
            return $this->handleUnauthenticated($request);
        }

        // Check if password needs to be updated (except for logout and update password routes)
        if (
            Session::get('needs_password_update') &&
            !$request->is('update-password*') &&
            !$request->is('logout')
        ) {
            return redirect()->route('update.password.form')
                ->with('info', 'You must update your password before continuing');
        }

        // Get the response
        $response = $next($request);

        // Add no-cache headers to all authenticated responses
        return $response->withHeaders([
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ]);
    }

    protected function handleUnauthenticated($request)
    {
        Session::flush();

        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        return redirect()->route('login.form')
            ->withHeaders([
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0'
            ])
            ->with('error', 'Please login to continue');
    }
}

// class SessionUserAccountMW
// {
//     public function handle($request, Closure $next)
//     {
//         // Check if user session exists
//         if (!Session::has('user')) {
//             // Clear any cached pages
//             return $this->clearCacheAndRedirectToLogin();
//         }

//         // Set headers to prevent caching
//         $response = $next($request);
//         return $this->setNoCacheHeaders($response);
//     }

//     protected function clearCacheAndRedirectToLogin()
//     {
//         return redirect()->route('login.form')
//             ->withHeaders([
//                 'Cache-Control' => 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0',
//                 'Pragma' => 'no-cache',
//                 'Expires' => 'Fri, 01 Jan 1990 00:00:00 GMT'
//             ]);
//     }

//     protected function setNoCacheHeaders($response)
//     {
//         return $response->withHeaders([
//             'Cache-Control' => 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0',
//             'Pragma' => 'no-cache',
//             'Expires' => 'Fri, 01 Jan 1990 00:00:00 GMT'
//         ]);
//     }
// }


// class SessionUserAccountMW
// {
//     public function handle($request, Closure $next)
//     {
//         // Check if user session exists
//         if (!Session::has('user')) {
//             return redirect()->route('login.form')->with('error', 'Please login first');
//         }

//         return $next($request);
//     }
// }


// class SessionUserAccountMW
// {
//     public function handle(Request $request, Closure $next)
//     {
//         if (!Session::has('user')) {
//             return redirect()->route('login.form');
//         }

//         return $next($request);
//     }
// }