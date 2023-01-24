<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Error;

class SanctumAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($response->status() === 500) {
            $error = new Error([
                'status' => 401,
                'title' => 'Unauthorized',
                'detail' => 'You are not authorized to access this resource.'
            ]);

            return response()->json($error, 401);
        }
        return $response;
    }
}
