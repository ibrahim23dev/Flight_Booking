<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use App\Mail\PasswordResetEmail;
use App\Models\EmailSetting;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Services\EmailService;
class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('backend.auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function store(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'email' => ['required', 'email'],
    //     ]);

    //     // We will send the password reset link to this user. Once we have attempted
    //     // to send the link, we will examine the response then see the message we
    //     // need to show to the user. Finally, we'll send out a proper response.
    //     $status = Password::sendResetLink(
    //         $request->only('email')
    //     );

    //     return $status == Password::RESET_LINK_SENT
    //                 ? back()->with('status', __($status))
    //                 : back()->withInput($request->only('email'))
    //                         ->withErrors(['email' => __($status)]);
    // }

    
    public function store(Request $request )
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'email'],
            ]);
    
            if ($validator->fails()) {
                return response()->json(['success'=>false, 'errors' => $validator->errors()], 400);
            }
    
            // Get the user by email
            $user = User::where('email', $request->input('email'))->first();
    
            if (!$user) {
                return response()->json(['success'=>false,'error' => 'We cannot find a user with that email address.'], 400);
            }
    
            // Retrieve email settings
            $emailSetting = new EmailSetting(); // Create an instance of the EmailSetting model
            $config = $emailSetting->getEmailConfig('general'); // Call the method on the instance
    
             if (!$config || $config == null) {
                return response()->json(['success'=>false,'error' => 'Email configuration not found.'], 400);
            }
    
            // Generate a password reset token
            $token = Password::createToken($user);
    
            // Build the reset link URL
            $resetLink = route('password.reset', $token);
            $email = $request->input('email');
            $subject='Password Reset';
            $view='backend.templates.reset-password-link';
            
                // need to send email with credentials stored in $config.smtp_port,smtp_username,smtp_host,smtp_password ,from_email, from nam
                $emailService=new EmailService;
                $emailService->sendEmail(
                    $email,               // To
                    'Password Reset',     // Subject
                    'backend.templates.reset-password-link', // View
                    ['resetLink' => $resetLink],             // Data
                    $config                                 // Email configuration
                );

            return response()->json(['success'=>true,'message' => 'Password reset email sent successfully.']);
        } catch (\Exception $e) {
            \Log::error('An error occurred: ' . $e->getMessage());
            return response()->json(['success'=>false,'error' => 'An error occurred. Please try again later.'], 500);
        }
    }
    
    
    
}

