<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use GrahamCampbell\Throttle\Facades\Throttle;
use App;
use Symfony\Component\HttpFoundation\Response;

class ThrottleMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $throttler = Throttle::get($request, 5, 1);
        Throttle::attempt($request);
        if (!$throttler->check()) {
            App::abort(429, 'Too many requests');
        }

        return $next($request);
    }
}
