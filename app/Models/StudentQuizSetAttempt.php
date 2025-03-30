<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentQuizSetAttempt extends Model
{
    protected $fillable = ['user_id', 'quiz_set_id', 'score'];

    public function answers()
    {
        return $this->hasMany(StudentQuizAnswer::class, 'attempt_id');
    }
}
