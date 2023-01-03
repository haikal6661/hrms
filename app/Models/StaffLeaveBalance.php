<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffLeaveBalance extends Model
{
    use HasFactory;

    protected $table = 'staff_leave_balance';

    protected $fillable = [
        'annual_leave',
        'sick_leave',
        'paternity_leave',
        'maternity_leave',
        'marriage_leave',
        'compassionate_leave',
        'unpaid_leave',
    ];

}
