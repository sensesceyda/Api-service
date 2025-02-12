<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TokenAuth
{
    public function handle(Request $request, Closure $next)
{
    $apiToken = trim(env('API_TOKEN')); 
    $requestToken = trim($request->header('token')); 

    if (empty($apiToken) || empty($requestToken)) {
        return response()->json([
            'error' => 'Yetkilendirme hatası: API token eksik.',
            'env_token' => $apiToken,
            'gelen_token' => $requestToken
        ], 401);
    }

    if (!hash_equals($apiToken, $requestToken)) {
        return response()->json([
            'error' => 'Yetkilendirme hatası: API token uyuşmuyor.',
            'env_token' => $apiToken,
            'gelen_token' => $requestToken
        ], 401);
    }

    return $next($request);
}

}
