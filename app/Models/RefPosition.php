<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefPosition extends Model
{
    use HasFactory;

    protected $table = 'ref_position';

    protected $fillable = [
        'code',
        'desc',
    ];
}
