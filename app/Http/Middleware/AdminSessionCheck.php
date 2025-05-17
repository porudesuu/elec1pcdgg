<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AdminSessionCheck
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('admin')) {
            return redirect()->route('admin.login');
        }
        return $next($request);
    }
}
