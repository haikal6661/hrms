<?php

namespace App\Http\Controllers\Leave;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Staff\StaffDAO;
use App\Models\Staff;
use App\Models\StaffLeaveBalance;
use App\Models\StaffLeaveEntitlement;
use Illuminate\Http\Request;

class LeaveDAO extends Controller
{
    public function storeEntitlement(Request $request){

        $staff_id = $request->staff_id;
        $staff = Staff::find($staff_id);

        if ($staff->leave_entitlement_id == null && $staff->leave_balance_id == null) {

            $staffEntitlement = StaffLeaveEntitlement::create();
            $staffBalance = StaffLeaveBalance::create();
            $leaveEntitlementId = $staffEntitlement->id;
            $leaveBalancetId = $staffBalance->id;

            $staff_entitlement = [
                'leave_entitlement_id' => $leaveEntitlementId,
            ];

            $staff_balance = [
                'leave_balance_id' => $leaveBalancetId,
            ];

            $staff->update($staff_entitlement);
            $staff->update($staff_balance);

            $staffEntitlementId = $staff->leave_entitlement_id;
            $leaveEntitlement = StaffLeaveEntitlement::find($staffEntitlementId);

            $entilementData = [
                'annual_leave' => $request->annual_leave,
                'sick_leave' => $request->sick_leave,
                'paternity_leave' => $request->paternity_leave,
                'maternity_leave' => $request->maternity_leave,
                'marriage_leave' => $request->marriage_leave,
                'compassionate_leave' => $request->compassionate_leave,
                'unpaid_leave' => $request->unpaid_leave,
            ];

            $leaveEntitlement->update($entilementData);

        } else {
            
            $staffEntitlementId = $staff->leave_entitlement_id;
            $leaveEntitlement = StaffLeaveEntitlement::find($staffEntitlementId);

            $entilementData = [
                'annual_leave' => $request->annual_leave,
                'sick_leave' => $request->sick_leave,
                'paternity_leave' => $request->paternity_leave,
                'maternity_leave' => $request->maternity_leave,
                'marriage_leave' => $request->marriage_leave,
                'compassionate_leave' => $request->compassionate_leave,
                'unpaid_leave' => $request->unpaid_leave,
            ];

            $leaveEntitlement->update($entilementData);
        }

        $url = route('leave.leave-entitlement');

        return $response = [
            'message' => "Entitlement added sucessfully.",
            'url' => $url,
        ];

    }

    public function storeBalance(Request $request){

        $staff_id = $request->staff_id;
        $staff = Staff::find($staff_id);
        $staffBalanceId = $staff->leave_balance_id;
        $leaveBalance = StaffLeaveBalance::find($staffBalanceId);

        $balanceData = [
            'annual_leave' => $request->annual_leave,
            'sick_leave' => $request->sick_leave,
            'paternity_leave' => $request->paternity_leave,
            'maternity_leave' => $request->maternity_leave,
            'marriage_leave' => $request->marriage_leave,
            'compassionate_leave' => $request->compassionate_leave,
            'unpaid_leave' => $request->unpaid_leave,
        ];

        $leaveBalance->update($balanceData);

        $url = route('leave.leave-balance');

        return $response = [
            'message' => "Balance edited sucessfully.",
            'url' => $url,
        ];

    }
}
