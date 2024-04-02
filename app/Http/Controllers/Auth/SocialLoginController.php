<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;

class SocialLoginController extends Controller
{
    use HasRoles, HasPermissions;

    public function redirectToProvider(Request $request, $provider)
   {
    $request->session()->put('redirect_url', url()->previous());

    $redirectUrl = route('callback', ['provider' => $provider]); // Set the URL for social login
    
    return Socialite::driver($provider)->redirectUrl($redirectUrl)->redirect();
   }

   public function handleProviderCallback(Request $request,$provider)
   {
       $user = Socialite::driver($provider)->user();

       // Check if user already exists based on social ID and provider
       $existingUser = User::where('social_id', $user->getId())
                            ->where('social_provider', $provider)
                            ->first();
   
       if ($existingUser) {
           // Log in the user
           Auth::login($existingUser);
       } else {
           // Check if user with the same email already exists
           $userWithSameEmail = User::where('email', $user->getEmail())->first();
   
           if ($userWithSameEmail) {
               // Handle the situation where the email already exists
               $userWithSameEmail->update([
                'name' => $user->getName(),
                'avatar' => $user->getAvatar(), // Update the avatar URL
                'social_id' => $user->getId(),
                'social_provider' => $provider,
                'social_token' => $user->token, // Update the access token
            ]);

            // Log in the updated user
            Auth::login($userWithSameEmail);
           } else {
               // Create a new user with social media data
               $newUser = User::create([
                   'name' => $user->getName(),
                   'email' => $user->getEmail(),
                   'affiliate_code' => $user->getName() . '_' . Str::random(6),
                   'status'=>'active',
                   'avatar' => $user->getAvatar(), // Store the avatar URL
                   'social_id' => $user->getId(),
                   'social_provider' => $provider,
                   'social_token' => $user->token, // Store the access token
               ]);
   
               // Log in the new user
               Auth::login($newUser);
              $newUser->assignRole('B2C');

           }
       }
        $user=Auth::user();
        $user->login_method='social';
        $user->email_verified_at=now();
        $user->save();

        // Check if there's a  redirect URL 
        if (session()->has('redirect_url')) {
            // Redirect the user back to the original URL
            $redirectUrl = session('redirect_url');
            
            // Forget the stored redirect URL in the session
            session()->forget('redirect_url');
 
            return redirect($redirectUrl);
        }

       return redirect()->route('home'); // Redirect to appropriate page
   }

   
}
