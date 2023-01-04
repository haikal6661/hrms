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
}
