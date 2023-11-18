<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefGender extends Model
{
    use HasFactory;

    protected $table = 'ref_gender';

    protected $fillable = [
        'code',
        'desc',
    ];
}
