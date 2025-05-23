<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipRecording extends Model
{
    use HasFactory;
    protected $fillable = ['recording_course_id', 'topic', 'title', 'link'];

    public function recordingCourse()
    {
        return $this->belongsTo(InternshipRecordingCourse::class);
    }

    public function liveClasses()
    {
        return $this->hasMany(LiveClass::class);
    }

    public function course()
    {
        return $this->belongsTo(InternshipRecordingCourse::class, 'recording_course_id');
    }
}
