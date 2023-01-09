<?php

namespace App\Http\Controllers\Leave;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Staff\StaffDAO;
use App\Mail\LeaveRequest;
use App\Mail\NewUserRegistered;
use App\Models\LeaveApplication;
use App\Models\RefLeaveType;
use App\Models\Staff;
use App\Models\StaffLeave;
use App\Models\User;
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

                // StaffLeave::update([
                //     'staff_id' => $staff_id,
                //     'leave_type_id' => $key,
                //     'entitlement' => $detail,
                // ]);
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

                // StaffLeave::UpdateOrCreate([
                //     'staff_id' => $staff_id,
                //     'leave_type_id' => $key,
                // ],[
                //     'balance' => $detail,
                // ]);
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
            $this->sendEmail($supervisor);
    
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

    public function sendEmail($information){
        
        $supervisor = User::whereHas('hasStaff', function ($q) use ($information){
                    $q->where('id', $information);
        })->first();


        $details = [
            'subject' => 'Registration New User',
            'title' => 'Registration New User'.Carbon::now()->format('d/m/Y'),
            'body' => 'Welcome To Fiscal Digest HRMS',
        ];

        Mail::to($supervisor->email)->send(new LeaveRequest($details));
        // return (new NewUserRegistered($details))->render();
    }
}
