<?php

namespace App\Http\Controllers\Roles_Permissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
class PermissionManage extends Controller
{
    /* this function is responsible for removing or assigning a single permission
     to multiple roles or users */
    public function assignRevokePermission(Request $request, Permission $permission)
   {
    $users = $request->input('users', []);
    $roles = $request->input('roles', []);
    $usersWithPermission = $permission->users()->get();
    $rolesWithPermission = $permission->roles()->get();
    $auhtId = Auth::id();
    // assign permission to selected users
    foreach ($users as $userId) {
        $user = User::find($userId);
        if ($user && !$user->hasPermissionTo($permission)) {
            $user->givePermissionTo($permission);
        }
    }

    // assign permission to selected roles
   
    foreach ($roles as $roleId) {
        $role = Role::findOrFail($roleId);
        if ($role->id != auth()->user()->role_id) {
            $role->givePermissionTo($permission);
        }
    }

    // revoke permission from users who were not selected
    foreach ($usersWithPermission as $user) {
        if ($user->id !== $auhtId && !in_array($user->id, $users)) {
            $user->revokePermissionTo($permission);
        }
    }
 
    // Revoke permission from roles that were not selected
    foreach ($rolesWithPermission as $role) {
        if ($role->id !== auth()->user()->role_id && !in_array($role->id, $roles)) {
            $role->revokePermissionTo($permission);
        }
    }

    return redirect()->back()->with('success', 'Permission assigned successfully.');
  }

      /* this function is responsible for removing or assigning a multiple permissions
     to single role  */
     public function assignRevokePermissionRole(Request $request, Role $role){
        $user=Auth::user();

        if($user->roles->pluck('name')[0]==$role->name){
            return redirect()->back()->with('error', 'You cannot change your own role permissions.');
        }
          
        
        $permissionIds = $request->input('permissions', []);
        $permissions = Permission::whereIn('id', $permissionIds)->get();
        
        $rolesWithPermission = $role->permissions()->get();
    
        // assign selected permissions to role
        foreach ($permissions as $permission) {
            if (!$role->hasPermissionTo($permission)) {
                $role->givePermissionTo($permission);
            }
        }
        
        // revoke permission from permissions that were not selected
        foreach ($rolesWithPermission as $permission) {
            if (!$permissions->contains($permission)) {
                $role->revokePermissionTo($permission);
            }
        }
    
        return redirect()->back()->with('success', 'Permission assigned successfully.');
    }
    
      /* this function is responsible for removing or assigning a multiple permissions
     to single User  */
     public function assignRevokePermissionUser(Request $request, User $user)
     {
         // Make sure the logged-in user cannot change their own permissions
         $authUser = Auth::user();
         if ($authUser->id === $user->id) {
             return redirect()->back()->with('error', 'You cannot change your own permissions.');
         }
     
         $permissionIds = $request->input('permissions', []);
         $permissions = Permission::whereIn('id', $permissionIds)->get();
     
         // Assign selected permissions to the user
         $user->syncPermissions($permissions);
         $request->session()->forget('success');
         return redirect()->back()->with('success', 'Permission assigned/revoked successfully.');
     }
     
     
     
}
