<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        // Apply the throttle middleware
        $throttleResponse = $this->throttle($request);
        if ($throttleResponse) {
            return $throttleResponse;
        }
        // Validate the request data, including checking affiliate code
        $validator = Validator::make($request->all(), [
          
            'email' => ['required', 'string', 'email'],
            'password' => ['required','string'],
            
        ]);
        // If validation fails, return the error response
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user = Auth::user();
        
        if ($user->status === 'inactive') {
            Auth::guard('web')->logout();
            return response()->json(['errors' => ['It seems your account status is blocked']], 401);
        }

        $user->update(['active_status' => true]);

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Logged in successfully.',
            'user' => $user,
            'token' => $token,
        ]);
    }

    protected function throttle(Request $request): ?JsonResponse
    {
        $limiter = app(\Illuminate\Cache\RateLimiter::class);

        if ($limiter->tooManyAttempts($this->throttleKey($request), $this->maxAttempts(), $this->decayMinutes())) {
            $response = response()->json(['errors' => ['Too many attempts. Please try again later.']], 429);
            $retryAfter = $limiter->availableIn($this->throttleKey($request));

            return $response->header('Retry-After', $retryAfter);
        }

        $limiter->hit($this->throttleKey($request));

        return null;
    }

    protected function throttleKey(Request $request): string
    {
        return sha1($request->ip());
    }

    protected function maxAttempts(): int
    {
        return 10; // Adjust as needed
    }

    protected function decayMinutes(): int
    {
        return 1; // Adjust as needed
    }
}
