<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Support\Str;


class UserController extends Controller
{
    use HasRoles, HasPermissions;
   
    public function index()
    {
        $users = User::with('roles')->get();
        return view('backend/users/users',compact('users'));
    }
     public function create( )
    {
        $roles=Role::all();
        return view('backend/users/create',compact('roles'));
    }


     public function store(Request $request)
    {

    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
        'password' => ['required', Rules\Password::defaults()],
        'role' => ['required'],
        'image' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        'status'=> ['required', Rule::in(['active', 'inactive'])],
        'gender'=> ['required', Rule::in(['male', 'female'])],
        'commission'=>['sometimes','nullable','numeric'],
    ]);

    $role = Role::firstWhere('name', $request->role);

    if (!$role) {
        return redirect()->route('users.index')->with('error', 'Role not found');
    }
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->mobile = $request->mobile;
    $user->address = $request->address;
    $user->status = $request->status;
    $user->affiliate_code =$request->name.'_'.Str::random(6);
    $user->gender = $request->gender;
    $user->password = Hash::make($request->password);
    $user->referred_by  = 6;
    $user->commission=($request->input('commission')!='' ? $request->input('commission') : null);

    // Check if image is present
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        // Upload image to storage
        Storage::putFileAs('public/images/users', $image, $imageName);

        // Set user's image path in the database
        $user->image = $imageName;
    }else{
        $user->image='';
    }

        $user->save();
        $user->assignRole($role);

     
       return redirect()->route('users.index')->with('success', 'User created');
    }
      /**
     * edit the user's account.
     */
    public function edit($id)
    {
        
        $user=User::findOrFail($id);
        $permissions=Permission::all();
        $currentRole = $user->roles->pluck('name')->first();
        $roles = Role::whereNotIn('name', [$currentRole])->get();
        return view('backend/users/update',compact('user','permissions','currentRole','roles'));
    }
 
 
    /**
     * updating the user's account.
     */
    public function update(Request $request, User $user)
    {       
        $authUser = auth()->user();
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['sometimes', 'nullable', 'string', 'min:8'],
            'mobile' => ['sometimes', 'nullable', 'string', 'max:15'],
            'address' => ['sometimes', 'nullable', 'string'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'image' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'commission'=>['sometimes','nullable','numeric'],
            'waive_fees'=>['required']


        ];
        $role = Role::firstWhere('name', $request->role);

        if (!$role) {
            return redirect()->route('users.index')->with('error', 'Role not found');
        }
        if ($authUser->id === $user->id) {
         
             return redirect()->route('users.index')->with('error','You cannot change your details from here please go to profile section for changing');


        } else {
            $rules['role'] = ['required', Rule::in(Role::pluck('name')->all())];
            $rules['status'] = ['required', Rule::in(['active', 'inactive'])];
            $user->roles()->detach();
            $user->assignRole($request->role);
        }
        
        $validatedData = $request->validate($rules);

        $validatedData = collect($validatedData)->filter()->toArray();
    
        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images/users', $filename);
            if ($user->image && Storage::disk('public')->exists('images/users/' . $user->image)) {
                Storage::disk('public')->delete('images/users/' . $user->image);
            }
            $validatedData['image'] = $filename;
        } else {
            unset($validatedData['image']);
        }
       
        $user->update($validatedData);


        return redirect()->route('users.index')->with('success','User Updatted');
    }
        
    /**
     * Delete the user's account.
     */
    public function destroy(User $user)
   {
    // Check if the authenticated user is trying to delete their own account
    if (auth()->user()->id === $user->id) {
        return back()->with('error', 'You cannot delete your own account.');
    }

    // Delete the user's image if it exists
    if ($user->image) {
        Storage::delete('public/images/users/' . $user->image);
    }

    // Delete the user
    $user->delete();


    return redirect()->route('users.index')->with('success', 'User deleted successfully.');
  }

    
}
