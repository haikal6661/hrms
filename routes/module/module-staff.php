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

    //edit staff page
    Route::get('/staff-edit', function(Request $request){

        $detail = [];

        $staff_id = $request->id;

        $detail = Staff::find($staff_id);
        $refposition = RefPosition::all();
        $refdepartment = RefDepartment::all();

        return view('staff.staff-edit', [
            'detail' => $detail,
            'refposition' => $refposition,
            'refdepartment' => $refdepartment,
        ]);

    })->name('.staff-edit');

    Route::get('/getStaffDetail', function(Request $request){

        $staff_id = $request->data;

        $detail = Staff::where('id', $staff_id)->with('hasPosition','hasDepartment')->first();

        return response()->json([$detail]);


    })->name('.getStaffDetail');

});



?>