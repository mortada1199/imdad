<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        // ## This is custom code for remove cors issue ##
        $request->header('Access-Control-Allow-Origin', '*');
        $request->header('Access-Control-Allow-Origin:  http://localhost:5173');
        $request->header('Access-Control-Allow-Origin:  http://172.21.1.116:9090');
        $request->header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Authorization, Origin');
        $request->header('Access-Control-Allow-Methods:  GET, POST, PUT, DELETE, OPTIONS');
        return $next($request);
    }
}
