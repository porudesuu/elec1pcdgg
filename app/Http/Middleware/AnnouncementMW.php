<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AnnouncementMW
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        echo "HOY PANSININ MO TONG ANNOUNCE KO OR ELSE MASISIRA LAPTOP MO!";
        return $next($request);
    }
}
