<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentQuizAnswer extends Model
{
    protected $fillable = ['attempt_id', 'quiz_id', 'student_answer'];
}
