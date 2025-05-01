<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipBatch extends Model
{
    use HasFactory;

    public function students()
{
    return $this->belongsToMany(InternshipEnrollment::class, 'internship_batch_student');
}

public function classes()
{
    return $this->hasMany(InternshipClass::class,'batch_id');
}
}
