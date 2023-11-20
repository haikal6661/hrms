<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Announcement extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'announcements';

    protected $fillable = [
        'title',
        'body',
        'status_id',
        'created_by',
    ];

    public function hasCreatedBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function hasStatus(){
        return $this->belongsTo(RefStatus::class, 'status_id');
    }
}
