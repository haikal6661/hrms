<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\StaffDAO;
use App\Models\RefDepartment;
use App\Models\RefPosition;
use App\Models\Staff;

Route::group(['prefix' => 'staff', 'as' => 'staff', 'middleware' => 'auth'], function(){

    //register staff
    Route::post('/staff-store', function(Request $request){
        $StaffDAO = new StaffDAO();
        return $StaffDAO->storeStaff($request);
    })->name('.staff-store');

    //show staff page

    Route::get('/staff-list', function(Request $request){

        $refposition = RefPosition::all();
        $refdepartment = RefDepartment::all();
        $stafflist = Staff::all();

        return view('staff.staff-list', [
            'refposition' => $refposition,
            'refdepartment' => $refdepartment,
            'stafflist' => $stafflist,
        ]);
    })->name('.staff-list');
});



?>