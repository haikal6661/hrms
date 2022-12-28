<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefDepartment extends Model
{
    use HasFactory;

    protected $table = 'ref_department';

    protected $fillable = [
        'code',
        'desc',
    ];
}
