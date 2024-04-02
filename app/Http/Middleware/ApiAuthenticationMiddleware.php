<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthenticationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
       
        $apiKey = '9jMYjM797RDxLPpzxwnAi6MnVP0tfOW6';
        $validIpAddresses = ['127.0.0.1','45.15.26.63']; 

        // Check if the request's IP address is in the list of valid IP addresses.
        // if (!in_array($request->ip(), $validIpAddresses)) {
        //     return response()->json(['message' => 'Unauthorized IP address'], 401);
        // }

        // Check if the request includes a valid API key.
        $requestApiKey = $request->header('X-Api-Key');
        if ($requestApiKey !== $apiKey) {
            return response()->json(['message' => 'Unauthorized API key'], 401);
        }

        return $next($request);
    }
}
