<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\StaffDAO;
use App\Models\RefDepartment;
use App\Models\RefPosition;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;

Route::group(['prefix' => 'staff', 'as' => 'staff', 'middleware' => 'auth'], function(){


    Route::group(['middleware' => ['permission:create staff|view staff|update staff|delete staff']], function () {

        //register staff
        Route::post('/staff-store', function(Request $request){
            $StaffDAO = new StaffDAO();
            return $StaffDAO->storeStaff($request);
        })->name('.staff-store');

        //show list staff page
        Route::get('/staff-list', function(Request $request){

            $refposition = RefPosition::all();
            $refdepartment = RefDepartment::all();
            $stafflist = Staff::paginate(10);

            return view('staff.staff-list', [
                'refposition' => $refposition,
                'refdepartment' => $refdepartment,
                'stafflist' => $stafflist,
            ]);
        })->name('.staff-list');

        //delete staff
        Route::delete('/staff-delete', function(Request $request){
            $StaffDAO = new StaffDAO();
            return $StaffDAO->deleteStaff($request);
        })->name('.staff-delete');
    });

    Route::group(['middleware' => ['permission:update staff']], function (){

        //edit staff page
        Route::get('/staff-edit', function(Request $request){

            $detail = [];

            $staff_id = $request->id;

            $detail = Staff::find($staff_id);
            $refposition = RefPosition::all();
            $refdepartment = RefDepartment::all();
            $refsupervisor = Staff::where('is_supervisor','!=', null)->get();

            return view('staff.staff-edit', [
                'detail' => $detail,
                'refposition' => $refposition,
                'refdepartment' => $refdepartment,
                'refsupervisor' => $refsupervisor,
            ]);

        })->name('.staff-edit');
    });

    //view staff profile
    Route::get('/staff-profile', function(Request $request){

        $staff = Auth::user()->hasStaff;
        $refposition = RefPosition::all();
        $refdepartment = RefDepartment::all();
        $refsupervisor = Staff::where('is_supervisor','!=', null)->get();

        return view('staff.staff-profile', [
            'staff' => $staff,
            'refposition' => $refposition,
            'refdepartment' => $refdepartment,
            'refsupervisor' => $refsupervisor,
        ]);

    })->name('.staff-profile');

    //update staff
    Route::post('/staff-update', function(Request $request){
        $StaffDAO = new StaffDAO();
        return $StaffDAO->updateStaff($request);
    })->name('.staff-update');

    Route::get('/getStaffDetail', function(Request $request){

        $staff_id = $request->data;

        $detail = Staff::where('id', $staff_id)->with('hasPosition','hasDepartment','hasSupervisor')->first();

        return response()->json([$detail]);


    })->name('.getStaffDetail');

});



?>