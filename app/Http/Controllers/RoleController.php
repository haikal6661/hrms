<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
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
}
