<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';

    protected $fillable = [
        'user_id',
        'fullname',
        'email',
        'ic_no',
        'address',
        'phone_no',
        'position_id',
        'department_id',
        'supervisor_id',
        'is_supervisor',
        'is_active',
        'status_id',
    ];

    public function hasUser(){
        $this->belongsTo(User::class, 'id');
    }

    public function hasPosition(){
        return $this->belongsTo(RefPosition::class, 'position_id');
    }
    
    public function hasDepartment()
    {
        return $this->belongsTo(RefDepartment::class, 'department_id');
    }

    public function hasSupervisor(){
        return $this->belongsTo(Staff::class, 'supervisor_id');
    }

    public function hasLeave(){
        return $this->hasMany(StaffLeave::class);
    }

    public function hasLeaveApplication(){
        return $this->hasMany(LeaveApplication::class);
    }
}
