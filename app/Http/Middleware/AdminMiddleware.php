<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminMiddleware
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
        if (auth()->user()->role == 'admin') {
            return $next($request);
        }

        if (auth()->user()->role == 'staff') {
            $routes = ['product', 'category', 'order', 'logout'];
            foreach ($routes as $route) {
                if (str_contains($request->route()->uri(), $route)) {
                    return $next($request);
                }
            }
            return abort(Response::HTTP_FORBIDDEN);
        }

        return abort(Response::HTTP_FORBIDDEN);
    }
}
