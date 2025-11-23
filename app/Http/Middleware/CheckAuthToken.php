<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Http;

class CheckAuthToken
{
    public function handle($request, Closure $next)
    {   
        // Obtiene el token Bearer del encabezado Authorization
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['error' => 'Token no proporcionado'], 401);
        }

        $response = Http::withToken($token)
            ->get('http://192.168.100.92:8000/api/validate-token'); // URL del microservicio de autenticación

        if (!$response->ok()) {
            return response()->json(['error' => 'Token inválido'], 401);
        }

        // Opcional: guardar datos del usuario autenticado en el request
        $request->merge(['auth_user' => $response->json('user')]);

        return $next($request);
    }
}
