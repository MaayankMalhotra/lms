<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipClass extends Model
{
    use HasFactory;
    protected $fillable = [
        'batch_id', 'class_date_time', 'link', 'thumbnail', 'status', 'subject', 'recording_id'
    ];

    public function batch(){
        return $this->belongsTo(InternshipBatch::class,'batch_id');
    }

    public function recording()
    {
        return $this->belongsTo(InternshipRecording::class);
    }
}
