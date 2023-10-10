<?php

use App\Http\Controllers\Leave\LeaveDAO;
use App\Models\LeaveApplication;
use App\Models\RefLeaveType;
use App\Models\Staff;
use App\Models\StaffLeave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $detail = [];
        if(auth()->user()->roles->first()->name == "User"){
            $staff_id = auth()->user()->hasStaff->id;
            $detail = Staff::find($staff_id);
            $balance = StaffLeave::where('staff_id', $staff_id)->get();

            $staffList = Staff::paginate(10);
            $refleavetype = RefLeaveType::all();

            return view('leave.leave-balance', [
                'staffList' => $staffList,
                'refleavetype' => $refleavetype,
                'detail' => $detail,
                'balance' => $balance,
            ]);
        }else{

            $staffList = Staff::paginate(10);
            $refleavetype = RefLeaveType::all();
            
            return view('leave.leave-balance', [
                'staffList' => $staffList,
                'refleavetype' => $refleavetype,
            ]);
        }

    })->name('.leave-balance');

    //leave entitlement list
    Route::get('/leave-entitlement', function(Request $request){

        $detail = [];
        if(auth()->user()->roles->first()->name == "User"){
            $staff_id = auth()->user()->hasStaff->id;
            $detail = Staff::find($staff_id);
            $entitlement = StaffLeave::where('staff_id', $staff_id)->get();

            $staffList = Staff::paginate(10);
            $refleavetype = RefLeaveType::all();

            return view('leave.leave-entitlement', [
                'staffList' => $staffList,
                'refleavetype' => $refleavetype,
                'detail' => $detail,
                'entitlement' => $entitlement,
            ]);
        }else{

            $staffList = Staff::paginate(10);
            $refleavetype = RefLeaveType::all();
            
            return view('leave.leave-entitlement', [
                'staffList' => $staffList,
                'refleavetype' => $refleavetype,
            ]);
        }
        
        

    })->name('.leave-entitlement');

    //leave history list
    Route::get('/leave-history', function(Request $request){

        $leave_application = LeaveApplication::all();
        $refleavetype = RefLeaveType::all();
        
        return view('leave.leave-history', [
            'leave_application' => $leave_application,
            'refleavetype' => $refleavetype,
        ]);

    })->name('.leave-history');

    //leave application list
    Route::get('/leave-application', function(Request $request){

        $leave_application = LeaveApplication::paginate(10);
        $refleavetype = RefLeaveType::all();
        
        return view('leave.leave-application', [
            'leave_application' => $leave_application,
            'refleavetype' => $refleavetype,
        ]);

    })->name('.leave-application');

    //leave application action form
    Route::get('/leave-application-approve', function(Request $request){

        $detail = [];

        $leave_id = $request->id;
        $detail = LeaveApplication::find($leave_id);

        return view('leave.leave-request-approve', [
            'detail' => $detail,
        ]);

    })->name('.leave-request-approve');

    //leave balance edit
    Route::get('/leave-balance-edit', function(Request $request){

        $detail = [];

        $staff_id = $request->id;
        $detail = Staff::find($staff_id);
        $balance = StaffLeave::where('staff_id', $staff_id)->get();
        $refleavetype = RefLeaveType::all();
        
        return view('leave.leave-balance-edit', [
            'detail' => $detail,
            'balance' => $balance,
            'refleavetype' => $refleavetype,
        ]);

    })->name('.leave-balance-edit');

    //leave entitlement edit
    Route::get('/leave-entitlement-edit', function(Request $request){

        $detail = [];

        $staff_id = $request->id;
        $detail = Staff::find($staff_id);
        $entitlement = StaffLeave::where('staff_id', $staff_id)->get();
        $refleavetype = RefLeaveType::all();
        
        return view('leave.leave-entitlement-edit', [
            'detail' => $detail,
            'entitlement' => $entitlement,
            'refleavetype' => $refleavetype,
        ]);

    })->name('.leave-entitlement-edit');

    //show leave form
    Route::get('/leave-request-form', function(Request $request){

        $detail = [];

        $detail = Auth::user()->hasStaff;
        $staff_id = $detail->id;
        $entitlement = StaffLeave::where('staff_id', $staff_id)->get();
        $refleavetype = RefLeaveType::all();

        return view('leave.leave-request-form', [
            'refleavetype' => $refleavetype,
            'detail' => $detail,
            'entitlement' => $entitlement,
        ]);

    })->name('.leave-request-form');

    //store leave application
    Route::post('/leave-application', function(Request $request){
        $LeaveDAO = new LeaveDAO();
        return $LeaveDAO->storeLeaveApplication($request);
    })->name('.leave-application');

    //store leave approval
    Route::post('/leave-approval', function(Request $request){
        $LeaveDAO = new LeaveDAO();
        return $LeaveDAO->storeLeaveApproval($request);
    })->name('.leave-approval');

});

?>