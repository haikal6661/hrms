<?php

namespace App\Http\Controllers\Staff;
use App\Http\Controllers\Controller;
use App\Mail\NewUserRegistered;
use App\Models\Staff;
use App\Models\StaffDetail;
use App\Models\User;
use Notification;
use App\Notifications\SendEmailNewUser;
use App\Notifications\StaffRegister;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class StaffDAO extends Controller {
    //store staff

    public function storeStaff(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user_data = [
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ];

        $user = User::create($user_data);
        $user->assignRole('User');
        $this->sendEmail($user,$request);
        $user_id = $user->id;

        $staff_data = [
            'user_id' => $user_id,
            'fullname' => $request['name'],
            'email' => $request['email'],
            'position_id' => $request['position_id'],
            'department_id' => $request['department_id'],
            'is_supervisor' => $request['is_supervisor'],
            'is_active' => 1,
        ];

        $url = route('staff.staff-list');

        Staff::create($staff_data);

        User::find($user_id)->notify(new StaffRegister($user->name));

        return $response = [
            'message' => "Staff added successfully.",
            'url' => $url,
        ];
    }

    //update staff
    public function updateStaff(Request $request){
        
        $staff_id = $request->staff_id;

        $staff = Staff::find($staff_id);

        $request->validate([
                'image' => 'image:jpeg,png,jpg|max:2048',
            ],[
                'image.image' => 'Please enter the correct format. eg:jpeg,png,jpg',
                'image.mimes' => 'Please enter the correct format. eg:jpeg,png,jpg',
        ]);

        $image = $request->file('image');

        if($request->result == "profile"){

            if($image){
                $imageName = $image->getClientOriginalName();

                $data = [
                    'ic_no' => $request->ic_no,
                    'address' => $request->address,
                    'phone_no' => $request->phone_no,
                    'gender_id' => $request->gender,
                    'image' => $imageName,
                    'image_path' => 'images/profile_picture/'.$imageName,
                ];

                $condition = [
                    'staff_id' => $staff_id,
                ];

                $data2 = [
                    'marriage_status' => $request->marriage_status,
                    'spouse_name' => $request->spouse_name,
                    'spouse_phone_no' => $request->spouse_phone_no,
                    'occupation' => $request->occupation,
                    'no_children' => $request->no_children,
                    'emergency_name' => $request->emergency_name,
                    'emergency_phone_no' => $request->emergency_phone_no,
                ];
    
                // $request->image->storeAs('images/profile_picture/',$imageName.$imageExt);
                Storage::disk('public')->put('images/profile_picture/'.$imageName, file_get_contents($image));
            }else{
                $data = [
                    'ic_no' => $request->ic_no,
                    'address' => $request->address,
                    'phone_no' => $request->phone_no,
                    'gender_id' => $request->gender,
                ];

                $condition = [
                    'staff_id' => $staff_id,
                ];

                $data2 = [
                    'marriage_status' => $request->marriage_status,
                    'spouse_name' => $request->spouse_name,
                    'spouse_phone_no' => $request->spouse_phone_no,
                    'occupation' => $request->occupation,
                    'no_children' => $request->no_children,
                    'emergency_name' => $request->emergency_name,
                    'emergency_phone_no' => $request->emergency_phone_no,
                ];
            }

        }else{

            $data = [
                'fullname' => $request->fullname,
                'email' => $request->email,
                'ic_no' => $request->ic_no,
                'address' => $request->address,
                'phone_no' => $request->phone_no,
                'position_id' => $request->position_id,
                'supervisor_id' => $request->supervisor_id,
                'department_id' => $request->department_id,
            ];

        }

        $staff->update($data);
        
        if($request->result == "profile"){
            StaffDetail::updateOrCreate($condition,$data2);
        }

        if($request->result == "profile"){
            $message = 'Profile Updated Successfully.';
        }else{
            $message = 'Staff Updated Succsessfully.';
        }

        if($staff->update($data)){
            return $respones = [
                'message' => $message,
            ];
        }else{
            return $respones = [
                'message' => 'Something went wrong.',
            ];
        }
    }

    public function deleteStaff(Request $request){
        $staff_id = $request->id;

        $staff = Staff::where('id',$staff_id)->first();
        $user_id = $staff->user_id;
        User::where('id',$user_id)->delete();
        $staff->delete();

        $url = route('staff.staff-list');

        return $respones = [
            'message' => "Staff has been deleted.",
            'url' => $url,
        ];
    }

    public function sendEmail($information,$request){

        $password = $request->password;

        $details = [
            'subject' => 'Registration New User',
            'title' => 'Registration New User '.Carbon::now()->format('d/m/Y'),
            'username' => $information->email,
            'password' => $password,
        ];

        Mail::to($information)->send(new NewUserRegistered($details));
    }
}








?>