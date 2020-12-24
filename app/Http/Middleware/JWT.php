<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (Exception $exception) {
            if ($exception instanceof TokenInvalidException) {
                return response()->json(['error' => 'Token is invalid'], 400);
            } else if ($exception instanceof TokenExpiredException) {
                // $refreshed = JWTAuth::refresh(JWTAuth::getToken());
                // $user = JWTAuth::setToken($refreshed)->toUser();
                // $request->headers->set('Authorization', 'Bearer ' . $refreshed);
                return response()->json(['error' => 'Token is Expired'], 400);
            } else if ($exception instanceof JWTException) {
                return response()->json(['error' => 'There is problem with your token'], 400);
            }
        }
        return $next($request);
    }
}
