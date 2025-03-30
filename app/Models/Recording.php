<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recording extends Model
{
    protected $table = 'recordings';
    protected $fillable = ['live_class_id', 'course_id', 'topic', 'video_url'];

    public function liveClass()
    {
        return $this->belongsTo(LiveClass::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
