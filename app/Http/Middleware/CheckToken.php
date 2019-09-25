<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class CheckToken
{
    public function handle($request, Closure $next, $guard = NULL)
    {
        if (!$request->bearerToken()) {
            return response()->json(
                [
                    'message' => 'Unauthorized'
                ]
            )->setStatusCode(401);
        }

        if (!auth()->guard('api')->check()) {
            return response()->json(
                [
                    'message' => 'Unauthorized'
                ]
            )->setStatusCode(401);
        }

        return $next($request);
    }
}
