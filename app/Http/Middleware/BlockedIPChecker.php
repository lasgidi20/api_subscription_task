<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockedIPChecker
{
    public function handle(Request $request, Closure $next): Response
    {
        $restrictedIps = ['127.0.0.1','102.129.158.0'];
        if(in_array($request->ip(), $restrictedIps)){
            App:abort(403, 'Request forbidden');
        } else {
            return $next($request);
        }
    }
}
