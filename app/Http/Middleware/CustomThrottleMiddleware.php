<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomThrottleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $limiter = app(\Illuminate\Cache\RateLimiter::class);

        if ($limiter->tooManyAttempts($this->throttleKey($request), $this->maxAttempts())) {
            $response = response()->json(['errors' => ['Too many attempts. Please try again later.']], 429);
            $retryAfter = $limiter->availableIn($this->throttleKey($request));

            return $response->header('Retry-After', $retryAfter);
        }

        $limiter->hit($this->throttleKey($request));

        return $next($request);
    }
        protected function throttleKey(Request $request): string
        {
            return sha1($request->ip());
        }

        protected function maxAttempts(): int
        {
            return 20; // Adjust as needed
        }

        protected function decayMinutes(): int
        {
            return 1; // Adjust as needed
        }
}
