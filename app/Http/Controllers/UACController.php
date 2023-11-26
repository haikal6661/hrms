<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UACController extends Controller
{
    
    public function storeRole(Request $request){

        $request->validate(['role_name' => ['required', 'string', 'max:255'],
        [
            'role_name.required' => 'Please fill in Role Name.'
        ]]);

        $data = [
            'name' => $request->role_name,
            'guard_name' => 'web',
        ];

        Role::create($data);

        $url = route('uac.role-list');

        return $response = [
            'message' => "Role added successfully.",
            'url' => $url,
        ];

    }

    public function assignUser(Request $request){
        
        $roleId = $request->roleId;
        $userIds = $request->input('user_id');

        $role = Role::find($roleId);

        // Assign the role to each user
        foreach ($userIds as $userId) {
            $user = User::find($userId);

            if ($user) {
                $user->assignRole($role);
            }
        }

        $url = route('uac.role-list');

        return $response = [
            'message' => "User assign to role successfully.",
            'url' => $url,
        ];
    }

    public function unassignUser(Request $request){
        
        $roleId = $request->roleId2;
        $userIds = $request->input('user_id');

        $role = Role::find($roleId);

        // Unassign the role to each user
        foreach ($userIds as $userId) {
            $user = User::find($userId);

            if ($user) {
                $user->removeRole($role);
            }
        }

        $url = route('uac.role-list');

        return $response = [
            'message' => "User unassign from role successfully.",
            'url' => $url,
        ];
    }

    public function permissionStore(Request $request){

        $permission = $request->permission_name;
        Permission::create(['name' => $permission]);

        $url = route('uac.permission');

        return $response = [
            'message' => "Permission added successfully.",
            'url' => $url,
        ];
    }

    public function permissionAssign(Request $request){

        // $request->validate([
        //     'permissions' => 'required|array',
        // ]);

        // Extract permissions data from the request
        $permissionsByRole = $request->input('permissions');

        // Loop through each role and its associated permissions
        foreach ($permissionsByRole as $item) {
            $roleId = $item['roleId'];
            $permissionIds = $item['permissionIds'];
        
            Log::info('Role ID: ' . $roleId);
            Log::info('Permission IDs: ' . json_encode($permissionIds));
        
            try {
                // Find the role
                $role = Role::findOrFail($roleId);
    
                // Detach all current permissions from the role
                $role->permissions()->detach();
    
                // Attach each selected permission to the role
                $permissions = Permission::findOrFail($permissionIds);
                $role->syncPermissions($permissions);
            } catch (\Exception $e) {
                // Debugging: Log any exceptions for further investigation
                Log::error('Exception: ' . $e->getMessage());
                // Optionally, you might want to handle the exception gracefully
            }
        }

        $url = route('uac.permission');

        return $response = [
            'message' => "Permission assign successfully.",
            'url' => $url,
        ];
    }
}
