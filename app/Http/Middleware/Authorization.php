<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next) : Response
    {
        $code = $request->bearerToken();
        $api_access = env('KEY');
        if($code != $api_access)
        {
            return response()->json(['error' => 'not authorized'], 401);
        }

        return $next($request);
    }
}
