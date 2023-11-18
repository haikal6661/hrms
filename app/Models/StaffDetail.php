<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffDetail extends Model
{
    use HasFactory;

    protected $table = 'staff_details';

    protected $fillable = [
        'staff_id',
        'marriage_status',
        'spouse_name',
        'spouse_phone_no',
        'occupation',
        'no_children',
        'emergency_name',
        'emergency_phone_no',
    ];
}
