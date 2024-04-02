<?php

namespace App\Http\Controllers\Roles_Permissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Auth;
class RolesandPermissionsController extends Controller
{
    /**
     * Roles list .
     */
    public function rolesIndex(){
        $roles = Role::withCount('users')->get();
        return view('backend/rolesAndpermissions/roles',compact('roles'));
    }
     /**
     * Roles Create . 
     */
   public function rolesCreate(){
    return view('backend/rolesAndpermissions/rolesCreate');
   }
      /**
     * Roles Store in database .
     */
   public function rolesStore(Request $request)
  {
    $validatedData = $request->validate([
        'name' => ['required', 'string', 'max:255', 'unique:' . Role::class],
    ]);

    $role = Role::create([
        'name' => $validatedData['name'],
    ]);

    return redirect()->route('/roles.index')->with('success','Role Created');
  }
   /**
     * Role Edit form .
     */
  public function rolesEdit($id){
    
    $role=Role::findOrFail($id);
    $permissions=Permission::all();
    return view('backend/rolesAndpermissions/rolesUpdate',compact('role','permissions'));
  }
   /**
     * Role Update in database .
     */
  public function rolesUpdate(Request $request, Role $role)
  {
      $validatedData = $request->validate([
          'name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($role->id)],
      ]);
  
      $role->update([
          'name' => $validatedData['name'],
      ]);
  
      return redirect()->route('/roles.index')->with('success','Role Updated');
  }

  /**
     * Permissions index view .
     */
    public function PermissionsIndex(){
        $permissions = Permission::withCount(['users', 'roles'])->get();
        return view('backend/rolesAndpermissions/permissions',compact('permissions'));
    }
    
     /**
     * Permissions creat view .
     */
    public function permissionsCreate(){
        return view('backend/rolesAndpermissions/permissionsCreate');
        
    }
     /**
     * Permissions creat request .
     */
    public function permissionsStore(Request $request){
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:' . Permission::class],
        ]);
    
        $permission = Permission::create([
            'name' => $validatedData['name'],
        ]);
    
        return redirect()->route('/permissions.index')->with('success',' Permissions Created');
    }
     /**
     * Permissions creat request .
     */
    public function permissionsEdit($id){
        $permission =Permission::findOrFail($id);
        $users=User::all();
        $roles=Role::all();
        return view('backend/rolesAndpermissions/permissionUpdate',compact('permission','users','roles'));
    }
     /**
     * Permissions update request .
     */
    public function permissionUpdate(Request $request, Permission $permission)
  {
      $validatedData = $request->validate([
          'name' => ['required', 'string', 'max:255', Rule::unique('permissions')->ignore($permission->id)],
      ]);
      $permission->update([
          'name' => $validatedData['name'],
      ]);
  
      return redirect()->route('/permissions.index')->with('success','Permission Updated');
  }
}