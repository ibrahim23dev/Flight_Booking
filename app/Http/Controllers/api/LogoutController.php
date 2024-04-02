<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
class LogoutController extends Controller
{
    public function logout(): JsonResponse
    {
        $user = Auth::user();

        // Revoke all tokens for the user
        $user->tokens()->delete();

        // Perform standard logout
        Auth::guard('web')->logout();

        return response()->json(['message' => 'Logged out successfully.']);
    }

}
