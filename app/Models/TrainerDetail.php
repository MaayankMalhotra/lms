<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainerDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'experience',
        'teaching_hours',
        'course_ids',
    ];

    protected $casts = [
        'course_ids' => 'array', // Automatically decode JSON to array
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function courses()
    {
        return Course::whereIn('id', $this->course_ids ?? [])->get();
    }
    
    
}
