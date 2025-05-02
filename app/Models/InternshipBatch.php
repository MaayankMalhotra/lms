<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipBatch extends Model
{
    use HasFactory;
    protected $fillable = [
        'internship_id', 'batch_name', 'start_time', 'end_time', 'class_schedule',
    ];
    

    public function students()
{
    return $this->belongsToMany(InternshipEnrollment::class, 'internship_batch_student');
}

public function classes()
{
    return $this->hasMany(InternshipClass::class,'batch_id');
}

public function internship()
{
    return $this->belongsTo(Internship::class, 'internship_id');
}
}