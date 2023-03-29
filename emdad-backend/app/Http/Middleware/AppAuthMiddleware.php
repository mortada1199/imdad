<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AppAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if ($request->header('x-authorization') !== '$2y$10$s2NTmAatcTQV20jBaBwTHO41n8k0YLZURdoqHs4UEs3WJLkZl8tyK') {
            return response()->json(["success" => false, "error" => "app not authenticated"], 401);
        }

        return $next($request);
    }
}
