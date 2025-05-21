<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipClass extends Model
{
    use HasFactory;
    protected $fillable = [
        'batch_id', 'class_date_time', 'link', 'thumbnail', 'status', 'subject', 'recording_id','notes',     // Add notes
        'notes_2',
    ];
    protected $casts = [
        'notes' => 'array',   // Automatically decode notes JSON to an array
        'notes_2' => 'array', // Automatically decode notes_2 JSON to an array
    ];
    public function batch(){
        return $this->belongsTo(InternshipBatch::class,'batch_id');
    }

    public function recording()
    {
        return $this->belongsTo(InternshipRecording::class);
    }
}
