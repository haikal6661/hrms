<?php

use App\Http\Controllers\RoleController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Role;

Route::group(['prefix' => 'uac', 'as' => 'uac', 'middleware' => ['role:Admin']], function(){

    //show role page
    Route::get('/role-list', function(Request $request){

        $roles = Role::withCount('users')->paginate(10);
        $userList = User::all();
        
        return view('uac.role-list', [
            'roles' => $roles,
            'userList' => $userList,
        ]);

    })->name('.role-list');

    Route::post('/role-store', function (Request $request){

        $role = new RoleController();
        return $role->storeRole($request);

    })->name('.role-store');

    Route::post('/assign-user', function (Request $request){

        $user = new RoleController();
        return $user->assignUser($request);
    })->name('.assign-user');

    Route::post('/unassign-user', function (Request $request){

        $user = new RoleController();
        return $user->unassignUser($request);
    })->name('.unassign-user');

    Route::get('/get-users-for-role/{roleId}', function (Request $request){
        
        $role_id = $request->roleId;

        $role = Role::find($role_id);

        $usersWithRole = $role->users;

        return response()->json(['users' => $usersWithRole]);

    })->name('.get-users-for-role');

    Route::get('/permission', function (Request $request){

        return view('uac.permission');

    })->name('.permission');

});



?>