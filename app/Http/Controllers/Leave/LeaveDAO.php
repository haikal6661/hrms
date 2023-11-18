<?php

namespace App\Http\Controllers\Leave;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Staff\StaffDAO;
use App\Mail\LeaveApproval;
use App\Mail\LeaveRequest;
use App\Mail\NewUserRegistered;
use App\Models\LeaveApplication;
use App\Models\RefLeaveType;
use App\Models\Staff;
use App\Models\StaffLeave;
use App\Models\User;
use App\Notifications\LeaveApproval as NotificationsLeaveApproval;
use App\Notifications\LeaveRequest as NotificationsLeaveRequest;
use Notification;
use App\Notifications\SendEmailNewUser;
use App\Notifications\SendLeaveRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\Switch_;

class LeaveDAO extends Controller
{
    public function storeEntitlement(Request $request){

        $staff_id = $request->staff_id;
        $staff = Staff::find($staff_id);
        $entitlement = StaffLeave::where('staff_id', $staff_id)->first();
        
        if($entitlement == null){
            foreach($request->leave as $key => $detail){
            
                $data = [
                    'staff_id' => $staff_id,
                    'leave_type_id' => $key,
                    'entitlement' => $detail,
                ];
    
                StaffLeave::create($data);
    
            }
        }else{
            foreach($request->leave as $key => $detail){

            $entitlement = StaffLeave::where('staff_id', $staff_id)->where('leave_type_id', $key);

                $data = [
                    'entitlement' => $detail,
                ];
    
                $entitlement->update($data);
            }
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
        $entitlement = StaffLeave::where('staff_id', $staff_id);
        
        if($staff->hasLeave == null){

            foreach($request->leave as $key => $detail){
            
                $data = [
                    'staff_id' => $staff_id,
                    'leave_type_id' => $key,
                    'balance' => $detail,
                ];
    
                StaffLeave::create($data);
    
            }
        }else{
            
            foreach($request->leave as $key => $detail){

            $balance = StaffLeave::where('staff_id', $staff_id)->where('leave_type_id', $key);

                $data = [
                    'balance' => $detail,
                ];
    
                $balance->update($data);
            }
        }

        

        $url = route('leave.leave-balance');

        return $response = [
            'message' => "Balance added sucessfully.",
            'url' => $url,
        ];

    }

    public function storeLeaveApplication(Request $request){
        
        Self::checkBalance($request);
        $staff_id = $request->staff_id;
        $staff = Staff::find($staff_id);
        $supervisor = $staff->supervisor_id;

        $request->validate([
            'get_start_date' => ['required'],
            'get_end_date' => ['required'],
            'leave_type_id' => ['required'],
        ],[
            'get_start_date.required' => 'Please fill in start date.',
            'get_end_date.required' => 'Please fill in end date.',
            'leave_type_id.required' => 'Please choose leave type.',
        ]);

        $balance = $this->checkBalance($request);

        if($balance == true){
    
            $data = [
                'staff_id' => $staff_id,
                'start_date' => date("Y-m-d",strtotime($request->get_start_date)),
                'end_date' => date("Y-m-d",strtotime($request->get_end_date)),
                'no_of_days' => $request->no_of_days,
                'leave_type_id' => $request->leave_type_id,
                'reason' => $request->reason,
                'status_id' => 5,
            ];
    
            $leaveApplication = LeaveApplication::create($data);
            $this->sendEmail($supervisor,$leaveApplication);
    
            $url = route('leave.leave-balance');
    
            if($leaveApplication){
                return $response = [
                    'message' => "Leave Form Submitted.",
                    'url' => $url,
                ];
            }else{
                return $response = [
                    'message' => "Something went wrong.",
                    'url' => $url,
                ];
            }
        }else{
            $url = route('leave.leave-balance');
            return $response = [
                'flag' => 1,
                'message' => "Your leave balance is insufficient.",
                'url' => $url,
            ];
        }

    }

    public function storeLeaveApproval(Request $request){

        $staff_id = $request->staff_id;
        $leave_type_id = $request->leave_type_id;
        $no_of_days = $request->no_of_days;

        $leave_id = $request->leave_id;
        $staffleave = StaffLeave::where('staff_id', $staff_id)
                        ->where('leave_type_id', $leave_type_id)->first();

        $leaveApplication = LeaveApplication::find($leave_id);

        $balance = $staffleave->balance;
        $update_balance = $balance-$no_of_days;

        if($request->approval == 1){

            $data = [
                'balance' => $update_balance,
            ];
    
            $data2 = [
                'supervisor_remark' => $request->supervisor_remark,
                'approval_staff_id' => auth()->user()->hasStaff->id,
                'status_id' => 6,
            ];

            $staffleave->update($data);
            $leaveApplication->update($data2);

            $this->sendEmailApproval($request);

        }else{

            $data2 = [
                'supervisor_remark' => $request->supervisor_remark,
                'status_id' => 8,
            ];

            $leaveApplication->update($data2);

            $this->sendEmailApproval($request);
        }

        $url = route('leave.leave-application-list');

        return $response = [
            'message' => "Leave Approval Submitted.",
            'url' => $url,
        ];

    }

    public function checkBalance($request){
        
        $staff_id = $request->staff_id;
        $leave_id = $request->leave_type_id;
        $days = $request->no_of_days;

        $staff = StaffLeave::where('staff_id', $staff_id)
                    ->where('leave_type_id', $leave_id)->first();

        if($staff == null){
            return false;
        }

        $staff_balance = $staff->balance;

        if($staff_balance >= $days){
            return true;
        }else{
            return false;
        }

    }

    public function sendEmail($information,$leaveApplication){
        
        $supervisor = User::whereHas('hasStaff', function ($q) use ($information){
                    $q->where('id', $information);
        })->first();


        $details = [
            'subject' => 'Leave Request',
            'title' => 'Leave Request '.Carbon::now()->format('d/m/Y'),
            'name' => $leaveApplication->hasStaff->fullname,
            'leave_type' => $leaveApplication->hasLeaveName->desc,
            'start_date' => $leaveApplication->start_date,
            'end_date' => $leaveApplication->end_date,
            'no_of_days' => $leaveApplication->no_of_days,
        ];

        Mail::to($supervisor->email)->send(new LeaveRequest($details));
        User::find($supervisor->id)->notify(new NotificationsLeaveRequest($leaveApplication->id));
    }

    public function sendEmailApproval($information){
        
        $staff_id = $information->staff_id;
        $leave_id = $information->leave_id;
        $staff = Staff::find($staff_id);
        $leaveApplication = LeaveApplication::find($leave_id);

        if($information->approval == 1){

            //if leave request approve

            $details = [
                'subject' => 'Leave Approval',
                'title' => 'Leave Approval '.Carbon::now()->format('d/m/Y'),
                'start_date' => $leaveApplication->start_date,
                'end_date' => $leaveApplication->end_date,
                'result' => 'approved',
                // 'remarks' => $information->supervisor_remark,
            ];

            Mail::to($staff->email)->send(new LeaveApproval($details));
            User::find($staff->user_id)->notify(new NotificationsLeaveApproval($leaveApplication->id));

        }else{

            //if leave request reject

            $details = [
                'subject' => 'Leave Approval',
                'title' => 'Leave Approval '.Carbon::now()->format('d/m/Y'),
                'start_date' => $leaveApplication->start_date,
                'end_date' => $leaveApplication->end_date,
                'result' => 'rejected',
                'remarks' => $information->supervisor_remark,
            ];

            Mail::to($staff->email)->send(new LeaveApproval($details));
            User::find($staff->user_id)->notify(new NotificationsLeaveApproval($leaveApplication->id));
        }
    }

    // public function sendEmail(){
    //     $details = [
    //         'subject' => 'Leave Approval',
    //         'title' => 'Leave Approval '.Carbon::now()->format('d/m/Y'),
    //         'start_date' => '13/1/2023',
    //         'end_date' => '13/1/2023',
    //         'result' => 'approved',
    //     ];

    //     return (new LeaveApproval($details))->render();
    // }
}
