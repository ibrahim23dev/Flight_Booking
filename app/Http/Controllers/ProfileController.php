<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Validation\ValidationException;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('backend/profile-update');

    }

    /**
     * Update the user's profile information.
     */


     public function update(Request $request): JsonResponse
     {
         try {
             $request->validate([
                 'name' => ['string', 'max:255'],
                 'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($request->user()->id)],
                 'mobile' => 'required|max:15',
                 'address' => 'required',
                 'image' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
                 'gender'=>['sometimes','nullable','in:male,female']
             ]);
         } catch (ValidationException $e) {
             // Validation failed, return the errors as JSON response
             return response()->json(['errors' => $e->errors()], 422);
         }
     
         $user = $request->user();
     
         // Update the user properties from the validated data
         $user->name = $request->input('name');
         $user->email = $request->input('email');
         $user->mobile = $request->input('mobile');
         $user->address = $request->input('address');
         $user->gender = $request->input('gender');
     
         if ($user->isDirty('email')) {
             $user->email_verified_at = null;
         }
     
         if ($request->hasFile('image')) {
             $image = $request->file('image');
             $fileName = time() . '.' . $image->getClientOriginalExtension();
             Storage::putFileAs('public/images/users', $image, $fileName);
     
             // delete old image if exists
             if ($user->image) {
                 Storage::delete('public/images/users/' . $user->image);
             }
     
             $user->image = $fileName;
         }
     
         $user->save();
     
         // Return JSON response for AJAX requests
         if ($request->ajax()) {
             return response()->json(['success' => true]);
         }
     
         return response()->json(['success' => 'Profile Updated']);
     }
     
     
     public function change(){
        return view('backend/update-password-form');
    }


    
}
