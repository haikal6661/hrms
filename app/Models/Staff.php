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
        'supervisor',
        'is_supervisor',
        'status_id',
        'leave_id',
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
}
