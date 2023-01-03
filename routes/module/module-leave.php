<?php

use App\Http\Controllers\Leave\LeaveDAO;
use App\Models\Staff;
use App\Models\StaffLeaveEntitlement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'leave', 'as' => 'leave', 'middleware' => 'auth'], function(){

    //store leave entitlement
    Route::post('/leave-entitlement-store', function(Request $request){
        $LeaveDAO = new LeaveDAO();
        return $LeaveDAO->storeEntitlement($request);
    })->name('.leave-entitlement-store');

    //store balance entitlement
    Route::post('/leave-balance-store', function(Request $request){
        $LeaveDAO = new LeaveDAO();
        return $LeaveDAO->storeBalance($request);
    })->name('.leave-balance-store');

    //leave balance list
    Route::get('/leave-balance', function(Request $request){

        $staffList = Staff::all();

        
        return view('leave.leave-balance', [
            'staffList' => $staffList,
        ]);

    })->name('.leave-balance');

    //leave entitlement list
    Route::get('/leave-entitlement', function(Request $request){

        $staffList = Staff::all();

        
        return view('leave.leave-entitlement', [
            'staffList' => $staffList,
        ]);

    })->name('.leave-entitlement');

});

?>