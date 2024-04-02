<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasPermissions;
use App\Models\identity;
use App\Models\ContactDetail;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create($affiliate_code=null): View
    {
        
        return view('backend/auth/register',compact('affiliate_code'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function store(Request $request): JsonResponse
    // {
    //     // Apply the throttle middleware
    //     $throttleResponse = $this->throttle($request);
    //     if ($throttleResponse) {
    //         return $throttleResponse;
    //     }

    //     // Validate the request data, including checking affiliate code
    //     $validator = Validator::make($request->all(), [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', Rules\Password::defaults()],
    //         'affiliate_code' => [
    //             'nullable',
    //             Rule::exists('users', 'affiliate_code')->where(function ($query) {
    //                 $query->whereNotNull('affiliate_code');
    //             }),
    //         ],
    //     ]);
    
    //     // If validation fails, return the error response
    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 422);
    //     }
    
    //     // Create the user
    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'status' => 'active',
    //         'affiliate_code' => $request->name . '_' . Str::random(6)
    //     ]);
    
    //     // If an affiliate code is provided, update the 'referred_by' column
    //     if ($request->has('affiliate_code')) {
    //         $affiliateUser = User::where('affiliate_code', $request->affiliate_code)->first();
    
    //         if (!$affiliateUser) {
    //             return response()->json(['errors' => ['Invalid affiliate code.']], 422);
    //         }
    
    //         $user->referred_by = $affiliateUser->id;
    //         $user->save();
    //     }
    
    //     // Assign the 'B2C' role
    //     $user->assignRole('B2C');
    
    //     // Dispatch the Registered event
    //     event(new Registered($user));

    //     return response()->json(['message' => 'Your account has been created. You may login now.'], 201);
    // }

    public function store(Request $request): JsonResponse
    {
        // Validate the request data, including checking termsAndPrivacy
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()], 
            // 'termsAndPrivacy' => ['required', 'accepted'],
            // 'affiliate_code' => [
            //             'nullable',
            //             Rule::exists('users', 'affiliate_code')->where(function ($query) {
            //                 $query->whereNotNull('affiliate_code');
            //             }),
            //         ],
            // 'agent'=>[
            //     ['required','in:yes,no']
            // ],
        ]);
    
        // If validation fails, return the error response
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

         // Create a new user
         $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' =>Hash::make($request->input('password')),
            'affiliate_code' => $request->name . '_' . Str::random(6),
            'status'=>'active'
        ]);
          // If an affiliate code is provided, update the 'referred_by' column
        if ($request->has('affiliate_code')) {
            $affiliateUser = User::where('affiliate_code', $request->affiliate_code)->first();
    
            if (!$affiliateUser) {
                return response()->json(['success'=>false,'errors' => ['Invalid affiliate code.']], 422);
            }
    
            $user->referred_by = $affiliateUser->id;
            $user->save();
        }
    
       $user->assignRole('B2C');
       
        return response()->json([
            'message' => 'User registered successfully.',
            'success' => true,
            'redirect_url'=>route('login')
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
