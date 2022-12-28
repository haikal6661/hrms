<?php

namespace App\Http\Controllers\Staff;
use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffDAO extends Controller {
    //store staff

    public function storeStaff(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user_data = [
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ];

        $user = User::create($user_data);
        $user_id = $user->id;

        $staff_data = [
            'user_id' => $user_id,
            'fullname' => $request['name'],
            'email' => $request['email'],
            'position_id' => $request['position_id'],
            'department_id' => $request['department_id'],
        ];

        $url = route('staff.staff-list');

        Staff::create($staff_data);

        return $response = [
            'message' => "Staff added successfully.",
            'url' => $url,
        ];
    }
}











?>