<?php

namespace App\Http\Middleware;

use App\Services\AuthService;
use App\Services\RedisService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Redis::exists($request->bearerToken())) {
            $checkType = new RedisService()->get($request->bearerToken());
            if ($checkType['type'] == 'session') {
                return $next($request);
            }
        }
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
