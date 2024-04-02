<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use App\Models\identity;
use App\Models\ContactDetail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {

        return view('backend/auth/login');
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request): RedirectResponse
    // {
        
    //     $request->authenticate();
    //     if(Auth::user()->status==='inactive'){
    //        Auth::guard('web')->logout();
            
    //       return redirect('login')->with('error','It seems your account status is blocked');

    //     }

    //     $request->session()->regenerate();

    //     User::where('id',auth()->user()->id)
    //     ->update(['active_status' => true]);
    //     return redirect('/dashboard');
    // }

    public function store(Request $request): JsonResponse
    {
        // Validate the request data, including checking affiliate code
        $validator = Validator::make($request->all(), [
          
            'email' => ['required', 'string', 'email'],
            'password' => ['required','string'],
            
        ]);
        // If validation fails, return the error response
        if ($validator->fails()) {
            return response()->json(['success'=>false,'errors' => $validator->errors()], 422);
        }
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {

            return response()->json(['success'=>false,'message' =>'The provided credentials are incorrect.']);

        }

        $user = Auth::user();
        
        if ($user->status == 'inactive') {
            Auth::guard('web')->logout();
            return response()->json(['success'=>false,'message' =>'It seems your account status is blocked.'], 401);
        }

        User::where('id',auth()->user()->id)
        ->update(['active_status' => true]);
        return response()->json([
            'message' => 'Logged in successfully.',
            'success' => true,
        ]);
    }

    /**
     * Destroy an authenticated session.
     */


    public function destroy(Request $request): RedirectResponse
    {
        User::where('id',auth()->user()->id)
        ->update(['active_status' => false]);
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');

    }
}
