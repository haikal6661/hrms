<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\StaffDAO;

Route::group(['prefix' => 'staff', 'as' => 'staff', 'middleware' => 'auth'], function(){

    //register staff
    Route::post('/staff-store', function(Request $request){
        $StaffDAO = new StaffDAO();
        return $StaffDAO->storeStaff($request);
    })->name('.staff-store');

    //show staff page

    Route::get('/staff-list', function(Request $request){
        return view('staff.staff-list');
    })->name('.staff-list');
});



?>