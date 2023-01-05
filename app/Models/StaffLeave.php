<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffLeave extends Model
{
    use HasFactory;

    protected $table = 'staff_leave';

    protected $fillable = [
        'staff_id',
        'leave_type_id',
        'balance',
        'entitlement',
    ];

    public function hasLeaveName(){
        return $this->belongsTo(RefLeaveType::class, 'leave_type_id');
    }

}
