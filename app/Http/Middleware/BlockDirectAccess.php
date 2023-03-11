<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BlockDirectAccess
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
        if ($request->server('HTTP_REFERER') == null || strpos($request->server('HTTP_REFERER'), url('/')) !== 0) {
            return abort(404);
        }

        return $next($request);
    }
}
