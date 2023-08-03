<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

Route::group(['prefix' => 'uac', 'as' => 'uac', 'middleware' => 'auth'], function(){

    //show role page
    Route::get('/role-list', function(Request $request){

        $roles = Role::paginate(10);
        
        return view('uac.role-list', [
            'roles' => $roles,
        ]);

    })->name('.role-list');

});



?>