<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveApplication extends Model
{
    use HasFactory;

    protected $table = 'leave_application';

    protected $fillable = [
        'staff_id',
        'start_date',
        'end_date',
        'no_of_days',
        'leave_type_id',
        'reason',
        'status_id',
    ];

    public function hasStaff(){
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function hasLeaveName(){
        return $this->belongsTo(RefLeaveType::class, 'leave_type_id');
    }

    public function hasStatus(){
        return $this->belongsTo(RefStatus::class, 'status_id');
    }
}
